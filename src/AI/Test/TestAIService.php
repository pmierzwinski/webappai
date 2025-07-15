<?php

namespace App\AI\Test;

use App\AI\AIService;

class TestAIService extends AIService
{
    private $response = '';

    public function ask(string $prompt) : string
    {
        return $this->response;
    }

    public function mockResponse($response)
    {
        $this->response = $response;
    }
}
