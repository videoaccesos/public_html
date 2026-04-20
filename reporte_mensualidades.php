<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
    $fechaFinal=$_POST['fechaFinal'];
    $mes=$_POST['cmbMeses'];
$chkRango=$_POST['chkRango'];
$chkMes=$_POST['chkMes'];
$ano = date('Y');
$totalVenta=0;
$totalPagado=0;
$tipoPago = "";
/*echo $fechaInicial;
echo $fechaFinal;
echo $privada;
echo $tecnico;
echo $estatus;
echo $mostrarFolio;
echo $mostrarPrivada;
echo $mostrarFalla;
echo $mostrarDiagnostico;
echo $mostrarTecnico;
echo $mostrarTiempo;
echo $mostrarFechaInicio;
echo $mostrarFechaSolucion;
echoMostrarEstatus;*/

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

if ($chkRango == 'on')
{
    $query="SELECT P.descripcion, FM.asignacion_id, FM.concepto, FM.responsable, FM.total, FM.tipo_pago, FM.fecha, FM.estatus FROM folios_mensualidades as FM INNER JOIN privadas as P on FM.privada_id = P.privada_id where FM.fecha >= '$fechaInicial' and FM.fecha <= '$fechaFinal'";
    $resultado=$conexion->query($query);
}

if ($chkMes== 'on')
{
    $query="SELECT DISTINCT P.descripcion, PM.total, FM.tipo_pago, PM.fecha, PM.estatus FROM pago_mensualidades as PM INNER JOIN privadas as P on PM.id_privada = P.privada_id INNER JOIN folios_mensualidades as FM on PM.id_privada=FM.privada_id where PM.ano=$ano and PM.mes=$mes order by PM.estatus desc";
    $resultado=$conexion->query($query);
}


$conexion->close(); //cerramos la conexi贸n
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="imprimirContrato/js/jquery.js"></script>
<script src="imprimirContrato/js/myjava.js"></script>
<link href="imprimirContrato/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="imprimirContrato/bootstrap/js/bootstrap.min.js"></script>
<script src="imprimirContrato/bootstrap/js/bootstrap.js"></script>

<title>Reportes Pago Mensualidades</title>
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

.login-block input#fechaInicial{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaInicial:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaFinal{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaFinal:focus{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block #cmbPrivadas{
margin-top:6px;
    background: #fff url('ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbPrivadas:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbTecnicos{
margin-top:6px;
    background: #fff url('ticket/imagenes/usuario3.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbTecnicos:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/usuario3.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbEstatus{
margin-top:6px;
    background: #fff url('ticket/imagenes/estatus.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbEstatus:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/estatus.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
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
<form name="consulta_reporte" method="POST" action="exportarVentasExcel.php" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Pago de Mensualidades</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">

<?php 
if ($chkRango == 'on')
{
echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Responsable</b></td>";
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Concepto</b></td>";
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
}

if ($chkMes== 'on')
{
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";

echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";

echo "<td style='text-align: center; padding:5px'><b>Fecha de Pago</b></td>";

echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";

echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
}
?>

                    <tr>
                </tr>
                <tbody style="background-color:white; color:black;font-size:12px;">

                    <?php while($row=$resultado->fetch_assoc()){ 
if ($chkRango == 'on')
{
  $host = "localhost";
  $user = "
wwwvideo_root";
  $pass = "
V1de0@cces0s";
  $databaseName = "wwwvideo_video_accesos";
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['asignacion_id']);
echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['descripcion']);
echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['responsable']);
echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['concepto']);
echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode('$'.$row['total']);
echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['fecha']);

echo "<td style='text-align: center; padding:5px'>";
if ($row['tipo_pago']==0)
{
$tipoPago= "No Definido";
}
if ($row['tipo_pago']==1)
{
$tipoPago= "Efectivo";
}
if ($row['tipo_pago']==2)
{
$tipoPago= "Bancos";
}
echo utf8_decode($tipoPago);

echo "<td style='text-align: center; padding:5px'>";
if ($row['estatus']==0)
{
$estatus= "Cancelado";
}
if ($row['estatus']==1)
{
$estatus= "Activo";
}
echo utf8_decode($estatus);
}

if ($chkMes == 'on')
{
  $host = "localhost";
  $user = "
wwwvideo_root";
  $pass = "
V1de0@cces0s";
  $databaseName = "wwwvideo_video_accesos";
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['descripcion']);
echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode('$'.$row['total']);
echo "<td style='text-align: center; padding:5px'>";
if ($row['estatus']==1)
{
echo utf8_decode($row['fecha']);
}
echo "<td style='text-align: center; padding:5px'>";
if ($row['estatus']==1)
{
    if ($row['tipo_pago']==0)
    {
    $tipoPago= "No Definido";
    }
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    }
    echo utf8_decode($tipoPago);
}
echo "<td style='text-align: center; padding:5px'>";
if ($row['estatus']==1)
{
$estatus= "Pagado";
$totalPagado= $totalPagado+$row['total'];
}
if ($row['estatus']==2)
{
$estatus= "Pendiente";
}
echo utf8_decode($estatus);

}

$totalVenta=$totalVenta+$row['total'];

?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
<br>
<?php echo 'Total General: $'.$totalVenta?><br>
<?php echo 'Total Pagado: $'.$totalPagado?><br>
<?php $totalPendiente = $totalVenta - $totalPagado;?>
<?php echo 'Pendiente por Pagar: $'.$totalPendiente?>
<br>

    <!--<input id="login" name="login" type="submit" value="Generar Reporte">
<a href="output.php?t=word" target="_blank">Word</a>
<a href="output.php?t=excel" target="_blank">Excel</a>
<a href="output.php?t=pdf" target="_blank">Pdf</a>-->
</form>
<form name="consulta_reporte" method="POST" action="exportarVentasExcel.php" target="_blank" >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
    <input id="enviarDatos" type="hidden" value="Exportar a Excel">

</form>

</div>
</body>

</html>