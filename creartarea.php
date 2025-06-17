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
        if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['es_invitado'])) {
            header("Location: index.php");
            exit();
        }

        $usuario_id = $_SESSION['id_usuario'];
        
        // Si es invitado, guardar sin usuario_id
        $es_invitado = ($_SESSION['usuario'] === 'invitado');

        if ($es_invitado) {
            $stmt = $conn->prepare("INSERT INTO tareas (descripcion, completada) VALUES (?, ?)");
            $stmt->bind_param("si", $descripcion, $completada);
        } else {
            $usuario_id = $_SESSION['id_usuario'] ?? null;
            if (!$usuario_id) {
                echo "Usuario no válido.";
                exit();
            }
    
            $stmt = $conn->prepare("INSERT INTO tareas (descripcion, completada, usuario_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $descripcion, $completada, $usuario_id);
        }
    
        if ($stmt->execute()) {
            header("Location: visualizadortareas.php");
            exit();
        } else {
            echo "Error al agregar la tarea.";
        }
    }
?>