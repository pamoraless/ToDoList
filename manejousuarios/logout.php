<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];

// Destruir la sesión por completo
session_destroy();

// Redirigir al inicio
header("Location: ../index.php");
exit();
?>
