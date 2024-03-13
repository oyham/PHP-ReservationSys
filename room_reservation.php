<?php
session_start();
include 'db.php';

// Verifica que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $habitacionId = $_POST['habitacionId'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 'pendiente';
    $usuario = $_POST['nombre'];
    $email = $_POST['email'];

    // Prepara la consulta SQL para insertar la reserva
    $sql = "INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin, estado, usuario, email) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Vincula los parámetros
    $stmt->bind_param("iss", $habitacionId, $fechaInicio, $fechaFin, $estado, $usuario, $email);

    // Ejecuta la consulta
    $stmt->execute();

    // Manejo de errores
    if ($stmt->error) {
        $response = array(
            'status' => 'error',
            'message' => 'Error al ejecutar la consulta: ' . $stmt->error,
        );

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();  // Importante salir del script después de enviar la respuesta
    }

    // Cierra la declaración
    $stmt->close();

    // Cierra la conexión a la base de datos (puedes omitir esto si la conexión es persistente)

    // Simulación de la respuesta (puedes personalizarla según tus necesidades)
    $response = array(
        'status' => 'pending',
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
// Cerrar la conexión (puedes omitir esto si la conexión es persistente)
$conn->close();
// $_SESSION['room_response'] = json_encode($response);
// session_write_close();
header('Location: index.php');
exit();


