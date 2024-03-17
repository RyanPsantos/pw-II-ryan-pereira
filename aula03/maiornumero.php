<?php

$numeros = array(20, 45, 70, 86, 49);
$result = $numeros[0];

foreach($numeros as $numero) {

if ($numero > $result) {

    $result = $numero;

}

}

echo "Maior número: ". $result;

    




?>