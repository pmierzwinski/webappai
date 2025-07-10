<?php

namespace App;

abstract class Provider
{
    public function checkClasses() : void
    {
        foreach ($this->getClasses() as $classes) {
            if(!class_exists($classes)) {
                throw new \Exception("Class $classes does not exist.");
            };
        }
    }

    protected abstract function getClasses() : array;
}