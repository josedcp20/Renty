<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['dni'])) {
    echo json_encode([]);
    exit;
}

$dni = $_SESSION['dni'];

// Consulta para obtener las reservas del usuario
$stmt = $conexion->prepare("SELECT fecha_inicio, fecha_fin FROM alquileres WHERE dni = ?");
$stmt->bind_param("s", $dni);
$stmt->execute();
$result = $stmt->get_result();

// Creamos un array para las reservas en el formato que FullCalendar necesita
$reservas = [];

while ($row = $result->fetch_assoc()) {
    $reservas[] = [
        'title' => 'Reserva',
        'start' => $row['fecha_inicio'],
        'end' => $row['fecha_fin']
    ];
}

echo json_encode($reservas);
?>