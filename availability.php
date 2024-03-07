<?php
session_start();
include 'db.php';

$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$tipoHabitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : null;
$tipoHabitacionClause = $tipoHabitacion ? "AND tipo = '$tipoHabitacion'" : "";

$sql = "SELECT * FROM habitaciones 
        WHERE 
            (fecha_inicio IS NULL AND fecha_fin IS NULL) OR 
            (fecha_inicio > '$fechaFin' OR fecha_fin < '$fechaInicio') 
            $tipoHabitacionClause";

$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $rooms = array();
    while ($row = $result->fetch_assoc()) {
        $rooms[] = array(
            'id' => $row["id"],
            'numero' => $row["numero"],
            'tipo' => $row["tipo"],
            'fecha_inicio' => $row["fecha_inicio"],
            'fecha_fin' => $row["fecha_fin"]
        );
    }

    $response['status'] = 'success';
    $response['message'] = 'Habitaciones Disponibles';
    $response['rooms'] = $rooms;
} else {
    $response['status'] = 'error';
    $response['message'] = 'No hay habitaciones disponibles';
}

$conn->close();
$_SESSION['availability_response'] = json_encode($response);
header('Location: index.php');
exit();