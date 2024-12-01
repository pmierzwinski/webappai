<?php

class GptApi implements Api
{
    const GPT_URL = "https://api.openai.com/v1/chat/completions";
    const GPT_VERSION = "gpt-3.5-turbo";

    private array $headers;
    private array $data = [];

    public function setHeaders(array $headers) : void
    {
        $this->headers = $headers;
    }

    public function setData(array $data) : void
    {
        $this->data = $data;
    }

    public function call() : string
    {
        return Curl::call(self::GPT_URL, $this->headers, $this->data);
    }

}