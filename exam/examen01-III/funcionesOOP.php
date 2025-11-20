<?php
/**
 *  VERSION con PROGRAMACIÓN ORIENTA A OBJETOS
 *  Usando la clase Usuario
 * 
 */

include_once 'Usuario.php';
/**
 *  Devuelve una tabla de objetos Usuario a partir del fichero
 */
function cargarTabla():array {
    $file = fopen('usuarios.dat', 'r');
    $tablaUser = [];
    while ($valores = fgetcsv($file)) {
        // Relleno a partir de array
        //$usr = new Usuario($valores[0],$valores[1],$valores[2]);
        list ($login, $password,$accesos ) = $valores;
        $user = new Usuario($login,$password,$accesos);
        // Tabla asociativa
        $tablaUser[$login]= $user;
    }
    fclose($file);
    return $tablaUser;
}


/**
 * Checks if the provided username and password are valid.
 *
 * @param string $username The username to validate.
 * @param string $password The password to validate.
 * @return bool Returns true if the username and password are valid, false otherwise.
 */
function accesoValido($username, $password): bool
{
    $tablaUser = cargarTabla();
    
    if ( key_exists($username,$tablaUser) &&
        password_verify($password, $tablaUser[$username]->clave) ) {
            return true;
        }
    
    return false;
}

/**
 * Records a new access for the given username.
 *
 * @param string $username The username for which to record the access.
 * @return int The result of the access recording operation.
 */
function anotarNuevoAcceso($username):int{
    $tablaUser = cargarTabla();
    if ( key_exists($username,$tablaUser) ){
        $tablaUser[$username]->accesos ++;
        volcarUsuarios($tablaUser);    
        return true;
    }
    return false;
}

/**
 *  Vuelca los datos el array de objetos de usuarios en el fichero
 * 
 */
function volcarUsuarios ($tabla){
    
   $fich = fopen("usuarios.dat","w");
   foreach( $tabla as $usr){
      $valores = [ $usr->nombre,$usr->clave,$usr->accesos ];
      fputcsv($fich,$valores);
   }
   fclose($fich);
}


/**
 * Registers a user with a given username and time.
 *
 * @param string $username The username of the user to register.
 * @param int $time The time associated with the registration.
 */
function registra($username,$time){
    $ip = $_SERVER["REMOTE_ADDR"];
     $nombre = $username;
     $tiempo = date("d-m-Y h:i",$time);
     $linea = $ip.",".$nombre.",".$tiempo."\n";
     $resu = @file_put_contents("registro.log",$linea,FILE_APPEND);
    return $resu;
}
