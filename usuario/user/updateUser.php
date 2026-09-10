<?php
include "../conexao.php";

/* As variáveis criadas do PHP recebem o name do HTML */
$id_user = $_POST['id_user'];
$cpf_user = $_POST['cpf_user'];
$nome_user = $_POST['nome_user'];
$email_user = $_POST['email_user'];
$senha_user = $_POST['senha_user'];

$sql = "UPDATE usuario SET 
id_adm = '$id_user', 
cpf_adm = '$cpf_user',
nome_adm = '$nome_user',
email_adm = '$email_user'
senha_adm = '$senha_user'
WHERE id_adm=$id_user";

if($conn->query($sql) === TRUE){
    echo "<script>
    alert('Dados editados com Sucesso!');
    window.location.href='formUser.php';
    </script>";
}else{
    echo 'Erro ao inserir:'.$conn->error;
}

?>