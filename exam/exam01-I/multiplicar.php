<?php
$nombres = ["uno","dos","tres","cuatro","cinco","seis","siete","ocho","nuevo","diez"];
$tmulti =[];
// Recorro la tabla de nombres de números
for ($i=0;$i <10; $i++){
    // Genera la multiplicar de cada número
    $valores=[];
    for ($j=1;$j<=10;$j++){
        // Ojo $i+1 porque la tabla $nombres empieza por la posición 0
        $valores[$j]=($i+1)*$j;
    }
    $tmulti[$nombres[$i]]=$valores;
}

echo "<pre>";
print_r($tmulti);
echo "</pre>";