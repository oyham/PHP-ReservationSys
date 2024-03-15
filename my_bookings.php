<?php
include 'db.php';
include 'includes/header.php';

// Realiza la consulta para obtener las reservas
$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

// Verifica si se encontraron reservas
if ($result->num_rows > 0) {
    // Imprime los datos de las reservas en una tabla HTML
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>ID Habitación</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
                <th>Usuario</th>
                <th>Email</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["id_habitacion"] . "</td>
                <td>" . $row["fecha_inicio"] . "</td>
                <td>" . $row["fecha_fin"] . "</td>
                <td>" . $row["estado"] . "</td>
                <td>" . $row["usuario"] . "</td>
                <td>" . $row["email"] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron reservas.";
}

// Cierra la conexión a la base de datos
$conn->close();

include 'includes/footer.php';