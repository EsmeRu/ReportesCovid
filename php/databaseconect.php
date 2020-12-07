<?php 
    $serverName = "localhost";
    $dataBase = "ReportesCOVID";
    $userName = "root";
    $password = "yoloswag30";

    $connection = mysqli_connect($serverName, $userName, $password, $dataBase);

    if(!$connection){
        die("Conexion fallida: " . mysqli_connect_error());
    }
    
?>