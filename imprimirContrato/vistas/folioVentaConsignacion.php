<?php
require('../fpdf/fpdf.php');
require('../php/conexion.php');

$privada = $_POST['cmbPrivadas'];
$responsable = $_POST['responsable'];
$cantidad = $_POST['cantidad'];
$nsInicial = $_POST['nsInicial'];
$nsFinal = $_POST['nsFinal'];
$tarjeta1= $_POST['tarjeta1'];
$tarjeta2= $_POST['tarjeta2'];
$tarjeta3= $_POST['tarjeta3'];
$tarjeta4= $_POST['tarjeta4'];
$tarjeta5= $_POST['tarjeta5'];
$tarjeta6= $_POST['tarjeta6'];
$tarjeta7= $_POST['tarjeta7'];
$tarjeta8= $_POST['tarjeta8'];
$tarjeta9= $_POST['tarjeta9'];
$tarjeta10= $_POST['tarjeta10'];
$ns1= $_POST['ns1'];
$ns2= $_POST['ns2'];
$ns3= $_POST['ns3'];
$ns4= $_POST['ns4'];
$ns5= $_POST['ns5'];
$ns6= $_POST['ns6'];
$ns7= $_POST['ns7'];
$ns8= $_POST['ns8'];
$ns9= $_POST['ns9'];
$ns10= $_POST['ns10'];
$observaciones = $_POST['observaciones'];
$concepto="Venta a consignación del NS ".$nsInicial." al NS ".$nsFinal.".";
$controlador=0;


$result1 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta1' and estatus_id=1");
  $tarjetaID1= mysql_fetch_row($result1); 

$result2 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta2' and estatus_id=1");
  $tarjetaID2= mysql_fetch_row($result2);   

  $result3 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta3' and estatus_id=1");
  $tarjetaID3= mysql_fetch_row($result3);   

  $result4 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta4' and estatus_id=1");
  $tarjetaID4= mysql_fetch_row($result4);   

  $result5 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta5' and estatus_id=1");
  $tarjetaID5= mysql_fetch_row($result5);  

$result6 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta6' and estatus_id=1");
  $tarjetaID6= mysql_fetch_row($result6); 

$result7 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta7' and estatus_id=1");
  $tarjetaID7= mysql_fetch_row($result7);   

  $result8 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta8' and estatus_id=1");
  $tarjetaID8= mysql_fetch_row($result8);   

  $result9 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta9' and estatus_id=1");
  $tarjetaID9= mysql_fetch_row($result9);   

  $result10 = mysql_query("SELECT tarjeta_id FROM tarjetas WHERE lectura='$tarjeta10' and estatus_id=1");
  $tarjetaID10= mysql_fetch_row($result10);  

if ($tarjeta1 !="" && $tarjetaID1[0] == "")
{
echo "<script> var tarjeta1 = $tarjeta1; confirm('La tarjeta '+ tarjeta1 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta1="";
$ns1="";
$controlador=1;
}

if ($tarjeta2 !="" && $tarjetaID2[0] == "")
{
echo "<script> var tarjeta2 = $tarjeta2; confirm('La tarjeta '+ tarjeta2 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta2="";
$ns2="";
$controlador=1;
}

if ($tarjeta3 !="" && $tarjetaID3[0] == "")
{
echo "<script> var tarjeta3 = $tarjeta3; confirm('La tarjeta '+ tarjeta3 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta3="";
$ns3="";
$controlador=1;
}

if ($tarjeta4 !="" && $tarjetaID4[0] == "")
{
echo "<script> var tarjeta4 = $tarjeta4; confirm('La tarjeta '+ tarjeta4 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta4="";
$ns4="";
$controlador=1;
}

if ($tarjeta5 !="" && $tarjetaID5[0] == "")
{
echo "<script> var tarjeta5 = $tarjeta5; confirm('La tarjeta '+ tarjeta5 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta5="";
$ns5="";
$controlador=1;
}

if ($tarjeta6 !="" && $tarjetaID6[0] == "")
{
echo "<script> var tarjeta6 = $tarjeta6; confirm('La tarjeta '+ tarjeta6 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta6="";
$ns6="";
$controlador=1;
}

if ($tarjeta7 !="" && $tarjetaID7[0] == "")
{
echo "<script> var tarjeta7 = $tarjeta7; confirm('La tarjeta '+ tarjeta7 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta7="";
$ns7="";
$controlador=1;
}

if ($tarjeta8 !="" && $tarjetaID8[0] == "")
{
echo "<script> var tarjeta8 = $tarjeta8; confirm('La tarjeta '+ tarjeta8 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta8="";
$ns8="";
$controlador=1;
}

if ($tarjeta9 !="" && $tarjetaID9[0] == "")
{
echo "<script> var tarjeta9 = $tarjeta9; confirm('La tarjeta '+ tarjeta9 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta9="";
$ns9="";
$controlador=1;
}

if ($tarjeta10 !="" && $tarjetaID10[0] == "")
{
echo "<script> var tarjeta10 = $tarjeta10; confirm('La tarjeta '+ tarjeta10 + ' no se encuentra disponible en el sistema.')</script>";
$tarjeta10="";
$ns10="";
$controlador=1;
}

if ($tarjeta1!= "" && $tarjetaID1[0] !="" && $controlador == 0)
{
$registro1= mysql_query("INSERT INTO folios_ventas_consignacion VALUES (NULL,'$privada','$responsable','$cantidad','$nsInicial', '$nsFinal', '$tarjeta1', '$ns1', '', '', '', '','', '','', '','', '','', '','', '','', '','', '','$observaciones', CURRENT_TIMESTAMP, '1')");

$rs = mysql_query("SELECT MAX(asignacion_id) AS id FROM folios_ventas_consignacion");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);

if ($tarjeta2 != "" && $tarjetaID2[0] !="")
{
$registro2= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta2='$tarjeta2',ns2='$ns2' where asignacion_id='$id'");
}

if ($tarjeta3 != "" && $tarjetaID3[0] !="")
{
$registro3= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta3='$tarjeta3',ns3='$ns3' where asignacion_id='$id'");
}

if ($tarjeta4 != "" && $tarjetaID4[0] !="")
{
$registro4= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta4='$tarjeta4',ns4='$ns4' where asignacion_id='$id'");
}

if ($tarjeta5 != "" && $tarjetaID5[0] !="")
{
$registro5= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta5='$tarjeta5',ns5='$ns5' where asignacion_id='$id'");
}

if ($tarjeta6 != "" && $tarjetaID6[0] !="")
{
$registro6= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta6='$tarjeta6',ns6='$ns6' where asignacion_id='$id'");
}

if ($tarjeta7 != "" && $tarjetaID7[0] !="")
{
$registro7= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta7='$tarjeta7',ns7='$ns7' where asignacion_id='$id'");
}

if ($tarjeta8 != "" && $tarjetaID8[0] !="")
{
$registro8= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta8='$tarjeta8',ns8='$ns8' where asignacion_id='$id'");
}

if ($tarjeta9 != "" && $tarjetaID9[0] !="")
{
$registro9= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta9='$tarjeta9',ns9='$ns9' where asignacion_id='$id'");
}

if ($tarjeta10 != "" && $tarjetaID10[0] !="")
{
$registro10= mysql_query("UPDATE folios_ventas_consignacion SET tarjeta10='$tarjeta10',ns10='$ns10' where asignacion_id='$id'");
}

}

$registro5= mysql_query("update tarjetas as T INNER JOIN folios_ventas_consignacion as FVC on T.lectura=FVC.tarjeta1 OR T.lectura=FVC.tarjeta2 OR T.lectura=FVC.tarjeta3 OR T.lectura=FVC.tarjeta4 OR T.lectura=FVC.tarjeta5 OR T.lectura=FVC.tarjeta6 OR T.lectura=FVC.tarjeta7 OR T.lectura=FVC.tarjeta8 OR T.lectura=FVC.tarjeta9 OR T.lectura=FVC.tarjeta10 set T.estatus_id = 4 where FVC.asignacion_id=$id");

$registro= mysql_query("SELECT fvc.asignacion_id, fvc.responsable, fvc.cantidad, p.descripcion, fvc.nsInicial, fvc.nsFinal, fvc.observaciones, fvc.fecha FROM folios_ventas_consignacion as fvc INNER JOIN privadas as p ON fvc.privada_id = p.privada_id WHERE fvc.asignacion_id = $id");
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
$pdf->Cell(40, 10, 'No. '.$id, 0,0,'C');
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
	$pdf->Cell(190, 7, utf8_decode('Razón Social: ').$privada, 1,0);
$pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Responsable de Pago: ').$todosLosRegistros['responsable'], 1,0);
	$pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, 'CANTIDAD', 1,0,'C');
$pdf->Cell(170, 6, utf8_decode('CONCEPTO'), 1,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, $todosLosRegistros['cantidad'], 1,0,'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(170, 6, utf8_decode($concepto), 1,0,'C');
$pdf->Ln(15);
$pdf->Cell(190, 8, $tarjeta1." ".$ns1, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta2." ".$ns2, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta3." ".$ns3, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta4." ".$ns4, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta5." ".$ns5, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta6." ".$ns6, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta7." ".$ns7, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta8." ".$ns8, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta9." ".$ns9, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 8, $tarjeta10." ".$ns10, 0,0,'L');
$pdf->Ln(8);
$pdf->Cell(190, 6, 'COMENTARIOS:', 0,0,'C');
$pdf->Ln(8);
$pdf->MultiCell(190,6, utf8_decode($todosLosRegistros['observaciones']));
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
echo "HA OCURRIDO UN ERROR AL REALIZAR LA VENTA A CONSIGNACION, LAS TARJETAS INGRESADAS NO SE ENCUENTRAN DISPONIBLES EN EL SISTEMA.";
}
?>