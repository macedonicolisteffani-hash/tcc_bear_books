<?php
/*Código para excluir a editora*/
include "../../ARQUIVOS/conexao.php";

$id_editora = $_GET['id_editora'];

$sql = "DELETE FROM editora WHERE id_editora = $id_editora";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarEditora.php");
} else {
    echo "Erro ao excluir editora: " . $conn->error;
}

?>