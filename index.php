<?php
 
 session_start();
//var_dump($_SESSION);
//exit();
 /*Manejo de errores*/
 $registro_error = $_SESSION['registro_error'] ?? '';
 unset($_SESSION['registro_error']);

 $login_error = $_SESSION['login_error'] ?? '';
 unset($_SESSION['login_error']);

// Si ya está logeado o es invitado, se redirige al visualizadortareas.php
if ((isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) || (isset($_SESSION['es_invitado']) && $_SESSION['es_invitado'] === true)){
    header("Location: visualizadortareas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Bienvenido - Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 40px auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
        }
        form {
            background: white;
            padding: 15px;
            margin-bottom: 20px;         
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 8px;
            margin: 6px 0 12px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color:white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .btn-invitado {
            background-color: #28a745;
            margin-top: 10px;
        }
        .btn-invitado:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <h2> Bienvenido a la Lista de Tareas</h2>

    <!--Formulario de Registro -->
   
    <form action="registro.php" method="post">
        <h3>Registarse</h3>
        <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required />
        <input type="password" name="contrasena" placeholder="Contraseña" required />
        <button type="submit">Crear cuenta</button>
    </form>
   
    <?php if(!empty($registro_error)): ?>
        <div style="color: red; text-align: center; margin-bottom: 15px;">
            <?= htmlspecialchars($registro_error) ?>
        </div>
    <?php endif; ?>

    <!-- Formulario de Inicio de Sesión -->
    <form action="login.php" method="post">
        <h3>Iniciar sesión</h3>
        <input type="text" name="nombre_usuario" placeholder="Nombre de Usuario" required />
        <input type="password" name="contrasena" placeholder="Contraseña" required />
        <button type="submit">Entrar</button>
    </form>

    <?php if(!empty($login_error)): ?>
        <div style="color: red; text-align: center; margin-bottom: 15px;">
            <?= htmlspecialchars($login_error) ?>
        </div>
    <?php endif; ?>

    <!--Botón para modo invitado -->
    <form action ="modo_invitado.php"  method="post">
        <button type="submit" class="btn-invitado">Entrar como invitado</button>
    </form>
    
</body>
</html>