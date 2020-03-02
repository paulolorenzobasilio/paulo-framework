<?php

namespace App\Controllers;

use Http\Response;

class HomepageController
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function show(){
        $this->response->setContent('Hello World');
    }
}
