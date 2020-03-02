<?php
$environment = 'development';

$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    $whoops->pushHandler(function ($e){
        echo 'Todo: Friendly error page';
    });
}