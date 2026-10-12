<?php

declare(strict_types=1);

namespace App\Core;

use Exception;

class Router
{
    private Request $request;
    private Response $response;
    private array $routes = [];
    private string $groupPrefix = '';
    private array $groupMiddleware = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, array|callable $handler, array $middleware = []): void
    {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, array|callable $handler, array $middleware = []): void
    {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(string $path, array|callable $handler, array $middleware = []): void
    {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function delete(string $path, array|callable $handler, array $middleware = []): void
    {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    public function group(array $attributes, callable $callback): void
    {
        $prevPrefix = $this->groupPrefix;
        $prevMiddleware = $this->groupMiddleware;

        if (isset($attributes['prefix'])) {
            $this->groupPrefix = rtrim($prevPrefix . '/' . trim($attributes['prefix'], '/'), '/');
        }

        if (isset($attributes['middleware'])) {
            $middleware = is_array($attributes['middleware']) ? $attributes['middleware'] : [$attributes['middleware']];
            $this->groupMiddleware = array_merge($prevMiddleware, $middleware);
        }

        $callback($this);

        $this->groupPrefix = $prevPrefix;
        $this->groupMiddleware = $prevMiddleware;
    }

    private function addRoute(string $method, string $path, array|callable $handler, array $middleware = []): void
    {
        $fullPath = $this->groupPrefix . '/' . trim($path, '/');
        $fullPath = '/' . trim($fullPath, '/');
        $allMiddleware = array_merge($this->groupMiddleware, $middleware);

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $fullPath,
            'handler' => $handler,
            'middleware' => $allMiddleware,
        ];
    }

    public function dispatch(): void
    {
        $method = $this->request->getMethod();
        $matchMethod = $method === 'HEAD' ? 'GET' : $method;
        $path = $this->request->getPath();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $matchMethod) {
                continue;
            }

            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Execute Middleware Stack
                foreach ($route['middleware'] as $mwClass) {
                    $mw = new $mwClass();
                    if (!$mw->handle($this->request, $this->response)) {
                        return;
                    }
                }

                // Execute Handler
                $handler = $route['handler'];
                if (is_callable($handler)) {
                    call_user_func_array($handler, [$this->request, $this->response, $params]);
                    return;
                }

                if (is_array($handler) && count($handler) === 2) {
                    [$controllerClass, $action] = $handler;
                    if (!class_exists($controllerClass)) {
                        throw new Exception("Controller '$controllerClass' not found.");
                    }
                    $controller = new $controllerClass($this->request, $this->response);
                    if (!method_exists($controller, $action)) {
                        throw new Exception("Action '$action' not found in '$controllerClass'.");
                    }
                    $controller->$action($params);
                    return;
                }
            }
        }

        // 404 Not Found
        $this->response->setStatusCode(404);
        if ($this->request->isJson() || str_starts_with($path, '/api')) {
            $this->response->json(['error' => 'Endpoint not found', 'status' => 404])->send();
        } else {
            $this->response->setContent('<h1>404 - Page Not Found</h1>')->send();
        }
    }
}