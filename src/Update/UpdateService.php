<?php

namespace App\Update;

use App\AI\AIService;
use App\Update\Command\Invoker;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class UpdateService
{
    const APP_DIR = "/public/app";

    private string $indexBackup;

    private array $existingFiles;

    public function __construct(private AIService $aiService) {

    }

    public function updateProject()
    {
        $this->makeCopy();
        $commands = $this->askForCommands();

        $invoker = new Invoker($commands);
        $invoker->run();

        if(!$this->tryCompileIndex()){
            $this->rollback();
        }
    }

    private function makeCopy()
    {
        $this->indexBackup = $this->getIndexContent();
        $this->memorizeCurrentFiles();
    }

    private function askForCommands()
    {
        $response = $this->aiService->getBetterCode($this->getIndexContent());
        return $this->parseToCommands($response);
    }

    private function getIndexContent()
    {
        return file_get_contents(self::APP_DIR."/index.php");
    }

    private function parseToCommands(string $response)
    {
        return [];//todo
    }

    private function tryCompileIndex()
    {
        $indexPath = self::APP_DIR."/index.php";
        return shell_exec("php -l $indexPath") == "No syntax errors.";
    }

    private function rollback()
    {
        file_put_contents(self::APP_DIR."/index.php", $this->indexBackup);
        $this->deleteNewFiles();
    }

    private function memorizeCurrentFiles()
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::APP_DIR, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $this->existingFiles[] = $file->getName();
            }
        }
    }

    private function deleteNewFiles()
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::APP_DIR, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && !isset($this->existingFiles[$file->getPathame()])) {
                //todo delete
            }
        }
    }
}
