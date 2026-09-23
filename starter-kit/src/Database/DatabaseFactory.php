<?php

declare(strict_types=1);

namespace App\Database;

use Medoo\Medoo;

final class DatabaseFactory
{
    public static function create(array $config): Medoo
    {
        return new Medoo([
            'type' => $config['type'],
            'host' => $config['host'],
            'port' => $config['port'],
            'database' => $config['database'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset' => $config['charset'],
        ]);
    }
}
