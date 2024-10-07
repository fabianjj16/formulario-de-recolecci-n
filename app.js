document.getElementById('residuoForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const tipo = document.getElementById('tipo').value;
    const descripcion = document.getElementById('descripcion').value;
    const volumen = document.getElementById('volumen').value;
    const fecha = document.getElementById('fecha').value;

    // Crear el objeto con los datos
    const data = {
        tipo: tipo,
        descripcion: descripcion,
        volumen: volumen,
        fecha: fecha
    };

    // Enviar los datos al servidor usando fetch
    fetch('server.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('message').textContent = 'Datos enviados con éxito';
    })
    .catch((error) => {
        console.error('Error:', error);
        document.getElementById('message').textContent = 'Ocurrió un error al enviar los datos';
    });

    document.getElementById('puntoRecoleccionForm').addEventListener('submit', function (event) {
        event.preventDefault();
    
        const ubicacion = document.getElementById('ubicacion').value;
        const tipo_punto = document.getElementById('tipo_punto').value;
        const capacidad = document.getElementById('capacidad').value;
        const horario_recoleccion = document.getElementById('horario_recoleccion').value;
    
        const data = {
            ubicacion: ubicacion,
            tipo_punto: tipo_punto,
            capacidad: capacidad,
            horario_recoleccion: horario_recoleccion
        };
    
        fetch('server.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            alert('Datos guardados con éxito');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });


});document.getElementById('vehiculoRecoleccionForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Obtener los datos del formulario
    const identificacion = document.getElementById('identificacion').value;
    const tipo_vehiculo = document.getElementById('tipo_vehiculo').value;
    const capacidad_carga = document.getElementById('capacidad_carga').value;
    const estado_vehiculo = document.getElementById('estado_vehiculo').value;

    // Crear el objeto con los datos
    const data = {
        identificacion: identificacion,
        tipo_vehiculo: tipo_vehiculo,
        capacidad_carga: capacidad_carga,
        estado_vehiculo: estado_vehiculo
    };

    // Enviar los datos al servidor usando fetch
    fetch('vehiculo_server.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),  // Convertir el objeto en JSON
    })
    .then(response => response.json())  // Convertir la respuesta en JSON
    .then(data => {
        document.getElementById('vehiculoMessage').textContent = data.message;
    })
    .catch((error) => {
        console.error('Error:', error);
        document.getElementById('vehiculoMessage').textContent = 'Error al enviar los datos';
    });
});