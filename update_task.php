<?php

session_start();
include('includes/db.php');



if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_GET['id']) || !isset($_GET['action'])) {
    header('Location: dashboard.php');
    exit;
}

$task_id = $_GET['id'];
$action = $_GET['action'];


$stmt = $conn->prepare("SELECT * FROM tareas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$task_id, $_SESSION['user_id']]);
$task = $stmt->fetch();

if(!$task) {
    header('Location: dashboard.php');
    exit;
}


if($action == 'complete') {
 
    $stmt = $conn->prepare("UPDATE tareas SET estado = 'completada' WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$task_id, $_SESSION['user_id']]);
    
    header('Location: dashboard.php');
    exit;
} elseif($action == 'edit') {
   
    $error = '';
    $success = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = trim($_POST['titulo']);
        $descripcion = trim($_POST['descripcion']);
        $estado = $_POST['estado'];
        
        if(empty($titulo)) {
            $error = 'El título es obligatorio';
        } else {
           
            $stmt = $conn->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, estado = ? WHERE id = ? AND usuario_id = ?");
            
            if($stmt->execute([$titulo, $descripcion, $estado, $task_id, $_SESSION['user_id']])) {
                $success = 'Tarea actualizada exitosamente';
                header('refresh:2;url=dashboard.php');
            } else {
                $error = 'Error al actualizar la tarea';
            }
        }
    }
    
    include('includes/header.php');
    ?>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Editar Tarea</h3>
                </div>
                <div class="card-body">
                    <?php if($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <?php if($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required
                                   value="<?php echo htmlspecialchars($task['titulo']); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"><?php echo htmlspecialchars($task['descripcion']); ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="pendiente" <?php echo $task['estado'] == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="completada" <?php echo $task['estado'] == 'completada' ? 'selected' : ''; ?>>Completada</option>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
                            <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php include('includes/footer.php');
}
?>