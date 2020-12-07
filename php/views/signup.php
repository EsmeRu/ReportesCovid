<?php 
    require '../databaseconect.php';

    if(!empty($_POST['emailSignUp']) && !empty($_POST['nameSignUP']) && !empty($_POST['pswSingUp']) && !empty($_POST['pswConfirm'])){
        if($_POST['pswSingUp'] === $_POST['pswConfirm']){
            $nombre = $_POST['nameSignUP'];
            $email = $_POST['emailSignUp'];
            $contraseña = $_POST['pswSingUp'];

            $sql = "CALL RegistrarCliente(?, ?, ?);";
            $statement = $connection->prepare($sql);
            $statement->bind_param("sss", $nombre,$email,$contraseña);

            if($statement->execute()){
                echo '<script language="javascript">alert("Usuario creado correctamente");</script>';
            } else {
                echo '<script language="javascript">alert("Ocurrio un error al crear el usuario");</script>';
            }
        }
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

            <form id="formSigIn" class="content" method="post">
                <label for="name"><b>Nombre Completo</b></label>
                <input type="text" autocomplete="off" id="name" placeholder="Nombre Apellido" name="nameSignUP" required>

                <label for="email"><b>Email</b></label>
                <input autocomplete="off" id="emailSign" type="email" placeholder="correo@ejemplo.com" name="emailSignUp" required>
    
                <label for="psw"><b>Password</b></label>
                <input autocomplete="off" id="passwordSignIn" type="password" placeholder="Enter Password" name="pswSingUp" required>

                <label for="psw"><b>Confirm Password</b></label>
                <input autocomplete="off" id="confirmPassword" type="password" placeholder="Confirm Password" name="pswConfirm" required>
                    
                <a id="logIn" href="./login.php">Log in</a>
    
                <button id="submitSig" type="submit">Sign Up</button>
            </form>

        </div>
        
    </div>
    <?php
        $result = mysqli_query($connection,"SELECT Email FROM Clientes WHERE idCliente = 1");
    ?>
    <script src="../../js/user.js"></script>
</body>
</html>