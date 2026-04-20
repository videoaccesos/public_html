<?php
	
	require('conexion.php');

$folio=$_REQUEST['folio'];
	$nombre=$_REQUEST['nombre'];
$tecnico_id=99;
if ($nombre == "Juan" || $nombre = "juan" || $nombre = "JUAN")
{
$tecnico_id = 7;
}
if ($nombre == "Mario" || $nombre = "mario" || $nombre = "MARIO")
{
$tecnico_id = 10;
}
if ($nombre == "Eduardo" || $nombre = "eduardo" || $nombre = "EDUARDO")
{
$tecnico_id = 88;
}
if ($nombre == "Alonso" || $nombre = "alonso" || $nombre = "ALONSO")
{
$tecnico_id = 140;
}
if ($nombre == "Javier" || $nombre = "javier" || $nombre = "JAVIER")
{
$tecnico_id = 155;
}
if ($nombre == "Rafael" || $nombre = "rafael" || $nombre = "RAFAEL")
{
$tecnico_id = 103;
}
if ($nombre == "Daniel" || $nombre = "daniel" || $nombre = "DANIEL")
{
$tecnico_id = 104;
}
	$query="SELECT tecnico_id, usuario FROM usuarios_tecnicos order by usuario";
	
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
#asignar {
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

#asignar {
    background: #0040FF;
border-color:white;
}


</style>
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
		<title>Asignar Reporte</title>
	</head>
	<body>
		<center><h1>Asignar Reporte</h1></center>
			<div class="login-block" id="login-block" name="login-block">
				<section>
					<form name="asignar_reporte" method="POST" action="reporte_asignado.php" >
						<input type="hidden" id="folio" name = "folio" class="feedback-input" value="<?php echo $folio; ?>">
						<br><h4>Elige a quien asignarlo:</h4>
<select name="cmbTecnicos" id="cmbTecnicos">

<?php    
if($nombre == "Juan" || $nombre = "juan" || $nombre = "JUAN")
{
    while ( $row = $resultado->fetch_array() )    
    {
        ?>
    
        <option value="<?php echo $row['tecnico_id'] ?>" >
        <?php echo $row['usuario']; ?>
        </option>
        
        <?php
    }    
}
else
{
    ?>
<option value="<?php echo $tecnico_id; ?>" >
<?php echo $nombre; ?>
</option> 
<?php
}
    ?>      

</select>						<br>
						<input type="submit" id="asignar" name="botonAsignar" id="botonAsignar" value="Asignar">
					</form>
				</section>
				
			</div>
	</body>
</html>	