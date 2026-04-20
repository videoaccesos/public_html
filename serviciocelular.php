<?php
// Definimos las credenciales para la conexión con la base de datos.
$server     = 'localhost'; 
$username   = 'wwwvideo_root'; 
$password   = 'V1de0@cces0s'; 
$database   = 'wwwvideo_video_accesos'; 

// Recogemos valores enviados desde un formulario vía POST, que servirán como filtros para el reporte.
$fechaInicial = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];
$privada = $_POST['cmbPrivadas'];
$tecnico = $_POST['cmbTecnicos'];
$estatus = $_POST['cmbEstatus'];
$fechaLevanto = $_POST['chkFechaLevanto'];
$fechaResolvio = $_POST['chkFechaResolvio'];

// Inicializamos valores por defecto para las fechas. Si no se selecciona ninguna opción, se tomará la fecha de levantamiento.
if ($fechaLevanto==0 && $fechaResolvio ==0) {
    $fechaLevanto = 1;
}

// Dependiendo de las fechas seleccionadas, establecemos las variables correspondientes.
$fechaResuelto = $fechaResolvio == 1 ? 'OS.fecha_modificacion' : '';
$fechaLevantado = $fechaLevanto == 1 ? 'OS.fecha' : '';

// Establecemos filtros basados en la elección de 'privada' del formulario.
$consultaPrivada = $privada != 0 ? ' and OS.privada_id ='.$privada : '';

// Si se elige un estatus, establecemos un filtro adicional.
$consultaEstatus = $estatus != 0 ? ' and OS.estatus_id='.$estatus : '';

// Conectamos con la base de datos.
$conexion = new mysqli($server, $username, $password, $database);

// Si hay un error en la conexión, lo mostramos.
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Consulta para obtener una lista de 'privadas' activas.
$sql = "SELECT * from privadas where estatus_id=1";
$result = $conexion->query($sql);

// Creamos un dropdown para las 'privadas' si hay resultados.
if ($result->num_rows > 0) {
    $combobit = "";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $combobit .= " <option value='".$row['privada_id']."'>".$row['descripcion']."</option>";
    }
} else {
    echo "No hubo resultados";
}

// Consulta para obtener una lista de técnicos.
$sql2 = "SELECT * from usuarios_tecnicos";
$result2 = $conexion->query($sql2);

// Creamos un dropdown para los técnicos si hay resultados.
if ($result2->num_rows > 0) {
    $combobit2 = "";
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
        $combobit2 .= " <option value='".$row2['tecnico_id']."'>".$row2['usuario']."</option>";
    }
} else {
    echo "No hubo resultados";
}

// Aquí iría tu consulta para obtener las órdenes de servicio basadas en los filtros.
// Por ahora, solo he colocado placeholders para ilustrar. Deberás reemplazarlo con tu consulta real.
if ($fechaLevanto == 1) {
    $query = "SELECT ... WHERE ...";  // reemplaza con tu consulta basada en fecha de levantamiento
    $resultado = $conexion->query($query);
}
if ($fechaResolvio == 1) {
    $query = "SELECT ... WHERE ...";  // reemplaza con tu consulta basada en fecha de resolución
    $resultado = $conexion->query($query);
}

// Cerramos la conexión a la base de datos.
$conexion->close();
?>