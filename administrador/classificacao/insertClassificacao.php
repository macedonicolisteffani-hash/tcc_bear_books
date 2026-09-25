<?php
/*Código para cadastrar a classificação*/
include "../../ARQUIVOS/conexao.php";

$nome_classificacao = $_POST['nome_classificacao'];

$sql = "INSERT INTO classificacao (nome_classificacao) VALUES ('$nome_classificacao')";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarClassificacao.php");
} else {
    echo "Erro ao cadastrar classificação: " . $conn->error;
}

?>