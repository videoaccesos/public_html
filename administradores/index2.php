<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresar谩 a login.php
if(!isset($_SESSION['username'])) 
{
  header('Location: login.php'); 
  exit();
}
$nombre = $_SESSION['username'];
	require('conexion.php');

$query1="SELECT privada_id FROM usuarios_administradores WHERE usuario='$nombre'";
	
	$resultado1=$mysqli->query($query1);


while($row1=$resultado1->fetch_assoc()){
$privadaID = $row1['privada_id'];

$query="SELECT p.descripcion from privadas as p inner join usuarios_administradores as ua on p.privada_id = ua.privada_id where ua.privada_id=$privadaID";
	
	$resultado=$mysqli->query($query);


while($row=$resultado->fetch_assoc()){
$nombrePrivada = $row['descripcion'];
}
}



 ?>
 <div style="text-align: right; font-size:18px; margin:5px;"><a style="color:#0040FF">Privada: </a><a style="color:white"> <?php echo $nombrePrivada;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="color:#0040FF">Usuario: </a><a style="color:white"> <?php echo $nombre;?>   </a><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="color:#FFFF00; font-size:15px;" href="logout.php">Cerrar Sesi&oacute;n</a></div>
 <?
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="imprimirContrato/js/jquery.js"></script>
<script src="imprimirContrato/js/myjava.js"></script>
<link href="imprimirContrato/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="imprimirContrato/bootstrap/js/bootstrap.min.js"></script>
<script src="imprimirContrato/bootstrap/js/bootstrap.js"></script>

<script language="javascript" type="text/javascript">

function getval(sel) {
       //alert(sel.value);

if (sel.value == 1 || sel.value == 2)
{
var fechaInicial = document.getElementById("fechaInicial");
 fechaInicial.style.display = 'none';
var fechaFinal= document.getElementById("fechaFinal");
 fechaFinal.style.display = 'none';

var textoFechaInicial = document.getElementById("textoFechaInicial");
 textoFechaInicial.style.display = 'none';
var textoFechaFinal = document.getElementById("textoFechaFinal");
 textoFechaFinal.style.display = 'none';

var textoInterfon = document.getElementById("textoInterfon");
 textoInterfon.style.display = 'block';

}

if (sel.value == 3 || sel.value == 4)
{

var fechaInicial = document.getElementById("fechaInicial");
 fechaInicial.style.display = 'block';
var fechaFinal= document.getElementById("fechaFinal");
 fechaFinal.style.display = 'block';

var textoFechaInicial = document.getElementById("textoFechaInicial");
 textoFechaInicial.style.display = 'block';
var textoFechaFinal = document.getElementById("textoFechaFinal");
 textoFechaFinal.style.display = 'block';

var textoInterfon = document.getElementById("textoInterfon");
 textoInterfon.style.display = 'none';
}
    }

</script>

<title>Reportes de Administradores</title>
<style>
body {
    background-image: url('../ticket/imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

a{
font-size:14px;
font-weight:bold;
color:#0431B4;
}

.logo {
    width: 250px;
    height: 70px;
    background: url('../ticket/imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 7px 20px 7px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 7px solid #0040FF;
    margin: 0 auto;
margin-bottom:20px;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 18px;
}

.login-block input#fechaInicial, input#fechaFinal,#cmbPrivadas,#cmbTecnicos,cmbEstatus{
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}
.login-block select {
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block textarea {
    width: 100%;
    height: 60px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#fechaInicial{
margin-top:6px;
    background: #fff url('../ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaInicial:focus {
margin-top:6px;
    background: #fff url('../ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaFinal{
margin-top:6px;
    background: #fff url('../ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaFinal:focus{
margin-top:6px;
    background: #fff url('../ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block #cmbPrivadas{
margin-top:6px;
    background: #fff url('../ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbPrivadas:focus {
margin-top:6px;
    background: #fff url('../ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbOpciones{
margin-top:6px;
    background: #fff url('../ticket/imagenes/opciones.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbOpciones:focus {
margin-top:6px;
    background: #fff url('../ticket/imagenes/opciones.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #observaciones{
margin-top:6px;
    background: #fff url('../ticket/imagenes/comentarios.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #observaciones:focus {
margin-top:6px;
    background: #fff url('../ticket/imagenes/comentarios.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}


.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

#login{
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

#login {
    background: #0040FF;
border-color:white;
}


</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="frmReportes" id="frmReportes" method="POST" action="#">
    <h3 style="text-align:center;color:#0040FF">Reporte de Administradores</h3>
    <a style="color:black;">Seleccione la opci&oacute;n deseada:<a/>
   <select style="color:#08088A;"  name="cmbOpciones" id="cmbOpciones" onchange="getval(this)">
<option value="1" >Activaci&oacute;n de Tarjetas</option>
<option value="2" >Desactivaci&oacute;n de Tarjetas</option>
<option value="3" >Solicitud de Videos</option>
<option value="4" >Reporte de Fallas</option>
   </select>
<a  style="color:black;">Favor de escribir detalladamente lo que necesita:<a/>
<textarea type="text" id="observaciones" name = "observaciones" class="feedback-input"></textarea>
<a id="textoInterfon" style="font-size:9.5px; color:red; display:block;">*Especifique si desea activar/desactivar tambi&eacute;n los interfones*<a/>
<br>
<a id="textoFechaInicial" style="color:black; display:none;">Fecha y Hora Inicial:<a/> 
<input id="fechaInicial" style="color:#08088A; display:none;" type="datetime-local" id="fechaInicial" value="<?php echo date("Y-m-d");?>" name = "fechaInicial" class="feedback-input">
<a id="textoFechaFinal" style="color:black; display:none;">Fecha y Hora Final:<a/>
<input id="fechaFinal" style="color:#08088A; display:none;" type="datetime-local" id="fechaFinal" value="<?php echo date("Y-m-d");?>" name="fechaFinal" class="feedback-input">


    <input id="login" type="submit" value="Generar Reporte">

</form>
</div>
</body>

</html>