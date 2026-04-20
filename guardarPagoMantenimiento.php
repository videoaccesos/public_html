<?php
$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_monte_carlo";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$residenciaID=$_POST['residenciaID'];
$residenteID=$_POST['residenteID'];
$fechaUltimoPago=$_POST['fechaUltimoPago'];
$fechaCubierta=$_POST['fechaCubierta'];
$totalMeses=$_POST['totalMeses'];
$totalPagar=$_POST['totalPagar'];
$descuento=$_POST['descuento'];
$tipoPago=$_POST['tipoPago'];
$usuarioID=$_POST['usuarioID'];
$fecha= date("Y-m-d");

$sql = "INSERT INTO pagos_mantenimiento VALUES (NULL,'$residenciaID','$residenteID','$totalMeses','$fechaUltimoPago','$fechaCubierta','$totalPagar',$descuento,'$tipoPago',1,'$fecha','$usuarioID')";
$insertarRegistro= mysql_query($sql);

$nuevaFechaPago = strtotime ( "+".$totalMeses." month" , strtotime ( $fechaCubierta ) ) ;
$nuevaFechaPago = date ( 'Y-m-j' , $nuevaFechaPago );

$sql = "UPDATE residencias SET fecha_ultimo_pago ='$fecha', fecha_cubierta='$nuevaFechaPago' WHERE residencia_id = $residenciaID";
$insertarRegistro= mysql_query($sql);

echo json_encode($array);

?>