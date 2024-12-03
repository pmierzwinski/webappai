<?php

class GroqConnection implements AIConnection
{
    private IApi $api;

    const GPT_VERSION = "gpt-3.5-turbo";

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
        $responseData = json_decode($jsonResponse, true);

        return $this->ensureCorrectResponse($responseData);
    }

}