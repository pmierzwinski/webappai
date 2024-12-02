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

    function ask(string $prompt) : string
    {
        $this->api->setData($this->createDataForMessage($prompt));

        return $this->api->call();
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


    public function getBetterCodeThan(string $oldCode) : string
    {
        $prompt = $this->promptFactory->newCodeForOldCode($oldCode);
        $response = $this->connection->ask($prompt);
        $responseData = json_decode($response, true);

        if (isset($responseData['choices'][0]['message']['content'])) {
            return $responseData['choices'][0]['message']['content'];
        } else {
            throw new Exception("Błąd: Brak odpowiedzi od API.");
        }
    }
}