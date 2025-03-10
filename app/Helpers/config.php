<?php

function config(string $path) {
    return require  __DIR__ . "/../../config/{$path}.php";
}