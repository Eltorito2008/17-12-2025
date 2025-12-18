<?php
session_start(); 
include('includes/db.php');
include('includes/header.php');
?>

<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <h1 class="display-4 mb-4">Bienvenido al Sistema de Tareas</h1>
        <p class="lead">Organiza tus tareas diarias de manera simple y eficiente</p>
        
        <?php if(!isset($_SESSION['user_id'])): ?>
            <div class="mt-5">
                <a href="login.php" class="btn btn-primary btn-lg me-3">Iniciar Sesión</a>
                <a href="register.php" class="btn btn-success btn-lg">Registrarse</a>
            </div>
        <?php else: ?>
            <div class="mt-5">
                <a href="dashboard.php" class="btn btn-primary btn-lg">Ir a Mis Tareas</a>
                <a href="create_task.php" class="btn btn-success btn-lg ms-3">Crear Nueva Tarea</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>