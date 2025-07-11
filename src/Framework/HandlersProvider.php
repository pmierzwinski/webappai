<?php

namespace App\Framework;

use App\Framework\Attribute\Handler;
use App\Framework\Exception\NoRuteException;
use App\Route\Interfaces\HandlerInterface;
use ReflectionClass;

class HandlersProvider
{
    /**
     * @var HandlerInterface[] $handlers
     */
    private array $handlers = [];

    public function __construct() {
        $this->loadHandlers();
    }

    public function getHandlerOf(string $requestUri)
    {
        $path = parse_url($requestUri, PHP_URL_PATH);
        if (isset($this->handlers[$path])) {
            return $this->handlers[$path];
        }

        throw new NoRuteException("No handler found for path: $path");
    }

    private function loadHandlers()
    {
        $handlers = Framework::getClassesByAttribute(Handler::class);
        foreach ($handlers as $handlerClass) {
            $reflector = new ReflectionClass($handlerClass);
            $attributes = $reflector->getAttributes(Handler::class);
            $attribute = $attributes[0]->newInstance();
            $this->handlers[$attribute->path] = new $handlerClass();
        }
    }
}