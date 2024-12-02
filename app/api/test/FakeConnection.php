<?php

class FakeConnection implements AIConnection
{
    public function ask(string $prompt) : string
    {
        return "test";
    }
}