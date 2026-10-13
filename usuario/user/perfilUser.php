<?php
session_start();
include "../../ARQUIVOS/conexao.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../loginUsuario.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];

/* Dados do usuário */
$sql = "SELECT * FROM usuario WHERE id_user=$id_user";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    header("Location: ../logout.php");
    exit;
}

$usuario = $result->fetch_assoc();

/* Primeiro nome */
$partes_nome = explode(" ", trim($usuario['nome_user']));
$primeiro_nome = $partes_nome[0];

/* Favoritos */
$sql_favoritos = "SELECT cadastro_liv.*
FROM favoritos
INNER JOIN cadastro_liv
ON favoritos.id_livro = cadastro_liv.id_liv
WHERE favoritos.id_usuario=$id_user
ORDER BY favoritos.id DESC";

$result_favoritos = $conn->query($sql_favoritos);

$total_favoritos = 0;

if ($result_favoritos) {
    $total_favoritos = $result_favoritos->num_rows;
}

/* Foto */
$foto_usuario = "";

if (!empty($usuario['foto_user'])) {
    $foto_usuario = "../../ARQUIVOS/fotos_usuario/" . $usuario['foto_user'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meu Perfil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="perfil-page">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a class="navbar-brand" href="../index.php">

                <img src="../../ARQUIVOS/img/logo.png" alt="Bear Books">

            </a>

            <div class="ms-auto">

                <a href="../index.php" class="nav-link d-inline">

                    Início

                </a>

            </div>

        </div>

    </nav>

    <main class="perfil-conteudo">

        <div class="container">

            <!-- Cabeçalho do perfil -->
            <section class="perfil-cabecalho">

                <div class="perfil-foto">

                    <?php if ($foto_usuario != "") { ?>

                        <img src="<?php echo htmlspecialchars($foto_usuario); ?>" alt="Foto de perfil">

                    <?php } else { ?>

                        <i class="bi bi-person-circle"></i>

                    <?php } ?>

                </div>

                <div class="perfil-identificacao">

                    <p class="perfil-boas-vindas">
                        MEU PERFIL
                    </p>

                    <h1>
                        Olá,
                        <?php echo htmlspecialchars($primeiro_nome); ?>!
                    </h1>

                    <p>
                        <?php echo htmlspecialchars($usuario['email_user']); ?>
                    </p>

                </div>

            </section>

            <!-- Ações -->
            <section class="perfil-acoes">

                <!-- Favoritos -->
                <a href="#meus-favoritos" class="perfil-acao">

                    <div class="perfil-acao-icone">

                        <i class="bi bi-heart"></i>

                    </div>

                    <div>

                        <h3>Favoritos</h3>

                        <p>
                            <?php echo $total_favoritos; ?>
                            livro(s) salvo(s)
                        </p>

                    </div>

                    <i class="bi bi-chevron-right perfil-seta"></i>

                </a>

                <!-- Continue lendo -->
                <div class="perfil-acao perfil-acao-desativada">

                    <div class="perfil-acao-icone">

                        <i class="bi bi-book"></i>

                    </div>

                    <div>

                        <h3>Continue lendo</h3>

                        <p>
                            Veja onde você parou
                        </p>

                        <span>Em breve</span>

                    </div>

                </div>

                <!-- Downloads -->
                <div class="perfil-acao perfil-acao-desativada">

                    <div class="perfil-acao-icone">

                        <i class="bi bi-download"></i>

                    </div>

                    <div>

                        <h3>Downloads</h3>

                        <p>
                            Livros que você baixou
                        </p>

                        <span>Em breve</span>

                    </div>

                </div>

            </section>

            <!-- Dados pessoais -->
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

                            <p>
                                <?php echo htmlspecialchars($usuario['nome_user']); ?>
                            </p>

                        </div>

                    </div>

                    <div class="perfil-info-nova">

                        <i class="bi bi-envelope"></i>

                        <div>

                            <span>Email</span>

                            <p>
                                <?php echo htmlspecialchars($usuario['email_user']); ?>
                            </p>

                        </div>

                    </div>

                    <div class="perfil-info-nova">

                        <i class="bi bi-person-vcard"></i>

                        <div>

                            <span>CPF</span>

                            <p>
                                <?php echo htmlspecialchars($usuario['cpf_user']); ?>
                            </p>

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

            <!-- Favoritos -->
            <section class="perfil-favoritos" id="meus-favoritos">

                <div class="perfil-secao-titulo">

                    <div>

                        <p>MINHA BIBLIOTECA</p>

                        <h2>Livros favoritos</h2>

                    </div>

                    <a href="../catalogo.php">
                        Explorar catálogo
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <?php if (
                    $result_favoritos &&
                    $result_favoritos->num_rows > 0
                ) { ?>

                    <div class="row g-4">

                        <?php
                        while (
                            $livro =
                            $result_favoritos->fetch_assoc()
                        ) {

                            $capa =
                                "../../ARQUIVOS/img/livroicon.png";

                            if (!empty($livro['foto_capa'])) {

                                $capa =
                                    "../../ARQUIVOS/capas/" .
                                    $livro['foto_capa'];

                            }
                            ?>

                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <div class="perfil-livro-card">

                                    <img src="<?php echo htmlspecialchars($capa); ?>"
                                        alt="<?php echo htmlspecialchars($livro['titulo']); ?>">

                                    <div class="perfil-livro-info">

                                        <h3>
                                            <?php echo htmlspecialchars($livro['titulo']); ?>
                                        </h3>

                                        <p>
                                            <?php echo htmlspecialchars($livro['autor']); ?>
                                        </p>

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

                        <p>
                            Os livros que você favoritar
                            aparecerão aqui.
                        </p>

                        <a href="../catalogo.php">
                            Explorar livros
                        </a>

                    </div>

                <?php } ?>

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

                        <img src="../../ARQUIVOS/img/logo.png" alt="Bear Books">

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

                        <a href="../index.php">
                            Início
                        </a>

                        <a href="../catalogo.php">
                            Catálogo
                        </a>

                        <a href="../sobre.php">
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

</body>

</html>