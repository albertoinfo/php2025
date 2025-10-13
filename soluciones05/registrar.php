<?php
// Funciones auxilires  
// ------------------------------------------------------------------
function estaVacio($valor)
{
   return true;
}

function hayMayusculas($valor)
{
   
    return false;
}

function hayMinusculas($valor)
{
   
    return false;
}

function hayDigito($valor)
{
    
    return false;
}

function hayNoAlfanumerico($valor)
{
   
    return false;
}

function postvalor(string $elemento): string
{
    if (isset($_POST[$elemento])) {
        $resu = $_POST[$elemento];
    } else {
        $resu = "";
    }
    return $resu;
}
//--------------------------------------------------------------------
// Proceso los datos
$msg = " POR GENERAR ---";
$registrado = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    // No hay valores vacios
   
    // No es un email
    

    // Validando contraseña
   
    // Contraseña Pasado todos los controles
    // $registrado = true;
    
} // PETICIÓN POST

?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
    <title>Registrar Usuario</title>
</head>

<body>
    <div id="container" style="width: 600px;">
        <div id="header">
            <h1>FORMULARIO DE REGISTRO</h1>
        </div>


        <div id="content">
            <?php if (!$registrado): ?>
                <form method="post">
                    <fieldset>
                        <legend>Datos para registrar:</legend>
                        Nombre:
                        <input type="text" name="nombre" placeholder="Nombre"
                            value="<?= postvalor('nombre') ?>" size="10"><br>
                        Correo electrónico:
                        <input type="text" name="email" placeholder="Correo electrónico"
                            value="<?= postvalor('email')  ?>" size="15"><br>
                        Contraseña
                        <input type="text" name="contraseña1" placeholder="Contraseña"
                            value="<?= postvalor('contraseña1')  ?>" size="10"><br>
                        Contraseña
                        <input type="text" name="contraseña2" placeholder="Contraseña"
                            value="<?= postvalor('contraseña2') ?>" size="10"> (Repetir )<br>
                        <input type="submit" value="Enviar" />
                        <input type="reset" value="Limpiar" />
                    </fieldset>
                </form>
                <?= $msg ?>
            <?php else: ?>
                Sus datos son correctos. <br><b> Ha sido registrado en el sistema.<b><br>
            <?php endif ?>
        </div>
    </div>
</body>

</html>