<?php

namespace App\Handlers;

use App\Framework\Attribute\Handler;
use App\Route\Interfaces\HandlerInterface;

#[Handler('/app')]
class AppHandler implements HandlerInterface
{
    public function handle() : void
    {
        echo("Something went wrong with app :(");
    }
}