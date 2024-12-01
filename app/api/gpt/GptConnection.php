<?php

class GptConnection implements AIConnection
{
    private Api $api;

    const GPT_VERSION = "gpt-3.5-turbo";

    public function __construct(Api $api)
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
}