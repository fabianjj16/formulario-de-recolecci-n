document.getElementById("residuoForm").addEventListener("submit", function(event) {
    var formValid = true;

    var inputs = document.querySelectorAll("#residuoForm input, #residuoForm select, #residuoForm textarea");
    inputs.forEach(function(input) {
        if (input.value === "" && !input.disabled) {  // Revisar solo campos habilitados
            formValid = false;
            input.classList.add("error");
        } else {
            input.classList.remove("error");
        }
    });

    if (!formValid) {
        event.preventDefault();
        document.getElementById("message").innerText = "Por favor, completa todos los campos.";
    }
});

function mostrarDatos() {
    const tipoSeleccionado = document.getElementById("tipo").value;
    const datosDomestico = document.getElementById("datos-domestico");
    const datosComercial = document.getElementById("datos-comercial");
    const datosGenerales = document.getElementById("datos");

    if (tipoSeleccionado === "1") { // Doméstico
        datosDomestico.style.display = "block";
        datosComercial.style.display = "none";
        datosGenerales.style.display = "block";  // Mostrar el contenedor general

        habilitarCampos('datos-domestico');
        deshabilitarCampos('datos-comercial');
    } else if (tipoSeleccionado === "2") { // Comercial
        datosDomestico.style.display = "none";
        datosComercial.style.display = "block";
        datosGenerales.style.display = "block";  // Mostrar el contenedor general

        habilitarCampos('datos-comercial');
        deshabilitarCampos('datos-domestico');
    } else {  // Si se selecciona la opción por defecto "Seleccione el campo"
        datosDomestico.style.display = "none";
        datosComercial.style.display = "none";
        datosGenerales.style.display = "none";  // Ocultar todo el contenedor general

        deshabilitarCampos('datos-domestico');
        deshabilitarCampos('datos-comercial');
    }
}

function habilitarCampos(id) {
    const inputs = document.querySelectorAll(`#${id} input, #${id} select`);
    inputs.forEach(input => input.removeAttribute('disabled'));
}

function deshabilitarCampos(id) {
    const inputs = document.querySelectorAll(`#${id} input, #${id} select`);
    inputs.forEach(input => input.setAttribute('disabled', 'disabled'));
}

// Ejecutar mostrarDatos al cargar la página para que se muestre el estado correcto
window.onload = mostrarDatos;
