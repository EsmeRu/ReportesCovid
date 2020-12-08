<?php
    require_once '../includes/head.php';
    require '../databaseconect.php';

    $idReporte = $_POST['idReporte'];

    if(isset($_SESSION['Type'])){
        if($_SESSION['Type'] == 'Administrador'){
            if(!empty($idReporte)){
                $sql = "UPDATE Reportes SET StatusRepo = ? WHERE idReporte = ?";
                $sqlStatement = $connection->prepare($sql);
                $sqlStatement->bind_param('si',$_POST['status'],$idReporte);
                $sqlStatement->execute();
            }
        } else {
            if(!empty($idReporte) && !empty($_POST['municipios']) && !empty($_POST['ciudades']) && !empty($_POST['direccion']) && !empty($_POST['descripcion'])){
                $idMunicipio = $_POST['municipios'];
                $idCiudad = $_POST['ciudades'];
                $direccion = $_POST['direccion'];
                $descripcion = $_POST['descripcion'];

                $sql = "CALL ActualizarReporte(?, ?, ?, ?, ?);";
                $Actualizar = $connection->prepare($sql);
                $Actualizar->bind_param('iiiss',$idReporte,$idMunicipio,$idCiudad,$direccion,$descripcion); 
                $Actualizar->execute();
            }
        }
    }
?>

</head>
<body>
    <?php require_once '../includes/nav.php';?>
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <div class="flex-container jc-c titleButton">
            <h2><strong>Reporte Actualizado</strong></h2>
            <a href="./home.php"><button id="editBtn" class="btn btn-primary">
            <i class="fas fa-edit"></i> Regresar a inicio</button></a>
        </div>
    </main>
    <script src="../../js/report-ctrl.js"></script>

<?php include '../includes/footer.php' ?>