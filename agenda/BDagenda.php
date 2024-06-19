<?php
$bd = new mysqli('localhost', 'root', 'agenda');

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

function editTelefone($id, $email) {
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
$id = isset($_GET['id'] ? intval($_GET['id'])) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';

if ($acao === 'adicionar') {
    adicNome($nome);
    header('Location: BDagenda.php');
    exit();
} elseif ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nomeoriginal = ($_GET['nome']);
    $nome = $_POST['nome'];
    editNome($id, $nome);
    header('Location: BDagenda.php');
}
?>