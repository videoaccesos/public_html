<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$privada=22;
$chkCombinadas=$_POST['chkCombinadas'];
$arrFolios[] = 999999;
$arrFolios[0] = 0;
$consultaPrivada='';
$totalVentaMC=0;
$totalTarjetasMC=0;
$totalVehicularesMC=0;
$totalPeatonalesMC=0;

if ($privada!=0)
{
$consultaPrivada=' and R.privada_id ='.$privada;
}

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$sql="SELECT DISTINCT RRTD.asignacion_id, RRTD.lectura, RRTD.numero_serie, T.tipo_id, RRTD.seguro, RRTD.costo, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, RRT.precio, U.usuario, RRT.fecha, RRT.estatus_id, R.privada_id FROM residencias_residentes_tarjetas_detalle_monte_carlo as RRTD INNER JOIN tarjetas as T on RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_monte_carlo as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN usuarios as U on RRT.usuario_id = U.usuario_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada ORDER BY RRTD.asignacion_id";
$resultado = $conexion->query($sql);

$contadorPeatonalesMC="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_monte_carlo AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_monte_carlo as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesMC = $conexion->query($contadorPeatonalesMC);
while($rowContadorPeatonalesMC=$resultadoContadorPeatonalesMC->fetch_assoc()){
$totalPeatonalesMC = $rowContadorPeatonalesMC['COUNT(*)'];
}

$contadorVehicularesMC="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_monte_carlo AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_monte_carlo as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada AND T.tipo_id = 2" ;
$resultadoContadorVehicularesMC = $conexion->query($contadorVehicularesMC);
while($rowContadorVehicularesMC=$resultadoContadorVehicularesMC->fetch_assoc()){
$totalVehicularesMC = $rowContadorVehicularesMC['COUNT(*)'];
}

$totalTarjetas = $totalPeatonalesMC+$totalVehicularesMC;

$conexion->close(); //cerramos la conexi贸n

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_ventasMC.xls");
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="imprimirContrato/js/jquery.js"></script>
<script src="imprimirContrato/js/myjava.js"></script>
<link href="imprimirContrato/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="imprimirContrato/bootstrap/js/bootstrap.min.js"></script>
<script src="imprimirContrato/bootstrap/js/bootstrap.js"></script>

<title>Reportes de Ventas</title>
<style>
body {

    background-image: url('ticket/imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

a{
font-size:14px;
font-weight:bold;
color:#0431B4;
}

.logo {
    width: 250px;
    height: 70px;
    background: url('ticket/imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 80%;
    padding: 7px 20px 7px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 7px solid #0040FF;
    margin: 0 auto;
    margin-bottom:20px;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 18px;
}

.login-block input {
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}
.login-block select {
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

#enviarDatos{
    width: 100%;
    height: 40px;
    background: #0040FF;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #0040FF;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

#enviarDatos{
    background: #0040FF;
border-color:white;
}
#tabla{
width:100%;
height:100%;
}

</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="#" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Folios MC</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

    echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Tarjeta</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Serie</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>V</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>P</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>S</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Costo</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Total Compra</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Nombre</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Domicilio</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Estado</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
        <tr>
<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$folio= ($row['asignacion_id']);
$contador="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_monte_carlo where asignacion_id=$folio";
$resultadoContador = $conexion->query($contador);
while($rowContador=$resultadoContador->fetch_assoc()){
$totalContador = $rowContador['COUNT(*)'];
}

$conexion->close();

    $arrFolios[$i]=$row['asignacion_id'];
if ($chkCombinadas != "on")
{
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['asignacion_id']);
    echo "</td>";
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['lectura']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['numero_serie']);
    echo "</td>";
   
    if ($row['tipo_id']==2)
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("X");
    echo "</td>";
    }
    else
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("");
    echo "</td>";
    }

    if ($row['tipo_id']==1)
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("X");
    echo "</td>";
    }
    else
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("");
    echo "</td>";
    }

    echo "<td style='text-align: center; padding:5px'>";
    if ($row['seguro']==0)
    {
    $seguro= "";
    }
    if ($row['seguro']==1)
    {
    $seguro= "X";
    }
    echo utf8_decode($seguro);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("$".$row['costo']);
    echo "</td>";

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode("$".$row['precio']);
    $totalVentaMC=$totalVentaMC+$row['precio'];
    echo "</td>";
    }

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['nombre'].' '.$row['ape_paterno'].' '.$row['ape_materno']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['calle'].' #'.$row['nro_casa']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    $tipoPago= "Efectivo";
    echo utf8_decode($tipoPago);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['usuario']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    if ($row['estatus_id']==0)
    {
    $estatus= "Cancelado";
    }
    if ($row['estatus_id']==1)
    {
    $estatus= "Activo";
    }
    echo utf8_decode($estatus);
    echo "</td>";
}
else
{
    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['asignacion_id']);
    echo "</td>";
    }
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['lectura']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['numero_serie']);
    echo "</td>";
   
    if ($row['tipo_id']==2)
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("X");
    echo "</td>";
    }
    else
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("");
    echo "</td>";
    }

    if ($row['tipo_id']==1)
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("X");
    echo "</td>";
    }
    else
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("");
    echo "</td>";
    }

    echo "<td style='text-align: center; padding:5px'>";
    if ($row['seguro']==0)
    {
    $seguro= "";
    }
    if ($row['seguro']==1)
    {
    $seguro= "X";
    }
    echo utf8_decode($seguro);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("$".$row['costo']);
    echo "</td>";

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode("$".$row['precio']);
    $totalVentaMC=$totalVentaMC+$row['precio'];
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['nombre'].' '.$row['ape_paterno'].' '.$row['ape_materno']);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['calle'].' #'.$row['nro_casa']);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['descripcion']);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    $tipoPago= "Efectivo";
    echo utf8_decode($tipoPago);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['usuario']);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    if ($row['estatus_id']==0)
    {
    $estatus= "Cancelado";
    }
    if ($row['estatus_id']==1)
    {
    $estatus= "Activo";
    }
    echo utf8_decode($estatus);
    echo "</td>";
    }
}

?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>

<br><br><br>
<b><h4 style="text-align: right; color: black;"><?php echo 'Total de Ventas: $'.$totalVentaMC.'(+)'; ?></h4></b>
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Tarjetas Vendidas: '.$totalTarjetas.' ('.$totalVehicularesMC.' Vehiculares y '.$totalPeatonalesMC.' Peatonales)'; ?></h5></b>
</form>
<?php 
if ($chkCombinadas != "on")
{
    echo "<form  method='POST' action='exportarVentasExcelMC2.php' target='_blank' >"; 
}
else
{
    echo "<form  method='POST' action='exportarVentasExcelMC.php' target='_blank' >"; 
}
?>
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="cmbPrivadas" name="cmbPrivadas" value="<?php echo $privada;?>">
    <input id="enviarDatos" type="submit" value="Exportar a Excel">

</form>
</div>
</body>

</html>