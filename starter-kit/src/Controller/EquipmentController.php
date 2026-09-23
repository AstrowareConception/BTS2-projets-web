<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\JsonResponder;
use App\Http\ViewRenderer;
use App\Service\EquipmentService;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class EquipmentController
{
    public function __construct(
        private EquipmentService $service,
        private ViewRenderer $renderer
    ) {
    }

    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $this->renderer->render($response, 'home', [
            'equipment' => $this->service->list(),
            'error' => null,
        ]);
    }

    public function webCreate(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $data = $request->getParsedBody();
        $data = is_array($data) ? $data : [];

        try {
            $this->service->create($data);
        } catch (InvalidArgumentException $exception) {
            return $this->renderer->render($response, 'home', [
                'equipment' => $this->service->list(),
                'error' => $exception->getMessage(),
            ], 422);
        }

        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }

    public function apiIndex(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return JsonResponder::respond($response, [
            'data' => $this->service->list(),
        ]);
    }

    public function apiShow(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $equipment = $this->service->get((int) ($args['id'] ?? 0));

        if ($equipment === null) {
            return JsonResponder::respond($response, [
                'error' => 'EQUIPMENT_NOT_FOUND',
                'message' => 'Équipement introuvable.',
            ], 404);
        }

        return JsonResponder::respond($response, ['data' => $equipment]);
    }

    public function apiCreate(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $data = $request->getParsedBody();
        $data = is_array($data) ? $data : [];

        try {
            $equipment = $this->service->create($data);
        } catch (InvalidArgumentException $exception) {
            return JsonResponder::respond($response, [
                'error' => 'VALIDATION_ERROR',
                'message' => $exception->getMessage(),
            ], 422);
        }

        return JsonResponder::respond($response, [
            'data' => $equipment,
        ], 201);
    }
}
