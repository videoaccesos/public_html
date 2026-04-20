<?php
require('imprimirContrato/fpdf/fpdf.php');
require('imprimirContrato/php/conexion.php');

$registro= mysql_query("SELECT * FROM ordenes_servicio");

header("Content-Type: text/html;charset=utf-8");
$fechaReportado= $todosLosRegistros['fecha'];
$folio= $todosLosRegistros['folio'];
$fechaCerrado= $todosLosRegistros['fecha_modificacion'];

$privada_id=$_POST['cmbPrivadas'];
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$estatus=$_POST['cmbEstatus'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$pdf->Image('imprimirContrato/recursos/videoaccesos.png' , 10 ,10, 45 , 17,'PNG');
$pdf->Ln(3);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 13, '', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 13, 'FECHA:', 0,0,'C');
$pdf->Ln(5);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 10, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 10, ''.date('d/m/Y').'', 0,0,'C');
$pdf->Ln(5);
$pdf->Cell(70, 5, '', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 6, utf8_decode('Reporte de Ã“rdenes de Servicio'), 0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 6, 'Folio', 1,0,'C');
$pdf->Cell(20, 6, 'Privada', 1,0,'C');
$pdf->Cell(20, 6, 'Falla', 1,0,'C');
$pdf->Cell(30, 6, 'Diagnostico', 1,0,'C');
$pdf->Cell(20, 6, utf8_decode('T¨¦cnico'), 1,0,'C');
$pdf->Cell(20, 6, 'Tiempo', 1,0,'C');
$pdf->Cell(30, 6, 'Fecha Inicio', 1,0,'C');
$pdf->Cell(30, 6, utf8_decode('Fecha SoluciÃ³n'), 1,0,'C');
$pdf->Ln(6);
while($todosLosRegistros= mysql_fetch_array($registro)){
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 6, $todosLosRegistros['folio'], 1,0,'C');
$pdf->Cell(20, 6, $todosLosRegistros['privada_id'], 1,0,'C');
$pdf->Cell(20, 6, '', 1,0,'C');
$pdf->Cell(30, 6, $todosLosRegistros['diagnostico_id'], 1,0,'C');
$pdf->Cell(20, 6, $todosLosRegistros['tecnico_id'], 1,0,'C');
$pdf->Cell(20, 6, $todosLosRegistros['tiempo'].' Min.', 1,0,'C');
$pdf->Cell(30, 6, $todosLosRegistros['fecha'], 1,0,'C');
$pdf->Cell(30, 6, $todosLosRegistros['fecha_modificacion'], 1,0,'C');
$pdf->Ln(6);
}
$pdf->Cell(114,8,'',0);
$pdf->Output();
?>