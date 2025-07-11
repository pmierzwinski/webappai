<?php

namespace App\Update\Command;

class Invoker
{
    /** @param CommandInterface[] $commands */
    public function __construct(
        private array $commands
    ) { }

    public function run()
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}