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
    !isset($_POST['id_comentario']) ||
    !isset($_POST['id_livro'])
){
    header("Location: ../catalogo.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$id_comentario = (int) $_POST['id_comentario'];
$id_livro = (int) $_POST['id_livro'];

/* Exclui somente comentário do próprio usuário */
$sql = "DELETE FROM comentario
WHERE id_comentario=?
AND id_user=?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ii",
    $id_comentario,
    $id_user
);

$stmt->execute();

/* Volta para o livro */
header("Location: ../detalhesLivro.php?id=".$id_livro);
exit;

?>