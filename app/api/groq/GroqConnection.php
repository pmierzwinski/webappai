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
            "max_tokens" => 100
        ];
    }

    private function ensureCorrectResponse($response) : string
    {
        //todo for groq
//        if (isset($response['choices'][0]['message']['content'])) {
//            return $response['choices'][0]['message']['content'];
//        } else {
//            throw new Exception("Błąd: Brak odpowiedzi od API.");
//        }
    }
}