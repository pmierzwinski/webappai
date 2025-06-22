<?php

namespace App\Interface;

interface AIConnection
{
    public function ask(string $prompt) : string;
}
