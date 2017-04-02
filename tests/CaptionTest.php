<?php

use Benlipp\SrtParser\Caption;
use Benlipp\SrtParser\Time;
use PHPUnit\Framework\TestCase;

class CaptionTest extends TestCase
{

    /**
     * Check possible syntax errors
     */
    public function testSyntax()
    {
        $var = new Caption();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    public function testFormatting()
    {
        $startTime = "00:00:00,000";
        $endTime = "00:00:05,000";
        $text = "Caption";

        $expectedStart = Time::get($startTime);
        $expectedEnd = Time::get($endTime);

        $caption = new Caption($startTime, $endTime, $text);
        $this->assertEquals($expectedStart, $caption->startTime);
        $this->assertEquals($expectedEnd, $caption->endTime);
        $this->assertEquals($text, $caption->text);
    }

    public function testToArray()
    {
        $startTime = "00:00:00,000";
        $endTime = "00:00:05,000";
        $text = "Caption";

        $expectedStart = Time::get($startTime);
        $expectedEnd = Time::get($endTime);

        $caption = new Caption($startTime, $endTime, $text);
        $captionArray = $caption->toArray();
        $this->assertTrue(is_array($captionArray));

        $expectedArray = [
            'start_time' => $expectedStart,
            'end_time' => $expectedEnd,
            'text' => $text
        ];
        $this->assertEquals($captionArray, $expectedArray);
    }

}
