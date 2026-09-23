<?php

declare(strict_types=1);

use App\Controller\EquipmentController;
use App\Database\DatabaseFactory;
use App\Http\ViewRenderer;
use App\Repository\EquipmentRepository;
use App\Service\EquipmentService;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

$root = dirname(__DIR__);

Dotenv::createImmutable($root)->safeLoad();

$settings = require $root . '/config/settings.php';

$app = AppFactory::create();

$database = DatabaseFactory::create($settings['database']);
$repository = new EquipmentRepository($database);
$service = new EquipmentService($repository);
$renderer = new ViewRenderer($root . '/templates');
$controller = new EquipmentController($service, $renderer);

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(
    $settings['app']['debug'],
    true,
    true
);

(require $root . '/routes/web.php')($app, $controller);
(require $root . '/routes/api.php')($app, $controller);

$app->run();
