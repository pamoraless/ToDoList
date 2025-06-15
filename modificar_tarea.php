<?php
require 'conexion.php'; // Tu archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nueva_descripcion = $_POST['nueva_descripcion'] ?? '';

    //SE USA EMPTY para asegurarnos de que los valores $id $nueva_descripcion no esten vacios
    if (!empty($id) && !empty($nueva_descripcion)) {
        // Evita inyección SQL con prepared statements
        $stmt = $mysqli->prepare("UPDATE tarea SET descripcion = ? WHERE id = ?");
        $stmt->bind_param("si", $nueva_descripcion, $id);

        if ($stmt->execute()) {
            echo "La descripción fue actualizada correctamente.";
        } else {
            echo "Error al actualizar la tarea: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID y nueva descripción son obligatorios.";
    }
} else {
    echo "No se recibieron los datos por POST.";
}
?>