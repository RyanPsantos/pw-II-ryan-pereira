
<h1>Fibonacci: </h1>

<?php

$numeros = array("0", "1", "1", "2", "3", "5", "8", "13", "21", "34");

for($sequencia = 0; $sequencia <= 9; $sequencia++) {

    echo "Números: ", $numeros[$sequencia], "<br>";

    echo  "<br>";

}


echo "<br>", "<br>";

 echo "<h1>2º Método:</h1>";

switch($numeros) {

    case($numeros != 999): echo "Primeiro Número: ", $numeros[0], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Segundo Número: ", $numeros[1], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Terceiro Número: ", $numeros[2], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Quarto Número: ", $numeros[3], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Quinto Número: ", $numeros[4], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Sexto Número: ", $numeros[5], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Sétimo Número: ", $numeros[6], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Oitavo Número: ", $numeros[7], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Nono Número: ", $numeros[8], "<br>";
    echo  "<br>";

    case($numeros != 999): echo "Décimo Número: ", $numeros[9], "<br>";
    echo  "<br>";

    break;
}

?>