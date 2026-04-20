<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$privada=$_POST['cmbPrivadas'];
$chkCombinadas=$_POST['chkCombinadas'];
$arrFolios[] = 999999;
$arrFolios[0] = 0;
$consultaPrivada='';
$consultaPrivadaGastos='';
$consultaPrivadaPagosGenerales='';
$consultaPrivadaFoliosMC=' and P.privada_id =22';
$totalVentaH=0;
$totalVentaB=0;
$totalVentaPagosGenerales=0;
$totalVentaA=0;
$totalTarjetas=0;
$totalVehicularesH=0;
$totalPeatonalesH=0;
$totalVehicularesB=0;
$totalPeatonalesB=0;
$totalVehiculares=0;
$totalPeatonales=0;
$totalVentasGeneral=0;
$totalVentasFoliosA=0;
$totalGastos=0;
$gastosFijos=0;
$gastosVariables=0;
$gastosBancos=0;
$gastosEfectivo=0;
$gastosCaja=0;
$ventasBancos=0;
$ventasEfectivo=0;
$totalVentaMC=0;
$totalTarjetasMC=0;
$totalVehicularesMC=0;
$totalPeatonalesMC=0;

if ($privada!=0)
{
$consultaPrivada=' and R.privada_id ='.$privada;
$consultaPrivadaGastos=' and privada_id ='.$privada;
$consultaPrivadaGastosDetalle=' and G.privada_id ='.$privada;
$consultaPrivadaPagosGenerales = 'and RRT.privada='.$privada;
$consultaPrivadaFoliosA=' and P.privada_id ='.$privada;
$consultaPrivadaFoliosMC=' and P.privada_id ='.$privada;
}

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$sql="SELECT DISTINCT RRTD.asignacion_id, RRTD.lectura, RRTD.numero_serie, T.tipo_id, RRTD.seguro, RRTD.costo, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, RRT.precio, RRT.tipo_pago, RRT.observaciones, RRT.fecha, RRT.estatus_id, R.privada_id FROM residencias_residentes_tarjetas_detalle as RRTD INNER JOIN tarjetas as T on RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id LEFT JOIN usuarios as U on RRT.usuario_id = U.usuario_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada ORDER BY RRTD.asignacion_id";
$resultado = $conexion->query($sql);

$sql2="SELECT DISTINCT RRTD.asignacion_id, RRTD.lectura, RRTD.numero_serie, T.tipo_id, RRTD.seguro, RRTD.costo, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, RRT.precio, RRT.tipo_pago, U.usuario, RRT.fecha, RRT.estatus_id FROM residencias_residentes_tarjetas_detalle_no as RRTD INNER JOIN tarjetas as T on RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on RRTD.asignacion_id = RRT.asignacion_id LEFT JOIN usuarios as U on RRT.usuario_id = U.usuario_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada ORDER BY RRTD.asignacion_id";
$resultado2 = $conexion->query($sql2);

$sql3="SELECT RRT.asignacion_id, P.descripcion, U.usuario, RRT.comprador_id, RRT.comprador_id as responsable, RRT.fecha, RRT.precio as total, RRT.concepto, RRT.estatus_id FROM residencias_residentes_tarjetas_no_renovacion as RRT INNER JOIN privadas as P on P.privada_id = RRT.privada LEFT JOIN usuarios as U on U.usuario_id = RRT.usuario_id WHERE
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivadaPagosGenerales ORDER BY RRT.asignacion_id";
$resultado3 = $conexion->query($sql3);

$sql4="SELECT FM.asignacion_id, P.descripcion, FM.concepto, FM.responsable, FM.total, FM.tipo_pago, FM.fecha, FM.estatus FROM folios_mensualidades as FM INNER JOIN privadas as P on P.privada_id = FM.privada_id WHERE
FM.fecha >= '$fechaInicial 00:00:01' and FM.fecha <= '$fechaFinal 23:59:59' $consultaPrivadaFoliosA ORDER BY FM.asignacion_id";
$resultado4 = $conexion->query($sql4);

$sql5="SELECT P.descripcion AS privada,TG.gasto, G.descripcion_gasto,G.comprobante,G.total, (CASE G.tipo_pago WHEN 1 THEN 'Efectivo' WHEN 2 THEN 'Bancos' WHEN 3 THEN 'Caja' END ) AS tipopago, (CASE TG.tipo_gasto WHEN 1 THEN 'Fijo' WHEN 2 THEN 'Variable' END ) AS tipo_gasto, G.fecha, U.usuario FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id LEFT JOIN usuarios as U on G.usuario_id = U.usuario_id INNER JOIN privadas as P on G.privada_id = P.privada_id WHERE G.fecha >= '$fechaInicial 00:00:01' and G.fecha <= '$fechaFinal 23:59:59' $consultaPrivadaGastosDetalle ORDER BY G.fecha ASC";
$resultado5 = $conexion->query($sql5);


$sql6="SELECT DISTINCT RRTD.asignacion_id, RRTD.lectura, RRTD.numero_serie, T.tipo_id, RRTD.seguro, RRTD.costo, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, RRT.precio, U.usuario, RRT.fecha, RRT.estatus_id, R.privada_id FROM residencias_residentes_tarjetas_detalle_monte_carlo as RRTD INNER JOIN tarjetas as T on RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_monte_carlo as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN usuarios as U on RRT.usuario_id = U.usuario_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivadaFoliosMC ORDER BY RRTD.asignacion_id";
$resultado6 = $conexion->query($sql6);

$sql7="SELECT DISTINCT R.id_reposicion, P.descripcion, R.residente, R.domicilio, R.folio, R.num_tarjeta_vieja, R.num_tarjeta_nueva, R.Motivo, R.observaciones, R.fecha, R.estatus FROM reposiciones as R INNER JOIN privadas as P on R.id_privada = P.privada_id WHERE R.fecha >= '$fechaInicial 00:00:01' and R.fecha <= '$fechaFinal 23:59:59' $consultaPrivada ORDER BY R.id_reposicion";
$resultado7 = $conexion->query($sql7);

$contadorPeatonalesMC="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_monte_carlo AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_monte_carlo as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivadaFoliosMC AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesMC = $conexion->query($contadorPeatonalesMC);
while($rowContadorPeatonalesMC=$resultadoContadorPeatonalesMC->fetch_assoc()){
$totalPeatonalesMC = $rowContadorPeatonalesMC['COUNT(*)'];
}

$contadorVehicularesMC="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_monte_carlo AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_monte_carlo as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivadaFoliosMC AND T.tipo_id = 2" ;
$resultadoContadorVehicularesMC = $conexion->query($contadorVehicularesMC);
while($rowContadorVehicularesMC=$resultadoContadorVehicularesMC->fetch_assoc()){
$totalVehicularesMC = $rowContadorVehicularesMC['COUNT(*)'];
}

$contadorPeatonalesH="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesH = $conexion->query($contadorPeatonalesH);
while($rowContadorPeatonalesH=$resultadoContadorPeatonalesH->fetch_assoc()){
$totalPeatonalesH = $rowContadorPeatonalesH['COUNT(*)'];
}

$contadorVehicularesH="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada AND T.tipo_id = 2" ;
$resultadoContadorVehicularesH = $conexion->query($contadorVehicularesH);
while($rowContadorVehicularesH=$resultadoContadorVehicularesH->fetch_assoc()){
$totalVehicularesH = $rowContadorVehicularesH['COUNT(*)'];
}

$contadorPeatonalesB="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesB = $conexion->query($contadorPeatonalesB);
while($rowContadorPeatonalesB=$resultadoContadorPeatonalesB->fetch_assoc()){
$totalPeatonalesB = $rowContadorPeatonalesB['COUNT(*)'];
}

$contadorVehicularesB="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada AND T.tipo_id = 2" ;
$resultadoContadorVehicularesB = $conexion->query($contadorVehicularesB);
while($rowContadorVehicularesB=$resultadoContadorVehicularesB->fetch_assoc()){
$totalVehicularesB = $rowContadorVehicularesB['COUNT(*)'];
}

$totalPeatonales = $totalPeatonalesH + $totalPeatonalesB + $totalPeatonalesMC;
$totalVehiculares = $totalVehicularesH + $totalVehicularesB + $totalVehicularesMC;
$totalTarjetas = $totalPeatonales+$totalVehiculares;

$conexion->close(); //cerramos la conexi贸n
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
    <h3 style="text-align:center;color:#0040FF">Reporte de Folios H</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
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
$contador="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle where asignacion_id=$folio";
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
    $totalVentaH=$totalVentaH+$row['precio'];
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
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    $ventasEfectivo = $ventasEfectivo + $row['precio'];
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    $ventasBancos = $ventasBancos + $row['precio'];
    }
    echo utf8_decode($tipoPago);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['observaciones']);
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
    $totalVentaH=$totalVentaH+$row['precio'];
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
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    $ventasEfectivo = $ventasEfectivo + $row['precio'];
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    $ventasBancos = $ventasBancos + $row['precio'];
    }
    echo utf8_decode($tipoPago);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['observaciones']);
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

<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Ventas H: $'.$totalVentaH; ?></h5></b>

<br><br><br>
<h3 style="text-align:center;color:#0040FF">Reporte de Folios B</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
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
echo "<td style='text-align: center; padding:5px'><b>observaciones</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estado</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado2->fetch_assoc();$i++){ ?>
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
$contador="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no where asignacion_id=$folio";
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
    $totalVentaB=$totalVentaB+$row['precio'];
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
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    $ventasEfectivo = $ventasEfectivo + $row['precio'];
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    $ventasBancos = $ventasBancos + $row['precio'];
    }
    echo utf8_decode($tipoPago);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['observaciones']);
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
    $totalVentaB=$totalVentaB+$row['precio'];
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
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    $ventasEfectivo = $ventasEfectivo + $row['precio'];
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    $ventasBancos = $ventasBancos + $row['precio'];
    }
    echo utf8_decode($tipoPago);
    echo "</td>";
    }

    if ($arrFolios[$i-1]!=$arrFolios[$i])
    {
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['observaciones']);
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
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Ventas B: $'.$totalVentaB; ?></h5></b>
<br><br><br>
<h3 style="text-align:center;color:#0040FF">Reporte de Folios MC</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
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
    echo "<td style='text-align: center; padding:5px'><b>observaciones</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Estado</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado6->fetch_assoc();$i++){ ?>
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
    echo utf8_decode($row['observaciones']);
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
    echo utf8_decode($row['observaciones']);
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
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Ventas MC: $'.$totalVentaMC; ?></h5></b>
<br><br><br>

<h3 style="text-align:center;color:#0040FF">Reporte de Folios A</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Responsable</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Concepto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado4->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['asignacion_id']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['responsable']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['concepto']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("$".$row['total']);
    $totalVentaA=$totalVentaA+$row['total'];
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    $ventasEfectivo = $ventasEfectivo + $row['total'];
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    $ventasBancos = $ventasBancos + $row['total'];
    }
    echo utf8_decode($tipoPago);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    if ($row['estatus']==0)
    {
    $estatus= "Cancelado";
    }
    if ($row['estatus_id']==1)
    {
    $estatus= "Activo";
    }
    echo utf8_decode($estatus);
    echo "</td>";
?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>

<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Ventas A: $'.$totalVentaA; ?></h5></b>
<br><br><br>
<h3 style="text-align:center;color:#0040FF">Reporte de Pagos Generales</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Responsable</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Concepto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>observaciones</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado3->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['asignacion_id']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['responsable']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['concepto']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("$".$row['total']);
    $totalVentaPagosGenerales=$totalVentaPagosGenerales+$row['total'];
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['observaciones']);
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
?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>

<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Pagos Generales: $'.$totalVentaPagosGenerales; ?></h5></b>
<br><br><br>
<h3 style="text-align:center;color:#0040FF">Reporte de Gastos</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Gasto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Descripci&oacute;n</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Comprobante</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Gasto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";
?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado5->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['privada']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['gasto']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion_gasto']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['comprobante']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("$".$row['total']);
    $totalGastos=$totalGastos+$row['total'];
    echo "</td>";

    if ($row['tipopago'] == "Bancos")
    {
        $gastosBancos=$gastosBancos+$row['total'];
    }

    if ($row['tipopago'] == "Efectivo")
    {
        $gastosEfectivo=$gastosEfectivo+$row['total'];
    }
    
    if ($row['tipopago'] == "Caja")
    {
        $gastosCaja=$gastosCaja+$row['total'];
    }

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['tipo_gasto']);
    if ($row['tipo_gasto'] == "Fijo")
    {
        $gastosFijos=$gastosFijos+$row['total'];
    }
    if ($row['tipo_gasto'] == "Variable")
    {
        $gastosVariables=$gastosVariables+$row['total'];
    }
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['tipopago']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['observaciones']);
    echo "</td>";

?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br><br><br>

<h3 style="text-align:center;color:#0040FF">Reporte de Reposiciones</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Residente</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Domicilio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Folio Anterior</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tarjeta Anterior</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tarjeta Nueva</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Motivo</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Observaciones</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado7->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['id_reposicion']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['residente']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['domicilio']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['folio']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['num_tarjeta_vieja']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['num_tarjeta_nueva']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['motivo']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['observaciones']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    if ($row['estatus']==0)
    {
    $estatus= "Cancelado";
    }
    if ($row['estatus_id']==1)
    {
    $estatus= "Activo";
    }
    echo utf8_decode($estatus);
    echo "</td>";
?>
        </tr>
    <?php } ?>
</tbody>
</table>

<br>
<!--<h5 style="text-align: right; color: black;"><?php echo 'Gastos Fijos: $'.number_format($gastosFijos, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos Variables: $'.number_format($gastosVariables, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Total de Gastos: $'.number_format($totalGastos, 2, '.', ','); ?></h5>-->



<h5 style="text-align: right; color: black;"><?php echo 'Ventas MC: $'.number_format($totalVentaMC, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Ventas por Bancos: $'.number_format($ventasBancos, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Ventas por Efectivo: $'.number_format($ventasEfectivo+$totalVentaPagosGenerales, 2, '.', ','); ?></h5>
<b><h4 style="text-align: right; color: black;"><?php $totalVentasGeneral = $totalVentaH+$totalVentaB+$totalVentaA+$totalVentaPagosGenerales+$totalVentaMC; echo 'Total de Ventas: $'.number_format($totalVentasGeneral, 2, '.', ',').'(+)'; ?></h4></b><br>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos Caja: $'.number_format($gastosCaja, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos por Bancos: $'.number_format($gastosBancos, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos por Efectivo: $'.number_format($gastosEfectivo, 2, '.', ','); ?></h5>
<b><h4 style="text-align: right; color: black;"><?php echo 'Total de Gastos: $'.number_format($totalGastos, 2, '.', ',').'(-)'; ?></h4></b><br>

<b><h4 style="text-align: right; color: black;"><?php $totalGeneral = $totalVentasGeneral-$totalGastos; echo 'Total General: $'.number_format($totalGeneral, 2, '.', ','); ?></h4></b><br>

<h5 style="text-align: right; color: black;">***************************************************</h5><br>

<h5 style="text-align: right; color: black;"><?php echo 'Ventas Efectivo: $'.number_format($ventasEfectivo+$totalVentaPagosGenerales, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos Efectivo: $'.number_format($gastosEfectivo, 2, '.', ','); ?></h5>
<b><h4 style="text-align: right; color: black;"><?php $totalEfectivo= $ventasEfectivo-$gastosEfectivo+$totalVentaPagosGenerales; echo 'Liquidación: $'.number_format($totalEfectivo, 2, '.', ','); ?></h4></b><br>
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Tarjetas Vendidas: '.$totalTarjetas.' ('.$totalVehiculares.' Vehiculares y '.$totalPeatonales.' Peatonales)'; ?></h5></b>
</form>
<?php 
if ($chkCombinadas != "on")
{
    echo "<form  method='POST' action='exportarVentasExcel2.php' target='_blank' >"; 
}
else
{
    echo "<form  method='POST' action='exportarVentasExcel.php' target='_blank' >"; 
}
?>
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="cmbPrivadas" name="cmbPrivadas" value="<?php echo $privada;?>">
<input type="hidden" id="chkCombinadas" name="chkCombinadas" value="<?php echo $chkCombinadas;?>">
<input id="enviarDatos" type="submit" value="Exportar a Excel">

</form>
</div>
</body>

</html>