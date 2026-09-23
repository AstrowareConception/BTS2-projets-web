<?php

declare(strict_types=1);

namespace App\Repository;

use Medoo\Medoo;

final class EquipmentRepository
{
    public function __construct(private Medoo $database)
    {
    }

    public function all(): array
    {
        return $this->database->select(
            'equipment',
            ['id', 'name', 'status', 'created_at'],
            ['ORDER' => ['id' => 'DESC']]
        );
    }

    public function find(int $id): ?array
    {
        $row = $this->database->get(
            'equipment',
            ['id', 'name', 'status', 'created_at'],
            ['id' => $id]
        );

        return is_array($row) ? $row : null;
    }

    public function create(string $name, string $status): array
    {
        $this->database->insert('equipment', [
            'name' => $name,
            'status' => $status,
        ]);

        $id = (int) $this->database->id();

        return $this->find($id) ?? [
            'id' => $id,
            'name' => $name,
            'status' => $status,
        ];
    }
}
