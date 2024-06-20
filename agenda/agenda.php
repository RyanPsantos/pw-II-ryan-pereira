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
$bd = new mysqli('localhost', 'root','', 'agenda');

function getContatos() {
    global $bd;
    $sql = "SELECT * FROM contatos";
    $resultado = $bd->query($sql);
    $contatos = [];
    while ($row = $resultado->fetch_assoc()) {
        $contatos[] = $row;
    }
    return $contatos;
}

function adicNome($nome) {
    global $bd;
    $sql = "INSERT INTO contatos (nome) VALUES ('$nome')";
    $bd->query($sql);
}

function editNome($id, $nome) {
    global $bd;
    $sql = "UPDATE contatos SET nome = '$nome' WHERE id = $id";
    $bd->query($sql);
}

function adicTelefone($tel) {
    global $bd;
    $sql = "INSERT INTO contatos (telefone) VALUES ('$tel')";
    $bd->query($sql);
}

function editTelefone($id, $tel) {
    global $bd;
    $sql = "UPDATE contatos SET telefone = '$tel' WHERE id = $id";
    $bd->query($sql);
}


function adicEmail($email) {
    global $bd;
    $sql = "INSERT INTO contatos (email) VALUES ('$email')";
    $bd->query($sql);
}

function editEmail($id, $email) {
    global $bd;
    $sql = "UPDATE contatos SET email = '$email' WHERE id = $id";
    $bd->query($sql);
}

function excluirDados($id) {
    global $bd;
    $sql = "DELETE FROM contatos WHERE id = $id";
    $bd->query($sql);
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$tel = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

if ($acao === 'adicionar') {
    adicNome($nome);
    adicTelefone($tel);
    adicEmail($email);
    header('Location: bdaenda.php');
    exit();
} elseif ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nomeoriginal = ($_GET['nome']);
    $nome = $_POST['nome'];
    $telloriginal = $_GET['telefone'];
    $tel = $_POST['telefone'];
    $emailoriginal = $_GET['email'];
    $email = $_POST['email']
    editNome($id, $nome);
    editTelefone($id, $tel);
    editEmail($id, $email);
    header('Location: bdagenda.php?id='. $id. 'nome='. $nomeoriginal. 'telefone='. $telloriginal. 'email='. $emailoriginal);
    exit();
} elseif ($acao ==='excluir') {
    excluirDados($id);
    header('Location: bdagenda.php');
    exit();
}
    $contatos = getContatos(); 
?>
    <form action="" method="post" novalidate>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="required">
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
        <div>
        <table border="border">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Ações</th>
        
    </tr>
    <?php foreach ($contatos as $nome): ?>
    <tr>
        <td><?php echo $nome['id']; ?></td>
        <td><?php echo $nome['nome']; ?></td>
        <td><?php echo $tel['telefone']?></td>
        <td><?php echo $email['email']?></td>
        <td>
            <a href="?acao=editar&id=><?php echo $nome['id'];?>
            &nome=<?php echo urlencode($nome['nome']); ?>">Editar</a> |
            <a href="?acao=excluir&id=<?php echo $nome['id']; ?>">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
        </div>
    </body>
</html>