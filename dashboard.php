<?php
session_start();
include('includes/db.php');


if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';


$sql = "SELECT * FROM tareas WHERE usuario_id = ?";
$params = [$_SESSION['user_id']];

switch($filter) {
    case 'pending':
        $sql .= " AND estado = 'pendiente'";
        break;
    case 'completed':
        $sql .= " AND estado = 'completada'";
        break;
  
}

$sql .= " ORDER BY fecha_creacion DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$tasks = $stmt->fetchAll();

include('includes/header.php');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Mis Tareas</h2>
    <a href="create_task.php" class="btn btn-success">➕ Nueva Tarea</a>
</div>

<div class="mb-4">
    <div class="btn-group" role="group">
        <a href="?filter=all" class="btn btn-outline-primary <?php echo $filter == 'all' ? 'active' : ''; ?>">
            Todas
        </a>
        <a href="?filter=pending" class="btn btn-outline-warning <?php echo $filter == 'pending' ? 'active' : ''; ?>">
            Pendientes
        </a>
        <a href="?filter=completed" class="btn btn-outline-success <?php echo $filter == 'completed' ? 'active' : ''; ?>">
            Completadas
        </a>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($tasks)): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay tareas registradas</td>
                </tr>
            <?php else: ?>
                <?php foreach($tasks as $task): ?>
                <tr class="<?php echo $task['estado'] == 'completada' ? 'table-success' : ''; ?>">
                    <td><?php echo htmlspecialchars($task['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($task['descripcion']); ?></td>
                    <td>
                        <span class="badge bg-<?php echo $task['estado'] == 'completada' ? 'success' : 'warning'; ?>">
                            <?php echo ucfirst($task['estado']); ?>
                        </span>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($task['fecha_creacion'])); ?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <?php if($task['estado'] == 'pendiente'): ?>
                                <a href="update_task.php?id=<?php echo $task['id']; ?>&action=complete" 
                                   class="btn btn-success" title="Completar">
                                    
                                </a>
                            <?php endif; ?>
                            <a href="update_task.php?id=<?php echo $task['id']; ?>&action=edit" 
                               class="btn btn-primary" title="Editar">
                                
                            </a>
                            <a href="delete_task.php?id=<?php echo $task['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('¿Eliminar esta tarea?')" title="Eliminar">
                                
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>