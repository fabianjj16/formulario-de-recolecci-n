<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevenir inyección SQL
    $username = $conn->real_escape_string($username);

    // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM usuarios WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $error = "El nombre de usuario ya está en uso.";
    } else {
        // Encriptar contraseña
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password_hash')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="registro.php">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
