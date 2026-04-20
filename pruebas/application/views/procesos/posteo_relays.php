    <?php
    $url = $_POST['url'];
    //abrimos la conexion
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // //Si lo deseamos podemos recuperar la salida de la ejecución de la URL
    $resultado = curl_exec($ch);
    // //cerrar conexión
    // //echo "El relay ha sido activado exitosamente"
    //echo $resultado;
    if ($resultado===FALSE){
        echo "Hay un problema con la tarjeta de relays!";
    }else{

        echo "El relay ha sido activado exitosamente!";
    }
        
    //cerramos la conexion
    curl_close($ch); 
    ?>