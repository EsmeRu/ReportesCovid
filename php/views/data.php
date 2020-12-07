<?php
require_once '../includes/head.php';
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    <section>
    <h2>Registro</h2>

        <?php if(isset($_POST['submit'])): 
            

            ?>
            
            <pre>
                <?php $datosPersonales = $_POST; ?>

                <?php var_dump($datosPersonales);  ?>
            </pre>
        <?php endif; ?>
    </section>

    </body>
</html>