<?php
//Importar o arquivo de conexão, fora da pasta
include "../../ARQUIVOS/conexao.php";

/*Neste trecho do código está sendo criado uma variável em PHP $ 
para receber através do método POST o name HTML*/

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


/*Receber o status*/

if (isset($_POST['status'])) {
    $status = implode(", ", $_POST['status']);
} else {
    $status = "";
}


/*Receber os arquivos*/

$nome_pdf = $_FILES['arquivo_pdf']['name'];
$nome_imagem = $_FILES['arquivo_imagem']['name'];


/*Criar as pastas*/

$pasta_pdf = "../../ARQUIVOS/pdf_livros/";
$pasta_imagem = "../../ARQUIVOS/capas/";

if (!is_dir($pasta_pdf)) {
    mkdir($pasta_pdf, 0777, true);
}

if (!is_dir($pasta_imagem)) {
    mkdir($pasta_imagem, 0777, true);
}


/*Mover os arquivos*/

move_uploaded_file(
    $_FILES['arquivo_pdf']['tmp_name'],
    $pasta_pdf . $nome_pdf
);

move_uploaded_file(
    $_FILES['arquivo_imagem']['tmp_name'],
    $pasta_imagem . $nome_imagem
);


/*Comando para inserir os dados no banco*/

$sql = "INSERT INTO cadastro_liv (titulo,isbn,descricao,id_editora,autor,id_classificacao,ano,num_pagina,edicao,id_categoria,foto_capa,pdf_livro,status) 
VALUES ('$titulo','$isbn','$descricao','$id_editora','$autor','$id_classificacao','$ano','$num_pagina','$edicao','$id_categoria','$nome_imagem','$nome_pdf','$status')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Dados Cadastrados com Sucesso!');
    window.location.href='gerenciarlivroAdm.php';
    </script>";
} else {
    echo "Erro ao inserir:</h2>";
    echo  $conn->error;
}

?>