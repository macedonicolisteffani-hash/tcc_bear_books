<?php
include "../../ARQUIVOS/conexao.php";

$id_liv = $_GET['id_liv'];

$sql = "SELECT * FROM cadastro_liv WHERE id_liv = $id_liv";
$result = $conn->query($sql);
$livro = $result->fetch_assoc();

/* Verifica o status do livro */
$status = explode(", ", $livro['status']);

/* Buscar classificações */
$sql_classificacao = "SELECT * FROM classificacao";
$result_classificacao = $conn->query($sql_classificacao);

/* Buscar categorias */
$sql_categoria = "SELECT * FROM categoria";
$result_categoria = $conn->query($sql_categoria);

/* Buscar editoras */
$sql_editora = "SELECT * FROM editora";
$result_editora = $conn->query($sql_editora);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>

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
                <img src="../../ARQUIVOS/img/logo.png" width="80" class="me-3">
            </a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../MenuAdministrador.php">
                    <i class="bi bi-house-door-fill"></i>
                    Home do ADM
                </a>
            </div>

        </div>
    </nav>


    <div class="container mt-5 mb-5">

        <div class="row justify-content-center">

            <div class="col-sm-12 col-md-10 col-lg-8">

                <div class="card card-formulario p-4 shadow">

                    <h2 class="titulo-formulario">Edição de Livro</h2>

                    <form method="post" action="updatelivroAdm.php" enctype="multipart/form-data">

                        <input type="hidden" name="id_liv" value="<?= $livro['id_liv'] ?>">

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo_livro"
                                    placeholder="Insira o título do livro"
                                    value="<?= $livro['titulo'] ?>" required>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn"
                                    placeholder="Insira o ISBN"
                                    value="<?= $livro['isbn'] ?>" required>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="ano" class="form-label">Ano</label>
                                <input type="number" class="form-control" id="ano" name="ano_livro"
                                    placeholder="Insira o ano"
                                    value="<?= $livro['ano'] ?>" required>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor"
                                    placeholder="Insira o autor"
                                    value="<?= $livro['autor'] ?>" required>
                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="classificacao" class="form-label">Classificação</label>

                                <select class="form-select" id="classificacao" name="id_classificacao" required>

                                    <option value="">Selecione a classificação</option>

                                    <?php
                                    while ($classificacao = $result_classificacao->fetch_assoc()) {

                                        $selecionado = "";

                                        if ($classificacao['id_classificacao'] == $livro['id_classificacao']) {
                                            $selecionado = "selected";
                                        }

                                        echo "<option value='{$classificacao['id_classificacao']}' $selecionado>
                                            {$classificacao['nome_classificacao']}
                                        </option>";
                                    }
                                    ?>

                                </select>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="categoria" class="form-label">Categoria</label>

                                <select class="form-select" id="categoria" name="id_categoria" required>

                                    <option value="">Selecione a categoria</option>

                                    <?php
                                    while ($categoria = $result_categoria->fetch_assoc()) {

                                        $selecionado = "";

                                        if ($categoria['id_categoria'] == $livro['id_categoria']) {
                                            $selecionado = "selected";
                                        }

                                        echo "<option value='{$categoria['id_categoria']}' $selecionado>
                                            {$categoria['nome_categoria']}
                                        </option>";
                                    }
                                    ?>

                                </select>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="descricao" class="form-label">Descrição</label>

                                <textarea class="form-control" id="descricao" name="descricao_livro"
                                    rows="5" required><?= $livro['descricao'] ?></textarea>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="paginas" class="form-label">Número de páginas</label>

                                <input type="number" class="form-control" id="paginas" name="paginas_livro"
                                    placeholder="Insira o número de páginas"
                                    value="<?= $livro['num_pagina'] ?>" required>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="editora" class="form-label">Editora</label>

                                <select class="form-select" id="editora" name="id_editora" required>

                                    <option value="">Selecione a editora</option>

                                    <?php
                                    while ($editora = $result_editora->fetch_assoc()) {

                                        $selecionado = "";

                                        if ($editora['id_editora'] == $livro['id_editora']) {
                                            $selecionado = "selected";
                                        }

                                        echo "<option value='{$editora['id_editora']}' $selecionado>
                                            {$editora['nome_editora']}
                                        </option>";
                                    }
                                    ?>

                                </select>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="edicao" class="form-label">Edição</label>

                                <input type="number" class="form-control" id="edicao" name="edicao_livro"
                                    placeholder="Insira a edição"
                                    value="<?= $livro['edicao'] ?>" required>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label class="form-label">Status</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="status[]" value="destaque"
                                        id="destaque"
                                        <?php if (in_array("destaque", $status)) echo "checked"; ?>>

                                    <label class="form-check-label" for="destaque">
                                        Destaque
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="status[]" value="novidade"
                                        id="novidade"
                                        <?php if (in_array("novidade", $status)) echo "checked"; ?>>

                                    <label class="form-check-label" for="novidade">
                                        Novidade
                                    </label>
                                </div>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="pdf" class="form-label">Arquivo PDF</label>

                                <input type="file" class="form-control" id="pdf" name="arquivo_pdf">

                                <small>Deixe vazio caso não queira alterar o PDF.</small>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">

                                <label for="imagem" class="form-label">Imagem da capa</label>

                                <input type="file" class="form-control" id="imagem" name="arquivo_imagem">

                                <small>Deixe vazio caso não queira alterar a capa.</small>

                            </div>


                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">

                                <button type="submit" class="btn btn-primary me-4">
                                    Editar
                                </button>

                                <button type="reset" class="btn btn-cancelar">
                                    Apagar
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <footer class="footer">
        <p class="mb-0">© 2026 Bear Books - Todos os direitos reservados.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>