<?php

namespace  App\Database;

use PDO;

class Database {
    public $connect;

    public function __construct() {
        $database = config('database')['database'];

        $this->connect = new PDO("{$database['type']}:host={$database['host']};dbname=".$database['name'], $database['user'], $database['pass']);
    }

    public function run() {
        $tables = require __DIR__ . "/tables.php";
        
        foreach ($tables as $table => $value) {
            $this->connect->exec($value);
        }
    }
}