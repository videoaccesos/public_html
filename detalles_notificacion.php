<?php 
 $imgNombre = $_GET['img'];
 $bolExiste = FALSE;
 if(file_exists("./syscbctlmonitoreo/uploads/".$imgNombre))
    $bolExiste = TRUE;
?>
<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Video Accesos System</title>
        
        <style type="text/css">
            body {
                background-color: rgb(255, 255, 255);
                color: rgb(0, 65, 130);
                display: block;
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                line-height: 20px;
                margin-bottom: 0px;
                margin-left: 0px;
                margin-right: 0px;
                margin-top: 0px;
            }
            .fluid {
                display: block;
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                line-height: 20px;
                padding-left: 0px;
                padding-right: 0px;
            }
            .img-polaroid {
                -webkit-box-shadow: rgba(0, 0, 0, 0.0980392) 0px 1px 3px 0px;
                background-color: rgb(255, 255, 255);
                border-bottom-color: rgba(0, 0, 0, 0.2);
                border-bottom-style: solid;
                border-bottom-width: 1px;
                border-image-outset: 0px;
                border-image-repeat: stretch;
                border-image-slice: 100%;
                border-image-source: none;
                border-image-width: 1;
                border-left-color: rgba(0, 0, 0, 0.2);
                border-left-style: solid;
                border-left-width: 1px;
                border-right-color: rgba(0, 0, 0, 0.2);
                border-right-style: solid;
                border-right-width: 1px;
                border-top-color: rgba(0, 0, 0, 0.2);
                border-top-style: solid;
                border-top-width: 1px;
                box-shadow: rgba(0, 0, 0, 0.0980392) 0px 1px 3px 0px;
                color: rgb(0, 34, 53);
                cursor: auto;
                display: inline;
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 18px;
                max-width: 100%;
                font-weight: bold;
                line-height: 20px;
                padding-bottom: 4px;
                padding-left: 4px;
                padding-right: 4px;
                padding-top: 4px;
                vertical-align: middle;
            }
            a {
                color: rgb(0, 82, 130);
                cursor: auto;
                display: inline;
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 18px;
                font-weight: bold;
                height: auto;
                line-height: 20px;
                text-decoration: none;
                width: auto;
            }

        </style>
    </head>
    <body>
        <div class="fluid">
            <div style="width:100%;background-color: #004c78;display:inline-block;">
                   <br>
                   <div style="width:70%;margin-left:15%;min-width:40%">
                        <a href="http://www.videoaccesos.net" style="text-decoration:none;"><img src="http://www.videoaccesos.net/syscbctlmonitoreo/img/logo.png" alt="" style="margin-bottom:10px;"></a><h1 style="color:white;float:right;">Notificación de Acceso</h1>
                   </div>
                   <br>
            </div>       
            <div style="width:70%;margin-left:15%;min-width:40%">
                <h3>
                    <?php if ($bolExiste){ ?>
                        Imagen registrada del evento: <br><br>
                        <img src="syscbctlmonitoreo/uploads/<?php echo $imgNombre; ?>" alt="Imagén del evento!" class="img-polaroid" ><br><br>
                        Esta imagen es para fines demostrativos no necesariamente corresponde a la persona que solicito el acceso.<br><br>
                    <?php }else { ?>
                        Lo sentimos, la imagen no se encuentra disponible!!! <br><br>
                    <?php } ?>
                        Gracias por su Preferencia!!! <br><br>
                        <a href="http://www.videoaccesos.net" style="text-decoration:none;">www.videoaccesos.net</a>
                </h3>
            </div>                   
        </div>
    </body>
</html>