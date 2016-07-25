<?php
$token = $_GET['token'];
$idusuario = $_GET['idusuario'];

$Login = Login::getTokenData($token);

if ($Login) {
    if (sha1($Login['idusuario']) == $idusuario) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="author" content="denker">
                <title> Restablecer contraseña </title>
                <link rel="stylesheet" href="css/normalize.css">
                <link rel="stylesheet" href="css/style.css">
                <script src="http://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script> 
            </head>

            <body>

                <div class="container" role="main">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form id="frmRestablecer" action="cambiarpassword.php" method="post">
                            <div class="login">
                                <h1>Recupera tu contraseña</h1>
                                <h5>Ingresa tu nueva contraseña</h5>
                                <fieldset>
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Nueva contraseña" required>
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmar contraseña" required>
                                    <input type="hidden" name="token" value="<?php echo $token ?>">
                                    <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
                                </fieldset>
                                <input type="submit" value="Recuperar" />
                                <div id="mensaje"></div><br>
                            </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div> 
        <script src="//code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $("#frmRestablecer").submit(function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: 'cambiarpassword.php',
                        type: 'post',
                        dataType: 'json',
                        data: $("#frmRestablecer").serializeArray()
                    }).done(function (respuesta) {
                        $("#mensaje").html(respuesta.mensaje);
                        $("#password1").val('');
                        $("#password2").val('');
                    });
                });
            });
        </script>
        </body>
        </html>
        <?php
    } else {
        header('Location:index.html');
    }
} else {
    header('Location:index.html');
}
?>