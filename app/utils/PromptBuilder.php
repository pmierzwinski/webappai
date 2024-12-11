<?php

class PromptBuilder
{
    private $prompt = "";

    private $codeLanguage = "";

    public function __construct() {

    }

    public function withCodeLanguage(string $language) : PromptBuilder
    {
        $this->codeLanguage = $language;
        return $this;
    }

    public function newCodeForOldCode(string $oldCode) : PromptBuilder
    {
        $this->prompt = NEW_CODE_FOR_OLD_CODE_PROMPT.$oldCode;
        return $this;
    }

    public function betterCodeThan(string $oldCode) : PromptBuilder
    {
        $this->prompt =  PHP_WITH_ONE_HTML_FILE.$oldCode;
        return $this;
    }

    public function getCssForPhpCode(string $oldCode) : PromptBuilder
    {
        $this->prompt = SCC_FOR_PHP.$oldCode;
        return $this;
    }

    public function getJsForPhpCode(string $oldCode) : PromptBuilder
    {
        $this->prompt =  JS_FOR_PHP.$oldCode;
        return $this;
    }

    public function build()
    {
        return $this->prompt;
    }
}