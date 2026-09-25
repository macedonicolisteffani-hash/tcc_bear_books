<?php
/*Código para atualizar a editora*/
include "../../ARQUIVOS/conexao.php";

$id_editora = $_POST['id_editora'];
$nome_editora = $_POST['nome_editora'];

$sql = "UPDATE editora SET nome_editora = '$nome_editora' WHERE id_editora = $id_editora";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarEditora.php");
} else {
    echo "Erro ao atualizar editora: " . $conn->error;
}

?>