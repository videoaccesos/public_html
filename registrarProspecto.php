<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
 
$sql="SELECT * from privadas where estatus_id=1 and pago_mensualidad=1 order by descripcion";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
 
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['privada_id']."'>".$row['descripcion']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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

<title>Registro de Prospectos</title>
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

.login-block #administrador,#nombrePrivada,#domicilio,#telefono,#observaciones{
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

.login-block input#administrador{
margin-top:6px;
    background: #fff url('ticket/imagenes/usuario3.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#administrador:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/usuario3.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#telefono{
margin-top:6px;
    background: #fff url('ticket/imagenes/telefono.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block input#telefono:focus{
margin-top:6px;
    background: #fff url('ticket/imagenes/telefono.png') 12px 4px no-repeat;
    background-size: 24px 24px;
}

.login-block #domicilio{
margin-top:6px;
    background: #fff url('ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #domicilio:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/privada.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #nombrePrivada{
margin-top:6px;
    background: #fff url('ticket/imagenes/privada2.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #nombrePrivada:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/privada2.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #observaciones{
margin-top:6px;
    background: #fff url('ticket/imagenes/comentarios.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #observaciones:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/comentarios.png') 12px 4px no-repeat;
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
<form name="consulta_reporte" method="POST" action="prospecto_registrado.php" >
    <h3 style="text-align:center;color:#0040FF">Registro de Prospecto</h3>
<a style="color:black;">Nombre Administrador:<a/>
   <input type="text" id="administrador" name = "administrador" class="feedback-input" required>
<a style="color:black;">Nombre Privada:<a/>
   <input type="text" id="nombrePrivada" name = "nombrePrivada" class="feedback-input" required>
   <a style="color:black;">Domicilio:<a/>
   <input type="text" id="domicilio" name = "domicilio" class="feedback-input" required>
   <a style="color:black;">Tel&eacute;fono de Contacto:<a/>
   <input type="text" id="telefono" name = "telefono" class="feedback-input" required>
<a style="color:black;">Observaciones:<a/>
<input type="textarea" id="observaciones" name = "observaciones" class="feedback-input" required>
    <input id="login" type="submit" value="Registrar Prospecto">

</form>
</div>
</body>

</html>