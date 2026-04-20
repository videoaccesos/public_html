<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresar谩 a login.php
if(!isset($_SESSION['username'])) 
{
  header('Location: login.php'); 
  exit();
}
$nombre = $_SESSION['username'];
	require('conexion.php');
	$query="SELECT OS.folio,OS.fecha,OS.empleado_id,OS.privada_id, P.descripcion,OS.cierre_tecnico_id, OS.codigo_servicio_id,OS.detalle_servicio,OS.estatus_id,OS.fecha_modificacion FROM ordenes_servicio as OS inner join privadas as P on P.privada_id=OS.privada_id inner join usuarios_tecnicos as U on U.tecnico_id = OS.tecnico_id where U.usuario='$nombre' and OS.estatus_id=1";
	
	$resultado=$mysqli->query($query);
 ?>
  <div style="text-align: right; font-size:18px; margin:5px;"><a href="logout.php">Cerrar Sesión</a></div>
 <?
?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Reportes Técnicos</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- 
    Authentic Template
    http://www.templatemo.com/tm-412-authentic
    -->
    <meta name="viewport" content="width=device-width">        
    <link rel="stylesheet" href="css/templatemo_main.css">
    <!-- templatemo 412 authentic -->
</head>
<body>

    <div id="main-wrapper" style="width: 100%;">
            <!--[if lt IE 7]>
                <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a rel="nofollow" href="http://browsehappy.com">upgrade your browser</a> or <a rel="nofollow" href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                <![endif]-->

                <div class="container" style="width: 100%;">
                    <!-- Static navbar -->
                    <div class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>
                      </div>
                      <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                          <li class="active"><a href="#templatemo-page1"><i class="fa fa-home"></i>Inicio</a></li>
                          <li><a href="#templatemo-page2"><i class="fa fa-user"></i>Mis Reportes</a></li>
                          <li><a href="#templatemo-page3"><i class="fa fa-search"></i>Todos los Reportes</a></li>
                      </ul>
                  </div><!--/.nav-collapse -->
              </div><!--/.container-fluid -->
          </div>
          <div class="image-section">
            <div class="image-container">
                <img src="imagenes/bgFondo.jpg" id="templatemo-page1-img" class="main-img inactive" alt="Home">
                <img src="imagenes/bgFondo.jpg" id="templatemo-page2-img" class="inactive" alt="Services">
                <img src="imagenes/bgFondo.jpg" id="templatemo-page3-img"  class="inactive" alt="Awards">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 templatemo-content-wrapper">
                <div class="templatemo-content" >   
                    <section  id="templatemo-page1-text" class="active">
                        <div style="height: 200px; margin-bottom:-30px;"  class="col-sm-12 col-md-12">
                            <div   id="slider" class="flexslider">
                              <ul class="slides">
                                <li>
                                  <img style="height: 180px" src="imagenes/logo.png"  alt="Slide 1"/>
                              </li>
                          </ul>
                      </div>
              </div>
          </section><!-- /.templatemo-page1-text --> 
          <section id="templatemo-page2-text" class="inactive">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow-y:scroll;">
                <table name"tabla" id="tabla" class="tabla" border="4px" style="color:white; width: 100%;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#00BFFF">
                <tr>
                    <tr name="columnas "id="columnas">
                    <td style="text-align: center; padding:5px"><b>Folio</b></td>
                    <td style="text-align: center; padding:5px"><b>Privada</b></td>
                    <td style="text-align: center; padding:5px"><b>Falla</b></td>
                    <td style="text-align: center; padding:5px"><b>Fecha y Hora</b></td>
<td style="text-align: center; padding:5px"><b>Concluir</b></td>
                    <tr>
                </tr>
                <tbody style="background-color:white; color:#0B2161">
                    <?php while($row=$resultado->fetch_assoc()){ ?>
                        <tr>
                            <td style="text-align: center; padding:5px"><?php echo $row['folio'];?>
                            </td>
                            <td style="text-align: center; padding:5px">
                                <?php echo $row['descripcion'];?>
                            </td>
                            <td style="text-align: center; padding:5px">
                                <?php echo $row['detalle_servicio'];?>
                            </td>
<td style="text-align: center"; padding:5px>
                                <?php echo $row['fecha'];?>
                            </td>
                            <td style="text-align: center; padding:5px"><a href="concluir.php?folio=<?php echo $row['folio'];?>"><img src="imagenes/concluir.png"  alt="concluir" weight="35px" height="35px" ></a> 
                            </td>
                            
                        </tr>
                    <?php } $query="SELECT OS.folio,OS.fecha,empleado_id,P.descripcion,OS.tecnico_id,OS.cierre_tecnico_id, OS.codigo_servicio_id,OS.detalle_servicio,OS.estatus_id,OS.fecha_modificacion FROM ordenes_servicio as OS INNER JOIN privadas as P on P.privada_id = OS.privada_id where OS.estatus_id = 1";
	
	$resultado=$mysqli->query($query);?>
                </tbody>
            </table>
            </div>
        </section><!-- /.templatemo-page2-text -->                 
        <section id="templatemo-page3-text" class="inactive">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow-y:scroll;">
                
   <table id="tabla" class="tabla" border="4px" style="color:white;" bordercolor="#0B2161">
            <thead style="text-align: center; background-color:#00BFFF">
                <tr>
                    <tr name="columnas "id="columnas">
                    <td style="text-align: center; padding:5px"><b>Folio</b></td>
                    <td style="text-align: center; padding:5px"><b>Privada</b></td>
                    <td style="text-align: center; padding:5px"><b>Falla</b></td>
                    <td style="text-align: center; padding:5px"><b>Fecha y Hora</b></td>
					<td><b>Asignado</b></td style="text-align: center; padding:5px">
					<td><b>Status</b></td>
					<td><b>Asignar</b></td>
                    <tr>
                </tr>
                <tbody style="background-color:white; color:#0B2161" >
                    <?php while($row=$resultado->fetch_assoc()){ ?>
                        <tr>
                            <td style="text-align: center; padding:5px"><?php echo $row['folio'];?>
                            </td>
                            <td style="text-align: center; padding:5px">
                                <?php echo $row['descripcion'];?>
                            </td>
                            <td style="text-align: center; padding:5px">
                                <?php echo $row['detalle_servicio'];?>
                            </td>
							<td style="text-align: center; padding:5px">
							                                <?php echo $row['fecha'];?>
							                            </td>
							<td style="text-align: center; padding:5px">
							                                <?php echo $row['tecnico_id'];?>
							                            </td>
							<td style="text-align: center; padding:5px">
                                <?php echo "Abierto";?>
                            </td>
                            <td><center><a href="asignar.php?nombre=<?php echo $nombre?>&folio=<?php echo $row['folio'];?>"><img src="imagenes/asignarme.png"  alt="concluir" weight="35px" height="35px" ></a></center> 
                            </td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </section><!-- /.templatemo-page3-text --> 
        <section id="templatemo-page4-text" class="inactive">
        	<h2 class="text-center">About Us</h2>
            <div class="col-sm-6 col-md-6">
                <h3>Background</h3>
                <p>Nullam semper blandit massa, ut ornare velit tempor vitae. In sollicitudin massa ac enim sollicitudin convallis. Donec rutrum leo ut iaculis mollis. Cras et ipsum id justo imperdiet fringilla. Fusce viverra augue vel tincidunt auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            </div>
            <div class="col-sm-6 col-md-6">
                <h3>Our Team</h3>
                <p>Etiam molestie libero eget blandit vehicula. Integer volutpat, neque a commodo convallis, massa sapien elementum enim, non bibendum sem odio luctus magna. Etiam ac risus at ligula lobortis blandit ut vitae sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac rhoncus magna.</p>
            </div>
            <div class="col-sm-6 col-md-6">
                <h3>Management</h3>
                <p>Aliquam tincidunt viverra quam, ut viverra dolor posuere id. Sed in volutpat eros, eu varius arcu. In hac habitasse platea dictumst. Ut aliquet ullamcorper tellus, sagittis pretium nisi consequat in. Integer in risus ac eros consectetur volutpat eget eu urna. In auctor tristique mi, sed dapibus purus ultrices sed.</p>
            </div>
            <div class="col-sm-6 col-md-6">
                <h3>Our Goals</h3>
                <p>In rhoncus purus in leo tincidunt elementum. Cras sed leo aliquam, ornare velit non, varius purus. Curabitur euismod leo sed purus dapibus vestibulum. Aliquam in magna id erat posuere ultrices. Pellentesque vel nibh felis. Praesent vel massa eget est imperdiet fermentum. Donec porta lectus quis pulvinar semper.</p>
            </div>
            
        </section><!-- /.templatemo-page4-text --> 

        <section id="templatemo-page5-text" class="inactive">
            <div class="col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                    	<h2>Contact Information</h2>
                    	<p>Mauris at rutrum arcu. In felis turpis, tincidunt a odio interdum, ornare interdum magna. Proin leo tortor, adipiscing et volutpat tincidunt, imperdiet sit amet purus. Proin erat ante, consectetur et sapien eu, egestas volutpat tortor. Donec at nulla orci. Sed luctus interdum ante, vel adipiscing leo aliquam nec.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                    	<h3>Our Location</h3>
                        <div id="map-canvas"></div>
                        <p>123 Thamine Street, New Estate, Yangon 10620, Myanmar</p>
                    </div>

                    <div class="col-sm-6 col-md-6">
                    	<h3>Send us a message</h3>
                        <form action="#" method="post">

                            <div class="form-group">
                                <!--<label for="contact_name">Name:</label>-->
                                <input type="text" id="contact_name" class="form-control" placeholder="Name" />
                            </div>
                            <div class="form-group">
                                <!--<label for="contact_email">Email:</label>-->
                                <input type="text" id="contact_email" class="form-control" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <!--<label for="contact_subject">Subject:</label>-->
                                <input type="text" id="contact_subject" class="form-control" placeholder="Subject" />
                            </div>
                            <div class="form-group">
                                <!--<label for="contact_message">Message:</label>-->
                                <textarea id="contact_message" class="form-control" rows="9" placeholder="Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>

                        </form>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </section><!-- /.templatemo-page5-text --> 
    </div><!-- /.templatemo-content -->  
</div><!-- /.templatemo-content-wrapper --> 
</div><!-- /.row --> 

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
        <div class="footer-wrapper">
            <p id="tm-copyright">
            	Copyright &copy; 2016 VideoAccesos
            </p>
            </div>                    
        </div><!-- /.footer --> 
    </div>               
</div> <!-- /.container -->
</div><!-- /#main-wrapper -->

<div id="preloader">
    <div id="status">&nbsp;</div>
</div><!-- /#preloader -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/jquery.flexslider.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/templatemo_script.js"></script>
</body>
</html>