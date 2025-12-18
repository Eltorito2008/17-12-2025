Nombre: juan ignacio juarez.
Curso: 6to 5ta
Materia: Desarrollo de aplicaciones web dinámicas
Docente: Martínez Leonardo

Diagrama de Base de Datos

┌─────────────────┐       ┌─────────────────┐
│    usuarios     │       │     tareas      │
├────────────────-┤       ├────────────────-┤
│ id (PK)         │       │ id (PK)         │
│ nombre          │       │ usuario_id (FK) │
│ email           │       │ titulo          │ muestra las dos tlablas con la relacion entre usuarios y con tareas con sus claves primarias y foraneas identificadas
│ password        │       │ descripcion     │
│ fecha_registro  │       │ estado          │
└─────────────────┘       │ fecha_creacion  │
         │                │ fecha_actualiz. │
         └───────────────>└─────────────────┘
         1:N relación


[FORMULARIO] → [PHP] → [CONSULTA SQL]
   ↓
INSERT INTO tareas (usuario_id, ...) VALUES (?, ...)
   ↓
El ? se reemplaza con $_SESSION['user_id']
   ↓
MySQL verifica que usuario_id exista en usuarios.id
   ↓
Si NO existe → ERROR de integridad referencial
Si SI existe → INSERCIÓN exitosa
