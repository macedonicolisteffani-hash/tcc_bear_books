<?php
/*Código para cadastrar a editora*/
include "../../ARQUIVOS/conexao.php";

$nome_editora = $_POST['nome_editora'];

$sql = "INSERT INTO editora (nome_editora) VALUES ('$nome_editora')";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarEditora.php");
} else {
    echo "Erro ao cadastrar editora: " . $conn->error;
}

?>