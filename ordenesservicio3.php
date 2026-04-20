<?php
require('imprimirContrato/fpdf/fpdf.php');
require('imprimirContrato/php/conexion.php');

$registro = mysql_query("SELECT * FROM ordenes_servicio");

header("Content-Type: text/html;charset=utf-8");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$pdf->Image('imprimirContrato/recursos/videoaccesos.png', 10, 10, 45, 17, 'PNG');
$pdf->Ln(3);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 13, '', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 13, 'FECHA:', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 10, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 10, ''.date('d/m/Y').'', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(70, 5, '', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 6, utf8_decode('Reporte de Órdenes de Servicio'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 6, 'Privada', 1, 0, 'C');
$pdf->Cell(20, 6, 'Falla', 1, 0, 'C');
$pdf->Cell(30, 6, 'Diagnostico', 1, 0, 'C');
$pdf->Cell(30, 6, 'Fecha Inicio', 1, 0, 'C');
$pdf->Cell(30, 6, utf8_decode('Fecha Solución'), 1, 0, 'C');
$pdf->Cell(20, 6, utf8_decode('Técnico'), 1, 0, 'C');
$pdf->Cell(20, 6, 'Estatus', 1, 0, 'C'); // Supongo que tienes una columna de estatus
$pdf->Ln(6);
while ($todosLosRegistros = mysql_fetch_array($registro)) {
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(20, 6, $todosLosRegistros['privada_id'], 1, 0, 'C');
    $pdf->Cell(20, 6, '', 1, 0, 'C'); // Aquí debe ir el dato de la falla, pero no veo que lo estés extrayendo de la DB
    $pdf->Cell(30, 6, $todosLosRegistros['diagnostico_id'], 1, 0, 'C');
    $pdf->Cell(30, 6, $todosLosRegistros['fecha'], 1, 0, 'C');
    $pdf->Cell(30, 6, $todosLosRegistros['fecha_modificacion'], 1, 0, 'C');
    $pdf->Cell(20, 6, $todosLosRegistros['tecnico_id'], 1, 0, 'C');
    $pdf->Cell(20, 6, '', 1, 0, 'C'); // Aquí debes poner el dato de estatus, pero no veo que lo estés extrayendo de la DB
    $pdf->Ln(6);
}
$pdf->Output();
?>