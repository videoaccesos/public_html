<?php
include('conexion.php');

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysql_query("SELECT * FROM productos WHERE nomb_prod LIKE '%$dato%' OR tipo_prod LIKE '%$dato%' ORDER BY id_prod ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Nombre</th>
                <th width="200">Tipo</th>
                <th width="150">Precio Unitario</th>
                <th width="150">Precio Distribuidor</th>
				<th width="50">Opciones</th>
            </tr>';
if(mysql_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['nomb_prod'].'</td>
				<td>'.$registro2['tipo_prod'].'</td>
				<td>S/. '.$registro2['precio_unit'].'</td>
				<td>S/. '.$registro2['precio_dist'].'</td>
				<td><a href="javascript:editarProducto('.$registro2['id_prod'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['id_prod'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="5">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>