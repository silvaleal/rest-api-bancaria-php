<?php

function config(string $path) {
    return require  __DIR__ . "/../../config/{$path}.php";
}

function genToken() {
    $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ@!$-%1234567890";
    $token = "";

    for ($i=0; $i < 25; $i++) { 
        $token = $token.$caracteres[rand(0,strlen($caracteres)-1)];

    }
    return $token;

}