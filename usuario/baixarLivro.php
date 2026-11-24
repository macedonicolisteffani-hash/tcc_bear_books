<?php
session_start();
include "../ARQUIVOS/conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    header("Location: loginUsuario.php");
    exit;
}

// Verifica se recebeu o ID do livro
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: catalogo.php");
    exit;
}

$id_livro = (int) $_GET['id'];
$id_user = (int) $_SESSION['id_user'];

// Busca o livro no banco
$sql = "SELECT titulo, pdf_livro FROM cadastro_liv WHERE id_liv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_livro);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: catalogo.php");
    exit;
}

$livro = $result->fetch_assoc();

if (empty($livro['pdf_livro'])) {
    die("PDF não encontrado.");
}

// Verifica se o arquivo existe
$nome_pdf = basename($livro['pdf_livro']);

$pasta_pdf = realpath(__DIR__ . "/../ARQUIVOS/pdf_livros");
$arquivo = realpath($pasta_pdf . DIRECTORY_SEPARATOR . $nome_pdf);

if (!$pasta_pdf || !$arquivo || strpos($arquivo, $pasta_pdf . DIRECTORY_SEPARATOR) !== 0 || !is_file($arquivo)) {
    die("Arquivo PDF não encontrado.");
}

// Registra o download no banco
$sql_download = "INSERT INTO downloads_liv (id_user, id_livro, data) VALUES (?, ?, CURDATE())";
$stmt_download = $conn->prepare($sql_download);
$stmt_download->bind_param("ii", $id_user, $id_livro);

if (!$stmt_download->execute()) {
    die("Não foi possível registrar o download.");
}

// Envia o PDF para o navegador
header("Content-Type: application/pdf");
header('Content-Disposition: attachment; filename="' . $nome_pdf . '"');
header("Content-Length: " . filesize($arquivo));

readfile($arquivo);
exit;
