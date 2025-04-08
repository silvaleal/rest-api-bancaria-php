<?php

namespace App\Controllers;

class HomeController
{
    public function index($request, $response) {
        $result = json_encode(["message"=>"Api disponível"]);

        $response->getBody()->write($result);
        return $response->withHeader("Content-Type", 'application/json');
    }
}