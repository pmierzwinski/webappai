<?php

namespace App\Prompt;

class PromptsFactory
{
    private PromptBuilder $builder;

    public function __construct() {
        $this->builder = new PromptBuilder();
    }

    public function createBetterCodePrompt(string $oldCode) : string
    {
        return $this->builder
            ->add(Prompts::REWRITE_CODE)
            ->add(Prompts::REDESIGN_CODE)
            ->add(Prompts::CODE_PREFIX.' '.$oldCode)
            ->build();
    }
}
