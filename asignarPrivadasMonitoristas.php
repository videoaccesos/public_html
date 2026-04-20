<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
$conexion = @new mysqli($server, $username, $password, $database);

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi車n: ' . $conexion->connect_error); //si hay un error termina la aplicaci車n y mostramos el error
}

$sql2="SELECT u.usuario_id from usuarios as u INNER JOIN empleados as e on u.empleado_id = e.empleado_id where u.logueado=1 and e.puesto_id=1";
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
 
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
$array2 = array();
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
    {
array_push($array2,$row2["usuario_id"]);
    }
//var_dump($array2);
}

$sql3="SELECT privada_id from privadas where monitoreo=1";
$result3 = $conexion->query($sql3); //usamos la conexion para dar un resultado a la variable
 
if ($result3->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
$array3 = array();
    while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) 
    {
array_push($array3,$row3["privada_id"]);
    }
//var_dump($array3);
}
$fecha= date("Y-m-d H:i:s");
$contadorPrivadas= count($array3);
$contadorMonitoristas= count($array2);
$posPersona = 0;
        for ($i = 0; $i < $contadorPrivadas; $i++) {
$sql4="INSERT INTO revisar_privadas VALUES(NULL,$array3[$i],$array2[$posPersona],CURRENT_TIMESTAMP,NULL,'',1)";
$result4 = $conexion->query($sql4);
            $posPersona++;
            if ($posPersona == $contadorMonitoristas) {
                $posPersona = 0;
            }
        }
$conexion->close(); //cerramos la conexion
?>
