<?php require_once '../databaseconect.php';?>

<?php
    // GRAFICA PUNTOS ----------------------------------------------
        $sql = mysqli_query($connection, "SELECT fecha, count(*) AS total FROM Reportes GROUP BY fecha ORDER BY fecha desc;");
        $data = array(); // Array donde vamos a guardar los datos
        while($row = mysqli_fetch_assoc($sql)){ // Recorrer los resultados de Ejecutar la consulta SQL
            $data[]=$row; // Guardar los resultados en la variable $data
        }
        $meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $repoMeses = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($data as $d){
            foreach($meses as $m){
                if(intval(substr($d['fecha'], 5, 2)) == $m){
                    $repoMeses[$m-1] = $repoMeses[$m-1] + intval($d['total']);
                }
            }
        }
    // GRAFICA BARRAS
        $sqlMunicipios = mysqli_query($connection, "SELECT NombreMunicipio, count(*) AS total FROM Reportes GROUP BY NombreMunicipio;");
                $dataMunicipios = array(); // Array donde vamos a guardar los datos
                while($row = mysqli_fetch_assoc($sqlMunicipios)){ // Recorrer los resultados de Ejecutar la consulta SQL
                    $dataMunicipios[]=$row; // Guardar los resultados en la variable $data
                }

?>

<section class="cont-graficas">
    <div class="grafica">
        <canvas id="chartPuntos" width="622" height="300"></canvas>
    </div>
    <div class="grafica">
        <canvas id="chartBarras" width="400" height="300"></canvas>
    </div>
</section>

<script type="module">
    function totalCaseChart(ctxPuntos, ctxBarras){
        const chartPuntos = new Chart(ctxPuntos, {
            type: 'line',
            data: {
                labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agt", "Sep", "Oct", "Nov", "Dic" 
                    
                    ],
                datasets: [
                    {
                        label: 'Reportes 2021',
                        data:  [<?php foreach($repoMeses as $rM):?>
                                "<?php echo $rM?>", 
                                <?php endforeach; ?>],
                        borderColor: 'rgba(255, 99, 132, 0.2)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 5
                        
                    }
                ]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        })

        const chartBarras = new Chart(ctxBarras, {
            type: 'bar',
            data: {
                labels: [<?php foreach($dataMunicipios as $dM):?>
                        
                        "<?php echo $dM['NombreMunicipio']?>", 
                        <?php endforeach; ?>],
            datasets: [{
                label: 'Reportes',
                data: [<?php foreach($dataMunicipios as $dM):?>
                        
                        "<?php echo $dM['total']?>", 
                        <?php endforeach; ?>],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        })
    }

    function renderCharts() {
        const ctxPuntos = document.getElementById('chartPuntos').getContext('2d');
        const ctxBarras = document.getElementById('chartBarras').getContext('2d');
        totalCaseChart(ctxPuntos, ctxBarras)
    }
    renderCharts()

</script>