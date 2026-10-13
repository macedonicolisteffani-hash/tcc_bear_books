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

    <title>Sobre - Bear Books</title>

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

                        <a class="nav-link active" href="sobre.php">

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

    <!-- Hero -->
    <section class="hero-sobre">

        <div class="container">

            <div class="hero-conteudo">

                <div class="hero-icone">

                    <i class="bi bi-book-half"></i>

                </div>

                <span class="hero-tag">
                    CONHEÇA A BEAR BOOKS
                </span>

                <h1>
                    Sobre a
                    <span>Bear Books</span>
                </h1>

                <p>
                    Uma biblioteca digital criada para aproximar
                    pessoas dos livros, da leitura e do conhecimento.
                </p>

            </div>

        </div>

    </section>

    <!-- Conteúdo -->
    <main class="sobre">

        <div class="container">

            <!-- Objetivo -->
            <section class="objetivo">

                <div class="card card-destaque">

                    <div class="card-body">

                        <div class="icone-card">

                            <i class="bi bi-book-half"></i>

                        </div>

                        <div>

                            <span class="mini-titulo">
                                NOSSA MISSÃO
                            </span>

                            <h2>
                                Nosso objetivo
                            </h2>

                            <p>
                                A <strong>Bear Books</strong> é uma biblioteca
                                digital desenvolvida com o objetivo de facilitar
                                o acesso aos livros e tornar a experiência de
                                encontrar uma obra literária mais simples,
                                rápida e organizada.
                            </p>

                            <p>
                                Nossa plataforma reúne diferentes livros em
                                um único espaço, permitindo que os usuários
                                pesquisem e conheçam obras de diferentes
                                autores e gêneros.
                            </p>

                            <p>
                                Além de facilitar o acesso à literatura,
                                o projeto busca incentivar o hábito da leitura
                                e mostrar como a tecnologia pode aproximar
                                as pessoas dos livros e do conhecimento.
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Banner -->
                <div class="banner-leitura">

                    <div class="banner-texto">

                        <span>
                            DESCUBRA NOVAS HISTÓRIAS
                        </span>

                        <h2>
                            Mais que livros,<br>
                            novas perspectivas.
                        </h2>

                        <p>
                            Explore diferentes obras e encontre
                            novas ideias em um só lugar.
                        </p>

                        <a href="catalogo.php" class="btn-banner">

                            Explorar catálogo
                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                    <div class="banner-livro">

                        <i class="bi bi-book"></i>

                    </div>

                </div>

            </section>

            <!-- Plataforma e equipe -->
            <section class="row g-4 mt-1">

                <!-- Plataforma -->
                <div class="col-lg-6">

                    <div class="card card-sobre h-100">

                        <div class="card-body">

                            <div class="icone-card">

                                <i class="bi bi-laptop"></i>

                            </div>

                            <span class="mini-titulo">
                                O PROJETO
                            </span>

                            <h2>
                                Sobre a plataforma
                            </h2>

                            <p>
                                A Bear Books foi criada como um projeto
                                acadêmico, unindo literatura e tecnologia
                                em uma biblioteca digital.
                            </p>

                            <p>
                                Durante o desenvolvimento, foram utilizados
                                conhecimentos de programação, desenvolvimento
                                web, organização de informações e criação
                                de interfaces.
                            </p>

                            <p>
                                O resultado é uma plataforma pensada para
                                ser simples, agradável e fácil de utilizar.
                            </p>

                            <div class="informacao">

                                <i class="bi bi-code-slash"></i>

                                <span>
                                    Plataforma acadêmica de desenvolvimento web
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Equipe -->
                <div class="col-lg-6">

                    <div class="card card-sobre h-100">

                        <div class="card-body">

                            <div class="icone-card">

                                <i class="bi bi-people-fill"></i>

                            </div>

                            <span class="mini-titulo">
                                QUEM SOMOS
                            </span>

                            <h2>
                                Nossa equipe
                            </h2>

                            <div class="equipe">

                                <!-- Jhulia -->
                                <div class="membro">

                                    <div class="avatar">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <div>

                                        <h5>
                                            Jhulia
                                        </h5>

                                        <p>
                                            Integrante da equipe
                                            responsável pelo
                                            desenvolvimento da
                                            Bear Books.
                                        </p>

                                    </div>

                                </div>

                                <!-- Pedro -->
                                <div class="membro">

                                    <div class="avatar">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <div>

                                        <h5>
                                            Pedro
                                        </h5>

                                        <p>
                                            Integrante da equipe
                                            responsável pelo
                                            desenvolvimento da
                                            Bear Books.
                                        </p>

                                    </div>

                                </div>

                                <!-- Nicoli -->
                                <div class="membro">

                                    <div class="avatar">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <div>

                                        <h5>
                                            Nicoli
                                        </h5>

                                        <p>
                                            Integrante da equipe
                                            responsável pelo
                                            desenvolvimento da
                                            Bear Books.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Frase -->
            <section class="frase">

                <i class="bi bi-quote"></i>

                <h2>
                    "Um livro pode abrir portas
                    para mundos que ainda não conhecemos."
                </h2>

                <p>
                    Bear Books
                </p>

            </section>

        </div>

    </main>

    <!-- Footer -->
<footer class="footer-principal">

    <div class="container">

        <div class="row g-4">

            <!-- Bear Books -->
            <div class="col-lg-4 col-md-6">

                <div class="footer-marca">

                    <img src="../ARQUIVOS/img/logo.png"
                    alt="Bear Books">

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

            <!-- Fale conosco -->
            <div class="col-lg-3 col-md-6">

                <div class="footer-fale">

                    <h5>Precisa de ajuda?</h5>

                    <p>
                        Tem alguma dúvida ou sugestão?
                        Entre em contato com nossa equipe.
                    </p>

                    <a href="faleconosco.php"
                    class="btn-footer-contato">

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