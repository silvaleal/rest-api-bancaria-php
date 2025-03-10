<?php

require __DIR__ . '/../dotenv.php';

return [
    "database" => [
        'type'=> $_ENV['DB_TYPE'],
        'host'=> $_ENV['DB_HOST'],
        'name'=> $_ENV['DB_NAME'],
        'user'=> $_ENV['DB_USER'],
        'pass'=> $_ENV['DB_PASS'],
        'port'=> $_ENV['DB_PORT'],
    ]
];