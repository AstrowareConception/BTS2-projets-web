<?php

declare(strict_types=1);

namespace App\Http;

use RuntimeException;

/**
 * Erreur HTTP attendue lors de la lecture d'une requête externe.
 * Ne pas confondre avec une erreur de base de données ou de configuration.
 */
final class HttpInputException extends RuntimeException
{
    public function __construct(
        public readonly int $status,
        string $message
    ) {
        parent::__construct($message);
    }
}
