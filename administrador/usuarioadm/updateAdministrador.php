<?php
include "../conexao.php";

/* As variáveis criadas do PHP recebem o name do HTML */
$id_adm = $_POST['id_adm'];
$cpf_adm = $_POST['cpf_adm'];
$nome_adm = $_POST['nome_adm'];
$email_adm = $_POST['email_adm'];
$senha_adm = $_POST['senha_adm'];

$sql = "UPDATE cadastro_adm SET 
cpf_adm = '$cpf_adm',
nome_adm = '$nome_adm',
email_adm = '$email_adm',
senha_adm = '$senha_adm'
WHERE id_adm=$id_adm";

if($conn->query($sql) === TRUE){
    echo "<script>
    alert('Dados editados com Sucesso!');
    window.location.href='formAdministrador.php';
    </script>";
}else{
    echo 'Erro ao inserir:'.$conn->error;
}

?>