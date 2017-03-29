<?php

use Benlipp\SrtParser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{

    /**
     * Check for possible syntax errors
     */
    public function testSyntax()
    {
        $var = new Parser();
        $this->assertTrue(is_object($var));
        unset($var);
    }
}