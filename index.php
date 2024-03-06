<?php
session_start();
include('db.php');
include 'includes/header.php';
?>
<main>
    <h1>Ingrese fechas para comprobar la disponibilidad</h1>
    <form action="procesar_reserva.php" method="post">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" required>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" required>

        <input type="submit" value="Verificar Disponibilidad">
    </form>
    <?php
    // Muestra la respuesta de procesar_reserva.php si está disponible
    if (isset($_SESSION['respuesta_reserva'])) {
        echo '<p>' . $_SESSION['respuesta_reserva'] . '</p>';

        // Limpia la variable de sesión después de mostrarla
        unset($_SESSION['respuesta_reserva']);
    }
    ?>
</main>
<?php
include 'includes/footer.php';