<?php 
	
require('imprimirContrato/php/conexion.php');

$administrador=$_POST["administrador"];
$nombrePrivada=$_POST["nombrePrivada"];
$domicilio=$_POST["domicilio"];
$telefono=$_POST["telefono"];
$observaciones=$_POST["observaciones"];
$usuario=0;

$sql = "INSERT INTO prospectos VALUES ('$administrador','$nombrePrivada','$domicilio','$telefono','$observaciones',CURRENT_TIMESTAMP,$usuario)";
								$result = mysql_query($sql);
?>

<html>
	<head>
		<title>Registro de Prospecto</title>
	</head>
	<body>
		<center>	
			
			<?php if($result >0){ ?>
				<h1>Prospecto Registrado Correctamente</h1>
				<?php }else{ ?>
				<h1>Error al Registrar Prospecto</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="../../app/">Ir al inicio</a>
			
		</center>
	</body>
	</html>	