<?php 
	
require('imprimirContrato/php/conexion.php');

$privada=$_POST["cmbPrivadas"];
$observaciones=$_POST["observaciones"];
$usuario=0;$sql = "INSERT INTO visitas VALUES ('$privada','$observaciones',CURRENT_TIMESTAMP,$usuario)";
								$result = mysql_query($sql);
?>

<html>
	<head>
		<title>Registrar Visita</title>
	</head>
	<body>
		<center>	
			
			<?php if($result >0){ ?>
				<h1>Visita Registrada Correctamente</h1>
				<?php }else{ ?>
				<h1>Error al Registrar Visita</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="../../app/">Ir al inicio</a>
			
		</center>
	</body>
	</html>	