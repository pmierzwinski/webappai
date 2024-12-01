<?php

interface AIService
{
    function getBetterCodeThan(string $oldCode) : string;
}