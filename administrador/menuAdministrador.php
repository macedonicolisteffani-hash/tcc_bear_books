<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador Bear Books</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <nav class="navbar navbar-dark">
        <div class="container">

            <a class="navbar-brand" href="menuAdministrador.php">
                <strong>Bear Books</strong>
            </a>

            <div>
                <a class="btn btn-outline-light me-2" href="PerfilAdministrador.php">
                    <i class="bi bi-person-circle"></i> Perfil
                </a>

                <a class="btn btn-danger" href="logout.php">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </a>
            </div>

        </div>
    </nav>

    <div class="container text-center mt-4">
        <img src="../ARQUIVOS/img/logo.png" width="150" class="mb-3">

        <h1 class="titulo-pagina">
            Painel do Administrador
        </h1>

        <p>
            Bem-vindo ao painel administrativo do Bear Books.
        </p>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row g-4 cards-dashboard">

            <div class="col-12 col-sm-6 col-lg-4">
                <a href="usuarioadm/gerenciaradm.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-person-badge-fill fs-1"></i>
                            <h5 class="mt-3">Administradores</h5>
                            <p class="mb-0">Gerencie os administradores do sistema.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <a href="livroadm/gerenciarlivroAdm.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-book-fill fs-1"></i>
                            <h5 class="mt-3">Livros</h5>
                            <p class="mb-0">Gerencie os livros cadastrados.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <a href="categoria/gerenciarCategoria.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-tags-fill fs-1"></i>
                            <h5 class="mt-3">Categorias</h5>
                            <p class="mb-0">Gerencie as categorias dos livros.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <a href="classificacao/gerenciarClassificacao.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-bookmark-star-fill fs-1"></i>
                            <h5 class="mt-3">Classificação</h5>
                            <p class="mb-0">Gerencie as classificações dos livros.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <a href="comentario/gerenciarComentarios.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-chat-dots-fill fs-1"></i>
                            <h5 class="mt-3">Comentários</h5>
                            <p class="mb-0">Visualize e modere os comentários.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <a href="usuario/gerenciarUsuarios.php" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-people-fill fs-1"></i>
                            <h5 class="mt-3">Usuários</h5>
                            <p class="mb-0">Visualize os usuários cadastrados.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <footer class="footer">
        <p class="mb-0">© 2026 Bear Books - Painel Administrativo</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>