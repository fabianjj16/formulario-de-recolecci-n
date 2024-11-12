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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FORMULARIO DE RECOLECCIÓN</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="container-content">
            <img src="img/LOGO.png" alt="LOGO" class="LOGO-img">
            <h2>Bienvenido, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Cerrar Sesión</a></h2>
            <!-- <p><a href="eliminar_cuenta.php" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.');" class="eliminar-cuenta">Eliminar Cuenta</a></p> -->
            <h2>Formulario de Recolección de Residuos</h2>
            <form id="residuoForm" action="guardar.php" method="POST">
                <!-- Tipo de Recolección -->
                <label for="tipo">Tipo de recolección</label>
                <select id="tipo" name="tipo" required onchange="mostrarDatos()">
                    <option value="3" selected>Seleccione el campo</option> <!-- Opción seleccionada por defecto -->
                    <option value="1">Domestico</option>
                    <option value="2">Comercial</option>
                </select>

                <!-- Div que contiene todos los campos del formulario, oculto por defecto -->
                <div id="datos" style="display: none;">
                    <!-- Datos Usuario Doméstico -->
                    <!-- Datos Usuario Doméstico -->
                    <div class="datos-domestico">
                        <div id="datos-domestico" style="display: none;">
                            <h3>Datos Usuario Doméstico</h3>
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" required>

                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" required>

                            <label for="barrio">Barrio</label>
                            <input type="text" id="barrio" name="barrio" required>

                            <label for="municipio">Municipio</label>
                            <select id="municipio" name="municipio" required>
                                <option value="1">Girardot</option>
                                <option value="2">Ricaurte</option>
                                <option value="3">Flandes</option>
                            </select>

                            <label for="num_personas">Número de personas que habitan la vivienda</label>
                            <input type="number" id="num_personas" name="num_personas" required>

                            <h3>Datos de Contacto</h3>
                            <label for="nombre_contacto">Nombre de la persona de contacto</label>
                            <input type="text" id="nombre_contacto" name="nombre_contacto" required>

                            <label for="cedula_contacto">Cédula</label>
                            <input type="text" id="cedula_contacto" name="cedula_contacto" required>

                            <label for="celular_contacto">Celular</label>
                            <input type="text" id="celular_contacto" name="celular_contacto" required>

                            <label for="correo_contacto">Correo electrónico</label>
                            <input type="email" id="correo_contacto" name="correo_contacto" required>

                            <!-- Tipos de Residuos -->
                            <label>Tipos de residuos:</label><br>
                            <div class="content-check">
                                <div class="checkbox-item">
                                    <input type="checkbox" id="plastico" name="tipos_residuos[]" value="1">
                                    <label for="plastico">Plástico</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="carton" name="tipos_residuos[]" value="2">
                                    <label for="carton">Cartón</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="papel" name="tipos_residuos[]" value="3">
                                    <label for="papel">Papel</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="metal" name="tipos_residuos[]" value="4">
                                    <label for="metal">Metal</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="vidrio" name="tipos_residuos[]" value="5">
                                    <label for="vidrio">Vidrio</label>
                                </div>
                            </div>

                            <!-- Horario de Recolección (debajo de Tipos de Residuos) -->
                            <label for="horario_recoleccion">Horario de recolección</label>
                            <select id="horario_recoleccion" name="horario_recoleccion" required>
                                <option value="1">Mañana: 8:00 a.m. - 12:00 p.m.</option>
                                <option value="2">Tarde: 2:00 p.m. - 5:00 p.m.</option>
                            </select>
                        </div>
                    </div>

                    <!-- Datos Usuario Comercial -->
                    <div id="datos-comercial" style="display: none;">
                        <h3>Datos Usuario Comercial</h3>
                        <label for="razon_social">Razón social</label>
                        <input type="text" id="razon_social" name="razon_social" required>
                        <label for="nit">NIT</label>
                        <input type="number" id="nit" name="nit" required>
                        <label for="direccion_comercial">Dirección</label>
                        <input type="text" id="direccion_comercial" name="direccion_comercial" required>
                        <label for="barrio_comercial">Barrio</label>
                        <input type="text" id="barrio_comercial" name="barrio_comercial" required>
                        <label for="municipio_comercial">Municipio</label>
                        <select id="municipio_comercial" name="municipio_comercial" required>
                            <option value="1">Girardot</option>
                            <option value="2">Ricaurte</option>
                            <option value="3">Flandes</option>
                        </select>
                        <label for="horario_operacional">Horario Establecimiento</label>
                        <input type="text" id="horario_operacional" name="horario_operacional" required>
                        <label for="nombre_contacto_comercial">Nombre contacto</label>
                        <input type="text" id="nombre_contacto_comercial" name="nombre_contacto_comercial" required>
                        <label for="numero_cedula_comercial">Cédula</label>
                        <input type="number" id="numero_cedula_comercial" name="numero_cedula_comercial" required>
                        <label for="correo_comercial">Correo electrónico</label>
                        <input type="email" id="correo_comercial" name="correo_comercial" required>

                        <!-- Horario de Recolección -->
                        <!-- <label for="horario_recoleccion">Horario de recolección</label>
                <input type="text" id="horario_recoleccion" name="horario_recoleccion" required> -->
                        <label>Tipos de residuos:</label><br>
                        <div class="content-check">
                            <div class="checkbox-item">
                                <input type="checkbox" id="plastico" name="tipos_residuos[]" value="1">
                                <label for="plastico">Plástico</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="carton" name="tipos_residuos[]" value="2">
                                <label for="carton">Cartón</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="papel" name="tipos_residuos[]" value="3">
                                <label for="papel">Papel</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="metal" name="tipos_residuos[]" value="4">
                                <label for="metal">Metal</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="vidrio" name="tipos_residuos[]" value="5">
                                <label for="vidrio">Vidrio</label>
                            </div>
                        </div>
                    </div>


                    <!-- Datos de Contacto (comunes) -->
                    <!-- <h3>Datos de Contacto</h3>
                <label for="nombre_contacto">Nombre de la persona de contacto</label>
                <input type="text" id="nombre_contacto" name="nombre_contacto" required>
                <label for="cedula_contacto">Cédula</label>
                <input type="text" id="cedula_contacto" name="cedula_contacto" required>
                <label for="celular_contacto">Celular</label>
                <input type="text" id="celular_contacto" name="celular_contacto" required>
                <label for="correo_contacto">Correo electrónico</label>
                <input type="email" id="correo_contacto" name="correo_contacto" required> -->

                    <!-- Tipos de Residuos -->
                    <!-- <label>Tipos de residuos:</label><br>
                <div class="content-check">
                    <div class="checkbox-item">
                        <input type="checkbox" id="plastico" name="tipos_residuos[]" value="1">
                        <label for="plastico">Plástico</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="carton" name="tipos_residuos[]" value="2">
                        <label for="carton">Cartón</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="papel" name="tipos_residuos[]" value="3">
                        <label for="papel">Papel</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="metal" name="tipos_residuos[]" value="4">
                        <label for="metal">Metal</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox" id="vidrio" name="tipos_residuos[]" value="5">
                        <label for="vidrio">Vidrio</label>
                    </div>
                </div> -->

                    <!-- Horario de Recolección
                <label for="horario_recoleccion">Horario de recolección</label>
                <select id="horario_recoleccion" name="horario_recoleccion" required>
                    <option value="1">Mañana: 8:00 a.m. - 12:00 p.m.</option>
                    <option value="2">Tarde: 2:00 p.m. - 5:00 p.m.</option>
                </select> -->


                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
