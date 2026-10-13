<?php
session_start();

$nome_usuario = "";

if (isset($_SESSION['usuario'])) {
    $nome_usuario = ucwords(trim($_SESSION['usuario']));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fale Conosco - Bear Books</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand" href="index.php">

                <img src="../ARQUIVOS/img/logo.png" alt="Bear Books">

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">

                        <a class="nav-link" href="index.php">
                            Início
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="catalogo.php">
                            Catálogo
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="sobre.php">
                            Sobre
                        </a>

                    </li>

                    <?php if (isset($_SESSION['id_user'])) { ?>

                        <li class="nav-item ms-lg-4">

                            <a class="nav-link usuario-navbar" href="user/perfilUser.php">

                                Olá,
                                <?php echo htmlspecialchars($nome_usuario); ?>

                            </a>

                        </li>

                    <?php } else { ?>

                        <li class="nav-item ms-lg-4">

                            <a class="nav-link" href="loginUsuario.php">
                                Entrar
                            </a>

                        </li>

                    <?php } ?>

                </ul>

            </div>

        </div>

    </nav>


    <!-- Fale Conosco -->
    <main>

        <section class="contato">

            <div class="container">

                <div class="row g-4 align-items-stretch">

                    <!-- Formulário -->
                    <div class="col-lg-8">

                        <div class="formulario-contato">

                            <h1>Entre em contato</h1>

                            <p class="subtitulo">
                                Preencha o formulário abaixo e fale com a equipe Bear Books.
                            </p>

                            <form>

                                <div class="row g-4">

                                    <!-- Nome -->
                                    <div class="col-md-6">

                                        <label for="nome" class="form-label">

                                            <i class="bi bi-person"></i>
                                            Nome

                                        </label>

                                        <input type="text" class="form-control" id="nome" name="nome"
                                            placeholder="Digite seu nome" required>

                                    </div>

                                    <!-- E-mail -->
                                    <div class="col-md-6">

                                        <label for="email" class="form-label">

                                            <i class="bi bi-envelope"></i>
                                            E-mail

                                        </label>

                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Digite seu e-mail" required>

                                    </div>

                                </div>


                                <!-- Assunto -->
                                <div class="mt-4">

                                    <label for="assunto" class="form-label">

                                        <i class="bi bi-chat-left-text"></i>
                                        Assunto

                                    </label>

                                    <input type="text" class="form-control" id="assunto" name="assunto"
                                        placeholder="Digite o assunto" required>

                                </div>


                                <!-- Mensagem -->
                                <div class="mt-4">

                                    <label for="mensagem" class="form-label">

                                        <i class="bi bi-pencil-square"></i>
                                        Mensagem

                                    </label>

                                    <textarea class="form-control" id="mensagem" name="mensagem" rows="6"
                                        placeholder="Digite sua mensagem..." required></textarea>

                                </div>


                                <!-- Botão -->
                                <div class="mt-4">

                                    <button type="submit" class="btn btn-enviar">

                                        <i class="bi bi-send"></i>
                                        Enviar mensagem

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>


                    <!-- Informações -->
                    <div class="col-lg-4">

                        <div class="fundofale">

                            <div class="icone-contato">

                                <i class="bi bi-chat-heart"></i>

                            </div>

                            <h2>
                                Fale Conosco
                            </h2>

                            <p>
                                Tem alguma dúvida ou sugestão?
                            </p>

                            <p>
                                Entre em contato com a Bear Books!
                                Estamos aqui para ajudar você a encontrar
                                seus próximos livros e tornar sua experiência
                                em nossa biblioteca digital cada vez melhor.
                            </p>


                            <!-- E-mail -->
                            <div class="informacao">

                                <i class="bi bi-envelope"></i>

                                <div>

                                    <strong>
                                        E-mail
                                    </strong>

                                    <span>
                                        contato@bearbooks.com
                                    </span>

                                </div>

                            </div>


                            <!-- Biblioteca -->
                            <div class="informacao">

                                <i class="bi bi-book"></i>

                                <div>

                                    <strong>
                                        Biblioteca
                                    </strong>

                                    <span>
                                        Explore nosso catálogo
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- Footer -->
    <footer class="footer-principal">

        <div class="container">

            <div class="row g-4">

                <!-- Bear Books -->
                <div class="col-lg-4 col-md-6">

                    <div class="footer-marca">

                        <img src="../ARQUIVOS/img/logo.png" alt="Bear Books">

                        <p>
                            Uma biblioteca digital criada para
                            aproximar você dos livros, da leitura
                            e de novas histórias.
                        </p>

                    </div>

                </div>


                <!-- Navegação -->
                <div class="col-lg-2 col-md-6">

                    <div class="footer-links">

                        <h5>Navegação</h5>

                        <a href="index.php">
                            Início
                        </a>

                        <a href="catalogo.php">
                            Catálogo
                        </a>

                        <a href="sobre.php">
                            Sobre
                        </a>

                    </div>

                </div>


                <!-- Contato -->
                <div class="col-lg-3 col-md-6">

                    <div class="footer-contato">

                        <h5>Contato</h5>

                        <p>
                            <i class="bi bi-envelope"></i>
                            contato@bearbooks.com
                        </p>

                        <p>
                            <i class="bi bi-book"></i>
                            Biblioteca digital
                        </p>

                    </div>

                </div>


                <!-- Fale Conosco -->
                <div class="col-lg-3 col-md-6">

                    <div class="footer-fale">

                        <h5>Precisa de ajuda?</h5>

                        <p>
                            Tem alguma dúvida ou sugestão?
                            Entre em contato com nossa equipe.
                        </p>

                        <a href="faleconosco.php" class="btn-footer-contato">

                            <i class="bi bi-chat-heart"></i>
                            Fale Conosco

                        </a>

                    </div>

                </div>

            </div>


            <div class="footer-linha"></div>


            <div class="footer-final">

                <p>
                    © 2026 Bear Books - Todos os direitos reservados.
                </p>

                <span>
                    Literatura e tecnologia em um só lugar.
                </span>

            </div>

        </div>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>