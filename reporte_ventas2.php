<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$privada=$_POST['cmbPrivadas'];
$arrFolios[] = 999999;
$arrFolios[0] = 0;
$consultaPrivadaH='';
$consultaPrivadaB='';
$totalVentaH=0;
$totalVentaB=0;
$totalTarjetas=0;
$totalVehicularesH=0;
$totalPeatonalesH=0;
$totalVehicularesB=0;
$totalPeatonalesB=0;
$totalVehiculares=0;
$totalPeatonales=0;
$totalVentasGeneral=0;
$totalGastos=0;

if ($privada!=0)
{
$consultaPrivadaH=' and R.privada_id ='.$privada;
$consultaPrivadaB=' and R.privada_id ='.$privada;
}

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$sql="SELECT RRTD.asignacion_id, RRTD.lectura, RRTD.numero_serie, T.tipo_id, RRTD.seguro, RRTD.costo, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, RRT.precio, RRT.tipo_pago, U.usuario, RRT.fecha, RRT.estatus_id, R.privada_id FROM residencias_residentes_tarjetas_detalle as RRTD INNER JOIN tarjetas as T on RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN usuarios as U on RRT.usuario_id = U.usuario_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivadaH ORDER BY RRTD.asignacion_id";
$resultado = $conexion->query($sql);

$sql2="SELECT RRTD.asignacion_id, RRTD.lectura, RRTD.numero_serie, T.tipo_id, RRTD.seguro, RRTD.costo, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, RRT.precio, RRT.tipo_pago, U.usuario, RRT.fecha, RRT.estatus_id FROM residencias_residentes_tarjetas_detalle_no as RRTD INNER JOIN tarjetas as T on RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on RRTD.asignacion_id = RRT.asignacion_id INNER JOIN usuarios as U on RRT.usuario_id = U.usuario_id INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where
RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivadaB ORDER BY RRTD.asignacion_id";
$resultado2 = $conexion->query($sql2);

$contadorPeatonalesH="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesH = $conexion->query($contadorPeatonalesH);
while($rowContadorPeatonalesH=$resultadoContadorPeatonalesH->fetch_assoc()){
$totalPeatonalesH = $rowContadorPeatonalesH['COUNT(*)'];
}

$contadorVehicularesH="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' AND T.tipo_id = 2" ;
$resultadoContadorVehicularesH = $conexion->query($contadorVehicularesH);
while($rowContadorVehicularesH=$resultadoContadorVehicularesH->fetch_assoc()){
$totalVehicularesH = $rowContadorVehicularesH['COUNT(*)'];
}

$contadorPeatonalesB="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesB = $conexion->query($contadorPeatonalesB);
while($rowContadorPeatonalesB=$resultadoContadorPeatonalesB->fetch_assoc()){
$totalPeatonalesB = $rowContadorPeatonalesB['COUNT(*)'];
}

$contadorVehicularesB="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' AND T.tipo_id = 2" ;
$resultadoContadorVehicularesB = $conexion->query($contadorVehicularesB);
while($rowContadorVehicularesB=$resultadoContadorVehicularesB->fetch_assoc()){
$totalVehicularesB = $rowContadorVehicularesB['COUNT(*)'];
}
$sumaGastos="SELECT SUM(total) FROM gastos where fecha >= '$fechaInicial' and fecha <= '$fechaFinal'" ;
$resultadoSumaGastos = $conexion->query($sumaGastos);
while($rowSumaGastos=$resultadoSumaGastos->fetch_assoc()){
$totalGastos = $rowSumaGastos['SUM(total)'];
}


$totalPeatonales = $totalPeatonalesH + $totalPeatonalesB;
$totalVehiculares = $totalVehicularesH + $totalVehicularesB;
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
$username   = '
wwwvideo_root'; //usuario de la base de datos
$password   = '
V1de0@cces0s'; //password del usuario de la base de datos
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
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    }
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
    $totalVentaH=$totalVentaH+$row['precio'];
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
echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";
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
$username   = '
wwwvideo_root'; //usuario de la base de datos
$password   = '
V1de0@cces0s'; //password del usuario de la base de datos
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
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    }
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
    $totalVentaB=$totalVentaB+$row['precio'];
?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>

<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Ventas B: $'.$totalVentaB; ?></h5></b>
<br><br><br>
<b><h4 style="text-align: right; color: black;"><?php $totalVentasGeneral = $totalVentaH+$totalVentaB; echo 'Total de Ventas: $'.$totalVentasGeneral.'(+)'; ?></h4></b>
<b><h4 style="text-align: right; color: black;"><?php echo 'Total de Gastos: $'.$totalGastos.'(-)'; ?></h4></b>
<b><h4 style="text-align: right; color: black;"><?php $totalGeneral = $totalVentasGeneral-$totalGastos; echo 'Total General: $'.$totalGeneral; ?></h4></b>
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Tarjetas Vendidas: '.$totalTarjetas.' ('.$totalVehiculares.' Vehiculares y '.$totalPeatonales.' Peatonales)'; ?></h5></b>
</form>
<form  method="POST" action="exportarVentasExcel.php" target="_blank" >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="cmbPrivadas" name="cmbPrivadas" value="<?php echo $privada;?>">
    <input id="enviarDatos" type="submit" value="Exportar a Excel">

</form>
</div>
</body>

</html>