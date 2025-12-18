CREATE DATABASE IF NOT EXISTS todo_list 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;


USE todo_list;


DROP TABLE IF EXISTS tareas;
DROP TABLE IF EXISTS usuarios;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado ENUM('pendiente', 'completada') DEFAULT 'pendiente',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) 
        REFERENCES usuarios(id) 
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO usuarios (nombre, email, password) VALUES
('Usuario Demo', 'demo@test.com', '$2y$10$ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmn'), -- contraseña: 123456
('Ana García', 'ana@test.com', '$2y$10$ZYXWVUTSRQPONMLKJIHGFEDCBA9876543210zyxwvutsrqponmlkj'); -- contraseña: 123456

INSERT INTO tareas (usuario_id, titulo, descripcion, estado) VALUES
(1, 'Comprar leche', 'Ir al supermercado por leche y pan', 'pendiente'),
(1, 'Estudiar PHP', 'Repasar PDO y sesiones para la defensa', 'completada'),
(2, 'Preparar presentación', 'Reunión de equipo a las 15:00hs', 'pendiente');

-
SELECT ' Base de datos configurada exitosamente' AS mensaje;