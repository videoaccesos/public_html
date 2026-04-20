<?php
include('numeros.php');
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
$privada = $_POST['cmbPrivadas'];
$mes = date('m');
$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
 
$sql2="SELECT * from pago_mensualidades where id_privada = $privada and (estatus = 2 or estatus = 3) ORDER BY mes asc";
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable


if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit2="";
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
    {
$cuota = $row2['cuota'];
        if ($row2['mes'] == 1)
        {
            $nombreMes="Enero";
        }
        if ($row2['mes'] == 2)
        {
            $nombreMes="Febrero";
        }
        if ($row2['mes'] == 3)
        {
            $nombreMes="Marzo";
        }
        if ($row2['mes'] == 4)
        {
            $nombreMes="Abril";
        }
        if ($row2['mes'] == 5)
        {
            $nombreMes="Mayo";
        }
        if ($row2['mes'] == 6)
        {
            $nombreMes="Junio";
        }
        if ($row2['mes'] == 7)
        {
            $nombreMes="Julio";
        }
        if ($row2['mes'] == 8)
        {
            $nombreMes="Agosto";
        }
        if ($row2['mes'] == 9)
        {
            $nombreMes="Septiembre";
        }
        if ($row2['mes'] == 10)
        {
            $nombreMes="Octubre";
        }
        if ($row2['mes'] == 11)
        {
            $nombreMes="Noviembre";
        }
        if ($row2['mes'] == 12)
        {
            $nombreMes="Diciembre";
        }
        $combobit2 .=" <option value='".$row2['mes']."'>".$nombreMes."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}



$sql4="SELECT * FROM pago_mensualidades where id_privada='$privada'";
$result4 = $conexion->query($sql4); //usamos la conexion para dar un resultado a la variable

if ($result4->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) 
    {
$total= $row4['total'];
    }
}
else
{
    echo "No hubo resultados";
}

$sql3="SELECT * from pago_mensualidades where cuota <> 0 and cuota <> $total and id_privada='$privada'";
$result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable

if ($result3->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) 
    {
$cuota = $row3['cuota'];
    }
}
else
{
    echo "No hubo resultados";
}

$conexion->close(); //cerramos la conexi贸n
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

<title>Pago de Mensualidad</title>
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

.login-block input{
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

.login-block input#responsable{
margin-top:6px;
    background: #fff url('ticket/imagenes/user2.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#responsable:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/user2.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#pago{
margin-top:6px;
    background: #fff url('ticket/imagenes/pagoRecibido2.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#pago:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/pagoRecibido2.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#comentarios{
margin-top:6px;
    background: #fff url('ticket/imagenes/comentarios.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#comentarios:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/comentarios.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#cuota{
margin-top:6px;
    background: #fff url('ticket/imagenes/cuota2.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#cuota:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/cuota2.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block #cmbMeses{
margin-top:6px;
    background: #fff url('ticket/imagenes/calendario.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block #cmbMeses:focus{
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
<form name="consulta_reporte" method="POST" action="imprimirContrato/vistas/revisionFolioMensualidad.php"  >
    <h3 style="text-align:center;color:#0040FF">Revisi&oacute;n de Mensualidad</h3>
<a style="color:black;">Mes a Pagar:<a/>
   <select name="cmbMeses" id="cmbMeses">
       <?php echo $combobit2; ?>
</select>
<a style="color:black;">Cuota:<a/>
<input type="text" id="cuota" name = "cuota" value="<?php echo $cuota;?>" class="feedback-input" readonly >
<a style="color:black;">Pago:<a/>
<input type="text" id="pago" name = "pago"   class="feedback-input" required>
<a style="color:black;">Responsable del pago:<a/>
<input type="text" id="responsable" name = "responsable" class="feedback-input" required>
<a style="color:black;">Comentarios:<a/>
<input type="text" id="comentarios" name = "comentarios" class="feedback-input">
    <input id="login" type="submit" value="Realizar Pago">
<input type="hidden" id="cantidadLetra" name="cantidadLetra" value="<? 	echo numtoletras($cuota);	?>" >
<input type="hidden" id="idPrivada" name="idPrivada" value="<?	echo $privada;	?>" >
</form>
</div>
</body>

</html>