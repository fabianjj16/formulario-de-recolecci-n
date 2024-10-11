<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';

// Obtener datos del formulario
// Tabla personal de recolección
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];
$turno_trabajo = $_POST['turno_trabajo'];
$identificacion = $_POST['identificacion'];
// Tabla tipos de residuos
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];
$volumen = $_POST['volumen'];
$fecha = $_POST['fecha'];
// Tabla datos punto de recolección
$ubicacion = $_POST['ubicacion'];
$tipo_punto = $_POST['tipo_punto'];
$capacidad = $_POST['capacidad'];
$horario_recoleccion = $_POST['horario_recoleccion'];
// Rutas de recolección
$identificacion_persona = $_POST['identificacion_persona'];
$puntos_asignados = $_POST['puntos_asignados'];
$horario = $_POST['horario'];
$frecuencia = $_POST['frecuencia'];
// Datos vehículo
$placa = $_POST['placa'];
$tipo_vehiculo = $_POST['tipo_vehiculo'];
$capacidad_carga = $_POST['capacidad_carga'];
$estado_vehiculo = $_POST['estado_vehiculo']; 

// Insertar datos en tipos_residuos
$sql_residuos = "INSERT INTO tipos_residuos (tipo, descripcion, volumen_peso, fecha_generacion) VALUES ('$tipo', '$descripcion', '$volumen', '$fecha')";
$conn->query($sql_residuos);

// Insertar datos en puntos_recoleccion
$sql_puntos = "INSERT INTO puntos_recoleccion (ubicacion, tipo, capacidad, horario_recoleccion) VALUES ('$ubicacion', '$tipo_punto', '$capacidad', '$horario_recoleccion')";
$conn->query($sql_puntos);

// Insertar datos en personal_recoleccion
$sql_personal = "INSERT INTO personal_recoleccion (identificacion, nombre, rol, turno_trabajo) VALUES ('$identificacion', '$nombre', '$rol', '$turno_trabajo')";
$conn->query($sql_personal);

// Insertar datos en datos_vehiculo_recoleccion
$sql_vehiculo = "INSERT INTO datos_vehiculo_recoleccion (identificacion, tipo_vehiculo, capacidad_carga, estado_vehiculo) VALUES ('$placa', '$tipo_vehiculo', '$capacidad_carga', '$estado_vehiculo')";
$conn->query($sql_vehiculo);

// Insertar datos en rutas_recoleccion
$sql_rutas = "INSERT INTO rutas_recoleccion (identificacion, puntos_asignados, horario, frecuencia) VALUES ('$identificacion_persona', '$puntos_asignados', '$horario', '$frecuencia')";
$conn->query($sql_rutas);

// Verificar si las consultas fueron exitosas
if ($conn->affected_rows > 0) {
    $_SESSION['mensaje'] = "Datos guardados correctamente.";
} else {
    $_SESSION['mensaje'] = "Error: " . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir al formulario con mensaje
header("Location: formulario.php");
exit();
?>
