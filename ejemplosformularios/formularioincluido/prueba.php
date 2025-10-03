<?php
ob_start();
$num=1;
if ( $num == 1) {
echo " Hola";
} else {
echo " Adios";
}
$m = ob_get_clean();

echo " Saludo:".$m;

?>