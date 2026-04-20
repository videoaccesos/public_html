<!DOCTYPE html>
<html> 
<head>
<title>Video Accesos</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- ========================  CSS FILES  ========================== -->
<!--[if lt IE 9]>
<script type="text/javascript" src="layout/plugins/html5.js"></script>
<![endif]-->

<!-- Style -->
<link rel="stylesheet" href="css/style.css" type="text/css" />

<!-- Fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css" />

<!-- ========================  JAVASCRIPT FILES  ========================== -->
<script type="text/javascript" src="scripts/jquery.js"></script>

<!-- PrettyPhoto start -->
<link rel="stylesheet" href="layout/plugins/prettyphoto/css/prettyPhoto.css" type="text/css" />
<script type="text/javascript" src="layout/plugins/prettyphoto/jquery.prettyPhoto.js"></script>
<!-- PrettyPhoto end -->

<!-- jQuery tools start -->
<script type="text/javascript" src="layout/plugins/tools/jquery.tools.min.js"></script>
<!-- jQuery tools end -->

<!-- ScrollTo start -->
<script type="text/javascript" src="layout/plugins/scrollto/jquery.scroll.to.min.js"></script>
<!-- ScrollTo end -->

<!-- FlexSlider start -->
<link rel="stylesheet" href="layout/plugins/flexslider/flexslider.css" type="text/css" />
<script type="text/javascript" src="layout/plugins/flexslider/jquery.flexslider-min.js"></script>
<!-- FlexSlider end -->

<!-- jQuery Form Plugin start -->
<script type="text/javascript" src="layout/plugins/ajaxform/jquery.form.js"></script>
<!-- jQuery Form Plugin end -->

<!-- Twitter Plugin start -->
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script type="text/javascript" src="layout/plugins/tweet/tweet.widget.js"></script>
<!-- Twitter Plugin end -->

<!-- jQuery Sort Plugin start -->
<script type="text/javascript" src="layout/plugins/sort/jquery.sort.min.js"></script>
<!-- jQuery Sort Plugin end -->

<!-- Roundabout Plugin start -->
<script type="text/javascript" src="layout/plugins/roundabout/jquery.roundabout.min.js"></script>
<!-- Roundabout Plugin end -->

<!-- OneByOne start -->
<link rel="stylesheet" href="layout/plugins/onebyone/css/jquery.onebyone.css" type="text/css" />
<link rel="stylesheet" href="layout/plugins/onebyone/css/animate.css" type="text/css" />
<script type="text/javascript" src="layout/plugins/onebyone/jquery.onebyone.min.js"></script>
<!-- OneByOne end -->

<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript" src="scripts/validar.js" ></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$fecha=date("d-m-y");
$hora=date("H:i:s");
$para="atencionaclientes@videoaccesos.com";
$nombre= $_POST["nombre"];
$asunto= $_POST[asunto];
$mensaje= $_POST["mensaje"];
$de='From: ' .$_POST[email];

$headers = "MIME-Version:1.0;\r\n" ;
$headers .= "content-type: text/html; \r\n charset= utf8_decode(data) \r\n" ;
$headers .= "From: $de \r\n" ;
$headers .= "To: $para; \r\n Subjet:$asunto \r\n" ;
?>



<style type="text/css">
.error{
display:inline-block;
background-color:red;
float: right;
color: white;
height: 15px;
border-radius: 6px;
width: 105px;
text-align: center;
display: none;
}
</style>

<script>
var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).ready(function(){
	$("#bEnviar").click(function(){
		var nombre = $("#itNombre").val();
		var correo = $("#itEmail").val();
		var asunto = $("#itAsunto").val();
		var mensaje = $("#itarea").val();

		for(i=1; i<6;i++){
			$("#mensaje"+i).fadeOut();
		}
		if(nombre == ""){
			$("#mensaje1").fadeIn();
			return false;
		}
		if(correo == ""){
			$("#mensaje2").fadeIn();
			return false;
		}
		if (!expr.test(correo)) {
			$("#mensaje5").fadeIn();
			return false;
		}
		if(asunto == "") {
			$("#mensaje3").fadeIn();
			return false;
		}				
		if(mensaje == ""){
			$("#mensaje4").fadeIn();
			return false;	
		}
		$("#frmContacto").submit();
	});

	<?php 
	//echo var_dump($para)."--".var_dump($asunto)."--".var_dump($mensaje);
		if($_POST["nombre"] && $_POST["asunto"] && $_POST["mensaje"] && $_POST["email"]){
			if (@mail($para, $asunto, $mensaje, $headers ))
				echo 'alert("Su mensaje ha sido enviado");  window.location="index.html";';
			
			else
				echo'alert("Error!! su mensaje no pudo ser enviado intentelo más tarde");';	
		}
	?>
});
</script>

</head>
<body>
<!-- ========================  ACABA HEADER  ========================== --> 

<header >
			<div id="header">
				<section class="section_top">
					<div class="inner">
						<div id="logo"><a href="index.html"><img src="images/videoaccesos.png" alt="VideoAccesos" title="Video Accesos" /></a></div>
                        
						<!----------------------- MENU PRINCIPAL -------------------------->
						<nav class="main_menu">
							<ul>
								<li ><a href="index.html">Inicio</a></li>
								<li ><a href="nosotros.html">Nosotros</a></li>
                                <li><a href="#">Productos</a>
									<ul>
										<li><a href="automatizaciones.html">Automatizaciones</a></li>
										<li><a href="control_acceso.html">Control de Acceso</a></li>
										<li><a href="cctv.html">CCTV</a></li>
										<li><a href="satelital_alarmas.html">Rastreo Satelital y Alarmas</a></li>			
									</ul>
								</li>
								<li><a href="#">Servicios</a>
									<ul>
										<li><a href="ventasacceso.html">Solicitud de Compras y Ventas de Acceso</a></li>
										<li><a href="servicioguardian.html">Servicio Guardian</a></li>
										<li><a href="kitvecinoseguro.html">Kit Vecino Seguro</a></li>
										<li><a href="miresidencial.html">Mi Residencial</a></li>
									</ul>
								</li>
								<li><a href="terminos.html">T&eacute;rminos</a></li>
								<li class="current_page_item"><a href="contacto.php">Contacto</a></li>
							</ul>
						<!----------------------- ACABA MENU -------------------------->						
						<div class="clearboth"></div>
					</div>
				</section>  
			</div>
        
		</header>
		<div class="mobilejump"></div>

<div class="wrapper sticky_footer">
		
		<!-- CONTENIDO -->
		<div id="content" class="">
			<div class="inner">
				<div class="general_content">
					<div class="main_content">
						<div class="separator" style="height:35px;"></div>
						
						<div class="block_contact_us">
							<div class="col_left">
							<h4>Localízanos</h4>
								<div class="map">
									<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?msa=0&amp;msid=207124223012972677320.0004de0bcd6ac4a5920d0&amp;ie=UTF8&amp;ll=24.797485,-107.400254&amp;spn=0,0&amp;t=m&amp;output=embed"></iframe><br /><small>Ver <a href="https://maps.google.com/maps/ms?msa=0&amp;msid=207124223012972677320.0004de0bcd6ac4a5920d0&amp;ie=UTF8&amp;ll=24.797485,-107.400254&amp;spn=0,0&amp;t=m&amp;source=embed" style="color:#0000FF;text-align:left">Video Accesos</a> en un mapa más grande</small>
								</div>
								
								<div class="address">
									<h4>Oficina</h4>
									<p><strong>Dirección:</strong></p>
									<p>Blvd. Zapata 543 Pte.</p>
									<p>Local 5 Col. Almada.</p>
									<p>C.P. 80200 Culiacán, Sinaloa.</p><br>
									
                                	<p><strong>Teléfonos:</strong></p>
                                	<p>+52 667 712 60 43 </p>
									<p>+52 667 712 60 45</p>
									<p><strong>Correo Electrónico:</strong></p>
									<p>atencionaclientes@videoaccesos.com</p>
									<br>
									<!--p><span class="text_subtitle_2">Calle:</span> Lorem ipsum dolor sit amet. Lorem imsum	</p>
									<div class="separator" style="height:14px;"></div>
									<p><span class="text_subtitle_2">Tel:</span> +52 11 1111 1111</p>
									<p><span class="text_subtitle_2">Fax:</span> +52 11 1111 1111</p>
									<p><span class="text_subtitle_2">Email:</span> <a href="mailto:#" target="_blank">info@videoaccesos.com</a></p>
									<p><span class="text_subtitle_2">Web:</span> <a href="#">http://videoaccesos.com/</a></p-->
								</div>
							</div>
							
							<div class="send_message">
								<h4>Formulario de Contacto</h4>
								
								<div class="form">
									<form id="frmContacto" name="mail_frm" action="contacto.php" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="false">
										<p class="label" style="display: inline-block;">Nombre<span> (Requerido)</span></p>
										<div style="display:inline-block; float:right"><div id="mensaje1" class="error"><strong>Ingrese Nombre</strong></div></div>
										<div class="field"><input type="text" id="itNombre" name="nombre" class="req" size="25"></div>
										

										<p class="label" style="display: inline-block;">E-mail <span>(Requerido)</span></p>
										<div style="display:inline-block; float:right"><div id="mensaje2" class="error"><strong>Ingrese E-mail</strong></div><div id="mensaje5" class="error" style="float: right;"><strong>E-mail Incorrecto</strong></div></div>
										<div class="field"><input type="text" id="itEmail" name="email" class="req"></div>
										
										<p class="label" style="display: inline-block;">Asunto</p>
										<div style="display:inline-block; float:right"><div id="mensaje3" class="error"><strong>Ingrese Asunto</strong></div></div>
										<div class="field"><input name="asunto" id="itAsunto" type="text"></div>
										
										<p class="label" style="display: inline-block;">Mensaje <span>(Requerido)</span></p>
										<div style="display:inline-block; float:right"><div id="mensaje4" class="error"><strong>Escriba Mensaje</strong></div></div>
										<div class="textarea"><textarea id="itarea" name="mensaje" cols="1" rows="1" class="req"></textarea></div>
										
										<div class="g-recaptcha" data-sitekey="6LfC5nkUAAAAAAcyyVwSKMSfnLzlPNz9CzYux2S7"></div>
										<br>
										<div class="button"><input type="button" id="bEnviar" name="enviar_btn" class="general_button" value="Enviar Mensaje"></div>
									</form>
								</div>
							</div>
							<div class="clearboth"></div>
						</div>
						
					</div>
					


					<div class="clearboth"></div>
				</div>


			</div>

		</div>
		<!-- ========================  FOOTER  ========================== --> 
				<footer>
				<div id="footer">
				<section class="section_top">
					<div class="inner">
						<div class="block_to_top">
							<a href="#">BACK TO TOP</a>
						</div>
						
						<div class="block_footer_widgets">
							<div class="columndouble">
								<div class="block_title_footer"><h1>Acerca de Video Accesos</h1></div>
								
								<div class="block_footer_about">
									<img src="images/aboutus.jpg" alt="Video Accesos" title="Video Accesos" class="imagefooter" />
									<p>Somos una empresa innovadora que apuesta a la implementación de tecnología para resolver problemas de seguridad y convivencia en conjuntos residenciales.</p>
									<p>Buscamos que nueros clientes obtengan una mayor eficiencia en el gasto que tienen destinado al pago de vigilancia en su privada o residencial.</p>
									

								</div>

							</div>
							
							<div class="column">
								<div class="block_title_footer"><h1>Últimos Tweets</h1></div>								
								<div class="block_footer_tweets">
									<script type="text/javascript">
										// ('YOUR USERNAME','NUMBER OF POSTS');
										AddTweet('lopezobrador_', 2);
									</script>
								</div>
							</div>
							
							<div class="column">
								<div class="block_title_footer"><h1>Contacto</h1></div>
								
								<div class="block_footer_about">
								<p><strong>Dirección:</strong></p>
									<p>Blvd. Zapata 543 Pte.</p>
									<p>Local 5 Col. Almada.</p>
									<p>C.P. 80200 Culiacán, Sinaloa.</p><br>
									
                                	<p><strong>Teléfonos:</strong></p>
                                	<p>+52 667 712 60 43 </p>
									<p>+52 667 712 60 45</p>
									<p><strong>Correo Electrónico:</strong></p>
									<p>atencionaclientes@videoaccesos.com</p>
                                	
								</div>
                            </div>
							
							<div class="clearboth"></div>
						</div>
					</div>
				</section>
				
				<section class="section_bottom">
					<div class="inner">
						 <div class="footer-social"> <a href="#" title="Twitter"><img src="images/social/twitter.png" alt=""></a> <a href="#" title="Facebook"><img src="images/social/facebook.png" alt=""></a> <a href="#" title="Linkedin"><img src="images/social/linkedin.png" alt=""></a> <a href="#" title="Skype"><img src="images/social/skype.png" alt=""></a> <a href="#" title="RSS"><img src="images/social/rss.png" alt=""></a> </div>
						
						<div class="block_copyrights"><p>Copyright &copy; 2013 Video Accesos Todos los derechos reservados.</p></div>
						
						<div class="clearboth"></div>
					</div>
				</section>
			</div>
		</footer>
		<!-- ========================  ACABA FOOTER  ========================== -->  
	</div>
</body>

</html>