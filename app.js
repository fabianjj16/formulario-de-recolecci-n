document.getElementById("residuoForm").addEventListener("submit", function(event) {
    var formValid = true;

    var inputs = document.querySelectorAll("#residuoForm input, #residuoForm select, #residuoForm textarea");
    inputs.forEach(function(input) {
        if (input.value === "") {
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
