<?php
include "../../ARQUIVOS/conexao.php";

$id_liv = $_GET['id_liv'];

$sql ="DELETE FROM cadastro_liv WHERE
id_liv=$id_liv";

$conn->query($sql);

header("Location:formlivroAdm.php");

?>