<?php
require_once '../databaseconect.php';

header('Content-Type: application/json');


$result = array();
$whereFilter = "";
if(isset($_POST['filtro_municipio'])) {
    $filter = (isset($_POST['filtro_municipio']) ? strtolower($_POST['filtro_municipio']) : NULL); 
    $whereFilter = "WHERE NombreMunicipio = '$filter'";
}

if(isset($_POST['filtro_ciudad'])) {
    $filter = (isset($_POST['filtro_ciudad']) ? strtolower($_POST['filtro_ciudad']) : NULL);
    if(!empty($whereFilter)) {
        $whereFilter .= " AND NombreCiudad = '$filter'";
    } else {
        $whereFilter = "WHERE NombreCiudad = '$filter'";
    }
}

if(isset($_POST['filtro_estatus'])) {
    $filter = (isset($_POST['filtro_estatus']) ? strtolower($_POST['filtro_estatus']) : NULL); 
    if(!empty($whereFilter)) {
        $whereFilter .= " AND StatusRepo = '$filter'";
    } else {
        $whereFilter = "WHERE StatusRepo = '$filter'";
    }
}

$sql = mysqli_query($connection, "SELECT * FROM Reportes $whereFilter;");

while($row = mysqli_fetch_assoc($sql)) {
    array_push($result, $row);
}

// var_dump($result);
echo json_encode($result);