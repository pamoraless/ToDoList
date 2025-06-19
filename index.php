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
    <title>Bienvenido - Tareas</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="pagina-index">
    <h2> Bienvenido a la Lista de Tareas</h2>

    <!--Formulario de Registro -->
   
    <form action="manejousuarios/registro.php" method="post">
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
    <form action="manejousuarios/login.php" method="post">
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
    <form action ="manejousuarios/modo_invitado.php"  method="post">
        <button type="submit" class="btn-invitado">Entrar como invitado</button>
    </form>
    <footer style="background-color: #f2f2f2; text-align: center; padding: 15px; margin-top: 30px;"> <!-- seria nuestro cuadro donde aparecerian nuestros nombres-->
        <p>Equipo: <br> Erick Mauricio Artega Velázquez, Paola Alejandra Morales García, Miguel Ángel Ramírez Aguilar, Manuel Antonio Gutierrez López</p>
    </footer>
</body>
</html>