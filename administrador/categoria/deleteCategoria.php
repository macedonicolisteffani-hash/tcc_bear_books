<?php
/*Código para excluir a categoria*/
include "../../ARQUIVOS/conexao.php";

$id_categoria = $_GET['id_categoria'];

$sql = "DELETE FROM categoria WHERE id_categoria = $id_categoria";

if ($conn->query($sql) === TRUE) {
    header("Location: gerenciarCategoria.php");
} else {
    echo "Erro ao excluir categoria: " . $conn->error;
}

?>