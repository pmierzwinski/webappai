<?php

class GroqConnection implements AIConnection
{
    private IApi $api;

    const MODEL = "llama3-8b-8192";

    public function __construct()
    {
        $this->api = new Api(GROQ_URL);
        $this->api->setHeaders([
            "Authorization: Bearer ".GROQ_API_KEY,  // Dodaj nagłówek autoryzacji, jeśli jest wymagany
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
            throw new Exception($response['error']['message']);
        }
        $message = $response["choices"][0]["message"]["content"];

        return str_replace("```","",$message);
    }
}