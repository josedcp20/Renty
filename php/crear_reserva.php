<?php
header('Content-Type: application/json; charset=UTF-8');
require_once 'conexion.php';
session_start();

// Lee el JSON de la petición
$data = json_decode(file_get_contents('php://input'), true);

if (
    empty($data['matricula']) ||
    empty($data['start'])     ||
    empty($data['end'])       ||
    empty($_SESSION['dni'])
) {
    echo json_encode(['success'=>false,'mensaje'=>'Datos incompletos.']);
    exit;
}

$matricula = $data['matricula'];
$start     = $data['start'];
$end       = $data['end'];
$dni       = $_SESSION['dni'];

// Inserta la reserva
$stmt = $conexion->prepare("
  INSERT INTO alquileres (matricula, fecha_inicio, fecha_fin, dni)
  VALUES (?, ?, ?, ?)
");
$stmt->bind_param("ssss", $matricula, $start, $end, $dni);

if ($stmt->execute()) {
    echo json_encode(['success'=>true,'mensaje'=>'Reserva creada correctamente.']);
} else {
    echo json_encode([
      'success'=>false,
      'mensaje'=>'Error en base de datos: '.$conexion->error
    ]);
}
exit;
