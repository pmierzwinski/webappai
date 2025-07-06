<?php

namespace App\Api;

use App\Interface\IApi;
use App\Utils\File\Curl\Curl;

class Api implements IApi
{
    private string $url;

    private array $headers;

    private array $data = [];

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function setHeaders(array $headers) : void
    {
        $this->headers = $headers;
    }

    public function setData(array $headers) : void
    {
        $this->data = $headers;
    }

    public function call() : string
    {
        return Curl::call($this->url, $this->headers, $this->data);
    }
}
