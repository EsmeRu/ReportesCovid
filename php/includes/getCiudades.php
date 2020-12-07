<?php
    require '../databaseconect.php';
    $idMunicipio = $_POST['idMunicipio'];

    $queryCiudades = "SELECT idCiudad, Nombre FROM Ciudades WHERE idMunicipio = '$idMunicipio'";
    $resultadoCiudades = $connection->query($queryCiudades);

    $html = "<option value='' selected disabled> --Seleccione-- </option>";
    while($row = $resultadoCiudades->fetch_assoc()){
        $html .= "<option value='".$row['idCiudad']."'>" .$row['Nombre']."</option>";
    }
    echo $html;
?>