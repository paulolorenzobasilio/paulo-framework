<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

require('error_handler.php');

$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse;

foreach($response->getHeaders() as $header){
    header($header, false);
}

$response->setContent('404 - Page not found');
$response->setStatusCode(404);

echo $response->getContent();
