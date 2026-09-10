<?php
include "../../ARQUIVOS/conexao.php";

/* As variáveis criadas do PHP recebem o name do HTML */
$id_liv = $_POST['id_liv'];
$titulo = $_POST['titulo_livro'];
$isbn = $_POST['isbn'];
$descricao = $_POST['descricao_livro'];
$id_editora = $_POST['id_editora'];
$autor = $_POST['autor'];
$id_classificacao = $_POST['id_classificacao'];
$ano = $_POST['ano_livro'];
$num_pagina = $_POST['paginas_livro'];
$edicao = $_POST['edicao_livro'];
$id_categoria = $_POST['id_categoria'];

/* Receber o status */

if(isset($_POST['status'])){
    $status = implode(", ", $_POST['status']);
}else{
    $status = "";
}

$sql = "UPDATE cadastro_liv SET 
titulo = '$titulo',
isbn = '$isbn',
descricao = '$descricao',
id_editora = '$id_editora',
autor = '$autor',
id_classificacao = '$id_classificacao',
ano = '$ano',
num_pagina = '$num_pagina',
edicao = '$edicao',
id_categoria = '$id_categoria',
status = '$status'
WHERE id_liv=$id_liv";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Dados editados com Sucesso!');
    window.location.href='gerenciarlivroAdm.php';
    </script>";
} else {
    echo 'Erro ao inserir:' . $conn->error;
}

?>