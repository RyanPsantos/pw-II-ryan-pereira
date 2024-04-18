<html>
    <body>
        <form method="POST">
            <label for="n1">Primeiro número:
            </label>
            <input type="number" name="n1"><br>
            <label for="n2">Segundo número:
            </label>
            <input type="number" name="n2"><br>
            <input type="submit">
        </form>
    </body>
</html>

<?php
    function some($n1, $n2) {
        $soma = $n1 + $n2;
    if($soma < 0) {
        echo "Resultado: 0. <br>"; 
    }else {
        echo "$n1 + $n2 = $soma <br>";
    }
    }
    if(isset($_POST["n1"]) && isset($_POST["n2"])) {
    some($_POST["n1"], $_POST["n2"]);
    }
?> 