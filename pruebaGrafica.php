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

$fecha1 = "2017-07-08";
$fecha2 = "2017-08-08";

?>
<html>
   <head>
    <title>Prueba de Gráficas</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="fusioncharts/fusioncharts.js"></script>
  </head>

   <body>
<?php

    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
      "chart" => array(
          "caption" => "Venta Folios H (Comparativa)",
          "subcaption" => "Del 08-07-2017 al 08-08-2017",
          "paletteColors" => "#0075c2",
          "bgColor" => "#ffffff",
          "borderAlpha"=> "20",
          "canvasBorderAlpha"=> "0",
          "usePlotGradientColor"=> "0",
          "plotBorderAlpha"=> "10",
          "showXAxisLine"=> "1",
          "xAxisLineColor" => "#999999",
          "showValues" => "0",
          "divlineColor" => "#999999",
          "divLineIsDashed" => "1",
          "showAlternateHGridColor" => "0"
        )
    );

    $arrData["data"] = array();

    for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
      //echo $i . "<br />";
      $query="SELECT SUM(precio) as total FROM residencias_residentes_tarjetas WHERE fecha ='".$i."'";
      $result = $conexion->query($query);
      while($row=$result->fetch_assoc()){
      $total = $row['total'];
      //echo $total;
      }

      array_push($arrData["data"], array(
          "label" => $i,
          "value" => $total
          )
      );

    }
    $jsonEncodedData = json_encode($arrData);

    $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

    // Render the chart
    $columnChart->render();

    // Close the database connection
    $conexion->close();

?>

    <div id="chart-1"><!-- Fusion Charts will render here--></div>

   </body>

</html>