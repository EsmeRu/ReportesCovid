<?php
    require_once '../databaseconect.php';
    require_once '../includes/head.php';
    $action = $_GET['action'];
    $idReporte = $_GET['id'];

    $sql = "SELECT idMunicipio, Nombre FROM Municipios;"; 
    $sqlMunicipios = $connection->query($sql);
    $sql = "SELECT * FROM Reportes WHERE idReporte = ?;";
    $sqlReporte = $connection->prepare($sql);
    $sqlReporte->bind_param('i',$idReporte);
    $sqlReporte->execute();

    $datosReporte = $sqlReporte->get_result()->fetch_assoc();
?>

<script languaje="javascript"> 
        $(document).ready(function(){            
            $("#municipios").change(function(){
                $("#municipios option:selected").each(function() {
                    idMunicipio = $(this).val();
                    idCiudad = <?php echo $datosReporte['idCiudad']; ?>;
                    $.post("../includes/getCiudades.php", {idMunicipio: idMunicipio,idCiudad:idCiudad},function(data){
                        $("#ciudades").html(data);
                    })
                })
            })
        })
    </script>
</head>
<body>
    <?php require_once '../includes/nav.php';?>
    
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <div class="flex-container jc-c titleButton">
            <h2>DETALLES<strong>-REPORTE</strong></h2>
            <?php if($_SESSION['Type'] === 'Cliente'): ?>
                <a href="./reporte.php?action=editar&id=<?php echo $idReporte?>">
                    <button id="editBtn" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar Reporte</button>
                </a>
            <?php endif;?>
        </div>

        <form action="./confirm.php" method="post" class="flex-container detail-report">
            <input type="text" name="idReporte" id="idReporte" value="<?php echo $idReporte; ?>" class="hidden">
            <?php if($_SESSION['Type'] === 'Administrador'): ?>
                <label for="Cliente">Cliente:</label>
                <input Type="text" name="Cliente" id="Cliente" value="<?php echo $datosReporte['NombreUsuario']; ?>" disabled>
            <?php endif; ?>

            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="municipios">Municipio</label>
                    <select id="municipios" name="municipios">
                        <?php while($row = $sqlMunicipios->fetch_assoc()) { ?>
                            <?php if($row['idMunicipio'] == $datosReporte['idMunicipio']): ?>
                                <option value="<?php echo $row['idMunicipio']; ?>" selected> <?php echo $row['Nombre']; ?> </option>
                            <?php else:?>
                                <option value="<?php echo $row['idMunicipio']; ?>"> <?php echo $row['Nombre']; ?> </option>
                            <?php endif;?>
                        <?php }?>
                    </select>
                </div>
                <div class="site">
                    <label for="ciudades">Ciudad</label>
                    <select id="ciudades" name="ciudades">
                        <option value="<?php echo $datosReporte['idCiudad']; ?>" selected> <?php echo $datosReporte['NombreCiudad']; ?> </option>
                    </select>
                </div>
            </div>            

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="<?php echo $datosReporte['Dirección']; ?>" required>

            <label for="fechaReporte">Fecha de reporte</label>
            <input type="date" name="fechaReporte" id="fechaReporte" value="<?php echo $datosReporte['Fecha']; ?>" disabled>
                
            <label for="status">Status</label>
            <select id="status" name="status" <?php if($_SESSION['Type'] === 'Cliente'): echo 'disabled'; endif;?>>
                <option value="Pendiente" selected>Pendiente</option>
                <option value="Confirmado">Confirmado</option>
                <option value="Rechazado">Rechazado</option>
                <option value="En proceso">En Proceso</option>
            </select>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Agrega la descripción del reporte"><?php echo $datosReporte['Descripcion']; ?></textarea>

            <button type="submit" id="confirmBtn" class="btn btn-primary actualizar-Btn">Confirmar Cambio</button>
        </form>
    </main>
    <script src="../../js/report-ctrl.js"></script>
    <?php 
        if($_SESSION['Type'] === 'Administrador' || $_GET['action'] == 'ver'){
            echo "
            <script>
              setDisabled('".$action."')
            </script>
            ";
        }         
    ?>
    <?php require_once '../includes/footer.php';?>