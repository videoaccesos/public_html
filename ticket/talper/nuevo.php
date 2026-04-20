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
		<center><h1>NUEVO EMPLEADO</h1></center>
		<div id="form-main" name="form-main">
			<div id="form-div" name="form-div">
				<section>
					<form name="nuevo_empleado" method="POST" action="guarda_empleado.php" >
						<br>
						<input type="text" id="Clave_Emp" name = "Clave_Emp" class="feedback-input" placeholder="Clave Empleado" onkeypress="return validNumber(event);" required>
						<br>
						<input type="text" id="Nombre" name = "Nombre" maxlength="50" class="feedback-input" placeholder="Nombre(s)" onkeypress="return validLetter(event);" required>
						<br>
						<input type="text" id="ApPaterno" name = "ApPaterno" maxlength="50" class="feedback-input" placeholder="Apellido Paterno" onkeypress="return validLetter(event);" required >
						<br>
						<input type="text" id="ApMaterno" name = "ApMaterno" maxlength="50" class="feedback-input" placeholder="Apellido Materno" onkeypress="return validLetter(event);" required>
						<br>
						<input type="date" id="FecNac" name = "FecNac" class="feedback-input" placeholder="Fecha Nacimiento" required>
						<br>
						<select id="Departamento" name="Departamento" class="feedback-input" > 
					      <option value="1" >Sistemas</option>
					      <option value="2" >Compras </option>
					      <option value="3" >Mercadotecnia</option>
					      <option value="4" >Recursos Humanos</option>
					      <option value="5" >Direcci&oacuten </option>
					      <option value="6" >Bodegas</option>
					    </select>
						<br>
						<input type="text" id="Sueldo" name = "Sueldo" class="feedback-input" placeholder="Sueldo" onkeypress="return validNumber(event);" required >
						<br>
						<input type="submit" name="botonGuardar" id="botonGuardar" value="Guardar">
					</form>
				</section>
				
					<form name="formCancelar" id="formCancelar" method="POST" action="index.php">
						<input type="submit" name="botonCancelar" id="botonCancelar" value="Cancelar">
					</form>
			</div>
		</div>
	</body>
</html>						