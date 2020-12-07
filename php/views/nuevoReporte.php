<?php 
    require_once '../databaseconect.php';
    $sql = "SELECT idMunicipio, Nombre FROM Municipios;"; 
    $sqlMunicipios = $connection->query($sql);
?>

<?php 
    require_once '../includes/head.php';
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
            <h2>NUEVO<strong>-REPORTE</strong></h2>
            <a href="./reporte.php?action=editar"><button id="editBtn" class="btn btn-primary">
                <i class="fas fa-edit"></i> Registrar Reporte</button></a>
        </div>

        <form action="./data.php" method="post" class="flex-container detail-report" id="newReportForm">
            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="municipios">Municipio</label>
                    <select id="municipios" name="municipios" required>
                        <option value="0" selected disabled> --Seleccione-- </option>
                        <?php while($row = $sqlMunicipios->fetch_assoc()) { ?>
                            <option value="<?php echo $row['idMunicipio']; ?>"> <?php echo $row['Nombre']; ?> </option>
                        <?php }?>
                    </select>
                </div>
                <div class="site">
                    <label for="ciudades">Ciudad</label>
                    <select id="ciudades" name="ciudades">
                        
                    </select>
                </div>
            </div>
            <label for="direccion">Dirección</label>
            <input type="text"  id="direccion"  autocomplete="off" placeholder="Calle 1 #numero entre calle 2 y calle 3"  name="direccion" required>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" placeholder="Agrega la descripción del reporte" form="newReportForm" name="descripcion"></textarea>

            <button type="submit" id="enviarRepo" class="btn btn-primary actualizar-Btn">Enviar</button>
        </form>
    </main>
    <script src="../../js/report-ctrl.js"></script>

<?php include '../includes/footer.php' ?>