<?php
include "../../ARQUIVOS/conexao.php";

$id_user = $_GET['id_user'];
$status = $_GET['status'];

$sql = "UPDATE usuario SET
status_user = '$status'
WHERE id_user = $id_user";

$conn->query($sql);

header("Location: gerenciarUsuarios.php");
exit;
?>