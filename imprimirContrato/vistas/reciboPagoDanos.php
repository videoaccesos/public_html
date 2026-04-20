<?php
require('../fpdf/fpdf.php');
require('../php/conexion.php');

$privada = $_POST['cmbPrivadas'];
$responsable = $_POST['responsable'];
$cantidad = $_POST['cantidad'];
$concepto = $_POST['concepto'];
$tipoPago = $_POST['cmbTipoPago'];
$fecha= date("Y-m-d");
if($tipoPago == 2)
{
	$registro1= mysql_query("INSERT INTO residencias_residentes_tarjetas_no_renovacion VALUES (NULL,$privada,'1502','','','','','','','','','','RE017036','$responsable',0,'$fecha','00-00-0000',1,'123','',$cantidad,0,0,0,0,0,0,0,'$concepto',1,CURRENT_TIMESTAMP,1,88,'')");
	$rs = mysql_query("SELECT MAX(asignacion_id) AS id FROM residencias_residentes_tarjetas_no_renovacion");
	if ($row = mysql_fetch_row($rs)) {
	$id = trim($row[0]);
	}

	$registro= mysql_query("SELECT p.descripcion, rrt.residente_id,rrt.comprador_id,rrt.precio,rrt.concepto, rrt.fecha from residencias_residentes_tarjetas_no_renovacion as rrt inner join privadas as p on p.privada_id = rrt.privada WHERE asignacion_id = $id");
	while($todosLosRegistros= mysql_fetch_array($registro)){
	header("Content-Type: text/html;charset=utf-8");
	$privada = $todosLosRegistros['descripcion'];
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(150, 13, 'RESIDENCIAL:', 0,0,'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 13, 'FOLIO:', 0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(150, 10, $privada, 0,0,'L');
	$pdf->Cell(40, 10, 'No. '.$id.' B', 0,0,'C');
	$pdf->Ln(6);
	$pdf->Cell(10, 10, '', 0);
	$pdf->Cell(140, 10, '', 0);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(40, 13, 'FECHA:', 0,0,'C');
	$pdf->Ln(5);
	$pdf->Cell(10, 10, '', 0);
	$pdf->Cell(140, 10, '', 0);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(40, 10, ''.$todosLosRegistros['fecha'].'', 0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(70, 5, '', 0);
	$pdf->Ln(5);
	$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(190, 7, utf8_decode('Razon Social: ').$todosLosRegistros['descripcion'], 1,0);
	$pdf->Ln(7);
	$pdf->Cell(190, 7, utf8_decode('Responsable de Pago: ').$todosLosRegistros['comprador_id'], 1,0);
		$pdf->Ln(7);
	$pdf->Ln(5);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(20, 6, 'TOTAL', 1,0,'C');
	$pdf->Cell(170, 6, utf8_decode('CONCEPTO'), 1,0,'C');
	$pdf->Ln(6);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(20, 6, '$'.$todosLosRegistros['precio'], 1,0,'C');
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(170, 6, utf8_decode($concepto), 1,0,'C');
	$pdf->Ln(15);
	$pdf->SetFont('Arial', 'U', 8);
	$pdf->Cell(95, 5, utf8_decode('                                                                   '),0,0,'C');
	$pdf->Cell(95, 5, utf8_decode('                                                                   '),0,0,'C');
	$pdf->Ln(8);
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(95, 5, utf8_decode('FIRMA DE ENTREGADO'),0,0,'C');
	$pdf->Cell(95, 5, utf8_decode('FIRMA DE RECIBIDO'),0,0,'C');
	$pdf->Ln(12);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(190, 6, 'www.videoaccesos.com', 1,0,'C');

	}
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(114,8,'',0);
	$pdf->Output();

}
else
{
	$registro= mysql_query("SELECT descripcion from privadas where privada_id = $privada");
	while($todosLosRegistros= mysql_fetch_array($registro)){
	header("Content-Type: text/html;charset=utf-8");
	$privada = $todosLosRegistros['descripcion'];
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 8);
	$pdf->Image('../recursos/videoaccesos.png' , 10 ,10, 60 , 22,'PNG');
	$pdf->Cell(10, 10, '', 0);
	$pdf->Cell(140, 10, '', 0);
	$pdf->SetFont('Arial', 'B', 12);
	if ($id != 0)
	{
	$pdf->Cell(40, 13, 'FOLIO:', 0,0,'C');
	$pdf->Ln(6);
	$pdf->Cell(10, 10, '', 0);
	$pdf->Cell(140, 10, '', 0);
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(40, 10, 'No. '.$id.' B', 0,0,'C');
	}
	$pdf->Ln(12);
	$pdf->Cell(10, 10, '', 0);
	$pdf->Cell(140, 10, '', 0);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(40, 13, 'FECHA:', 0,0,'C');
	$pdf->Ln(5);
	$pdf->Cell(10, 10, '', 0);
	$pdf->Cell(140, 10, '', 0);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(40, 10, ''.$fecha.'', 0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(70, 5, '', 0);
	$pdf->Ln(5);
	$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(190, 7, utf8_decode('Razon Social: ').$todosLosRegistros['descripcion'], 1,0);
	$pdf->Ln(7);
	$pdf->Cell(190, 7, utf8_decode('Responsable de Pago: ').$responsable, 1,0);
		$pdf->Ln(7);
	$pdf->Ln(5);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(20, 6, 'TOTAL', 1,0,'C');
	$pdf->Cell(170, 6, utf8_decode('CONCEPTO'), 1,0,'C');
	$pdf->Ln(6);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(20, 6, '$'.$cantidad, 1,0,'C');
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(170, 6, utf8_decode($concepto), 1,0,'C');
	$pdf->Ln(15);
	$pdf->SetFont('Arial', 'U', 8);
	$pdf->Cell(95, 5, utf8_decode('                                                                   '),0,0,'C');
	$pdf->Cell(95, 5, utf8_decode('                                                                   '),0,0,'C');
	$pdf->Ln(8);
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(95, 5, utf8_decode('FIRMA DE ENTREGADO'),0,0,'C');
	$pdf->Cell(95, 5, utf8_decode('FIRMA DE RECIBIDO'),0,0,'C');
	$pdf->Ln(12);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(190, 6, 'www.videoaccesos.com', 1,0,'C');

	}
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(114,8,'',0);
	$pdf->Output();
}
?>