<?php require_once '../databaseconect.php';?>

<?php
    // GRAFICA PASTEL
        $sqlStatus = mysqli_query($connection, "SELECT StatusRepo, count(*) AS total FROM Reportes GROUP BY StatusRepo;");
            $dataStatus = array(); // Array donde vamos a guardar los datos
            while($row = mysqli_fetch_assoc($sqlStatus)){ // Recorrer los resultados de Ejecutar la consulta SQL
                $dataStatus[]=$row; // Guardar los resultados en la variable $data
            }
?>

<section>
    <div class="">
        <canvas id="chartPastel" width="250" height="250"></canvas>
    </div>
</section>

<script type="module">
    function totalCaseChart(ctxPastel){

        const chartPastel = new Chart(ctxPastel, {
            type: 'pie',
            data: {
                labels: [<?php foreach($dataStatus as $dS):?>
                        
                        "<?php echo $dS['StatusRepo']?>", 
                        <?php endforeach; ?>],
            datasets: [{
                label: 'Status de reportes',
                data: [<?php foreach($dataStatus as $dS):?>
                        
                        "<?php echo $dS['total']?>", 
                        <?php endforeach; ?>],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(156, 122, 235)'
                ],
                hoverOffset: 4
            }]
            }
        })
    }

    function renderCharts() {
        const ctxPastel = document.getElementById('chartPastel').getContext('2d');
        totalCaseChart(ctxPastel)
    }
    renderCharts()

</script>