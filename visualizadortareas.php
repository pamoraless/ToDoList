<?php
require 'conexion.php';
session_start();

/*var_dump($_SESSION);
exit();*/

if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['es_invitado'])) {
    header("Location: index.php");
    exit();
}
 
$usuario_id = $_SESSION['id_usuario'] ?? null;
$es_invitado = isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'invitado';

// ejemplo de la lista de tareas 0,1
/*$tareas = [
    ['id' => 1, 'nombre' => 'Limpiar la casa', 'completado' => true],
    ['id' => 2, 'nombre' => 'Preparar la comida', 'completado' => false],
    ['id' => 3, 'nombre' => 'Cambiar las toallas', 'completado' => false]
];
*/
//obtener tareas de la base de datos
$tareas = [];
if ($es_invitado) {
    // Si es invitado, mostrar todas las tareas
    $query = "SELECT id, descripcion, completada FROM tareas WHERE usuario_id IS NULL ORDER BY completada ASC, id DESC";
    $stmt = $conn->prepare($query);
} else {
    // Si es usuario registrado, filtrar por su id
    $query = "SELECT id, descripcion, completada FROM tareas WHERE usuario_id = ? ORDER BY completada ASC, id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
}
$stmt->execute();
$resultado = $stmt->get_result();

$tareas_pendientes = [];
$tareas_completadas = [];

    while ($tarea = $resultado->fetch_assoc()) {
        if ($tarea['completada']) {
            $tareas_completadas[] = $tarea;
        } else {
            $tareas_pendientes[] = $tarea;
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
   <link rel="stylesheet" href="css/estilos.css">
   <script src="js/scripts.js" defer></script>
</head>
<body class="pagina-visualizador">
<?php if (isset($_SESSION['usuario'])): ?>
    <form action="manejousuarios/logout.php" method="post" style="text-align: right; margin-bottom: 15px;">
        <button type="submit">Cerrar sesión</button>
    </form>
<?php endif; ?>

<h1>Mi lista de tareas</h1>

<!-- Formulario para crear nueva tarea -->
<form action="manejotareas/creartarea.php" method="post" style="text-align: center; margin-bottom: 30px;">
    <input type="text" name="descripcion" placeholder="Nueva tarea" required>
    <button type="submit">Agregar</button>
</form>

<!-- Tareas pendientes -->
<h2>Tareas pendientes</h2>
<?php if (count($tareas_pendientes) > 0): ?>
    <?php foreach ($tareas_pendientes as $tarea): ?>
        <div class="tarea">
            <div>
                <!-- Formulario para marcar como completado -->
                <form class="inline" action="manejotareas/tareacompletada.php" method="get">
                    <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                    <input type="checkbox" onchange="this.form.submit()" <?= $tarea['completada'] ? 'checked' : '' ?>>
                </form>

                <!-- Mostrar nombre -->
                <span class="<?= $tarea['completada'] ? 'completada' : '' ?>">
                    <?= htmlspecialchars($tarea['descripcion']) ?>
                </span>
            </div>

            <!-- Botón para eliminar -->
            <form class="inline" action="manejotareas/eliminartarea.php" method="get" onsubmit="return confirm('¿Eliminar esta tarea?');">
                <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                <button type="submit">🗑️</button>
            </form>

            <!-- Botón para modificar -->
            <form class="inline" action="manejotareas/modificar_tarea.php" method="post">
                <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                <input type="text" name="nueva_descripcion" placeholder="Nuevo nombre" required>
                <button type="submit">✏️</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align: center;">No hay tareas pendientes.</p>
<?php endif; ?>

<!-- Botón para mostrar/ocultar tareas completadas -->
<button id="btn-toggle" class="toggle-btn" onclick="toggleCompletadas()">Ocultar tareas completadas</button>

<!-- Tareas completadas -->
<div id="tareas-completadas">
    <h2>Tareas completadas</h2>
    <?php if (count($tareas_completadas) > 0): ?>
        <?php foreach ($tareas_completadas as $tarea): ?>
            <div class="tarea">
                <div>
                    <!-- Checkbox ya marcado -->
                    <form class="inline" action="manejotareas/descompletartarea.php" method="get">
                    <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                    <input type="checkbox" onchange="this.form.submit()" <?= $tarea['completada'] ? 'checked' : '' ?>>
                </form>
                    <span class="completado"><?= htmlspecialchars($tarea['descripcion']) ?></span>
                </div>

                <!-- Eliminar -->
                <form class="inline" action="manejotareas/eliminartarea.php" method="get" onsubmit="return confirm('¿Eliminar esta tarea?');">
                    <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                    <button type="submit">🗑️</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center;">No hay tareas completadas.</p>
    <?php endif; ?>
</div>

</body>
</html>
