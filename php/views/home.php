<?php
require_once '../includes/head.php';
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    <!-- DATA TABLE-->
    <section class="mg-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-container jc-c">
                        <h2>REPORTES<strong>-ENVIADOS</strong></h2>
                        <a href="./reporte.php"><button id="addBtn" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Agregar Reporte</button></a>
                    </div>
                    
                    <div class="mg-top report-t">
                        <table class="table">
                            <thead>
                                <tr class="fixed-th">
                                    <th>Municipio</th>
                                    <th>Ciudad</th>
                                    <th>Dirección</th>
                                    <th>Fecha de reporte</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    <td>La Paz</td>
                                    <td>
                                        La Paz
                                    </td>
                                    <td>
                                        Col. Pueblo Nuevo
                                    </td>
                                    <td>
                                        12/12/2020
                                    </td>
                                    <td>
                                        <span class="status">Procesado</span>
                                    </td>
                                    <td >
                                        <div class="flex-container" style="justify-content: space-evenly;">
                                            <a href="./reporte.php" class="item" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="item" title="ocultar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="./reporte.php" class="item" title="Ver">
                                            <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>                                                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
                <!-- END DATA TABLE-->


    <?php require_once '../includes/footer.php';?>