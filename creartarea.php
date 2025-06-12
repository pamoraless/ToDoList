<?php
    require 'conexion.php';

    //Se verifica que el formulario haya sido enviado 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $descripcion = $_POST['descripcion'] ?? '';
        $completada = $_POST['completada'] ?? '';

        $sql = "INSERT INTO tarea (descripcion, completada) VALUES ('$descripcion','$completada')";

        if($mysqli->query($sql) == TRUE){

        }else{
            echo "No se realizo la conexion";
        }
    }else{
        echo "No se recibieron los datos";
    }





?>