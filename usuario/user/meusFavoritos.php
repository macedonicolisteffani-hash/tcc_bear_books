<?php
session_start();
include "../../ARQUIVOS/conexao.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../loginUsuario.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$sql = "SELECT cadastro_liv.*, categoria.nome_categoria AS categoria_livro
FROM favoritos
INNER JOIN cadastro_liv
ON favoritos.id_livro = cadastro_liv.id_liv
LEFT JOIN categoria
ON cadastro_liv.id_categoria = categoria.id_categoria
WHERE favoritos.id_usuario = $id_user
ORDER BY favoritos.id DESC";

$result = $conn->query($sql);
$total = $result ? $result->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Favoritos | Bear Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="favoritos-page">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../../ARQUIVOS/img/logo.png" alt="Bear Books">
            </a>
            <div class="ms-auto">
                <a href="../index.php" class="nav-link d-inline me-3">Início</a>
                <a href="perfilUser.php" class="nav-link d-inline">Perfil</a>
            </div>
        </div>
    </nav>
    <main class="favoritos-conteudo">
        <div class="container">
            <a href="perfilUser.php" class="favoritos-voltar">
                <i class="bi bi-arrow-left"></i> Voltar ao perfil
            </a>
            <div class="favoritos-cabecalho">
                <div>
                    <p>MINHA BIBLIOTECA</p>
                    <h1><i class="bi bi-heart"></i> Meus favoritos</h1>
                    <span>Encontre todos os livros que você salvou.</span>
                </div>
                <div class="favoritos-contador">
                    <i class="bi bi-book"></i>
                    <?php echo $total; ?> livro(s)
                </div>
            </div>
            <?php if ($result && $result->num_rows > 0) { ?>
                <div class="pesquisa-catalogo mb-5">
                    <i class="bi bi-search"></i>
                    <input type="text" id="buscarFavoritos" class="form-control"
                        placeholder="Buscar por título, autor ou categoria..." aria-label="Buscar favoritos">
                </div>
                <div class="row g-4">
                    <?php while ($livro = $result->fetch_assoc()) {
                        $capa = "../../ARQUIVOS/img/livroicon.png";
                        if (!empty($livro['foto_capa'])) {
                            $arquivo_capa = __DIR__ . "/../../ARQUIVOS/capas/" . $livro['foto_capa'];
                            if (file_exists($arquivo_capa)) {
                                $capa = "../../ARQUIVOS/capas/" . $livro['foto_capa'];
                            }
                        }
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 favorito-item"
                            data-categoria="<?php echo htmlspecialchars($livro['categoria_livro'] ?? '', ENT_QUOTES); ?>">
                            <div class="favoritos-livro-card">
                                <img src="<?php echo htmlspecialchars($capa); ?>"
                                    alt="<?php echo htmlspecialchars($livro['titulo']); ?>">
                                <div class="favoritos-livro-info">
                                    <h3><?php echo htmlspecialchars($livro['titulo']); ?></h3>
                                    <p><?php echo htmlspecialchars($livro['autor']); ?></p>
                                    <a href="../detalhesLivro.php?id=<?php echo $livro['id_liv']; ?>"
                                        class="favoritos-ver-livro">
                                        Ver livro <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="catalogo-sem-resultado" id="semResultadoFavoritos">
                    <i class="bi bi-search"></i>
                    <h3>Nenhum livro encontrado</h3>
                    <p>Tente pesquisar por outro título, autor ou categoria.</p>
                </div>
            <?php } else { ?>
                <div class="favoritos-vazio">
                    <i class="bi bi-heart"></i>
                    <h3>Nenhum favorito ainda</h3>
                    <p>Explore nosso catálogo e salve seus livros preferidos.</p>
                    <a href="../catalogo.php">Explorar catálogo</a>
                </div>
            <?php } ?>
        </div>
    </main>
    <footer class="footer-principal">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-marca">
                        <img src="../../ARQUIVOS/img/logo.png" alt="Bear Books">
                        <p>Uma biblioteca digital criada para aproximar você dos livros, da leitura e de novas
                            histórias.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h5>Navegação</h5>
                        <a href="../index.php">Início</a>
                        <a href="../catalogo.php">Catálogo</a>
                        <a href="../sobre.php">Sobre</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-contato">
                        <h5>Contato</h5>
                        <p><i class="bi bi-envelope"></i> contato@bearbooks.com</p>
                        <p><i class="bi bi-book"></i> Biblioteca digital</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-fale">
                        <h5>Precisa de ajuda?</h5>
                        <p>Tem alguma dúvida ou sugestão? Entre em contato com nossa equipe.</p>
                        <a href="../faleconosco.php" class="btn-footer-contato">
                            <i class="bi bi-chat-heart"></i> Fale Conosco
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-linha"></div>
            <div class="footer-final">
                <p>© 2026 Bear Books - Todos os direitos reservados.</p>
                <span>Literatura e tecnologia em um só lugar.</span>
            </div>
        </div>
    </footer>
    <script>
        function normalizar(texto) {
            return texto.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        }
        const campoBusca = document.getElementById("buscarFavoritos");
        if (campoBusca) {
            campoBusca.addEventListener("input", function () {
                let busca = normalizar(this.value.trim());
                let encontrados = 0;
                document.querySelectorAll(".favorito-item").forEach(function (livro) {
                    let titulo = normalizar(livro.querySelector("h3").textContent);
                    let autor = normalizar(livro.querySelector("p").textContent);
                    let categoria = normalizar(livro.dataset.categoria);
                    if (titulo.includes(busca) || autor.includes(busca) || categoria.includes(busca)) {
                        livro.style.display = "";
                        encontrados++;
                    } else {
                        livro.style.display = "none";
                    }
                });
                document.getElementById("semResultadoFavoritos").style.display = encontrados === 0 ? "block" : "none";
            });
        }
    </script>
</body>

</html>