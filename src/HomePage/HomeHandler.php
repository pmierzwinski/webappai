<?php

namespace App\HomePage;

use App\Framework\Attribute\Handler;
use App\Route\Interfaces\HandlerInterface;

#[Handler('/')]
class HomeHandler implements HandlerInterface
{
    public function handle(): void
    {

        echo(file_get_contents(__DIR__.'/index.html'));

    }
}