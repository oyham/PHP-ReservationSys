<!DOCTYPE html>
<html lang="en" class="h-100 m-0 p-0">

<head>
  <meta charset="UTF-8">
  <title>ReservationSys</title>
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOEM -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body class="d-flex flex-column align-items-center justify-content-center">
  <nav class="navbar navbar-dark bg-dark container-fluid">
    <div class="container d-flex justify-content-center">
      <title class="navbar-brand">Sistema de Reservación</title>
    </div>
    <div class="">
      <button class="btn btn-secondary" onclick="index()">Inicio</button>
      <button class="btn btn-primary" onclick="myBookings()">Mis reservas</button>
    </div>
    <script>
      function myBookings() {
        // Redirige al archivo PHP que muestra las reservas
        window.location.href = 'my_bookings.php';
      }
      function index() {
        window.location.href = 'index.php'
      }
    </script>
  </nav>