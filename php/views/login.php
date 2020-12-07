<?php
    session_start();
    $cerrar_sesion = $_GET['cerrar_sesion'];
    if($cerrar_sesion){
        session_destroy();
    }

    require '../databaseconect.php';  

    if(!empty($_POST['emailLogIn']) && !empty($_POST['pswLogIn'])){
        $cliente = $connection->prepare("SELECT Nombre, Email,AES_DECRYPT(Contraseña, 'cliente') AS Contraseña FROM Clientes WHERE Email = '".$_POST['emailLogIn']."';");
        // $cliente->bind_param("s",$_POST['emailLogIn']);
        $cliente->execute();

        $resultado = $cliente->get_result()->fetch_assoc();
        if(!isset($_SESSION["user"])){
            session_start();
        }
        
        if(count($resultado) > 0){
            if($_POST['pswLogIn'] === $resultado['Contraseña']){
                echo '<script language="javascript">alert("Mi loco dele pa dentro");</script>';
                $_SESSION["user"] = $resultado;
                header("Location: ./home.php"); 
            } else {
                echo '<script language="javascript">alert("Ta mal la contraseña we");</script>';
            }
        } else {
            echo '<script language="javascript">alert("Ta vacio we");</script>';
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