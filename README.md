1- Página de Inicio:

- Formulario con fecha de inicio, fin, y tipo de habitacion (opcional) para verificar disponibilidad. ✔️
- Muestra habitaciones disponibles. ✔️
- Los usuarios pueden seleccionar la habitación.

2- Proceso de Reserva (Backend):

- Verifica la disponibilidad de la habitación para las fechas seleccionadas.
- Registra la reserva en la base de datos y actualiza el estado de la habitación.
- Envía un correo electrónico de confirmación al usuario (PHPMailer).

3- Calendario de Reservas (Backend y Frontend):

- Muestra un calendario con las fechas ocupadas y disponibles.
- Permite a los usuarios realizar nuevas reservas o cancelar las existentes.

4- Panel de Administración (Backend):

- Proporciona una interfaz para que los administradores gestionen habitaciones, reservas y usuarios.

SQL:

```sql
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255)
);

CREATE TABLE habitaciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero INT,
    tipo VARCHAR(50),
    estado VARCHAR(20),
    fecha_inicio DATE,
    fecha_fin DATE;

);

CREATE TABLE reservas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_habitacion INT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado VARCHAR(20),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_habitacion) REFERENCES habitaciones(id)
);

INSERT INTO habitaciones (numero, tipo, estado, fecha_inicio, fecha_fin) VALUES
(101, 'Individual', 'Disponible', NULL, NULL),
(102, 'Doble', 'Disponible', NULL, NULL),
(103, 'Suite', 'Reservada', '2024-03-01', '2024-03-05'),
(104, 'Individual', 'Disponible', NULL, NULL),
(105, 'Doble', 'Disponible', NULL, NULL),
(106, 'Suite', 'Disponible', NULL, NULL),
(107, 'Individual', 'Reservada', '2024-03-10', '2024-03-15'),
(108, 'Doble', 'Disponible', NULL, NULL),
(109, 'Suite', 'Disponible', NULL, NULL),
(110, 'Individual', 'Disponible', NULL, NULL);

```
