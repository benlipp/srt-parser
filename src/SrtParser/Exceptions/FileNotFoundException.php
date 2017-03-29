<?php

namespace Benlipp\SrtParser\Exceptions;


use Throwable;

class FileNotFoundException extends \Exception
{

    public function __construct($file_location)
    {
        $message = "Could not find file: " . $file_location;
        parent::__construct($message);
    }
}