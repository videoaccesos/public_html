<?php 
  $host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";

  $databaseName = "wwwvideo_video_accesos";
  $usuario=$_POST['usuario'];
  $array = array();
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  $empleadoQuery= mysql_query("SELECT empleado_id FROM usuarios WHERE usuario='$usuario'");
  while($empleado= mysql_fetch_array($empleadoQuery)){
  $empleadoID = $empleado['empleado_id'];
  }

  $puestoQuery= mysql_query("SELECT puesto_id FROM empleados WHERE empleado_id = $empleadoID");
  while($puesto= mysql_fetch_array($puestoQuery)){
  $puestoID = $puesto['puesto_id'];
  }

  $totalTurnosQuery= mysql_query("SELECT COUNT( * ) AS total_turnos FROM turnos WHERE puesto_id =$puestoID");
  while($contadorTurnos= mysql_fetch_array($totalTurnosQuery)){
  $totalTurnos = $contadorTurnos['total_turnos'];
  array_push($array,$totalTurnos); //Total de turnos en la posición 0.
  }

  $turnoQuery= mysql_query("SELECT turno_id, descripcion FROM turnos WHERE puesto_id = $puestoID");
  while($turno= mysql_fetch_array($turnoQuery)){
  $turnoID = $turno['turno_id'];
  $nombreTurno = $turno['descripcion'];
  array_push($array,$turnoID); //Comienza en la posición 1
  array_push($array,$nombreTurno); //Siguiente posición
  }

  echo json_encode($array);

?>