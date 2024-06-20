<?php

    $bd = new mysqli('localhost', 'root', '', 'crud');

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

    //para buscar o nome atual
    $sql = "SELECT nome FROM contatos WHERE id = $id";
    $resultnome = $bd->query($sql);

    $sql = "SELECT telefone FROM contatos WHERE id = $id";
    $resultfone = $bd->query($sql);

    $sql = "SELECT email FROM contatos WHERE id = $id";
    $resultemail = $bd->query($sql);

    if ($resultnome->num_rows == 0) {
        echo "Erro: Nome não encontrado no banco de dados.";
        exit();
    }
    if ($resultfone->num_rows == 0) {
        echo "Erro: Número não encontrado no banco de dados.";
        exit();
    }
    if ($resultemail->num_rows == 0) {
        echo "Erro: Email não encontrado no banco de dados.";
        exit();
    }

