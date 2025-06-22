<?php

namespace App\Utils\File;

use Exception;


class FileContentException extends Exception
{
    public function __construct($message = "File content error", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
