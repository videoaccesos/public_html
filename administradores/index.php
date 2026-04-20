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

$query2="SELECT id_registro, observaciones, estatus FROM reportes_administradores where usuario='$nombre'";
	
	$resultado2=$mysqli->query($query2);

 ?>
 <div style="text-align: right; font-size:18px; margin:5px;"><a style="color:#0040FF">Privada: </a><a style="color:white"> <?php echo $nombrePrivada;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="color:#0040FF">Usuario: </a><a style="color:white"> <?php echo $nombre;?>   </a><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="color:#FFFF00; font-size:15px;" href="logout.php">Cerrar Sesi&oacute;n</a></div>
 <?
?>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Tickets Administradores</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
<script language="javascript" type="text/javascript">

function getval(sel) {
       //alert(sel.value);

if (sel.value == 1 || sel.value == 2 || sel.value == 5)
{
var fechaInicial = document.getElementById("fechaInicial");
 fechaInicial.style.display = 'none';
var fechaFinal= document.getElementById("fechaFinal");
 fechaFinal.style.display = 'none';

var textoFechaInicial = document.getElementById("textoFechaInicial");
 textoFechaInicial.style.display = 'none';
var textoFechaFinal = document.getElementById("textoFechaFinal");
 textoFechaFinal.style.display = 'none';

//var textoInterfon = document.getElementById("textoInterfon");
 //textoInterfon.style.display = 'block';
var textoVideo = document.getElementById("textoVideo");
 textoVideo.style.display = 'none';

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

//var textoInterfon = document.getElementById("textoInterfon");
 //textoInterfon.style.display = 'none';
var textoVideo = document.getElementById("textoVideo");
 textoVideo.style.display = 'block';
}
    }

</script>

<title>Tickets de Administradores</title>
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
    width: 100%;
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
    height: 180px;
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
    <!-- 
    Authentic Template
    http://www.templatemo.com/tm-412-authentic
    -->
    <meta name="viewport" content="width=device-width">        
    <link rel="stylesheet" href="css/templatemo_main.css">
    <!-- templatemo 412 authentic -->
</head>
<body>

    <div id="main-wrapper">
            <!--[if lt IE 7]>
                <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a rel="nofollow" href="http://browsehappy.com">upgrade your browser</a> or <a rel="nofollow" href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                <![endif]-->

                <div class="container">
                    <!-- Static navbar -->
                    <div class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>
                      </div>
                      <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                          <li class="active"><a href="#templatemo-page1"><i class="fa fa-home"></i>Inicio</a></li>
                          <li><a href="#templatemo-page2"><i class="fa fa-bullhorn"></i>Levantar Ticket</a></li>
<li><a href="#templatemo-page3"><i class="fa fa-search"></i>Mis Tickets</a></li>
                      </ul>
                  </div><!--/.nav-collapse -->
              </div><!--/.container-fluid -->
          </div>
          <div class="image-section">
            <div class="image-container">
                <img src="../ticket/imagenes/bgFondo.jpg" id="templatemo-page1-img" class="main-img inactive" alt="Home">
                <img src="../ticket/imagenes/bgFondo.jpg" id="templatemo-page2-img" class="inactive" alt="Services">
<img src="../ticket/imagenes/bgFondo.jpg" id="templatemo-page3-img"  class="inactive" alt="Awards">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 templatemo-content-wrapper">
                <div class="templatemo-content">   
                    <section  id="templatemo-page1-text" class="active">
                        <div style="height: 200px; margin-bottom:-30px;"  class="col-sm-12 col-md-12">
                            <div   id="slider" class="flexslider">
                              <ul class="slides">
                                <li>
                                  <img style="height: 180px" src="../ticket/imagenes/logo.png"  alt="Slide 1"/>
                              </li>
                          </ul>
                      </div>
              </div>
          </section><!-- /.templatemo-page1-text --> 
          <section id="templatemo-page2-text" class="inactive">
            <div class="col-sm-12 col-md-12" style="width:100%">
<div class="login-block">
<form name="frmReportes" id="frmReportes" method="POST" action="ticket_generado.php">
    <h2 style="text-align:center;color:#0040FF">Levantar Ticket</h2>
    <a style="color:black;">Seleccione la opci&oacute;n deseada:</a>
   <select style="color:#08088A;"  name="cmbOpciones" id="cmbOpciones" onchange="getval(this)">
<option value="1" >Activaci&oacute;n de Tarjetas</option>
<option value="2" >Suspensi&oacute;n de Tarjetas</option>
<option value="3" >Solicitud de Videos</option>
<option value="4" >Reporte de Fallas</option>
<option value="5" >Solicitudes o Quejas</option>
   </select>
<a  style="color:black;">Favor de escribir detalladamente lo que necesita:</a>
<textarea style="color:#08088A;" type="text" id="observaciones" name = "observaciones" class="feedback-input" required></textarea>
<!--<a id="textoInterfon" style="font-size:9.5px; color:red; display:block;">*Especifique si desea activar/desactivar tambi&eacute;n los interfones*</a>-->
<br>
<a id="textoVideo" style="font-size:12px; color:red; display:none; text-align:center;">Favor de proporcionar el rango de tiempo en el que sucedieron los hechos:</a>
<br>
<a id="textoFechaInicial" style="color:black; display:none;">Fecha y Hora Inicial:</a> 
<input id="fechaInicial" style="color:#08088A; display:none;" type="datetime-local" value="<?php echo date("Y-m-d");?>" name = "fechaInicial" class="feedback-input">

<a id="textoFechaFinal" style="color:black; display:none;">Fecha y Hora Final:</a>
<input id="fechaFinal" style="color:#08088A; display:none;" type="datetime-local" value="<?php echo date("Y-m-d");?>" name="fechaFinal" class="feedback-input">

<input style="color:#08088A;" type="hidden" value="<?php echo $nombre;?>" name = "usuario" id= "usuario" class="feedback-input">
<input style="color:#08088A;" type="hidden" value="<?php echo $privadaID;?>" name = "privadaID" id= "privadaID" class="feedback-input">

    <input id="login" type="submit" value="Generar Ticket">

</form>
</div>
            </div>
        </section><!-- /.templatemo-page2-text -->         

<section id="templatemo-page3-text" class="inactive">
            <div class="col-sm-12 col-md-12" style="width:100%">
<table name"tabla" id="tabla" class="tabla" border="3px" style="color:#0040FF" bordercolor="#0040FF" >
            <thead style="text-align: center; background-color:#0040FF; color: white;">
                <tr>
                    <tr name="columnas "id="columnas">
                    <td style="text-align: center; padding:5px"><b>Folio</b></td>
                    <td style="text-align: center; padding:5px"><b>Observaciones</b></td>
                    <td style="text-align: center; padding:5px"><b>Estatus</b></td>
                    <tr>
                </tr>
                <tbody style="background-color:white; color:#0040FF">
                    <?php while($row=$resultado2->fetch_assoc()){ ?>
                        <tr>
                            <td style="text-align: center; padding:5px"><?php echo $row['id_registro'];?>
                            </td>
                            <td style="text-align: center; padding:5px">
                                <?php echo $row['observaciones'];?>
                            </td>
                            <td style="text-align: center; padding:5px">
                                <?php 
if ( $row['estatus'] == 1)
{
$estatus= "Concluído";
}
if ( $row['estatus'] == 2)
{
$estatus= "Pendiente";
}
echo $estatus;
?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </section><!-- /.templatemo-page3-text -->                 
        

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
        <div class="footer-wrapper">
            <p id="tm-copyright">
            	Copyright &copy; 2016 VideoAccesos
            </p>
            </div>                    
        </div><!-- /.footer --> 
    </div>               
</div> <!-- /.container -->
</div><!-- /#main-wrapper -->

<div id="preloader">
    <div id="status">&nbsp;</div>
</div><!-- /#preloader -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/jquery.flexslider.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/templatemo_script.js"></script>
</body>
</html>