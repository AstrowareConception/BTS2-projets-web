<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\EquipmentRepository;
use InvalidArgumentException;

final class EquipmentService
{
    private const ALLOWED_STATUSES = [
        'AVAILABLE',
        'MAINTENANCE',
        'UNAVAILABLE',
    ];

    public function __construct(private EquipmentRepository $repository)
    {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): ?array
    {
        return $this->repository->find($id);
    }

    public function create(array $input): array
    {
        $name = trim((string) ($input['name'] ?? ''));
        $status = strtoupper(trim((string) ($input['status'] ?? 'AVAILABLE')));

        if ($name === '') {
            throw new InvalidArgumentException('Le nom est obligatoire.');
        }

        if (!in_array($status, self::ALLOWED_STATUSES, true)) {
            throw new InvalidArgumentException('Le statut fourni est invalide.');
        }

        return $this->repository->create($name, $status);
    }
}
