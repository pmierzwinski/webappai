<?php

namespace App\Handlers;

use App\Framework\Attribute\Handler;
use App\Route\Interfaces\HandlerInterface;

#[Handler('/test')]
class SomeHandler implements HandlerInterface
{
    public function handle() : void
    {
        echo "Some";
    }
}