<?php

use App\Controller\AuthorController;
use App\Controller\AutoController;
use App\Controller\PhoneController;
use App\Controller\RateController;
use App\Controller\TestController;

$router = new AltoRouter();

$router->map('GET', '/example', [TestController::class, 'example']);
$router->map('GET', '/auto', [AutoController::class, 'list']);
$router->map('POST', '/auto', [AutoController::class, 'add']);

$router->map('GET', '/rate', [RateController::class, 'list']);
$router->map('PUT', '/rate', [RateController::class, 'update']);

$router->map('GET', '/phone/info', [PhoneController::class, 'info']);

$router->map('GET', '/author/info', [AuthorController::class, 'info']);

return $router;