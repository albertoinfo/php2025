<?php

include_once "Coche.php";

const META = 5500;         // 500 kilómetros

$parrilla= [];            // Array de coches

// Creo 5 coches
$parrilla [] = new Coche ("Ferrari",300);
$parrilla [] = new Coche ("600",100);
$parrilla [] = new Coche ("BMW",220);
$parrilla [] = new Coche ("Seat",150);
$parrilla [] = new Coche ("La Cabra",10);

// Test de pruebas todos deben generar errores

$c1 = $parrilla[0];
$c2 = $parrilla[1];
$c1->acelera(10);
$c2->frena(20);
$c1->parar();
$c2->recorre();

// Arranquen los motores
foreach ($parrilla as $coche){
    $coche->arrancar();
}

// Comienza la carrera !!!!
do {
    for ($i = 0; $i < count($parrilla); $i++) {
        $parrilla[$i]->acelera(random_int(0, 20));
        $parrilla[$i]->recorre();
        $parrilla[$i]->frena(random_int(0,10));
        //echo " <br> ".$parrilla[$i]->info();
    }
    
} while ( ! alcanzarMeta ( $parrilla, META) );


// Ordena la tabla para mostrar la clasificación
ordenarClasificacion ( $parrilla);

// usort($parrilla, array ("Coche","compara"));
echo "<br> CLASIFICACIÓN : <br> ";

// Muestra la clasificación
for($p=1,$i=count($parrilla)-1; $i>=0; $i--,$p++){
    echo $p."º Clasificado ". $parrilla[$i]->info()."<br>";
}

// MÉTODOS AUXILIARES
// Devuelve verdadero si hay algun coche que haya recorrido la distancia indicada.

function alcanzarMeta ( array $tcoches, int $distancia):bool{
   $fin = false;
   foreach ($tcoches as $coche) {
       if ( $coche->getKilometros() >= $distancia){
           $fin = true;
           break;
       }
   }
   return $fin;
}

function ordena($a, $b) {
    return $a->getKilometros() - $b->getKilometros();
}

// Ordeno la tabla de objetos por los kilometros recorridos
// OJO hay que pasarlo por REFERENCIA 
function ordenarClasificacion ( array &$tcoches):void{
    
    // Uso una función anónima
    usort($tcoches,function($a, $b) {
        return $a->getKilometros() - $b->getKilometros();});
    // Otras indicando clase y método de clase para comparar 
    //usort($tcoches, array ("Coche","compara"));
}
