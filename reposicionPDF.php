<?php
require('imprimirContrato/fpdf/fpdf.php');
require('imprimirContrato/php/conexion.php');

$privada = $_POST['cmbPrivadas'];
$nombrePrivada = $_POST['nombrePrivada'];
$nombre=$_POST['nombre'];
$domicilio=$_POST['domicilio'];
$folio=$_POST['folio'];
$tipoFolio=$_POST['tipoFolio'];
$tarjetaAnterior=$_POST['tarjetaAnterior'];
$tarjetaNueva=$_POST['tarjetaNueva'];
$motivo=$_POST['motivo'];
$observaciones=$_POST['observaciones'];
if ($motivo == 1)
{
$motivo="Seguro";
}
if ($motivo == 2)
{
$motivo="Garantía";
}
if ($motivo == 3)
{
$motivo="Robo";
}
$estatus=2;
$estatusAlta=2;
$estatusBaja=5;

$result6 = "INSERT INTO reposiciones VALUES (NULL,$privada,'$nombre','$domicilio','$folio','$tarjetaAnterior','$tarjetaNueva','$motivo','$observaciones',CURRENT_TIMESTAMP,$estatus)";          //query
  $final= mysql_query($result6);  
  
$rs = mysql_query("SELECT MAX(id_reposicion) AS id FROM reposiciones");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

if ($tipoFolio == "H")
{
    $sql = "UPDATE residencias_residentes_tarjetas_detalle SET folio_salida= '".$folio."'  WHERE lectura = '".$tarjetaAnterior."'";
    $result = mysql_query($sql);
}

if ($motivo == "Seguro")
{
    $sql = "UPDATE residencias_residentes_tarjetas_detalle SET seguro = 0 WHERE lectura = '".$tarjetaAnterior."'";
    $result = mysql_query($sql);
}

if ($tipoFolio == "B")
{
    $sql = "UPDATE residencias_residentes_tarjetas_detalle_no SET folio_salida= '".$folio."'  WHERE lectura = '".$tarjetaAnterior."'";
    $result = mysql_query($sql);
}

if ($tipoFolio == "MC")
{
    $sql = "UPDATE residencias_residentes_tarjetas_detalle_monte_carlo SET folio_salida= '".$folio."'  WHERE lectura = '".$tarjetaAnterior."'";
    $result = mysql_query($sql);
}

$sql = "UPDATE tarjetas SET estatus_id= '".$estatusAlta."'  WHERE lectura = '".$tarjetaNueva."'";
$result = mysql_query($sql);

$sql = "UPDATE tarjetas SET estatus_id= '".$estatusBaja."'  WHERE lectura = '".$tarjetaAnterior."'";
$result = mysql_query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(150, 13, 'RESIDENCIAL:', 0,0,'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 13, 'FOLIO:', 0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(150, 10, $nombrePrivada, 0,0,'L');
$pdf->Cell(40, 13, 'No. '.$id, 0,0,'C');
$pdf->Ln(12);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(100, 10, '', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 10, utf8_decode('Culiacán, Sinaloa,México     '.date('d/m/Y').''), 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 5, '', 0);
$pdf->Ln(15);
/*$pdf->SetFont('Arial', '', 12);
$pdf->Cell(180, 5, utf8_decode('Domicilio: '.$domicilio.' '.$nombrePrivada),0,0,'L');
$pdf->Ln(20);*/
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, utf8_decode('REPOSICIÓN DE TARJETA'),0,0,'C');
$pdf->Ln(15);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(180, 5, utf8_decode('Yo '.$nombre.' solicito el cambio de mi tarjeta por el motivo de: '.$motivo.'.'),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(180, 5, utf8_decode('Autorizo la baja de la tarjeta No.'.$tarjetaAnterior.' que fue vendida en el folio: '.$folio),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(180, 5, utf8_decode('por la alta de la tarjeta No. '.$tarjetaNueva.'.'),0,0,'L');
if ($observaciones != "")
{
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(180, 5, utf8_decode('Observaciones: '.$observaciones.'.'),0,0,'L');
}
$pdf->Ln(25);
$pdf->SetFont('Arial', 'U', 12);
$pdf->Cell(180, 5, utf8_decode('                                                                                                              '),0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 5, utf8_decode('FIRMA DE ACEPTACIÓN DEL SOLICITANTE'),0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(114,8,'',0);
$pdf->Output();
?>