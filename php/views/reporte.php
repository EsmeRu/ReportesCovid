<?php
    require_once '../includes/head.php';
    $action = $_GET['action'];
    require_once '../databaseconect.php';
    $sql = "SELECT idMunicipio, Nombre FROM Municipios;"; 
    $sqlMunicipios = $connection->query($sql);
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
            <a href="./reporte.php?action=editar"><button id="editBtn" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar Reporte</button></a>
        </div>

        <form action="data.php" method="post" class="flex-container detail-report">
            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="municipios">Municipio</label>
                    <select id="municipios" name="municipio">
                        <?php while($row = $sqlMunicipios->fetch_assoc()) { ?>
                            <option value="<?php echo $row['idMunicipio']; ?>"> <?php echo $row['Nombre']; ?> </option>
                        <?php }?>
                    </select>
                </div>
                <div class="site">
                    <label for="ciudades">Ciudad</label>
                    <select id="ciudades" name="ciudad">
                        <option value="" selected disabled> --Seleccione-- </option>
                        <option value="1" >La Paz</option>
                        <option value="2">Los Cabos</option>
                        <option value="3">Loreto</option>
                    </select>
                </div>
            </div>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" required>

            <label for="fechaReporte">Fecha de reporte</label>
            <input type="date" name="fechaReporte" id="fechaReporte">

            <label for="status">Status</label>
            <input type="text" name="status" value="Procesado" disabled>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Agrega la descripción del reporte"></textarea>

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