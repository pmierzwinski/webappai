<?php

class PromptsFactory
{
    public function newCodeForOldCode(string $oldCode) : string
    {
        return NEW_CODE_FOR_OLD_CODE_PROMPT.$oldCode;
    }

    public function getPhpContainingOnaHtmlFile(string $oldCode) : string
    {
        return PHP_WITH_ONE_HTML_FILE.$oldCode;
    }

    public function getCssForPhpCode(string $oldCode) : string
    {
        return SCC_FOR_PHP.$oldCode;
    }

    public function getJsForPhpCode(string $oldCode) : string
    {
        return JS_FOR_PHP.$oldCode;
    }
}