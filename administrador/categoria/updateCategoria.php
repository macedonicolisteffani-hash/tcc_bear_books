<?php
/*Código para atualizar a categoria*/
include "../../ARQUIVOS/conexao.php";

$id_categoria = $_POST['id_categoria'];
$nome_categoria = $_POST['nome_categoria'];

$sql = "UPDATE categoria SET nome_categoria = '$nome_categoria' WHERE id_categoria = $id_categoria";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarCategoria.php");
} else {
    echo "Erro ao atualizar categoria: " . $conn->error;
}

?>