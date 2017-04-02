<?php

namespace Benlipp\SrtParser;

use Benlipp\SrtParser\Time;

class Caption
{

    public $startTime;
    public $endTime;
    public $text;

    public function __construct($startTime = null, $endTime = null, $text = null)
    {
        $this->startTime = Time::get($startTime);
        $this->endTime = Time::get($endTime);
        $this->text = $text;
    }

    /**
     * @param mixed $text
     * @return Caption
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Returns an array with snake_case formatted keys for Laravel
     * @return array
     */
    public function toArray()
    {
        return [
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'text' => $this->text
        ];
    }
}