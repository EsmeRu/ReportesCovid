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
                    $.post("../includes/getCiudades.php", {idMunicipio: idMunicipio},function(data){
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
            <a href="./reporte.php?action=editar&id="<?php echo $idReporte?>><button id="editBtn" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar Reporte</button></a>
        </div>

        <form action="data.php" method="post" class="flex-container detail-report">
            <?php if($_SESSION['Type'] === 'Administrador'): ?>
                <label for="Cliente">Cliente:</label>
                <input Type="text" name="Cliente" id="Cliente" value="<?php echo $datosReporte['NombreCliente']; ?>" >
            <?php endif; ?>

            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="municipios">Municipio</label>
                    <select id="municipios" name="municipios">
                        <?php while($row = $sqlMunicipios->fetch_assoc()) { ?>
                            <?php if($row['idMunicipio'] == $datosReporte['idMunicipio']): ?>
                                <option value="<?php echo $row['idMunicipio']; ?>" selected> <?php echo $row['Nombre']; ?> </option>
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
            <input type="date" name="fechaReporte" id="fechaReporte" value="<?php echo $datosReporte['Fecha']; ?>">

            <label for="status">Status</label>
            <input type="text" name="status" value="<?php echo $datosReporte['StatusRepo']; ?>" disabled>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Agrega la descripción del reporte"><?php echo $datosReporte['Descripcion']; ?></textarea>

            <button type="submit" id="addBtn" class="btn btn-primary actualizar-Btn">Enviar</button>
        </form>
    </main>
    <script src="../../js/report-ctrl.js"></script>
    <?php 
        echo "
            <script>
              setDisabled('".$action."')
            </script>
        ";
    ?>
    <?php require_once '../includes/footer.php';?>