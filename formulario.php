<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
<head>
	<title>Compra en Linea</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    </script>
</head>
<body>
<br><br>
<center><img src="images/videoaccesos.png">
<br><br>
<h2 style="color:white">REGISTRO Y COMPRA DE TARJETAS</h2>
<br>
<table id="dataTotal" width="190px" border="1"   class="table table-striped table-bordered table-hover" name="total_table" style="overflow: auto; position: relative; border-color:#DFD326; border-radius: 3px; border-style: groove;  width:280px; " tabindex="5001">
				<thead>
					<tr>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> Vehicular</span></th>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> $700</span></th>
					</tr>
					<tr>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> Peatonal</span></th>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> $150</span></th>
					</tr>
					<tr>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> Kit (1 Vehicular y 1 Peatonal)</span></th>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> $750</span></th>
					</tr>
				</thead>
			</table>
			</center>
<!-- multistep form -->
<form name="msform" id="msform" method="POST" action="guarda_datos.php">
  <!-- progressbar -->

  <ul id="progressbar">
    <li class="active">Datos Personales</li>
    <li>Registro de Residentes y Visitas</li>
    <li>Registro de Tarjetas</li>
  </ul>
  
  <!-- fieldsets -->
  <fieldset>

    <h1 class="fs-title">Datos del Responsable</h1>
    <h6 style="color: red">** Asegúrese de llenar TODOS los campos (son obligatorios para poder realizar el pago) **</h6>
    <table>
    <tr></tr>
    <tr>
    <td><input type="text" name="nombreRes" id="nombreRes" maxlength="30" placeholder="Nombre(s)" onkeypress="return validLetter(event);" /></td>
    <td width="20px"></td>
    <td><input type="text" name="apPaternoRes" id="apPaternoRes" maxlength="20" placeholder="Apellido Paterno" onkeypress="return validLetter(event);" /></td>
    <td width="20px"></td>
    <td><input type="text" name="apMaternoRes" id="apMaternoRes" maxlength="20" placeholder="Apellido Materno" onkeypress="return validLetter(event);" /></td>
    </tr>
    </table>
    <table>
    <tr>
    <td width="47.5%"><input type="text" name="calle"  id="calle" maxlength="30" placeholder="Calle"  /></td>
    <td width="20px"></td>
    <td width="15%"><input type="text" name="numExt" id="numExt" maxlength="4" placeholder="Núm. Ext." onkeypress="return validNumber(event);" /></td>
    <td width="20px"></td>
      <td>
      
    	 <select name="residencia" id="residencia">
  		<option value="0">Seleccione su privada...</option> 
  		<!--<option value="1">Mónaco</option>-->
  		<!--<option value="2">Tosali</option>-->
  		<option value="3">Banus C2</option>
  		<!--<option value="4">Buena Vista</option>-->
	 </select>
       </td>
    </tr>
    </table>
    	<table>
    		<tr>
    			<td><input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" maxlength="20" onkeypress="return validLetter(event);" /></td>
    			<td width="20px"></td>
    			<td><input type="text" name="estado1" id="estado1" placeholder="Estado" maxlength="20" onkeypress="return validLetter(event);" /></td>
    			<td width="20px"></td>
   			<td><input type="text" name="CP" id="CP" placeholder="Código Postal" maxlength="6" onkeypress="return validNumber(event);" /></td>
    		</tr>
    	</table>
    <table>
    <tr></tr>
    
    <td width="48.5%"><input type="text" name="telCasa" id="telCasa" maxlength="10" placeholder="Teléfono Casa" onkeypress="return validNumber(event);"  /></td>
    <td width="20px"></td>

    <td width="48.5%"><input type="text" name="telCel" id="telCel" maxlength="10" placeholder="Teléfono Celular" onkeypress="return validNumber(event);" /></td>
    
    </table>
    <table>


  <h4>Elija el teléfono que desea usar como interfón</h4>
  <br>
    <td><input type="checkbox" class="radio" value="1" name="chk" checked /><h5 id="telefonos">Casa</h5></td>
    <td width="20px"></td>
    <td><input type="checkbox" class="radio" value="2" name="chk" /><h5 id="telefonos">Celular</h5></td>
    <table>
    <br>

<a>Para tener derecho a un teléfono de interfón debe comprar al menos una tarjeta vehicular</a>
<br><br>
    <td width="48.5%"><input type="text" name="correo" id="correo" maxlength="50" placeholder="Correo electrónico" /></td>
    <td width="20px"></td>
    <td><a>*Usted recibirá notificaciones en este correo cuando se de acceso a su residencia*</a></td>

    </table>
<table>
    <td width="48.5%"><input type="text" name="confirmaCorreo" id="confirmaCorreo" maxlength="50" placeholder="Confirmar correo electrónico" /></td>
    <td width="20px"></td>
    <td><a></a></td>

    </table>
    <input type="button" name="next" class="next1 action-button" value="Continuar"  />

  </fieldset>
  
  <fieldset>
    <h1 class="fs-title">Registro de Residentes y Visitas</h1>
    <h5>A continuacion le solicitamos que nos hagan llegar la información relativa a residentes y visitas distinguidos que quiera registrar y se les permita acceso a su residencia.</h5>
<br><br>

    <br>
    <table>
    <tr></tr><div class="input-group" >
                      <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>

                      <td width="25%"></td>
    <td><input type="button" onclick="obtenerValoresTablaResidentes();" id="add_residente" class="agregarTablas" value="Agregar" /></td>

    <td><input type="button" onclick="delete_row('dataResidente');" id="delete_residente" class="eliminarTablas" value="Eliminar"/></td>
                     <TABLE id="dataResidente" width="350px" border="1"   class="table table-striped table-bordered table-hover" name='residente_table' style="overflow: auto; position: relative;" tabindex="5001">
                      <thead>
              <tr>
                  <th class="warning" >Eliminar</th>
                  <th class="warning"><span class="glyphicon glyphicon-play-circle"> Nombre del residente</span></th>
                  
              </tr>

          </thead>
                    </TABLE>
                    </div>
    </table>
    
<br>
<h5 style="text-align:left">- Si desea proporcionar otro nombre presione el botón "Agregar".</h5>
<h5 style="text-align:left">- Si desea eliminar seleccione el nombre y presione el botón "Eliminar".</h5>
<br><br>
<br>
    <table>
    <tr></tr><div class="input-group" >
                      <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>

                      <td width="25%"></td>
    <td><input type="button" onclick="obtenerValoresTablaVisitantes();" id="add_visitante" class="agregarTablas" value="Agregar" /></td>

    <td><input type="button" onclick="delete_row('dataVisitante');" id="delete_visitante" class="eliminarTablas" value="Eliminar"/></td>
                     <TABLE id="dataVisitante" width="350px" border="1"   class="table table-striped table-bordered table-hover" name='visitante_table' style="overflow: auto; position: relative;" tabindex="5001">
                      <thead>
              <tr>
                  <th class="warning" >Eliminar</th>
                  <th class="warning"><span class="glyphicon glyphicon-play-circle"> Nombre del visitante</span></th>
                  
              </tr>

          </thead>
                    </TABLE>
                    </div>
    </table>
<br>
<h5 style="text-align:left">- Si desea proporcionar otro nombre presione el botón "Agregar".</h5>
<h5 style="text-align:left">- Si desea eliminar seleccione el nombre y presione el botón "Eliminar".</h5>

    <!--<table><td><input type="checkbox" class="radio" value="1" name="noRegistrar" /></td>
    <td width="80%"></td>
    </table>
    <h5 id="noRegistrar">No gracias, no quiero registrar a nadie</h5> -->

    <!--<h5 style="color: #08088A">Usted ha registrado a:  <?php echo $visitas_residentes ?></h5>-->
    
    <!--<h5>Gracias por su colaboración, procederemos a valorar los datos con el comité de su privada, en caso de alguna duda nos comunicaremos con usted vía telefónica.</h5>-->

    <input type="hidden" value="ba3b2748672431ebeebeed1327c1459a94a74be" name="idSucursal"></input>
    <input type="hidden" value="ce4287a4093e4fca1928f2cde9bf04lee7de8292" name="idUsuario"></input>
    <input type="hidden" value="1" name="idServicio"></input>
    <input type="hidden" value="1372109726" name="idPedido"></input>
    <input type="hidden" value="36" name="monto"></input>
    <input type="button" name="previous" class="previous action-button" value="Anterior" />
    <input type="button" name="next" class="next action-button" value="Continuar" onclick="addNumeroTarjeta('dataNumeroTarjeta');" />
     
  </fieldset>
<fieldset>

    <h1 class="fs-title">Registro de Tarjetas</h1>
    <h5>Por favor, proporcione los números y el tipo de tarjeta que desea adquirir, en caso de optar por NO COMPRAR tarjetas vehiculares podrá registrar hasta dos tarjetas peatonales que le servirán para accesar bajándose de su vehículo y pasándolas por la lectora de caseta.

Le comentamos que si usted necesita alguna tarjeta extra, puede solicitarla al correo monaco@videoaccesos.com, o en su caso comunicarse con el comité de su residencial.</h5>
<br><br>
 <!--<h3>Presione "Agregar" para seleccionar las tarjetas que desea comprar</h3>
<br>
<table>
    <tr>
    </tr>
                         <div class="input-group" >
                      <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>

                      <td width="25%"></td>
    <td><input type="button" onclick="" id="add_tarjeta" class="agregarTablas" value="Agregar" /></td>

    <td><input type="button" onclick="delete_row('dataTarjeta');" id="delete_tarjeta" class="eliminarTablas" value="Eliminar"/></td>
                     <TABLE id="dataTarjeta" width="350px" border="1"   class="table table-striped table-bordered table-hover" name='tarjeta_table' style="overflow: auto; position: relative;" tabindex="5001">
                      <thead>
              <tr>
                  <th class="warning" ># Registro</th>
                  <th class="warning"><span class="glyphicon glyphicon-play-circle"> Seleccione una tarjeta</span></th>
                  <th class="warning"><span class="glyphicon glyphicon-calendar"> Cantidad</span></th>
                  
              </tr>

          </thead>
                    </TABLE>
                    </div>
<tr></tr>
    </table> -->
<br>
<table>
    <tr></tr>
    <div class="input-group" >
                      <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>

                      <td width="25%"></td>
    <td><input type="button" onclick="obtenerValoresTablaNumerosTarjeta();" id="add_numeroTarjeta" class="agregarTablas" value="Agregar" /></td>

    <td><input type="button" onclick="delete_row('dataNumeroTarjeta');" id="delete_numeroTarjeta" class="eliminarTablas" value="Eliminar"/></td>
                     <TABLE id="dataNumeroTarjeta" width="350px" border="1"   class="table table-striped table-bordered table-hover" name='numeroTarjeta_table' style="overflow: auto; position: relative;" tabindex="5001">
                      <thead>
              <tr>
                  <th class="warning" >Eliminar</th>
                  <th class="warning"><span class="glyphicon glyphicon-play-circle"> Número de tarjeta</span></th>
                  
              </tr>

          </thead>
                    </TABLE>
                    </div>
    <tr></tr>
    </table>
    <br>
<h5 style="text-align:left">- Si desea proporcionar otro número de tarjeta presione el botón "Agregar".</h5>
<h5 style="text-align:left">- Si desea eliminar seleccione el registro y presione el botón "Eliminar".</h5>
<br><br>
<h3>Dudas o comentarios</h3>
    <br>
    <textarea name="dudasComentarios"></textarea>
    <br>
<h5>Gracias por su colaboración, procederemos a valorar los datos con el comité de su privada, en caso de alguna duda nos comunicaremos con usted vía telefónica.</h5>
	<!--<h5 style="color: #08088A">Usted ha registrado éstas tarjetas:  <?php echo $numero_tarjetas ?></h5>-->
    <input type="button" name="previous" class="previous action-button" value="Regresar" />
    <input type="submit" name="bGuardar" class="submit action-button" value="Continuar"  />
  </fieldset>
</form>
</body>
</html>
<script src="//assets.codepen.io/assets/common/stopExecutionOnTimeout-f961f59a28ef4fd551736b43f94620b5.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script type="text/javascript">


function validarCampos()
{
if ($("#nombreRes").val() == "")
{
    alert("Favor de proporcionar su Nombre");
}

if ($("#apPaternoRes").val() == "")
{
    alert("Favor de proporcionar su Apellido Paterno");
}

if ($("#apMaternoRes").val() == "")
{
    alert("Favor de proporcionar su Apellido Materno");
}
if ($("#calle").val() == "")
{
    alert("Favor de proporcionar la Calle");
}
if ($("#numExt").val() == "")
{
    alert("Favor de proporcionar su Número Exterior");
}
if ($("#residencia").val() == "")
{
    alert("Favor de proporcionar su Residencia");
}
if ($("#ciudad").val() == "")
{
    alert("Favor de proporcionar su Ciudad");
}
if ($("#estado1").val() == "")
{
    alert("Favor de proporcionar su Estado");
}
if ($("#CP").val() == "")
{
    alert("Favor de proporcionar su Código Postal");
}
if ($("#telCasa").val() == "")
{
    alert("Favor de proporcionar su Teléfono de Casa");
}
if ($("#telCel").val() == "")
{
    alert("Favor de proporcionar su Teléfono Celular");
}
var correo=$("#correo").val();
if (!(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test($("#correo").val())))
{
    alert("Favor de proporcionar su Correo");
}
if ($("#correo").val() != $("#confirmaCorreo").val())
{
    alert("Confirmar correo electrónico, no coincide");
}
}

function agregarTarjetas()
{
var tarjetas_elegidas = document.msform.listaTarjetas.value ;
var cantidad = document.msform.cant.value;
alert(tarjetas_elegidas);
}
</script>

<script>
      var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animating;
$('.next').click(function () {
    if (animating)
        return false;
    animating = true;
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    $('#progressbar li').eq($('fieldset').index(next_fs)).addClass('active');
    next_fs.show();
    current_fs.animate({ opacity: 0 }, {
        step: function (now, mx) {
            scale = 1 - (1 - now) * 0.2;
            left = now * 50 + '%';
            opacity = 1 - now;
            current_fs.css({
                'transform': 'scale(' + scale + ')',
                'position': 'absolute'
            });
            next_fs.css({
                'left': left,
                'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        easing: 'easeInOutBack'
    });
});
$('.previous').click(function () {
    if (animating)
        return false;
    animating = true;
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    $('#progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');
    previous_fs.show();
    current_fs.animate({ opacity: 0 }, {
        step: function (now, mx) {
            scale = 0.8 + (1 - now) * 0.2;
            left = (1 - now) * 50 + '%';
            opacity = 1 - now;
            current_fs.css({ 'left': left });
            previous_fs.css({
                'transform': 'scale(' + scale + ')',
                'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        easing: 'easeInOutBack'
    });
});
      //@ sourceURL=pen.js 
    </script>
<script>
      var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animating;

$('.next1').click(function () {
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if ($("#nombreRes").val() != "" && $("#apPaternoRes").val() != "" && $("#apMaternoRes").val() != "" && $("#calle").val() != "" && $("#numExt").val() != "" && $("#residencia").val() != 0 && $("#ciudad").val() != "" &&  $("#estado1").val() != "" && $("#CP").val() != "" && $("#telCasa").val() != "" && $("#telCel").val() != "" && $("#correo").val() != "" && $("#confirmaCorreo").val() != "")
{
  email= $("#correo").val();
  if ( !expr.test(email) )
  {
    alert("Formato de correo inválido.");
    }
    else
    {
if ($("#correo").val() == $("#confirmaCorreo").val())
{
addResidente('dataResidente'); addVisitante('dataVisitante');
    if (animating)
        return false;
    animating = true;
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    $('#progressbar li').eq($('fieldset').index(next_fs)).addClass('active');
    next_fs.show();
    current_fs.animate({ opacity: 0 }, {
        step: function (now, mx) {
            scale = 1 - (1 - now) * 0.2;
            left = now * 50 + '%';
            opacity = 1 - now;
            current_fs.css({
                'transform': 'scale(' + scale + ')',
                'position': 'absolute'
            });
            next_fs.css({
                'left': left,
                'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        easing: 'easeInOutBack'
    });
}else{alert("Confirmar correo, no coincide.");} }
}else{alert("Favor de llenar todos los campos.");}
});
$('.previous').click(function () {
    if (animating)
        return false;
    animating = true;
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    $('#progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');
    previous_fs.show();
    current_fs.animate({ opacity: 0 }, {
        step: function (now, mx) {
            scale = 0.8 + (1 - now) * 0.2;
            left = (1 - now) * 50 + '%';
            opacity = 1 - now;
            current_fs.css({ 'left': left });
            previous_fs.css({
                'transform': 'scale(' + scale + ')',
                'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        easing: 'easeInOutBack'
    });
});
      //@ sourceURL=pen.js 
    </script>
<script>
      function validNumber(e) 
      {
      var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
      return ((tecla > 47 && tecla < 58) || tecla == 8);
      }
      function validLetter(e) 
      {
      var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
      var especiales = [8, 32, 13];/*back, space, enter */
        for (var i in especiales) 
        {
          if (tecla == especiales[i]) { return true;/*break; */}
        }
        return (((tecla > 96 && tecla < 123) || (tecla > 64 && tecla < 91)) || tecla == 8);
      }

    </script>
    <script>
    	
    	$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

    </script>


<script>

function addTarjeta(tableID) 
{

               var table = document.getElementById(tableID);

 

               var rowCount = table.rows.length;1

               var row = table.insertRow(rowCount);

 
                    
               var cell1 = row.insertCell(0);

               var element1 = document.createElement("input");

               element1.type = "checkbox";

               cell1.appendChild(element1);

 

               var cell2 = row.insertCell(1);

                
              
               var element2 = document.createElement("select");

               element2.type = "select";
                 
                element2.title = "Seleccione la tarjeta";
                
                element2.setAttribute('cols', 25); 
                element2.setAttribute('rows', 3);
                 element2.name="tarjetas_seleccionadas[]";
                  element2.id="tarjetas_seleccionadas";
                  element2.options[0]=new Option("Selecciona una opción o el Kit de tu preferencia","0");
                  element2.options[1]=new Option("Vehicular $700","1");
                  element2.options[2]=new Option("Peatonal $150","2");
                  element2.options[3]=new Option("Kit 1 (1 Vehicular y 1 Peatonal) $750","3");
		  element2.options[4]=new Option("Kit 2 (2 Vehiculares y 1 Peatonal) $1450","4");
                  element2.options[5]=new Option("Kit 3 (3 Vehiculares) $1750","5");
                  element2.options[6]=new Option("Kit 4 (3 Vehiculares y 2 Peatonales) $1850","6");
                  element2.options[7]=new Option("Kit 5 (3 Vehiculares y 3 Peatonales) $2000","7");
                  
                  
               //element2.placeholder="Medida correctiva de las causas básicas ";
               cell2.appendChild(element2);
            
               
               
               var cell3 = row.insertCell(2);
               var element3 = document.createElement("input");

               element3.type = "text";
                 
                element3.title = "Cantidad";
                
               
                 element3.name="cantidad[]";
                  element3.id="cantidad";
               element3.placeholder="Cantidad";
               cell3.appendChild(element3);


          }

function obtenerValoresTablaNumerosTarjeta()
{
          var tarjetas= document.getElementsByName('numeroTarjeta[]');
          var tarjetas_registradas= [];
          var tmTarjetas="X";
          for(var i = 0; i < tarjetas.length; i++)
          {
             if (tarjetas[i].value != ""){
                   tmTarjetas="X";
tarjetas_registradas.push(tarjetas[i].value);
             }

if (tarjetas[i].value == "")
{
tmTarjetas = "";
}
          }
if(tmTarjetas=="")
            {
          alert("Usted ya tiene un campo vacío para proporcionar un número de tarjeta.");
}
else
{
addNumeroTarjeta('dataNumeroTarjeta');

}
}

function addNumeroTarjeta(tableID) 
{
               var table = document.getElementById(tableID);

               var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

               var cell1 = row.insertCell(0);

               var element1 = document.createElement("input");

               element1.type = "checkbox";

               cell1.appendChild(element1);


               var cell3 = row.insertCell(1);
               var element3 = document.createElement("input");

               element3.type = "text";
                element3.title = "NumeroTarjeta";
                element3.maxLength="10";
               
                 element3.name="numeroTarjeta[]";
                  element3.id="numeroTarjeta";
               element3.placeholder="Número de la tarjeta";
               cell3.appendChild(element3);
           
          }

function addNumeroTarjeta1(tableID) 
{
               var table = document.getElementById(tableID);

               var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

               var cell1 = row.insertCell(0);

               var element1 = document.createElement("input");

               element1.type = "checkbox";

               cell1.appendChild(element1);


               var cell3 = row.insertCell(1);
               var element3 = document.createElement("input");

               element3.type = "text";
                 
                element3.title = "NumeroTarjeta";
                element3.maxLength="10";
               
                 element3.name="numeroTarjeta[]";
                  element3.id="numeroTarjeta";
               element3.placeholder="Número de la tarjeta";
               cell3.appendChild(element3);
           
          }

function numerosTarjetaRepetidos()
{
          var tarjetas= document.getElementsByName('numeroTarjeta[]');
          var tarjetas_registradas= [];
          var tmTarjetas="X";
          for(var i = 0; i < tarjetas.length; i++)
          {
              for(var j = 0; j < (tarjetas.length)-i; j++)
            {
               if (tarjetas[j] == tarjetas[j]+1)
               {
                     alert("Números de tarjeta repetidos.");
                }
            }
          }
}


function obtenerValoresTablaResidentes()
{
          var residentes= document.getElementsByName('residentes[]');
          var residentes_registrados= [];
          var tmResidentes="X";
          for(var i = 0; i < residentes.length; i++)
          {
             if (residentes[i].value != ""){
                   tmResidentes="X";
residentes_registrados.push(residentes[i].value);
             }

if (residentes[i].value == "")
{
tmResidentes= "";
}
          }
if(tmResidentes=="")
            {
          alert("Usted ya tiene un campo vacío para proporcionar un residente.");
}
else
{
addResidente('dataResidente');

}
}

function addResidente(tableID) 
{

               var table = document.getElementById(tableID);

 

               var rowCount = table.rows.length;

               var row = table.insertRow(rowCount);

 
                    
               var cell1 = row.insertCell(0);

               var element1 = document.createElement("input");

               element1.type = "checkbox";

               cell1.appendChild(element1);

 

               var cell3 = row.insertCell(1);
               var element3 = document.createElement("input");

               element3.type = "text";
                 
                element3.title = "Residentes";
                element3.maxLength="80";
               
                 element3.name="residentes[]";
                  element3.id="residentes";
               element3.placeholder="Nombre del residente";
               cell3.appendChild(element3);


          }

function obtenerValoresTablaVisitantes()
{
          var visitantes= document.getElementsByName('visitantes[]');
          var visitantes_registrados= [];
          var tmVisitantes="X";
          for(var i = 0; i < visitantes.length; i++)
          {
             if (visitantes[i].value != ""){
                   tmVisitantes="X";
visitantes_registrados.push(visitantes[i].value);
             }

if (visitantes[i].value == "")
{
tmVisitantes= "";
}
          }
if(tmVisitantes=="")
            {
          alert("Usted ya tiene un campo vacío para proporcionar un visitante.");
}
else
{
addVisitante('dataVisitante');

}
}
function addVisitante(tableID) 
{

               var table = document.getElementById(tableID);

 

               var rowCount = table.rows.length;

               var row = table.insertRow(rowCount);

 
                    
               var cell1 = row.insertCell(0);

               var element1 = document.createElement("input");

               element1.type = "checkbox";

               cell1.appendChild(element1);

 

               var cell3 = row.insertCell(1);
               var element3 = document.createElement("input");

               element3.type = "text";
                 
                element3.title = "Visitantes";
                element3.maxLength="80";
               
                 element3.name="visitantes[]";
                  element3.id="visitantes";
               element3.placeholder="Nombre del visitante";
               cell3.appendChild(element3);


          }
//elimina fila de la tabla
//funcion para eliminar las filas de las tablas dinamicas
 function delete_row(tableID) {

               try {

               var table = document.getElementById(tableID);

               var rowCount = table.rows.length;

 

               for(var i=0; i<rowCount; i++) {

                    var row = table.rows[i];

                    var chkbox = row.cells[0].childNodes[0];

                    if(null != chkbox && true == chkbox.checked) {

                         table.deleteRow(i);

                         rowCount--;

                         i--;

                    }

               }

               }catch(e) {

                    alert(e);

               }

          }
          </script>