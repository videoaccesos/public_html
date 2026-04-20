<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$estatus=$_POST['cmbEstatus'];
$privadaID=$_POST['cmbPrivadas'];
$nombreComprador=$_POST['nombreComprador'];
$numeroTarjeta=$_POST['numeroTarjeta'];
$consultaEstatus='';
$fechaHoraActual = date("Y-m-d H:i:s");
$chkRango=$_POST['chkRango'];
$chkEstatus=$_POST['chkEstatus'];
$nombreCompleto="";
$domicilioCompleto="";

if ($estatus!=0)
{
$consultaEstatus=' where T.estatus_id='.$estatus;
}

if ($privadaID!=0)
{
$consultaPrivada=' and P.privada_id='.$privadaID;
}

$contadorTarjetas= 0;

$nombreCompleto="";

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

if ($chkRango == 'on')
{
$sql="SELECT T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id where T.fecha >= '$fechaInicial' and T.fecha <= '$fechaFinal'";
$resultado = $conexion->query($sql);
}

if ($chkEstatus== 'on')
{
	
$sql="SELECT T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id $consultaEstatus";
$resultado = $conexion->query($sql);
}
 

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

<title>Reportes de Tarjetas</title>
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
<form name="consulta_reporte" method="POST" action="#" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Tarjetas</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Folio Origen</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Lectura</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Tarjeta</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Nombre Comprador</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Domicilio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Usuario Alta</b></td>";

?>
                    <tr>
                </tr>
                <tbody style="background-color:white; color:black;font-size:12px;">
                    <?php while($row=$resultado->fetch_assoc()){ ?>
                        <tr>
<?php
$tarjetaActual=$row['tarjeta_id'];
$tarjetaActualLectura=$row['lectura'];
$conexion = @new mysqli($server, $username, $password, $database);
$sql333="SELECT RRT.asignacion_id, RRT.residente_id, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id INNER JOIN residencias_residentes_tarjetas as RRT on T.tarjeta_id = RRT.tarjeta_id OR T.tarjeta_id = RRT.tarjeta_id2 OR T.tarjeta_id = RRT.tarjeta_id3 OR T.tarjeta_id = RRT.tarjeta_id4 OR T.tarjeta_id = RRT.tarjeta_id5 INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where T.tarjeta_id = $tarjetaActual $consultaPrivada";
$resultado333 = $conexion->query($sql333);

$sql444="SELECT RRT.asignacion_id, RRT.residente_id, RR.nombre, RR.ape_paterno, RR.ape_materno, R.calle, R.nro_casa, P.descripcion, T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on T.tarjeta_id = RRT.tarjeta_id OR T.tarjeta_id = RRT.tarjeta_id2 OR T.tarjeta_id = RRT.tarjeta_id3 OR T.tarjeta_id = RRT.tarjeta_id4 OR T.tarjeta_id = RRT.tarjeta_id5 INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id where T.tarjeta_id = $tarjetaActual $consultaPrivada";
$resultado444 = $conexion->query($sql444);

$sql555="SELECT R.id_reposicion, R.residente, R.domicilio, T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id INNER JOIN reposiciones as R ON R.num_tarjeta_nueva = T.lectura OR R.num_tarjeta_vieja=T.lectura INNER JOIN privadas as P on R.id_privada = P.privada_id where T.lectura = $tarjetaActualLectura";
$resultado555 = $conexion->query($sql555);

$sql666="SELECT FVC.asignacion_id, FVC.responsable, T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id INNER JOIN folios_ventas_consignacion as FVC ON T.lectura = FVC.tarjeta1 OR T.lectura = FVC.tarjeta2 OR T.lectura = FVC.tarjeta3 OR T.lectura = FVC.tarjeta4 OR T.lectura = FVC.tarjeta5 OR T.lectura = FVC.tarjeta6 OR T.lectura = FVC.tarjeta7 OR T.lectura = FVC.tarjeta8 OR T.lectura = FVC.tarjeta9 OR T.lectura = FVC.tarjeta10 INNER JOIN privadas as P on FVC.privada_id = P.privada_id where T.lectura = $tarjetaActualLectura";
$resultado666 = $conexion->query($sql666);

echo "<td style='text-align: center; padding:5px'>";
while($row2=$resultado333 ->fetch_assoc()){
$folioEncontrado = $row2['asignacion_id'];
    if ( $folioEncontrado != "")
    {
    echo utf8_decode($row2['asignacion_id']." H ");
    $nombreCompleto = $row2['nombre'].' '.$row2['ape_paterno'].' '.$row2['ape_materno'];
    $domicilioCompleto = $row2['calle'].' '.$row2['nro_casa'].' '.$row2['descripcion'];
    }
}
while($row3=$resultado444 ->fetch_assoc()){
$folioEncontrado = $row3['asignacion_id'];
    if ( $folioEncontrado != "")
    {
    echo utf8_decode($row3['asignacion_id']." B ");
    $nombreCompleto = $row3['nombre'].' '.$row3['ape_paterno'].' '.$row3['ape_materno'];
    $domicilioCompleto = $row3['calle'].' '.$row3['nro_casa'].' '.$row3['descripcion'];
    }
}
while($row4=$resultado555 ->fetch_assoc()){
$folioEncontrado = $row4['id_reposicion'];
    if ( $folioEncontrado != "")
    {
    echo utf8_decode($row4['id_reposicion']." R ");
    $nombreCompleto = $row4['residente'];
    $domicilioCompleto = $row4['domicilio'].' '.$row4['descripcion'];
    }
}

while($row5=$resultado666 ->fetch_assoc()){
$folioEncontrado = $row5['asignacion_id'];
    if ( $folioEncontrado != "")
    {
    echo utf8_decode($row5['asignacion_id']." VC ");
    $nombreCompleto = $row5['responsable'];
    $domicilioCompleto = $row5['descripcion'];
    }
}
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['lectura']);
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
if ($row['tipo_id']==1)
{
$tipoTarjeta="Peatonal";
}
if ($row['tipo_id']==2)
{
$tipoTarjeta="Vehicular";
}
echo utf8_decode($tipoTarjeta);
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($nombreCompleto);
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($domicilioCompleto);
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
if ($row['estatus_id']==1)
{
$estatus="Disponible";
}
if ($row['estatus_id']==2)
{
$estatus="Asignada";
}
if ($row['estatus_id']==3)
{
$estatus="Suspendida";
}
if ($row['estatus_id']==4)
{
$estatus="Venta Consignacion";
}
if ($row['estatus_id']==5)
{
$estatus="Baja";
}
echo utf8_decode($estatus);
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['fecha']);
echo "</td>";


echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['usuario']);
echo "</td>";


$totalTarjetas= $totalTarjetas+1;
$conexion->close(); //cerramos la conexi贸n

?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
<br><br>
<?php echo 'Total de Tarjetas: '.$totalTarjetas?>
    <!--<input id="login" name="login" type="submit" value="Generar Reporte">-->


</form>
<form name="consulta_reporte" method="POST" action="exportarTarjetasExcel.php" target="_blank" >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="estatus" name="estatus" value="<?php echo $estatus;?>">
    <input id="enviarDatos" type="submit" value="Exportar a Excel">

</form>
</div>
</body>

</html>