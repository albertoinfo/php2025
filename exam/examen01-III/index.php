<?php
include_once 'funcionesOOP.php';
session_start();

if ( isset ($_SESSION["tiempolimite"]) ){
    if ( time() > $_SESSION["tiempolimite"]  ){
        session_destroy();
    } else {
        $_SESSION["tiempo"] = $_SESSION["tiempolimite"] - time();
        include 'bienvenido.php';
        exit();     
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET"){
    include "acceso.php";
} else {
    // Proceso el formulario
    $nombre = $_POST["username"];
    $clave = $_POST["password"];
    $tiempo = $_POST["time"];
    if ( accesoValido($nombre,$clave)){
        $_SESSION["nombre"] = $nombre;
        $_SESSION["tiempo"] = $tiempo;
        $_SESSION["tiempolimite"] = time() + $tiempo;
        anotarNuevoAcceso($nombre);
        registra($nombre,time());
        include "bienvenido.php";
    } else {
        $msg = " Nombre y contraseña incorrectos";
        include "acceso.php";
    }
    
}
