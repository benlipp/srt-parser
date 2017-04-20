SRT Parser
=
[![Build Status](https://travis-ci.org/benlipp/srt-parser.svg?branch=master)](https://travis-ci.org/benlipp/srt-parser)

A PHP library to parse SRT files.  
Built by Ben Lippincott for [LiveTech](http://www.liveteched.com/)

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
or
````
$parser = new Parser();

$parser->loadString($formatted_caption_input);

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
A caption can be returned as an array instead of an object, if you prefer. The array is `snake_case` for compatibility with Laravel's attributes.
````
foreach($captions as $caption){
    $caption = $caption->toArray();
    echo "Start Time: " . $caption['start_time'];
    echo "End Time: " . $caption['end_time'];
    echo "Text: " . $caption['text'];
}
````
For Laravel usage with a model:
````
$url = "https://youtu.be/dQw4w9WgXcQ";
$video = new Video($url);
foreach ($captions as $caption) {
    $data = new VideoMetadata($caption->toArray());
    $video->videoMetadata()->save($data);
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
