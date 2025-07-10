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

    public static $environment = self::PROD;

    const CACHE_ATTRIBUTES = __DIR__ . '/cache/attributes.php';

    private static array $attributeCache = [];

    public static function getClassesWithAttribute(string $attribute): array
    {
        return self::$attributeCache[$attribute];
    }

    public function run($env = self::PROD): void
    {
        self::$environment = $env;
        $this->warmupCache();

        $this->handelRequest();
    }

    private function warmupCache() : void
    {
        if (!file_exists(self::CACHE_ATTRIBUTES) || self::$environment != self::PROD) {
            $this->importAttributes();
        } else {
            self::$attributeCache = include self::CACHE_ATTRIBUTES;
        }
    }

    /**
     * @return void
     */
    private function importAttributes() : void
    {
        $this->importAll();
        $this->mapAttributeClasses();
        $this->saveToCache();
    }

    /**
     * @return void
     */
    private function importAll() : void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(__DIR__, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                include_once $file->getPathname();
            }
        }
    }

    private function mapAttributeClasses(): void
    {
        foreach (get_declared_classes() as $className) {
            if (str_starts_with($className, 'App\\')) {
                $reflector = new \ReflectionClass($className);
                $attributes = $reflector->getAttributes();
                if (!empty($attributes)) {
                    foreach ($attributes as $attr) {
                        $attrName = $attr->getName();
                        self::$attributeCache[$attrName][] = $className;
                    }
                }
            }
        }
    }

    private function saveToCache() : void
    {
        $cacheDir = __DIR__ . '/cache';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, recursive: true);
        }

        file_put_contents(
            self::CACHE_ATTRIBUTES,
            '<?php return ' . var_export(self::$attributeCache, true) . ';'
        );
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