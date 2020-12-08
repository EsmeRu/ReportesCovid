<?php
    require_once '../includes/head.php';
    require '../databaseconect.php';

    if(isset($_SESSION['Id'])){
        if(!empty($_POST['municipios']) && !empty($_POST['ciudades']) && !empty($_POST['direccion']) && !empty($_POST['descripcion'])){
            $direccion = $_POST['direccion'];
            $descripcion = $_POST['descripcion'];
            $idCliente = $_SESSION['Id'];
            $idMunicipio = $_POST['municipios'];
            $idCiudad = $_POST['ciudades'];
            $sql = "CALL NuevoReporte(?, ?, ?, ?, ?);";
            $statement = $connection->prepare($sql);
            $statement->bind_param("sssss",$idCliente,$idMunicipio,$idCiudad,$direccion,$descripcion); 
            $statement->execute();
        }
    }
?>

</head>
<body>
    <?php require_once '../includes/nav.php';?>
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <div class="flex-container jc-c titleButton">
            <h2><strong>Reporte Registrado</strong></h2>
            <a href="./home.php"><button id="editBtn" class="btn btn-primary">
            <i class="fas fa-edit"></i> Regresar a inicio</button></a>
        </div>
    </main>
    <script src="../../js/report-ctrl.js"></script>

<?php include '../includes/footer.php' ?>