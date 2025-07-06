<?php

namespace App\Interface;

interface IAIService
{
    function getBetterCodeThan(string $oldCode) : string;
}
