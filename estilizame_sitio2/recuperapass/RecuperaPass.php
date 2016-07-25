<?php

class RecuperaPass extends Login{
    
    public $Usuario;
    
    public function __construct() {
        $this->Usuario = new Usuario();
    }

    public function generarLinkTemporal($idUsuario, $username) {
        global $_app;
        $token = self::setTokenForNewPass($idUsuario, $username);

        if ($token) {
            // Se devuelve el link que se enviara al usuario
            //$enlace = $_SERVER["SERVER_NAME"] . '/Estilizame-master/estilizame_sitio2/recuperapass/restablecer.php?idusuario=' . sha1($idusuario) . '&token=' . $token;
            $enlace = $_app->url . 'recuperapass/restablecer.php?idusuario=' . sha1($idusuario) . '&token=' . $token;
            return $enlace;
        } else {
            return FALSE;
        }
    }

    public function enviarEmail($email, $link, $user) {
        global $_Correos;
        $mensaje = '<html>
 <head>
  <title>Restablece tu contraseña</title>
</head>
<body>
 <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
 <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
 <p>
   <strong>Enlace para restablecer tu contraseña</strong><br>
   <a href="' . $link . '"> Restablecer contraseña </a>
 </p>
</body>
</html>';

        $mail = new SendMailer();
        $mail->setFrom($_Correos['recuperaPass'], "Estilizame");
        $mail->setTo($email, $user);
        $mail->subject("Estilizame - Recuperación de contraseña.");
        $mail->setMainTitle("Recupera tu contraseña");
        $mail->msgHTML($mensaje);

        if ($mail->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
