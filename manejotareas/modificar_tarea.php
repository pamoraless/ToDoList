<?php
session_start();
require '../conexion.php';

$id = $_POST['id'] ?? '';
$nueva_descripcion = $_POST['nueva_descripcion'] ?? '';
$mensaje = "";

if ($id !== '' && $nueva_descripcion !== '') {
    $stmt = $conn->prepare("UPDATE tareas SET descripcion = ? WHERE id = ?");
    $stmt->bind_param("si", $nueva_descripcion, $id);

    if ($stmt->execute()) {
        $mensaje = "Descripción actualizada correctamente.";
        header("Location: ../visualizadortareas.php");
    } else {
        $mensaje = "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}
?>


