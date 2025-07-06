<?php

namespace App\Utils\File\Curl;

use Exception;

class CurlException extends Exception
{
    /**
     * CurlException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "Curl error occurred", $code = 0)
    {
        parent::__construct($message, $code);
    }
}