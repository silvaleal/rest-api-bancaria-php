<?php

namespace App\Controllers;

use App\Models\UsersModels;
use PDOException;

class UsersController
{
    protected UsersModels $usersmodels;

    public function __construct(UsersModels $usersmodels)
    {
        $this->usersmodels = $usersmodels;
    }

    public function add($request, $response, $args)
    {
        $auth = $request->getHeader('Authorization');

        if (empty($auth)) {
            $response->getBody()->write(json_encode(['message' => "Token inválido"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $name = $args['name'];
        $token = genToken();

        try {
            if ($this->usersmodels->find('name', $name)) {
                $response->getBody()->write(json_encode(["message" => "Usuário já registrado"]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            }
            $this->usersmodels->add($name, $token);

            $response->getBody()->write(json_encode(["message" => "Usuário registrado"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (PDOException $error) {
            $response->getBody()->write(json_encode(["message" => "Não foi possível registrar este usuário"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    public function remove($request, $response, $args)
    {
        $auth = $request->getHeader('Authorization');

        if (empty($auth)) {
            $response->getBody()->write(json_encode(['message' => "Token inválido"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        try {
            if (!$this->usersmodels->find('id', $args['id'])) {
                $response->getBody()->write(json_encode(['message'=> 'Nenhum usuário com este ID foi encontrado.']));
            }
            $this->usersmodels->remove($args['id']);
            
            $response->getBody()->write(json_encode(["message"=>"Usuário deletado com sucesso"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);

        } catch (PDOException $error) {
            $response->getBody()->write(json_encode(["message"=>"Não foi possível deletar este usuário"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    public function all($request, $response)
    {
        $auth = $request->getHeader('Authorization');

        if (empty($auth)) {
            $response->getBody()->write(json_encode(['message' => "Token inválido"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $result = $this->usersmodels->all();

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function find($request, $response, $args)
    {
        $auth = $request->getHeader('Authorization');

        if (empty($auth)) {
            $response->getBody()->write(json_encode(['message' => "Token inválido"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $result = $this->usersmodels->find('name', $args['name']);

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}