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
/*if ((isset($_SESSION['usuario']) && isset($_SESSION['id_usuario'])) || (isset($_SESSION['es_invitado']) && $_SESSION['es_invitado'] === true)){
    header("Location: visualizadortareas.php");
    //exit();
}*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Organiza tu vida - TaskFlow</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php require_once("header.php"); ?>
    
    <div class="pagina-index" style="text-align: center; padding: 40px 20px;">
        <h1 style="color: #b30000;">TaskFlow</h1>
        <p style="font-size: 1.2rem; margin-bottom: 25px;">
            Organiza tus tareas, simplifica tu día y mantén tu mente libre de pendientes.  
        </p>

        <img src="img/organiza_tareas.jpeg" alt="Organización de tareas" style="max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 30px;">

        <h3 style="color: #b30000;">¿Qué puedes hacer con TaskFlow?</h3>
        <ul style="list-style: none; padding: 0; font-size: 1rem; margin-bottom: 30px;">
            <li>✅ Añadir tareas pendientes fácilmente</li>
            <li>✅ Marcar tareas como completadas</li>
            <li>✅ Editarlas cuando cambien tus planes</li>
            <li>✅ Organizar tus pendientes en un solo lugar</li>
        </ul>

        
        <footer style="background-color: #f2f2f2; text-align: center; padding: 15px; margin-top: 30px;"> <!-- seria nuestro cuadro donde aparecerian nuestros nombres-->
            <p>Equipo: <br> Erick Mauricio Arteaga Velázquez, Paola Alejandra Morales García, Miguel Ángel Ramírez Aguilar, Manuel Antonio Gutiérrez López</p>
        </footer>
    </div>
</html>