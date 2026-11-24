<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
include "../../ARQUIVOS/conexao.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../loginUsuario.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$sql = "SELECT * FROM usuario WHERE id_user=$id_user";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    header("Location: ../logout.php");
    exit;
}

$usuario = $result->fetch_assoc();
$partes_nome = explode(" ", trim($usuario['nome_user']));
$primeiro_nome = $partes_nome[0];

$sql_total_favoritos = "SELECT COUNT(*) AS total FROM favoritos WHERE id_usuario=$id_user";
$result_total_favoritos = $conn->query($sql_total_favoritos);
$total_favoritos = 0;

if ($result_total_favoritos) {
    $linha_total_favoritos = $result_total_favoritos->fetch_assoc();
    $total_favoritos = (int) $linha_total_favoritos['total'];
}

$sql_favoritos = "SELECT cadastro_liv.*
FROM favoritos
INNER JOIN cadastro_liv
ON favoritos.id_livro = cadastro_liv.id_liv
WHERE favoritos.id_usuario=$id_user
ORDER BY favoritos.id DESC
LIMIT 4";
$result_favoritos = $conn->query($sql_favoritos);

$sql_total_downloads = "SELECT COUNT(*) AS total FROM downloads_liv WHERE id_user=$id_user";
$result_total_downloads = $conn->query($sql_total_downloads);
$total_downloads = 0;

if ($result_total_downloads) {
    $linha_total_downloads = $result_total_downloads->fetch_assoc();
    $total_downloads = (int) $linha_total_downloads['total'];
}

$sql_downloads = "SELECT
cadastro_liv.id_liv,
cadastro_liv.titulo,
cadastro_liv.autor,
downloads_liv.data
FROM downloads_liv
INNER JOIN cadastro_liv
ON downloads_liv.id_livro = cadastro_liv.id_liv
WHERE downloads_liv.id_user = $id_user
ORDER BY downloads_liv.data DESC, downloads_liv.id_dow DESC
LIMIT 4";
$result_downloads = $conn->query($sql_downloads);

$sql_progresso = "SELECT
progresso_leitura.pagina_atual,
cadastro_liv.id_liv,
cadastro_liv.titulo,
cadastro_liv.autor
FROM progresso_leitura
INNER JOIN cadastro_liv
ON progresso_leitura.id_liv = cadastro_liv.id_liv
WHERE progresso_leitura.id_user = $id_user
ORDER BY progresso_leitura.data_atualizacao DESC
LIMIT 1";

$result_progresso = $conn->query($sql_progresso);
$continue_lendo = null;

if ($result_progresso && $result_progresso->num_rows > 0) {
    $continue_lendo = $result_progresso->fetch_assoc();
}

$foto_usuario = "";

if (!empty($usuario['foto_user'])) {
    $arquivo_foto = __DIR__ . "/../../ARQUIVOS/fotos_usuario/" . $usuario['foto_user'];
    if (file_exists($arquivo_foto)) {
        $foto_usuario = "../../ARQUIVOS/fotos_usuario/" . $usuario['foto_user'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="perfil-page">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../../ARQUIVOS/img/logo.png" alt="Bear Books">
            </a>
            <div class="ms-auto">
                <a href="../index.php" class="nav-link d-inline">Início</a>
            </div>
        </div>
    </nav>

    <main class="perfil-conteudo">
        <div class="container">
            <section class="perfil-cabecalho">
                <div class="perfil-foto">
                    <?php if ($foto_usuario != "") { ?>
                        <img src="<?php echo htmlspecialchars($foto_usuario); ?>" alt="Foto de perfil">
                    <?php } else { ?>
                        <i class="bi bi-person-circle"></i>
                    <?php } ?>
                </div>
                <div class="perfil-identificacao">
                    <p class="perfil-boas-vindas">MEU PERFIL</p>
                    <h1>Olá, <?php echo htmlspecialchars($primeiro_nome); ?>!</h1>
                    <p><?php echo htmlspecialchars($usuario['email_user']); ?></p>
                </div>
            </section>

            <section class="perfil-acoes">
                <a href="#meus-favoritos" class="perfil-acao">
                    <div class="perfil-acao-icone">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div>
                        <h3>Favoritos</h3>
                        <p><?php echo $total_favoritos; ?> livro(s) salvo(s)</p>
                    </div>
                    <i class="bi bi-chevron-right perfil-seta"></i>
                </a>

                <?php if ($continue_lendo) { ?>
                    <a href="../lerLivro.php?id=<?php echo $continue_lendo['id_liv']; ?>" class="perfil-acao">
                        <div class="perfil-acao-icone">
                            <i class="bi bi-book"></i>
                        </div>
                        <div>
                            <h3>Continue lendo</h3>
                            <p>
                                <?php echo htmlspecialchars($continue_lendo['titulo']); ?>
                                - Página <?php echo $continue_lendo['pagina_atual']; ?>
                            </p>
                        </div>
                        <i class="bi bi-chevron-right perfil-seta"></i>
                    </a>
                <?php } else { ?>
                    <div class="perfil-acao perfil-acao-desativada">
                        <div class="perfil-acao-icone">
                            <i class="bi bi-book"></i>
                        </div>
                        <div>
                            <h3>Continue lendo</h3>
                            <p>Você ainda não iniciou nenhuma leitura</p>
                        </div>
                    </div>
                <?php } ?>

                <a href="#meus-downloads" class="perfil-acao">
                    <div class="perfil-acao-icone">
                        <i class="bi bi-download"></i>
                    </div>
                    <div>
                        <h3>Downloads</h3>
                        <p><?php echo $total_downloads; ?> livro(s) baixado(s)</p>
                    </div>
                    <i class="bi bi-chevron-right perfil-seta"></i>
                </a>
            </section>

            <section class="perfil-painel">
                <div class="perfil-painel-titulo">
                    <div>
                        <p>CONTA</p>
                        <h2>Informações pessoais</h2>
                    </div>
                    <a href="editarUser.php" class="perfil-editar">
                        <i class="bi bi-pencil"></i>
                        Editar perfil
                    </a>
                </div>
                <div class="perfil-informacoes">
                    <div class="perfil-info-nova">
                        <i class="bi bi-person"></i>
                        <div>
                            <span>Nome</span>
                            <p><?php echo htmlspecialchars($usuario['nome_user']); ?></p>
                        </div>
                    </div>
                    <div class="perfil-info-nova">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <span>Email</span>
                            <p><?php echo htmlspecialchars($usuario['email_user']); ?></p>
                        </div>
                    </div>
                    <div class="perfil-info-nova">
                        <i class="bi bi-person-vcard"></i>
                        <div>
                            <span>CPF</span>
                            <p><?php echo htmlspecialchars($usuario['cpf_user']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="perfil-sair">
                    <a href="../logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        Sair da conta
                    </a>
                </div>
            </section>

            <section class="perfil-favoritos" id="meus-favoritos">
                <div class="perfil-secao-titulo">
                    <div>
                        <p>MINHA BIBLIOTECA</p>
                        <h2>Livros favoritos</h2>
                    </div>
                    <a href="meusFavoritos.php">
                        Ver Mais
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <?php if ($result_favoritos && $result_favoritos->num_rows > 0) { ?>
                    <div class="row g-4">
                        <?php
                        while ($livro = $result_favoritos->fetch_assoc()) {
                            $capa = "../../ARQUIVOS/img/livroicon.png";
                            if (!empty($livro['foto_capa'])) {
                                $arquivo_capa = __DIR__ . "/../../ARQUIVOS/capas/" . $livro['foto_capa'];
                                if (file_exists($arquivo_capa)) {
                                    $capa = "../../ARQUIVOS/capas/" . $livro['foto_capa'];
                                }
                            }
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="perfil-livro-card">
                                    <img src="<?php echo htmlspecialchars($capa); ?>"
                                        alt="<?php echo htmlspecialchars($livro['titulo']); ?>">
                                    <div class="perfil-livro-info">
                                        <h3><?php echo htmlspecialchars($livro['titulo']); ?></h3>
                                        <p><?php echo htmlspecialchars($livro['autor']); ?></p>
                                        <a href="../detalhesLivro.php?id=<?php echo $livro['id_liv']; ?>">
                                            Ver livro
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="perfil-sem-favoritos">
                        <i class="bi bi-heart"></i>
                        <h3>Nenhum favorito ainda</h3>
                        <p>Os livros que você favoritar aparecerão aqui.</p>
                        <a href="../catalogo.php">Explorar livros</a>
                    </div>
                <?php } ?>
            </section>

            <section class="perfil-favoritos" id="meus-downloads">
                <div class="perfil-secao-titulo">
                    <div>
                        <p>MINHA BIBLIOTECA</p>
                        <h2>Histórico de downloads</h2>
                    </div>
                    <a href="meusDonwloads.php">
                            Ver Mais
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <?php if ($result_downloads && $result_downloads->num_rows > 0) { ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Livro</th>
                                    <th>Autor(a)</th>
                                    <th>Data do download</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($download = $result_downloads->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($download['titulo']); ?></td>
                                        <td><?php echo htmlspecialchars($download['autor']); ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($download['data'])); ?></td>
                                        <td>
                                            <a href="../detalhesLivro.php?id=<?php echo (int) $download['id_liv']; ?>">
                                                Ver livro
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="perfil-sem-favoritos">
                        <i class="bi bi-download"></i>
                        <h3>Nenhum download ainda</h3>
                        <p>Os livros que você baixar aparecerão aqui.</p>
                        <a href="../catalogo.php">Explorar livros</a>
                    </div>
                <?php } ?>
            </section>
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
                <div class="col-lg-3 col-md-6">
                    <div class="footer-fale">
                        <h5>Precisa de ajuda?</h5>
                        <p>Tem alguma dúvida ou sugestão? Entre em contato com nossa equipe.</p>
                        <a href="../faleconosco.php" class="btn-footer-contato">
                            <i class="bi bi-chat-heart"></i>
                            Fale Conosco
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
        window.addEventListener("pageshow", function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</body>

</html>