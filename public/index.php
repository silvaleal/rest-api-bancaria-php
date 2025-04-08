<?php

use App\Controllers\HomeController;
use App\Controllers\TransferController;
use App\Controllers\UsersController;
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../bootstrap.php';

AppFactory::setContainer(new Container()); # Responsável pela auto-dependência dos controllers. (Classe do php-di/php-di)
$app = AppFactory::create();

$app->get('/', [HomeController::class, 'index']);
$app->get('/users', [UsersController::class, 'all']);
$app->get('/user/{name}', [UsersController::class, 'find']);
$app->post('/user/add/{name}', [UsersController::class, 'add']);
$app->post('/user/remove/{id}', [UsersController::class, 'remove']);

$app->get('/transfers', [TransferController::class, 'all']);
$app->get('/transfer/{id}', [TransferController::class, 'find']);
$app->post('/transfer/add/{value}', [TransferController::class, 'add']);

$app->run();
