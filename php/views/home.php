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
                                <?php
                                    $sql = mysqli_query($connection, "SELECT NombreCliente, NombreMunicipio, NombreCiudad, Dirección, Fecha, StatusRepo, idReporte FROM Reportes");
                                    if(mysqli_num_rows($sql) == 0){
                                        echo '<td>No has hecho ningún reporte.</td>';
                                    }else{
                                        while($row = mysqli_fetch_assoc($sql)){
                                            echo '
                                            <tr class="tr-shadow">
                                                <td>'.$row['NombreCliente'].'</td>
                                                <td>'.$row['NombreMunicipio'].'</td>
                                                <td>'.$row['NombreCiudad'].'</td>
                                                <td>'.$row['Dirección'].'</td>
                                                <td>'.$row['Fecha'].'</td>
                                                <td>'.$row['StatusRepo'].'</td>
                                                <td >
                                                    <div class="flex-container" style="justify-content: space-evenly;">
                                                        <a class="item" title="eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        <a href="./reporte.php?action=ver&id='.$row['idReporte'].'" class="item" title="Más">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr> 
                                            ';
                                        }
                                    }
                                ?>                                                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
                <!-- END DATA TABLE-->


    <?php require_once '../includes/footer.php';?>