<?php 
//DATOS Y CONEXION A BASE DE DATOS
$server = "localhost";
$username = "wwwvideo_root";
$password = "V1de0@cces0s";
$database = "wwwvideo_video_accesos";
$conexion = @new mysqli($server, $username, $password, $database);

if ($conexion->connect_error)
{
    die('Error de conexion: ' . $conexion->connect_error);
}

$codigoQR=$_GET['qr'];
$privadaID=0;
$residenteID="";
$nombreResidente="";
$numeroTarjeta="";
$nombrePrivada="";
$fechaSolicitud="";
$horaSolicitud="";
$minutosSolicitud="";
$numeroAccesos=0;
$fechaLimite="";
$horaLimite="";
$urlImagen="";
$horaSumar="";
$minutosSumar="";

//CONSULTAMOS EL QR PARA SACAR LA INFORMACION
$sqlQR="SELECT residente_id, tarjeta, privada_id, telefono, fecha_autorizacion, hora_autorizacion, minutos_autorizacion, numero_accesos FROM accesosqr WHERE imagen_qr LIKE '%".$codigoQR."%'";
$consultaQR = $conexion->query($sqlQR);

while($registroQR=$consultaQR->fetch_assoc())
{
    $residenteID = $registroQR["residente_id"];
    $numeroTarjeta = $registroQR["tarjeta"];
    $privadaID = $registroQR["privada_id"];
    $telefono = $registroQR["residente_id"];
    $fechaSolicitud = $registroQR["fecha_autorizacion"];
    $horaSolicitud = $registroQR["hora_autorizacion"];
    $minutosSolicitud = $registroQR["minutos_autorizacion"];
	$numeroAccesos = $registroQR["numero_accesos"];
}

//CONSULTAMOS NOMBRE DE LA PRIVADA
$sqlPrivada="SELECT descripcion FROM privadas WHERE privada_id=$privadaID";
$consultaPrivada = $conexion->query($sqlPrivada);

while($registroPrivada=$consultaPrivada->fetch_assoc())
{
    $nombrePrivada = $registroPrivada["descripcion"];
}

//CONSULTAMOS NOMBRE DEL RESIDENTE
$sqlResidente="SELECT nombre FROM residencias_residentes WHERE residente_id='".$residenteID."'";
$consultaResidente = $conexion->query($sqlResidente);

while($registroResidente=$consultaResidente->fetch_assoc())
{
    $nombreResidente = $registroResidente["nombre"];
}

//URL PARA OBTENER LA IMAGEN
$urlImagen = "imagenesQR/qr".$codigoQR.".png";

//RECORTAMOS LA HORA DE LA SOLICITUD
$horaTemporal = $horaSolicitud;
$resultado = substr($horaTemporal,0,2);
$horaRecortada=$resultado;

//SACAMOS LA FECHA Y HORA LIMITE
$horaInicial=$horaSolicitud;
$minutoAnadir=$minutosSolicitud;
$segundos_horaInicial=strtotime($horaInicial);
$segundos_minutoAnadir=$minutoAnadir*60;
$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);

$fechaLimite = $fechaSolicitud." ".$nuevaHora;

//CERRAMOS LA CONEXION A LA BASE DE DATOS
$conexion->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>VideoAccesos - Acceso QR</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="twitter:title" content="VideoAccesos - Acceso QR">
<meta name="twitter:description" content="Accede a la residencial mostrando este codigo QR.">
<meta name="twitter:image" content="https://videoaccesos.com/serviciosVB/imagenes/test.png">
<meta name="twitter:url" content="https://www.videoaccesos.com">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

<style>

.logo {
    width: 250px;
    height: 70px;
    background: url('imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

#imagenQR{
	width: 255px;
	height: 255px;
	background: url('<?php echo $urlImagen;?>') no-repeat;
}

</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
	<div class="main-w3layouts wrapper">
		<div class="logo"></div>
		<div class="main-agileinfo">
			<div class="agileits-top"> 
				<form action="#" method="post"> 
					<p style="text-transform: uppercase;font-size: 20px;font-weight: bold;">C&oacute;digo de Acceso</p><br>
					<a style="color:white;text-align: left; font-size: 16px;font-weight: bold;">Residente: </a>
					<a style="color:white; font-size: 14px;;"><?php echo $nombreResidente ?></a> 
					<br>
					<a style="color:white;text-align: left; font-size: 16px;font-weight: bold;">Privada: </a>
					<a style="color:white; font-size: 14px;;"><?php echo $nombrePrivada ?></a> 
					<br>
					<a style="color:white;text-align: left; font-size: 16px;font-weight: bold;">Accesos: </a>
					<a style="color:white; font-size: 14px;;"><?php echo $numeroAccesos ?> disponible(s) </a><br>
					<a style="color:white;text-align: left; font-size: 16px;font-weight: bold;">Fecha/Hora Inicial: </a>
					<a style="color:white; font-size: 14px;;"><?php echo $fechaSolicitud." ".$horaSolicitud ?></a>
					<br>
					<a style="color:white;text-align: left; font-size: 16px;font-weight: bold;">Fecha/Hora Final: </a>
					<a style="color:white; font-size: 14px;;"><?php echo $fechaLimite ?></a> 
					<br><br>
					<center><div id="imagenQR"></div>
					<a href="<?php echo $urlImagen;?>" download>Click para descargar QR</a><center>
					<a><?php echo "http://www.videoaccesos.com/serviciosVB/".$urlImagen;?></a>
					<br>
					<p style="font-size: 14px; font-weight: bold;">Nota: deber&aacute; colocar el c&oacute;digo QR en la c&aacute;mara y se le dar&aacute; el acceso autom&aacute;ticamente.</p>
					
				</form>
			</div>	 
		</div>	
		<!-- copyright -->
		<div class="w3copyright-agile">
			<p>© 2018 VideoAccesos | Todos los derechos reservados.</p>
		</div>
	</div>	
</body>
</html>