<?php
    require_once '../includes/head.php';
    require '../databaseconect.php';

    if(isset($_SESSION['Type'])){
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
            $newName = $_POST['name'];
            $newEmail = $_POST['email'];
            $newPassword = $_POST['password'];

            $sql = "CALL ActualizarCliente(?,?,?,?)";
            $statement = $connection->prepare($sql);
            $statement->bind_param('isss',$_SESSION['Id'],$newName,$newEmail,$newPassword);
            $statement->execute();

            $_SESSION['Nombre'] = $newName;
            $_SESSION['Email'] = $newEmail;
            $_SESSION['Contraseña'] = $newPassword;
        }
    }
?>

</head>
<body>
    <?php require_once '../includes/nav.php';?>
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <div class="flex-container jc-c titleButton">
            <h2><strong>Datos Actualizados</strong></h2>
            <a href="./home.php"><button id="editBtn" class="btn btn-primary">
            <i class="fas fa-edit"></i> Regresar a inicio</button></a>
        </div>
    </main>
    <script src="../../js/report-ctrl.js"></script>

<?php include '../includes/footer.php' ?>