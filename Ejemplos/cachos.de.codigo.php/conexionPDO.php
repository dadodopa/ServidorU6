<?php

try {
    $conexion = new PDO("mysql:host=localhost;dbname=crud_empleados;charset=utf8", "root", "");
} catch (PDOException $e) {
    die("Error");
}
