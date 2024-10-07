<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "residuos_db"; // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos enviados desde el frontend
$data = json_decode(file_get_contents("php://input"));

// Insertar los datos en la tabla de tipos_residuos
$sql = "INSERT INTO tipos_residuos (tipo, descripcion, volumen_peso, fecha_generacion)
VALUES ('$data->tipo', '$data->descripcion', '$data->volumen', '$data->fecha')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("message" => "Datos almacenados con éxito"));
} else {
    echo json_encode(array("message" => "Error: " . $conn->error));
}

if (isset($data->ubicacion) && isset($data->tipo_punto)) {
    $ubicacion = $data->ubicacion;
    $tipo_punto = $data->tipo_punto;
    $capacidad = $data->capacidad;
    $horario_recoleccion = $data->horario_recoleccion;

    $sql = "INSERT INTO puntos_recoleccion (ubicacion, tipo_punto, capacidad, horario_recoleccion) VALUES ('$ubicacion', '$tipo_punto', '$capacidad', '$horario_recoleccion')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Datos guardados con éxito"));
    } else {
        echo json_encode(array("message" => "Error: " . $conn->error));
    }
}

if (isset($data->identificacion) && isset($data->tipo_vehiculo)) {
    $identificacion = $data->identificacion;
    $tipo_vehiculo = $data->tipo_vehiculo;
    $capacidad_carga = $data->capacidad_carga;
    $estado_vehiculo = $data->estado_vehiculo;

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO vehiculos_recoleccion (identificacion, tipo_vehiculo, capacidad_carga, estado_vehiculo) 
            VALUES ('$identificacion', '$tipo_vehiculo', '$capacidad_carga', '$estado_vehiculo')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Vehículo guardado con éxito"));
    } else {
        echo json_encode(array("message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "Datos incompletos"));
}

$conn->close();
?>
