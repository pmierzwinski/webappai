<?php

namespace App\AI;

use App\Prompt\PromptsFactory;

abstract class AIService
{
    private PromptsFactory $promptFactory;

    public abstract function ask(string $prompt);

    public function __construct()
    {
        $this->promptFactory = new PromptsFactory();
    }

    public function getBetterCode(string $oldCode) : string
    {
        $prompt = $this->promptFactory->createBetterCodePrompt($oldCode);
        return $this->ask($prompt);
    }


}
