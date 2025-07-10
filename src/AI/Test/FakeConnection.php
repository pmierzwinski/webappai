<?php

namespace App\AI\Test;

use App\Interface\AIConnection;

class FakeConnection implements AIConnection
{
    public function ask(string $prompt) : string
    {
        return "test";
    }
}
