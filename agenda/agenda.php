<?php
$bd = new mysqli('localhost', 'root', '', 'agenda');

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
// criei uma nova function adicionarContato
function adicionarContato($nome, $telefone, $email) {
    global $bd;
    $sql = "INSERT INTO contatos (nome, telefone, email) VALUES ('$nome', '$telefone', '$email')"; 
    $bd->query($sql);
}
 // Criei uma nova function editarContato
function editarContato($id, $nome, $telefone, $email) {
    global $bd;
    $sql = "UPDATE contatos SET nome = '$nome', telefone = '$telefone', email = '$email' WHERE id = $id";
    $bd->query($sql);
}
// Criei uma nova function excluirContato
function excluirContato($id) {
    global $bd;
    $sql = "DELETE FROM contatos WHERE id = $id";
    $bd->query($sql);
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

if ($acao === 'adicionar') {
    adicionarContato($nome, $telefone, $email); //utilizei a nova function criada 
    header('Location: agenda.php'); // mudei para agenda.php
    exit();
} elseif ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    editarContato($id, $nome, $telefone, $email); // utilizei a nova function criada
    header("Location: editagenda.php?id=$id&nome=" . urlencode($nome) . "&telefone=" . urlencode($telefone) . "&email=" . urlencode($email));
    exit();
} elseif ($acao === 'excluir') {
    excluirContato($id); // utilizei a nova function criada 
    header('Location: agenda.php');
    exit();
}

$contatos = getContatos();
?>

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
    <h1 class="text-info bg-dark">Agenda de Contatos</h1>
    
    <form action="?acao=adicionar" method="post" novalidate="novalidate">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="required">
            <label for="nome" class="lbl_titulo">Nome:</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Número" required="required">
            <label for="telefone" class="lbl_titulo">Telefone:</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
            <label for="email" class="lbl_titulo">Email:</label>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary" id="botao">Adicionar contato</button>
        </div>
    </form>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contatos as $contato): ?>
            <tr>
                <td><?php echo $contato['id']; ?></td>
                <td><?php echo $contato['nome']; ?></td>
                <td><?php echo $contato['telefone']; ?></td>
                <td><?php echo $contato['email']; ?></td>
                <td>
                    <a href="?acao=editar&id=<?php echo $contato['id']; ?>&nome=<?php echo urlencode($contato['nome']); ?>&telefone=<?php echo urlencode($contato['telefone']); ?>&email=<?php echo urlencode($contato['email']); ?>" class="btn btn-primary">Editar</a>
                    <a href="?acao=excluir&id=<?php echo $contato['id']; ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
