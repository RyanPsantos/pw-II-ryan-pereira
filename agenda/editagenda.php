<?php
$bd = new mysqli('localhost', 'root', '', 'agenda');

if ($bd->connect_error) {
    echo "Erro: Falha ao conectar ao banco de dados. " . $bd->connect_error;
    exit();
}

// Verificar se o ID foi recebido e validar como inteiro
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "Erro: ID nao recebido.";
    exit();
}

// Buscar o nome, telefone e email atuais do contato
$sqlContato = "SELECT nome, telefone, email FROM contatos WHERE id = $id";
$resultContato = $bd->query($sqlContato);

if ($resultContato->num_rows == 0) {
    echo "Erro: Contato não encontrado no banco de dados.";
    exit();
}

$contato = $resultContato->fetch_assoc();
$nomeOriginal = $contato['nome'];
$telefoneOriginal = $contato['telefone'];
$emailOriginal = $contato['email'];

// validar e atualizar os dados no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    // Atualizar o nome, se o novo nome foi recebido
    if (isset($_POST['novo_nome'])) {
        $novoNome = trim($_POST['novo_nome']);
        $novoNome = filter_var($novoNome, FILTER_SANITIZE_STRING);

        if ($novoNome === '') {
            echo "Erro: Novo nome não pode ser vazio.";
            exit();
        }

        $sqlUpdateNome = "UPDATE contatos SET nome = '$novoNome' WHERE id = $id";
        $resultUpdateNome = $bd->query($sqlUpdateNome);

        if ($resultUpdateNome === false) {
            echo "Erro: Falha ao atualizar o nome.";
            exit();
        }
    }

    // Atualizar o telefone, se o novo telefone foi recebido
    if (isset($_POST['novo_telefone'])) {
        $novoTelefone = trim($_POST['novo_telefone']);
        $novoTelefone = filter_var($novoTelefone, FILTER_SANITIZE_STRING);

        if ($novoTelefone === '') {
            echo "Erro: Novo telefone não pode ser vazio.";
            exit();
        }

        $sqlUpdateTelefone = "UPDATE contatos SET telefone = '$novoTelefone' WHERE id = $id";
        $resultUpdateTelefone = $bd->query($sqlUpdateTelefone);

        if ($resultUpdateTelefone === false) {
            echo "Erro: Falha ao atualizar o telefone.";
            exit();
        }
    }

    // Atualizar o email, se o novo email foi recebido
    if (isset($_POST['novo_email'])) {
        $novoEmail = trim($_POST['novo_email']);
        $novoEmail = filter_var($novoEmail, FILTER_SANITIZE_EMAIL);

        if (!filter_var($novoEmail, FILTER_VALIDATE_EMAIL)) {
            echo "Erro: Email inválido.";
            exit();
        }

        $sqlUpdateEmail = "UPDATE contatos SET email = '$novoEmail' WHERE id = $id";
        $resultUpdateEmail = $bd->query($sqlUpdateEmail);

        if ($resultUpdateEmail === false) {
            echo "Erro: Falha ao atualizar o email.";
            exit();
        }
    }

    // Redirecionar após a atualização
    header('Location: agenda.php');
    exit();
}

// Fechar a conexão com o banco de dados
$bd->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Editar Contato</title>
    </head>
    <body>
        <h1>Editar Contato</h1>
        <form method="post">
            <div>
                <label for="novo_nome">Nome:</label>
                <input
                    type="text"
                    id="novo_nome"
                    name="novo_nome"
                    value="<?php echo htmlspecialchars($nomeOriginal); ?>"
                    required="required">
            </div>
            <div>
                <label for="novo_telefone">Telefone:</label>
                <input
                    type="text"
                    id="novo_telefone"
                    name="novo_telefone"
                    value="<?php echo htmlspecialchars($telefoneOriginal); ?>"
                    required="required">
            </div>
            <div>
                <label for="novo_email">Email:</label>
                <input
                    type="email"
                    id="novo_email"
                    name="novo_email"
                    value="<?php echo htmlspecialchars($emailOriginal); ?>"
                    required="required">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Atualizar Contato</button>
        </form>
    </body>
</html>