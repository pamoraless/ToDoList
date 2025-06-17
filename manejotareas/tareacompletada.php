<?php
session_start();
require '../conexion.php';


if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("UPDATE tareas SET completada = 1 WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

//Agregar un mensaje de exito o fracaso

header("Location: ../visualizadortareas.php");
exit();
?>