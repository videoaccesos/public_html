<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Intenta incluir PHPExcel
try {
    require 'PHPExcel/Classes/PHPExcel.php';
    echo "PHPExcel está instalado y disponible.";
} catch (Exception $e) {
    echo "PHPExcel no está instalado o no se pudo cargar.";
}
?>
