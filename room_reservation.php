<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $habitacionId = $_POST['habitacionId'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 'pendiente';
    $usuario = $_POST['nombre']; // El nombre del campo del formulario es "nombre"
    $email = $_POST['email']; // El nombre del campo del formulario es "email"

    // Preparar la consulta SQL
    $sql = "INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin, estado, usuario, email) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("iss", $habitacionId, $fechaInicio, $fechaFin, $estado, $usuario, $email);

    // Ejecutar la consulta
    $stmt->execute();

    // Redirigir al usuario a otra página después de completar la inserción
    header('Location: index.php');
    exit(); // Es importante terminar la ejecución del script después de la redirección
} else {
    // Si la solicitud no es de tipo POST, mostrar un mensaje de error
    echo "Error: método no permitido";
    exit(); // Terminar la ejecución del script
}



