var manageBrandTable;

$(document).ready(function() {
	// top bar active
	$('#navBrand').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchBrand.php',
		'order': []		
		
	});

	// submit brand form function
	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var brandName 	= $("#brandName").val();
		var brandStatus = $("#brandStatus").val();
		var telefono 	= $("#telefono").val();
		var correo		= $("#correo").val();
		var peticion    = $("#peticion").val();
		if(brandName == "") {
			$("#brandName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#brandName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandName").find('.text-danger').remove();
			// success out for form 
			$("#brandName").closest('.form-group').addClass('has-success');	  	
		}
		if(telefono == "") {
			$("#telefono").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#telefono').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#telefono").find('.text-danger').remove();
			// success out for form 
			$("#telefono").closest('.form-group').addClass('has-success');	  	
		}		
		if(correo == "") {
			$("#correo").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#correo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#correo").find('.text-danger').remove();
			// success out for form 
			$("#correo").closest('.form-group').addClass('has-success');	  	
		}
		if(brandStatus == "") {
			$("#brandStatus").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#brandStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandStatus").find('.text-danger').remove();
			// success out for form 
			$("#brandStatus").closest('.form-group').addClass('has-success');	  	
		}
		if(peticion == "") {
			$("#peticion").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#peticion').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#peticion").find('.text-danger').remove();
			// success out for form 
			$("#peticion").closest('.form-group').addClass('has-success');	  	
		}

		if(brandName && telefono && correo && brandStatus && peticion) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageBrandTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit brand form function

});

function editBrands(brandId = null) {
	if(brandId) {
		// remove hidden brand id text
		$('#brandId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');
				// nombre del solicitante
				$('#editBrandName').val(response.nombresolicitante);
				// vinculacion
				$('#vinculacion').val(response.vinculacion);
				// materia
				$('#materia').val(response.materia);
				// anotaciones
				$('#anotaciones').val(response.anotaciones);
				// seguimiento
				$('#seguimiento').val(response.seguimiento);
				// requerimiento
				$('#requerimiento').val(response.apoyo);
				// estado
				$('#editBrandStatus').val(response.estado);
				// brand id 
				$(".editBrandFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+response.idsolicitud+'" />');

				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var brandName 	= $('#editBrandName').val();
					var brandStatus = $('#editBrandStatus').val();

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form 
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}

					if(brandStatus == "") {
						$("#editBrandStatus").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editBrandStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editBrandStatus").find('.text-danger').remove();
						// success out for form 
						$("#editBrandStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(brandName && vinculacion && brandStatus) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageBrandTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeBrands(brandId = null) {
	if(brandId) {
		$('#removeBrandId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				$('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.brand_id+'" /> ');

				// click on remove button to remove the brand
				$("#removeBrandBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBrandBtn").button('loading');

					$.ajax({
						url: 'php_action/removeBrand.php',
						type: 'post',
						data: {brandId : brandId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBrandBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the brand table 
								manageBrandTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function