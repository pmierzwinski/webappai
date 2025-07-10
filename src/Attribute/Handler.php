<?php

namespace App\Attribute;

use Attribute;

#[Attribute]
class Handler
{
    public string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }
}