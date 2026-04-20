<?php
if (isset($_POST['descargar'])) {
    $csv_data = json_decode($_POST['csv_data'], true);

    // Crear un archivo CSV para descargar
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="tarjetas_clasificadas.csv"');

    $output = fopen("php://output", "w");
    foreach ($csv_data as $fila) {
        fputcsv($output, $fila);
    }
    fclose($output);
}
?>
