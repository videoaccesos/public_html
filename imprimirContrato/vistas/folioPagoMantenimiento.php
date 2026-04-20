<?php
require('../fpdf/fpdf.php');
$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_monte_carlo";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$rs = mysql_query("SELECT MAX(pago_id) AS id FROM pagos_mantenimiento");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}


$registro= mysql_query("SELECT RR.nombre, RR.ape_paterno, RR.ape_materno,RR.email,RR.celular, R.nro_casa, R.calle,R.fecha_cubierta, PM.meses, PM.fecha_ultimo_pago, PM.fecha_cubierta as fecha_anterior, PM.total, PM.descuento, PM.tipo_pago, PM.fecha_modificacion, U.usuario FROM pagos_mantenimiento AS PM INNER JOIN residencias AS R ON R.residencia_id = PM.residencia_id INNER JOIN residencias_residentes AS RR ON RR.residente_id = PM.residente_id INNER JOIN usuarios AS U ON U.usuario_id = PM.usuario_id WHERE PM.pago_id = $id");
while($datos= mysql_fetch_array($registro)){
header("Content-Type: text/html;charset=utf-8");

$nombreCompleto = $datos['nombre'].' '.$datos['ape_paterno'].' '.$datos['ape_materno'];
$domicilio = $datos['calle'].' '.$datos['nro_casa'];
$celular = $datos['celular'];
$email = $datos['email'];
$meses = $datos['meses'];
$totalPagado = $datos['total'];
$fechaUltimoPago = $datos['fecha_ultimo_pago'];
$fechaAnterior = $datos['fecha_anterior'];
$fechaPagada = $datos['fecha_cubierta'];
$usuarioVendio = $datos['usuario'];
$descuento = $datos['descuento'];
$subTotal = $totalPagado + $descuento;

$cortarMesAnterior = substr($fechaAnterior, 5, 7);
$mesAnterior = substr($cortarMesAnterior, 0, 2);
$anoAnterior = substr($fechaAnterior, 0, 4);

$cortarMesPagado = substr($fechaPagada, 5, 7);
$mesPagado = substr($cortarMesPagado, 0, 2);
$anoPagado = substr($fechaPagada, 0, 4);

if ($mesAnterior == '01')
{
    $nombreMesAnterior="Enero";
}
if ($mesAnterior == '02')
{
    $nombreMesAnterior="Febrero";
}
if ($mesAnterior == '03')
{
    $nombreMesAnterior="Marzo";
}
if ($mesAnterior == '04')
{
    $nombreMesAnterior="Abril";
}
if ($mesAnterior == '05')
{
    $nombreMesAnterior="Mayo";
}
if ($mesAnterior == '06')
{
    $nombreMesAnterior="Junio";
}
if ($mesAnterior == '07')
{
    $nombreMesAnterior="Julio";
}
if ($mesAnterior == '08')
{
    $nombreMesAnterior="Agosto";
}
if ($mesAnterior == '09')
{
    $nombreMesAnterior="Septiembre";
}
if ($mesAnterior == '10')
{
    $nombreMesAnterior="Octubre";
}
if ($mesAnterior == '11')
{
    $nombreMesAnterior="Noviembre";
}
if ($mesAnterior == '12')
{
    $nombreMesAnterior="Diciembre";
}

if ($mesPagado == '01')
{
    $nombreMesPagado="Enero";
}
if ($mesPagado == '02')
{
    $nombreMesPagado="Febrero";
}
if ($mesPagado == '03')
{
    $nombreMesPagado="Marzo";
}
if ($mesPagado == '04')
{
    $nombreMesPagado="Abril";
}
if ($mesPagado == '05')
{
    $nombreMesPagado="Mayo";
}
if ($mesPagado == '06')
{
    $nombreMesPagado="Junio";
}
if ($mesPagado == '07')
{
    $nombreMesPagado="Julio";
}
if ($mesPagado == '08')
{
    $nombreMesPagado="Agosto";
}
if ($mesPagado == '09')
{
    $nombreMesPagado="Septiembre";
}
if ($mesPagado == '10')
{
    $nombreMesPagado="Octubre";
}
if ($mesPagado == '11')
{
    $nombreMesPagado="Noviembre";
}
if ($mesPagado == '12')
{
    $nombreMesPagado="Diciembre";
}

if ($datos['tipo_pago'] == '1')
{
    $tipoPagoLetra = 'Efectivo';
}
if ($datos['tipo_pago'] == '2')
{
    $tipoPagoLetra = 'Bancos';
}
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Image('../recursos/logoMC.png' , 10 ,10, 26 , 20,'PNG');
$pdf->Cell(60, 10, '', 0);
$pdf->Cell(90, 10, 'Residencial MonteCarlo, Culiacan, A.C.', 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40, 8, 'FOLIO:', 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(90, 8, 'Blvd. Lola Beltran No. 3120 Residencial Monte Carlo', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(194,8,8);
$pdf->Cell(40, 9, 'No. '.$id.' M', 0,0,'C');
$pdf->Ln(3);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(73, 8, '', 0);
$pdf->Cell(77, 8, 'CP. 80054 Culiacan, Sinaloa', 0);
$pdf->Cell(40, 8, '', 0,0,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(67, 8, '', 0);
$pdf->Cell(83, 8, 'R.F.C. RMC-060220-LP0 TEL: 146-9818', 0);
$pdf->Cell(40, 8, 'FECHA:', 0,0,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(66, 8, '', 0);
$pdf->Cell(84, 8, 'Correo: montecarlo.culiacan@hotmail.com', 0);
$pdf->Cell(40, 8, ''.$datos['fecha_modificacion'].'', 0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(95, 6, utf8_decode('Nombre: ').$nombreCompleto, 1,0);
$pdf->Cell(95, 6, utf8_decode('Domicilio: ').$domicilio, 1,0);
    $pdf->Ln(6);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, 'MESES', 1,0,'C');
$pdf->Cell(130, 5, utf8_decode('CONCEPTO'), 1,0,'C');
$pdf->Cell(20, 5, 'P. UNIT.', 1,0,'C');
$pdf->Cell(20, 5, 'IMPORTE', 1,0,'C');
$pdf->Ln(5);
$pdf->Cell(20, 5, $meses, 1,0,'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(130, 5, 'Cuota de Mantenimiento de '.$nombreMesAnterior.' del '.$anoAnterior.' a '.$nombreMesPagado.' del '.$anoPagado, 1,0,'C');
$pdf->Cell(20, 5, '$400', 1,0,'C');
$pdf->Cell(20, 5, '$'.$subTotal .'', 1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'SubTotal:', 0,0,'R');
$pdf->Cell(20, 5, '$'.$subTotal .'',1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, 'Elaborado por:', 0,0,'C');
$pdf->Cell(20, 5, $usuarioVendio,0,0,'C');
$pdf->Cell(130, 5, 'Descuento(-):', 0,0,'R');
$pdf->Cell(20, 5, '$'.$descuento .'',1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'Total:', 0,0,'R');
$pdf->Cell(20, 5, '$'.$totalPagado .'',1,0,'C');

$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'Tipo de Pago:', 0,0,'R');
$pdf->Cell(20, 5, ''.$tipoPagoLetra.'',1,0,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(75, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Cell(75, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(75, 5, utf8_decode('FIRMA DE ENTREGADO'),0,0,'C');
$pdf->Cell(75, 5, utf8_decode('FIRMA DE RECIBIDO'),0,0,'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 6, '',0,0,'R');

$pdf->Ln(20);

//HOJA 2

$pdf->SetFont('Arial', 'B', 10);
$pdf->Image('../recursos/logoMC.png' , 10 ,100, 26 , 20,'PNG');
$pdf->Cell(60, 10, '', 0);
$pdf->Cell(90, 10, 'Residencial MonteCarlo, Culiacan, A.C.', 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40, 8, 'FOLIO:', 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(90, 8, 'Blvd. Lola Beltran No. 3120 Residencial Monte Carlo', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(194,8,8);
$pdf->Cell(40, 9, 'No. '.$id.' M', 0,0,'C');
$pdf->Ln(3);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(73, 8, '', 0);
$pdf->Cell(77, 8, 'CP. 80054 Culiacan, Sinaloa', 0);
$pdf->Cell(40, 8, '', 0,0,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(67, 8, '', 0);
$pdf->Cell(83, 8, 'R.F.C. RMC-060220-LP0 TEL: 146-9818', 0);
$pdf->Cell(40, 8, 'FECHA:', 0,0,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(66, 8, '', 0);
$pdf->Cell(84, 8, 'Correo: montecarlo.culiacan@hotmail.com', 0);
$pdf->Cell(40, 8, ''.$datos['fecha_modificacion'].'', 0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(95, 6, utf8_decode('Nombre: ').$nombreCompleto, 1,0);
$pdf->Cell(95, 6, utf8_decode('Domicilio: ').$domicilio, 1,0);
    $pdf->Ln(6);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, 'MESES', 1,0,'C');
$pdf->Cell(130, 5, utf8_decode('CONCEPTO'), 1,0,'C');
$pdf->Cell(20, 5, 'P. UNIT.', 1,0,'C');
$pdf->Cell(20, 5, 'IMPORTE', 1,0,'C');
$pdf->Ln(5);
$pdf->Cell(20, 5, $meses, 1,0,'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(130, 5, 'Cuota de Mantenimiento de '.$nombreMesAnterior.' del '.$anoAnterior.' a '.$nombreMesPagado.' del '.$anoPagado, 1,0,'C');
$pdf->Cell(20, 5, '$400', 1,0,'C');
$pdf->Cell(20, 5, '$'.$subTotal .'', 1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'SubTotal:', 0,0,'R');
$pdf->Cell(20, 5, '$'.$subTotal .'',1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, 'Elaborado por:', 0,0,'C');
$pdf->Cell(20, 5, $usuarioVendio,0,0,'C');
$pdf->Cell(130, 5, 'Descuento(-):', 0,0,'R');
$pdf->Cell(20, 5, '$'.$descuento .'',1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'Total:', 0,0,'R');
$pdf->Cell(20, 5, '$'.$totalPagado .'',1,0,'C');

$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'Tipo de Pago:', 0,0,'R');
$pdf->Cell(20, 5, ''.$tipoPagoLetra.'',1,0,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(75, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Cell(75, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(75, 5, utf8_decode('FIRMA DE ENTREGADO'),0,0,'C');
$pdf->Cell(75, 5, utf8_decode('FIRMA DE RECIBIDO'),0,0,'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 6, '',0,0,'R');

$pdf->Ln(20);

//HOJA 3

$pdf->SetFont('Arial', 'B', 10);
$pdf->Image('../recursos/logoMC.png' , 10 ,190, 26 , 20,'PNG');
$pdf->Cell(60, 10, '', 0);
$pdf->Cell(90, 10, 'Residencial MonteCarlo, Culiacan, A.C.', 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40, 8, 'FOLIO:', 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(90, 8, 'Blvd. Lola Beltran No. 3120 Residencial Monte Carlo', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(194,8,8);
$pdf->Cell(40, 9, 'No. '.$id.' M', 0,0,'C');
$pdf->Ln(3);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(73, 8, '', 0);
$pdf->Cell(77, 8, 'CP. 80054 Culiacan, Sinaloa', 0);
$pdf->Cell(40, 8, '', 0,0,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(67, 8, '', 0);
$pdf->Cell(83, 8, 'R.F.C. RMC-060220-LP0 TEL: 146-9818', 0);
$pdf->Cell(40, 8, 'FECHA:', 0,0,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(66, 8, '', 0);
$pdf->Cell(84, 8, 'Correo: montecarlo.culiacan@hotmail.com', 0);
$pdf->Cell(40, 8, ''.$datos['fecha_modificacion'].'', 0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(95, 6, utf8_decode('Nombre: ').$nombreCompleto, 1,0);
$pdf->Cell(95, 6, utf8_decode('Domicilio: ').$domicilio, 1,0);
    $pdf->Ln(6);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, 'MESES', 1,0,'C');
$pdf->Cell(130, 5, utf8_decode('CONCEPTO'), 1,0,'C');
$pdf->Cell(20, 5, 'P. UNIT.', 1,0,'C');
$pdf->Cell(20, 5, 'IMPORTE', 1,0,'C');
$pdf->Ln(5);
$pdf->Cell(20, 5, $meses, 1,0,'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(130, 5, 'Cuota de Mantenimiento de '.$nombreMesAnterior.' del '.$anoAnterior.' a '.$nombreMesPagado.' del '.$anoPagado, 1,0,'C');
$pdf->Cell(20, 5, '$400', 1,0,'C');
$pdf->Cell(20, 5, '$'.$subTotal .'', 1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'SubTotal:', 0,0,'R');
$pdf->Cell(20, 5, '$'.$subTotal .'',1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, 'Elaborado por:', 0,0,'C');
$pdf->Cell(20, 5, $usuarioVendio,0,0,'C');
$pdf->Cell(130, 5, 'Descuento(-):', 0,0,'R');
$pdf->Cell(20, 5, '$'.$descuento .'',1,0,'C');
$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'Total:', 0,0,'R');
$pdf->Cell(20, 5, '$'.$totalPagado .'',1,0,'C');

$pdf->Ln(5);

$pdf->Cell(20, 5, '', 0,0,'C');
$pdf->Cell(20, 5, '',0,0,'C');
$pdf->Cell(130, 5, 'Tipo de Pago:', 0,0,'R');
$pdf->Cell(20, 5, ''.$tipoPagoLetra.'',1,0,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(75, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Cell(75, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(75, 5, utf8_decode('FIRMA DE ENTREGADO'),0,0,'C');
$pdf->Cell(75, 5, utf8_decode('FIRMA DE RECIBIDO'),0,0,'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 6, '',0,0,'R');

}
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Output();
?>