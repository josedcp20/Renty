<?php

$host = "localhost";
$user = "root@localhost";
$password = "";
$basedatos = "Renty";

$conexion= new mysqli($host, $user, $password, $basedatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

&conexion ->set_charset("utf8mb4");
?>
