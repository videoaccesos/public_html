<?php
session_start();

if(isset($_SESSION["vauser"]))
{
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>[VIDEOACCESOS] CAMARAS - LOGIN</title>

    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style type="text/css">
        * {
  margin: 0;
  pading: 0;
}

body {
  background: #B0BEC5;
}

.box {
  top: 50%;
  left: 50%;
  position: absolute;
  margin: -200px 0 0 -300px;
  width: 600px;
  height: 410px;
  background: #37474F;
  color: white;
  border: 1px solid white;
  border-radius: 5px;
  animation: boxShow 1s ease-in-out;
}
.box .title {
  margin: 0 50px;
  color: white;
  border-bottom: 2px solid white;
  font-family: Calibri;
}
.box .content {
  margin: 30px 50px;
}
.box .content input#uname, .box .content input#passwd {
  color: #e74c3c;
  background: rgba(0, 0, 0, 0.1);
  outline: 0;
  border: none;
  border-radius: 3px;
  padding: 5px 15px;
  transition: all 0.4s;
}
.box .content input#uname:focus, .box .content input#passwd:focus {
  color: #2ecc71;
  background: rgba(0, 0, 0, 0.4);
  box-shadow: inset 0 0 10px #3498db;
}
.box .content button[id=login] {
  width: 100%;
  margin: 10px 0;
}
.box .footer {
  bottom: 0;
  left: 0;
  margin: 0 50px;
  padding: 15px 5px;
  width: 83%;
  position: absolute;
  border-top: 2px solid white;
}
.box .footer a {
  text-decoration: none;
  transition: color 0.4s;
}
.box .footer a:hover {
  color: #4FC3F7;
}

@-webkit-keyframes boxShow {
  0% {
    transform: scale(0.5);
    opacity: 0.5;
  }
  25% {
    transform: scale(1.2);
    opacity: 1;
  }
  50% {
    transform: scale(0.8);
    opacity: 0.8;
  }
  75% {
    transform: scale(1.1);
    opacity: 1;
  }
  100% {
    transform: scale(1);
  }
}
@keyframes boxShow {
  0% {
    transform: scale(0.5);
    opacity: 0.5;
  }
  25% {
    transform: scale(1.2);
    opacity: 1;
  }
  50% {
    transform: scale(0.8);
    opacity: 0.8;
  }
  75% {
    transform: scale(1.1);
    opacity: 1;
  }
  100% {
    transform: scale(1);
  }
}

    </style>
</head>
<body>

    <div class="box w3-card-12">
    <div class="title w3-center">
        <h3>Login</h3>
    </div>
    <div class="content">
        <form method="post" action="blogin.php" id="form">
            <div class="input-cont">
                <label class="w3-label w3-text-yellow">Usuario: </label>
                <span class="icon"><i class="fa fa-user"></i></span>
                <input class="w3-input" type="text" id="uname" name="usuario" required>
            </div>
            <br><br>
            <div class="input-cont">
                <label class="w3-label w3-text-yellow">Contraseña: </label>
                <span class="icon"><i class="fa fa-key"></i></span>
                <input class="w3-input" type="password" id="passwd" name="palabra_secreta" required>
            </div>
            <br>
            <button class="w3-btn w3-blue" id="login" type="submit" onClick="validate">Iniciar sesion</button>
        </form>
    </div>
    <div class="footer">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
    function validate() {
        var uname = $('#uname'),
                passwd = $('#passwd');
        
        if(uname === "" && passwd === "") {
            alert('Introduce el usuario y contraseña');
            return false;
        } else {
            alert('Correcto !');
            return false;
        }
    }
});
</script>
</body>
</html>