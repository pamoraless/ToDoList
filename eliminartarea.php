<?php
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM tareas WHERE   id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

//Agregar un mensaje de exito o fracaso

header("Location: index.php");
exit();
?>