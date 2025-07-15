<?php

namespace App\AI\Gpt;

use App\AI\AIService;
use App\AI\Exceptions\ResponseFormatException;
use App\Utils\Api\Api;

class GptConnection extends AIService
{
    private Api $api;

    const GPT_URL = "https://api.openai.com/v1/chat/completions";
    const GPT_API_KEY = "xxx";
    const GPT_VERSION = "gpt-3.5-turbo";

    public function __construct()
    {
        parent::__construct();

        $this->api = new Api(self::GPT_URL);
        $this->api->setHeaders([
            "Authorization: Bearer ".self::GPT_API_KEY,
            "Content-Type: application/json"
        ]);
    }

    public function ask(string $prompt) : string
    {
        $this->api->setData($this->createDataForMessage($prompt));

        $jsonResponse = $this->api->call();
        $responseData = json_decode($jsonResponse, true);

        return $this->ensureCorrectResponse($responseData);
    }

    private function createDataForMessage($message) : array
    {
        return [
            "model" => self::GPT_VERSION,
            "messages" => [
                [
                    "role" => "user",
                    "content" => $message
                ]
            ],
            "max_tokens" => 100
        ];
    }

    private function ensureCorrectResponse($response) : string
    {
        if (isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        } else {
            throw new ResponseFormatException("Błąd: Brak odpowiedzi od API.");
        }
    }
}
