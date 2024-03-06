<?php
session_start();
include 'db.php';

$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$tipoHabitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : null;
$tipoHabitacionClause = $tipoHabitacion ? "AND tipo = '$tipoHabitacion'" : "";

$sql = "SELECT * FROM habitaciones WHERE estado = 'Disponible' AND fecha_inicio IS NULL AND fecha_fin IS NULL $tipoHabitacionClause";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $respuesta .= "<h2>Habitaciones Disponibles</h2>";
    $respuesta .= "<table border='1'>";
    $respuesta .= "<tr><th>Número</th><th>Tipo</th><th>Estado</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $respuesta .= "<tr>";
        $respuesta .= "<td>" . $row["numero"] . "</td>";
        $respuesta .= "<td>" . $row["tipo"] . "</td>";
        $respuesta .= "<td>" . $row["estado"] . "</td>";
        $respuesta .= "</tr>";
    }

    $respuesta .= "</table>";
} else {
    $respuesta = "<p>No hay habitaciones disponibles</p>";
}

// Almacena la respuesta en una variable de sesión
$_SESSION['respuesta_reserva'] = $respuesta;
// Cierra la conexión a la base de datos
$conn->close();
// Redirecciona de vuelta a index.php
header('Location: index.php');
exit();