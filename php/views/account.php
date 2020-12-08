<?php
    require_once '../databaseconect.php';
    require_once '../includes/head.php';
    $action = $_GET['action'];

    if($_SESSION['Type'] === 'Administrador'){
        $sql = "SELECT * FROM Administradores WHERE idAdministrador = ?";
    } else {
        $sql = "SELECT * FROM Clientes WHERE idCliente = ?";
    }

    $sqlstatement = $connection->prepare($sql);
    $sqlstatement->bind_param('i',$_SESSION['Id']);
    $sqlstatement->execute();

    $results = $sqlstatement->get_result()->fetch_assoc();
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    
    
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <div class="flex-container jc-c titleButton" style="width: 100%; margin-top: 3rem;">
                <h2>DETALLES<strong>-CUENTA</strong></h2>
                    <?php if($_SESSION['Type'] === 'Cliente'): ?>
                        <a href="./account.php?action=editar">
                            <button id="editBtn" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar Cuenta</button>
                        </a>
                    <?php endif; ?>
            </div>

        <form action="./update.php" method="post" class="flex-container detail-report">           

            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="<?php echo $results['Nombre']; ?>" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $results['Email']; ?>" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" value="<?php echo $results['Contraseña']; ?>" required>

            <button type="submit" id="confirmBtn" class="btn btn-primary actualizar-Btn">Confirmar Cambio</button>
        </form>
    </main>
    <script src="../../js/user-ctrl.js"></script>
    <?php 
        echo "
        <script>
          setDisabled('".$action."')
        </script>
        ";
    ?>
    <?php require_once '../includes/footer.php';?>