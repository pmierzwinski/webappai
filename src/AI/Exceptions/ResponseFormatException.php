<?php

namespace App\AI\Exceptions;

use Exception;

class ResponseFormatException extends Exception
{
    /**
     * Constructs a new ResponseFormatException.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = "Invalid response format.", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
