<?php
ob_start();

if(!isset($_POST["usuario"]))
{
    header("Location: login.php");
    return;
}

$usuario_correcto = "admin";
$palabra_secreta_correcta = "v1de0acces0s";$palabra_secreta_correcta2 = "accessbot";

$usuario = $_POST["usuario"];
$palabra_secreta = $_POST["palabra_secreta"];

if ($usuario === $usuario_correcto && ($palabra_secreta === $palabra_secreta_correcta || $palabra_secreta === $palabra_secreta_correcta2) )
{
    session_start();
    $_SESSION["vauser"] = $usuario;
    header("Location: index.php");
}
else
{
    echo "El usuario o la contraseña son incorrectos";
    header("refresh:5; url=login.php");
}

ob_end_flush();