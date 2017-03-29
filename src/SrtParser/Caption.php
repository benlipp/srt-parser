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
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    function __set($name, $value)
    {
        switch ($name) {
            case 'startTime':
            case 'endTime':
                $value = Time::get($value);
                $this->$name = $value;
                break;
            default:
                if (property_exists($this, $name)) {
                    $this->$name = $value;
                }
                break;
        }
    }
}