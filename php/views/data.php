<?php
require_once '../includes/head.php';
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    <?php $datosPersonales = $_POST; ?>

    <?php var_dump($datosPersonales["apellido"]);  ?>

    <?php require_once '../includes/footer.php';?>