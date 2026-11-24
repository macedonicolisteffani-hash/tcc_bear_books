<?php

include "../../ARQUIVOS/conexao.php";

$sql = "SELECT
comentario.id_comentario,
comentario.id_user,
comentario.id_liv,
comentario.comentario,
comentario.data_comentario,
comentario.status_comentario,
usuario.nome_user,
cadastro_liv.titulo

FROM comentario

INNER JOIN usuario
ON comentario.id_user = usuario.id_user

INNER JOIN cadastro_liv
ON comentario.id_liv = cadastro_liv.id_liv

ORDER BY comentario.data_comentario DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Comentários</title>

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link
    rel="stylesheet"
    href="../../css/style.css">

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a
            class="navbar-brand"
            href="../menuAdministrador.php">

                <img
                src="../../ARQUIVOS/img/logo.png"
                alt="Bear Books"
                class="me-3">

            </a>

            <div class="navbar-nav ms-auto">

                <a
                class="nav-link"
                href="../menuAdministrador.php">

                    <i class="bi bi-house-door-fill"></i>

                    Home do ADM

                </a>

            </div>

        </div>

    </nav>

    <!-- Conteúdo -->

    <main class="container mt-5 mb-5">

        <h2 class="titulo-pagina">
            Comentários Cadastrados
        </h2>

        <p class="text-center text-muted mb-4">
            Visualize, bloqueie ou desbloqueie os comentários dos usuários.
        </p>

        <div class="table-responsive">

            <table class="table table-striped-columns table-bordered align-middle">

                <thead class="text-center">

                    <tr>

                        <th>ID</th>

                        <th>Usuário</th>

                        <th>Livro</th>

                        <th>Comentário</th>

                        <th>Data</th>

                        <th>Status</th>

                        <th>Ação</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if($result && $result->num_rows > 0){ ?>

                        <?php while($row = $result->fetch_assoc()){ ?>

                            <tr>

                                <td class="text-center">

                                    <?php
                                    echo $row['id_comentario'];
                                    ?>

                                </td>

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $row['nome_user']
                                    );
                                    ?>

                                </td>

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $row['titulo']
                                    );
                                    ?>

                                </td>

                                <td>

                                    <?php
                                    echo nl2br(
                                        htmlspecialchars(
                                            $row['comentario']
                                        )
                                    );
                                    ?>

                                </td>

                                <td class="text-center">

                                    <?php

                                    echo date(
                                        "d/m/Y H:i",
                                        strtotime(
                                            $row['data_comentario']
                                        )
                                    );

                                    ?>

                                </td>

                                <td class="text-center">

                                    <?php if(
                                        $row['status_comentario']
                                        == "Ativo"
                                    ){ ?>

                                        <span class="badge bg-success">
                                            Ativo
                                        </span>

                                    <?php }else{ ?>

                                        <span class="badge bg-danger">
                                            Bloqueado
                                        </span>

                                    <?php } ?>

                                </td>

                                <td class="text-center">

                                    <?php if(
                                        $row['status_comentario']
                                        == "Ativo"
                                    ){ ?>

                                        <a
                                        href="bloquearComentario.php?id_comentario=<?php echo $row['id_comentario']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Deseja bloquear este comentário?');">

                                            <i class="bi bi-lock-fill"></i>

                                            Bloquear

                                        </a>

                                    <?php }else{ ?>

                                        <a
                                        href="bloquearComentario.php?id_comentario=<?php echo $row['id_comentario']; ?>"
                                        class="btn btn-success btn-sm">

                                            <i class="bi bi-unlock-fill"></i>

                                            Desbloquear

                                        </a>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                    <?php }else{ ?>

                        <tr>

                            <td
                            colspan="7"
                            class="text-center py-4">

                                Nenhum comentário cadastrado.

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </main>

    <!-- Footer -->

    <footer class="footer">

        <p class="mb-0">
            © 2026 Bear Books - Todos os direitos reservados.
        </p>

    </footer>

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>