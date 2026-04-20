<?php 
	
	require('conexion.php');


	$claveEmpleado=$_POST['Clave_Emp'];
	$nombre=$_POST['Nombre'];
	$apellidoMaterno=$_POST['ApMaterno'];
	$apellidoPaterno=$_POST['ApPaterno'];
	$fechaNacimiento=$_POST['FecNac'];
	$departamento=$_POST['Departamento'];
	$sueldo=$_POST['Sueldo'];

	$query="INSERT INTO Empleados (Clave_Emp,Nombre, ApMaterno, ApPaterno, FecNac, Departamento, Sueldo) VALUES ('$claveEmpleado','$nombre','$apellidoMaterno','$apellidoPaterno','$fechaNacimiento','$departamento', '$sueldo')";
	
	$resultado=$mysqli->query($query);
	
?>

<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
	<head>
		<title>Guardar empleado</title>
	</head>
	<body>
		<center>	
			
			<?php if($resultado>0){ ?>
				<h1>Empleado guardado correctamente</h1>
				<?php }else{ ?>
				<h1>Error al guardar el empleado</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="index.php">Ir al inicio</a>
			
		</center>
	</body>
	</html>	