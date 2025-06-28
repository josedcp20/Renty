<?php
// php/get_reservas.php
header('Content-Type: application/json; charset=UTF-8');
require_once 'conexion.php'; // ajusta ruta si toca

// 1) Recogemos la matrícula por GET (sin sesión)
if (!isset($_GET['matricula'])) {
  echo json_encode([]);
  exit;
}
$matricula = $_GET['matricula'];

// 2) Consultamos las reservas de este coche
$stmt = $conexion->prepare("
  SELECT fecha_inicio, fecha_fin
    FROM alquileres
   WHERE matricula = ?
");
$stmt->bind_param("s", $matricula);
$stmt->execute();
$result = $stmt->get_result();

// 3) Montamos el array con start/end
$reservas = [];
while ($row = $result->fetch_assoc()) {
  $reservas[] = [
    'start' => $row['fecha_inicio'],
    'end'   => $row['fecha_fin']
  ];
}

// 4) Devolvemos sólo JSON
echo json_encode($reservas);
exit;
