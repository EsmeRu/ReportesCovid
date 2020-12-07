<?php
    session_start();
    require '../databaseconect.php';

    if(!empty($_POST['emailLogIn']) && !empty($_POST['pswLogIn'])){
        $administrador = $connection->prepare("SELECT * FROM Administradores WHERE Email = ?;");
        $administrador->bind_param('s',$_POST['emailLogIn']);
        $administrador->execute();

        $resultado = $administrador->get_result()->fetch_assoc();
        if(!empty($resultado)){
            switch($resultado['idAdministrador']){
                case 1:
                    $passAdmin = $connection->prepare("SELECT AES_DECRYPT(Contraseña, 'esme') AS Contraseña FROM Administradores WHERE Email = ?;");
                break;
                case 2:
                    $passAdmin = $connection->prepare("SELECT AES_DECRYPT(Contraseña, 'chris') AS Contraseña FROM Administradores WHERE Email = ?;");
                break;
                case 3:
                    $passAdmin = $connection->prepare("SELECT AES_DECRYPT(Contraseña, 'profe') AS Contraseña FROM Administradores WHERE Email = ?;");
                break;                    
            }
            $passAdmin->bind_param('s',$_POST['emailLogIn']);
            $passAdmin->execute();
            $passDecrypt = $passAdmin->get_result()->fetch_assoc();
            if($passDecrypt['Contraseña'] == $_POST['pswLogIn']){
                $_SESSION["Type"] = "Administrador";
                $_SESSION["Id"] = $resultado['idAdministrador'];
                sleep(2);
                header('Location: ../../php/views/home.php');
            }            
        } else {
            $cliente = $connection->prepare("SELECT idCliente,Nombre, Email,AES_DECRYPT(Contraseña, 'cliente') AS Contraseña FROM Clientes WHERE Email = ?;");
            $cliente->bind_param('s',$_POST['emailLogIn']);
            $cliente->execute();

            $resultado = $cliente->get_result()->fetch_assoc();

            if(count($resultado) > 0){
                if($_POST['pswLogIn'] === $resultado['Contraseña']){            
                    $_SESSION["Type"] = "Cliente";
                    $_SESSION["Id"] = $resultado['idCliente'];
                    sleep(2);
                    header('Location: ../../php/views/home.php');
                } else {
                    echo '<script language="javascript">alert("Contraseña incorrecta");</script>';
                }
            } else {
                echo '<script language="javascript">alert("No hay un usuarior registrado con ese correo");</script>';
            }
        }
        $_SESSION["Nombre"] = $resultado['Nombre'];
        $_SESSION["Email"] = $resultado['Email'];
        $_SESSION["Contraseña"] = $resultado['Contraseña'];        
    }
?>

<?php
    require_once '../includes/head.php';
?>

<link rel="stylesheet" href="../../css/styles-log.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    
    <div class="login">        
        <div class="container">                    
            <div class="image-logo">
                <!-- <div class="back-arrow">
                    <a href="./home.php"><i class="fas fa-arrow-left"></i></a>
                </div>               -->
                <img src="../../img/logo1.png" alt="">
                <h2>Reporte<strong>-Covid</strong></h2>
            </div>
            <form id="formLogIn" class="content" method="post">
                <label for="email"><b>Email</b></label>
                <input autocomplete="off" id="email" type="email" placeholder="correo@ejemplo.com" name="emailLogIn" required>
    
                <label for="psw"><b>Password</b></label>
                <input autocomplete="off" id="passwordLogIn" type="password" placeholder="Enter Password" name="pswLogIn" required>
                    
                <a id="signUp" href="./signup.php">Sign Up</a>
    
                <button id="submitLog" type="submit">Login</button>
            </form>
        </div>        
    </div>
    <script src="../../js/user.js"></script>
</body>
</html>