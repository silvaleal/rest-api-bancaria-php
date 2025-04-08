<?php

namespace App\Models;

use PDO;

class UsersModels{
    private $database;

    public function __construct() 
    {
        $this->database = $GLOBALS['database']; # Resolvi usar uma variável criada no bootstrap para não ficar instanciando a classe novamente.
    }

    public function add($name, $token)
    {
        $sql = "INSERT INTO users (name, token) VALUES (:name, :token)";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute([
            'name'=>$name,
            'token'=>$token]);
        return $stmt->rowCount() >0;
    }

    public function remove($id) {
        $sql = 'DELETE FROM users WHERE id = :id';

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->rowCount() >0;
    }

    public function find($field, $value) {
        $sql = "SELECT * FROM users WHERE $field = :value";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute([
            'value' => $value]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function all() {
        $sql =  "SELECT * FROM users";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function checkUserByField($field, $value) {
        $sql = "SELECT * FROM users WHERE $field = :value";
        
        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute(["value"=> $value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}