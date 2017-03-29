<?php

use Benlipp\SrtParser\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{

    /**
     * Check for possible syntax errors
     */
    public function testSyntax()
    {
        $var = new Time();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    /**
     * @dataProvider timeProvider
     */
    public function testTimes($time, $expected)
    {
        $this->assertEquals(Time::get($time), $expected);
    }

    public function timeProvider()
    {
        return [
            ['00:00:00,000', 0],
            ['00:04:30,000', 270],
            ['01:20:30,999', 4830.999],
        ];
    }
}