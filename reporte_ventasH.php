<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];
	$privada=$_POST['cmbPrivadas'];
	$vendedora=$_POST['cmbVendedoras'];
	$mostrarCantidadTarjetas=$_POST['chkCantidadTarjetas'];
	$mostrarPrivada=$_POST['chkPrivada'];
	$mostrarFolio=$_POST['chkFolio'];
$mostrarNumTarjeta=$_POST['chkNumTarjeta'];
$mostrarNumSerie=$_POST['chkNumSerie'];
	$mostrarComprador=$_POST['chkComprador'];
$mostrarDomicilio=$_POST['chkDomicilio'];
	$mostrarVendedora=$_POST['chkVendedora'];
$mostrarDescuento=$_POST['chkDescuento'];
	$mostrarTotal=$_POST['chkTotal'];
$mostrarSeguros=$_POST['chkSeguros'];
$mostrarFecha=$_POST['chkFecha'];
$consultaPrivada='';
$consultaVendedora='';

$totalVenta=0;
$totalTarjetas=0;
$totalVehiculares=0;
$totalPeatonales=0;

if ($privada!=0)
{
$consultaPrivada=' and R.privada_id ='.$privada;
}

if ($vendedora!=0)
{
$consultaVendedora=' and RRT.usuario_id='.$vendedora;
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
 
$sql="SELECT * from privadas where estatus_id=1";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
 
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['privada_id']."'>".$row['descripcion']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}

$sql2="SELECT * from usuarios_vendedoras";
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
 
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit2="";
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit2 .=" <option value='".$row2['vendedora_id']."'>".$row2['nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}

	$query="SELECT RRT.asignacion_id,RR.ape_paterno, RR.ape_materno, RR.nombre, R.nro_casa, R.calle, R.telefono1,R.telefono2,R.interfon,RR.email, U.usuario, U.usuario_id, R.privada_id, P.descripcion, T.lectura,  RRT.tarjeta_id,RRT.tarjeta_id2,RRT.tarjeta_id3,RRT.tarjeta_id4,RRT.tarjeta_id5, RRT.fecha, RRT.fecha_vencimiento, RRT.lectura_tipo_id, RRT.comprador_id, RRT.folio_contrato, RRT.precio, RRT.descuento, RRT.IVA, RRT.numero_serie,RRT.numero_serie2,RRT.numero_serie3,RRT.numero_serie4,RRT.numero_serie5, RRT.utilizo_seguro, RRT.utilizo_seguro2, RRT.utilizo_seguro3, RRT.utilizo_seguro4, RRT.utilizo_seguro5, RRT.fecha_modificacion, RRT.estatus_id, RRT.usuario_id, U.usuario FROM residencias_residentes_tarjetas as RRT INNER JOIN residencias_residentes as RR ON RR.residente_id = RRT.residente_id INNER JOIN tarjetas as T ON T.tarjeta_id = RRT.tarjeta_id INNER JOIN residencias as R on R.residencia_id=RR.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id INNER JOIN usuarios AS U ON RRT.usuario_id = U.usuario_id where RRT.fecha >= '$fechaInicial' and RRT.fecha <= '$fechaFinal' $consultaPrivada $consultaVendedora";
	$resultado=$conexion->query($query);



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
    <h3 style="text-align:center;color:#0040FF">Reporte de Ventas</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php if ($mostrarFolio=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
}
?>
<?php if ($mostrarCantidadTarjetas=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Cantidad</b></td>";
}
?>

<?php if ($mostrarNumTarjeta=="on")
{
echo "<td style='text-align: center; padding:5px'><b># Tarjetas</b></td>";
}
?>
<?php if ($mostratNumSerie=="on")
{
echo "<td style='text-align: center; padding:5px'><b># Serie</b></td>";
}
?>
<?php if ($mostrarNumSerie=="on")
{
echo "<td style='text-align: center; padding:5px'><b># Serie</b></td>";
}
?>
<?php if ($mostrarSeguros=="on")
{
echo "<td style='text-align: center; padding:5px'><b># Seguros</b></td>";
}
?>

<?php if ($mostrarComprador=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Comprador</b></td>";
}
?>
<?php if ($mostrarDomicilio=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Domicilio</b></td>";
}
?>
<?php if ($mostrarPrivada=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
}
?>
<?php if ($mostrarVendedora=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Vendedora</b></td>";
}
?>
<?php if ($mostrarDescuento=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Descuento</b></td>";
}
?>
<?php if ($mostrarTotal=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
}
?>
<?php if ($mostrarFecha=="on")
{
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
}
?>
<?php 
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
?>
                    <tr>
                </tr>
                <tbody style="background-color:white; color:black;font-size:12px;">
                    <?php while($row=$resultado->fetch_assoc()){ 
  $host = "localhost";
  $user = "
wwwvideo_root";
  $pass = "
V1de0@cces0s";
  $databaseName = "wwwvideo_video_accesos";
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

$intTarjetaID = $row['tarjeta_id'];
$intTarjetaID2 = $row['tarjeta_id2'];
$intTarjetaID3 = $row['tarjeta_id3'];
$intTarjetaID4 = $row['tarjeta_id4'];
$intTarjetaID5 = $row['tarjeta_id5'];

$result1 = mysql_query("SELECT lectura FROM tarjetas WHERE tarjeta_id='$intTarjetaID'");          //query
  $tarjetaID= mysql_fetch_row($result1); 

$result2 = mysql_query("SELECT lectura FROM tarjetas WHERE tarjeta_id='$intTarjetaID2'");          //query
  $tarjetaID2= mysql_fetch_row($result2); 

$result3 = mysql_query("SELECT lectura FROM tarjetas WHERE tarjeta_id='$intTarjetaID3'");          //query
  $tarjetaID3= mysql_fetch_row($result3); 

$result4 = mysql_query("SELECT lectura FROM tarjetas WHERE tarjeta_id='$intTarjetaID4'");          //query
  $tarjetaI4= mysql_fetch_row($result4); 

$result5 = mysql_query("SELECT lectura FROM tarjetas WHERE tarjeta_id='$intTarjetaID5'");          //query
  $tarjetaID5= mysql_fetch_row($result5); 



?>
                        <tr>
<?php if ($mostrarFolio=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['asignacion_id']);
}
?>
                            </td>
<?php if ($mostrarCantidadTarjetas=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
$contadorCantidad = 0;
if($row['tarjeta_id'] != "")
{
$contadorCantidad=$contadorCantidad+1;
}
if($row['tarjeta_id2'] != "")
{
$contadorCantidad=$contadorCantidad+1;
}
if($row['tarjeta_id3'] != "")
{
$contadorCantidad=$contadorCantidad+1;
}
if($row['tarjeta_id4'] != "")
{
$contadorCantidad=$contadorCantidad+1;
}
if($row['tarjeta_id5'] != "")
{
$contadorCantidad=$contadorCantidad+1;
}
if ($row['estatus_id']==0)
{
$contadorCantidad=0;
}
echo $contadorCantidad;
}
?>
                            </td>

<?php if ($mostrarNumTarjeta=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo $tarjetaID[0].' '.$tarjetaID2[0].' '.$tarjetaID3[0].' '.$tarjetaID4[0].' '.$tarjetaID5[0];
}
?>
                            </td>
<?php if ($mostrarNumSerie=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo $row['numero_serie'].' '.$row['numero_serie2'].' '.$row['numero_serie3'].' '.$row['numero_serie4'].' '.$row['numero_serie5'];
}
?>
                            </td>

<?php if ($mostrarSeguros=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
$contadorSeguros= 0;
if($row['utilizo_seguro'] != 0)
{
$contadorSeguros=$contadorSeguros+1;
}
if($row['utilizo_seguro2'] != 0)
{
$contadorSeguros=$contadorSeguros+1;
}
if($row['utilizo_seguro3'] != 0)
{
$contadorSeguros=$contadorSeguros+1;
}
if($row['utilizo_seguro4'] != 0)
{
$contadorSeguros=$contadorSeguros+1;
}
if($row['utilizo_seguro5'] != 0)
{
$contadorSeguros=$contadorSeguros+1;
}
echo $contadorSeguros;
}
?>
</td>
<?php if ($mostrarComprador=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['comprador_id']);
}
?>
                            </td>
<?php if ($mostrarDomicilio=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['calle']).' '.$row['nro_casa'];
}
?>
                            </td>
<?php if ($mostrarPrivada=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['descripcion']);
}
?>
                            </td>
<?php if ($mostrarVendedora=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['usuario']);
}
?>
                            </td>
<?php if ($mostrarDescuento=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode('$'.$row['descuento']);
}
?>
<?php if ($mostrarTotal=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode('$'.$row['precio']);
}
?>
<?php if ($mostrarFecha=="on")
{
                            echo "<td style='text-align: center; padding:5px'>";
echo utf8_decode($row['fecha']);
}
                            echo "<td style='text-align: center; padding:5px'>";
if ($row['estatus_id']==0)
{
$estatus= "Cancelado";
}
if ($row['estatus_id']==1)
{
$estatus= "Activo";
}
if ($row['estatus_id']==2)
{
$estatus= "Reposición";
}

echo utf8_decode($estatus);

$totalVenta=$totalVenta+$row['precio'];

$totalTarjetas=$totalTarjetas+$contadorCantidad;
?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
<br>

<?php echo 'Total de Venta: $'.$totalVenta?>
<br>
<?php echo 'Total de Tarjetas Vendidas: '.$totalTarjetas?>

    <!--<input id="login" name="login" type="submit" value="Generar Reporte">
<a href="output.php?t=word" target="_blank">Word</a>
<a href="output.php?t=excel" target="_blank">Excel</a>
<a href="output.php?t=pdf" target="_blank">Pdf</a>-->
</form>
<form name="consulta_reporte" method="POST" action="exportarVentasExcel.php" target="_blank" >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="privada" name="privada" value="<?php echo $privada;?>">
<input type="hidden" id="vendedora" name="vendedora" value="<?php echo $vendedora;?>">
<input type="hidden" id="mostrarCantidadTarjetas" name="mostrarCantidadTarjetas" value="<?php echo $mostrarCantidadTarjetas;?>">
<input type="hidden" id="mostrarPrivada" name="mostrarPrivada" value="<?php echo $mostrarPrivada;?>">
<input type="hidden" id="mostrarFolio" name="mostrarFolio" value="<?php echo $mostrarFolio;?>">
<input type="hidden" id="mostrarNumTarjeta" name="mostrarNumTarjeta" value="<?php echo $mostrarNumTarjeta;?>">
<input type="hidden" id="mostrarNumSerie" name="mostrarNumSerie" value="<?php echo $mostrarNumSerie;?>">
<input type="hidden" id="mostrarComprador" name="mostrarComprador" value="<?php echo $mostrarComprador;?>">
<input type="hidden" id="mostrarDomicilio" name="mostrarDomicilio" value="<?php echo $mostrarDomicilio;?>">
<input type="hidden" id="mostrarVendedora" name="mostrarVendedora" value="<?php echo $mostrarVendedora;?>">
<input type="hidden" id="mostrarDescuento" name="mostrarDescuento" value="<?php echo $mostrarDescuento;?>">
<input type="hidden" id="mostrarTotal" name="mostrarTotal" value="<?php echo $mostrarTotal;?>">
<input type="hidden" id="mostrarSeguros" name="mostrarSeguros" value="<?php echo $mostrarSeguros;?>">
<input type="hidden" id="mostrarFecha" name="mostrarFecha" value="<?php echo $mostrarFecha;?>">
    <input id="enviarDatos" type="submit" value="Exportar a Excel">

</form>

</div>
</body>

</html>