<?php 

use App\Database\Database;
use App\Models\Model;
use Dotenv\Dotenv;

require __DIR__."/vendor/autoload.php";
require __DIR__."/dotenv.php";

# Preparando o banco de dados!
$database = new Database();
$database->run();