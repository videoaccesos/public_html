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
 
$sql="SELECT * from privadas where estatus_id=1 order by descripcion";
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

$sql2="SELECT * from usuarios_tecnicos";
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
 
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit2="";
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit2 .=" <option value='".$row2['tecnico_id']."'>".$row2['usuario']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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


<title>Venta a Consignaci&oacute;n</title>
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
<style>
body {
    background-image: url('ticket/imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

a {color:#013ADF}
.logo {
    width: 250px;
    height: 70px;
    background: url('ticket/imagenes/videoaccesos.png') no-repeat;
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
    padding: 0 20px 0 50px;
    outline: none;
color:#013ADF;
}

.login-block #tarjeta1,#tarjeta2,#tarjeta3,#tarjeta4,#tarjeta5,#tarjeta6,#tarjeta7,#tarjeta8,#tarjeta9,#tarjeta10{
    width: 60%;
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

.login-block #ns1,#ns2,#ns3,#ns4,#ns5,#ns6,#ns7,#ns8,#ns9,#ns10{
    width: 38%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 20px;
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
color:#013ADF;
}
.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block #cmbPrivadas{
margin-top:6px;
    background: #fff url('ticket/imagenes/casa3.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbPrivadas:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/casa3.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #responsable{
margin-top:6px;
    background: #fff url('ticket/imagenes/user.png') 12px 4px no-repeat;
    background-size: 26px 26px;
}

.login-block #responsable:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/user.png') 12px 4px no-repeat;
    background-size: 26px 26px;
}

.login-block #observaciones{
margin-top:6px;
    background: #fff url('ticket/imagenes/info.png') 12px 4px no-repeat;
    background-size: 26px 26px  ;
}

.login-block #observaciones:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/info.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block #domicilio{
margin-top:6px;
    background: #fff url('ticket/imagenes/direccion.png') 12px 4px no-repeat;
    background-size: 26px 26px  ;
}

.login-block #domicilio:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/direccion.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block #cantidad{
margin-top:6px;
    background: #fff url('ticket/imagenes/folio.jpg') 12px 4px no-repeat;
    background-size: 34px 30px  ;
}

.login-block #cantidad:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/folio.jpg') 12px 4px no-repeat;
    background-size: 34px 30px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}


.login-block #tarjeta1,#tarjeta2,#tarjeta3,#tarjeta4,#tarjeta5,#tarjeta6,#tarjeta7,#tarjeta8,#tarjeta9,#tarjeta10{
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}

.login-block #nsInicial{
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}

.login-block #nsInicial:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block #nsFinal{
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}

.login-block #nsFinal:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
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
color:#013ADF;
}

#venta{
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

#venta{
    background: #0040FF;
border-color:white;
}


</style>
</head>

<body>


<div class="logo"></div>
<div class="login-block">
<form action="imprimirContrato/vistas/folioVentaConsignacion.php" method="post">
    <h1>Venta a Consignaci&oacute;n</h1>
   <select name="cmbPrivadas" id="cmbPrivadas">
       <?php echo $combobit; ?>
   </select>
    <input type="text" value="" placeholder="Nombre del Responsable" id="responsable" name="responsable" onkeypress="return validLetter(event);" required />
<input type="text" value="" placeholder="Cantidad de Tarjetas" id="cantidad" name="cantidad" onkeypress="return validNumber(event);" required />
<a style="color:black;">Desde el NS:</a>
    <input type="text" value="" placeholder="NS Inicial" id="nsInicial" name="nsInicial" onkeypress="return validNumber(event);" required/>
<a style="color:black;">Hasta el NS:</a>
    <input type="text" value="" placeholder="NS Final" id="nsFinal" name="nsFinal" onkeypress="return validNumber(event);" required/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta1" name="tarjeta1" onkeypress="return validNumber(event);" required/>
    <input type="text" value="" placeholder="# de NS" id="ns1" name="ns1" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta2" name="tarjeta2" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns2" name="ns2" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta3" name="tarjeta3" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns3" name="ns3" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta4" name="tarjeta4" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns4" name="ns4" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta5" name="tarjeta5" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns5" name="ns5" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta6" name="tarjeta6" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns6" name="ns6" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta7" name="tarjeta7" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns7" name="ns7" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta8" name="tarjeta8" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns8" name="ns8" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta9" name="tarjeta9" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns9" name="ns9" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de tarjeta" id="tarjeta10" name="tarjeta10" onkeypress="return validNumber(event);"/>
    <input type="text" value="" placeholder="# de NS" id="ns10" name="ns10" onkeypress="return validNumber(event);"/>
<textarea value="" placeholder="Observaciones" id="observaciones" name="observaciones"> </textarea>
    <input id="venta" name="venta" type="submit" value="Generar Venta">

</form>
</div>
</body>

</html>