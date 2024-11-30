<?php

class GptMock implements GptApi
{
    function getNewCode(string $oldCode) : string
    {
        return substr($oldCode, 0, -2) . 'echo("'.(string)rand().'");' . ' ?>';
    }
}