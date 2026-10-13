<?php
session_start();
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Perfil</title>

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

                <a href="perfilUser.php" class="nav-link d-inline">

                    Meu Perfil

                </a>

            </div>

        </div>

    </nav>

    <main class="editar-perfil-conteudo">

        <div class="container">

            <div class="editar-perfil-card">

                <div class="editar-perfil-titulo">

                    <p>MINHA CONTA</p>

                    <h1>Editar Perfil</h1>

                    <span>
                        Atualize suas informações pessoais.
                    </span>

                </div>

                <form action="updateUser.php" method="POST" enctype="multipart/form-data">

                    <!-- Foto -->
                    <div class="editar-foto-area">

                        <div class="editar-foto-preview">

                            <?php if (!empty($usuario['foto_user'])) { ?>

                                <img src="../../ARQUIVOS/fotos_usuario/<?php echo htmlspecialchars($usuario['foto_user']); ?>"
                                    alt="Foto de perfil">

                            <?php } else { ?>

                                <i class="bi bi-person-circle"></i>

                            <?php } ?>

                        </div>

                        <div>

                            <label class="form-label">
                                Foto de perfil
                            </label>

                            <input type="file" class="form-control" name="foto_user"
                                accept="image/png,image/jpeg,image/jpg">

                            <small>
                                Escolha uma imagem JPG ou PNG.
                            </small>

                        </div>

                    </div>

                    <!-- Nome -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nome
                        </label>

                        <input type="text" class="form-control" name="nome_user"
                            value="<?php echo htmlspecialchars($usuario['nome_user']); ?>" required>

                    </div>

                    <!-- CPF -->
                    <div class="mb-3">

                        <label class="form-label">
                            CPF
                        </label>

                        <input type="text" class="form-control" name="cpf_user"
                            value="<?php echo htmlspecialchars($usuario['cpf_user']); ?>" required>

                    </div>

                    <!-- Email -->
                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input type="email" class="form-control" name="email_user"
                            value="<?php echo htmlspecialchars($usuario['email_user']); ?>" required>

                    </div>

                    <!-- Nova senha -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nova senha
                        </label>

                        <input type="password" class="form-control" name="senha_user"
                            placeholder="Digite apenas se quiser alterar">

                        <small class="editar-ajuda">
                            Deixe em branco para manter sua senha atual.
                        </small>

                    </div>

                    <!-- Botões -->
                    <div class="editar-perfil-botoes">

                        <a href="perfilUser.php" class="btn btn-cancelar">

                            Cancelar

                        </a>

                        <button type="submit" class="btn btn-primary">

                            Salvar

                        </button>

                    </div>

                </form>

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

</body>

</html>