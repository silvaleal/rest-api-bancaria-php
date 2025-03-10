<?php

namespace App\Models;

use PDO;

class BookModels{
    private $database;

    public function __construct() 
    {
        $this->database = $GLOBALS['database']; # Resolvi usar uma variável criada no bootstrap para não ficar instanciando a classe novamente.
    }

    public function find($id) {
        $sql = "SELECT * FROM books WHERE id = :id";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function all() {
        $sql =  "SELECT * FROM books";

        $stmt = $this->database->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }
}