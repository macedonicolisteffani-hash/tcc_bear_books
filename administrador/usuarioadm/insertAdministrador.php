<?php
//Importar o arquivo de conexão, fora da pasta
include "../../ARQUIVOS/conexao.php";

/*Neste trecho do código está sendo criado uma variável em PHP $ 
para receber através do método POST o name HTML*/
$id_adm = $_POST['id_adm'];
$cpf_adm = $_POST['cpf_adm'];
$nome_adm = $_POST['nome_adm'];
$email_adm = $_POST['email_adm'];
$senha_adm = $_POST['senha_adm'];

$sql = "INSERT INTO cadastro_adm (id_adm,cpf_adm,nome_adm,email_adm,senha_adm) 
VALUES ('$id_adm','$cpf_adm','$nome_adm','$email_adm','$senha_adm')";

if($conn->query($sql) === TRUE){
    echo "<script>
    alert('Dados Cadastrados com Sucesso!');
    window.location.href='formAdministrador.php';
    </script>";
}else{
    echo 'Erro ao inserir:'.$conn->error;
}

?>
