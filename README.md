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

