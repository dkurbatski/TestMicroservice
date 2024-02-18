<?php

use Dotenv\Dotenv;
use Nette\Database\Connection;
use Symfony\Component\HttpFoundation\Request;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $router = include 'routes.php';
    $match = $router->match();

    global $connect;
    $connect = new Connection("mysql:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

    if ($match = $router->match()) {
        list($controllerName, $methodName) = $match['target'];

        $controller = new $controllerName();

        $request = Request::createFromGlobals();
        $response = call_user_func([$controller, $methodName], $request);

        if ($response) {
            $response->send();
        }
    } else {
        http_response_code(404);
        echo 'Not Found';
    }
} catch (\Throwable $e) {
    http_response_code(500);
    echo $e->getMessage();
}
