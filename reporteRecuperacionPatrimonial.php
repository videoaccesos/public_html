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

<title>Reportes de Recuperaci&oacute;n Patrimonial</title>
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
<form name="consulta_reporte" method="POST" action="reporte_recuperacion_patrimonial.php" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Recuperaci&oacute;n Patrimonial</h3>
	<a style="color:black;">Fecha Inicial:<a/>
	<input type="date" id="fechaInicial" value="<?php echo date("Y-m-d");?>" name = "fechaInicial" class="feedback-input">
	<a style="color:black;">Fecha Final:<a/>
	<input type="date" id="fechaFinal" value="<?php echo date("Y-m-d");?>" name="fechaFinal" class="feedback-input">
	<input id="login" type="submit" value="Generar Reporte">

</form>
</div>
</body>

</html>