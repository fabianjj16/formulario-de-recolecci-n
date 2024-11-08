<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            
            <!-- <?php if ($_SESSION['rol'] === 'admin'): ?>
                <li><a href="admin.php">Panel de Admin</a></li>
            <?php endif; ?> -->
            
            <!-- <li><a href="perfil.php">Perfil</a></li> -->
            <li><a href="logout.php">Cerrar Sesión</a></li>
        <?php else: ?>
            <li><a href="login.php">Iniciar Sesión</a></li>
            <li><a href="register.php">Registrarse</a></li>
        <?php endif; ?>
    </ul>
</nav>

<style>
    /* Estilos para la barra de navegación */
    nav {
        background-color: #28a745;
        padding: 10px;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    nav ul li {
        float: left;
    }

    nav ul li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    nav ul li a:hover {
        background-color: #575757;
    }
</style>
