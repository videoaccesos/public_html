<?php 

  $host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";
  $databaseName = "wwwvideo_video_accesos";

  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

$privadaID=$_POST['cmbPrivadas'];
$ano = date("Y")+1;

$result1 = mysql_query("SELECT precio_mensualidad FROM privadas WHERE privada_id=$privadaID");
  $precioMensualidad= mysql_fetch_row($result1); 

$result2 = mysql_query("SELECT folio FROM pago_mensualidades WHERE id_privada=$privadaID AND ano=$ano");
  $validarExiste= mysql_fetch_row($result2); 
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<title>Agregar Mensualidad a Privada</title>
<style>
body {
    background-image: url('ticket/imagenes/bgFondo.jpg');
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
    background: url('ticket/imagenes/videoaccesos.png') no-repeat;
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

.login-block input#fechaInicial, input#fechaFinal,#cmbPrivadas,#cmbTecnicos,#cmbEstatus{
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

.login-block input#fechaInicial{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaInicial:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaFinal{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#fechaFinal:focus{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block #cmbPrivadas{
margin-top:6px;
    background: #fff url('ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbPrivadas:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbVendedoras{
margin-top:6px;
    background: #fff url('ticket/imagenes/mujer3.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbVendedoras:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/mujer3.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbEstatus{
margin-top:6px;
    background: #fff url('ticket/imagenes/estatus.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbEstatus:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/estatus.png') 12px 4px no-repeat;
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
<form method="POST" action="#" >
    <!--<h3 style="text-align:center;color:#0040FF">Agregar Mensualidad</h3>-->
<h3 style="color:black;text-align:justify;">
<?php 
if($validarExiste[0] != 0){
echo "Error: La privada ya cuenta con sus mensualidades agregadas.";
}
else
{
$mes1= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,1,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes1= mysql_query($mes1);
$mes2= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,2,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes2= mysql_query($mes2);
$mes3= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,3,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes3= mysql_query($mes3);
$mes4= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,4,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes4= mysql_query($mes4);
$mes5= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,5,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes5= mysql_query($mes5);
$mes6= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,6,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes6= mysql_query($mes6);
$mes7= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,7,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes7= mysql_query($mes7);
$mes8= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,8,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes8= mysql_query($mes8);
$mes9= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,9,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes9= mysql_query($mes9);
$mes10= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,10,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes10= mysql_query($mes10);
$mes11= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,11,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes11= mysql_query($mes11);
$mes12= "INSERT INTO pago_mensualidades VALUES (NULL,$privadaID,12,$ano,$precioMensualidad[0],0,$precioMensualidad[0],CURRENT_TIMESTAMP,2)";
  $finalMes12= mysql_query($mes12);
echo "Se han agregado correctamente las mensualidades para &eacute;sta privada.";
}
?>
</h3>


</form>
</div>
</body>

</html>