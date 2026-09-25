<?php
include "../../ARQUIVOS/conexao.php";

$id_adm = $_GET['id_adm'];

$sql = "DELETE FROM cadastro_adm WHERE
id_adm=$id_adm";

$conn->query($sql);

header("Location: gerenciaradm.php");

?>