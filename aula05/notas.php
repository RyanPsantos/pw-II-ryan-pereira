<html>
    <body>
        <form method="POST">
            <label for="n1">Nota 1:
            </label>
            <input type="number" name="n1">
            <br>
            <label for="n2">Nota 2:
            </label>
            <input type="number" name="n2">
            <br>
            <input type="submit">
        </form>
    </body>
</html>

<?php
    function notas($n1, $n2) {
        $result = ($n1 + $n2) / 2;
        if($result >= 6) {
            echo "O aluno foi aprovado! <br>";
        }
        else if($result >= 4) {
            echo "O aluno está em recuperação!";
        }
        else {
            echo "O aluno foi reprovado!";
        }
    }
    if(isset($_POST["n1"]) && isset($_POST["n2"])) {
        notas($_POST["n1"], $_POST["n2"]);
    }
?>