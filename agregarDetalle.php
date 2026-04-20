<?php 
  $host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";

  $databaseName = "wwwvideo_video_accesos";
  $usuario=$_POST['usuario'];
  $array = array();
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  $detalleQuery= mysql_query("SELECT RRT.asignacion_id, RRT.tarjeta_id, T.lectura, RRT.numero_serie, RRT.utilizo_seguro, T.tipo_id, R.privada_id FROM residencias_residentes_tarjetas_no_renovacion as RRT INNER JOIN tarjetas as T on T.tarjeta_id = RRT.tarjeta_id INNER JOIN residencias_residentes as RR on RR.residente_id = RRT.residente_id INNER JOIN residencias as R on R.residencia_id = RR.residencia_id INNER JOIN privadas as P on P.privada_id = R.privada_id ORDER BY RRT.asignacion_id");
  while($datosDetalle= mysql_fetch_array($detalleQuery))
  {
    $asignacionID = $datosDetalle['asignacion_id'];
    $lectura = $datosDetalle['lectura'];
    $numeroSerie = $datosDetalle['numero_serie'];
    $seguro = $datosDetalle['utilizo_seguro'];
    $tipoTarjeta = $datosDetalle['tipo_id'];
    $privadaID = $datosDetalle['privada_id']; 

    if($tipoTarjeta == 1)
    {
      $costoQuery= mysql_query("SELECT precio_peatonal FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_peatonal'];
      }
    }

    if($tipoTarjeta == 2)
    {
      $costoQuery= mysql_query("SELECT precio_vehicular FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_vehicular'];
      }
    }
    $insertarDetalle= mysql_query("INSERT INTO residencias_residentes_tarjetas_detalle_no VALUES (NULL,$asignacionID,'$lectura','$numeroSerie',$seguro,$costo)");
  }

  $detalleQuery= mysql_query("SELECT RRT.asignacion_id, RRT.tarjeta_id2, T.lectura, RRT.numero_serie2, RRT.utilizo_seguro2, T.tipo_id, R.privada_id FROM residencias_residentes_tarjetas_no_renovacion as RRT INNER JOIN tarjetas as T on T.tarjeta_id = RRT.tarjeta_id2 INNER JOIN residencias_residentes as RR on RR.residente_id = RRT.residente_id INNER JOIN residencias as R on R.residencia_id = RR.residencia_id INNER JOIN privadas as P on P.privada_id = R.privada_id ORDER BY RRT.asignacion_id");
  while($datosDetalle= mysql_fetch_array($detalleQuery))
  {
    $asignacionID = $datosDetalle['asignacion_id'];
    $lectura = $datosDetalle['lectura'];
    $numeroSerie = $datosDetalle['numero_serie2'];
    $seguro = $datosDetalle['utilizo_seguro2'];
    $tipoTarjeta = $datosDetalle['tipo_id'];
    $privadaID = $datosDetalle['privada_id']; 

    if($tipoTarjeta == 1)
    {
      $costoQuery= mysql_query("SELECT precio_peatonal FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_peatonal'];
      }
    }

    if($tipoTarjeta == 2)
    {
      $costoQuery= mysql_query("SELECT precio_vehicular FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_vehicular'];
      }
    }
    $insertarDetalle= mysql_query("INSERT INTO residencias_residentes_tarjetas_detalle_no VALUES (NULL,$asignacionID,'$lectura','$numeroSerie',$seguro,$costo)");
  }

  $detalleQuery= mysql_query("SELECT RRT.asignacion_id, RRT.tarjeta_id3, T.lectura, RRT.numero_serie3, RRT.utilizo_seguro3, T.tipo_id, R.privada_id FROM residencias_residentes_tarjetas_no_renovacion as RRT INNER JOIN tarjetas as T on T.tarjeta_id = RRT.tarjeta_id3 INNER JOIN residencias_residentes as RR on RR.residente_id = RRT.residente_id INNER JOIN residencias as R on R.residencia_id = RR.residencia_id INNER JOIN privadas as P on P.privada_id = R.privada_id ORDER BY RRT.asignacion_id");
  while($datosDetalle= mysql_fetch_array($detalleQuery))
  {
    $asignacionID = $datosDetalle['asignacion_id'];
    $lectura = $datosDetalle['lectura'];
    $numeroSerie = $datosDetalle['numero_serie3'];
    $seguro = $datosDetalle['utilizo_seguro3'];
    $tipoTarjeta = $datosDetalle['tipo_id'];
    $privadaID = $datosDetalle['privada_id']; 

    if($tipoTarjeta == 1)
    {
      $costoQuery= mysql_query("SELECT precio_peatonal FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_peatonal'];
      }
    }

    if($tipoTarjeta == 2)
    {
      $costoQuery= mysql_query("SELECT precio_vehicular FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_vehicular'];
      }
    }
    $insertarDetalle= mysql_query("INSERT INTO residencias_residentes_tarjetas_detalle_no VALUES (NULL,$asignacionID,'$lectura','$numeroSerie',$seguro,$costo)");
  }

  $detalleQuery= mysql_query("SELECT RRT.asignacion_id, RRT.tarjeta_id4, T.lectura, RRT.numero_serie4, RRT.utilizo_seguro4, T.tipo_id, R.privada_id FROM residencias_residentes_tarjetas_no_renovacion as RRT INNER JOIN tarjetas as T on T.tarjeta_id = RRT.tarjeta_id4 INNER JOIN residencias_residentes as RR on RR.residente_id = RRT.residente_id INNER JOIN residencias as R on R.residencia_id = RR.residencia_id INNER JOIN privadas as P on P.privada_id = R.privada_id ORDER BY RRT.asignacion_id");
  while($datosDetalle= mysql_fetch_array($detalleQuery))
  {
    $asignacionID = $datosDetalle['asignacion_id'];
    $lectura = $datosDetalle['lectura'];
    $numeroSerie = $datosDetalle['numero_serie4'];
    $seguro = $datosDetalle['utilizo_seguro4'];
    $tipoTarjeta = $datosDetalle['tipo_id'];
    $privadaID = $datosDetalle['privada_id']; 

    if($tipoTarjeta == 1)
    {
      $costoQuery= mysql_query("SELECT precio_peatonal FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_peatonal'];
      }
    }

    if($tipoTarjeta == 2)
    {
      $costoQuery= mysql_query("SELECT precio_vehicular FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_vehicular'];
      }
    }
    $insertarDetalle= mysql_query("INSERT INTO residencias_residentes_tarjetas_detalle_no VALUES (NULL,$asignacionID,'$lectura','$numeroSerie',$seguro,$costo)");
  }

  $detalleQuery= mysql_query("SELECT RRT.asignacion_id, RRT.tarjeta_id5, T.lectura, RRT.numero_serie5, RRT.utilizo_seguro5, T.tipo_id, R.privada_id FROM residencias_residentes_tarjetas_no_renovacion as RRT INNER JOIN tarjetas as T on T.tarjeta_id = RRT.tarjeta_id5 INNER JOIN residencias_residentes as RR on RR.residente_id = RRT.residente_id INNER JOIN residencias as R on R.residencia_id = RR.residencia_id INNER JOIN privadas as P on P.privada_id = R.privada_id ORDER BY RRT.asignacion_id");
  while($datosDetalle= mysql_fetch_array($detalleQuery))
  {
    $asignacionID = $datosDetalle['asignacion_id'];
    $lectura = $datosDetalle['lectura'];
    $numeroSerie = $datosDetalle['numero_serie5'];
    $seguro = $datosDetalle['utilizo_seguro5'];
    $tipoTarjeta = $datosDetalle['tipo_id'];
    $privadaID = $datosDetalle['privada_id']; 

    if($tipoTarjeta == 1)
    {
      $costoQuery= mysql_query("SELECT precio_peatonal FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_peatonal'];
      }
    }

    if($tipoTarjeta == 2)
    {
      $costoQuery= mysql_query("SELECT precio_vehicular FROM privadas where privada_id = $privadaID");
      while($costoDetalle= mysql_fetch_array($costoQuery))
      {
        $costo = $costoDetalle['precio_vehicular'];
      }
    }
    $insertarDetalle= mysql_query("INSERT INTO residencias_residentes_tarjetas_detalle_no VALUES (NULL,$asignacionID,'$lectura','$numeroSerie',$seguro,$costo)");
  }

?>