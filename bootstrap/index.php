<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

require('error_handler.php');

$injector = include('../app/dependencies.php');

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

$routeDefinitionCallback = function(\FastRoute\RouteCollector $r) {
    $routes = include('../app/routes.php');
    foreach($routes as $route){
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        
        $class = $injector->make($className);
        $class->$method($vars);
        break;
}

foreach($response->getHeaders() as $header){
    header($header, false);
}

echo $response->getContent();
