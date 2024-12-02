<?php

class GptConnection implements AIConnection
{
    private IApi $api;

    const GPT_VERSION = "gpt-3.5-turbo";

    public function __construct(IApi $api)
    {
        $this->api = $api;
        $this->api->setHeaders([
            "Authorization: Bearer ".SYSTEM_API_KEY,
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
                    "role" => "system",
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
            throw new Exception("Błąd: Brak odpowiedzi od API.");
        }
    }
}