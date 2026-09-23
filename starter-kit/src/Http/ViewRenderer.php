<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;

final class ViewRenderer
{
    public function __construct(private string $basePath)
    {
    }

    public function render(
        ResponseInterface $response,
        string $template,
        array $data = [],
        int $status = 200
    ): ResponseInterface {
        $file = $this->basePath . '/' . $template . '.php';

        if (!is_file($file)) {
            throw new RuntimeException('Vue introuvable : ' . $template);
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $file;
        $html = (string) ob_get_clean();

        $response->getBody()->write($html);

        return $response
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withStatus($status);
    }
}
