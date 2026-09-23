<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;

final class JsonResponder
{
    public static function respond(
        ResponseInterface $response,
        mixed $data,
        int $status = 200
    ): ResponseInterface {
        $json = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES
            | JSON_THROW_ON_ERROR
        );

        $response->getBody()->write($json);

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus($status);
    }
}
