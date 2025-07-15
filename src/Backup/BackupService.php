<?php

namespace App\Backup;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class BackupService
{

    private string $indexBackup;

    private array $existingFiles;

    public function __construct(string $appDir) {
        $this->appDir = $appDir;
    }

    public function makeCopy()
    {
        $this->indexBackup = $this->getIndexContent();
        $this->memorizeCurrentFiles();
    }

    public function rollback()
    {
        file_put_contents($this->appDir."/index.php", $this->indexBackup);
        $this->deleteNewFiles();
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
//        $iterator = new RecursiveIteratorIterator(
//            new RecursiveDirectoryIterator($this->appDir, FilesystemIterator::SKIP_DOTS)
//        );
//        foreach ($iterator as $file) {
//            if ($file->isFile() && !isset($this->existingFiles[$file->getPathame()])) {
//
//            }
//        }
    }


    private function getIndexContent()
    {
        return file_get_contents($this->appDir."/index.php");
    }
}