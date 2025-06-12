<div id="app">
  <h1>To Do List</h1>
  <form id="task-form">
    <input type="text" id="task-input" placeholder="Nueva tarea" />
    <button type="submit">Agregar</button>
  </form>

  <ul id="task-list"></ul>
</div>

<?php
require 'conexion.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("UPDATE tareas SET completada = 1 WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

//Agregar un mensaje de exito o fracaso

header("Locations: index.php");
exit();
?>