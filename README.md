1- Página de Inicio:

- Formulario con fecha de inicio, fin, y tipo de habitacion (opcional) para verificar disponibilidad. ✔️
- Muestra habitaciones disponibles. ✔️
- Los usuarios pueden seleccionar la habitación. ✔️

2- Proceso de Reserva (Backend):

- Verifica la disponibilidad de la habitación para las fechas seleccionadas. ✔️
- Registra la reserva en la base de datos y actualiza el estado de la habitación. ❗
- Envía un correo electrónico de confirmación al usuario (PHPMailer). ❗

3- Calendario de Reservas (Backend y Frontend):

- Muestra un calendario con las fechas ocupadas y disponibles.
- Permite a los usuarios realizar nuevas reservas o cancelar las existentes.

4- Panel de Administración (Backend):

- Proporciona una interfaz para que los administradores gestionen habitaciones, reservas y usuarios.

SQL:

```sql
CREATE TABLE habitaciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero INT,
    tipo VARCHAR(50),
);

CREATE TABLE reservas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_habitacion INT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_habitacion) REFERENCES habitaciones(id)
);

INSERT INTO habitaciones (numero, tipo,) VALUES
(101, 'Individual'),
(102, 'Doble'),
(103, 'Suite'),
(104, 'Individual'),
(105, 'Doble'),
(106, 'Suite'),
(107, 'Individual'),
(108, 'Doble'),
(109, 'Suite'),
(110, 'Individual');

-- Reserva 1
INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin)
VALUES (1, '2024-03-01', '2024-03-05');

-- Reserva 2
INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin)
VALUES (2, '2024-04-01', '2024-04-10');

-- Reserva 3
INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin)
VALUES (3, '2024-05-15', '2024-05-20');

-- Reserva 4
INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin)
VALUES (4, '2024-06-01', '2024-06-07');

-- Reserva 5
INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin)
VALUES (5, '2024-07-01', '2024-07-15');

INSERT INTO reservas (id_habitacion, fecha_inicio, fecha_fin)
VALUES (1, '2024-03-06', '2024-03-10');

```
