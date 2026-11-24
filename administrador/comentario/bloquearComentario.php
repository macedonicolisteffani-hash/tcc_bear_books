<?php

include "../../ARQUIVOS/conexao.php";

if(!isset($_GET['id_comentario'])){
    header("Location: gerenciarComentario.php");
    exit;
}

$id_comentario = (int) $_GET['id_comentario'];

$sql = "SELECT status_comentario
FROM comentario
WHERE id_comentario=?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $id_comentario
);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows === 0){
    header("Location: gerenciarComentario.php");
    exit;
}

$comentario = $result->fetch_assoc();

if($comentario['status_comentario'] == "Ativo"){
    $novo_status = "Bloqueado";
}else{
    $novo_status = "Ativo";
}

$sql = "UPDATE comentario
SET status_comentario=?
WHERE id_comentario=?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "si",
    $novo_status,
    $id_comentario
);

$stmt->execute();

header("Location: gerenciarComentario.php");
exit;

?>