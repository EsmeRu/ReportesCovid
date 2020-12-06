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
            <form id="formLogIn" class="content">
                <label for="email"><b>Email</b></label>
                <input autocomplete="off" id="email" type="email" placeholder="@ejemplo.com" name="email" required>
    
                <label for="psw"><b>Password</b></label>
                <input autocomplete="off" id="passwordLogIn" type="password" placeholder="Enter Password" name="psw" required>
                    
                <a id="signIn" href="#">Sign Up</a>
    
                <button id="submitLog" type="submit">Login</button>
            </form>

            <form id="formSigIn" class="content hidden">
                <label for="name"><b>Nombre Completo</b></label>
                <input type="text" autocomplete="off" id="name" placeholder="Nombre Apellido" name="name" required>

                <label for="email"><b>Email</b></label>
                <input autocomplete="off" id="emailSign" type="email" placeholder="correo@ejemplo.com" name="email" required>
    
                <label for="psw"><b>Password</b></label>
                <input autocomplete="off" id="passwordSignIn" type="password" placeholder="Enter Password" name="psw" required>

                <label for="psw"><b>Confirm Password</b></label>
                <input autocomplete="off" id="confirmPassword" type="password" placeholder="Confirm Password" name="psw" required>
                    
                <a id="logIn" href="#">Log in</a>
    
                <button id="submitSig" type="submit">Sign In</button>
            </form>

        </div>
        
    </div>
    <script src="../../js/user.js"></script>

</body>
</html>