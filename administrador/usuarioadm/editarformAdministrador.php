<?php
include "../../ARQUIVOS/conexao.php";

$id_adm = $_GET['id_adm'];

$sql = "SELECT * FROM cadastro_adm WHERE id_adm = $id_adm";
$result = $conn->query($sql);
$administrador = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Administrador</title>
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

                <div class="card card-formulario p-4 shadow" >

                    <h2 class="titulo-formulario">Edição de Administrador</h2>

                    <form method="post" action="updateAdministrador.php" enctype="multipart/form-data">

                        <input type="hidden" name="id_adm" value="<?= $administrador['id_adm'] ?>">

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="CPF" class="form-label ">CPF</label>
                                <input type="text" class="form-control" id="CPF" name="cpf_adm"
                                    placeholder="Insira seu CPF" value="<?= $administrador['cpf_adm'] ?>" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="nome" class="form-label ">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome_adm"
                                    placeholder="Insira seu nome" value="<?= $administrador['nome_adm'] ?>" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="email" class="form-label ">Email</label>
                                <input type="email" class="form-control" id="email" name="email_adm"
                                    placeholder="Insira seu e-mail" value="<?= $administrador['email_adm'] ?>" required>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="senha" class="form-label ">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha_adm"
                                    placeholder="Insira sua senha" value="<?= $administrador['senha_adm'] ?>" required>
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