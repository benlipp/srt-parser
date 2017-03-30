SRT Parser
=
[![Build Status](https://travis-ci.org/benlipp/srt-parser.svg?branch=master)](https://travis-ci.org/benlipp/srt-parser)

A PHP library to parse SRT files.

Installation / Requirements
-
Run 
`composer require "benlipp/srt-parser"`
and let Composer do the work.

PHP 7+ is **REQUIRED**! This isn't amateur hour.  

Usage
-
Import the `Parser` class: `use Benlipp\SrtParser\Parser;`

Use it:
````
$parser = new Parser();
$parser->loadFile('/path/to/srtfile.srt');
$captions = $parser->parse();
````
`parse()` returns an array of captions. Use them like so:

````
foreach($captions as $caption){
    echo "Start Time: " . $caption->startTime;
    echo "End Time: " . $caption->endTime;
    echo "Text: " . $caption->text;
}
````
You can also chain the `parse()` method:
````
$parser = new Parser();
$captions = $parser->loadFile($srtPath)->parse();
````

Contributing
-
Run PHPUnit on your changes, pretty please. If you add a new feature, add tests for that feature.
