<?php
$conexion = new mysqli("localhost", "root", "", "alquiler_autos");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
