<?php

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

    public function setData(array $data) : void
    {
        $this->data = $data;
    }

    public function call() : string
    {
        return Curl::call($this->url, $this->headers, $this->data);
    }
}