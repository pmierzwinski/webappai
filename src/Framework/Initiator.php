<?php

namespace App\Framework;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Initiator
{
    const CACHE_ATTRIBUTES = __DIR__ . '/cache/attributes.php';

    private array $attributeCache;

    public function __construct(
        private $projectDir
    ) {

    }

    public function init(bool $force = false){
        if (!file_exists(self::CACHE_ATTRIBUTES) || $force) {
            $this->mapClasses();
        } else {
            $this->attributeCache = include self::CACHE_ATTRIBUTES;
        }
    }

    /**
     * @return void
     */
    private function mapClasses() : void
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
            new RecursiveDirectoryIterator($this->projectDir, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {

                $contents = file_get_contents($file->getPathname());
                $tokens = token_get_all($contents);
                $tokenFile = false;

                foreach ($tokens as $token) {
                    if(is_array($token) && $token[0] === T_ATTRIBUTE){
                        $tokenFile = true;
                        break;
                    }
                }

                if($tokenFile){
                    include_once $file->getPathname();
                }
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
                        $this->attributeCache[$attrName][] = $className;
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
            '<?php return ' . var_export($this->attributeCache, true) . ';'
        );
    }

    public function getAttributeCache() : array
    {
        return $this->attributeCache;
    }
}