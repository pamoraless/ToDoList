<?php
// Lista de tareas que tenemos
$tareas = [
    ['nombre' => 'Limpiar la casa', 'completado' => true],
    ['nombre' => 'Preparar la comida', 'completado' => false],
    ['nombre' => 'Cambiar las toallas', 'completado' => false]
];

// esto lo tenemos en caso de que se haya enviado el formulario, lo que actualiza los cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($tareas as $index => $tarea) {
        $tareas[$index]['completado'] = isset($_POST['tarea'][$index]);
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
            max-width: 400px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .completado {
            text-decoration: line-through;
            color: green;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 25px; 
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Mi lista de tareas</h1> 

<form method="post">  
    <?php foreach ($tareas as $index => $tarea): ?>
        <div class="tarea">
            <label>
                <input type="checkbox" name="tarea[<?= $index ?>]" <?= $tarea['completado'] ? 'checked' : '' ?>> // esto es el que verifica si esta completado
                <span class="<?= $tarea['completado'] ? 'completado' : '' ?>">
                    <?= htmlspecialchars($tarea['nombre']) ?>
                </span>
            </label>
        </div>
    <?php endforeach; ?>

    <button type="submit">Actualizar</button> // el boton de actualizar 
</form>

</body>
</html>
