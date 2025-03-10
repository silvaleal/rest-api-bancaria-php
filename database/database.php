<?php

namespace  App\Database;

use PDO;

class Database {
    public $connect;

    public function __construct() {
        $this->connect = new PDO("mysql:host=localhost;dbname=slim", "root", "");
    }

    public function run() {
        $tables = require __DIR__ . "/tables.php";
        
        foreach ($tables as $table => $value) {
            $this->connect->exec($value);
        }
    }
}