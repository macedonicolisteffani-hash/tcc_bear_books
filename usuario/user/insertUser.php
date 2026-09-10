<?php
//Importar o arquivo de conexão, fora da pasta
include "../conexao.php";

/*Neste trecho do código está sendo criado uma variável em PHP $ 
para receber através do método POST o name HTML*/
$id_user = $_POST['id_user'];
$cpf_user = $_POST['cpf_user'];
$nome_user = $_POST['nome_user'];
$email_user = $_POST['email_user'];
$senha_user = $_POST['senha_user'];

$sql = "INSERT INTO cadastro_adm (id_adm,cpf_adm,nome_adm,email_adm,senha_adm) 
VALUES ('$id_user','$cpf_user','$nome_user','$email_user','$senha_user')";

if($conn->query($sql) === TRUE){
    echo "<script>
    alert('Dados Cadastrados com Sucesso!');
    window.location.href='formUser.php';
    </script>";
}else{
    echo 'Erro ao inserir:'.$conn->error;
}
