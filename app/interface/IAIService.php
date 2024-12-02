<?php

interface IAIService
{
    function getBetterCodeThan(string $oldCode) : string;
}