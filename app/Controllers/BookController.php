<?php

namespace App\Controllers;

use App\Models\BookModels;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController
{
    protected $model;

    public function __construct(BookModels $model) {
        $this->model = $model;
    }

    public function index(Request $request, Response $response)
    {
        $date = json_encode(['message' => "Api online"]);

        $response->getBody()->write($date);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    public function all(Request $request, Response $response)
    {
        $result = $this->model->all();

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function find(Request $request, Response $response, $args)
    {
        $result = $this->model->find($args['id']);

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}