<?php 
	
	require('../imprimirContrato/php/conexion.php');

	$opcion=$_POST['cmbOpciones'];
	$observaciones=$_POST['observaciones'];
$usuario=$_POST['usuario'];
$privadaID=$_POST['privadaID'];

if ($_POST['fechaInicial'] != "")
{
$fechaInicial=$_POST['fechaInicial'];
}
else
{
	$fechaInicial = "";
}

if ($_POST['fechaFinal'] != "")
{
$fechaFinal=$_POST['fechaFinal'];
}
else
{
	$fechaFinal = "";
}

$nombreOpcion="";
if ($opcion==1)
{
	$nombreOpcion="Activación de Tarjetas";
}
if ($opcion==2)
{
	$nombreOpcion="Suspensión de Tarjetas";
}
if ($opcion==3)
{
	$nombreOpcion="Solicitud de Videos";
}
if ($opcion==4)
{
	$nombreOpcion="Reporte de Fallas";
}
if ($opcion==5)
{
	$nombreOpcion="Solicitudes o Quejas";
}

$area="";
if ($opcion == 1 || $opcion == 2)
{
	$area="Atención a Clientes";
}
if ($opcion == 3 || $opcion == 4)
{
	$area="Soporte Técnico";
}
if ($opcion == 5)
{
	$area="Gerencia";
}
$estatus=2;

	$query=mysql_query("INSERT INTO reportes_administradores VALUES (NULL,$privadaID,'$usuario',$opcion,'$observaciones','$fechaInicial','$fechaFinal',CURRENT_TIMESTAMP,$estatus)");
	


	$rs = mysql_query("SELECT MAX(id_registro) AS id FROM reportes_administradores");
if ($row = mysql_fetch_row($rs)) {
$numTicket = trim($row[0]);
}

$rs2 = mysql_query("SELECT fecha_hora_modificacion FROM reportes_administradores WHERE id_registro=$numTicket");
if ($row2 = mysql_fetch_row($rs2)) {
$fechaRegistro = trim($row2[0]);
}

$queryNombre= mysql_query("SELECT p.descripcion FROM privadas as p INNER JOIN reportes_administradores as ra ON ra.privada_id = p.privada_id where ra.id_registro=$numTicket");

while($registroNombre= mysql_fetch_array($queryNombre)){
$nombrePrivada= $registroNombre['descripcion'];
}

$correoElectronico="mike_ramos14@hotmail.com";
if ($area == "Atención a Clientes")
{
$email_to = $correoElectronico.", atencionaclientes@videoaccesos.com";
}
if ($area == "Soporte Técnico")
{
$email_to = $correoElectronico.", daniel.aramburo@videoaccesos.com";
}
if ($area == "Gerencia")
{
$email_to = $correoElectronico.", atencionaclientes@videoaccesos.com, valeria@videoaccesos.com";
}
		$email_subject = "Confirmación del Ticket #".$numTicket;
if ($opcion == 3 || $opcion == 4)
{
$email_message = '<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body style="background-color:rgba(227,227,227,1.00)">
<table width="600" height="142" border="0" cellspacing="0" cellpadding="0" align="center" background="http://www.videoaccesos.com/imagenes/header.jpg">
  <tbody>
    <tr>
      <td><table width="545" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><p style="text-align:right; color:#fff; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif"><span style="font-size:20px">Folio #'.$numTicket.'</span><br>'.$fechaRegistro.'<br>&nbsp;</p></td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
<table style="background-color: #fff;" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<table style="background-color: #fff;" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><h4 style="text-align:center; font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; color: #0B0B61; font-weight:bold">¡SU TICKET HA SIDO GENERADO EXITOSAMENTE!</h4><p style="font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; text-align:center; margin-top: -15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El área de '.$area.' se encargará de darle seguimiento
a su solicitud:</p></td>
    </tr>
    <tr>
      <td><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td style="border-bottom: 1px solid #808080;"><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><p style="font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; color:#808080;">'."Privada: ".$nombrePrivada.'<br>'."Solicitante: ". $usuario.'<br><br>'."Solicitud: ".$nombreOpcion.'</p></td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
    <tr>
      <td style="border-bottom: 1px solid #808080;"><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><p style="font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; color:#808080;">'.
      "Fecha y Hora Inicial: ".$fechaInicial."<br>"."Fecha y Hora Final: ".$fechaFinal."<br><br>".$observaciones.'</p></td>
    </tr>
  </tbody>
</table>
</td>
    </tr><tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
    <tr>
      <td><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><table width="67" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/register.jpg" width="62" height="62" alt=""/></td>
    </tr>
  </tbody>
</table>
<h4 style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:bold;margin-top: 0px;">Registro<h4><p style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:100;margin-top: -20px;">Genera ticket</p></td>
      <td><table width="36" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/arrow.jpg" width="36" height="23" alt=""/></td>
    </tr>
  </tbody>
</table>
</td>
      <td><table width="56" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/solicitud.jpg" width="56" height="59" alt=""/></td>
    </tr>
  </tbody>
</table>
<h4 style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:bold;margin-top: 0px;">Solicitud<h4><p style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:100;margin-top: -20px;">Se atiende la solicitud</p>
</td>
      <td><table width="36" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/arrow.jpg" width="36" height="23" alt=""/></td>
    </tr>
  </tbody>
</table>
</td>
      <td> &nbsp; <table "width="66" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/approve.jpg" width="66" height="64" alt=""/></td>
    </tr>
  </tbody>
</table>
<h4 style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:bold;margin-top: 0px;">Solución<h4><p style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:100;margin-top: -20px;">Se soluciona en un lapso <br>
no mayor a 48 hrs</p>
</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
<table style="background-color: #fff;" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<table width="600" height="90" border="0" cellspacing="0" cellpadding="0" align="center" background="http://www.videoaccesos.com/imagenes/footer.jpg">
  <tbody>
    <tr>
      <td><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody>
          <tr>
            <td><p style="color: #596B87; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-size: 12px; ">&nbsp;<br><span style="font-weight: bold;">DATOS DE CONTACTO PARA DUDAS O INFORMACIÓN:</span><br>
            Email: atencionaclientes@videoaccesos.com - Tel: 7126043/7126045 <br> Dirección: Zapata #543 Col. Almada</p></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
';
}
else
{
		$email_message = '<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body style="background-color:rgba(227,227,227,1.00)">
<table width="600" height="142" border="0" cellspacing="0" cellpadding="0" align="center" background="http://www.videoaccesos.com/imagenes/header.jpg">
  <tbody>
    <tr>
      <td><table width="545" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><p style="text-align:right; color:#fff; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif"><span style="font-size:20px">Folio #'.$numTicket.'</span><br>'.$fechaRegistro.'<br>&nbsp;</p></td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
<table style="background-color: #fff;" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<table style="background-color: #fff;" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><h4 style="text-align:center; font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; color: #0B0B61; font-weight:bold">¡SU TICKET HA SIDO GENERADO EXITOSAMENTE!</h4><p style="font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; text-align:center; margin-top: -15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El área de '.$area.' se encargará de darle seguimiento
a su solicitud:</p></td>
    </tr>
    <tr>
      <td><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td style="border-bottom: 1px solid #808080;"><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><p style="font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; color:#808080;">'."Privada: ".$nombrePrivada.'<br>'."Solicitante: ". $usuario.'<br><br>'."Solicitud: ".$nombreOpcion.'</p></td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
    <tr>
      <td style="border-bottom: 1px solid #808080;"><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><p style="font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; color:#808080;">'.$observaciones.'</p></td>
    </tr>
  </tbody>
</table>
</td>
    </tr><tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
    <tr>
      <td><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><table width="67" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/register.jpg" width="62" height="62" alt=""/></td>
    </tr>
  </tbody>
</table>
<h4 style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:bold;margin-top: 0px;">Registro<h4><p style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:100;margin-top: -20px;">Genera ticket</p></td>
      <td><table width="36" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/arrow.jpg" width="36" height="23" alt=""/></td>
    </tr>
  </tbody>
</table>
</td>
      <td><table width="56" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/solicitud.jpg" width="56" height="59" alt=""/></td>
    </tr>
  </tbody>
</table>
<h4 style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:bold;margin-top: 0px;">Solicitud<h4><p style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:100;margin-top: -20px;">Se atiende la solicitud</p>
</td>
      <td><table width="36" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/arrow.jpg" width="36" height="23" alt=""/></td>
    </tr>
  </tbody>
</table>
</td>
      <td> &nbsp; <table "width="66" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td><img src="http://www.videoaccesos.com/imagenes/approve.jpg" width="66" height="64" alt=""/></td>
    </tr>
  </tbody>
</table>
<h4 style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:bold;margin-top: 0px;">Solución<h4><p style="text-align:center; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-weight:100;margin-top: -20px;">Se soluciona en un lapso <br>
no mayor a 48 hrs</p>
</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
<table style="background-color: #fff;" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<table width="600" height="90" border="0" cellspacing="0" cellpadding="0" align="center" background="http://www.videoaccesos.com/imagenes/footer.jpg">
  <tbody>
    <tr>
      <td><table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody>
          <tr>
            <td><p style="color: #596B87; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif; font-size: 12px; ">&nbsp;<br><span style="font-weight: bold;">DATOS DE CONTACTO PARA DUDAS O INFORMACIÓN:</span><br>
            Email: atencionaclientes@videoaccesos.com - Tel: 7126043/7126045 <br> Dirección: Zapata #543 Col. Almada</p></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
';
}
		// Ahora se envia el e-mail usando la funcion mail() de PHP
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: ticketsadministradores@videoaccesos.com\r\n";
		$headers .= "Reply-To: ticketsadministradores@videoaccesos.com\r\n";
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);


	
?>

<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
<head>
	<title>Ticket Generado</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
<style type="text/css">
body {
    background-image: url('../ticket/imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

#salir{
	width: 150px;
height: 50px;
	background: #08088A;
	font-weight: bold;
font-size:16px;
	color: white;
	border: 0 none;
	border-radius: 3px;
	cursor: pointer;
}
#salir:hover, #salir:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
}

</style>
<center>	
<br><br>
<img src="../ticket/imagenes/videoaccesos.png">
			<br><br><br>
				<center><h1 style="color:white;width: 60%;">¡SU TICKET HA SIDO GENERADO EXITOSAMENTE!</h1></center>
			<br>
<center><form name="formulario" id="formulario"  action="index.php">
<br><br>
    <input type="submit" id="salir" value="Salir">
</form></center>

</body>
</html>