<?php

session_start();

include "../ARQUIVOS/conexao.php";

if (!isset($_SESSION['id_user'])) {
    exit;
}

if (!isset($_POST['id_livro']) || !isset($_POST['pagina'])) {
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$id_livro = (int) $_POST['id_livro'];
$pagina = (int) $_POST['pagina'];

if ($id_livro <= 0 || $pagina <= 0) {
    exit;
}

$sql = "INSERT INTO progresso_leitura
(id_user, id_liv, pagina_atual, data_atualizacao)
VALUES (?, ?, ?, NOW())

ON DUPLICATE KEY UPDATE
pagina_atual = VALUES(pagina_atual),
data_atualizacao = NOW()";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "iii",
    $id_user,
    $id_livro,
    $pagina
);

$stmt->execute();
