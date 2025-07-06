<?php

namespace App\Utils\File;

class PromptBuilder
{
    private $prompt = "";

    private array $baseParts;

    public function __construct() {

        $this->baseParts = [
            Prompts::NO_SUMMARY,
            Prompts::CHARACTER_LIMIT,
        ];
    }

    public function add(string $promptPart)
    {
        $this->prompt .= " ".$promptPart;
        return $this;
    }

    public function build()
    {
        $basePart = implode(" ", $this->baseParts);
        $this->prompt = "";
        return $basePart." ".$this->prompt;
    }
}
