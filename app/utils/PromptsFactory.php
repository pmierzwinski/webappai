<?php

class PromptsFactory
{
    private PromptBuilder $builder;

    public function __construct() {
        $this->builder = new PromptBuilder();
    }

    public function newCodeForOldCode(string $oldCode) : string
    {
        return $this->builder->newCodeForOldCode($oldCode)->build();
    }

    public function betterCodeThan(string $oldCode) : string
    {
        return $this->builder->betterCodeThan(PHP_WITH_ONE_HTML_FILE.$oldCode)->build();
    }

    public function getCssForPhpCode(string $oldCode) : string
    {
        return $this->builder->getCssForPhpCode(SCC_FOR_PHP.$oldCode)->build();
    }

    public function getJsForPhpCode(string $oldCode) : string
    {
        return $this->builder->getJsForPhpCode(SCC_FOR_PHP.$oldCode)->build();
    }
}