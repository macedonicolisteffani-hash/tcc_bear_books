<?php
include "../ARQUIVOS/conexao.php";

if (!isset($_GET['id'])) {
    header("Location: catalogo.php");
    exit;
}

$id_livro = (int) $_GET['id'];

$sql = "SELECT titulo, pdf_livro
FROM cadastro_liv
WHERE id_liv = ?";

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

$nome_pdf = basename($livro['pdf_livro']);

$caminho =
    "../ARQUIVOS/pdf_livros/" . $nome_pdf;

if (!file_exists($caminho)) {
    die("Arquivo PDF não encontrado.");
}

header("Content-Type: application/pdf");

header(
    'Content-Disposition: attachment; filename="' .
    $nome_pdf . '"'
);

header("Content-Length: " . filesize($caminho));

readfile($caminho);

exit;
?>