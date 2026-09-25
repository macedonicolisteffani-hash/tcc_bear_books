<?php
/*Aqui virá o código de busca utilizando o comando SQL - Nesta Mudança faremos apenas a conexão aqui, o código ficará embaixo*/
include "../../ARQUIVOS/conexao.php";

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Administrador</title>
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


    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-8">

                <div class="card card-formulario p-4 shadow">

                    <h2 class="titulo-formulario">Cadastro de Administrador</h2>
                    <form method="post" action="insertAdministrador.php" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4 mt-4">
                                <label for="CPF" class="form-label ">CPF</label>
                                <input type="text" class="form-control" id="CPF" name="cpf_adm"
                                    placeholder="insira seu CPF" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="nome" class="form-label ">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome_adm"
                                    placeholder="insira seu nome" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="email" class="form-label ">Email</label>
                                <input type="email" class="form-control" id="email" name="email_adm"
                                    placeholder="insira seu e-mail" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="senha" class="form-label ">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha_adm"
                                    placeholder="Insira sua Senha" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 text-center mt-3">

                                <a href="gerenciaradm.php" class="btn btn-cancelar me-3">
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

    <footer class="footer">
        <p class="mb-0">© 2026 Bear Books - Todos os direitos reservados.</p>
    </footer>
</body>

</html>