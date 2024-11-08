<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Operación</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Incluye tu archivo CSS -->
    <style>
        .modal {
            display: block; /* Cambia a 'none' para esconder el modal por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Fondo negro con opacidad */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }

        .modal-content h2 {
            margin: 0;
            color: #333;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
        <?php if ($status == 'success') : ?>
            <h2 class="success">¡Operación exitosa!</h2>
            <p>Los datos se han guardado correctamente.</p>
        <?php elseif ($status == 'error') : ?>
            <h2 class="error">Error en la operación</h2>
            <p>Hubo un problema al guardar los datos.</p>
        <?php else: ?>
            <h2>Resultado desconocido</h2>
            <p>No se pudo determinar el estado de la operación.</p>
        <?php endif; ?>
        <button onclick="window.location.href='formulario.php'">Cerrar</button>
    </div>
</div>

</body>
</html>
