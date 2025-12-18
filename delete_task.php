<?php

session_start(); 
include('includes/db.php');


if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$task_id = $_GET['id'];


$stmt = $conn->prepare("DELETE FROM tareas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$task_id, $_SESSION['user_id']]);

header('Location: dashboard.php');
exit;
?>