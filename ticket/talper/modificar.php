<?php
	
	require('conexion.php');
	$claveEmpleado=$_GET['Clave_Emp'];
	
	$query="SELECT Empleados.Nombre,Empleados.ApPaterno,Empleados.ApMaterno,Empleados.FecNac,Empleados.Departamento,Empleados.Sueldo, Departamentos.Puesto, Departamentos.Descripcion FROM Empleados,Departamentos WHERE Empleados.Clave_Emp='$claveEmpleado'";
	
	$resultado=$mysqli->query($query);
	
	$row=$resultado->fetch_assoc();
	$nombre_departamento="Hola";
?>

<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
	<head>
		<title>Empleados</title>
			<script>
      function validNumber(e) 
      {
      var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
      return ((tecla > 47 && tecla < 58) || tecla == 8);
      }
      function validLetter(e) 
      {
      var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
      var especiales = [8, 32, 13];/*back, space, enter */
        for (var i in especiales) 
        {
          if (tecla == especiales[i]) { return true;/*break; */}
        }
        return (((tecla > 96 && tecla < 123) || (tecla > 64 && tecla < 91)) || tecla == 8);
      }

    </script>
	</head>
	<body>
		<center><h1>MODIFICAR EMPLEADO</h1></center>
		<div id="form-main" name="form-main">
			<div id="form-div" name="form-div">
				<section>
					<form name="modificar_empleado" method="POST" action="mod_empleado.php" >
						<br>
						<input type="text" id="Clave_Emp" name = "Clave_Emp" class="feedback-input" value="<?php echo $claveEmpleado; ?>" onkeypress="return validNumber(event);" required>
						<br>
						<input type="text" id="Nombre" name = "Nombre" maxlength="50" class="feedback-input" value="<?php echo $row['Nombre']; ?>" onkeypress="return validLetter(event);" required >
						<br>
						<input type="text" id="ApPaterno" name = "ApPaterno" maxlength="50" class="feedback-input" value="<?php echo $row['ApPaterno']; ?>" onkeypress="return validLetter(event);" required >
						<br>
						<input type="text" id="ApMaterno" name = "ApMaterno" maxlength="50" class="feedback-input" value="<?php echo $row['ApMaterno']; ?>" onkeypress="return validLetter(event);" required >
						<br>
						<input type="date" id="FecNac" name = "FecNac" class="feedback-input" value="<?php echo $row['FecNac']; ?>" required >
						<br>
						<select id="Departamento" name="Departamento" class="feedback-input" required >
							<option value="1">Sistemas</option>
							<option value="2">Compras</option>
							<option value="3">Mercadotecnia</option>
							<option value="4">Recursos Humanos</option>
							<option value="5">Direcci&oacuten</option>
							<option value="6">Bodegas</option>
							<option selected="selected" value="<?php echo $row['Departamento']; ?>">
								<?php if ($row['Departamento'] == '1')
								echo "Sistemas";
								elseif($row['Departamento'] == '2')
								{
									echo "Compras";
								}
								elseif($row['Departamento'] == '3')
								{
									echo "Mercadotecnia";
								}
								elseif($row['Departamento'] == '4')
								{
									echo "Recursos Humanos";
								}
								elseif($row['Departamento'] == '5')
								{
									echo "Dirección";
								}
								elseif($row['Departamento'] == '6')
								{
									echo "Bodegas";
								}
								?>
							</option>
					    </select>
						<br>
						<input type="text" id="Sueldo" name = "Sueldo" class="feedback-input" value="<?php echo $row['Sueldo']; ?>" onkeypress="return validNumber(event);" required>
						<br>
						<input type="submit" name="botonEditar" id="botonEditar" value="Editar">
					</form>
				</section>
				
					<form name="formCancelar" id="formCancelar" method="POST" action="index.php">
						<input type="submit" name="botonCancelar" id="botonCancelar" value="Cancelar">
					</form>
			</div>
		</div>
	</body>
</html>	
