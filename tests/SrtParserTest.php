<?php

use Benlipp\SrtParser\Parser;
use PHPUnit\Framework\TestCase;

class SrtParserTest extends TestCase
{

    /**
     * Check for possible syntax errors
     */
    public function testAnySyntaxError()
    {
        $var = new Parser();
        $this->assertTrue(is_object($var));
        unset($var);
    }
}