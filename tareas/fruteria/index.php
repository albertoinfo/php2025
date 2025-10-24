<?php
session_start();

// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedidos' => array asociativo fruta => cantidad

// Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = array();
}

// No hay definido un cliente todavía en la session 
if (!isset($_SESSION['cliente'])) {
    require_once 'bienvenida.php';
    exit();
}


// Proceso las acciones 
if (isset($_POST["accion"])) {
    $fruta = $_POST["fruta"];
    $cantidad = (int)$_POST["cantidad"];

    switch ($_POST["accion"]) {
        case " Anotar ":
            // Actualizo la tabla de pedidos en la sesión
            if ($cantidad > 0) {
                if (isset($_SESSION['pedidos'][$fruta])) {
                    $_SESSION['pedidos'][$fruta] += $cantidad;
                } else {
                    $_SESSION['pedidos'][$fruta] = $cantidad;
                }
            }
            break;
        case " Anular ":
            // Vacío la tabla de pedidos de la fruta  la sesión
            unset($_SESSION['pedidos'][$fruta]);
            break;
        case " Terminar ":
            // Destruyo la sesión y vuelvo a la página de bienvenida
            $compraRealizada = htmlTablaPedidos();
            require_once 'despedida.php';
            session_destroy();
            exit();
         
    }
}

$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string
{
    global $precio;
    $msg = "";
    
    if (count($_SESSION['pedidos']) > 0) {
        $msg .= "Este es su pedido :<br>";
        $msg .= "<table style='border: 1px solid black;'>";
        foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
            $msg .= "<tr><td><b>" . $fruta . "</b><td> ". 
            $cantidad."</td></tr>";
           
        }
        $msg .= "</table>";
    } else {
        $msg .= "No ha realizado ningún pedido.";
    }
    return $msg;
}
