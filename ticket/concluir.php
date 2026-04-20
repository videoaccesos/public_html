<?php
	
	require('conexion.php');
	$folio=$_GET['folio'];

	$query="SELECT diagnostico_id, descripcion FROM diagnosticos order by descripcion";
	
	$resultado=$mysqli->query($query);

?>
<html>
<style>
body {
    background-image: url('imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

.logo {
    width: 250px;
    height: 70px;
    background: url('imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #0040FF;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 10px 0 10px;
    outline: none;
}
.login-block select{
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
padding: 0 10px 0 10px;
    outline: none;
}

.login-block input#DetalleDiagnostico {
    background-size: 16px 80px;
}

.login-block input#DetalleDiagnostico:focus {
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block button {
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

.login-block button:hover {
    background: #0040FF;
}
#concluir {
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

#concluir {
    background: #0040FF;
border-color:white;
}


</style>
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
		<title>Concluir Reporte</title>
	</head>
	<body>
		<center><h1>Concluir Reporte</h1></center>
			<div class="login-block" id="login-block" name="login-block">
				<section>
					<form name="concluir_reporte" method="POST" action="reporte_concluido.php" >
						<br>
						<input type="hidden" id="folio" name = "folio" class="feedback-input" value="<?php echo $folio; ?>">
						<br><h4>Elige el diagnóstico:</h4>
<select name="cmbDiagnosticos" id="cmbDiagnosticos">

<?php    
    while ( $row = $resultado->fetch_array() )    
    {
        ?>
    
        <option value=" <?php echo $row['diagnostico_id'] ?> " >
        <?php echo $row['descripcion']; ?>
        </option>
        
        <?php
    }    
    ?>      

</select>						
<br><h4>Detalle del diagnóstico:</h4>
						<input type="text" id="detalleDiagnostico" name = "detalleDiagnostico" maxlength="100" class="feedback-input">
						<br>
<h4>Tiempo tardado (Minutos)</h4>
<input style="width:20%" type="text" id="tiempo" name = "tiempo" maxlength="3" class="feedback-input">
						<br>
						<input type="submit" id="concluir" name="botonConcluir" id="botonConcluir" value="Concluir">
					</form>
				</section>
				
			</div>
	</body>
</html>	
