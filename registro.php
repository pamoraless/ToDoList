<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['nombre_usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if (empty($usuario) || empty($contrasena)) {
        $_SESSION['registro_error'] = 'Debes completar todos los campos.';
        header("Location: index.php");
        exit();
    }

    //verificar si ya existe el usuario
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        $stmt->close();
        $_SESSION['registro_error'] = 'Ese nombre de usuario ya está en uso.';
        header("Location: index.php");
        exit();
    }

    $stmt->close();

    //encriptar contraseña
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    //insertamos nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $hash);
    if($stmt->execute()){
        //Guardamos la sesion
        $_SESSION['usuario'] = $usuario;
        header("Location: visualizadortareas.php");
        exit();
    } else {
        $_SESSION['registro_error'] = 'Error al registrar: ' . $conn->error;
        header("Location: index.php");
        exit();
    }
    
    $stmt->close();
} else {
    $_SESSION['registro_error'] = 'Acceso no permitido.';
        header("Location: index.php");
        exit();
    }
?>