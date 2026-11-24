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

    $sql_favoritos = "SELECT id_livro
    FROM favoritos
    WHERE id_usuario=$id_usuario";

    $result_favoritos = $conn->query($sql_favoritos);

    if ($result_favoritos) {
        while ($fav = $result_favoritos->fetch_assoc()) {
            $favoritos[] = $fav['id_livro'];
        }
    }
}

/* Categorias */
$sql_categorias = "SELECT *
FROM categoria
ORDER BY nome_categoria ASC";

$result_categorias = $conn->query($sql_categorias);

/* Livros */
$sql_livros = "SELECT
cadastro_liv.*,
categoria.nome_categoria
FROM cadastro_liv

LEFT JOIN categoria
ON cadastro_liv.id_categoria = categoria.id_categoria

ORDER BY cadastro_liv.titulo ASC";

$result_livros = $conn->query($sql_livros);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo - Bear Books</title>

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

                        <a class="nav-link active" href="catalogo.php">
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

    <!-- Catálogo -->
    <main class="catalogo">

        <div class="container">

            <!-- Cabeçalho -->
            <div class="catalogo-cabecalho">

                <h1>Catálogo</h1>

                <span>
                    Encontre sua próxima história.
                </span>

            </div>

            <!-- Pesquisa -->
            <div class="pesquisa-catalogo">

                <i class="bi bi-search"></i>

                <input type="text" id="pesquisaLivro" class="form-control"
                    placeholder="Digite o nome do livro ou autor..." autocomplete="off">

            </div>

            <!-- Categorias -->
            <div class="filtros">

                <span class="filtros-titulo">
                    Categorias:
                </span>

                <button type="button" class="btn filtro ativo" data-filtro="todos">

                    Todos

                </button>

                <?php
                if ($result_categorias) {

                    while (
                        $categoria =
                        $result_categorias->fetch_assoc()
                    ) {
                        ?>

                        <button type="button" class="btn filtro" data-filtro="<?php echo $categoria['id_categoria']; ?>">

                            <?php
                            echo htmlspecialchars(
                                $categoria['nome_categoria']
                            );
                            ?>

                        </button>

                        <?php
                    }
                }
                ?>

            </div>

            <!-- Livros -->
            <div class="row g-4 livros-catalogo" id="listaLivros">

                <?php
                if (
                    $result_livros &&
                    $result_livros->num_rows > 0
                ) {

                    while (
                        $livro =
                        $result_livros->fetch_assoc()
                    ) {

                        $capa =
                            "../ARQUIVOS/img/livroicon.png";

                        if (!empty($livro['foto_capa'])) {

                            $capa =
                                "../ARQUIVOS/capas/" .
                                $livro['foto_capa'];

                        }

                        $nome_pesquisa =
                            $livro['titulo'] . " " . $livro['autor'];
                        ?>

                        <div class="col-6 col-md-4 col-lg-2 livro-item" data-categoria="<?php echo $livro['id_categoria']; ?>"
                            data-nome="<?php echo htmlspecialchars(
                                strtolower($nome_pesquisa)
                            ); ?>">

                            <div class="card card-catalogo h-100">

                                <div class="catalogo-capa">

                                    <img src="<?php echo htmlspecialchars($capa); ?>" class="card-img-top"
                                        alt="<?php echo htmlspecialchars($livro['titulo']); ?>">

                                    <!-- Favorito -->
                                    <?php if (isset($_SESSION['id_user'])) { ?>

                                        <button type="button" class="btn-favorito" data-id="<?php echo $livro['id_liv']; ?>">

                                            <?php
                                            if (
                                                in_array(
                                                    $livro['id_liv'],
                                                    $favoritos
                                                )
                                            ) {
                                                ?>

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

                                <div class="card-body">

                                    <?php
                                    if (!empty($livro['nome_categoria'])) {
                                        ?>

                                        <span class="categoria-livro">

                                            <?php
                                            echo htmlspecialchars(
                                                $livro['nome_categoria']
                                            );
                                            ?>

                                        </span>

                                    <?php } ?>

                                    <h5 class="titulo-livro">

                                        <?php
                                        echo htmlspecialchars(
                                            $livro['titulo']
                                        );
                                        ?>

                                    </h5>

                                    <p class="autor">

                                        <?php
                                        echo htmlspecialchars(
                                            $livro['autor']
                                        );
                                        ?>

                                    </p>

                                    <div class="acoes-livro">

                                        <a href="detalhesLivro.php?id=<?php echo $livro['id_liv']; ?>" class="leia-mais">

                                            Leia mais

                                            <i class="bi bi-arrow-right"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php
                    }
                }
                ?>

            </div>

            <!-- Nenhum resultado -->
            <div class="catalogo-sem-resultado" id="semResultado" style="display:none;">

                <i class="bi bi-book"></i>

                <h3>
                    Nenhum livro encontrado
                </h3>

                <p>
                    Tente pesquisar outro título,
                    autor ou categoria.
                </p>

            </div>

        </div>

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

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Pesquisa e filtro -->
    <script>

        let categoriaAtual = "todos";

        const botoesFiltro =
            document.querySelectorAll(".filtro");

        const livros =
            document.querySelectorAll(".livro-item");

        const pesquisa =
            document.getElementById("pesquisaLivro");

        const semResultado =
            document.getElementById("semResultado");


        botoesFiltro.forEach(function (botao) {

            botao.addEventListener("click", function () {

                botoesFiltro.forEach(function (item) {

                    item.classList.remove("ativo");

                });

                botao.classList.add("ativo");

                categoriaAtual =
                    botao.getAttribute("data-filtro");

                filtrarLivros();

            });

        });


        pesquisa.addEventListener("input", function () {

            filtrarLivros();

        });


        function filtrarLivros() {

            const textoPesquisa =
                pesquisa.value
                    .toLowerCase()
                    .trim();

            let quantidadeEncontrada = 0;

            livros.forEach(function (livro) {

                const nome =
                    livro.getAttribute("data-nome");

                const categoria =
                    livro.getAttribute("data-categoria");

                const correspondePesquisa =
                    nome.includes(textoPesquisa);

                const correspondeCategoria =
                    categoriaAtual === "todos" ||
                    categoria === categoriaAtual;

                if (
                    correspondePesquisa &&
                    correspondeCategoria
                ) {

                    livro.style.display = "";
                    quantidadeEncontrada++;

                } else {

                    livro.style.display = "none";

                }

            });

            if (quantidadeEncontrada === 0) {

                semResultado.style.display = "block";

            } else {

                semResultado.style.display = "none";

            }

        }

        /* Corrige estado inicial */
        filtrarLivros();

    </script>

    <!-- Favoritos -->
    <script>

        document.querySelectorAll(
            ".btn-favorito[data-id]"
        ).forEach(function (botao) {

            botao.addEventListener("click", function () {

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

            });

        });

    </script>

</body>

</html>