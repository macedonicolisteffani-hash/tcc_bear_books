<?php
/*Aqui virá o código de busca utilizando o comando SQL - Nesta Mudança faremos apenas a conexão aqui, o código ficará embaixo*/
include "../../ARQUIVOS/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Administradores</title>

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


    <!-- Inicio da Tabela de visualização de usuário -->
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="titulo-pagina">Administradores Cadastrados</h2>

            <a href="formAdministrador.php" class="btn btn-adicionar">
                <i class="bi bi-plus-lg"></i>
                Adicionar Administrador
            </a>

        </div>

        <div class="row justify-content-center">

            <div class="col-sm-12 col-md-10 col-lg-8">

                <div class="table-responsive">

                    <table class="table table-striped-columns table-bordered">

                        <thead class="text-center">
                            <tr>
                                <th>CPF</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            /* Verifica se há registros retornados */
                            $sql = "SELECT * FROM cadastro_adm";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {

                                /* Chave primária */
                                $id_adm = $row['id_adm'];

                                echo "<tr>

                            <td>{$row['cpf_adm']}</td>
                            <td>{$row['nome_adm']}</td>
                            <td>{$row['email_adm']}</td>

                            <td class='text-center'>

                                <a href='editarFormAdministrador.php?id_adm=$id_adm'>
                                    <img src='../../ARQUIVOS/img/lapis.png' width='30' height='30'>
                                </a>

                                <a href='deleteAdministrador.php?id_adm=$id_adm'
                                    onclick=\"return confirm('Deseja realmente excluir o Administrador {$row['nome_adm']}?');\">
                                    <img src='../../ARQUIVOS/img/lixeira.png' width='30' height='30'>
                                </a>

                            </td>

                        </tr>";
                            }

                            ?>

                        </tbody>

                    </table>

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