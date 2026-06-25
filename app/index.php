<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require "router.php";

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/url/{short}', function (Request $request, Response $response, $short) {
    $response->getBody()->write(json_encode(['routes' => [$short],'status' => 'ready']));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/uri', function (Request $request, Response $response) {
    $router = new Router();
    $allRoutes = $router->getAll();
    $response->getBody()->write(json_encode(['routes' => $allRoutes,'status' => 'ready']));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/api/uris', function (Request $request, Response $response) {
    $response->getBody()->write(json_encode(['service' => 'testing input', 'status' => 'ready']));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();