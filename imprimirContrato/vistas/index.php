<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tienda</title>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../js/jquery.js"></script>
<script src="../js/myjava.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <header>Ejemplo Contrato"</header>
    <section>
    <table border="0" align="center">
    	<tr>
        	<td width="400"><input type="text" placeholder="Busca un producto por: Nombre o Tipo" id="bs-prod"/></td>
            <td width="100"><button id="nuevo-producto" class="btn btn-primary">Nuevo</button></td>
            <td width="200"><a target="_blank" href="productos.php" class="btn btn-danger">Exportar a PDF</a></td>
        </tr>
    </table>
    </section>
    <div class="registros" id="agrega-registros">
    	<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Nombre</th>
                <th width="200">Tipo</th>
                <th width="150">Precio Unitario</th>
                <th width="150">Precio Distribuidor</th>
                <th width="50">Opciones</th>
            </tr>
            <?php 
					include('../php/conexion.php');
					$registro = mysql_query("SELECT * FROM usuarios_tecnicos ORDER BY usuario ASC");
					while($registro2 = mysql_fetch_array($registro)){
						echo '<tr>
								<td>'.$registro2['tecnico_id'].'</td>
								<td>'.$registro2['usuario'].'</td>
								<td>S/. '.$registro2['contrasena'].'</td>
								</tr>';		
					}
			?>
        </table>
    </div>
    
    
    <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita un Producto</b></h4>
            </div>
            <form id="formulario" class="formulario" onsubmit="return modificaRegistro();">
            <div class="modal-body">
				<table border="0" width="100%">
               		 <tr>
                        <td colspan="2"><input type="text" required="required" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/></td>
                    </tr>
                     <tr>
                    	<td width="150">Proceso: </td>
                        <td><input type="text" required="required" readonly="readonly" id="pro" name="pro"/></td>
                    </tr>
                	<tr>
                    	<td>Nombre: </td>
                        <td><input type="text" required="required" name="nombre" id="nombre" maxlength="100"/></td>
                    </tr>
                    <tr>
                    	<td>Tipo: </td>
                        <td><select required="required" name="tipo" id="tipo">
                        		<option value="enlatados">Enlatados</option>
                                <option value="organicos">Organicos</option>
                                <option value="nocomestibles">No Comestibles</option>
                                <option value="otros">Otros</option>
                            </select></td>
                    </tr>
                    <tr>
                    	<td>Precio Unitario: </td>
                        <td><input type="number" required="required" name="precio-uni" id="precio-uni"/></td>
                    </tr>
                    <tr>
                    	<td>Precio Distribuidor: </td>
                        <td><input type="number"  required="required" name="precio-dis" id="precio-dis"/></td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<div id="mensaje"></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
            </div>
            </form>
          </div>
        </div>
      </div>
      

</body>
</html>
