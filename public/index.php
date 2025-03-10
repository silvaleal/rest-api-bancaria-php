<?php

use App\Controllers\BookController;
use App\Models\BookModels;
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../bootstrap.php';

AppFactory::setContainer(new Container()); # Responsável pela auto-dependência dos controllers. (Classe do php-di/php-di)
$app = AppFactory::create();

$app->get('/', [BookController::class, 'index']);
$app->get('/book/{id}', [BookController::class, 'find']);
$app->get('/books', [BookController::class, 'all']);

$app->run();
