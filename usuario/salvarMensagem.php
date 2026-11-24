<?php

session_start();

include "../ARQUIVOS/conexao.php";


/* Só aceita envio pelo formulário */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: faleconosco.php");
    exit;
}


/* Recebe os dados */

$nome = trim($_POST['nome'] ?? "");
$email = trim($_POST['email'] ?? "");
$assunto = trim($_POST['assunto'] ?? "");
$mensagem = trim($_POST['mensagem'] ?? "");


/* Verifica campos vazios */

if (
    empty($nome) ||
    empty($email) ||
    empty($assunto) ||
    empty($mensagem)
) {

    header("Location: faleconosco.php?erro=campos");
    exit;
}


/* Verifica o e-mail */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    header("Location: faleconosco.php?erro=email");
    exit;
}


/* Insere a mensagem no banco */

$sql = "INSERT INTO mensagem_contato
(nome, email, assunto, mensagem)
VALUES (?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    die("Erro no prepare: " . $conn->error);
}


$stmt->bind_param(
    "ssss",
    $nome,
    $email,
    $assunto,
    $mensagem
);


/* Executa */

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: faleconosco.php?sucesso=1");
    exit;
} else {

    die("Erro ao salvar mensagem: " . $stmt->error);
}
