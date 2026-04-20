<?php 

  $numeroCasa=$_POST['txtNumCasa_Tarjetas'];
  $calle=$_POST['txtCalle_Tarjetas'];
  $fechaInicial=$_POST['dtFecha_Tarjetas'];
  $fechaVencimiento=$_POST['dtFechaVencimiento_Tarjetas'];
  $estatus=$_POST['cmbEstatusID_Tarjetas'];
$folioConsecutivo = $_POST['txtAsignacionID'];
  $nombreResidente=$_POST['txtResidente_Tarjetas'];
$nombreComprador=$_POST['txtComprador_Tarjetas'];
$mostrarNombreComprador=$_POST['chkNombreComprador'];
  $folioContrato=$_POST['txtFolioContrato_Tarjetas'];
  $tipoLectura=$_POST['cmbTipoLecturaID_Tarjetas'];
  $lecturaTarjeta=$_POST['txtLectura_Tarjetas'];
$lecturaTarjeta2=$_POST['txtLectura_Tarjetas2'];
$lecturaTarjeta3=$_POST['txtLectura_Tarjetas3'];
$lecturaTarjeta4=$_POST['txtLectura_Tarjetas4'];
$lecturaTarjeta5=$_POST['txtLectura_Tarjetas5'];
  $numeroSerie=$_POST['txtNumeroSerie1'];
$numeroSerie2=$_POST['txtNumeroSerie2'];
$numeroSerie3=$_POST['txtNumeroSerie3'];
$numeroSerie4=$_POST['txtNumeroSerie4'];
$numeroSerie5=$_POST['txtNumeroSerie5'];
  $precio=$_POST['txtPrecio_Tarjetas'];
$precio2=$_POST['txtPrecio_Tarjetas2'];
$precio3=$_POST['txtPrecio_Tarjetas3'];
$precio4=$_POST['txtPrecio_Tarjetas4'];
$precio5=$_POST['txtPrecio_Tarjetas5'];
$descuento=$_POST['txtDescuento_Tarjetas'];
  $seguro=$_POST['chkUtilizoSeguro_Tarjetas'];
$seguro2=$_POST['chkUtilizoSeguro_Tarjetas2'];
$seguro3=$_POST['chkUtilizoSeguro_Tarjetas3'];
$seguro4=$_POST['chkUtilizoSeguro_Tarjetas4'];
$seguro5=$_POST['chkUtilizoSeguro_Tarjetas5'];
$total=$_POST['txtTotal_Tarjetas'];
  $privada=$_POST['txtPrivada_Tarjetas'];
  $telefono=$_POST['txtTelefonos_Tarjetas'];
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contrato</title>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../js/jquery.js"></script>
<script src="../js/myjava.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body >
    <header>Datos del Contrato</header>
    <section>
    <table border="0" align="center">
    	<tr>
           <?php 

            echo "<td width='120'></td><td width='200'><a target='_blank' href='contratoPDFMC.php' class='btn btn-danger'>Generar Contrato</a></td> <td width='200'><a target='_blank' href='../../syscbctlmonitoreo' class='btn btn-danger'>Regresar</a></td>";

        ?>
        </tr>
    </table>
    </section>
    <div class="registros" id="agrega-registros">
    	<table  class="table table-striped table-condensed table-hover">
        	<tr>
<th width="30">Folio</th>
            	<th width="50">Nro. Casa</th>
                <th width="50">Calle</th>
                <th width="50">Fecha Inicial</th>
                <th width="50">Fecha Vencimiento</th>
                <th width="150">Residente</th>
                <th width="150">Comprador</th>
<th width="30">Mostrar Comprador</th>
<th width="50">Folio Contrato</th>
                <th width="50">Lectura 1</th>
                <th width="50">Lectura 2</th>
                <th width="50">Lectura 3</th>
                <th width="50">Lectura 4</th>
                <th width="50">Lectura 5</th>
                <th width="30">NS 1</th>
                <th width="30">NS 2</th>
                <th width="30">NS 3</th>
                <th width="30">NS 4</th>
                <th width="30">NS 5</th>
                <th width="40">Precio 1</th>
                <th width="40">Precio 2</th>
                <th width="40">Precio 3</th>
                <th width="40">Precio 4</th>
                <th width="40">Precio 5</th>
<th width="30">Descuento</th>
                <th width="30">Seguro 1</th>
                <th width="30">Seguro 2</th>
                <th width="30">Seguro 3</th>
                <th width="30">Seguro 4</th>
                <th width="30">Seguro 5</th>
                <th width="100">Privada</th>
                <th width="50">Telefono</th>
            </tr>
            <?php 
						echo '<tr>
<td>'.$folioConsecutivo.'</td>
								<td>'.$numeroCasa.'</td>
								<td>'.$calle.'</td>
								<td>'.$fechaInicial.'</td>
<td>'.$fechaVencimiento.'</td>
								<td>'.$nombreResidente.'</td>
                <td>'.$nombreComprador.'</td>
<td>'.$mostrarNombreComprador.'</td>
<td>'.$folioContrato.'</td>
								<td>'.$lecturaTarjeta.'</td>
                <td>'.$lecturaTarjeta2.'</td>
                <td>'.$lecturaTarjeta3.'</td>
                <td>'.$lecturaTarjeta4.'</td>
                <td>'.$lecturaTarjeta5.'</td>
                <td>'.$numeroSerie.'</td>
                <td>'.$numeroSerie2.'</td>
                <td>'.$numeroSerie3.'</td>
                <td>'.$numeroSerie4.'</td>
                <td>'.$numeroSerie5.'</td>
                <td>'.$precio.'</td>
                <td>'.$precio2.'</td>
                <td>'.$precio3.'</td>
                <td>'.$precio4.'</td>
                <td>'.$precio5.'</td>
<td>'.$descuento.'</td>
                <td>'.$seguro.'</td>
<td>'.$seguro2.'</td>
<td>'.$seguro3.'</td>
<td>'.$seguro4.'</td>
<td>'.$seguro5.'</td>
<td>'.$privada.'</td>
<td>'.$telefono.'</td>
								</tr>';		
			?>
        </table>
    </div>
      

</body>
</html>
