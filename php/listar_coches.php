<?php
include("conexion.php");

$sql = "SELECT * FROM coches";
$resultado = $conexion->query($sql);

$coches = [];

while($fila = $resultado->fetch_assoc()) {
    $coches[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($coches);
?>

