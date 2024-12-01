<?php

class PromptsFactory
{

    public function newCodeForOldCode(string $oldCode) : string
    {
        return SYSTEM_PROMPT."hello";
    }

}