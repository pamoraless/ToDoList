<?php
session_start();
//var_dump($_SESSION); 
    require 'conexion.php';

    //Se verifica que el formulario haya sido enviado 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $descripcion = $_POST['descripcion'] ?? '';
        //completada es binario, es decir 0 o 1
        $completada = isset($_POST['completada']) && $_POST['completada'] == '1' ? 1 : 0;
        
        // Verificar que el usuario está logeado
        if (!isset($_SESSION['id_usuario'])) {
        echo "No se ha iniciado sesión";
        exit();
        }

        $usuario_id = $_SESSION['id_usuario'];

        $stmt = $conn->prepare("INSERT INTO tareas (descripcion, completada, usuario_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $descripcion, $completada, $usuario_id);

        if ($stmt->execute()) {
            header("Location: visualizadortareas.php");
            exit();
        } else {
            echo "Error al agregar la tarea";
        }
    }
?>