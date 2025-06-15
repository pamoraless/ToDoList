<div id="app">
  <h1>To Do List</h1>
  <form id="task-form"  action = "creartarea.php" method="post">
    <input type="text" id="task-input" placeholder="Nueva tarea" id = "" />
    <button type="submit" name = "añadirtarea">Agregar</button>
  </form>

  <ul id="task-list"></ul>
</div>

<!--index para pruebas-->

<?php
include 'conexion.php';

// Obtener tareas
$sql = "SELECT * FROM tareas ORDER BY completada ASC, id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas - Versión de Prueba</title>
</head>
<body>
    <h1>Lista de Tareas</h1>

    <!-- Formulario para agregar nueva tarea -->
    <form action="creartarea.php" method="POST">
        <input type="text" name="descripcion" placeholder="Nueva tarea" required>
        <button type="submit">Agregar</button>
    </form>

    <hr>

    <!-- Mostrar tareas -->
    <?php if ($resultado->num_rows > 0): ?>
        <ul>
            <?php while ($tarea = $resultado->fetch_assoc()): ?>
                <li>
                    <?php if ($tarea['completada']): ?>
                        <s><?= htmlspecialchars($tarea['descripcion']) ?></s>
                    <?php else: ?>
                        <?= htmlspecialchars($tarea['descripcion']) ?>
                    <?php endif; ?>

                    <!-- Botones -->
                    <a href="tareacompletada.php?id=<?= $tarea['id'] ?>">[✔]</a>
                    <a href="modificar_tarea.php?id=<?= $tarea['id'] ?>">[✎]</a>
                    <a href="eliminartarea.php?id=<?= $tarea['id'] ?>">[🗑]</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No hay tareas aún.</p>
    <?php endif; ?>

</body>
</html>