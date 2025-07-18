<?php

namespace App\Utils\File;

class FileService
{
    const PUBLIC_FOLDER_PATH = __DIR__.'/../../public';
    const INDEX_PATH = self::PUBLIC_FOLDER_PATH.'/index.php';
    const CSS_PATH = self::PUBLIC_FOLDER_PATH.'/css/style.css';
    const JS_PATH = self::PUBLIC_FOLDER_PATH.'/js/script.js';
    const LOG_PATH = self::PUBLIC_FOLDER_PATH.'/log.txt';

    public static function getLogContent() : string
    {
        return self::getFileContent(self::LOG_PATH);
    }
    public static function getIndexContent() : string
    {
        return self::getFileContent(self::INDEX_PATH);
    }

    public static function log(string $content) : void
    {
        self::setFileContent(self::LOG_PATH, FileService::getLogContent()."\n\n-----------\n\n".$content);
    }

    public static function setCssContent(string $content) : void
    {
        self::setFileContent(self::CSS_PATH, $content);
    }

    public static function setJsContent(string $content) : void
    {
        self::setFileContent(self::JS_PATH, $content);
    }

    public static function setIndexContent(string $content) : void
    {
        self::setFileContent(self::INDEX_PATH, $content);
    }

    public static function setFileContent(string $filePath, string $newContent) : void
    {
        if (file_put_contents($filePath, $newContent) === false) {
            throw new FileContentException('Error writing to file: '.$filePath);
        }
    }

    private static function getFileContent(string $filePath) : string
    {
        $fileContent = file_get_contents($filePath);
        if ($fileContent === false) {
            throw new FileContentException('File not found or could not be read: '.$filePath);
        }
        return $fileContent;
    }
}
