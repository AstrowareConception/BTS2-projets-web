<?php

declare(strict_types=1);

/**
 * Une variable peut venir du .env chargé par phpdotenv ou de l'environnement
 * réel du processus (CI, Docker, hébergement).
 * Ne jamais supposer que variables_order expose toujours $_ENV.
 */
$env = static function (string $name, mixed $default = null): mixed {
    if (array_key_exists($name, $_ENV)) {
        return $_ENV[$name];
    }

    if (array_key_exists($name, $_SERVER)) {
        return $_SERVER[$name];
    }

    $value = getenv($name);

    return $value === false ? $default : $value;
};

$bool = static function (string $name, bool $default = false) use ($env): bool {
    return filter_var($env($name, $default), FILTER_VALIDATE_BOOL);
};

return [
    'app' => [
        'env' => $env('APP_ENV', 'prod'),
        'debug' => $bool('APP_DEBUG', false),
    ],
    'database' => [
        'type' => $env('DB_TYPE', 'mysql'),
        'host' => $env('DB_HOST', '127.0.0.1'),
        'port' => (int) $env('DB_PORT', 3306),
        'database' => $env('DB_NAME', 'bts_web'),
        'username' => $env('DB_USER', 'root'),
        'password' => $env('DB_PASSWORD', ''),
        'charset' => $env('DB_CHARSET', 'utf8mb4'),
    ],
];
