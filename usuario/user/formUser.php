<?php
/*Aqui virá o código de busca utilizando o comando SQL - Nesta Mudança faremos apenas a conexão aqui, o código ficará embaixo*/
include "../conexao.php"; 

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário User</title>
<style>
    body{
        font-family:Arial;
        text-align:center;
        background-color:#f2f2f2;
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
    

    <h2>Cadastro de Usuário </h2>

<form method="post" action="insertUser.php" enctype="multipart/form-data">

   
    <input type="hidden" name="id_user" class="caixa" value="<?=$cadastro_adm['id_user']?>"><br>

    CPF:<br>
    <input type="text" name="cpf_user" class="caixa"><br>

    Nome:<br>
    <input type="text" name="nome_user" class="caixa"><br>

    E-mail:<br>
    <input type="email" name="email_user" class="caixa"><br>

    Senha:<br>
    <input type="password" name="senha_user" class="caixa"><br>
    


<!--Botõs de Enviar e Limpar-->
    <input type="submit" value="CADASTRAR" class="caixa">
    <input type="reset" value="CANCELAR" class="caixa">





</form>

<!--Inicio da Tabela de visualização de usuário-->
<table>
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
        </tr>
    </thead>

<!--A partir da segunda linha da tabelaos dados serão em PHP e virão do banco de dados-->
    <tbody>
        <?php
            //Verifica se há registros retornados//
            $sql = "SELECT * FROM usuario";
            $result = $conn->query($sql);
                
            while ($row = $result->fetch_assoc()){
                    //Na linha abaixo ele solicita que o campo chave primaria seja adicionada dentro de uma variável PHP para utilizar uma condição
                    $id_user = $row['id_user'];
                    //Dentro dos colchetes na sequência abaixo virá o nome do campo da tabela que exibirá os dados do banco
                    echo "<tr>
                    
                            <td>{$row['id_user']}</td>
                            <td>{$row['cpf_user']}</td>
                            <td>{$row['nome_user']}</td>
                            <td>{$row['email_user']}</td>
                            <td>{$row['senha_user']}</td>
                         <td>
                            <a href='editarUser.php?id_user=$id_user'>
                            <img src='img/lapis.png' 
                            width='20' height='20'>
                            </a>




                            <a href='deleteUser.php?id_user=$id_user'
                            onclick=\"return confirm('Deseja realmente excluir o Usuário
                            {$row['nome_user']}?');\">
                            <img src='imag/lixeira.png'
                            width='20' height='20'>

                            
                            </a>

                            </td>
                         </tr>";
             }
             
            
            
        ?>
    </tbody>

</table>

</div>

</body>
</html>