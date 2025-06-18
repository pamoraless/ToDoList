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
