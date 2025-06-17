function toggleCompletadas() {
    const section = document.getElementById('tareas-completadas');
    const boton = document.getElementById('btn-toggle');
    if (section.style.display === 'none') {
        section.style.display = 'block';
        boton.textContent = 'Ocultar tareas completadas';
    } else {
        section.style.display = 'none';
        boton.textContent = 'Mostrar tareas completadas';
    }
}