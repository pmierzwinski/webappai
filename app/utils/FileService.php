<?php

class FileService
{
    const PUBLIC_FOLDER_PATH = __DIR__.'/../../public';
    const INDEX_PATH = self::PUBLIC_FOLDER_PATH.'/index.php';

    public static function getIndexContent() : string
    {
        return self::getFileContent(self::INDEX_PATH);
    }

    public static function setIndexContent(string $content) : void
    {
        self::setFileContent(self::INDEX_PATH, $content);
    }

    public static function setFileContent(string $filePath, string $newContent) : void
    {
        if (file_put_contents($filePath, $newContent) === false) {
            throw new Exception('Nie udało się zapisać do pliku');
        }
    }

    private static function getFileContent(string $filePath) : string
    {
        $fileContent = file_get_contents($filePath);
        if ($fileContent === false) {
            throw new Exception('Nie udało się odczytać pliku');
        }
        return $fileContent;
    }
}