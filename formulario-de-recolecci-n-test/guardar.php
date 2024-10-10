<?php
session_start(); // Iniciar la sesión
// Configuración de la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root";   // Reemplaza con tu nombre de usuario de MySQL
$password = ""; // Reemplaza con tu contraseña de MySQL
$dbname = "ecologico"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];
$volumen = $_POST['volumen'];
$fecha = $_POST['fecha'];
$ubicacion = $_POST['ubicacion'];
$tipo_punto = $_POST['tipo_punto'];
$capacidad = $_POST['capacidad'];
$horario_recoleccion = $_POST['horario_recoleccion'];
$identificacion = $_POST['identificacion'];
$tipo_vehiculo = $_POST['tipo_vehiculo'];
$capacidad_carga = $_POST['capacidad_carga'];
$estado_vehiculo = $_POST['estado_vehiculo'];

// Insertar datos en tipos_residuos
$sql_residuos = "INSERT INTO tipos_residuos (tipo, descripcion, volumen_peso, fecha_generacion) VALUES ('$tipo', '$descripcion', '$volumen', '$fecha')";
$conn->query($sql_residuos);

// Obtener el último ID insertado para usarlo en puntos_recoleccion
$ultimo_id_residuo = $conn->insert_id;

// Insertar datos en puntos_recoleccion
$sql_puntos = "INSERT INTO puntos_recoleccion (ubicacion, tipo, capacidad, horario_recoleccion) VALUES ('$ubicacion', '$tipo_punto', '$capacidad', '$horario_recoleccion')";
$conn->query($sql_puntos);

// Obtener el último ID insertado para usarlo en personal_recoleccion
$ultimo_id_punto = $conn->insert_id;

// Insertar datos en personal_recoleccion
$sql_vehiculo = "INSERT INTO personal_recoleccion (identificacion, nombre, rol, turno_trabajo) VALUES ('$identificacion', '$tipo_vehiculo', '$capacidad_carga', '$estado_vehiculo')";
$conn->query($sql_vehiculo);

// Verificar si las consultas fueron exitosas
if ($conn->affected_rows > 0) {
    $_SESSION['mensaje'] = "Datos guardados correctamente."; // Mensaje de éxito
} else {
    $_SESSION['mensaje'] = "Error: " . $conn->error; // Mensaje de error
}

// Cerrar conexión
$conn->close();

// Redirigir a la página principal
header("Location: index.php");
exit(); // Asegúrate de que el script se detenga aquí
?>
