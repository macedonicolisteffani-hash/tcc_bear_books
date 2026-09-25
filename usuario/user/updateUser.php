<?php
include "../../ARQUIVOS/conexao.php";

/* As variáveis criadas do PHP recebem o name do HTML */
$id_user = $_POST['id_user'];
$cpf_user = $_POST['cpf_user'];
$nome_user = $_POST['nome_user'];
$email_user = $_POST['email_user'];
$senha_user = $_POST['senha_user'];

$sql = "UPDATE usuario SET 
id_user = '$id_user', 
cpf_user = '$cpf_user',
nome_user = '$nome_user',
email_user = '$email_user'
senha_user = '$senha_user'
WHERE id_user=$id_user";

if($conn->query($sql) === TRUE){
    echo "<script>
    alert('Dados editados com Sucesso!');
    window.location.href='formUser.php';
    </script>";
}else{
    echo 'Erro ao inserir:'.$conn->error;
}

?>