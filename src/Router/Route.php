<?php

namespace App\Router;

class Route
{
    private array $handlers;
    private array $middlewares = [];
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get(string $path, $handler, $middleware = null): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler, $middleware);
    }

    public function post($path, $handler, $middleware = null): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler, $middleware);
    }

    private function addHandler($method, $path, $handler, $middleware = null): void
    {
        $this->handlers[$method][$path] = $handler;
        if ($middleware) {
            $this->middlewares[$method][$path] = $middleware;
        }
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    public function run()
    {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        $middleware = null;

        if (isset($this->handlers[$method])) {
            foreach ($this->handlers[$method] as $handlerPath => $handler) {
                $regex = '#^' . $handlerPath . '$#';
                if (preg_match($regex, $requestPath, $matches)) {
                    $callback = $handler;
                    $middleware = $this->middlewares[$method][$handlerPath] ?? null;
                    array_shift($matches); // Remove the full match
                    break;
                }
            }
        }

        if (!$callback) {
            header("HTTP/1.0 404 Not found");
            if (!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }

        if (is_string($callback)) {
            $parts = explode('::', $callback);
            if (count($parts) === 2) {
                $className = $parts[0];
                $methodName = $parts[1];
                $handler = new $className();

                $callback = [$handler, $methodName];
            } else {
                throw new \InvalidArgumentException('Invalid callback format');
            }
        }

        if ($middleware) {
            $middlewareInstance = new $middleware();
            $middlewareInstance->handle($callback, ...$matches);
        } else {
            call_user_func_array($callback, $matches ?? []);
        }
    }
}
