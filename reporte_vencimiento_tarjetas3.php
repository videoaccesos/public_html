<?php
// Habilitar el almacenamiento en búfer de salida
ob_start();

// Habilitar la notificación de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Parámetros recibidos a través de la URL
$periodo = isset($_GET['periodo']) ? $_GET['periodo'] : '';
$privada = isset($_GET['privada']) ? $_GET['privada'] : ''; // Captura del parámetro privada
$download = isset($_GET['download']) ? $_GET['download'] : '0';

// Validar el formato del periodo (asumimos YYYY-MM-DD a YYYY-MM-DD)
$periodoArray = explode(' a ', $periodo);
if (count($periodoArray) != 2) {
    die('El formato del periodo debe ser "YYYY-MM-DD a YYYY-MM-DD"');
}
$fechaInicial = $periodoArray[0];
$fechaFinal = $periodoArray[1];

if (!$fechaInicial || !$fechaFinal) {
    die('Faltan parámetros fechaInicial o fechaFinal');
}

// Conexión a la base de datos
$server = 'videoaccesos.net';
$username = 'wwwvideo_root';
$password = 'V1de0@cces0s';
$database = 'wwwvideo_video_accesos';

$conexion = @new mysqli($server, $username, $password, $database);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Consultar las privadas con estatus_id=1
$sql_privadas = "SELECT privada_id, renovacion FROM privadas WHERE estatus_id=1";
if ($privada !== 'todas') {
    $sql_privadas .= " AND descripcion = '$privada'";
}
$resultado_privadas = $conexion->query($sql_privadas);

if (!$resultado_privadas) {
    die('Error en la consulta de privadas: ' . $conexion->error);
}

$privadas_renovacion = [];
$privadas_no_renovacion = [];

// Dividir las privadas según el valor de renovación
while ($row_privada = $resultado_privadas->fetch_assoc()) {
    if ($row_privada['renovacion'] == 1) {
        $privadas_renovacion[] = $row_privada['privada_id'];
    } else {
        $privadas_no_renovacion[] = $row_privada['privada_id'];
    }
}

$reportData = [];
$tarjetas_vistas = []; // Para controlar si una tarjeta es "única" o "duplicada"

// Función para procesar registros
function procesar_registros($sql, $conexion, &$reportData, $renovacion, &$tarjetas_vistas) {
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        die('Error en la consulta: ' . $conexion->error);
    }

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $asignacion_id = $row['asignacion_id'];
            $tarjeta_ids = [
                $row['tarjeta_id'],
                $row['tarjeta_id2'],
                $row['tarjeta_id3'],
                $row['tarjeta_id4'],
                $row['tarjeta_id5']
            ];
            $residente_id = $row['residente_id'];
            $fecha_modificacion = $row['fecha_modificacion'];
            $fecha_vencimiento = $row['fecha_vencimiento'];
            $observaciones = $row['observaciones'];
            $estatus_id = $row['estatus_id'];
            $estatus = ($estatus_id == 0) ? 'Cancelada' : 'Activa';
            $vencimiento_final = DateTime::createFromFormat('Y-m-d', $fecha_vencimiento);
            if ($vencimiento_final !== false) {
                $vencimiento_final = $vencimiento_final->format('d/m/Y');
            } else {
                $vencimiento_final = $fecha_vencimiento;
            }

            // Buscar fecha en observaciones y ajustar vencimiento
            if (preg_match('/\b\d{2}\/\d{2}\/\d{4}\b/', $observaciones, $matches)) {
                $fecha_extraida = DateTime::createFromFormat('d/m/Y', $matches[0]);
                
                if ($fecha_extraida !== false) {
                    // Si se encuentra "FOLIO", se agrega un año a la fecha extraída
                    if (stripos($observaciones, 'FOLIO') !== false) {
                        $fecha_extraida->modify('+1 year');
                        $vencimiento_final = $fecha_extraida->format('d/m/Y');
                    }
                    // Si se encuentra "VENCE" o "CAMBIO", se utiliza la fecha extraída sin modificación
                    elseif (stripos($observaciones, 'VENCE') !== false || stripos($observaciones, 'CAMBIO') !== false) {
                        $vencimiento_final = $fecha_extraida->format('d/m/Y');
                    }
                }
            } elseif (preg_match('/\b(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre)\s+(\d{4})\b/i', $observaciones, $matches)) {
                // Nombre del mes y año encontrados, usar el día 15
                $mes = strtolower($matches[1]);
                $meses = [
                    'enero' => '01', 'febrero' => '02', 'marzo' => '03', 'abril' => '04',
                    'mayo' => '05', 'junio' => '06', 'julio' => '07', 'agosto' => '08',
                    'septiembre' => '09', 'octubre' => '10', 'noviembre' => '11', 'diciembre' => '12'
                ];
                $fecha_extraida = DateTime::createFromFormat('d/m/Y', '15/' . $meses[$mes] . '/' . $matches[2]);
                if ($fecha_extraida !== false) {
                    $vencimiento_final = $fecha_extraida->format('d/m/Y');
                }
            }

            foreach ($tarjeta_ids as $tarjeta_id) {
                if ($tarjeta_id) {
                    $sql_lectura = "SELECT lectura, tipo_id FROM tarjetas WHERE tarjeta_id = '$tarjeta_id'";
                    $resultado_lectura = $conexion->query($sql_lectura);

                    if ($resultado_lectura && $resultado_lectura->num_rows > 0) {
                        $row_lectura = $resultado_lectura->fetch_assoc();
                        $lectura = preg_replace('/\D/', '', $row_lectura['lectura']);
                        $tipo_id = $row_lectura['tipo_id'];
                        $tipo = ($tipo_id == 1) ? 'Peatonal' : 'Vehicular';

                        $detalle_tabla = $renovacion ? 'residencias_residentes_tarjetas_detalle' : 'residencias_residentes_tarjetas_detalle_no';
                        $sql_residente = "SELECT nombre, ape_paterno, ape_materno, residencia_id FROM residencias_residentes WHERE residente_id = '$residente_id'";
                        $resultado_residente = $conexion->query($sql_residente);
                        if ($resultado_residente && $resultado_residente->num_rows > 0) {
                            $row_residente = $resultado_residente->fetch_assoc();
                            $nombre_completo = $row_residente['nombre'] . ' ' . $row_residente['ape_paterno'] . ' ' . $row_residente['ape_materno'];
                            $residencia_id = $row_residente['residencia_id'];

                            $sql_residencia = "SELECT calle, nro_casa, privada_id FROM residencias WHERE residencia_id = '$residencia_id'";
                            $resultado_residencia = $conexion->query($sql_residencia);
                            if ($resultado_residencia && $resultado_residencia->num_rows > 0) {
                                $row_residencia = $resultado_residencia->fetch_assoc();
                                $domicilio = $row_residencia['calle'] . ' ' . $row_residencia['nro_casa'];
                                $privada_id = $row_residencia['privada_id'];

                                $sql_privada = "SELECT descripcion FROM privadas WHERE privada_id = '$privada_id'";
                                $resultado_privada = $conexion->query($sql_privada);
                                if ($resultado_privada && $resultado_privada->num_rows > 0) {
                                    $row_privada = $resultado_privada->fetch_assoc();
                                    $descripcion_privada = $row_privada['descripcion'];

                                    // Verificar si ya se ha mostrado este número de tarjeta
                                    $estado_tarjeta = in_array($lectura, $tarjetas_vistas) ? 'duplicado' : 'único';
                                    if ($estado_tarjeta === 'único') {
                                        $tarjetas_vistas[] = $lectura; // Marcar la tarjeta como vista
                                    }

                                    // Ajustar los datos según el formato solicitado
                                    $reportData[] = [
                                        'id_usuario' => $lectura,       // ID Usuario = Lectura
                                        'nombre' => $domicilio,         // Nombre = Domicilio
                                        'domicilio' => $nombre_completo, // Domicilio = Nombre completo
                                        'numero_tarjeta' => $lectura,    // Número de tarjeta = Lectura
                                        'estado_tarjeta' => $estado_tarjeta, // Estado de la tarjeta (único o duplicado)
                                        'num_departamento' => 20,        // No. de departamento = 20 (fijo)
                                        'departamento' => $descripcion_privada, // Departamento = Privada
                                        'genero' => 'Masculino',         // Género = Masculino (fijo)
                                        'captura' => $fecha_modificacion, // Captura = Fecha de Modificación
                                        'observaciones' => $observaciones, // Observaciones = Observaciones
                                        'vencimiento' => $vencimiento_final // Vencimiento = Fecha ajustada
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

// Consultar y procesar registros para privadas con renovacion=1
if (!empty($privadas_renovacion)) {
    $privadas_renovacion_list = implode(',', $privadas_renovacion);
    $sql_renovacion = "SELECT asignacion_id, tarjeta_id, tarjeta_id2, tarjeta_id3, tarjeta_id4, tarjeta_id5, residente_id, fecha_modificacion, fecha_vencimiento, observaciones, estatus_id
                       FROM residencias_residentes_tarjetas
                       WHERE fecha_modificacion >= '$fechaInicial'
                       AND fecha_modificacion <= '$fechaFinal'
                       AND residente_id IN (
                           SELECT RR.residente_id
                           FROM residencias_residentes AS RR
                           INNER JOIN residencias AS R ON RR.residencia_id = R.residencia_id
                           WHERE R.privada_id IN ($privadas_renovacion_list)
                       )
                       ORDER BY asignacion_id";
    procesar_registros($sql_renovacion, $conexion, $reportData, true, $tarjetas_vistas);
}

// Consultar y procesar registros para privadas con renovacion=0
if (!empty($privadas_no_renovacion)) {
    $privadas_no_renovacion_list = implode(',', $privadas_no_renovacion);
    $sql_no_renovacion = "SELECT asignacion_id, tarjeta_id, tarjeta_id2, tarjeta_id3, tarjeta_id4, tarjeta_id5, residente_id, fecha_modificacion, fecha_vencimiento, observaciones, estatus_id
                          FROM residencias_residentes_tarjetas_no_renovacion
                          WHERE fecha_modificacion >= '$fechaInicial'
                          AND fecha_modificacion <= '$fechaFinal'
                          AND residente_id IN (
                              SELECT RR.residente_id
                              FROM residencias_residentes AS RR
                              INNER JOIN residencias AS R ON RR.residencia_id = R.residencia_id
                              WHERE R.privada_id IN ($privadas_no_renovacion_list)
                          )
                          ORDER BY asignacion_id";
    procesar_registros($sql_no_renovacion, $conexion, $reportData, false, $tarjetas_vistas);
}

// Generar reporte
if (count($reportData) > 0) {
    if ($download) {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="reporte_acceso.csv";');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID Usuario', 'Nombre', 'Domicilio', 'Numero de Tarjeta', 'Estado Tarjeta', 'No. de Departamento', 'Departamento', 'Genero', 'Captura', 'Observaciones', 'Vencimiento'));

        foreach ($reportData as $data) {
            fputcsv($output, $data);
        }

        fclose($output);
    } else {
        echo "<table border='1'>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Domicilio</th>
                    <th>Numero de Tarjeta</th>
                    <th>Estado Tarjeta</th>
                    <th>No. de Departamento</th>
                    <th>Departamento</th>
                    <th>Genero</th>
                    <th>Captura</th>
                    <th>Observaciones</th>
                    <th>Vencimiento</th>
                </tr>";

        foreach ($reportData as $data) {
            echo "<tr>
                    <td>{$data['id_usuario']}</td>
                    <td>{$data['nombre']}</td>
                    <td>{$data['domicilio']}</td>
                    <td>{$data['numero_tarjeta']}</td>
                    <td>{$data['estado_tarjeta']}</td>
                    <td>{$data['num_departamento']}</td>
                    <td>{$data['departamento']}</td>
                    <td>{$data['genero']}</td>
                    <td>{$data['captura']}</td>
                    <td>{$data['observaciones']}</td>
                    <td>{$data['vencimiento']}</td>
                  </tr>";
        }

        echo "</table>";
    }
} else {
    echo "No se encontraron resultados para el periodo especificado.";
}

// Cerrar la conexión
$conexion->close();
?>
