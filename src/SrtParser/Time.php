<?php

namespace Benlipp\SrtParser;


class Time
{

    public static function get($time)
    {
        if (isset($time)) {
            $parsed = self::parseTime($time);

            return self::formatTime($parsed);
        }

        return null;
    }

    /**
     * Get the formatted time.
     * @param $times
     * @return float
     */
    private static function formatTime($times)
    {
        $seconds = 0;
        $seconds += $times['hours'] * 3600;
        $seconds += $times['minutes'] * 60;
        $seconds += $times['seconds'];
        $milliseconds = $times['milliseconds'] / 1000;

        return $seconds + $milliseconds;
    }

    private static function parseTime($time)
    {
        $time = explode(',', $time, 2);
        $milliseconds = $time[1];
        $splitTime = explode(':', $time[0], 3);

        $times = [];
        $times['hours'] = (int)$splitTime[0];
        $times['minutes'] = (int)$splitTime[1];
        $times['seconds'] = (int)$splitTime[2];
        $times['milliseconds'] = (int)$milliseconds;

        return $times;
    }
}