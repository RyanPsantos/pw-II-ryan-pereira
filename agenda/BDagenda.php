<?php
$bd = new mysqli('localhost', 'root', '', 'agenda');

if ($bd->connect_error) {
    echo "Erro: Falha ao conectar ao banco de dados. " . $bd->connect_error;
    exit();
}

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
    header('Location: bdagenda.php');
    exit();
} elseif ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nomeoriginal = $_GET['nome'];
    $nome = $_POST['nome'];
    $teloriginal = $_GET['telefone'];
    $tel = $_POST['telefone'];
    $emailoriginal = $_GET['email'];
    $email = $_POST['email'];
    editNome($id, $nome);
    editTelefone($id, $tel);
    editEmail($id, $email);
    header("Location: bdagenda.php?id=$id&nome=$nomeoriginal&telefone=$teloriginal&email=$emailoriginal");
    exit();
} elseif ($acao === 'excluir') {
    excluirDados($id);
    header('Location: bdagenda.php');
    exit();
}

$contatos = getContatos();
?>