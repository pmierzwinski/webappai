<?php

namespace App\Update\Command;

class CommandFactory
{
    const COMMANDS_SEPARATOR = "@@@";
    const DATA_SEPARATOR = "%%%";

    public function parseToCommands($response) {
        $commands = [];
        $commandsData = explode(self::COMMANDS_SEPARATOR, $response);
        unset($commandsData[0]);//todo do it in ai implementations

        foreach ($commandsData as $contentData) {
            $commandData = explode(self::DATA_SEPARATOR, $contentData);

            $type = $commandData[0];
            $fileName = $commandData[1];
            $fileContent = $commandData[2];

            $commands[] = $this->createCommand($this, $type, $fileName, $fileContent);
        }

        return $commands;
    }

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