<?php

declare(strict_types=1);

namespace App\Http;

use JsonException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Lecture stricte du contrat JSON : Content-Type, syntaxe et structure.
 * Suit les trois étapes du cours REST : 415 -> 400 -> validation métier 422.
 */
final class JsonInput
{
    public static function readObject(ServerRequestInterface $request): array
    {
        $contentType = strtolower(trim(explode(';', $request->getHeaderLine('Content-Type'))[0]));

        if ($contentType !== 'application/json') {
            throw new HttpInputException(
                415,
                'Content-Type application/json attendu.'
            );
        }

        try {
            $decoded = json_decode(
                (string) $request->getBody(),
                false,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw new HttpInputException(400, 'JSON mal formé.');
        }

        if (!is_object($decoded)) {
            throw new HttpInputException(400, 'Un objet JSON est attendu.');
        }

        return get_object_vars($decoded);
    }
}
