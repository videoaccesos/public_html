<?php
require('../fpdf/fpdf.php');
require('../php/conexion.php');

$fecha= date("Y-m-d H:i:s");
$mes= $_POST['cmbMeses'];
$privada = $_POST['idPrivada'];
$cuota = $_POST['cuota'];
$pagoRecibido = $_POST['pago'];
$responsable= $_POST['responsable'];
$comentarios= $_POST['comentarios'];
$cantidadLetra = $_POST['cantidadLetra'];
$tipoPago= $_POST['cmbTipoPago'];
$tipoPagoLetra="";

if ($tipoPago == 1)
{
$tipoPagoLetra="Efectivo";
}

if ($tipoPago == 2)
{
$tipoPagoLetra="Bancos";
}

$rs1 = mysql_query("SELECT estatus,ano FROM pago_mensualidades where id_privada='$privada' and mes='$mes' ORDER BY ano DESC LIMIT 1");
if ($row = mysql_fetch_row($rs1)) {
$estatus= trim($row[0]);
$ano= trim($row[1]);
}

$rs2 = mysql_query("SELECT total FROM pago_mensualidades where id_privada='$privada' and mes='$mes' ORDER BY ano DESC LIMIT 1");
if ($row = mysql_fetch_row($rs2)) {
$total= trim($row[0]);
}

        if ($mes == 1)
        {
            $nombreMes="Enero";
        }
        if ($mes == 2)
        {
            $nombreMes="Febrero";
        }
        if ($mes == 3)
        {
            $nombreMes="Marzo";
        }
        if ($mes == 4)
        {
            $nombreMes="Abril";
        }
        if ($mes == 5)
        {
            $nombreMes="Mayo";
        }
        if ($mes == 6)
        {
            $nombreMes="Junio";
        }
        if ($mes == 7)
        {
            $nombreMes="Julio";
        }
        if ($mes == 8)
        {
            $nombreMes="Agosto";
        }
        if ($mes == 9)
        {
            $nombreMes="Septiembre";
        }
        if ($mes == 10)
        {
            $nombreMes="Octubre";
        }
        if ($mes == 11)
        {
            $nombreMes="Noviembre";
        }
        if ($mes == 12)
        {
            $nombreMes="Diciembre";
        }




if ($cuota == $pagoRecibido)
{
if ($estatus == 2)
{
$concepto = "Servicio al sistema de teleporteo correspondiente al mes de ".$nombreMes." del ".$ano;
}

if ($estatus == 3)
{
$concepto = "Liquidacion del servicio al sistema de teleporteo correspondiente al mes de ".$nombreMes." del ".$ano;
}
$registro1= mysql_query("UPDATE pago_mensualidades SET estatus = '1',cuota='0', pagado='$total' where mes='$mes' and id_privada='$privada'");
}


if ($pagoRecibido < $cuota)
{
$diferencia = $cuota - $pagoRecibido;
$concepto = "Pago parcial de servicio al sistema de teleporteo correspondiente al mes de ".$nombreMes." del ".$ano;
$registro2= mysql_query("UPDATE pago_mensualidades SET estatus= '3', cuota='$diferencia', pagado='$pagoRecibido' where mes='$mes' and id_privada='$privada'");
}
if ($privada != 0 && $concepto != "" && $responsable != "" && $pagoRecibido != 0)
{
$registro= mysql_query("INSERT INTO folios_mensualidades VALUES (NULL,'$privada','$concepto','$responsable','$pagoRecibido','$tipoPago', '".$fecha."', '1')");
}

$rs2 = mysql_query("SELECT cuota FROM pago_mensualidades where id_privada= '$privada' and mes='$mes'");
if ($row2 = mysql_fetch_row($rs2)) {
$pendiente= trim($row2[0]);
}

$rs = mysql_query("SELECT MAX(asignacion_id) AS id FROM folios_mensualidades");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}


$registro= mysql_query("SELECT fm.asignacion_id, fm.concepto, fm.responsable, fm.total, fm.fecha, p.descripcion, p.celular, p.email FROM folios_mensualidades as fm INNER JOIN privadas as p ON fm.privada_id = p.privada_id WHERE fm.asignacion_id = $id");
while($todosLosRegistros= mysql_fetch_array($registro)){
header("Content-Type: text/html;charset=utf-8");
$privada = $todosLosRegistros['descripcion'];
$celular = $todosLosRegistros['celular'];
$email = $todosLosRegistros['email'];
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(150, 13, 'RESIDENCIAL:', 0,0,'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 13, 'FOLIO:', 0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(150, 10, $privada, 0,0,'L');
$pdf->Cell(40, 10, 'No. '.$id.' A', 0,0,'C');
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
	$pdf->Cell(190, 7, utf8_decode('Razиоn Social: ').$privada, 1,0);
$pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Responsable de Pago: ').$todosLosRegistros['responsable'], 1,0);
	$pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Telижfono Privada: ').$celular, 1,0);
	$pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Correo Electrиоnico Privada: ').$email, 1,0);
	$pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, 'CANTIDAD', 1,0,'C');
$pdf->Cell(130, 6, utf8_decode('CONCEPTO'), 1,0,'C');
$pdf->Cell(20, 6, 'P. UNIT.', 1,0,'C');
$pdf->Cell(20, 6, 'IMPORTE', 1,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, '1', 1,0,'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(130, 6, $todosLosRegistros['concepto'], 1,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, '$'.$pagoRecibido .'', 1,0,'C');
$pdf->Cell(20, 6, '$'.$pagoRecibido .'', 1,0,'C');
$pdf->Ln(6);
if ($concepto == "Pago parcial de servicio al sistema de teleporteo correspondiente al mes de ".$nombreMes." del ".$ano)
{
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 6, '', 0,0,'L');
}
else
{
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 6, 'Importe con letra: ', 0,0,'L');
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, '',0,0,'C');
$pdf->Cell(130, 6, 'SubTotal:', 0,0,'R');
$pdf->Cell(20, 6, '$'.$pagoRecibido .'',1,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 6, '',0,0,'R');
if ($concepto == "Pago parcial de servicio al sistema de teleporteo correspondiente al mes de ".$nombreMes." del ".$ano)
{
$pdf->Cell(130, 6, 'Para liquidar el pago de la mensualidad quedan pendientes: $'.$pendiente,0,0,'C');
}
else
{
$pdf->Cell(130, 6, 'Son: '.$cantidadLetra.'',0,0,'C');
}
$pdf->Cell(20, 6, '16 % I.V.A:', 0,0,'R');
$pdf->Cell(20, 6, '$0',1,0,'C');
$pdf->Ln(6);

$pdf->Cell(20, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, '',0,0,'C');
$pdf->Cell(130, 6, 'Total:', 0,0,'R');
$pdf->Cell(20, 6, '$'.$pagoRecibido .'',1,0,'C');

$pdf->Ln(6);

$pdf->Cell(20, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, '',0,0,'C');
$pdf->Cell(130, 6, 'Tipo de Pago:', 0,0,'R');
$pdf->Cell(20, 6, ''.$tipoPagoLetra.'',1,0,'C');

$pdf->Ln(25);
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(95, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Cell(95, 5, utf8_decode('                                                                   '),0,0,'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(95, 5, utf8_decode('FIRMA DE ENTREGADO'),0,0,'C');
$pdf->Cell(95, 5, utf8_decode('FIRMA DE RECIBIDO'),0,0,'C');
$pdf->Ln(20);
if ($comentarios != "")
{
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 6, 'Comentarios: '.$comentarios.'',0,0,'R');
}
else
{
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 6, '',0,0,'R');
}
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 6, 'www.videoaccesos.com', 1,0,'C');

}
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Output();
?>