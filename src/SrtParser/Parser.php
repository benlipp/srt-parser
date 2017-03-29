<?php

namespace Benlipp\SrtParser;

use Benlipp\SrtParser\Exceptions\FileNotFoundException;

class Parser
{

    private $data;
    const SRT_REGEX_STRING = '/\d\s(\d\d:\d\d:\d\d,\d\d\d)\s-->\s(\d\d:\d\d:\d\d,\d\d\d)\s((?:.*\S.*\s)*)/';

    public function loadFile($file)
    {
        try {
            $fileContents = file_get_contents($file);
        } catch (\Exception $e) {
            throw new FileNotFoundException($file);
        }
        $this->data = $fileContents;

        return $this;
    }

    public function parse()
    {
        //add a newline to the end for ease of parsing
        $data = $this->data . "\n";
        $matches = [];
        preg_match_all(self::SRT_REGEX_STRING, $this->data, $matches, PREG_SET_ORDER);

        return $this->buildCaptions($matches);
    }

    private function buildCaptions($matches)
    {
        $captions = [];
        foreach ($matches as $match) {
            $startTime = $match[1];
            $endTime = $match[2];
            $text = rtrim($match[3]);
            $caption = new Caption($startTime, $endTime, $text);
            $captions[] = $caption;
        }

        return $captions;
    }
}
