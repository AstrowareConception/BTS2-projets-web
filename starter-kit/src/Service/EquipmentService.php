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
        // Un client peut envoyer name[] : vérifier le type avant trim().
        $rawName = $input['name'] ?? null;
        if (!is_string($rawName)) {
            throw new InvalidArgumentException('Le nom doit être une chaîne.');
        }

        $name = trim($rawName);
        if ($name === '' || mb_strlen($name, 'UTF-8') > 150) {
            throw new InvalidArgumentException(
                'Nom obligatoire, 150 caractères maximum.'
            );
        }

        $rawStatus = $input['status'] ?? 'AVAILABLE';
        if (!is_string($rawStatus)) {
            throw new InvalidArgumentException('Le statut doit être une chaîne.');
        }

        $status = strtoupper(trim($rawStatus));
        if (!in_array($status, self::ALLOWED_STATUSES, true)) {
            throw new InvalidArgumentException('Le statut fourni est invalide.');
        }

        return $this->repository->create($name, $status);
    }
}
