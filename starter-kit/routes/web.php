<?php

declare(strict_types=1);

use App\Controller\EquipmentController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return static function (App $app, EquipmentController $controller): void {
    $app->get('/', [$controller, 'index']);

    $app->post('/equipment', [$controller, 'webCreate']);

    $app->get('/hello/{name}', function (
        Request $request,
        Response $response,
        array $args
    ): Response {
        $name = htmlspecialchars(
            (string) ($args['name'] ?? 'inconnu'),
            ENT_QUOTES,
            'UTF-8'
        );

        $response->getBody()->write(
            '<h1>Bonjour ' . $name . '</h1>'
            . '<p>Cette route montre un paramètre dynamique Slim.</p>'
        );

        return $response;
    });
};
