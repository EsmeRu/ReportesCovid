<?php
    require '../databaseconect.php';
    $idMunicipio = $_POST['idMunicipio'];

    $queryCiudades = "SELECT idCiudad, Nombre FROM Ciudades WHERE idMunicipio = '$idMunicipio'";
    $resultadoCiudades = $connection->query($queryCiudades);
    $idCiudad = 0;
    if(!empty($_POST['idCiudad'])){
        $idCiudad = $_POST['idCiudad'];
    }
    $html = "<option value='' disabled selected> --Seleccione-- </option>";
    while($row = $resultadoCiudades->fetch_assoc()){
        if($idCiudad === $row['idCiudad']){
            $html .= "<option value='".$row['idCiudad']."' selected>" .$row['Nombre']."</option>";
        } else {
            $html .= "<option value='".$row['idCiudad']."'>" .$row['Nombre']."</option>";
        }
        
    }
    echo $html;
?>