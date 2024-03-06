<?php
session_start();
include('db.php');
include 'includes/header.php';
?>
<main>
    <h2>Comprobar la disponibilidad con parametros opcionales</h2>
    <form action="procesar_reserva.php" method="post">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio">

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin">

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