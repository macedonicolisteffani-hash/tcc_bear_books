<?php

session_start();

include "../../ARQUIVOS/conexao.php";

/* Verifica login */
if(!isset($_SESSION['id_user'])){
    header("Location: ../loginUsuario.php");
    exit;
}

/* Verifica dados */
if(
    !isset($_POST['id_livro']) ||
    !isset($_POST['comentario'])
){
    header("Location: ../catalogo.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$id_livro = (int) $_POST['id_livro'];
$comentario = trim($_POST['comentario']);

/* Não aceita comentário vazio */
if($comentario == ""){
    header("Location: ../detalhesLivro.php?id=".$id_livro);
    exit;
}

/* Cadastra comentário */
$sql = "INSERT INTO comentario
(id_user,id_liv,comentario)
VALUES (?,?,?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "iis",
    $id_user,
    $id_livro,
    $comentario
);

$stmt->execute();

/* Volta para o livro */
header("Location: ../detalhesLivro.php?id=".$id_livro);
exit;

?>