<?php
require_once '../includes/head.php';
?>
</head>
<body>   
<?php require_once '../includes/nav.php';?>
<?php require_once '../databaseconect.php';?>
    <!-- DATA TABLE-->
    <section class="mg-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-container jc-c">
                        <h2>REPORTES<strong>-ENVIADOS</strong></h2>
                        <a href="./reporte.php?action=agregar"><button id="addBtn" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Agregar Reporte</button></a>
                    </div>
                    
                    <?php
                        $elementos = array('Nombre','Municipio','Ciudad','Dirección','Fecha de reporte','Status')
                    ?>

                    <div class="mg-top report-t">
                        <table class="table">
                            <thead>
                                <tr class="fixed-th">
                                <?php foreach($elementos as $elemento): ?>
                                    <th><?php echo $elemento; ?></th>
                                <?php endforeach; ?>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    <td>
                                        Usuario Logueado
                                    </td>
                                    <td>
                                        La Paz
                                    </td>
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
                                            <a class="item" title="eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="./reporte.php?action=ver&id=4" class="item" title="Más">
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