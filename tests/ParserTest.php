<?php

use Benlipp\SrtParser\Exceptions\FileNotFoundException;
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

    public function testFileNotFound()
    {
        $parser = new Parser();
        $this->expectException(FileNotFoundException::class);
        $result = $parser->loadFile('NotARealFile');
        $this->assertFalse(is_object($result));
    }

    public function testReadFile()
    {
        $parser = new Parser();
        $result = $parser->loadFile(__DIR__ . '/files/SampleCaptions.srt');
        $this->assertTrue(is_object($result));
    }

    public function testLoadString()
    {
        $captionString = file_get_contents(__DIR__ . '/files/SampleCaptions.srt');
        $parser = new Parser();
        $result = $parser->loadString($captionString);
        $this->assertTrue(is_object($result));
    }


    public function testParse()
    {
        $testData = $this->captionData();
        $parser = new Parser();
        $parser->loadFile(__DIR__ . '/files/SampleCaptions.srt');
        $captions = $parser->parse();
        foreach ($captions as $key => $caption) {
            $this->assertEquals($testData[$key]['startTime'], $caption->startTime);
            $this->assertEquals($testData[$key]['endTime'], $caption->endTime);
            $this->assertEquals($testData[$key]['text'], $caption->text);
        }
    }

    public function captionData()
    {
        return [
            [
                'startTime' => 0,
                'endTime'   => 3,
                'text'      => "Type Caption Text HereCar is backing up a little bit"
            ],
            [
                'startTime' => 3,
                'endTime'   => 4,
                'text'      => "Yep there it goes"
            ],
            [
                'startTime' => 4,
                'endTime'   => 5,
                'text'      => "Don't hit it!\nTesting Multi"
            ],

        ];
    }
}