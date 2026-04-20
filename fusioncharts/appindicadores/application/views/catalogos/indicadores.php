<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos

$totalTarjetas=0;
$totalVehicularesH=0;
$totalPeatonalesH=0;
$totalVehicularesB=0;
$totalPeatonalesB=0;
$totalVehiculares=0;
$totalPeatonales=0;
$fechaActual= date('Y-m-d');
$totalEfectivo=0;
$totalBancos=0;
$totalEfectivoGastos=0;
$totalBancosGastos=0;
$totalGastosFijos=0;
$totalGastosVariables=0;
$totalGeneralFolios=0;
$diaActual= date('d');
$mesActual= date('m');
$anoActual= date('Y');

$mesMetaGastos =0;
$totalMetaGastosProgramado =0;
$totalMetaGastos =0;
$porcentajeGastos=0;

$mesMetaGastosVariables =0;
$totalMetaGastosVariablesProgramado =0;
$totalMetaGastosVariables =0;
$porcentajeGastosVariables=0;

$mesMetaCobranza =0;
$totalMetaCobranzaProgramado =0;
$totalMetaCobranza =0;
$porcentajeCobranza=0;

$mesMetaTarjetas =0;
$totalMetaTarjetasProgramado =0;
$totalMetaTarjetasH=0;
$totalMetaTarjetasB=0;
$totalMetaTarjetasGeneral=0;
$porcentajeTarjetas=0;

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$contadorPeatonalesH="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha_modificacion LIKE '%".$fechaActual."%' AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesH = $conexion->query($contadorPeatonalesH);
while($rowContadorPeatonalesH=$resultadoContadorPeatonalesH->fetch_assoc()){
$totalPeatonalesH = $rowContadorPeatonalesH['COUNT(*)'];
}

$contadorVehicularesH="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha_modificacion LIKE '%".$fechaActual."%' AND T.tipo_id = 2" ;
$resultadoContadorVehicularesH = $conexion->query($contadorVehicularesH);
while($rowContadorVehicularesH=$resultadoContadorVehicularesH->fetch_assoc()){
$totalVehicularesH = $rowContadorVehicularesH['COUNT(*)'];
}

$contadorPeatonalesB="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha_modificacion LIKE '%".$fechaActual."%' AND T.tipo_id = 1" ;
$resultadoContadorPeatonalesB = $conexion->query($contadorPeatonalesB);
while($rowContadorPeatonalesB=$resultadoContadorPeatonalesB->fetch_assoc()){
$totalPeatonalesB = $rowContadorPeatonalesB['COUNT(*)'];
}

$contadorVehicularesB="SELECT COUNT(*) FROM residencias_residentes_tarjetas_detalle_no AS RRTD INNER JOIN tarjetas AS T ON RRTD.lectura = T.lectura INNER JOIN residencias_residentes_tarjetas_no_renovacion as RRT on RRTD.asignacion_id = RRT.asignacion_id where RRT.fecha_modificacion LIKE '%".$fechaActual."%' AND T.tipo_id = 2" ;
$resultadoContadorVehicularesB = $conexion->query($contadorVehicularesB);
while($rowContadorVehicularesB=$resultadoContadorVehicularesB->fetch_assoc()){
$totalVehicularesB = $rowContadorVehicularesB['COUNT(*)'];
}

$totalPeatonales = $totalPeatonalesH + $totalPeatonalesB;
$totalVehiculares = $totalVehicularesH + $totalVehicularesB;
$totalTarjetas = $totalPeatonales+$totalVehiculares;

$sumaEfectivoH="SELECT  SUM( precio ) as efectivo_h FROM residencias_residentes_tarjetas WHERE fecha_modificacion LIKE  '%".$fechaActual."%' and tipo_pago = 1 " ;
$resultadoSumaEfectivoH = $conexion->query($sumaEfectivoH);
while($rowSumaEfectivoH=$resultadoSumaEfectivoH->fetch_assoc()){
$efectivoH = $rowSumaEfectivoH['efectivo_h'];
  if ($efectivoH == NULL)
  {
    $efectivoH = 0;
  }
}

$sumaBancosH="SELECT SUM( precio ) as bancos_h FROM residencias_residentes_tarjetas WHERE fecha_modificacion LIKE  '%".$fechaActual."%' and tipo_pago = 2 " ;
$resultadoSumaBancosH = $conexion->query($sumaBancosH);
while($rowSumaBancosH=$resultadoSumaBancosH->fetch_assoc()){
$bancosH = $rowSumaBancosH['bancos_h'];
  if ($bancosH == NULL)
  {
    $bancosH = 0;
  }
}

$sumaEfectivoB="SELECT SUM(precio) as efectivo_b FROM residencias_residentes_tarjetas_no_renovacion WHERE fecha_modificacion LIKE  '%".$fechaActual."%' and tipo_pago = 1 " ;
$resultadoSumaEfectivoB = $conexion->query($sumaEfectivoB);
while($rowSumaEfectivoB=$resultadoSumaEfectivoB->fetch_assoc()){
$efectivoB = $rowSumaEfectivoB['efectivo_b'];
  if ($efectivoB == NULL)
  {
    $efectivoB = 0;
  }
}

$sumaBancosB="SELECT SUM(precio) as bancos_b FROM residencias_residentes_tarjetas_no_renovacion WHERE fecha_modificacion LIKE  '%".$fechaActual."%' and tipo_pago = 2 " ;
$resultadoSumaBancosB = $conexion->query($sumaBancosB);
while($rowSumaBancosB=$resultadoSumaBancosB->fetch_assoc()){
$bancosB = $rowSumaBancosB['bancos_b'];
  if ($bancosB == NULL)
  {
    $bancosB = 0;
  }
}

$sumaEfectivoA="SELECT SUM(total) as efectivo_a FROM folios_mensualidades WHERE fecha LIKE  '%".$fechaActual."%' and tipo_pago = 1" ;
$resultadoSumaEfectivoA = $conexion->query($sumaEfectivoA);
while($rowSumaEfectivoA=$resultadoSumaEfectivoA->fetch_assoc()){
$efectivoA = $rowSumaEfectivoA['efectivo_a'];
  if ($efectivoA == NULL)
  {
    $efectivoA = 0;
  }
}

$sumaBancosA="SELECT SUM(total) as bancos_a FROM folios_mensualidades WHERE fecha LIKE  '%".$fechaActual."%' and tipo_pago = 2" ;
$resultadoSumaBancosA = $conexion->query($sumaBancosA);
while($rowSumaBancosA=$resultadoSumaBancosA->fetch_assoc()){
$bancosA = $rowSumaBancosA['bancos_a'];
  if ($bancosA == NULL)
  {
    $bancosA = 0;
  }
}

$sumaGastosHoy="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id WHERE G.fecha LIKE '%".$fechaActual."%' " ;
$resultadoSumaGastosHoy = $conexion->query($sumaGastosHoy);
while($rowSumaGastosHoy=$resultadoSumaGastosHoy->fetch_assoc()){
$gastosHoy = $rowSumaGastosHoy['total'];
  if ($gastosHoy == NULL)
  {
    $gastosHoy = 0;
  }
}

$sumaGastosGeneral="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id WHERE G.fecha_pago LIKE '%".$fechaActual."%' " ;
$resultadoSumaGastosGeneral = $conexion->query($sumaGastosGeneral);
while($rowSumaGastosGeneral=$resultadoSumaGastosGeneral->fetch_assoc()){
$gastosGeneral = $rowSumaGastosGeneral['total'];
  if ($gastosGeneral == NULL)
  {
    $gastosGeneral = 0;
  }
}

$sumaGastosFijos="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id WHERE TG.tipo_gasto = 1 AND G.fecha_pago LIKE '%".$fechaActual."%'" ;
$resultadoSumaGastosFijos = $conexion->query($sumaGastosFijos);
while($rowSumaGastosFijos=$resultadoSumaGastosFijos->fetch_assoc()){
$gastosFijos = $rowSumaGastosFijos['total'];
  if ($gastosFijos == NULL)
  {
    $gastosFijos = 0;
  }
}

$sumaGastosVariables="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id WHERE TG.tipo_gasto = 2 AND G.fecha_pago LIKE '%".$fechaActual."%'" ;
$resultadoSumaGastosVariables = $conexion->query($sumaGastosVariables);
while($rowSumaGastosVariables=$resultadoSumaGastosVariables->fetch_assoc()){
$gastosVariables = $rowSumaGastosVariables['total'];
  if ($gastosVariables == NULL)
  {
    $gastosVariables = 0;
  }
}

$sumaGastosEfectivo="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id WHERE G.tipo_pago = 1 AND G.fecha_pago LIKE '%".$fechaActual."%'" ;
$resultadoSumaGastosEfectivo = $conexion->query($sumaGastosEfectivo);
while($rowSumaGastosEfectivo=$resultadoSumaGastosEfectivo->fetch_assoc()){
$gastosEfectivo = $rowSumaGastosEfectivo['total'];
  if ($gastosEfectivo == NULL)
  {
    $gastosEfectivo = 0;
  }
}

$sumaGastosBancos="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id WHERE G.tipo_pago = 2 AND G.fecha_pago LIKE '%".$fechaActual."%'" ;
$resultadoSumaGastosBancos = $conexion->query($sumaGastosBancos);
while($rowSumaGastosBancos=$resultadoSumaGastosBancos->fetch_assoc()){
$gastosBancos = $rowSumaGastosBancos['total'];
  if ($gastosBancos == NULL)
  {
    $gastosBancos = 0;
  }
}

//METAS

$metaGastos="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 1 AND M.mes = $mesActual";
$resultadoTotalMetaGastos = $conexion->query($metaGastos);

while($rowTotalMetaGastos=$resultadoTotalMetaGastos->fetch_assoc()){ 
$totalMetaGastosProgramado = $rowTotalMetaGastos['meta'];
$mesMetaGastos = $rowTotalMetaGastos['mesNombre'];
}

$queryMetaGastos="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id INNER JOIN usuarios as U on G.usuario_id = U.usuario_id INNER JOIN privadas as P on G.privada_id = P.privada_id WHERE TG.tipo_gasto = 1 AND G.fecha_pago LIKE '%".$anoActual.'-'.$mesActual."%' ";
$resultadoMetaGastos = $conexion->query($queryMetaGastos);

while($rowMetaGastos=$resultadoMetaGastos->fetch_assoc()){ 
$totalMetaGastos = $rowMetaGastos['total'];
}

$metaGastosVariables="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 4 AND M.mes = $mesActual";
$resultadoTotalMetaGastosVariables = $conexion->query($metaGastosVariables);

while($rowTotalMetaGastosVariables=$resultadoTotalMetaGastosVariables->fetch_assoc()){ 
$totalMetaGastosVariablesProgramado = $rowTotalMetaGastosVariables['meta'];
$mesMetaGastosVariables = $rowTotalMetaGastosVariables['mesNombre'];
}

$queryMetaGastosVariables="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id INNER JOIN usuarios as U on G.usuario_id = U.usuario_id INNER JOIN privadas as P on G.privada_id = P.privada_id WHERE TG.tipo_gasto = 2 AND G.fecha_pago LIKE '%".$anoActual.'-'.$mesActual."%' ";
$resultadoMetaGastosVariables = $conexion->query($queryMetaGastosVariables);

while($rowMetaGastosVariables=$resultadoMetaGastosVariables->fetch_assoc()){ 
$totalMetaGastosVariables = $rowMetaGastosVariables['total'];
}


$metaCobranza="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 2 AND M.mes = $mesActual";
$resultadoTotalMetaCobranza = $conexion->query($metaCobranza);

while($rowTotalMetaCobranza=$resultadoTotalMetaCobranza->fetch_assoc()){ 
$totalMetaCobranzaProgramado = $rowTotalMetaCobranza['meta'];
$mesMetaCobranza = $rowTotalMetaCobranza['mesNombre'];
}


$queryMetaCobranza="SELECT SUM(total) as total FROM folios_mensualidades WHERE estatus = 1 AND fecha LIKE '%".$anoActual.'-'.$mesActual."%' ";
$resultadoMetaCobranza = $conexion->query($queryMetaCobranza);

while($rowMetaCobranza=$resultadoMetaCobranza->fetch_assoc()){ 
$totalMetaCobranza = $rowMetaCobranza['total'];
}

$metaTarjetas="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 5 AND M.mes = $mesActual";
$resultadoTotalMetaTarjetas = $conexion->query($metaTarjetas);

while($rowTotalMetaTarjetas=$resultadoTotalMetaTarjetas->fetch_assoc()){ 
$totalMetaTarjetasProgramado = $rowTotalMetaTarjetas['meta'];
$mesMetaTarjetas = $rowTotalMetaTarjetas['mesNombre'];
}

$queryMetaTarjetasH="SELECT SUM(precio) as total FROM residencias_residentes_tarjetas WHERE estatus_id = 1 AND fecha_modificacion LIKE '%".$anoActual.'-'.$mesActual."%' ";
$resultadoMetaTarjetasH = $conexion->query($queryMetaTarjetasH);

while($rowMetaTarjetasH=$resultadoMetaTarjetasH->fetch_assoc()){ 
$totalMetaTarjetasH = $rowMetaTarjetasH['total'];
}

$queryMetaTarjetasB="SELECT SUM(precio) as total FROM residencias_residentes_tarjetas_no_renovacion WHERE estatus_id = 1 AND fecha_modificacion LIKE '%".$anoActual.'-'.$mesActual."%' ";
$resultadoMetaTarjetasB = $conexion->query($queryMetaTarjetasB);

while($rowMetaTarjetasB=$resultadoMetaTarjetasB->fetch_assoc()){ 
$totalMetaTarjetasB = $rowMetaTarjetasB['total'];
}

$totalEfectivo = $efectivoH + $efectivoB + $efectivoA;
$totalBancos = $bancosH + $bancosB + $bancosA;
$totalGeneralEfectivo = $totalEfectivo - $gastosEfectivo;
$totalGeneralBancos = $totalBancos - $gastosBancos;
$totalGeneralFolios = $totalEfectivo+$totalBancos;
$totalGeneralTodo = ($totalEfectivo+$totalBancos)-$gastosGeneral;

$totalGeneralEfectivo = number_format($totalGeneralEfectivo, 2, '.', '');
$totalGeneralBancos = number_format($totalGeneralBancos, 2, '.', '');
$totalGeneralTodo = number_format($totalGeneralTodo, 2, '.', '');
$totalEfectivo = number_format($totalEfectivo, 2, '.', '');
$totalBancos = number_format($totalBancos, 2, '.', '');
$totalGeneralFolios = number_format($totalGeneralFolios, 2, '.', '');

$gastosFijos = number_format($gastosFijos, 2, '.', '');
$gastosVariables = number_format($gastosVariables, 2, '.', '');
$gastosEfectivo = number_format($gastosEfectivo, 2, '.', '');
$gastosBancos = number_format($gastosBancos, 2, '.', '');
$gastosGeneral = number_format($gastosGeneral, 2, '.', '');
$gastosHoy = number_format($gastosHoy, 2, '.', '');

$totalMetaGastosProgramado = number_format($totalMetaGastosProgramado, 2, '.', '');
$totalMetaGastos = number_format($totalMetaGastos, 2, '.', '');
$porcentajeGastos = ($totalMetaGastos * 100)/$totalMetaGastosProgramado;
$porcentajeGastos = round($porcentajeGastos);

$totalMetaGastosVariablesProgramado = number_format($totalMetaGastosVariablesProgramado, 2, '.', '');
$totalMetaGastosVariables = number_format($totalMetaGastosVariables, 2, '.', '');
$porcentajeGastosVariables = ($totalMetaGastosVariables * 100)/$totalMetaGastosVariablesProgramado;
$porcentajeGastosVariables = round($porcentajeGastosVariables);

$totalMetaCobranzaProgramado = number_format($totalMetaCobranzaProgramado, 2, '.', '');
$totalMetaCobranza = number_format($totalMetaCobranza, 2, '.', '');
$porcentajeCobranza = ($totalMetaCobranza * 100)/$totalMetaCobranzaProgramado;
$porcentajeCobranza = round($porcentajeCobranza);

$totalMetaTarjetasProgramado = number_format($totalMetaTarjetasProgramado, 2, '.', '');
$totalMetaTarjetasH = number_format($totalMetaTarjetasH, 2, '.', '');
$totalMetaTarjetasB = number_format($totalMetaTarjetasB, 2, '.', '');
$totalMetaTarjetasGeneral = $totalMetaTarjetasH + $totalMetaTarjetasB;
$totalMetaTarjetasGeneral = number_format($totalMetaTarjetasGeneral, 2, '.', '');
$porcentajeTarjetas = ($totalMetaTarjetasGeneral * 100)/$totalMetaTarjetasProgramado;
$porcentajeTarjetas = round($porcentajeTarjetas);

$conexion->close(); //cerramos la conexi贸n
?>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <div class="btn-group" style="display:inline-block;float:right;">
        <button class="btn btn-inverse" tabindex="-2" onclick="printDiv('wellContenido')">
          <i class="icon-print icon-white"></i> Imprimir
        </button> 
  </div>
  <br>
      <table class="table table-stripped" id="dgMonitoristas">
    <h3>Monitoristas</h3>
    <thead>
      <tr>
       <th style="width:2px;"></th>
       <th style="text-align:center;" width="60px">Nombre</th>
       <th style="text-align:center;" width="40px">&Uacute;ltima Llamada</th>
       <th style="text-align:center;" width="40px">Llamadas 01-15 Seg.</th>
       <th style="text-align:center;" width="40px">Llamadas 15-30 Seg.</th>
       <th style="text-align:center;" width="40px">Llamadas M&aacute;s 30 Seg.</th>
       <th style="text-align:center;" width="40px">Total Llamadas</th>
       <th style="text-align:center;" width="40px">Total Tiempo</th>
       <th style="text-align:center;" width="40px">Promedio por llamada</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
        <script id="plantilla_monitoristas" type="text/template">
          {{#rows}}
          <tr>
          <td style="background-color: green"></td>
          <td style="text-align:center;">{{nombre}}</td>
          <td style="text-align:center;">{{ultima_sesion}}</td>
          <td style="text-align:center;">{{llamadas115}}</td>
          <td style="text-align:center;">{{llamadas1530}}</td>
          <td style="text-align:center;">{{llamadas30mas}}</td>
          <td style="text-align:center;">{{total_llamadas}}</td>
          <td style="text-align:center;">{{total_minutos}} Min. {{total_segundos}} Seg. </td>   
          <td style="text-align:center;">{{promedio}} Seg.</td>
            </tr>
          {{/rows}}
          {{^rows}}
          <tr> 
            <td colspan="7">No se encontraron resultados</td>
          </tr> 
          {{/rows}}
        </script>
  </table>
  <br>
  <br>
  <br>
  <br>
  <hr color="blue">
  <table class="table table-stripped" id="dgReportes">
  <h3>Reportes Vigentes</h3>
    <thead>
      <tr>
      <th style="text-align:center;" width="60px">Folio</th>
       <th style="text-align:center;" width="60px">Privada</th>
       <th style="text-align:center;" width="40px">Descripci&oacute;n</th>
       <th style="text-align:center;" width="40px">Fecha</th>
       <th style="text-align:center;" width="40px">T&eacute;cnico</th>
       <th style="text-align:center;" width="40px">Tiempo Transcurrido</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
        <script id="plantilla_reportes" type="text/template">
          {{#rows}}
          <tr>
          <td style="text-align:center;">{{folio}}</td>
          <td style="text-align:center;">{{privada}}</td>
          <td style="text-align:center;">{{detalle}}</td>
          <td style="text-align:center;">{{fecha}}</td>
          <td style="text-align:center;">{{tecnico}}</td>
          <td style="text-align:center;">{{tiempo_transcurrido}}</td>
            </tr>
          {{/rows}}
          {{^rows}}
          <tr> 
            <td colspan="7">No se encontraron resultados</td>
          </tr> 
          {{/rows}}
        </script>
  </table>
  <br>
  <br>
  <br>
  <br>
  <hr color="blue">
  <table class="table table-stripped" id="dgTecnicos">
  <h3>T&eacute;cnicos</h3>
    <thead>
      <tr>
       <th style="text-align:center;" width="60px">&Uacute;ltimo Reporte</th>
       <th style="text-align:center;" width="60px">Nombre</th>
       <th style="text-align:center;" width="40px"># Reportes</th>
       <th style="text-align:center;" width="40px">Tiempo Total</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
        <script id="plantilla_tecnicos" type="text/template">
          {{#rows}}
          <tr>
          <td style="text-align:center;">{{ultimo_reporte}}</td>
          <td style="text-align:center;">{{nombre}}</td>
          <td style="text-align:center;">{{total_reportes}}</td>
          <td style="text-align:center;">{{tiempo_acumulado}} Min.</td>
            </tr>
          {{/rows}}
          {{^rows}}
          <tr> 
            <td colspan="7">No se encontraron resultados</td>
          </tr> 
          {{/rows}}
        </script>
  </table>
  <br>
  <br>
  <br>
  <br>
  <table class="table table-stripped" id="dgFinanzas">
  <h3>Ventas</h3>
    <thead>
      <tr>
       <th style="text-align:center;" width="60px">Folios A</th>
       <th style="text-align:center;" width="60px">Folios H</th>
       <th style="text-align:center;" width="60px">Folios B</th>
       <th style="text-align:center;" width="60px">Total General</th>
       <th style="text-align:center;" width="60px">Efectivo</th>
       <th style="text-align:center;" width="60px">Bancos</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
        <script id="plantilla_finanzas" type="text/template">
          {{#rows}}
          <tr>
          <td style="text-align:center;">${{folios_a}}</td>
          <td style="text-align:center;">${{folios_h}}</td>
          <td style="text-align:center;">${{folios_b}}</td>
          <td style="text-align:center;color:black;font-weight:bold;"><?php echo '$'.$totalGeneralFolios ?></td>
          <td style="text-align:center;"><?php echo '$'.$totalEfectivo ?></td>
          <td style="text-align:center;"><?php echo '$'.$totalBancos ?></td>
          </tr>
          {{/rows}}
          {{^rows}}
          <tr> 
            <td colspan="7">No se encontraron resultados</td>
          </tr> 
          {{/rows}}
        </script>
  </table>
  <table class="table table-stripped" id="dgGastos">
  <h3>Gastos</h3>
    <thead>
      <tr>
       <th style="text-align:center;" width="60px">Gastos Fijos</th>
       <th style="text-align:center;" width="60px">Gastos Variables</th>
       <th style="text-align:center;" width="60px">Total General</th>
       <th style="text-align:center;" width="60px">Efectivo</th>
       <th style="text-align:center;" width="60px">Bancos</th>
       <th style="text-align:center;" width="60px"></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
        <script id="plantilla_gastos" type="text/template">
          {{#rows}}
          <tr>
          <td style="text-align:center;"><?php echo '$'.$gastosFijos ?></td>
          <td style="text-align:center;"><?php echo '$'.$gastosVariables ?></td>
          <td style="text-align:center;color:black;font-weight:bold;"><?php echo '$'.$gastosGeneral ?></td>
          <td style="text-align:center;"><?php echo '$'.$gastosEfectivo ?></td>
          <td style="text-align:center;"><?php echo '$'.$gastosBancos ?></td>
          <td style="text-align:center;"></td>
          </tr>
          {{/rows}}
          {{^rows}}
          <tr> 
            <td colspan="7">No se encontraron resultados</td>
          </tr> 
          {{/rows}}
        </script>
  </table>
  <br>
  <div style="dysplay: inline-block;">
    <div id="pagLinks"  style="float:left;margin-right:10px;"></div>
    <div style="float:right;margin-right:10px;"><b><?php echo 'Total Folios: $'.$totalGeneralFolios.' (+)<br>'.'Total Gastos: $'.$gastosGeneral.' (-)<br>'. 'Total General: $'.$totalGeneralTodo.'<br><br>'.'En Efectivo: $'.$totalGeneralEfectivo.'<br>'.'En Bancos: $'.$totalGeneralBancos.'<br><br>'.'Gastos Registrados Hoy: $'.$gastosHoy ?></b></div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <table class="table table-stripped" id="dgMetas">
  <h3>Metas</h3>
    <thead>
      <tr>
       <th style="text-align:center;" width="60px">D&iacute;a Actual</th>
       <th style="text-align:center;" width="60px">Tipo de Meta</th>
       <!--<th style="text-align:center;" width="60px">Mes</th>-->
       <th style="text-align:center;" width="60px">Meta</th>
       <th style="text-align:center;" width="40px">Total</th>
       <th style="text-align:center;" width="40px">Porcentaje</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
        <script id="plantilla_metas" type="text/template">
          {{#rows}}
          <tr>
          <td style="text-align:center;"><?php echo $diaActual ?></td>
          <td style="text-align:center;">GASTOS PROGRAMADOS</td>
          <!--<td style="text-align:center;"><?php echo $mesMetaGastos ?></td>-->
          <td style="text-align:center;"><?php echo '$'.$totalMetaGastosProgramado ?></td>
          <td style="text-align:center;"><?php echo '$'.$totalMetaGastos ?></td>
          <td style="text-align:center;"><?php echo $porcentajeGastos.'%' ?></td>
          </tr>
          <tr>
          <td style="text-align:center;"><?php echo $diaActual ?></td>
          <td style="text-align:center;">GASTOS VARIABLES</td>
          <!--<td style="text-align:center;"><?php echo $mesMetaGastos ?></td>-->
          <td style="text-align:center;"><?php echo '$'.$totalMetaGastosVariablesProgramado ?></td>
          <td style="text-align:center;"><?php echo '$'.$totalMetaGastosVariables ?></td>
          <td style="text-align:center;"><?php echo $porcentajeGastosVariables.'%' ?></td>
          </tr>
          <tr>
          <td style="text-align:center;"><?php echo $diaActual ?></td>
          <td style="text-align:center;">COBRANZA MENSUALIDADES</td>
          <!--<td style="text-align:center;"><?php echo $mesMetaCobranza ?></td>-->
          <td style="text-align:center;"><?php echo '$'.$totalMetaCobranzaProgramado ?></td>
          <td style="text-align:center;"><?php echo '$'.$totalMetaCobranza ?></td>
          <td style="text-align:center;"><?php echo $porcentajeCobranza.'%' ?></td>
          </tr>
          <tr>
          <td style="text-align:center;"><?php echo $diaActual ?></td>
          <td style="text-align:center;">FLUJO TARJETAS</td>
          <!--<td style="text-align:center;"><?php echo $mesMetaCobranza ?></td>-->
          <td style="text-align:center;"><?php echo '$'.$totalMetaTarjetasProgramado ?></td>
          <td style="text-align:center;"><?php echo '$'.$totalMetaTarjetasGeneral ?></td>
          <td style="text-align:center;"><?php echo $porcentajeTarjetas.'%' ?></td>
          </tr>
          {{/rows}}
          {{^rows}}
          <tr> 
            <td colspan="7">No se encontraron resultados</td>
          </tr> 
          {{/rows}}
        </script>
  </table>
<script type="text/javascript">
  var pagina = 0;
  var strUltimaBusqueda= "";
//---------- Funciones para la Busqueda

function paginacionFinanzas(){
    if($('#txtBusqueda').val() != strUltimaBusqueda){
      pagina = 0;
      strUltimaBusqueda = $('#txtBusqueda').val();
    }
      
    $.post('catalogos/indicadores/paginacionFinanzas',
                 {strBusqueda:$('#txtBusqueda').val(), intPagina:pagina},
                  function(data) {
                    $('#dgFinanzas tbody').empty();
                    var temp = Mustache.render($('#plantilla_finanzas').html(),data);
                    $('#dgFinanzas tbody').html(temp);
                    $('#dgGastos tbody').empty();
                    var temp = Mustache.render($('#plantilla_gastos').html(),data);
                    $('#dgGastos tbody').html(temp);
                    $('#dgMetas tbody').empty();
                    var temp = Mustache.render($('#plantilla_metas').html(),data);
                    $('#dgMetas tbody').html(temp);
                    $('#pagLinks').html(data.paginacion);
                    $('#numElementos').html(data.total_rows);
                    pagina = data.pagina;
                  }
                 ,
          'json');
  }


  function paginacionTecnicos(){
    if($('#txtBusqueda').val() != strUltimaBusqueda){
      pagina = 0;
      strUltimaBusqueda = $('#txtBusqueda').val();
    }
      
    $.post('catalogos/indicadores/paginacionTecnicos',
                 {strBusqueda:$('#txtBusqueda').val(), intPagina:pagina},
                  function(data) {
                    $('#dgTecnicos tbody').empty();
                    var temp = Mustache.render($('#plantilla_tecnicos').html(),data);
                    $('#dgTecnicos tbody').html(temp);
                    $('#pagLinks').html(data.paginacion);
                    $('#numElementos').html(data.total_rows);
                    pagina = data.pagina;
                  }
                 ,
          'json');
  }

  function paginacionMonitoristas(){
    if($('#txtBusqueda').val() != strUltimaBusqueda){
      pagina = 0;
      strUltimaBusqueda = $('#txtBusqueda').val();
    }
      
    $.post('catalogos/indicadores/paginacionMonitoristas',
                 {strBusqueda:$('#txtBusqueda').val(), intPagina:pagina},
                  function(data) {
                    $('#dgMonitoristas tbody').empty();
                    var temp = Mustache.render($('#plantilla_monitoristas').html(),data);
                    $('#dgMonitoristas tbody').html(temp);
                    $('#pagLinks').html(data.paginacion);
                    $('#numElementos').html(data.total_rows);
                    pagina = data.pagina;
                  }
                 ,
          'json');
  }

  function paginacionReportes(){
    if($('#txtBusqueda').val() != strUltimaBusqueda){
      pagina = 0;
      strUltimaBusqueda = $('#txtBusqueda').val();
    }
      
    $.post('catalogos/indicadores/paginacionReportes',
                 {strBusqueda:$('#txtBusqueda').val(), intPagina:pagina},
                  function(data) {
                    $('#dgReportes tbody').empty();
                    var temp = Mustache.render($('#plantilla_reportes').html(),data);
                    $('#dgReportes tbody').html(temp);
                    $('#pagLinks').html(data.paginacion);
                    $('#numElementos').html(data.total_rows);
                    pagina = data.pagina;
                  }
                 ,
          'json');
  }

  $( document ).ready(function() {

    setInterval(function(){
    paginacionFinanzas();
    paginacionTecnicos(); 
    paginacionMonitoristas(); 
    paginacionReportes(); 
    }, 30000);

     $('#pagLinks').on('click','a',function(event){
        event.preventDefault();
        pagina = $(this).attr('href').replace('/','');
     });
    paginacionFinanzas(); 
    paginacionTecnicos(); 
    paginacionMonitoristas(); 
    paginacionReportes();
  });

  function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
  }
</script> 

               