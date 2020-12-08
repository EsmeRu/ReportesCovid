<?php
require_once '../databaseconect.php';

header('Content-Type: application/json');

$filter = (isset($_POST['filter']) ? strtolower($_POST['filter']) : NULL); 
$whereFilter = 'NombreMunicipio';
$sql = mysqli_query($connection, "SELECT NombreCliente, NombreMunicipio, NombreCiudad, Dirección, Fecha, StatusRepo, idReporte FROM Reportes WHERE '$whereFilter' = '$filter';");
$row = mysqli_fetch_assoc($sql);

echo json_encode($_POST['filter']);

