<?php

use App\Controller\TestController;

$router = new AltoRouter();

$router->map('GET', '/example', [TestController::class, 'example']);

return $router;