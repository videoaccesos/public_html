<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos

$totalTarjetas=0;
$totalVehicularesH=0;
$totalPeatonalesH=0;
$totalVehicularesB=0;
$totalPeatonalesB=0;
$totalVehiculares=0;
$totalPeatonales=0;
$fechaActual= date('Y-m-d');

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$queryChart="SELECT lectura, tipo_id FROM tarjetas ORDER BY lectura DESC" ;
$result = $conexion->query($queryChart);

$conexion->close(); //cerramos la conexi贸n
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Lectura', 'Tipo'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['lectura']."', ".$row['tipo_id']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        title: 'Most Popular Programming Languages',
        width: 900,
        height: 500,
        pieSliceText: 'label',
        slices: {
            0: {offset: 0.5},
            6: {offset: 0.4},
            8: {offset: 0.3}
        },
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}
</script>
</head>
<body>
    <!-- Display the pie chart -->
    <div id="piechart"></div>
</body>
</html>