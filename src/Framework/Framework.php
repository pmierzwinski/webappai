<?php

namespace App\Framework;

use App\Framework\Exception\NoRuteException;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Framework
{
    const PROD = 'prod';
    const DEV = 'dev';

    public static $environment;
    public static $projectDir;


    private static array $attributeCache = [];

    public static function getClassesByAttribute(string $attribute): array
    {
        return self::$attributeCache[$attribute];
    }

    public function createAplication(string $env = self::PROD, string $projectDir = __DIR__)
    {
        self::$environment = $env;
        self::$projectDir = $projectDir;

        $this->boot();
        $this->run();
    }

    private function run(): void
    {
        $this->handelRequest();
    }

    private function boot() {
        $this->warmup();
    }

    private function warmup() : void
    {
        $initiator = new Initiator(self::$projectDir);
        $initiator->init(self::$environment != self::PROD);
        self::$attributeCache = $initiator->getAttributeCache();
    }


    private function handelRequest()
    {
        $handlersProvider = new HandlersProvider();
        try {
            $handler = $handlersProvider->getHandlerOf($_SERVER['REQUEST_URI']);
            $handler->handle();
        } catch (NoRuteException $e) {
            http_response_code(404);
            echo "404 Not Found: " . $e->getMessage();
        }

    }
}