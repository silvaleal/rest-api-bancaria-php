<?php

return [
    "books" => "CREATE TABLE IF NOT EXISTS books (
        id INT(11) NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    )"
];