<?php
/*Código para excluir a classificação*/
include "../../ARQUIVOS/conexao.php";

$id_classificacao = $_GET['id_classificacao'];

$sql = "DELETE FROM classificacao WHERE id_classificacao = $id_classificacao";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarClassificacao.php");
} else {
    echo "Erro ao excluir classificação: " . $conn->error;
}

?>