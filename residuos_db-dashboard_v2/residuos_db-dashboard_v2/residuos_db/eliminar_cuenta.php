<?php
session_start();
require 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Obtener el nombre de usuario y rol desde la sesión
$username = $_SESSION['username'];

// Obtener el rol del usuario autenticado
$sql = "SELECT rol FROM usuarios WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$rol = $user['rol']; // Obtener el rol del usuario autenticado

// Verificar si se está intentando eliminar a otro usuario (solo admin puede hacerlo)
if ($rol === 'admin' && isset($_GET['username'])) {
    $user_to_delete = $_GET['username']; // El administrador puede eliminar la cuenta de otro usuario
} else {
    // Si no es admin o no se especifica otro usuario, eliminar la cuenta propia
    $user_to_delete = $username;
}

// Eliminar el usuario de la base de datos
$sql_delete = "DELETE FROM usuarios WHERE username = '$user_to_delete'";

if ($conn->query($sql_delete) === TRUE) {
    // Si el usuario es admin y eliminó otra cuenta, redirigirlo al panel de admin
    if ($rol === 'admin' && $user_to_delete !== $username) {
        header("Location: admin_panel.php?message=usuario_eliminado");
        exit();
    }
    
    // Si se eliminó su propia cuenta, cerrar la sesión y redirigir a la página de login
    session_destroy();
    header("Location: index.php?message=cuenta_eliminada");
    exit();
} else {
    echo "Error al eliminar la cuenta: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
