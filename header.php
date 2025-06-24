<?php
    //session_start();
    
?>

<div class="fondo_menu bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <?php if(empty($_SESSION['usuario'])): ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="visualizadortareas.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Precios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactanos</a>
                        </li>
                    </ul>
                    <a href="manejousuarios/login.php" class="boton">Inicia Session</a>
                    <a href="manejousuarios/registro.php" class="boton">Registrate</a>
                    <a href="manejousuarios/modo_invitado.php" class="boton">Registrate</a>
                </div>
                <?php else: ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Agregar informacion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Editar perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Session de recursos</a>
                        </li>
                    </ul>
                    <a href="manejousuarios/logout.php" class="boton">Cerrar Sesion</a>
                </div>
                <?php endif ?>
        </nav>
</div>
<div class="fondo">