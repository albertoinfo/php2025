<?php 
define ('FILEUSER','dat/usuarios.txt');
/**
 * 
 * Compruba que la usuario y la contraseña son correctos consultando
 * el archivo de datos
 * @param mixed $login
 * @param mixed $passwd
 * @return bool
 */
function userOk ( $login, $passwd):bool {

    $tusuariolinea = @file(FILEUSER);
    if ( ! $tusuariolinea ){
        die(" Error al abrir el fichero");
    }
    foreach ( $tusuariolinea as $lineauser){
        $datosUser = explode('|', $lineauser);
        if ( $datosUser[0] == $login &&   password_verify($passwd,$datosUser[1]) ){
            return true;

        }
    }
    return false;
}
/**
 *  Actualiza la password de un usuario en el archivo de datos
 * @param mixed $login
 * @param mixed $passwd
 * @return bool true si el usuarios existe en el fichero
 */
function updatePasswd ($login, $passwd):bool {
    $tusuariolinea = @file(FILEUSER);
    if ( ! $tusuariolinea ){
        die(" Error al abrir el fichero");
    }
    $actualizar = false;
    $passwdnueva = password_hash($passwd, PASSWORD_DEFAULT);
    foreach ( $tusuariolinea as &$lineauser){
        $datosUser = explode('|', $lineauser);
        if ( $datosUser[0] == $login ){
            $datosUser[1] = $passwdnueva;
            $lineauser = implode('|', $datosUser) . "\n";
            $actualizar = true;
            break; // NO hace falta buscar más
        }
    }
    if ($actualizar) {
         volcarDatos($tusuariolinea);
    }
    return $actualizar;
}

/**
 *  Vuelca un tabla con los datos de usuario al fichero
 * @param array $tabla
 * @return bool true si actualiza correctamente
 */
function volcarDatos($tabla): void
{
    $fich = fopen(FILEUSER, "w");

    foreach ($tabla as $linea) {
        fputs($fich, $linea);
    }
    fclose($fich);
}
