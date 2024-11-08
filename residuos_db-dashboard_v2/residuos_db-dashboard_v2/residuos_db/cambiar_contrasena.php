<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['username'];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET password = '$hashed_password' WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Contraseña actualizada correctamente.";
        header("Location: dashboard.php");
    } else {
        echo "Error actualizando la contraseña: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>

<form action="cambiar_contrasena.php" method="POST">
    <label for="new_password">Nueva Contraseña:</label>
    <input type="password" name="new_password" id="new_password" required>
    <button type="submit">Actualizar Contraseña</button>
</form>

</body>
</html>
