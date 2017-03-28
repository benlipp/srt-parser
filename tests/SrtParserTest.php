<?php

use Benlipp\SrtParser;
use PHPUnit\Framework\TestCase;

class SrtParserTest extends TestCase
{

    /**
     * Check for possible syntax errors
     */
    public function testAnySyntaxError()
    {
        $var = new SrtParser();
        $this->assertTrue(is_object($var));
        unset($var);
    }
}