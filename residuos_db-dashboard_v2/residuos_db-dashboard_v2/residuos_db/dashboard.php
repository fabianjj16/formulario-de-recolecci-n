<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Conectar a la base de datos
require 'db.php';

// Obtener información del usuario
$username = $_SESSION['username'];
$sql = "SELECT * FROM usuarios WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_role = $user['rol'];  // Suponiendo que tienes un campo 'role' en la tabla 'usuarios'
} else {
    echo "Usuario no encontrado.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Incluye tu archivo CSS -->
    <style>
        /* Aquí podrías agregar estilos para el dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .admin-section, .user-section {
            margin-top: 20px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Bienvenido, <?php echo $user['username']; ?></h2>

    <?php if ($user_role === 'admin'): ?>
        <!-- Contenido exclusivo para usuarios con rol de admin -->
        <div class="admin-section">
            <h3>Sección de Administrador</h3>
            <p>Aquí puedes gestionar todas las cuentas de los usuarios.</p>

            <!-- Mostrar todas las cuentas de usuarios -->
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <!-- <th>Email</th> -->
                        <th>Role</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_usuarios = "SELECT * FROM usuarios";
                    $result_usuarios = $conn->query($sql_usuarios);
                    if ($result_usuarios->num_rows > 0):
                        while($row = $result_usuarios->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['rol']; ?></td>
                                <td>
                                    <a href="editar_usuario.php?id=<?php echo $row['id']; ?>">Editar</a>
                                    <a href="eliminar_usuario.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; 
                    else: ?>
                        <tr>
                            <td colspan="5">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($user_role === 'user'): ?>
        <!-- Contenido exclusivo para usuarios con rol de user -->
        <div class="user-section">
            <h3>Gestión de tu cuenta</h3>
            <p>Desde aquí puedes gestionar tu cuenta, cambiar la contraseña o eliminar tu cuenta.</p>
            <button onclick="window.location.href='cambiar_contrasena.php';">Cambiar contraseña</button>
            <button onclick="window.location.href='eliminar_cuenta.php';">Eliminar cuenta</button>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
