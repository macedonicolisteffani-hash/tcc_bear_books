<?php
/* Conexão com o banco */
include "../../ARQUIVOS/conexao.php";


/* Busca as editoras no banco */
$sql_editora = "SELECT * FROM editora";
$result_editora = $conn->query($sql_editora);


/* Busca as classificações no banco */
$sql_classificacao = "SELECT * FROM classificacao";
$result_classificacao = $conn->query($sql_classificacao);


/* Busca as categorias no banco */
$sql_categoria = "SELECT * FROM categoria";
$result_categoria = $conn->query($sql_categoria);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livro</title>

    <!-- Bootstrap 5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS do projeto -->
    <link rel="stylesheet" href="../../css/style.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="../MenuAdministrador.php">
              <img src="../../ARQUIVOS/img/logo.png" class="me-3">
            </a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../MenuAdministrador.php">
                    <i class="bi bi-house-door-fill"></i>
                    Home do ADM
                </a>
            </div>

        </div>
    </nav>


    <!-- FORMULÁRIO -->

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">

            <div class="col-sm-12 col-md-10 col-lg-8">
                <div class="card card-formulario p-4 shadow">


                    <h2 class="titulo-formulario">Cadastro de Livro</h2>


                    <form method="post" action="insertlivroAdm.php" enctype="multipart/form-data">

                        <div class="row">


                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="titulo" class="form-label ">
                                    Título do livro:
                                </label>
                                <input type="text" class="form-control" id="titulo" name="titulo_livro"
                                    placeholder="Digite aqui..." required>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="isbn" class="form-label">
                                    ISBN:
                                </label>
                                <input type="text" class="form-control" id="isbn" name="isbn"
                                    placeholder="Digite o ISBN" required>
                            </div>



                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="ano" class="form-label">
                                    Ano:
                                </label>
                                <input type="text" class="form-control" id="ano" name="ano_livro"
                                    placeholder="Digite aqui..." required>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="autor" class="form-label ">
                                    Autor:
                                </label>
                                <input type="text" class="form-control" id="autor" name="autor"
                                    placeholder="Digite aqui..." required>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="classificacao" class="form-label">
                                    Classificação:
                                </label>
                                <select name="id_classificacao" id="classificacao" class="form-select" required>
                                    <option value="">
                                        Selecione a classificação
                                    </option>


                                    <?php

                                    while ($classificacao = $result_classificacao->fetch_assoc()) {
                                        echo "<option value='{$classificacao['id_classificacao']}'>{$classificacao['nome_classificacao']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="categoria" class="form-label ">
                                    Categoria:
                                </label>
                                <select name="id_categoria" id="categoria" class="form-select" required>
                                    <option value="">
                                        Selecione a categoria
                                    </option>


                                    <?php

                                    while ($categoria = $result_categoria->fetch_assoc()) {
                                        echo "<option value='{$categoria['id_categoria']}'>{$categoria['nome_categoria']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="descricao" class="form-label ">
                                    Descrição:
                                </label>
                                <textarea class="form-control" id="descricao" name="descricao_livro" rows="3"
                                    placeholder="Digite aqui..." style="resize: none;" required></textarea>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="paginas" class="form-label">
                                    Número de páginas:
                                </label>
                                <input type="number" class="form-control" id="paginas" name="paginas_livro"
                                    placeholder="Digite aqui..." required>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="editora" class="form-label ">
                                    Editora:
                                </label>
                                <select name="id_editora" id="editora" class="form-select" required>
                                    <option value="">
                                        Selecione a editora
                                    </option>


                                    <?php

                                    while ($editora = $result_editora->fetch_assoc()) {
                                        echo "<option value='{$editora['id_editora']}'>{$editora['nome_editora']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                                <label for="edicao" class="form-label ">
                                    Edição:
                                </label>
                                <input type="number" class="form-control" id="edicao" name="edicao_livro"
                                    placeholder="Digite aqui..." required>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label class="form-label d-block">
                                    Status do livro:
                                </label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="status[]" id="destaque"
                                        value="destaque">
                                    <label class="form-check-label" for="destaque">
                                        Destaque
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="status[]" id="novidade"
                                        value="novidade">
                                    <label class="form-check-label" for="novidade">
                                        Novidade
                                    </label>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="pdf" class="form-label ">
                                    Arquivo PDF:
                                </label>
                                <input type="file" class="form-control" id="pdf" name="arquivo_pdf" required>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="imagem" class="form-label ">
                                    Arquivo imagem:
                                </label>
                                <input type="file" class="form-control" id="imagem" name="arquivo_imagem" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 text-center mt-3">

                                <a href="gerenciarlivroAdm.php" class="btn btn-cancelar me-3">
                                    Cancelar
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>

                            </div>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->

    <footer class="footer">
        <p class="mb-0">
            © 2026 Bear Books - Todos os direitos reservados.
        </p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>