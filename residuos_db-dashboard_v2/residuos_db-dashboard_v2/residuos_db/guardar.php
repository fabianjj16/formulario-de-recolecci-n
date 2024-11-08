<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debug: Ver los datos enviados a través del formulario
    echo "<pre>";  // Formato de salida legible
    echo "Datos recibidos:\n";
    var_dump($_POST);
    echo "</pre>";

    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null; // Manejo seguro

    if ($tipo === '1') { // Procesar datos domésticos
        $nombre = $_POST['nombre'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $barrio = $_POST['barrio'] ?? '';
        $municipio = $_POST['municipio'] ?? '';
        $num_personas = $_POST['num_personas'] ?? '';
        $nombre_contacto = $_POST['nombre_contacto'] ?? '';
        $cedula_contacto = $_POST['cedula_contacto'] ?? '';
        $celular_contacto = $_POST['celular_contacto'] ?? '';
        $correo_contacto = $_POST['correo_contacto'] ?? '';

        // Guardar datos domésticos en la base de datos
        echo "El valor de tipo es: " . $tipo;

    } elseif ($tipo === '2') { // Procesar datos comerciales
        $razon_social = $_POST['razon_social'] ?? '';
        $nit = $_POST['nit'] ?? '';
        $direccion_comercial = $_POST['direccion_comercial'] ?? '';
        $barrio_comercial = $_POST['barrio_comercial'] ?? '';
        $municipio_comercial = $_POST['municipio_comercial'] ?? '';
        $horario_operacional = $_POST['horario_operacional'] ?? '';
        $nombre_contacto_comercial = $_POST['nombre_contacto_comercial'] ?? '';
        $numero_cedula_comercial = $_POST['numero_cedula_comercial'] ?? '';
        $correo_comercial = $_POST['correo_comercial'] ?? '';
        // Guardar datos comerciales en la base de datos
        echo "El valor de tipo es: " . $tipo;
    } else {
        echo "Tipo de dato no válido.";
        exit();
    }

    // // Procesar datos de contacto comunes
    // -$nombre_contacto = $_POST['nombre_contacto'] ?? '';
    // -$cedula_contacto = $_POST['cedula_contacto'] ?? '';
    // -$celular_contacto = $_POST['celular_contacto'] ?? '';
    // -$correo_contacto = $_POST['correo_contacto'] ?? '';

    // Guardar datos de contacto en la base de datos

    // Aquí es donde se debe realizar la inserción en la base de datos, usando las variables que definiste.
    // Asegúrate de que las variables que estás usando para la inserción están bien definidas y no son nulas.

    if ($tipo == '1') {  // Doméstico
        // Asegúrate de que estas variables están definidas
        $num_personas = $_POST['num_personas'] ?? '';  // Solo para tipo doméstico

        // Insertar datos en la tabla UsuarioDomestico
        $sql_domestico = "INSERT INTO UsuarioDomestico (nombre, direccion, barrio, id_municipio, num_personas, nombre_contacto, cedula_contacto, celular_contacto, correo_contacto)
        VALUES ('$nombre', '$direccion', '$barrio', '$municipio', '$num_personas', '$nombre_contacto', '$cedula_contacto', '$celular_contacto', '$correo_contacto')";

        if ($conn->query($sql_domestico) === TRUE) {
            $usuario_id = $conn->insert_id;

            // Insertar tipos de residuos
            foreach ($_POST['tipos_residuos'] as $tipo_residuo) {
                $sql_residuos = "INSERT INTO ResiduosDomesticos (id_usuario_domestico, id_tipo_residuo) VALUES ('$usuario_id', '$tipo_residuo')";
                $conn->query($sql_residuos);
            }

            // Verificar si el horario de recolección existe antes de insertarlo
            $horario_recoleccion = $_POST['horario_recoleccion'] ?? '';  // Asegúrate de que este campo se está enviando correctamente
            if ($horario_recoleccion) {
                $sql_horario = "INSERT INTO RecoleccionDomestica (id_usuario_domestico, id_horario_recoleccion) VALUES ('$usuario_id', '$horario_recoleccion')";
                $conn->query($sql_horario);
            } else {
                echo "No se recibió el horario de recolección.";
            }

            echo "Datos domésticos guardados exitosamente.";
        } else {
            echo "Error: " . $sql_domestico . "<br>" . $conn->error;
        }

    } elseif ($tipo == '2') {  // Comercial
        // Asegúrate de que estas variables están definidas
        $razon_social = $_POST['razon_social'] ?? '';  // Solo para tipo comercial

        // Insertar datos en la tabla EstablecimientoComercial
        $sql_comercial = "INSERT INTO establecimientocomercial (razon_social, nit, direccion, barrio, id_municipio, horario_operacion, nombre_contacto, cedula_contacto, correo_contacto)
        VALUES ('$razon_social', '$nit', '$direccion_comercial', '$barrio_comercial', '$municipio_comercial', '$horario_operacional', '$nombre_contacto_comercial', '$numero_cedula_comercial', '$correo_comercial')";


        if ($conn->query($sql_comercial) === TRUE) {
            $comercial_id = $conn->insert_id;
            echo "Valor de comercio: " . $comercial_id;

            // Insertar tipos de residuos
            foreach ($_POST['tipos_residuos'] as $tipo_residuo) {
                $sql_residuos_comercial = "INSERT INTO ResiduosComerciales (id_establecimiento_comercial, id_tipo_residuo) VALUES ('$comercial_id', '$tipo_residuo')";
                $conn->query($sql_residuos_comercial);
            }

            // Insertar horario de recolección
            $horario_recoleccion = $_POST['horario_recoleccion'] ?? ''; // Asegúrate de que este campo se está enviando correctamente
            if ($horario_recoleccion) {
                $sql_horario_comercial = "INSERT INTO RecoleccionComercial (id_establecimiento_comercial, id_horario_recoleccion) VALUES ('$comercial_id', '$horario_recoleccion')";
                $conn->query($sql_horario_comercial);
            } else {
                echo "No se recibió el horario de operación.";
            }

            echo "Datos comerciales guardados exitosamente.";
        } else {
            echo "Error: " . $sql_comercial . "<br>" . $conn->error;
        }
    }

    $conn->close();
    header("Location: success.php?status=success");
} else {
    header("Location: success.php?status=error");
}
?>