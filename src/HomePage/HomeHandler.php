<?php

namespace App\HomePage;

use App\Framework\Attribute\Handler;
use App\Route\Interfaces\HandlerInterface;

#[Handler('/')]
class HomeHandler implements HandlerInterface
{
    const TEMPLATE_FILE = __DIR__.'/index.html';
    public function handle(): void
    {
        echo(file_get_contents(self::TEMPLATE_FILE));
    }
}