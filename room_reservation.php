<?php
// room_reservation.php
session_start();
include 'db.php';

// Verifica que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos de la solicitud JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Datos recibidos desde la solicitud AJAX
    $habitacionId = $data['habitacionId'];
    $fechaInicio = $data['fechaInicio'];
    $fechaFin = $data['fechaFin'];

    // Aquí deberías realizar la lógica de reserva en la base de datos con los datos recibidos
    // Por ejemplo, podrías ejecutar una consulta SQL para actualizar la tabla de reservas

    // Supongamos que tienes una conexión a la base de datos establecida en este punto

    // Prepara la consulta SQL para insertar la reserva
    $sql = "INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin) 
            VALUES (?, ?, ?)";

    // Prepara la declaración
    $stmt = $conn->prepare($sql);

    // Vincula los parámetros
    $stmt->bind_param("iss", $habitacionId, $fechaInicio, $fechaFin);

    // Ejecuta la consulta
    $stmt->execute();

    // Cierra la declaración
    $stmt->close();

    // Cierra la conexión a la base de datos (puedes omitir esto si la conexión es persistente)

    // Simulación de la respuesta (puedes personalizarla según tus necesidades)
    $response = array(
        'status' => 'success',
        'message' => 'Reserva realizada correctamente desde room_reservation',
        'data' => $data,  // Puedes incluir más información si es necesario
    );

    // Devuelve la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si la solicitud no es de tipo POST, devuelve un mensaje de error
    $response = array(
        'status' => 'error',
        'message' => 'Error en la solicitud',
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}

