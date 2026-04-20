<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Aseguramos que el archivo CSV se maneje con la codificación correcta (UTF-8)
// mb_internal_encoding('UTF-8');

// Paso 1: Cargar y procesar el archivo CSV
if (isset($_POST['submit'])) {
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        $file_name = $_FILES['csv_file']['name'];
        $file_tmp = $_FILES['csv_file']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
        if ($file_ext == 'csv') {
            $upload_dir = 'uploads/';
            $destino = $upload_dir . basename($file_name);

            if (move_uploaded_file($file_tmp, $destino)) {
                echo "El archivo ha sido cargado exitosamente: " . $destino . "<br>";

                // Crear un array para almacenar el CSV actualizado con la clasificación
                $csv_actualizado = [];

                // Leer el archivo CSV
                if (($handle = fopen($destino, "r")) !== FALSE) {
                    echo "<h3>Resultado de la clasificacion de tarjetas:</h3>";
                    echo "<table border='1'>";
                    
                    // Imprimir la cabecera del archivo CSV
                    $headers = fgetcsv($handle, 1000, ",");
                    $headers[] = "Clasificación";  // Añadimos la nueva columna "Clasificación"
                    echo "<tr>";
                    foreach ($headers as $header) {
                        echo "<th>" . htmlspecialchars($header) . "</th>";
                    }
                    echo "</tr>";

                    // Guardar la cabecera en el CSV actualizado
                    $csv_actualizado[] = $headers;

                    // Conectar a la base de datos
                    $conexion = @new mysqli('localhost', 'wwwvideo_root', 'V1de0@cces0s', 'wwwvideo_video_accesos');
                    if ($conexion->connect_error) {
                        die('Error de conexión: ' . $conexion->connect_error);
                    }

                    // Leer cada tarjeta del CSV
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $tarjeta = $data[0];  // Asumiendo que el número de tarjeta está en la primera columna

                        // Limpiar caracteres no numéricos
                        $tarjeta_limpia = preg_replace('/^[^0-9]+/', '', $tarjeta);

                        // Verificar en la base de datos si la tarjeta existe
                        $sql = "SELECT fecha_vencimiento FROM residencias_residentes_tarjetas_detalle WHERE tarjeta_id = '$tarjeta_limpia'";
                        $resultado = $conexion->query($sql);
                        
                        $clasificacion = "Inexistente";  // Valor predeterminado para inexistentes

                        if ($resultado && $resultado->num_rows > 0) {
                            $row = $resultado->fetch_assoc();
                            $fecha_vencimiento = $row['fecha_vencimiento'];
                            
                            // Verificar si está vencida o vigente
                            if (strtotime($fecha_vencimiento) < time()) {
                                $clasificacion = "Vencida";
                            } else {
                                $clasificacion = "Vigente";
                            }
                        }
                        
                        // Añadir la clasificación a la fila
                        $data[] = $clasificacion;

                        // Imprimir la fila en pantalla
                        echo "<tr>";
                        foreach ($data as $campo) {
                            echo "<td>" . htmlspecialchars($campo) . "</td>";
                        }
                        echo "</tr>";

                        // Añadir la fila al CSV actualizado
                        $csv_actualizado[] = $data;
                    }
                    fclose($handle);
                    echo "</table>";

                    // Paso 3: Preguntar si el usuario desea descargar el CSV actualizado
                    // Convertimos el array CSV a un formato serializado para enviarlo en un formulario oculto
                    echo '<form action="descargar_csv.php" method="post">';
                    echo '<input type="hidden" name="csv_data" value="' . htmlspecialchars(serialize($csv_actualizado)) . '">';
                    echo '<input type="submit" name="descargar" value="Descargar CSV con Clasificacion">';
                    echo '</form>';
                }
            } else {
                echo "Hubo un error al mover el archivo.";
            }
        } else {
            echo "Por favor, sube un archivo CSV válido.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="gb18030">
     <!-- Corregir la codificación para evitar caracteres extraños -->
    <title>Cargar archivo CSV</title>
</head>
<body>

    <h2>Cargar archivo CSV</h2>
    <form action="cargar_csv.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecciona el archivo CSV:</label>
        <input type="file" name="csv_file" id="csv_file" accept=".csv">
        <br><br>
        <input type="submit" value="Cargar Archivo" name="submit">
    </form>

</body>
</html>
