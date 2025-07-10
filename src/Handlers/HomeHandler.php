<?php

namespace App\Handlers;

use App\Attribute\Handler;

#[Handler('/')]
class HomeHandler
{
    public function handle(): void
    {
        echo "Welcome to the Home Page!";
    }
}