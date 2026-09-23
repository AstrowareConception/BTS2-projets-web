<?php

declare(strict_types=1);

$bool = static function (string $name, bool $default = false): bool {
    $value = $_ENV[$name] ?? null;

    if ($value === null) {
        return $default;
    }

    return filter_var($value, FILTER_VALIDATE_BOOL);
};

return [
    'app' => [
        'env' => $_ENV['APP_ENV'] ?? 'prod',
        'debug' => $bool('APP_DEBUG', false),
    ],
    'database' => [
        'type' => $_ENV['DB_TYPE'] ?? 'mysql',
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'port' => (int) ($_ENV['DB_PORT'] ?? 3306),
        'database' => $_ENV['DB_NAME'] ?? 'bts_web',
        'username' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
    ],
];
