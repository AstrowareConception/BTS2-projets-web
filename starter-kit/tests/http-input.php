<?php

declare(strict_types=1);

/**
 * Tests de contrat légers, sans SGBD :
 * composer test
 *
 * Ils sont volontairement simples pour illustrer "entrée -> règle -> résultat".
 * PHPUnit est une piste d'approfondissement, non un prérequis du starter.
 */
use App\Http\HttpInputException;
use App\Http\JsonInput;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\StreamFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

function request(string $type, string $body): \Psr\Http\Message\ServerRequestInterface
{
    return (new ServerRequestFactory())
        ->createServerRequest('POST', '/api/equipment')
        ->withHeader('Content-Type', $type)
        ->withBody((new StreamFactory())->createStream($body));
}

function expectHttpError(int $expected, string $type, string $body): void
{
    try {
        JsonInput::readObject(request($type, $body));
        throw new RuntimeException("Erreur HTTP $expected attendue, mais aucune exception levée.");
    } catch (HttpInputException $exception) {
        if ($exception->status !== $expected) {
            throw new RuntimeException(
                "Attendu HTTP $expected, obtenu HTTP {$exception->status}."
            );
        }
    }
}

$data = JsonInput::readObject(
    request('application/json; charset=utf-8', '{"name":"Oscilloscope"}')
);

if (($data['name'] ?? null) !== 'Oscilloscope') {
    throw new RuntimeException('Le JSON valide doit être décodé.');
}

expectHttpError(415, 'text/plain', '{"name":"A"}');
expectHttpError(400, 'application/json', '{"name":}');
expectHttpError(400, 'application/json', '[]');

echo "Contrat JsonInput : 4 scénarios verts.\n";
