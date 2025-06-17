<?php
session_start();
require '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['nombre_usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if (empty($usuario) || empty($contrasena)) {
        $_SESSION['login_error'] = 'Debes ingresar ambos campos.';
        header("Location: ../index.php");
        exit();
    }

    // Verificar si el usuario existe
    $stmt = $conn->prepare("SELECT id, contrasena FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id_usuario, $hash_guardado);
        $stmt->fetch();

        // Verificar contraseña
        if (password_verify($contrasena, $hash_guardado)) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id_usuario'] = $id_usuario;
            header("Location: ../visualizadortareas.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Contraseña incorrecta.';
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = 'El usuario no existe.';
        header("Location: ../index.php");
        exit();
    }


    $stmt->close();
} else {
    $_SESSION['login_error'] = 'Acceso no permitido.';
    header("Location: ../index.php");
    exit();
}
?>
