<?php
session_start();
include "../ARQUIVOS/conexao.php";

/* Nome do usuário */
$nome_usuario = "";

if (isset($_SESSION['usuario'])) {
    $nome_usuario = ucwords(trim($_SESSION['usuario']));
}

/* Favoritos */
$favoritos = [];

if (isset($_SESSION['id_user'])) {
    $id_usuario = (int) $_SESSION['id_user'];

    $sql_favoritos = "SELECT id_livro FROM favoritos
    WHERE id_usuario=$id_usuario";

    $result_favoritos = $conn->query($sql_favoritos);

    if ($result_favoritos) {
        while ($fav = $result_favoritos->fetch_assoc()) {
            $favoritos[] = $fav['id_livro'];
        }
    }
}

/* Livros para pesquisa */
$sql_pesquisa = "SELECT id_liv, titulo, autor
FROM cadastro_liv
ORDER BY titulo ASC";

$result_pesquisa = $conn->query($sql_pesquisa);

$livrosPesquisa = [];

if ($result_pesquisa) {
    while ($row = $result_pesquisa->fetch_assoc()) {
        $livrosPesquisa[] = [
            "id" => $row["id_liv"],
            "titulo" => $row["titulo"],
            "autor" => $row["autor"]
        ];
    }
}

/* Novidades */
$sql_novidades = "SELECT * FROM cadastro_liv
WHERE status LIKE '%novidade%'
ORDER BY id_liv DESC
LIMIT 2";

$result_novidades = $conn->query($sql_novidades);

/* Destaques */
$sql_destaques = "SELECT * FROM cadastro_liv
WHERE status LIKE '%destaque%'
ORDER BY id_liv DESC
LIMIT 3";

$result_destaques = $conn->query($sql_destaques);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bear Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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

                                Olá, <?php echo htmlspecialchars($nome_usuario); ?>

                            </a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item ms-lg-4">
                            <a class="nav-link usuario-navbar" href="loginUsuario.php">

                                Entrar

                            </a>
                        </li>

                    <?php } ?>

                </ul>

            </div>

        </div>
    </nav>

    <!-- Banner -->
    <section class="banner-home" style="background-image: url('../ARQUIVOS/img/banner-home.png');">

        <div class="container">

            <div class="row">

                <div class="col-lg-7 col-md-9 col-sm-12 banner-home-conteudo">

                    <p class="banner-home-bemvindo">
                        BEM-VINDO AO
                    </p>

                    <h1>Bear Books</h1>

                    <p class="banner-home-texto">
                        Milhares de histórias, um só lugar.<br>
                        Leia, explore, descubra.
                    </p>

                    <!-- Busca -->
                    <form class="busca-home" id="formBusca">

                        <div class="pesquisa-container">

                            <div class="input-group">

                                <input type="text" class="form-control" id="pesquisaLivro"
                                    placeholder="Buscar livros ou autores..." autocomplete="off">

                                <button type="submit" class="btn-busca-home">

                                    <i class="bi bi-search"></i>

                                </button>

                            </div>

                            <div id="resultadosPesquisa" class="resultados-pesquisa">
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <!-- Novidades -->
    <section class="home-novidades">

        <div class="container">

            <div class="titulo-home">

                <h2>Novidades</h2>

                <a href="catalogo.php">
                    Ver todos
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="row g-4">

                <?php
                if ($result_novidades && $result_novidades->num_rows > 0) {

                    while ($livro = $result_novidades->fetch_assoc()) {

                        $capa = "../ARQUIVOS/img/livroicon.png";

                        if (!empty($livro['foto_capa'])) {
                            $capa = "../ARQUIVOS/capas/" . $livro['foto_capa'];
                        }
                        ?>

                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <div class="card-novidade-home">

                                <div class="row g-0">

                                    <div class="col-4 capa-novidade-container">

                                        <img src="<?php echo htmlspecialchars($capa); ?>"
                                            alt="<?php echo htmlspecialchars($livro['titulo']); ?>">

                                        <?php if (isset($_SESSION['id_user'])) { ?>

                                            <button type="button" class="btn-favorito" data-id="<?php echo $livro['id_liv']; ?>">

                                                <?php if (in_array($livro['id_liv'], $favoritos)) { ?>

                                                    <i class="bi bi-heart-fill"></i>

                                                <?php } else { ?>

                                                    <i class="bi bi-heart"></i>

                                                <?php } ?>

                                            </button>

                                        <?php } else { ?>

                                            <a href="loginUsuario.php" class="btn-favorito">

                                                <i class="bi bi-heart"></i>

                                            </a>

                                        <?php } ?>

                                    </div>

                                    <div class="col-8">

                                        <div class="novidade-conteudo">

                                            <span class="novidade-label">
                                                NOVO
                                            </span>

                                            <h3>
                                                <?php echo htmlspecialchars($livro['titulo']); ?>
                                            </h3>

                                            <p class="novidade-autor">
                                                <?php echo htmlspecialchars($livro['autor']); ?>
                                            </p>

                                            <p class="novidade-ano">
                                                <?php echo htmlspecialchars($livro['ano']); ?>
                                            </p>

                                            <a href="detalhesLivro.php?id=<?php echo $livro['id_liv']; ?>"
                                                class="leia-mais-home">

                                                Saiba mais
                                                <i class="bi bi-arrow-right"></i>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php
                    }
                } else {
                    ?>

                    <p class="text-muted">
                        Nenhum livro marcado como novidade.
                    </p>

                <?php } ?>

            </div>

        </div>

    </section>

    <!-- Carrossel literário -->
    <section class="carrossel-literario">

        <div class="container">

            <div id="carouselLiterario" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

                <!-- Pontinhos -->
                <div class="carousel-indicators">

                    <button type="button" data-bs-target="#carouselLiterario" data-bs-slide-to="0" class="active">
                    </button>

                    <button type="button" data-bs-target="#carouselLiterario" data-bs-slide-to="1">
                    </button>

                    <button type="button" data-bs-target="#carouselLiterario" data-bs-slide-to="2">
                    </button>

                </div>

                <!-- Imagens -->
                <div class="carousel-inner">

                    <div class="carousel-item active">

                        <img src="../ARQUIVOS/img/carrosel1.png" class="d-block w-100" alt="Frase literária">

                    </div>

                    <div class="carousel-item">

                        <img src="../ARQUIVOS/img/carrosel2.png" class="d-block w-100" alt="Frase literária">

                    </div>

                    <div class="carousel-item">

                        <img src="../ARQUIVOS/img/carrosel3.png" class="d-block w-100" alt="Frase literária">

                    </div>

                </div>

                <!-- Seta esquerda -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselLiterario"
                    data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                    <span class="visually-hidden">
                        Anterior
                    </span>

                </button>

                <!-- Seta direita -->
                <button class="carousel-control-next" type="button" data-bs-target="#carouselLiterario"
                    data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>

                    <span class="visually-hidden">
                        Próximo
                    </span>

                </button>

            </div>

        </div>

    </section>







    <!-- Destaques -->
    <section class="home-destaques">

        <div class="container">

            <div class="titulo-home">

                <h2>Destaques</h2>

                <a href="catalogo.php">
                    Ver todos
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="row g-4 justify-content-center">

                <?php
                if ($result_destaques && $result_destaques->num_rows > 0) {

                    while ($livro = $result_destaques->fetch_assoc()) {

                        $capa = "../ARQUIVOS/img/livroicon.png";

                        if (!empty($livro['foto_capa'])) {
                            $capa = "../ARQUIVOS/capas/" . $livro['foto_capa'];
                        }
                        ?>

                        <div class="col-lg-4 col-md-6 col-sm-12">

                            <div class="card-destaque-home">

                                <div class="capa-destaque-container">

                                    <img src="<?php echo htmlspecialchars($capa); ?>" class="capa-destaque-home"
                                        alt="<?php echo htmlspecialchars($livro['titulo']); ?>">

                                    <?php if (isset($_SESSION['id_user'])) { ?>

                                        <button type="button" class="btn-favorito" data-id="<?php echo $livro['id_liv']; ?>">

                                            <?php if (in_array($livro['id_liv'], $favoritos)) { ?>

                                                <i class="bi bi-heart-fill"></i>

                                            <?php } else { ?>

                                                <i class="bi bi-heart"></i>

                                            <?php } ?>

                                        </button>

                                    <?php } else { ?>

                                        <a href="loginUsuario.php" class="btn-favorito">

                                            <i class="bi bi-heart"></i>

                                        </a>

                                    <?php } ?>

                                </div>

                                <div class="destaque-conteudo">

                                    <h3>
                                        <?php echo htmlspecialchars($livro['titulo']); ?>
                                    </h3>

                                    <p>
                                        <?php echo htmlspecialchars($livro['autor']); ?>
                                    </p>

                                    <a href="detalhesLivro.php?id=<?php echo $livro['id_liv']; ?>" class="leia-mais-home">

                                        Leia mais
                                        <i class="bi bi-arrow-right"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                        <?php
                    }
                } else {
                    ?>

                    <p class="text-muted">
                        Nenhum livro marcado como destaque.
                    </p>

                <?php } ?>

            </div>

        </div>

    </section>


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

                <!-- Fale conosco -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Busca -->
    <script>

        const livros =
            <?php echo json_encode($livrosPesquisa, JSON_UNESCAPED_UNICODE); ?>;

        const pesquisa =
            document.getElementById("pesquisaLivro");

        const resultados =
            document.getElementById("resultadosPesquisa");

        const formBusca =
            document.getElementById("formBusca");

        function buscarLivros() {

            const texto =
                pesquisa.value.toLowerCase().trim();

            resultados.innerHTML = "";

            if (texto === "") {
                resultados.style.display = "none";
                return [];
            }

            const encontrados =
                livros.filter(function (livro) {

                    return livro.titulo
                        .toLowerCase()
                        .includes(texto)

                        ||

                        livro.autor
                            .toLowerCase()
                            .includes(texto);

                });

            encontrados
                .slice(0, 5)
                .forEach(function (livro) {

                    const link =
                        document.createElement("a");

                    link.href =
                        "detalhesLivro.php?id=" + livro.id;

                    link.className =
                        "resultado-livro";

                    link.innerHTML =
                        '<i class="bi bi-book"></i>' +
                        '<div>' +
                        '<strong>' + livro.titulo + '</strong>' +
                        '<small>' + livro.autor + '</small>' +
                        '</div>';

                    resultados.appendChild(link);

                });

            if (encontrados.length === 0) {

                resultados.innerHTML =
                    '<div class="resultado-vazio">' +
                    'Nenhum livro encontrado.' +
                    '</div>';

            }

            resultados.style.display = "block";

            return encontrados;
        }

        pesquisa.addEventListener(
            "input",
            buscarLivros
        );

        formBusca.addEventListener(
            "submit",
            function (event) {

                event.preventDefault();

                const encontrados =
                    buscarLivros();

                if (encontrados.length > 0) {

                    window.location.href =
                        "detalhesLivro.php?id=" +
                        encontrados[0].id;

                }

            }
        );

        document.addEventListener(
            "click",
            function (event) {

                if (!event.target.closest(
                    ".pesquisa-container"
                )) {

                    resultados.style.display =
                        "none";

                }

            }
        );

    </script>

    <!-- Favoritos -->
    <script>

        document.querySelectorAll(
            ".btn-favorito[data-id]"
        ).forEach(function (botao) {

            botao.addEventListener(
                "click",
                function () {

                    const idLivro =
                        this.dataset.id;

                    const icone =
                        this.querySelector("i");

                    fetch("favoritar.php", {
                        method: "POST",
                        headers: {
                            "Content-Type":
                                "application/x-www-form-urlencoded"
                        },
                        body:
                            "id_livro=" + idLivro
                    })

                        .then(function (resposta) {
                            return resposta.json();
                        })

                        .then(function (dados) {

                            if (dados.login === false) {

                                window.location.href =
                                    "loginUsuario.php";

                                return;
                            }

                            if (dados.favorito) {

                                icone.classList.remove(
                                    "bi-heart"
                                );

                                icone.classList.add(
                                    "bi-heart-fill"
                                );

                            } else {

                                icone.classList.remove(
                                    "bi-heart-fill"
                                );

                                icone.classList.add(
                                    "bi-heart"
                                );

                            }

                        });

                }
            );

        });

    </script>

</body>

</html>