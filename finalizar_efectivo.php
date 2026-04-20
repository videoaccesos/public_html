<?php 
$idPrivada=$_POST['idPrivada'];
	$idRegistro=$_POST['idRegistro'];
	$nombre=$_POST['nombreRes'];
	$apellidoPaterno=$_POST['apPaternoRes'];
	$apellidoMaterno=$_POST['apMaternoRes'];
	$calle=$_POST['calle'];
	$numeroExterior=$_POST['numExt'];
	$residencia=$_POST['residencia'];
	$ciudad=$_POST['ciudad'];
	$estado=$_POST['estado1'];
	$codigoPostal=$_POST['CP'];
	$telefonoCasa=$_POST['telCasa'];
	$telefonoCelular=$_POST['telCel'];
	$interfon=$_POST['interfon'];
	$correoElectronico=$_POST['correo'];
	$tarjetasCompradas=$_POST['tarjetasCompradas'];
	$numerosTarjetas=$_POST['numerosTarjetas'];
	$residentesRegistrados=$_POST['residentesRegistrados'];
	$visitantesRegistrados=$_POST['visitantesRegistrados'];
	$dudasComentarios=$_POST['dudasComentarios'];
	$numeroReferencia=$_POST['numeroReferencia'];
	$total=$_POST['total'];
	$tipoPago = $_POST['tipoPago'];
	$tienda = $_POST['tienda'];

	 if ($tienda == 1)
    {
      $tienda = "OXXO";
    }
 	if ($tienda == 2)
    {
      $tienda = "SEVEN_ELEVEN";
    }
     if ($tienda == 3)
    {
      $tienda = "EXTRA";
    }
 	if ($tienda == 4)
    {
      $tienda = "CHEDRAUI";
    }
     if ($tienda == 5)
    {
      $tienda = "FARMACIA_BENAVIDES";
    }
 	if ($tienda == 6)
    {
      $tienda = "FARMACIA_ESQUIVAR";
    }
	$idSucursal = 'ca3ea5d2d000706482d80bc2be7bffbf51481386';
	$idUsuario = '8312ba2e08ada99312b12e700709a7005c495b92';
	$productos = 'Tarjetas videoaccesos';



	$email_to = $correoElectronico.", tarjetas@videoaccesos.com";
		$email_subject = "Registro de compra";
		$email_message = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Demystifying Email Design</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
  <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
    <tr>
      <td style="padding: 10px 0 30px 0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
          <tr>
            <td align="center" bgcolor="#0B0B3B" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
              <img src="http://videoaccesos.com/images/videoaccesos.png" alt="Video Accesos" width="250" height="60" style="display: block;" />
            </td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="text-align:center; color: #08088A; font-family: Arial, sans-serif; font-size: 20px;">
                    <b>DATOS DEL REGISTRO</b>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;">
                    <b>Nombre:</b> '.$nombre." ". $apellidoPaterno. " ".$apellidoMaterno.' <br><br> <b>Dirección:</b> '.$calle." #".$numeroExterior. " ".$residencia. " ".$ciudad." ".$estado." ".$codigoPostal.'  <br><br> <b>Teléfono Casa:</b> '.$telefonoCasa.' <br><br> <b>Teléfono Celular:</b> '.$telefonoCelular.' <br><br> <b>Interfón elegido:</b>  '.$interfon.' <br><br> <b>Correo Electrónico:</b>  '.$correoElectronico.' <br><br> <b>Tarjetas Compradas:</b>  '.$tarjetasCompradas.' <br><br> <b>Números de las tarjetas:</b>  '.$numerosTarjetas.' <br><br> <b>Residentes Registrados:</b> '.$residentesRegistrados.' <br><br> <b>Visitantes Registrados:</b> '.$visitantesRegistrados.' <br><br> <b>Dudas o comentarios:</b> '.$dudasComentarios.' 
                  </td>
                </tr>
                <td style="text-align:center; color: #08088A; font-family: Arial, sans-serif; font-size: 20px;">
                    <b>DATOS PARA REALIZAR EL PAGO</b>
                  </td>
                  <tr><td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;">
                    <b>Número de Referencia:</b> '.$numeroReferencia.' <br><br> <b>Tienda en la que pagará:</b> '.$tienda.' <br><br> <b>Tipo de pago:</b>  '.$tipoPago.' <br><br> <b>Total a pagar: </b> $'.$total.' 
                    </td></tr>
              </table>
            </td>
          </tr>
          <tr>
                  <td style="text-align:center; color: #black; font-family: Arial, sans-serif; font-size: 14px;">
                    <center><b>El equipo de VideoAccesos, agradece su preferencia.</b></center><br><br>
                  </td>
                </tr>
          <tr>
            <td bgcolor="#0B0B3B" style="padding: 30px 30px 30px 30px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 12.5px;" width="75%">
                    <b> Dirección:</b><br/><br/>
                      Blvd. Zapata 543 Pte.<br/>
                      Local 5 Col. Almada.<br/>
                      C.P. 80200 Culiacán, Sinaloa.<br/>
                  </td>
                  <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 11px;" width="75%" align="right" width="25%">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <b> Teléfonos:</b><br/>
                       +52 667 712 60 43<br/>
                       +52 667 712 60 45<br/><br/>
                        <b>Correo Electrónico:</b><br/>
                        atencionaclientes@videoaccesos.com
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';

		// Ahora se envia el e-mail usando la funcion mail() de PHP
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: tarjetas@videoaccesos.com\r\n";
		$headers .= "Reply-To: tarjetas@videoaccesos.com\r\n";
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);


$host	=	'https://www.pagofacil.net/ws/public/cash/charge';
$params	=	array(
				'branch_key' =>	$idSucursal ,
				'user_key' =>	$idUsuario ,
				'order_id' =>	$numeroReferencia ,
				'product' =>	$productos ,
				'amount' =>	$total ,
				'store_code' =>	$tienda ,
				'customer' =>	$nombre." ".$apellidoPaterno." ".$apellidoMaterno ,
				'email' =>	$correoElectronico , );
$ch	=	curl_init();
curl_setopt($ch,	CURLOPT_URL,	$host);
curl_setopt($ch,	CURLOPT_SSL_VERIFYPEER,	false);	
curl_setopt($ch,	CURLOPT_RETURNTRANSFER,	true);
curl_setopt($ch,	CURLOPT_POST,	true);
curl_setopt($ch,	CURLOPT_POSTFIELDS,	http_build_query($params));
$result	=	curl_exec($ch);
curl_close($ch);
$data	=	json_decode($result,	true);

 ?>


<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
<head>
	<title>Pagar en Efectivo</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
<style type="text/css">
	
#formulario .salir{
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
#formulario .salir:hover, #formulario .salir:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
}

</style>
<center>	
<br><br>
<img src="images/videoaccesos.png">
			<br><br><br>
			<center><h1 style="color:white;width: 60%;">¡ SU REGISTRO HA SIDO EXITOSO !</h1></center>
			<br>
<center><form name="formulario" id="formulario"  action="http://www.videoaccesos.com">
<br><br>
    <input  type="submit"   name="salir" id="salir" class="salir"  value="Salir">
</form></center>

</body>
</html>