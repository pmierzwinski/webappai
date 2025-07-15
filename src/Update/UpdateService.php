<?php

namespace App\Update;

use App\AI\AIService;
use App\Framework\Framework;
use App\Update\Command\CommandFactory;
use App\Update\Command\Invoker;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class UpdateService
{
    const COMMANDS_SEPARATOR = "@@@";
    const DATA_SEPARATOR = "%%%";
    const COMMAND_HASH = "##COMMAND:";
    const END_HASH = "##FILE_NAME:";
    const CONTENT_HASH = "##CONTENT:";

    private $appDir;

    private string $indexBackup;

    private array $existingFiles;
    private array $newFiles;

    public function __construct(
        private AIService $aiService
    ) {
        $this->appDir = Framework::$projectDir."/../public/app";
    }

    public function updateProject()
    {
        $this->makeCopy();
        $this->updateFiles();

//        if(!$this->tryCompileIndex()){
//            $this->rollback();
//        }
    }

    private function makeCopy()
    {
        $this->indexBackup = $this->getIndexContent();
        $this->memorizeCurrentFiles();
    }

    private function updateFiles() : void
    {
        $commands = $this->askForCommands();
        $invoker = new Invoker($commands);
        $invoker->run();
    }

    private function askForCommands()
    {
        $response = $this->aiService->getBetterCode($this->getIndexContent());

        return $this->parseToCommands($response);
    }

    private function parseToCommands(string $response)
    {
        $commands = [];
        $commandsData = explode(self::COMMANDS_SEPARATOR, $response);
        unset($commandsData[0]);

        $factory = new CommandFactory();

        foreach ($commandsData as $contentData) {
            $commandData = explode(self::DATA_SEPARATOR, $contentData);

            $type = $commandData[0];
            $fileName = $commandData[1];
            $fileContent = $commandData[2];

            $commands[] = $factory->createCommand($this, $type, $fileName, $fileContent);
        }

        return $commands;
    }

    private function tryCompileIndex()
    {
        $indexPath = $this->appDir."/index.php";
        $response = shell_exec("php -l index.php");//nie dziala

        var_dump($response);
        return $response;
    }

    private function rollback()
    {
        file_put_contents($this->appDir."/index.php", $this->indexBackup);
//        $this->deleteNewFiles();
    }

    private function memorizeCurrentFiles()
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->appDir, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $this->existingFiles[] = $file->getFileName();
            }
        }
    }

    private function deleteNewFiles()
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->appDir, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && !isset($this->existingFiles[$file->getPathame()])) {

            }
        }
    }

    private function getIndexContent()
    {
        return file_get_contents($this->appDir."/index.php");
    }

    public function createFile($fileName, $content)
    {
        file_put_contents($this->appDir."/".$fileName, $content);
//        $this->newFiles[] = $
    }

    public function updateFile($fileName, $content) {
        file_put_contents($this->appDir."/".$fileName, $content);
    }
}
