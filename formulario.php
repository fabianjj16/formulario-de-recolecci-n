<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Residuos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Cerrar Sesión</a></h2>
        <form id="residuoForm" method="POST" action="guardar.php">
            <!-- Aquí va todo el contenido del formulario que tenías en index.php -->
            <!-- ... (todo el contenido del formulario original) -->
            <!-- He incluido el formulario completo a continuación -->
            <h1>Formulario de Recolección de Residuos</h1>
            <h2>Personal de Recolección</h2>
            <label for="identificacion">Identificación:</label>
            <input type="number" id="identificacion" name="identificacion" required>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="rol">Rol:</label>
            <input type="text" id="rol" name="rol" required>
            <label for="turno_trabajo">Turno de Trabajo:</label>
            <select id="turno_trabajo" name="turno_trabajo" required>
                <option value="mañana">Mañana</option>
                <option value="tarde">Tarde</option>
                <option value="noche">Noche</option>
            </select>
        
            <h2>Datos del Residuo</h2>
            <label for="tipo">Tipo de Residuo:</label>
            <select id="tipo" name="tipo" required>
                <option value="orgánico">Orgánico</option>
                <option value="inorgánico">Inorgánico</option>
                <option value="reciclable">Reciclable</option>
                <option value="peligroso">Peligroso</option>
            </select>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
            <label for="volumen">Volumen/Peso:</label>
            <input type="number" id="volumen" name="volumen" required>
            <label for="fecha">Fecha de Generación:</label>
            <input type="date" id="fecha" name="fecha" required>
            
            <h2>Datos del Punto de Recolección</h2>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>
            <label for="tipo_punto">Tipo de Punto:</label>
            <select id="tipo_punto" name="tipo_punto" required>
                <option value="domiciliario">Domiciliario</option>
                <option value="comercial">Comercial</option>
                <option value="industrial">Industrial</option>
            </select>
            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" required>
            <label for="horario_recoleccion">Horario de Recolección:</label>
            <input type="time" id="horario_recoleccion" name="horario_recoleccion" required>
            
            <h2>Rutas de Recolección</h2>
            <label for="identificacion_persona">Identificación de la Persona:</label>
            <input type="text" id="identificacion_persona" name="identificacion_persona" required>
            <label for="puntos_asignados">Puntos Asignados:</label>
            <input type="text" id="puntos_asignados" name="puntos_asignados" required>
            <label for="horario">Horario:</label>
            <input type="time" id="horario" name="horario" required>
            <label for="frecuencia">Frecuencia:</label>
            <input type="text" id="frecuencia" name="frecuencia" required>

            <h2>Datos del Vehículo de Recolección</h2>
            <label for="placa">Identificación del Vehículo:</label>
            <input type="text" id="placa" name="placa" required>
            <label for="tipo_vehiculo">Tipo de Vehículo:</label>
            <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" required>
            <label for="capacidad_carga">Capacidad de Carga:</label>
            <input type="number" id="capacidad_carga" name="capacidad_carga" required>
            <label for="estado_vehiculo">Estado del Vehículo:</label>
            <input type="text" id="estado_vehiculo" name="estado_vehiculo" required>
        
            <button type="submit">Enviar</button>
            <div id="message"></div>
        </form>
    </div>

    <script src="app.js"></script>
</body>
</html>
