<?php
require_once '../includes/head.php';
?>
</head>
<body>
    <?php require_once '../includes/nav.php';?>

    
    
    <main class="detail-report-container" style="margin-bottom: 5rem;">
        <form action="" class="flex-container detail-report">

            <div class="flex-container jc-c" style="width: 100%; margin-top: 3rem;">
                <h2>DETALLES<strong>-REPORTE</strong></h2>
                    <button id="addBtn" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar Reporte</button>
            </div>

            <div class="flex-container jc-c" style="width: 100%;">
                <div class="site">
                    <label for="municipios">Municipio</label>
                    <select id="municipios" disabled>
                        <option value="" disabled> --Seleccione-- </option>
                        <option value="1" selected>La Paz</option>
                        <option value="2">Los Cabos</option>
                        <option value="3">Loreto</option>
                    </select>
                </div>
                <div class="site">
                    <label for="ciudades">Ciudad</label>
                    <select id="ciudades" disabled>
                        <option value="" disabled> --Seleccione-- </option>
                        <option value="1" selected>La Paz</option>
                        <option value="2">Los Cabos</option>
                        <option value="3">Loreto</option>
                    </select>
                </div>
            </div>

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" required disabled>

            <label for="fechaReporte">Fecha de reporte</label>
            <input type="date" name="fechaReporte" id="" disabled>

            <label for="status">Status</label>
            <input type="text" name="status" disabled value="Procesado">

            <label for="desc">Descripción</label>
            <textarea id="desc" placeholder="Agrega la descripción del reporte" disabled></textarea>
        </form>
    </main>

    <?php require_once '../includes/footer.php';?>