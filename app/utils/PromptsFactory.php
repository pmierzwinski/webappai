<?php

class PromptsFactory
{
    public function newCodeForOldCode(string $oldCode) : string
    {
        return NEW_CODE_FOR_OLD_CODE_PROMPT.$oldCode;
    }
}