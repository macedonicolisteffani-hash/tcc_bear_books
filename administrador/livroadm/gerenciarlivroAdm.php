<?php
/*Aqui virá o código de busca utilizando o comando SQL - Nesta Mudança faremos apenas a conexão aqui, o código ficará embaixo*/
include "../../ARQUIVOS/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Livros</title>

    <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
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


    <!-- Inicio da visualização dos livros -->

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="titulo-pagina">Livros Cadastrados</h2>

            <a href="formlivroAdm.php" class="btn btn-adicionar">
                <i class="bi bi-plus-lg"></i>
                Adicionar Livro
            </a>

        </div>


        <div class="table-responsive tabela-livros">

            <table class="table table-hover">

                <thead class="text-center">

                    <tr>
                        <th>Capa</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    /* Busca os livros cadastrados */
                    $sql = "SELECT * FROM cadastro_liv";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {

                        $id_liv = $row['id_liv'];

                        $imagem = !empty($row['foto_capa']) ?
                            "../../ARQUIVOS/capas/" . $row['foto_capa'] :
                            "../../ARQUIVOS/img/semfoto.png";

                        ?>

                        <tr>

                            <td class="text-center">
                                <img src="<?php echo $imagem; ?>" class="capa-livro">
                            </td>

                            <td>
                                <?php echo $row['titulo']; ?>
                            </td>

                            <td>
                                <?php echo $row['autor']; ?>
                            </td>

                            <td class="text-center">
                                <?php echo $row['ano']; ?>
                            </td>

                            <td class="text-center">

                                <a href="editarformlivroAdm.php?id_liv=<?php echo $id_liv; ?>">
                                    <img src="../../ARQUIVOS/img/lapis.png" width="30" height="30">
                                </a>

                                <a href="deletelivroAdm.php?id_liv=<?php echo $id_liv; ?>"
                                    onclick="return confirm('Deseja realmente excluir o livro <?php echo $row['titulo']; ?>?');">
                                    <img src="../../ARQUIVOS/img/lixeira.png" width="30" height="30">
                                </a>

                            </td>

                        </tr>

                        <?php
                    }

                    ?>

                </tbody>

            </table>

        </div>

    </div>


    <footer class="footer">
        <p class="mb-0">© 2026 Bear Books - Todos os direitos reservados.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>