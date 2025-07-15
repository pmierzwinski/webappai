<?php

namespace App\Update\Command;

class CommandFactory
{
    public function createCommand($app, $type, $filename, $content)
    {
        switch ($type) {
            case "CREATE":
                return new CreateCommand($app, $filename, $content);
            case "UPDATE":
                return new UpdateCommand($app, $filename, $content);
            default:
                throw new \Exception("Unknown command type ".$type);
        }
    }
}