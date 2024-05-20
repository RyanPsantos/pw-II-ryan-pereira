<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Agenda</title>
    </head>
    <body>
        <h1>Agenda de Contatos</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = htmlspecialchars($_POST['nome']);
        $telefone = htmlspecialchars($_POST['telefone']);
        $email = htmlspecialchars($_POST['email']);
        
        // Validação simples esta verificando se os campos foram preenchidos
        if (!empty($nome) && !empty($telefone) && !empty($email)) {
            $contato = [$nome, $telefone, $email];
            
            /* Abre o arquivo CSV para escrita, o Arquivo csv é criado para testar 
            se o form ta funcionando se tiver ele vai abrir um arquivo excel na pasta 
            fiz so por equanto ja que precisamos do BD */
            $file = fopen('contatos.csv', 'a');
            
            // Escreve os dados do contato no arquivo CSV
            fputcsv($file, $contato);
            
            // Fecha o arquivo
            fclose($file);
            
            echo "<p style='color:green;'>Contato adicionado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Por favor, preencha todos os campos.</p>";
        }
    }
    ?>

        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required="required"><br><br>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required="required"><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required="required"><br><br>

            <input type="submit" value="Adicionar Contato">
        </form>
    </body>
</html>