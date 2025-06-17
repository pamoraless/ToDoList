<?php
    require 'conexion.php';

    //Se verifica que el formulario haya sido enviado 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $descripcion = $_POST['descripcion'] ?? '';
        //completada es binario, es decir 0 o 1
        $completada = isset($_POST['completada']) && $_POST['completada'] == '1' ? 1 : 0;

        $sql = "INSERT INTO tareas (descripcion, completada) VALUES ('$descripcion', $completada)";

        if($conn->query($sql) == TRUE){
            header("Location: index.php");
            exit();
        }else{
            echo "No se realizo la conexion";
        }
    }else{
        echo "No se recibieron los datos";
    }

?>