<?php

namespace App\Framework\Exception;

class NoRuteException extends \RuntimeException
{
    public function __construct(string $message = "No route found for the given request", int $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}