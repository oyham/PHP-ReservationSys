<?php
session_start();
include 'db.php';

$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$tipoHabitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : null;

$sql = "SELECT h.id, h.numero, h.tipo
        FROM habitaciones h
        WHERE NOT EXISTS (
            SELECT 1
            FROM reservas r
            WHERE h.id = r.id_habitacion
                AND ('$fechaInicio' < r.fecha_fin AND '$fechaFin' > r.fecha_inicio)
        )";

if ($tipoHabitacion) {
    $sql .= " AND h.tipo = '$tipoHabitacion'";
}


$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $rooms = array();
    while ($row = $result->fetch_assoc()) {
        $rooms[] = array(
            'id' => $row["id"],
            'numero' => $row["numero"],
            'tipo' => $row["tipo"],
        );
    }

    $response['status'] = 'success';
    $response['message'] = "Habitaciones Disponibles para entre " . date('d/m/Y', strtotime($fechaInicio)) . " y " . date('d/m/Y', strtotime($fechaFin));
    $response["fechaInicio"] = $fechaInicio;
    $response["fechaFin"] = $fechaFin;
    $response['rooms'] = $rooms;
} else {
    $response['status'] = 'error';
    $response['message'] = 'No hay habitaciones disponibles';
}

$conn->close();
$_SESSION['availability_response'] = json_encode($response);
header('Location: index.php');
exit();