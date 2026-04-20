<?php
// Configuración de la base de datos
$server     = 'localhost'; // servidor
$username   = 'wwwvideo_root'; // usuario de la base de datos
$password   = 'V1de0@cces0s'; // contraseña del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; // nombre de la base de datos

// Establecer conexión con la base de datos
$conexion = @new mysqli($server, $username, $password, $database);

// Verificar si hubo un error al conectar
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error); // Si hay un error, termina la aplicación y muestra el error
}

// Consulta para obtener las privadas con estatus_id igual a 1, ordenadas por descripción
$sql = "SELECT * FROM privadas WHERE estatus_id = 1 ORDER BY descripcion";
$result = $conexion->query($sql); // Ejecutar la consulta y almacenar el resultado en una variable

// Verificar si se encontraron resultados en la consulta
if ($result->num_rows > 0) {
    $combobit = ""; // Inicializar una variable para almacenar opciones de selección HTML
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        // Concatenar opciones de selección HTML utilizando los valores de la consulta
        $combobit .= " <option value='" . $row['privada_id'] . "'>" . $row['descripcion'] . "</option>";
    }
} else {
    echo "No hubo resultados"; // Si no se encontraron resultados, mostrar un mensaje
}

// Consulta para obtener los usuarios vendedoras
$sql2 = "SELECT * FROM usuarios_vendedoras";
$result2 = $conexion->query($sql2); // Ejecutar la consulta y almacenar el resultado en una variable

// Verificar si se encontraron resultados en la consulta
if ($result2->num_rows > 0) {
    $combobit2 = ""; // Inicializar una variable para almacenar opciones de selección HTML
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
        // Concatenar opciones de selección HTML utilizando los valores de la consulta
        $combobit2 .= " <option value='" . $row2['usuario_id'] . "'>" . $row2['nombre'] . "</option>";
    }
} else {
    echo "No hubo resultados"; // Si no se encontraron resultados, mostrar un mensaje
}

// Cerrar la conexión con la base de datos
$conexion->close();
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script src="imprimirContrato/js/jquery.js"></script>
    <script src="imprimirContrato/js/myjava.js"></script>
    <link href="imprimirContrato/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="imprimirContrato/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="imprimirContrato/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
    <link href="imprimirContrato/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="imprimirContrato/bootstrap/js/bootstrap.min.js"></script>
    <script src="imprimirContrato/bootstrap/js/bootstrap.js"></script>

    <title>Reportes de Venta de Tarjetas</title>
    <style>
        /* Estilos CSS aquí */

    </style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
    <form name="consulta_reporte" method="POST" action="reporte_ventas.php" target="_blank">
        <h3 style="text-align:center;color:#0040FF">Reporte de Venta de Tarjetas</h3>
        <a style="color:black;">Fecha Inicial:<a/>
            <input type="date" id="fechaInicial" value="<?php echo date("Y-m-d"); ?>" name="fechaInicial" class="feedback-input">
        <a style="color:black;">Fecha Final:<a/>
            <input type="date" id="fechaFinal" value="<?php echo date("Y-m-d"); ?>" name="fechaFinal" class="feedback-input">
        <a style="color:black;">Privada:<a/>
            <select name="cmbPrivadas" id="cmbPrivadas">
                <option value="0">Todas las Privadas</option>
                <?php echo $combobit; ?> <!-- Mostrar opciones de selección generadas dinámicamente -->
            </select>
        <input type="checkbox" name="chkCombinadas" id="chkCombinadas" checked> Mostrar celdas combinadas <br> <br>
        <input id="login" type="submit" value="Generar Reporte">
    </form>
</div>
</body>

</html>
