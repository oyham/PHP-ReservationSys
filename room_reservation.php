<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $habitacionId = $_POST['habitacionId'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 'pendiente';
    $usuario = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin, estado, usuario, email) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $habitacionId, $fechaInicio, $fechaFin, $estado, $usuario, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: La inserción en la base de datos falló";
        exit();
    }
} else {
    echo "Error: método no permitido";
    exit();
}



