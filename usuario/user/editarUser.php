<?php
include "../conexao.php";
$cpf_adm = $_GET['cpf_user'];

$sql="SELECT * FROM usuario
WHERE cpf_user= $cpf_user";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Formulário de Alteração de Administrador</title>

<style>
body{
    font-family:Arial;
    background-color:#f2f2f2;
    text-align:center;
}
.container{
    background:white;
    width:600px;
    margin:auto;
    margin-top:30px;
    padding:20px;
    border-radius:10px;
}
.caixa{
    width:80%;
    padding:5px;
    margin:5px;
}
img{
    width:100px;
    margin-bottom:10px;
}
.grupo{
    text-align:left;
    width:80%;
    margin:auto;
}
.grupo label{
    display:block;
    margin:5px 0;
}
</style>

</head>
<body>

<div class="container">

<img src="img/logo.png">    

<h2>Edição de User</h2>

<form method="post" action="updateAdm.php" enctype="multipart/form-data">
    CPF:<br>
    <input type="number" name="cpf_user" class="caixa" value="<?= $admin['cpf_user']?>"><br>
      
    Nome:<br>
    <input type="text" name="nome_user" class="caixa" value="<?= $admin['nome_user']?>"><br>
    
    Email:<br>
    <input type="email" name="email_user" class="caixa" value="<?= $admin['email_user']?>"><br>
    
    <br>  
    Senha:<br>
    <input type="password" name="senha_user" class="caixa" value="<?= $admin['senha_user']?>">
    <br>
    <br>
<!--Botões de Enviar e Limpar-->
<input type="submit" value="EDITAR" class="caixa">

</form>