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
                        <?php if(isset($_SESSION['Type'])): ?>
                            <?php if($_SESSION['Type'] == 'Administrador'):?>
                                <h2>REPORTES<strong>-RECIBIDOS</strong></h2>
                            <?php else: ?>
                                <h2>REPORTES<strong>-ENVIADOS</strong></h2>
                                <a href="./nuevoReporte.php?action=agregar"><button id="addBtn" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i> Agregar Reporte</button></a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['Type'])): ?>
                            <?php if($_SESSION['Type'] == 'Cliente'):?>
                                
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="mg-top">

                        <form class="flex-container form-filter">
                            <div class="flex-container">
                                <select id="filtro_municipio" class="custom-select my-1 mr-sm-2">
                                <option value="" selected disabled> --Municipio-- </option>
                                <?php
                                    $sql = mysqli_query($connection, "SELECT Nombre FROM Municipios");
                                    while($row = mysqli_fetch_assoc($sql)){
                                        echo '
                                        >
                                        <option value="'.$row['Nombre'].'" >'.$row['Nombre'].'</option>
                                        ';
                                    }   
                                ?>
                                </select>
                                <select id="filtro_ciudad" class="custom-select my-1 mr-sm-2">
                                <option value="" selected disabled> --Ciudad-- </option>
                                <?php
                                    $sql = mysqli_query($connection, "SELECT Nombre FROM Ciudades");
                                    while($row = mysqli_fetch_assoc($sql)){
                                        echo '
                                        >
                                        <option value="'.$row['Nombre'].'" >'.$row['Nombre'].'</option>
                                        ';
                                    }   
                                ?>
                                </select>
                                <select id="filtro_estatus" class="custom-select my-1 mr-sm-2">
                                    <option value="" selected disabled> --Estatus-- </option>
                                    <option value="En proceso" > En proceso </option>
                                    <option value="Confirmado" > Confirmado </option>
                                    <option value="Rechazado" > Rechazado </option>
                                    <option value="Rechazado" > Pendiente </option>
                                </select>
                            </div>
                            <button type="submit" id="btnFiltro" class="btn btn-primary my-1">Filtrar</button>
                        </form>
                     <div class="report-t">             
                        <table class="table">
                            <thead>
                                <tr>
                                <?php 
                                    $elementos = array('Nombre','Municipio','Ciudad','Dirección','Fecha de reporte','Status');
                                    foreach($elementos as $elemento): 
                                ?>
                                    <th><?php echo $elemento; ?></th>
                                <?php endforeach; ?>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tableRows">
                                <?php  
                                    if(isset($_SESSION['Type'])) {
                                        if($_SESSION['Type']=='Cliente'){
                                            $email = $_SESSION['Email'];
                                            $sql = mysqli_query($connection, "SELECT NombreCliente, NombreMunicipio, NombreCiudad, Dirección, Fecha, StatusRepo, idReporte FROM Reportes WHERE idCliente = (select idCliente from Clientes where Email = '$email');");
                                        }
                                        else {
                                            // if($filter){
                                            //     $sql = mysqli_query($connection,"SELECT NombreCliente, NombreMunicipio, NombreCiudad, Dirección, Fecha, StatusRepo, idReporte FROM Reportes WHERE '$whereFilter' = '$filter';");
                                            // }
                                            // else{
                                                $sql = mysqli_query($connection,"SELECT NombreCliente, NombreMunicipio, NombreCiudad, Dirección, Fecha, StatusRepo, idReporte FROM Reportes;");
                                            // }
                                        }                       
                                    
                                        if(mysqli_num_rows($sql) == 0){
                                            echo '<td>No hay ningún reporte.</td>';
                                        }
                                        else{
                                            while($row = mysqli_fetch_assoc($sql)){
                                                echo '
                                                <tr class="tr-shadow" >
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
                                                            <a href="./reporte.php?action=ver&id='.$row['idReporte'].'" class="item" title="Más" name="Reporte" id="'.$row['idReporte'].'">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr> 
                                                ';
                                            }   
                                        }
                                    }
                                ?>                                                      
                            </tbody>
                        </table>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../../js/filter.js"></script>                                
    <?php require_once '../includes/footer.php';?>