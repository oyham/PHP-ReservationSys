<?php
session_start();
include('db.php');
include 'includes/header.php';
?>
<main>
    <h2>Comprobar la disponibilidad con parametros opcionales</h2>
    <form action="availability.php" method="post">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" required>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" required>

        <label for="tipo_habitacion">Tipo de Habitación:</label>
        <select name="tipo_habitacion">
            <option value="">Seleccione...</option>
            <option value="Individual">Individual</option>
            <option value="Doble">Doble</option>
            <option value="Suite">Suite</option>
        </select>

        <input type="submit" value="Verificar Disponibilidad">
    </form>
    <?php
    if (isset($_SESSION['availability_response'])) {
        $response = json_decode($_SESSION['availability_response'], true);

        if ($response['status'] === 'success') {
            ?>
            <h2>
                <?= $response['message'] ?>
            </h2>
            <table border='1'>
                <tr>
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Reservar</th>
                </tr>
                <?php foreach ($response['rooms'] as $room): ?>
                    <tr>
                        <td>
                            <?= $room['numero'] ?>
                        </td>
                        <td>
                            <?= $room['tipo'] ?>
                        </td>
                        <td>
                            <?= $room['estado'] ?>
                        </td>
                        <td>
                            <button onclick="reservarHabitacion(this)" class="reservar-btn" data-habitacion-id="<?= $room['id'] ?>"
                                data-fecha-inicio="<?= $room['fecha_inicio'] ?>"
                                data-fecha-fin="<?= $room['fecha_fin'] ?>">Reservar</button>
                        </td>
                        <script>
                            // Función para manejar el clic del botón
                            function reservarHabitacion(btn) {
                                // Obtener los datos de la habitación desde los atributos del botón
                                const habitacionId = btn.getAttribute('data-habitacion-id');
                                const fechaInicio = btn.getAttribute('data-fecha-inicio');
                                const fechaFin = btn.getAttribute('data-fecha-fin');

                                // Realizar la reserva utilizando JavaScript (solicitud AJAX)
                                fetch('room_reservation.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        habitacionId: habitacionId,
                                        fechaInicio: fechaInicio,
                                        fechaFin: fechaFin,
                                    }),
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        // Manejar la respuesta según sea necesario
                                        console.log(data);
                                        // Puedes realizar acciones adicionales o redireccionar si es necesario
                                    })
                                    .catch(error => {
                                        console.error('Error al realizar la reserva:', error);
                                    });
                            }
                        </script>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php
        } else {
            echo "<p>{$response['message']}</p>";
        }

        unset($_SESSION['availability_response']);
    }
    ?>
</main>
<?php
include 'includes/footer.php';