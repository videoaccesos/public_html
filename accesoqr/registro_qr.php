<?php
// registro_qr.php - Versión con tabla residenciales

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// ============= FUNCIÓN REORDENAR CÓDIGO =============
function reordenar_codigo($codigo) {
    if (strlen($codigo) != 9) {
        return $codigo;
    }
    
    $reorder_map = [4, 5, 0, 1, 6, 2, 3, 7, 8];
    $reordenado = '';
    
    for ($i = 0; $i < 9; $i++) {
        $reordenado .= $codigo[$reorder_map[$i]];
    }
    
    return $reordenado;
}

// ============= FUNCIÓN CAPTURAR FRAME HLS =============
function capturar_frame_hls($stream_url, $timeout = 10) {
    $temp_image = '/tmp/frame_' . uniqid() . '.jpg';
    
    $cmd = sprintf(
        'timeout %d ffmpeg -i "%s" -vframes 1 -q:v 2 -f image2 "%s" 2>/dev/null',
        $timeout,
        escapeshellarg($stream_url),
        escapeshellarg($temp_image)
    );
    
    exec($cmd, $output, $return_var);
    
    if ($return_var === 0 && file_exists($temp_image)) {
        $imagen_data = file_get_contents($temp_image);
        unlink($temp_image);
        return $imagen_data;
    }
    
    return null;
}

// ============= FUNCIÓN CAPTURAR IMAGEN SEGÚN MÉTODO =============
function capturar_imagen_residencial($residencial_config) {
    $metodo = $residencial_config['metodo_captura'];
    $timeout = $residencial_config['timeout_captura'] ?? 10;
    
    switch ($metodo) {
        case 'rtsp':
        case 'http':
            // Captura directa de cámara IP
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $residencial_config['url_completa']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            
            if (!empty($residencial_config['usuario_camara'])) {
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
                curl_setopt($ch, CURLOPT_USERPWD, 
                    $residencial_config['usuario_camara'] . ':' . $residencial_config['password_camara']);
            }
            
            $imagen = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                error_log("Error captura directa: " . $error);
                return null;
            }
            
            return $imagen;
            
        case 'hls':
            // Captura de stream HLS
            return capturar_frame_hls($residencial_config['url_completa'], $timeout);
            
        default:
            error_log("Método de captura no soportado: " . $metodo);
            return null;
    }
}

// ============= OBTENER PARÁMETROS =============
$codigo_valor = isset($_GET['codigo']) ? $_GET['codigo'] : '';
$respuesta_valor = isset($_GET['respuesta']) ? $_GET['respuesta'] : '';

// Log de peticiones
$log_entry = date('Y-m-d H:i:s') . " - ";
if (!empty($_SERVER['HTTP_X_FORWARDED_FROM'])) {
    $log_entry .= "Via: " . $_SERVER['HTTP_X_FORWARDED_FROM'] . " - ";
}
$log_entry .= "Codigo: $codigo_valor - Respuesta: $respuesta_valor" . PHP_EOL;
@file_put_contents('/var/log/qr_system/registro_qr_access.log', $log_entry, FILE_APPEND);

// Validar parámetros
if (empty($codigo_valor) || empty($respuesta_valor)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Faltan parámetros obligatorios (codigo y respuesta)."
    ]);
    exit;
}

// ============= CONEXIÓN A BASE DE DATOS =============
$servername = "localhost";
$username = "wwwvideo_qr";
$password = "V1de0acces0s";
$dbname = "wwwvideo_acceso_codigo";

$conexion = @new mysqli($servername, $username, $password, $dbname);

if (!$conexion || $conexion->connect_error) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Error de conexión a la base de datos: " . ($conexion ? $conexion->connect_error : "no se pudo crear conexión.")
    ]);
    exit;
}

$conexion->set_charset("utf8mb4");

// ============= BUSCAR CÓDIGO EN BD =============
$sql_buscar = "SELECT folio, telefono FROM registro_accesos WHERE codigo = ?";
$stmt_buscar = $conexion->prepare($sql_buscar);
if (!$stmt_buscar) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Error preparando consulta SQL: " . $conexion->error
    ]);
    exit;
}

$stmt_buscar->bind_param("s", $codigo_valor);
$stmt_buscar->execute();
$resultado = $stmt_buscar->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $folio = $row['folio'];
    $telefono = $row['telefono'];

    // ============= DETERMINAR RESIDENCIAL Y OBTENER CONFIGURACIÓN =============
    $codigo_reordenado = reordenar_codigo($codigo_valor);
    $residencial_id = (int)substr($codigo_reordenado, 3, 1); // 4° dígito del código reordenado
    
    // Obtener configuración del residencial
    //$sql_residencial = "SELECT * FROM v_residenciales_config WHERE id = ?";
    $sql_residencial = "SELECT * FROM residenciales WHERE id = ?";
    $stmt_residencial = $conexion->prepare($sql_residencial);
    $stmt_residencial->bind_param("i", $residencial_id);
    $stmt_residencial->execute();
    $config_result = $stmt_residencial->get_result();
    
    $imagen_base64 = null;
    $metodo_captura = "";
    
    if ($config_result->num_rows > 0) {
        $residencial_config = $config_result->fetch_assoc();
        $metodo_captura = "Residencial {$residencial_config['nombre']} - {$residencial_config['metodo_captura']}";
        
        // Capturar imagen según configuración
        $imagen = capturar_imagen_residencial($residencial_config);
        $imagen_base64 = ($imagen !== false && $imagen !== null) ? base64_encode($imagen) : null;
        
    } else {
        // Residencial no configurado - usar fallback
        error_log("Residencial $residencial_id no encontrado, usando fallback");
        $metodo_captura = "Fallback HLS (Residencial $residencial_id no configurado)";
        
        // Fallback a HLS por defecto
        $hls_url = "http://localhost:8088/hls/stream.m3u8";
        $imagen = capturar_frame_hls($hls_url);
        $imagen_base64 = ($imagen !== false && $imagen !== null) ? base64_encode($imagen) : null;
    }
    
    // Log del método de captura usado
    @file_put_contents('/var/log/qr_system/registro_qr_captura.log', 
        date('Y-m-d H:i:s') . " - Codigo: $codigo_valor - Residencial: $residencial_id - Método: $metodo_captura - " . 
        ($imagen_base64 ? "OK" : "FALLO") . PHP_EOL, 
        FILE_APPEND
    );

    // ============= ACTUALIZAR REGISTRO =============
    $sql_actualizar = "UPDATE registro_accesos SET fecha_utilizado = NOW(), respuesta = ?, imagen_base64 = ? WHERE folio = ?";
    $stmt_actualizar = $conexion->prepare($sql_actualizar);
    
    if ($stmt_actualizar) {
        $stmt_actualizar->bind_param("ssi", $respuesta_valor, $imagen_base64, $folio);
        
        if ($stmt_actualizar->execute()) {
            // ============= ENVIAR NOTIFICACIÓN A BOTPLUS =============
            if (!empty($telefono) && !empty($imagen_base64)) {
                $botplus_url = "http://localhost:5501/registrar_acceso";

                $data = [
                    "telefono" => $telefono,
                    "respuesta" => $respuesta_valor,
                    "imagen_base64" => $imagen_base64
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $botplus_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                $response = curl_exec($ch);
                
                if(curl_errno($ch)) {
                    error_log("Error notificando a bot: " . curl_error($ch));
                }
                curl_close($ch);
            }

            echo json_encode([
                "status" => "success",
                "codigo" => $codigo_valor,
                "respuesta" => $respuesta_valor,
                "residencial" => $residencial_id,
                "metodo_captura" => $metodo_captura,
                "message" => "Actualización realizada correctamente y notificación enviada."
            ]);
            
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Error al actualizar el registro."
            ]);
        }
        $stmt_actualizar->close();
        
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Error preparando actualización SQL: " . $conexion->error
        ]);
    }

} else {
    http_response_code(404);
    echo json_encode([
        "status" => "error",
        "message" => "Código no encontrado."
    ]);
}

$stmt_buscar->close();
$conexion->close();
?>
