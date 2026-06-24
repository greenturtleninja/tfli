<?php
declare(strict_types=1);
require "router.php";

date_default_timezone_set('UTC');


$request = $_SERVER['REQUEST_URI'];

$routes = new Router();

$uris = explode("/", $request);

if (count($uris) === 3) {
    $routes->redirect($uris[2]);
}

// var_dump($routes->getAll());

echo 'Hello there' . $request;