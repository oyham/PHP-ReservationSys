<?php
// room_reservation.php

// Verifica que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos de la solicitud JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Aquí deberías realizar la lógica de reserva en la base de datos con los datos recibidos
    // Por ejemplo, podrías actualizar la base de datos con la información de la reserva

    // Simulación de la respuesta (puedes personalizarla según tus necesidades)
    $response = array(
        'status' => 'success',
        'message' => 'Reserva realizada correctamente',
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
