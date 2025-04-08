<?php

namespace App\Controllers;

use App\Models\TransfersModel;
use App\Models\UsersModels;
use Psr\Http\Message\ServerRequestInterface as Request;

class TransferController
{
    protected TransfersModel $transfersmodel;
    protected UsersModels $usersmodel;

    public function __construct(TransfersModel $transfersmodel, UsersModels $usersModels)
    {
        $this->transfersmodel = $transfersmodel;
        $this->usersmodel = $usersModels;
    }

    public function add(Request $request, $response, $args)
    {
        $value = $args['value'];
        $auth = $request->getHeader('Authorization');

        if (empty($auth)) {
            $response->getBody()->write(json_encode(['message' => "Token inválido"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $token = explode(' ', $auth[0])[1];
        $user = $this->transfersmodel->checkUserByToken($token);

        if (empty($this->usersmodel->find('token', $token))) {
            $response->getBody()->write(json_encode(['message' => "Token inválido"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        $this->transfersmodel->add($user['id'], $value);

        $response->getBody()->write(json_encode(['message' => "Transferência registrada com sucesso"]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function all(Request $request, $response)
    {
        $token = $request->getHeader('Authorization');

        if (empty($token)) {
            $response->getBody()->write(json_encode(["message"=>"Sem token"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }

        $result = $this->transfersmodel->all();

        $response->getBody()->write(json_encode($token));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function find(Request $request, $response, $args)
    {
        $result = $this->transfersmodel->find('id', $args['id']);

        if ($result) {
            $response->getBody()->write(json_encode($result));
            $status = 200;
        } else {
            $response->getBody()->write(json_encode(['message' => 'Nenhuma transferência da sua conta com este ID foi encontrada.']));
            $status = 404;
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}