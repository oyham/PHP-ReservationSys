<?php
// Inicia la sesión
session_start();
// Incluye el archivo de conexión a la base de datos (db.php)
include 'db.php';

// Recupera las fechas de inicio y fin del formulario
$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];

// Consulta SQL para obtener habitaciones disponibles durante el rango de fechas
$sql = "SELECT * FROM habitaciones WHERE estado = 'Disponible' AND fecha_inicio IS NULL AND fecha_fin IS NULL";
$result = $conn->query($sql);

// Muestra el resultado al usuario
if ($result->num_rows > 0) {
    $respuesta .= "<h2>Habitaciones Disponibles para el Rango de Fechas</h2>";
    $respuesta .= "<table border='1'>";
    $respuesta .= "<tr><th>ID</th><th>Número</th><th>Tipo</th><th>Estado</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $respuesta .= "<tr>";
        $respuesta .= "<td>" . $row["id"] . "</td>";
        $respuesta .= "<td>" . $row["numero"] . "</td>";
        $respuesta .= "<td>" . $row["tipo"] . "</td>";
        $respuesta .= "<td>" . $row["estado"] . "</td>";
        $respuesta .= "</tr>";
    }

    $respuesta .= "</table>";
} else {
    $respuesta = "<p>No hay habitaciones disponibles para el rango de fechas seleccionado.</p>";
}

// Almacena la respuesta en una variable de sesión
$_SESSION['respuesta_reserva'] = $respuesta;
// Cierra la conexión a la base de datos
$conn->close();
// Redirecciona de vuelta a index.php
header('Location: index.php');
exit();