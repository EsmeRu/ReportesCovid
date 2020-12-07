<?php
require_once '../includes/head.php';
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>


    <main class="detail-report-container" style="margin-bottom: 3rem;">

        <div class="flex-container jc-c titleButton">
            <h2>DETALLES<strong>-CUENTA</strong></h2>
                <button id="addBtn" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar Cuenta</button>
        </div>

        <form action="" method="post" class="flex-container detail-report">

            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="name">Nombre</label>
                    <input type="text" name="nombre" id="name" required>
                </div>
                <div class="site">
                    <label for="lastname">Apellido</label>
                    <input type="text" name="apellido" id="lastname" required>
                </div>
            </div>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="correo" id="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="contraseña" id="password" required>

            <button type="submit" id="addBtn" class="btn btn-primary actualizar-Btn">Actualizar</button>
        </form>
    </main>

    <?php require_once '../includes/footer.php';?>