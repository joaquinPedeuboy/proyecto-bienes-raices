<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'joa55joa', 'bienesraices_crud');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}