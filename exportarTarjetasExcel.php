<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];
	$estatus=$_POST['estatus'];
$consultaEstatus='';
$fechaHoraActual = date("Y-m-d H:i:s");

if ($estatus!=0)
{
$consultaEstatus=' where T.estatus_id='.$estatus;
}

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
 
$sql="SELECT T.tarjeta_id,T.lectura,T.tipo_id,T.estatus_id,T.fecha,T.usuario_id, U.usuario from tarjetas as T INNER JOIN usuarios as U ON T.usuario_id = U.usuario_id $consultaEstatus";
$resultado = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable

$conexion->close(); //cerramos la conexi贸n

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_tarjetas.xls");
?>
<html>

<title>Reportes de Ordenes de Servicio</title>
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

#login{
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

#login {
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
<form name="consulta_reporte" method="POST" action="reporteOrdenesServicio.php" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Tarjetas</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>ID Tarjeta</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Lectura</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Tarjeta</b></td>";
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
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['tarjeta_id']);
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['lectura']);
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
$estatus="Baja";
}
echo utf8_decode($estatus);
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['fecha']);
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['usuario']);
?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <!--<input id="login" name="login" type="submit" value="Generar Reporte">-->

</form>
</div>
</body>

</html>