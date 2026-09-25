<?php
/*Código de busca*/
include "../../ARQUIVOS/conexao.php";

$sql = "SELECT * FROM categoria";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categoria</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <!-- Menu -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../MenuAdministrador.php">
                <img src="../../ARQUIVOS/img/logo.png" class="me-3">
            </a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../MenuAdministrador.php">
                    <i class="bi bi-house-door-fill"></i> Home do ADM
                </a>
            </div>
        </div>
    </nav>

    <!-- Título e formulário -->
    <div class="container cadastro-conteudo">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-5 cadastro-titulo">
                <h1>Gerenciar Categorias</h1>
                <p>Cadastre e gerencie as categorias dos livros.</p>
            </div>

            <div class="col-sm-12 col-md-7">
                <div class="card cadastro-formulario p-4 shadow">
                    <h4>Nova Categoria</h4>

                    <!-- Formulário de cadastro -->
                    <form method="post" action="insertCategoria.php">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="categoria" name="nome_categoria"
                                placeholder="Insira a sua Categoria" required>
                        </div>

                        <div class="text-center">
                            <button type="reset" class="btn btn-cancelar me-3">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela -->
    <div class="container cadastro-tabela">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <h2>Categorias Cadastradas</h2>

                <div class="table-responsive">
                    <table class="table table-striped-columns table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Categoria</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $id_categoria = $row['id_categoria'];
                                ?>

                                <tr>
                                    <td><?php echo $row['nome_categoria']; ?></td>

                                    <td class="text-center">

                                        <!-- Botão para abrir o modal -->
                                        <button type="button" class="btn p-0" data-bs-toggle="modal"
                                            data-bs-target="#editarCategoria<?php echo $id_categoria; ?>">
                                            <img src="../../ARQUIVOS/img/lapis.png" width="30" height="30">
                                        </button>

                                        <!-- Botão para excluir -->
                                        <a href="deleteCategoria.php?id_categoria=<?php echo $id_categoria; ?>"
                                            onclick="return confirm('Deseja realmente excluir a categoria <?php echo $row['nome_categoria']; ?>?');">
                                            <img src="../../ARQUIVOS/img/lixeira.png" width="30" height="30">
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal para editar -->
                                <div class="modal fade" id="editarCategoria<?php echo $id_categoria; ?>" tabindex="-1"
                                    aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Título do modal -->
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Categoria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Formulário de edição -->
                                            <form method="post" action="updateCategoria.php">

                                                <div class="modal-body">

                                                    <!-- Guarda o ID da categoria -->
                                                    <input type="hidden" name="id_categoria"
                                                        value="<?php echo $id_categoria; ?>">

                                                    <label for="nome_categoria<?php echo $id_categoria; ?>"
                                                        class="form-label">
                                                        Categoria
                                                    </label>

                                                    <!-- Mostra o nome atual -->
                                                    <input type="text" class="form-control"
                                                        id="nome_categoria<?php echo $id_categoria; ?>"
                                                        name="nome_categoria" value="<?php echo $row['nome_categoria']; ?>"
                                                        required>
                                                </div>

                                                <!-- Botões do modal -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        Salvar alterações
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="footer">
        <p class="mb-0">© 2026 Bear Books - Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>