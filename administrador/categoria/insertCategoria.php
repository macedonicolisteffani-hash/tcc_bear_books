<?php
/*Aqui virá o código para inserir a categoria*/
include "../../ARQUIVOS/conexao.php";

$nome_categoria = $_POST['nome_categoria'];

$sql = "INSERT INTO categoria (nome_categoria) VALUES ('$nome_categoria')";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarCategoria.php");
} else {
    echo "Erro ao cadastrar categoria: " . $conn->error;
}

?>