<?php

use Dotenv\Dotenv;

# usando o .env ( LIB: vlucas/phpdotenv | composer require vlucas/phpdotenv )
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();