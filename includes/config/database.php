<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'joa55joa', 'bienesraices_crud');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}