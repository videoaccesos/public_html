<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_monte_carlo'; //nombre de la base de datos
 
$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
 
$sql="SELECT * from usuarios where estatus_id=1 order by usuario";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
 
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['usuario_id']."'>".$row['usuario']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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

<title>Reportes de Finanzas MC</title>
<style>
body {
    background-image: url('imagenes/bgFondoMC.png');
    background-size: cover;
    font-family: Montserrat;
}

a{
font-size:14px;
font-weight:bold;
color:#8c0d1b;
}

.logo {
    width: 250px;
    height: 70px;
    background: url('imagenes/logoMC.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 7px 20px 7px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 7px solid #660000;
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

.login-block input#fechaInicial, input#fechaFinal{
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

.login-block #cmbUsuarios{
margin-top:6px;
    background: #fff url('ticket/imagenes/usuario3.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block #cmbUsuarios:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/usuario3.png') 12px 4px no-repeat;
    background-size: 24px 24px ;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #8c0d1b;
}

#login{
    width: 100%;
    height: 40px;
    background: #8c0d1b;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #8c0d1b;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;    
    border-color:white;
}
#login:hover{
    background: #660000;
    border: 1px solid #660000;
}



</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="reporte_finanzasMC.php" target="_blank" >
    <h3 style="text-align:center;color:#8c0d1b">Reporte de Finanzas MC</h3>
<a style="color:black;">Fecha Inicial:<a/>
<input type="date" id="fechaInicial" value="<?php echo date("Y-m-d");?>" name = "fechaInicial" class="feedback-input">
<a style="color:black;">Fecha Final:<a/>
<input type="date" id="fechaFinal" value="<?php echo date("Y-m-d");?>" name="fechaFinal" class="feedback-input">
<a style="color:black;">Usuario:<a/>
   <select name="cmbUsuarios" id="cmbUsuarios">
<option value="0" >Todos los usuarios</option>
       <?php echo $combobit; ?>
   </select>
<input id="login" type="submit" value="Generar Reporte">

</form>
</div>
</body>

</html>