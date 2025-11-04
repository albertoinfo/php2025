<?php 
session_start();

if (!isset($_SESSION['usuario']) && !isset($_POST['orden'])){
    include_once 'acceso.html';
    die();
}

if ($_POST['orden'] ==  "entrar" ){
    $_SESSION['usuaria'] = "JUANJO";
    include_once 'cambiarcontra.html';
}

if ($_POST['orden'] ==  "cambiar" ){
    session_destroy();
    include_once 'resultado.html';
}
