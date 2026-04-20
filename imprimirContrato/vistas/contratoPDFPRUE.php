<?php
require('../fpdf/fpdf.php');
require('../php/conexion.php');
$rs = mysql_query("SELECT MAX(asignacion_id) AS id FROM residencias_residentes_tarjetas");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$registro5= mysql_query("update tarjetas as T INNER JOIN residencias_residentes_tarjetas as RRT on T.tarjeta_id=RRT.tarjeta_id OR T.tarjeta_id=RRT.tarjeta_id2 OR T.tarjeta_id=RRT.tarjeta_id3 OR T.tarjeta_id=RRT.tarjeta_id4 OR T.tarjeta_id=RRT.tarjeta_id5 set T.estatus_id = 2 where RRT.asignacion_id=$id");

$registro= mysql_query("SELECT RR.ape_paterno, RR.ape_materno, RR.nombre, R.nro_casa, R.calle, R.telefono1,R.telefono2,R.interfon,R.telefono_interfon,R.extra_telefono_interfon,R.extra_clave_interfon,R.extra_precio_interfon,RR.email, R.privada_id, P.descripcion, T.lectura, RRT.tarjeta_id,RRT.tarjeta_id2,RRT.tarjeta_id3,RRT.tarjeta_id4,RRT.tarjeta_id5, RRT.fecha, RRT.fecha_vencimiento, RRT.lectura_tipo_id, RRT.comprador_id, RRT.mostrar_nombre_comprador, RRT.folio_contrato, RRT.precio, RRT.descuento, RRT.IVA, RRT.numero_serie,RRT.numero_serie2,RRT.numero_serie3,RRT.numero_serie4,RRT.numero_serie5, RRT.utilizo_seguro, RRT.utilizo_seguro2, RRT.utilizo_seguro3, RRT.utilizo_seguro4, RRT.utilizo_seguro5, RRT.estatus_id, RRT.usuario_id, U.usuario FROM residencias_residentes_tarjetas as RRT INNER JOIN residencias_residentes as RR ON RR.residente_id = RRT.residente_id INNER JOIN tarjetas as T ON T.tarjeta_id = RRT.tarjeta_id INNER JOIN residencias as R on R.residencia_id=RR.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id INNER JOIN usuarios AS U ON RRT.usuario_id = U.usuario_id WHERE RRT.asignacion_id = $id");
while($todosLosRegistros= mysql_fetch_array($registro)){
header("Content-Type: text/html;charset=utf-8");
$id_tarjeta1 = $todosLosRegistros['tarjeta_id'];
$id_tarjeta2 = $todosLosRegistros['tarjeta_id2'];
$id_tarjeta3 = $todosLosRegistros['tarjeta_id3'];
$id_tarjeta4 = $todosLosRegistros['tarjeta_id4'];
$id_tarjeta5 = $todosLosRegistros['tarjeta_id5'];

$numeroSerie1= $todosLosRegistros['numero_serie'];
$numeroSerie2= $todosLosRegistros['numero_serie2'];
$numeroSerie3= $todosLosRegistros['numero_serie3'];
$numeroSerie4= $todosLosRegistros['numero_serie4'];
$numeroSerie5= $todosLosRegistros['numero_serie5'];
$usuarioID= $todosLosRegistros['usuario_id'];
$interfon= $todosLosRegistros['interfon'];
$telefonoInterfon= $todosLosRegistros['telefono_interfon'];
$extraTelefonoInterfon= $todosLosRegistros['extra_telefono_interfon'];
$extraClaveInterfon= $todosLosRegistros['extra_clave_interfon'];
$extraPrecioInterfon= $todosLosRegistros['extra_precio_interfon'];
$nombreResidente = $todosLosRegistros['nombre'].' '.$todosLosRegistros['ape_paterno'].' '.$todosLosRegistros['ape_materno'];
$mostrarNombreComprador= $todosLosRegistros['mostrar_nombre_comprador'];
$result= mysql_query("SELECT empleado_id FROM usuarios WHERE usuario_id=$usuarioID");          //query
  $empleado_id= mysql_fetch_row($result);  
$extraInterfon="";
if ($extraClaveInterfon != "" && $extraTelefonoInterfon != "")
{
$extraInterfon= utf8_decode('  Extra Cve. Interfon: ').$extraClaveInterfon.utf8_decode(' Extra Tel. Interfón: ').$extraTelefonoInterfon;
}

$queryNombre= mysql_query("SELECT nombre, ape_paterno, ape_materno FROM empleados WHERE empleado_id=$empleado_id[0]");          //query 


while($registroNombre= mysql_fetch_array($queryNombre)){
$nombreCompleto = $registroNombre['nombre'].' '.$registroNombre['ape_paterno'].' '.$registroNombre['ape_materno'];
}

$descuento= $todosLosRegistros['descuento'];
$IVA= $todosLosRegistros['IVA'];
$usuario= $todosLosRegistros['usuario'];
$precioSeguro=50;
$result1= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta1'");
$tarjeta1= mysql_fetch_row($result1);
$result2= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta2'");
$tarjeta2= mysql_fetch_row($result2);
$result3= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta3'");
$tarjeta3= mysql_fetch_row($result3);
$result4= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta4'");
$tarjeta4= mysql_fetch_row($result4);
$result5= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta5'");
$tarjeta5= mysql_fetch_row($result5);

$result11= mysql_query("SELECT tipo_id FROM tarjetas where tarjeta_id = '$id_tarjeta1'");
$tipoTarjeta1= mysql_fetch_row($result11);
$result22= mysql_query("SELECT tipo_id FROM tarjetas where tarjeta_id = '$id_tarjeta2'");
$tipoTarjeta2= mysql_fetch_row($result22);
$result33= mysql_query("SELECT tipo_id FROM tarjetas where tarjeta_id = '$id_tarjeta3'");
$tipoTarjeta3= mysql_fetch_row($result33);
$result44= mysql_query("SELECT tipo_id FROM tarjetas where tarjeta_id = '$id_tarjeta4'");
$tipoTarjeta4= mysql_fetch_row($result44);
$result55= mysql_query("SELECT tipo_id FROM tarjetas where tarjeta_id = '$id_tarjeta5'");
$tipoTarjeta5= mysql_fetch_row($result55);

$id_privada=$todosLosRegistros['privada_id'];
$nombre_privada=$todosLosRegistros['descripcion'];
$seguro1= $todosLosRegistros['utilizo_seguro'];
$seguro2= $todosLosRegistros['utilizo_seguro2'];
$seguro3= $todosLosRegistros['utilizo_seguro3'];
$seguro4= $todosLosRegistros['utilizo_seguro4'];
$seguro5= $todosLosRegistros['utilizo_seguro5'];
$fechaVencimiento= $todosLosRegistros['fecha_vencimiento'];
$totalSeguros=0;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$pdf->Image('../recursos/videoaccesos.png' , 10 ,10, 60 , 22,'PNG');
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 10, '', 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 13, 'FOLIO:', 0,0,'C');
$pdf->Ln(6);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 10, '', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'No. '.$id.' H', 0,0,'C');
$pdf->Ln(6);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 10, '', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 13, 'FECHA:', 0,0,'C');
$pdf->Ln(5);
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(140, 10, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 10, ''.date('d/m/Y').'', 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, '', 0);
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
  $pdf->Cell(190, 7, utf8_decode('Nombre Residente: ').$nombreResidente, 1,0);
$pdf->Ln(7);
if ($mostrarNombreComprador)
{
  $pdf->Cell(190, 7, utf8_decode('Nombre Comprador: ').$todosLosRegistros['comprador_id'], 1,0);
$pdf->Ln(7);
}
$pdf->Cell(190, 7, utf8_decode('Domicilio: ').$todosLosRegistros['calle'].' '.$todosLosRegistros['nro_casa'].' '.$todosLosRegistros['descripcion'], 1,0);
  $pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Teléfono Celular: ').$todosLosRegistros['telefono2'].utf8_decode('  Cve. Interfón: ').$interfon.utf8_decode(' Tel. Interfón: ').$telefonoInterfon.$extraInterfon, 1,0);
  $pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Teléfono Casa: ').$todosLosRegistros['telefono1'], 1,0);
  $pdf->Ln(7);
$pdf->Cell(190, 7, utf8_decode('Correo Electrónico: ').$todosLosRegistros['email'], 1,0);
  $pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(30, 6, 'CANTIDAD', 1,0,'C');
$pdf->Cell(80, 6, utf8_decode('NÚMERO DE TARJETA (N/S)'), 1,0,'C');
$pdf->Cell(30, 6, 'SEGURO', 1,0,'C');
$pdf->Cell(50, 6, 'PRECIO UNITARIO', 1,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 7);
if ($id_tarjeta1 != "")
{
$pdf->Cell(30, 6, '1', 1,0,'C');
$pdf->Cell(80, 6, $tarjeta1[0].' ('.$numeroSerie1.')', 1,0,'C');
if ($tipoTarjeta1[0]== "1")
{
$result1 = mysql_query("SELECT precio_peatonal FROM privadas WHERE privada_id = '$id_privada'");
  $precio1= mysql_fetch_row($result1);   
} 

if ($tipoTarjeta1[0]== "2")
{
$result1 = mysql_query("SELECT precio_vehicular FROM privadas WHERE privada_id = '$id_privada'");
  $precio1= mysql_fetch_row($result1);
}
if ($seguro1==1)
{
$resultadoSeguro1="SI";
$totalSeguros=$totalSeguros+$precioSeguro;
}
else
{
$resultadoSeguro1="NO";
}
$pdf->Cell(30, 6, $resultadoSeguro1, 1,0,'C');
$pdf->Cell(50, 6, '$'.$precio1[0].'', 1,0,'C');

$pdf->Ln(6);
}
if ($id_tarjeta2 != "")
{
$pdf->Cell(30, 6, '1', 1,0,'C');
$pdf->Cell(80, 6, $tarjeta2[0].' ('.$numeroSerie2.')', 1,0,'C');
if ($tipoTarjeta2[0]== "1")
{
$result2 = mysql_query("SELECT precio_peatonal FROM privadas WHERE privada_id = '$id_privada'");
  $precio2= mysql_fetch_row($result2);   
} 

if ($tipoTarjeta2[0]== "2")
{
$result2 = mysql_query("SELECT precio_vehicular FROM privadas WHERE privada_id = '$id_privada'");
  $precio2= mysql_fetch_row($result2);
}
if ($seguro2==1)
{
$resultadoSeguro2="SI";
$totalSeguros=$totalSeguros+$precioSeguro;
}
else
{
$resultadoSeguro2="NO";
}
$pdf->Cell(30, 6, $resultadoSeguro2, 1,0,'C');
$pdf->Cell(50, 6, '$'.$precio2[0].'', 1,0,'C');

$pdf->Ln(6);
}
if ($id_tarjeta3 != "")
{
$pdf->Cell(30, 6, '1', 1,0,'C');
$pdf->Cell(80, 6, $tarjeta3[0].' ('.$numeroSerie3.')', 1,0,'C');
if ($tipoTarjeta3[0]== "1")
{
$result3 = mysql_query("SELECT precio_peatonal FROM privadas WHERE privada_id = '$id_privada'");
  $precio3= mysql_fetch_row($result3);   
} 

if ($tipoTarjeta3[0]== "2")
{
$result3 = mysql_query("SELECT precio_vehicular FROM privadas WHERE privada_id = '$id_privada'");
  $precio3= mysql_fetch_row($result3);
}
if ($seguro3==1)
{
$resultadoSeguro3="SI";
$totalSeguros=$totalSeguros+$precioSeguro;
}
else
{
$resultadoSeguro3="NO";
}
$pdf->Cell(30, 6, $resultadoSeguro3, 1,0,'C');
$pdf->Cell(50, 6, '$'.$precio3[0].'', 1,0,'C');

$pdf->Ln(6);
}
if ($id_tarjeta4 != "")
{
$pdf->Cell(30, 6, '1', 1,0,'C');
$pdf->Cell(80, 6, $tarjeta4[0].' ('.$numeroSerie4.')', 1,0,'C');
if ($tipoTarjeta4[0]== "1")
{
$result4 = mysql_query("SELECT precio_peatonal FROM privadas WHERE privada_id = '$id_privada'");
  $precio4= mysql_fetch_row($result4);   
} 

if ($tipoTarjeta4[0]== "2")
{
$result4 = mysql_query("SELECT precio_vehicular FROM privadas WHERE privada_id = '$id_privada'");
  $precio4= mysql_fetch_row($result4);
}
if ($seguro4==1)
{
$resultadoSeguro4="SI";
$totalSeguros=$totalSeguros+$precioSeguro;
}
else
{
$resultadoSeguro4="NO";
}
$pdf->Cell(30, 6, $resultadoSeguro4, 1,0,'C');
$pdf->Cell(50, 6, '$'.$precio4[0].'', 1,0,'C');

$pdf->Ln(6);
}
if ($id_tarjeta5 != "")
{
$pdf->Cell(30, 6, '1', 1,0,'C');
$pdf->Cell(80, 6, $tarjeta5[0].' ('.$numeroSerie5.')', 1,0,'C');
if ($tipoTarjeta5[0]== "1")
{
$result5 = mysql_query("SELECT precio_peatonal FROM privadas WHERE privada_id = '$id_privada'");
  $precio5= mysql_fetch_row($result5);   
} 

if ($tipoTarjeta5[0]== "2")
{
$result5 = mysql_query("SELECT precio_vehicular FROM privadas WHERE privada_id = '$id_privada'");
  $precio5= mysql_fetch_row($result5);
}
if ($seguro5==1)
{
$resultadoSeguro5="SI";
$totalSeguros=$totalSeguros+$precioSeguro;
}
else
{
$resultadoSeguro5="NO";
}
$pdf->Cell(30, 6, $resultadoSeguro5, 1,0,'C');
$pdf->Cell(50, 6, '$'.$precio5[0].'', 1,0,'C');
$pdf->Ln(6);
}

$subTotal=$precio1[0]+$precio2[0]+$precio3[0]+$precio4[0]+$precio5[0];
$total = $precio1[0]+$precio2[0]+$precio3[0]+$precio4[0]+$precio5[0]+$totalSeguros+$extraPrecioInterfon-$descuento+$IVA;

$pdf->Cell(30, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 6, '',0,0,'C');
$pdf->Cell(80, 6, 'SubTotal:', 0,0,'R');
$pdf->Cell(50, 6, '$'.$subTotal.'',1,0,'C');
$pdf->Ln(6);
if ($totalSeguros > 0)
{
$pdf->Cell(30, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 6, '',0,0,'C');
$pdf->Cell(80, 6, 'Seguros (+):', 0,0,'R');
$pdf->Cell(50, 6, '$'.$totalSeguros.'',1,0,'C');
$pdf->Ln(6);
}
if ($extraPrecioInterfon>0)
{
$pdf->Cell(30, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 6, '',0,0,'C');
$pdf->Cell(80, 6, utf8_decode('Extra Interfón(+):'), 0,0,'R');
$pdf->Cell(50, 6, '$'.$extraPrecioInterfon.'',1,0,'C');
$pdf->Ln(6);
}
if ($descuento>0)
{
$pdf->Cell(30, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 6, '',0,0,'C');
$pdf->Cell(80, 6, 'Descuento (-):', 0,0,'R');
$pdf->Cell(50, 6, '$'.$descuento.'',1,0,'C');
$pdf->Ln(6);
}
if ($IVA>0)
{
$pdf->Cell(30, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 6, '',0,0,'C');
$pdf->Cell(80, 6, 'IVA(+):', 0,0,'R');
$pdf->Cell(50, 6, '$'.$IVA.'',1,0,'C');
$pdf->Ln(6);
}
$pdf->Cell(30, 6, '', 0,0,'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 6, '',0,0,'C');
$pdf->Cell(80, 6, 'Total:', 0,0,'R');
$pdf->Cell(50, 6, '$'.$total.'',1,0,'C');
$pdf->Ln(11);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(180, 5, utf8_decode('SOLICITUD DE ACTIVACIÓN DE TARJETA:'),0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(180, 5, utf8_decode('Por este medio solicito que las tarjetas cuyos números figuran en el presente documento, sean activadas para ingresar mediante el uso del control de '),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('acceso instalado en la entrada del residencial ').$nombre_privada,0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('Así mismo realizo las siguientes declaraciones: '),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('PRIMERA: En este acto me adhiero al contrato entre el comité de vecinos del residencial '.$nombre_privada.' y José Miguel Ruiz Díaz, a quien en'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('este documento se le denominará El Prestador. Para el suministro de equipo y prestación de servicio de teleportero, este contrato fue presentado'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('para su lectura, así mismo reconozco que la propiedad del equipo instalado es de El Prestador y que solamente se instalará en comodato, el servicio'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('de teleportero y los mantenimientos preventivos y correctivos serán realizados por El prestador conforme a lo estipulado en el contrato. La tarjeta'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('tendrá validez únicamente durante la duración del contrato.'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('SEGUNDA: Entiendo que la compra de tarjetas a El Prestador, en ningún momento lo obliga a brindarme algún servicio, y que el prestador realizará'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('su trabajo conforme a las instrucciones que el comité de vecinos le haga llegar oportunamente.'),0,0,'L');
$pdf->Ln(6);

$pdf->Cell(180, 5, utf8_decode('Esta tarjeta podrá ser activada para acceder al residencial, siempre y cuando lo autorice el Comité de vecinos y podrá ser cancelado y/o suspendida'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('sin responsabilidad del prestador en los siguientes casos:'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('a) Mal uso de la tarjeta activada, entendiéndose ésto, como cualquier uso que tenga como fin el acceso a personas ajenas al residencial sin'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('registrarse, la activación de la tarjeta es personal e intransferible.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('b) Cuando la tarjeta activada sea usada por un residente que tenga la categoria de moroso tenga desactivadas sus propias tarjetas por ese u otro motivo.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('c) Cuando la tarjeta activada no sea utilizada por mas de 90 días naturales continuos, se considerará extraviada y será cancelada.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('d) Por instrucciones del comité de vecinos.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('TERCERA: Me comprometo a reportar inmediatamente la pérdida, extravío o robo de cualquiera de las tarjetas que le han sido activadas. Este'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('reporte podrá ser directamente a Video Accesos (667)7126043, por correo electrónico a "atencionaclientes@videoaccesos.com" o en las oficinas'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('ubicadas en Blvd. Zapata 543 Pte. Loc. 5 de esta ciudad de Culiacán, Sinaloa.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('CUARTA: En este acto autorizo a VECINO SEGURO A.C. a representarme ante las autoridades de cualquier nivel de gobierno, exclusivamente en lo'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('referente a acto o disputas relativos a la operación de control de acceso instalado y gestión de servicios públicos al interior del residencial.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('QUINTA: Por este medio entiendo y acepto que El Prestador no se hace responsable por daños o lesiones derivadas de la operación de sistema'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('mecánico y electrónico del Control de Accesos.'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('SEXTO: Reconozco que se me informa que puedo consultar integralmente el aviso de privacidad que protege mis datos personales, directamente en la'),0,0,'L');
$pdf->Ln(3);
$pdf->Cell(180, 5, utf8_decode('página web www.videoaccesos.com'),0,0,'L');
$pdf->Ln(6);
$pdf->Cell(180, 5, utf8_decode('SEPTIMO: En caso de pérdida de la tarjeta se deberá de comprar una nueva al precio contratado.'),0,0,'L');
$pdf->Ln(12);
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(180, 5, utf8_decode('                                                                                                              '),0,0,'C');
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(180, 5, utf8_decode('FIRMA DE ACEPTACIÓN DEL SOLICITANTE Y ADHERENTE'),0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(180, 5, 'Elaborado por:',0,0,'L');
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(180, 5, $nombreCompleto,0,0,'L');
}
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Output();
?>