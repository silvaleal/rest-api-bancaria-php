<?php

namespace App\Models;

use PDO;

class TransfersModel{
    private $database;

    public function __construct() 
    {
        $this->database = $GLOBALS['database']; # Resolvi usar uma variável criada no bootstrap para não ficar instanciando a classe novamente.
    }

    public function add($userId, $value)
    {
        $sql = "INSERT INTO transfers (user_id, value) VALUES (:userId, :value)";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute([
            'userId'=>$userId,
            'value'=>$value]);
        return $stmt->rowCount() >0;
    }

    public function checkAcessByToken($token) {
        $sql = "SELECT * FROM transfers
                INNER JOIN users ON transfers.user_id AND users.id
                WHERE users.token = :token AND transfers.id = 1;";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute(['token'=>$token]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkUserByToken($token) {
        $sql = "SELECT users.* FROM transfers
                INNER JOIN users ON transfers.user_id AND users.id
                WHERE users.token = :token";
        
        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute(["token"=> $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function remove($id) {
        $sql = 'DELETE FROM transfers WHERE id = :id';

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->rowCount() >0;
    }

    public function find($field, $value) {
        $sql = "SELECT * FROM transfers WHERE $field = :value";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute([
            'value' => $value
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function all() {
        $sql =  "SELECT * FROM transfers";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }
}