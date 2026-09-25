<?php
/*Código para atualizar a classificação*/
include "../../ARQUIVOS/conexao.php";

$id_classificacao = $_POST['id_classificacao'];
$nome_classificacao = $_POST['nome_classificacao'];

$sql = "UPDATE classificacao SET nome_classificacao = '$nome_classificacao' WHERE id_classificacao = $id_classificacao";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarClassificacao.php");
} else {
    echo "Erro ao atualizar classificação: " . $conn->error;
}

?>