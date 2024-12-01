<?php

interface AIConnection
{
    public function ask(string $prompt) : string;
}