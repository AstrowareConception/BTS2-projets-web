<?php

declare(strict_types=1);

use App\Controller\EquipmentController;
use App\Http\JsonResponder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app, EquipmentController $controller): void {
    $app->group('/api', function (RouteCollectorProxy $group) use ($controller): void {
        $group->get('/health', function (
            Request $request,
            Response $response
        ): Response {
            return JsonResponder::respond($response, [
                'status' => 'ok',
                'service' => 'bts2-web-starter',
            ]);
        });

        $group->get('/equipment', [$controller, 'apiIndex']);
        $group->get('/equipment/{id:[0-9]+}', [$controller, 'apiShow']);
        $group->post('/equipment', [$controller, 'apiCreate']);
    });
};
