<?php
include("fusioncharts.php");
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos

$fechaActual= date('Y-m-d');

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error)
{
    die('Error de conexi贸n: ' . $conexion->connect_error);
}
?>
<html>
   <head>
    <title>Gráfica 3D</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->

    <script src="fusioncharts/fusioncharts.js"></script>
  </head>

   <body>
<?php

$query="SELECT SUM(precio) as folios_h, IFNULL((SELECT SUM(precio) FROM residencias_residentes_tarjetas_no_renovacion WHERE fecha_modificacion >= '2017-07-08' and fecha_modificacion <= '2017-08-08'),0) as folios_b, IFNULL((SELECT SUM(total) FROM folios_mensualidades WHERE fecha >= '2017-07-08' and fecha <= '2017-08-08'),0) as folios_a FROM residencias_residentes_tarjetas WHERE fecha >= '2017-07-08' and fecha <= '2017-08-08'" ;
$result = $conexion->query($query);

while($row=$result->fetch_assoc()){
$foliosH = $row['folios_h'];
$foliosB = $row['folios_b'];
$foliosA = $row['folios_a'];
}
  // If the query returns a valid response, prepare the JSON string
  if ($result) {
    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
      "chart" => array(
          "caption" => "Ingresos",
          "subcaption" => "Del 08-07-2017 al 08-08-2017",
          "formatnumberscale" => "0",
          "showborder" => "0"
        )
    );
    $arrData["data"] = array();

    // Push the data into the array
    array_push($arrData["data"], array(
        "label" => "Folios H",
        "value" => $foliosH
        )
    );
    array_push($arrData["data"], array(
        "label" => "Folios B",
        "value" => $foliosB
        )
    );
    array_push($arrData["data"], array(
        "label" => "Folios A",
        "value" => $foliosA
        )
    );

    $jsonEncodedData = json_encode($arrData);

    $columnChart = new FusionCharts("pie3d", "ex2", "100%", 400, "chart-1", "json", $jsonEncodedData);

    $columnChart->render();

    }

    $conexion->close();

?>

    <div id="chart-1"><!-- Fusion Charts will render here--></div>

   </body>

</html>