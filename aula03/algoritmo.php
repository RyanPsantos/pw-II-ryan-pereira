
<h1>Par ou Ímpar:</h1>

<?php



for ($valor = 25; $valor <= 60; $valor++) {
    
    if($valor % 2 == 0){
    echo $valor, " é par. <br>";
}
    else{
    echo $valor, " é impar. <br>";
}
}

 
?>