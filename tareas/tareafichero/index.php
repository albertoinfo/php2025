<?php 
session_start();

$mensaje=" Hola hola";
if (!isset($_SESSION['usuario']) && !isset($_POST['orden'])){
    include_once 'acceso.php';
    die();
}

if ($_POST['orden'] ==  "entrar" ){
    // Chequear que el usuario y la contraseña son correctas
    // En caso contrario ir acceso con un mensaje
    $_SESSION['usuario'] = "JUANJO";

    include_once 'cambiarcontra.php';
}

if ($_POST['orden'] ==  "cambiar" ){
    // Se cambiar si la contraseña antigua es correcta
    // Y las nuevas contraseñas son iguales sino volvemos
    // a mostrar cambiarcontra
    session_destroy();
    include_once 'resultado.php';
}
