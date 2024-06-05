<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>Agenda</title>
    </head>
    
    <body>
    <div class="conteudo">
        <h1 class="titulo" class="text-info bg-dark">Agenda de Contatos</h1>

    <?php
    $dsn = 'mysql:host=localhost;dbname=agenda';
    $username = 'root';
    $password = '';

    try{
        //Conexão com BD pelo PDO
        $pdo = new PDO($dsn, $username, $password);

        //caso der erros
        $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

           $nome = $_POST['nome'];
           $telefone = $_POST['telefone'];
           $email = $_POST['email'];

           //Consulta SQL
           $sql = "INSERT INTO contatos (nome, telefone, email)
           VALUES (:nome, :telefone, :email)";

           //prepara a eclaração
           $stmt = $pdo ->prepare($sql);

           $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
           $stmt->bindValue(':telefone', $telefone, PDO::PARAM_STR);
           $stmt->bindValue(':email', $email, PDO::PARAM_STR);

           //Executa a consulta
           $stmt->execute();

           echo "Dados inseridos com sucesso!";

        }
    } catch(PDOExcepticon $e) {
        //mensagem de erro que será mostrada caso dê erro
        echo "Erro: " .$e->getMessage();
    }

    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = htmlspecialchars($_POST['nome']);
        $telefone = htmlspecialchars($_POST['telefone']);
        $email = htmlspecialchars($_POST['email']);
        
        // Validação simples esta verificando se os campos foram preenchidos
        if (!empty($nome) && !empty($telefone) && !empty($email)) {
            $contato = [$nome, $telefone, $email];
            
            /* Abre o arquivo CSV para escrita, o Arquivo csv é criado para testar 
            se o form ta funcionando se tiver ele vai abrir um arquivo excel na pasta 
            fiz so por equanto ja que precisamos do BD 
            $file = fopen('contatos.csv', 'a');
            
            // Escreve os dados do contato no arquivo CSV
            fputcsv($file, $contato);
            
            // Fecha o arquivo
            fclose($file);
            
            echo "<p style='color:green;'>Contato adicionado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Por favor, preencha todos os campos.</p>";
        }
    }*/
    ?>
    <form action="" method="post" novalidate>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="validationCustom01" id="floatingInput" placeholder="nOME">
            <label for="floatingInput" class="lbl_titulo">Nome:</label><br><br>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="telefone" name="telefone"  placeholder="Número" required="required">
            <label for="floatingInput" class="lbl_titulo">Telefone:</label><br><br>
        </div>  

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
            <label for="floatingInput" class="lbl_titulo">Email:</label><br><br>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-primary" id="botao">Adicionar contato</button>
        </div>
        </form>
        </div>
    </body>
</html>