<?php
    if(!isset($_SESSION['Type'])){
        session_start(); 
    }    
?>
<header class="flex-container">
    <div class="logo-container">
        <a href="../views/home.php"><img src="../../img/logo.png" alt=""></a>
    </div>

    <div class="user flex-container">
        <div class="flex-container">
            <img src="../../img/incognito.png" alt="" style="width: 30px;">
        </div>

        <div class="dropdown" style="float:right;">
            <button onclick="myFunction()" class="dropbtn" style="outline: none;"><?php echo $_SESSION['Type']?></button>

            <div id="myDropdown" class="dropdown-content">
                <div class="flex-container user-info">
                    
                    <div class="user">
                        <img src="../../img/incognito.png" alt="" />
                    </div>

                    <div class="user">
                        <p class="name"><?php echo $_SESSION['Nombre']; ?></p>
                        <span class="email"><?php echo $_SESSION["Email"]; ?> </span>
                    </div>

                </div>
                <a href="../views/home.php">Reportes</a>
                <a href="../views/account.php?action=ver">Cuenta</a>
                <div class="">
                    <a href="../views/login.php?cerrar_sesion=true" class="account-dropdown__footer">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
    }
</script>

