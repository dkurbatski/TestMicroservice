<?php

use App\Controller\AutoController;
use App\Controller\TestController;

$router = new AltoRouter();

$router->map('GET', '/example', [TestController::class, 'example']);
$router->map('GET', '/auto', [AutoController::class, 'list']);
$router->map('POST', '/auto', [AutoController::class, 'add']);

return $router;