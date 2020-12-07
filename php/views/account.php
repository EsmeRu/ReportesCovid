<?php
require_once '../includes/head.php';
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    
    
    <main class="detail-report-container" style="margin-bottom: 3rem;">
        <form action="" class="flex-container detail-report">

            <div class="flex-container jc-c" style="width: 100%; margin-top: 3rem;">
                <h2>DETALLES<strong>-CUENTA</strong></h2>
                    <button id="addBtn" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar Cuenta</button>
            </div>

            <label for="name">Nombre</label>
            <input type="text" id="name" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" required>
        </form>
    </main>

    <?php require_once '../includes/footer.php';?>