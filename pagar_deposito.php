<?php 

// CONEXION A LA BASE DE DATOS
        $conexion = mysql_connect('localhost', 'wwwvideo_root', 'V1de0@cces0s') or die ('No se puede conectar con el servidor');
        mysql_select_db('videoacc_pagos') or die ('No se puede seleccionar la base de datos');

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
	$correoElectronico=$_POST['correo'];
	$interfon=$_POST['interfon'];
	$tarjetasCompradas=$_POST['tarjetasCompradas'];
	$numerosTarjetas=$_POST['numerosTarjetas'];
	$residentesRegistrados=$_POST['residentesRegistrados'];
	$visitantesRegistrados=$_POST['visitantesRegistrados'];
	$dudasComentarios=$_POST['dudasComentarios'];
	$numeroReferencia=$_POST['numeroReferencia'];
	$total=$_POST['total'];
	if(isset($_POST["pagoDeposito"]))
	{
		$tipoPago = "Pago por Deposito o Transferencia";
	}

	$sql="INSERT INTO usuarios (id_privada,id_registro,nombre,apellido_paterno, apellido_materno, calle, numero_exterior, nombre_residencial, ciudad, estado, codigo_postal, telefono_casa, telefono_celular, interfon, correo_electronico, tarjetas_elegidas, total, numero_tarjetas, residentes, visitantes, dudas_comentarios, numero_referencia, tipo_pago) VALUES ('".$idPrivada."','".$idRegistro."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$calle."','".$numeroExterior."','".$residencia."', '".$ciudad."', '".$estado."', '".$codigoPostal."', '".$telefonoCasa."', '".$telefonoCelular."','".$interfon."','".$correoElectronico."', '".$tarjetasCompradas."','".$total."','".$numerosTarjetas."','".$residentesRegistrados."','".$visitantesRegistrados."','".$dudasComentarios."','".$numeroReferencia."','".$tipoPago."')";
	
	$result = mysql_query($sql);

$insert_id = mysql_insert_id();

 ?>
<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
<head>
	<title>Pagar en Efectivo</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
<style type="text/css">
	
#msform .finalizar{
	width: 250px;
height: 50px;
	background: #08088A;
	font-weight: bold;
font-size:16px;
	color: white;
	border: 0 none;
	border-radius: 3px;
	cursor: pointer;
}
#msform .finalizar:hover, #msform .finalizar:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
}
</style>

<center>	
<br><br>
<img src="images/videoaccesos.png">
			<br><br><br>
			<!--<center><h1 style="color:white;width: 60%;">¡ Su Registro Ha Sido Exitoso !</h1></center> -->
			<br>
<h4 style="color:white;width: 60%; text-align: justify;">Para concluir su compra presione el botón "Finalizar Compra", posteriormente verifique en su bandeja de entrada el correo que le enviamos con la información que nos proporcionó y las instrucciones para realizar el pago, si no encuentra busque en su bandeja de correos no deseados o spam. Recuerde que su correo registrado es a donde le llegarán las notificaciones de acceso a su residencia.</h4>

<center><form name="msform" id="msform" method="post"  action="finalizar_deposito.php">
<input type="hidden" name="nombreRes" id="nombreRes" value="<?php echo $nombre ?>"/>
    
    <input type="hidden" name="apPaternoRes" id="apPaternoRes" value="<?php echo $apellidoPaterno ?>"/>
    
    <input type="hidden" name="apMaternoRes" id="apMaternoRes"  value="<?php echo $apellidoMaterno ?>"/>
    
    <input type="hidden" name="calle"  id="calle"  value="<?php echo $calle ?>"/>
    
    <input type="hidden" name="numExt" id="numExt"  value="<?php echo $numeroExterior ?>"/>

    <input type="hidden" name="residencia" id="residencia"  value="<?php echo $residencia ?>" />

    <input type="hidden" name="ciudad" id="ciudad" value="<?php echo $ciudad ?>"/>

    <input type="hidden" name="estado1" id="estado1"  value="<?php echo $estado ?>"/>

    <input type="hidden" name="CP" id="CP"  value="<?php echo $codigoPostal ?>"/>

    <input type="hidden" name="telCasa" id="telCasa"  value="<?php echo $telefonoCasa ?>"/>

    <input type="hidden" name="telCel" id="telCel" value="<?php echo $telefonoCelular ?>" />

    <input type="hidden" name="interfon" id="interfon" value="<?php echo $interfon ?>"/>

    <input type="hidden" name="correo" id="correo" value="<?php echo $correoElectronico ?>"/>

	<input type="hidden" name="tarjetasCompradas" id="tarjetasCompradas"  value="<?php echo $tarjetasCompradas ?>"/>

    <input type="hidden" name="numerosTarjetas" id="numerosTarjetas" value="<?php echo $numerosTarjetas ?>" />

    <input type="hidden" name="residentesRegistrados" id="residentesRegistrados" value="<?php echo $residentesRegistrados ?>"/>

    <input type="hidden" name="visitantesRegistrados" id="visitantesRegistrados" value="<?php echo $visitantesRegistrados ?>"/>

	<input type="hidden" name="dudasComentarios" id="dudasComentarios" value="<?php echo $dudasComentarios ?>"/>

	<input type="hidden" name="idPrivada" id="idPrivada" value="<?php echo $idPrivada ?>"/>

	<input type="hidden" name="idRegistro" id="idRegistro" value="<?php echo $idRegistro ?>"/>

	<input type="hidden" name="numeroReferencia" id="numeroReferencia" value="<?php echo $numeroReferencia ?>"/>

	<input type="hidden" name="total" id="total" value="<?php echo $total ?>"/>

	<input type="hidden" name="tipoPago" id="tipoPago" value="<?php echo $tipoPago ?>"/>

<input type="submit" name="finalizar" class="finalizar" value="Finalizar Compra" ></input>
</form></center>
</body>
</html>