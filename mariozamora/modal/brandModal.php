<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitBrandForm" action="php_action/createBrand.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar solicitud</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-brand-messages"></div>

	        <div class="form-group">
	        	<label for="brandName" class="col-sm-3 control-label">Nombre: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="brandName" placeholder="Nombre del solicitante" name="brandName" autocomplete="off">
				    </div>
	        </div> <!-- Nombre del solicitante/form-group-->	     
	        <div class="form-group">
	        	<label for="telefono" class="col-sm-3 control-label">Telefono: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="telefono" placeholder="Telefono del solicitante" name="telefono" autocomplete="off">
				    </div>
	        </div> <!--Telefono  /form-group-->	
	        <div class="form-group">
	        	<label for="correo" class="col-sm-3 control-label">Correo: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="correo" placeholder="Correo del solicitante" name="correo" autocomplete="off">
				    </div>
	        </div> <!--Correo /form-group-->	

	        <div class="form-group">
	        	<label for="brandStatus" class="col-sm-3 control-label">Municipio: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="brandStatus" name="brandStatus">
				      	<option value="">-- Selecciona --</option>
				      	<option value="Ahome">Ahome</option>
				      	<option value="Angostura">Angostura</option>
				      	<option value="Badiraguato">Badiraguato</option>
				      	<option value="Concordia">Concordia</option>
				      	<option value="Cosala">Cosala</option>
				      	<option value="Culiacan">Culiacan</option>
				      	<option value="Choix">Choix</option>
				      	<option value="Elota">Elota</option>
				      	<option value="Escuinapa">Escuinapa</option>
				      	<option value="El Fuerte">El Fuerte</option>
				      	<option value="Guasave">Guasave</option>
				      	<option value="Mazatlan">Mazatlan</option>
				      	<option value="Mocorito">Mocorito</option>
				      	<option value="El Rosario">El Rosario</option>
				      	<option value="Salvador Alvarado">Salvador Alvarado</option>
				      	<option value="San Ignacio">San Ignacio</option>
				      	<option value="Sinaloa">Sinaloa</option>
				      	<option value="Navolato">Navolato</option>
				      </select>
				    </div>
	        </div> <!--Municipio /form-group-->	         	        
	        <div class="form-group">
	        	<label for="peticion" class="col-sm-3 control-label">Petición: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="peticion" placeholder="Petición del solicitante" name="peticion" autocomplete="off">
				    </div>
	        </div> <!--Peticion /form-group-->
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Cargando..." autocomplete="off">Guardar cambios</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->


<!-- edit brand -->
<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editBrandForm" action="php_action/editBrand.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Solicitud</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-brand-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editBrandName" class="col-sm-3 control-label">Nombre: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editBrandName" placeholder="Nombre del solicitante" name="editBrandName" autocomplete="off">
					    </div>
		        </div> <!--Nombre del solicitante /form-group-->	         	        

		      	<div class="form-group">
		        	<label for="vinculacion" class="col-sm-3 control-label">Vinculación: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="vinculacion" placeholder="Vinculación" name="vinculacion" autocomplete="off">
					    </div>
		        </div> <!--Vinculacion /form-group-->	 

		      	<div class="form-group">
		        	<label for="materia" class="col-sm-3 control-label">Materia: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="materia" placeholder="Materia" name="materia" autocomplete="off">
					    </div>
		        </div> <!--Materia /form-group-->

		      	<div class="form-group">
		        	<label for="anotaciones" class="col-sm-3 control-label">Anotaciones: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="anotaciones" placeholder="Anotaciones petición" name="anotaciones" autocomplete="off">
					    </div>
		        </div> <!--Anotaciones peticion /form-group-->

		      	<div class="form-group">
		        	<label for="seguimiento" class="col-sm-3 control-label">Seguimiento: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="seguimiento" placeholder="Seguimiento enlace" name="seguimiento" autocomplete="off">
					    </div>
		        </div> <!--Seguimiento enlace /form-group-->		        		        

		      	<div class="form-group">
		        	<label for="requerimiento" class="col-sm-3 control-label">Requerimiento: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="requerimiento" placeholder="Requerimento de apoyo ofincina" name="requerimiento" autocomplete="off">
					    </div>
		        </div> <!--Requerimiento apoyo oficina /form-group-->		        
		        <div class="form-group">
		        	<label for="editBrandStatus" class="col-sm-3 control-label">Estado: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editBrandStatus" name="editBrandStatus">
				      	<option value="">-- Selecciona --</option>
				      	<option value="1">Pendiente</option>
				      	<option value="2">En seguimiento</option>
				      	<option value="3">Concluida</option>
   				        </select>
					    </div>
		        </div> <!-- /form-group-->	
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editBrandFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit brand -->


<!-- remove brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar fabricante</h4>
      </div>
      <div class="modal-body">
        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeBrandFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->