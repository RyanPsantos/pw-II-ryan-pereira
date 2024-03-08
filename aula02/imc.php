<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício IMC</title>
</head>
<body>
    <?php
        $peso = 59;
        $altura = 1.73;
        $imc = $peso / pow($altura, 2);

        switch($imc){
            
            case($imc < 18.5):
            echo "magro de ruim";
            break;

            case($imc < 25):
            echo "peso normal";
            break;

            case($imc < 30):
            echo "Obesidade grau III";
            break;

            case($imc < 40):
            echo "Obesidade grau II";
            break;

            case($imc >= 40):
            echo "Obesidade grau III";
            break;

        }

        echo "<p>Peso: $peso kg</p>";
        echo "<p>Altura: $altura cm</p>";
        echo "<p>IMC: $imc</p>";
    ?>
</body>
</html>