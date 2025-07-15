<?php

namespace App\AI\Groq;

use App\AI\AIService;
use App\AI\Exceptions\ResponseFormatException;
use App\Utils\Api\Api;
use App\Utils\File\FileService;

class GroqAIService extends AIService
{
    private Api $api;

    const MODEL = "llama3-8b-8192";
    const GROQ_URL = "https://api.groq.com/v1/chat/completions";
    const GROQ_API_KEY = "your_groq_api_key_here";

    public function __construct()
    {
        parent::__construct();

        $this->api = new Api(self::GROQ_URL);
        $this->api->setHeaders([
            "Authorization: Bearer ".self::GROQ_API_KEY,
            "Content-Type: application/json"
        ]);
    }

    public function ask(string $prompt) : string
    {
        $this->api->setData($this->createDataForMessage($prompt));

        $jsonResponse = $this->api->call();

        FileService::log($jsonResponse);
        $responseData = json_decode($jsonResponse, true);

        return $this->ensureCorrectResponse($responseData);
    }

    private function createDataForMessage($message) : array
    {
        return [
            "model" => self::MODEL,
            "messages" => [
                [
                    "role" => "user",
                    "content" => $message
                ]
            ],
            "max_tokens" => 1000
        ];
    }

    private function ensureCorrectResponse($response) : string
    {
        if (isset($response['error'])) {
            throw new ResponseFormatException($response['error']['message']);
        }
        $message = $response["choices"][0]["message"]["content"];

        return str_replace("```","",$message);
    }
}
