<?php
session_start();

// Asignar valores de invitado
$_SESSION['usuario'] = 'invitado';
$_SESSION['es_invitado'] = true;

header("Location: visualizadortareas.php");
exit();