document.addEventListener("DOMContentLoaded", function () {
    const boton = document.getElementById("btn-toggle");
    const completadas = document.getElementById("completadas");

    boton.addEventListener("click", function () {
        if (completadas.style.display === "none") {
            completadas.style.display = "block";
            boton.textContent = "Ocultar tareas completadas";
        } else {
            completadas.style.display = "none";
            boton.textContent = "Mostrar tareas completadas";
        }
    });
});

function mostrarInput(id) {
    const contenedor = document.getElementById(`form-${id}`);
    const botonLapiz = contenedor.querySelector(".boton-editar");
    const formularioDiv = contenedor.querySelector(".formulario-editar");

    botonLapiz.style.display = "none";
    formularioDiv.style.display = "block";

    const input = formularioDiv.querySelector("input[type='text']");
    input.focus();
}

function cancelarEdicion(id) {
    const contenedor = document.getElementById(`form-${id}`);
    const botonLapiz = contenedor.querySelector(".boton-editar");
    const formularioDiv = contenedor.querySelector(".formulario-editar");

    formularioDiv.style.display = "none";
    botonLapiz.style.display = "inline";

    const input = formularioDiv.querySelector("input[type='text']");
    input.value = "";
}

