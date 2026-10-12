<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

abstract class Controller
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected function render(string $view, array $data = [], string $layout = 'main'): void
    {
        $content = $this->renderView($view, $data);
        $layoutFile = APP_PATH . '/Views/layouts/' . $layout . '.php';

        if (file_exists($layoutFile)) {
            extract($data);
            ob_start();
            require $layoutFile;
            $output = ob_get_clean();
            $this->response->setContent($output)->send();
        } else {
            $this->response->setContent($content)->send();
        }
    }

    protected function renderView(string $view, array $data = []): string
    {
        $viewFile = APP_PATH . '/Views/' . str_replace('.', '/', $view) . '.php';
        if (!file_exists($viewFile)) {
            throw new RuntimeException("View file '$viewFile' not found.");
        }
        extract($data);
        ob_start();
        require $viewFile;
        return (string)ob_get_clean();
    }

    protected function json(array $data, int $status = 200): void
    {
        $this->response->json($data, $status)->send();
    }

    protected function redirect(string $url, int $status = 302): void
    {
        $this->response->redirect($url, $status);
    }
}