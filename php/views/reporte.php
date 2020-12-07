<?php
require_once '../includes/head.php';
$action = $_GET['action'];
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    
    
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <form action="data.php" method="post" class="flex-container detail-report">

            <div class="flex-container jc-c" style="width: 100%; margin-top: 3rem;">
                <h2>DETALLES<strong>-REPORTE</strong></h2>
                    <button id="editBtn" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar Reporte</button>
            </div>

            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="municipios">Municipio</label>
                    <select id="municipios" name="municipio" <?
                        if(isset($action)) {
                            if($action == "ver")
                                echo "disabled";
                        }
                    ?>>
                        <option value=""> --Seleccione-- </option>
                        <option value="1">La Paz</option>
                        <option value="2">Los Cabos</option>
                        <option value="3">Loreto</option>
                    </select>
                </div>
                <div class="site">
                    <label for="ciudades">Ciudad</label>
                    <select id="ciudades" name="ciudad" disabled>
                        <option value="" disabled> --Seleccione-- </option>
                        <option value="1" selected>La Paz</option>
                        <option value="2">Los Cabos</option>
                        <option value="3">Loreto</option>
                    </select>
                </div>
            </div>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" required disabled>

            <label for="fechaReporte">Fecha de reporte</label>
            <input type="date" name="fechaReporte" id="" disabled>

            <label for="status">Status</label>
            <input type="text" name="status" disabled value="Procesado">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Agrega la descripción del reporte" disabled></textarea>

            <button type="submit" id="addBtn" class="btn btn-primary actualizar-Btn">Enviar</button>
        </form>
    </main>

    <?php require_once '../includes/footer.php';?>