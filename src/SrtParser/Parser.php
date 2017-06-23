<?php

namespace Benlipp\SrtParser;

use Benlipp\SrtParser\Exceptions\FileNotFoundException;

class Parser
{

    private $data;
    const SRT_REGEX_STRING = '/\d\r\n\r\n((?:.*\r\n)*)\r\n/';

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
    
    public function loadString($string)
    {
        $this->data = $string;

        return $this;
    }

    public function parse()
    {
        $splitData = self::splitData($this->data);
        $captions = self::buildCaptions($splitData);

        return $captions;
    }

    /**
     * split data into workable chunks
     * @return array
     */
    private static function splitData($data)
    {
        //find digits followed by a single line break and timestamps
        $sections = preg_split('/\d+(?:\r\n|\r|\n)(?=(?:\d\d:\d\d:\d\d,\d\d\d)\s-->\s(?:\d\d:\d\d:\d\d,\d\d\d))/m', $data,-1,PREG_SPLIT_NO_EMPTY);
        $matches = [];
        foreach ($sections as $section) {
            //cleans out control characters, borrowed from https://stackoverflow.com/a/23066553
            $section = preg_replace('/[^\PC\s]/u', '', $section);
            if(trim($section) == '') continue;
            $matches[] = preg_split('/(\r\n|\r|\n)/', $section, 2,PREG_SPLIT_NO_EMPTY);
        }
        return $matches;
    }

    private static function buildCaptions($matches)
    {
        $captions = [];
        foreach ($matches as $match) {
            $times = self::timeMatch($match[0]);
            $text = self::textMatch($match[1]);

            $captions[] = new Caption($times['start_time'], $times['end_time'], $text);
        }

        return $captions;
    }

    private static function timeMatch($timeString)
    {
        $matches = [];
        preg_match_all('/(\d\d:\d\d:\d\d,\d\d\d)\s-->\s(\d\d:\d\d:\d\d,\d\d\d)/', $timeString, $matches,
            PREG_SET_ORDER);
        $time = $matches[0];

        return [
            'start_time' => $time[1],
            'end_time'   => $time[2]
        ];
    }

    private static function textMatch($textString)
    {
        $text = rtrim($textString);
        $text = str_replace("\r\n", "\n", $text);

        return $text;
    }
}
