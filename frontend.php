<?php
require 'conexion.php';

//obtener tareas de la base de datos
$tareas = [];
$resultado = $conn->query("SELECT * FROM tareas ORDER BY completada ASC, id DESC");

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $tareas[] = [
            'id' => $fila['id'],
            'nombre' => $fila['descripcion'],
            'completado' => $fila['completada'] == 1
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        .tarea {
            background: white;
            padding: 15px;
            margin: 10px auto;
            border-radius: 8px;
            max-width: 500px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .completado {
            text-decoration: line-through;
            color: green;
        }
        form.inline {
            display: inline;
        }
        input[type="text"] {
            padding: 5px;
            width: 200px;
        }
        button {
            padding: 5px 10px;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<h1>Mi lista de tareas</h1>

<!-- Formulario para crear nueva tarea -->
<form action="creartarea.php" method="post" style="text-align: center; margin-bottom: 30px;">
    <input type="text" name="descripcion" placeholder="Nueva tarea" required>
    <button type="submit">Agregar</button>
</form>

<?php foreach ($tareas as $tarea): ?>
    <div class="tarea">
        <div>
            <!-- Formulario para marcar como completado -->
            <form class="inline" action="tareacompletada.php" method="get">
                <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                <input type="checkbox" onchange="this.form.submit()" <?= $tarea['completado'] ? 'checked' : '' ?>>
            </form>

            <!-- Mostrar nombre -->
            <span class="<?= $tarea['completado'] ? 'completado' : '' ?>">
                <?= htmlspecialchars($tarea['nombre']) ?>
            </span>
        </div>

        <!-- Botón para eliminar -->
        <form class="inline" action="eliminartarea.php" method="get" onsubmit="return confirm('¿Eliminar esta tarea?');">
            <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
            <button type="submit">🗑️</button>
        </form>

        <!-- Botón para modificar -->
        <form class="inline" action="modificar_tarea.php" method="post">
            <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
            <input type="text" name="nueva_descripcion" placeholder="Nuevo nombre" required>
            <button type="submit">✏️</button>
        </form>
    </div>
<?php endforeach; ?>

</body>
</html>