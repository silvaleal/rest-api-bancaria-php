<?php

namespace App\Controllers;

use App\Models\UsersModels;
use PDOException;

class UsersController
{
    protected $model;

    public function __construct(UsersModels $model) {
        $this->model = $model;
    }

    public function add($request, $response, $args) {

        $name = $args['name'];
        $token = genToken();

        try {
            $this->model->add($name, $token);

            $response->getBody()->write(json_encode(["message"=>"Usuário registrado"]));
            $status = 200;
        } catch (PDOException $error) {
            $response->getBody()->write(json_encode(["message"=>"Não foi possível registrar este usuário"]));
            $status = 404;
        }
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }

    public function remove($request, $response, $args) {
        $id = $args['id'];

        $query = $this->model->remove($id);
        
        if ($query) {        
            $response->getBody()->write(json_encode(['message'=> "Usuário #{$id} foi removido."]));
        } else {
            $response->getBody()->write(json_encode(['message'=> "Usuário #{$id} não foi removido."]));
        }

        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    public function all($request, $response)
    {
        $result = $this->model->all();

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function find($request, $response, $args)
    {
        $result = $this->model->find('name',$args['name']);

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}