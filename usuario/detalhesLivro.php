<?php

session_start();

include "../ARQUIVOS/conexao.php";

if(!isset($_GET['id'])){
    header("Location: catalogo.php");
    exit;
}

$id_livro = (int) $_GET['id'];

/* Livro */

$sql = "SELECT
cadastro_liv.*,
categoria.nome_categoria,
classificacao.nome_classificacao,
editora.nome_editora

FROM cadastro_liv

LEFT JOIN categoria
ON cadastro_liv.id_categoria = categoria.id_categoria

LEFT JOIN classificacao
ON cadastro_liv.id_classificacao = classificacao.id_classificacao

LEFT JOIN editora
ON cadastro_liv.id_editora = editora.id_editora

WHERE cadastro_liv.id_liv = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $id_livro
);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows === 0){
    header("Location: catalogo.php");
    exit;
}

$livro = $result->fetch_assoc();

/* Nome usuário */

$nome_usuario = "";

if(isset($_SESSION['usuario'])){

    $nome_usuario = ucwords(
        trim($_SESSION['usuario'])
    );

}

/* Capa */

$capa = "../ARQUIVOS/img/livroicon.png";

if(!empty($livro['foto_capa'])){

    $capa =
    "../ARQUIVOS/capas/" .
    $livro['foto_capa'];

}

/* PDF */

$pdf = "";

if(!empty($livro['pdf_livro'])){

    $pdf =
    "../ARQUIVOS/pdf_livros/" .
    $livro['pdf_livro'];

}

/* Total de comentários ativos */

$sql_total = "SELECT COUNT(*) AS total
FROM comentario
WHERE id_liv = ?
AND status_comentario = 'Ativo'";

$stmt_total = $conn->prepare($sql_total);

$stmt_total->bind_param(
    "i",
    $id_livro
);

$stmt_total->execute();

$result_total =
$stmt_total->get_result();

$total_comentarios =
$result_total->fetch_assoc()['total'];

/* 4 comentários ativos mais recentes */

$sql_comentarios = "SELECT

comentario.id_comentario,
comentario.id_user,
comentario.comentario,
comentario.data_comentario,

usuario.nome_user,
usuario.foto_user

FROM comentario

INNER JOIN usuario
ON comentario.id_user = usuario.id_user

WHERE comentario.id_liv = ?

AND comentario.status_comentario = 'Ativo'

ORDER BY comentario.data_comentario DESC

LIMIT 4";

$stmt_comentarios =
$conn->prepare($sql_comentarios);

$stmt_comentarios->bind_param(
    "i",
    $id_livro
);

$stmt_comentarios->execute();

$result_comentarios =
$stmt_comentarios->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($livro['titulo']); ?>
        - Bear Books
    </title>

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link
    rel="stylesheet"
    href="../css/style.css">

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a
            class="navbar-brand"
            href="index.php">

                <img
                src="../ARQUIVOS/img/logo.png"
                alt="Bear Books">

            </a>

            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div
            class="collapse navbar-collapse"
            id="menu">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">

                        <a
                        class="nav-link"
                        href="index.php">

                            Início

                        </a>

                    </li>

                    <li class="nav-item">

                        <a
                        class="nav-link"
                        href="catalogo.php">

                            Catálogo

                        </a>

                    </li>

                    <li class="nav-item">

                        <a
                        class="nav-link"
                        href="sobre.php">

                            Sobre

                        </a>

                    </li>

                    <?php if(isset($_SESSION['id_user'])){ ?>

                        <li class="nav-item ms-lg-4">

                            <a
                            class="nav-link"
                            href="user/perfilUser.php">

                                Olá,
                                <?php echo htmlspecialchars($nome_usuario); ?>

                            </a>

                        </li>

                    <?php }else{ ?>

                        <li class="nav-item ms-lg-4">

                            <a
                            class="nav-link"
                            href="loginUsuario.php">

                                Entrar

                            </a>

                        </li>

                    <?php } ?>

                </ul>

            </div>

        </div>

    </nav>

    <!-- Detalhes -->

    <main class="detalhes-livro">

        <div class="container">

            <a
            href="catalogo.php"
            class="voltar-catalogo"
            onclick="history.back(); return false;">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

            <div class="row g-5 align-items-start">

                <!-- Capa -->

                <div class="col-lg-4 col-md-5">

                    <div class="detalhes-capa">

                        <img
                        src="<?php echo htmlspecialchars($capa); ?>"
                        alt="<?php echo htmlspecialchars($livro['titulo']); ?>">

                    </div>

                </div>

                <!-- Informações -->

                <div class="col-lg-8 col-md-7">

                    <div class="detalhes-conteudo">

                        <?php if(!empty($livro['nome_categoria'])){ ?>

                            <span class="detalhes-categoria">

                                <?php
                                echo htmlspecialchars(
                                    $livro['nome_categoria']
                                );
                                ?>

                            </span>

                        <?php } ?>

                        <h1>

                            <?php
                            echo htmlspecialchars(
                                $livro['titulo']
                            );
                            ?>

                        </h1>

                        <p class="detalhes-autor">

                            por

                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $livro['autor']
                                );
                                ?>

                            </strong>

                        </p>

                        <!-- Informações -->

                        <div class="row g-3 detalhes-informacoes">

                            <div class="col-lg-4 col-sm-6">

                                <div class="detalhes-info">

                                    <span>
                                        Classificação
                                    </span>

                                    <p>

                                        <?php

                                        echo !empty(
                                            $livro['nome_classificacao']
                                        )

                                        ? htmlspecialchars(
                                            $livro['nome_classificacao']
                                        )

                                        : "Não informado";

                                        ?>

                                    </p>

                                </div>

                            </div>

                            <div class="col-lg-4 col-sm-6">

                                <div class="detalhes-info">

                                    <span>
                                        Editora
                                    </span>

                                    <p>

                                        <?php

                                        echo !empty(
                                            $livro['nome_editora']
                                        )

                                        ? htmlspecialchars(
                                            $livro['nome_editora']
                                        )

                                        : "Não informado";

                                        ?>

                                    </p>

                                </div>

                            </div>

                            <div class="col-lg-4 col-sm-6">

                                <div class="detalhes-info">

                                    <span>
                                        Ano
                                    </span>

                                    <p>

                                        <?php

                                        echo !empty(
                                            $livro['ano']
                                        )

                                        ? htmlspecialchars(
                                            $livro['ano']
                                        )

                                        : "Não informado";

                                        ?>

                                    </p>

                                </div>

                            </div>

                            <div class="col-lg-4 col-sm-6">

                                <div class="detalhes-info">

                                    <span>
                                        Páginas
                                    </span>

                                    <p>

                                        <?php

                                        echo !empty(
                                            $livro['num_pagina']
                                        )

                                        ? htmlspecialchars(
                                            $livro['num_pagina']
                                        )

                                        : "Não informado";

                                        ?>

                                    </p>

                                </div>

                            </div>

                            <div class="col-lg-4 col-sm-6">

                                <div class="detalhes-info">

                                    <span>
                                        Edição
                                    </span>

                                    <p>

                                        <?php

                                        echo !empty(
                                            $livro['edicao']
                                        )

                                        ? htmlspecialchars(
                                            $livro['edicao']
                                        )

                                        : "Não informado";

                                        ?>

                                    </p>

                                </div>

                            </div>

                            <div class="col-lg-4 col-sm-6">

                                <div class="detalhes-info">

                                    <span>
                                        ISBN
                                    </span>

                                    <p>

                                        <?php

                                        echo !empty(
                                            $livro['isbn']
                                        )

                                        ? htmlspecialchars(
                                            $livro['isbn']
                                        )

                                        : "Não informado";

                                        ?>

                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- Botões -->

                        <div class="detalhes-botoes">

                            <?php if(!empty($pdf)){ ?>

                                <a
                                href="<?php echo htmlspecialchars($pdf); ?>"
                                target="_blank"
                                class="btn-ler-livro">

                                    <i class="bi bi-book"></i>

                                    Ler livro

                                </a>

                                <a
                                href="baixarLivro.php?id=<?php echo $livro['id_liv']; ?>"
                                class="btn-baixar-livro">

                                    <i class="bi bi-download"></i>

                                    Baixar PDF

                                </a>

                            <?php } ?>

                            <?php if(isset($_SESSION['id_user'])){ ?>

                                <button
                                type="button"
                                class="btn-comentar-livro"
                                data-bs-toggle="modal"
                                data-bs-target="#modalComentario">

                                    <i class="bi bi-chat-left-text"></i>

                                    Comentar

                                </button>

                            <?php }else{ ?>

                                <a
                                href="loginUsuario.php"
                                class="btn-comentar-livro">

                                    <i class="bi bi-chat-left-text"></i>

                                    Comentar

                                </a>

                            <?php } ?>

                        </div>

                        <?php if(empty($pdf)){ ?>

                            <p class="detalhes-sem-pdf mt-3">

                                <i class="bi bi-file-earmark-x"></i>

                                PDF indisponível

                            </p>

                        <?php } ?>

                    </div>

                </div>

            </div>

            <!-- Descrição -->

            <section class="detalhes-descricao">

                <span>
                    SOBRE O LIVRO
                </span>

                <h2>
                    Descrição
                </h2>

                <p>

                    <?php

                    echo !empty($livro['descricao'])

                    ? nl2br(
                        htmlspecialchars(
                            $livro['descricao']
                        )
                    )

                    : "Nenhuma descrição disponível.";

                    ?>

                </p>

            </section>

            <!-- Comentários -->

            <section class="comentarios-livro">

                <div class="comentarios-cabecalho">

                    <div>

                        <span>
                            OPINIÃO DOS LEITORES
                        </span>

                        <h2>
                            Comentários
                        </h2>

                    </div>

                    <p>

                        <?php
                        echo $total_comentarios;
                        ?>

                        <?php

                        echo $total_comentarios == 1

                        ? "comentário"

                        : "comentários";

                        ?>

                    </p>

                </div>

                <?php if(
                    $result_comentarios->num_rows > 0
                ){ ?>

                    <div class="lista-comentarios">

                        <?php while(
                            $comentario =
                            $result_comentarios->fetch_assoc()
                        ){ ?>

                            <div class="comentario-card">

                                <div class="comentario-topo">

                                    <div class="comentario-usuario">

                                        <div class="comentario-avatar">

                                            <?php if(
                                                !empty(
                                                    $comentario['foto_user']
                                                )
                                            ){ ?>

                                                <img
                                                src="../ARQUIVOS/fotos_usuario/<?php echo htmlspecialchars($comentario['foto_user']); ?>"
                                                alt="Foto do usuário">

                                            <?php }else{ ?>

                                                <i class="bi bi-person"></i>

                                            <?php } ?>

                                        </div>

                                        <div>

                                            <strong>

                                                <?php
                                                echo htmlspecialchars(
                                                    $comentario['nome_user']
                                                );
                                                ?>

                                            </strong>

                                            <span>

                                                <?php

                                                echo date(
                                                    "d/m/Y",
                                                    strtotime(
                                                        $comentario['data_comentario']
                                                    )
                                                );

                                                ?>

                                            </span>

                                        </div>

                                    </div>

                                    <?php if(
                                        isset($_SESSION['id_user']) &&
                                        $_SESSION['id_user'] ==
                                        $comentario['id_user']
                                    ){ ?>

                                        <div class="comentario-acoes">

                                            <button
                                            type="button"
                                            class="btn-editar-comentario"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarComentario<?php echo $comentario['id_comentario']; ?>">

                                                <i class="bi bi-pencil"></i>

                                                Editar

                                            </button>

                                            <form
                                            action="comentarios/excluirComentario.php"
                                            method="POST"
                                            onsubmit="return confirm('Deseja excluir este comentário?');">

                                                <input
                                                type="hidden"
                                                name="id_comentario"
                                                value="<?php echo $comentario['id_comentario']; ?>">

                                                <input
                                                type="hidden"
                                                name="id_livro"
                                                value="<?php echo $livro['id_liv']; ?>">

                                                <button
                                                type="submit"
                                                class="btn-excluir-comentario">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    <?php } ?>

                                </div>

                                <p class="comentario-texto">

                                    <?php

                                    echo nl2br(
                                        htmlspecialchars(
                                            $comentario['comentario']
                                        )
                                    );

                                    ?>

                                </p>

                            </div>

                            <!-- Modal editar -->

                            <?php if(
                                isset($_SESSION['id_user']) &&
                                $_SESSION['id_user'] ==
                                $comentario['id_user']
                            ){ ?>

                                <div
                                class="modal fade"
                                id="editarComentario<?php echo $comentario['id_comentario']; ?>"
                                tabindex="-1">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content modal-comentario">

                                            <div class="modal-header">

                                                <h5 class="modal-title">
                                                    Editar comentário
                                                </h5>

                                                <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                                </button>

                                            </div>

                                            <form
                                            action="comentarios/editarComentario.php"
                                            method="POST">

                                                <div class="modal-body">

                                                    <input
                                                    type="hidden"
                                                    name="id_comentario"
                                                    value="<?php echo $comentario['id_comentario']; ?>">

                                                    <input
                                                    type="hidden"
                                                    name="id_livro"
                                                    value="<?php echo $livro['id_liv']; ?>">

                                                    <label class="form-label">
                                                        Comentário
                                                    </label>

                                                    <textarea
                                                    name="comentario"
                                                    class="form-control"
                                                    rows="5"
                                                    required><?php echo htmlspecialchars($comentario['comentario']); ?></textarea>

                                                </div>

                                                <div class="modal-footer">

                                                    <button
                                                    type="button"
                                                    class="btn btn-cancelar"
                                                    data-bs-dismiss="modal">

                                                        Cancelar

                                                    </button>

                                                    <button
                                                    type="submit"
                                                    class="btn btn-primary">

                                                        Salvar

                                                    </button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            <?php } ?>

                        <?php } ?>

                    </div>

                    <?php if(
                        $total_comentarios > 4
                    ){ ?>

                        <div class="comentarios-mais">

                            <span>

                                Exibindo os 4 comentários
                                mais recentes de
                                <?php echo $total_comentarios; ?>.

                            </span>

                        </div>

                    <?php } ?>

                <?php }else{ ?>

                    <div class="sem-comentarios">

                        <i class="bi bi-chat"></i>

                        <h3>
                            Nenhum comentário ainda
                        </h3>

                        <p>
                            Seja o primeiro leitor
                            a comentar sobre este livro.
                        </p>

                    </div>

                <?php } ?>

            </section>

        </div>

    </main>

    <!-- Modal novo comentário -->

    <?php if(isset($_SESSION['id_user'])){ ?>

        <div
        class="modal fade"
        id="modalComentario"
        tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content modal-comentario">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Comentar sobre o livro
                        </h5>

                        <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                        </button>

                    </div>

                    <form
                    action="comentarios/comentar.php"
                    method="POST">

                        <div class="modal-body">

                            <input
                            type="hidden"
                            name="id_livro"
                            value="<?php echo $livro['id_liv']; ?>">

                            <label
                            for="comentario"
                            class="form-label">

                                Seu comentário

                            </label>

                            <textarea
                            class="form-control"
                            id="comentario"
                            name="comentario"
                            rows="5"
                            placeholder="O que você achou deste livro?"
                            required></textarea>

                        </div>

                        <div class="modal-footer">

                            <button
                            type="button"
                            class="btn btn-cancelar"
                            data-bs-dismiss="modal">

                                Cancelar

                            </button>

                            <button
                            type="submit"
                            class="btn btn-primary">

                                Publicar

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    <?php } ?>

    <!-- Footer -->

    <footer class="footer-principal">

        <div class="container">

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">

                    <div class="footer-marca">

                        <img
                        src="../ARQUIVOS/img/logo.png"
                        alt="Bear Books">

                        <p>
                            Uma biblioteca digital criada para
                            aproximar você dos livros, da leitura
                            e de novas histórias.
                        </p>

                    </div>

                </div>

                <div class="col-lg-2 col-md-6">

                    <div class="footer-links">

                        <h5>
                            Navegação
                        </h5>

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

                <div class="col-lg-3 col-md-6">

                    <div class="footer-contato">

                        <h5>
                            Contato
                        </h5>

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

                        <h5>
                            Precisa de ajuda?
                        </h5>

                        <p>
                            Tem alguma dúvida ou sugestão?
                            Entre em contato com nossa equipe.
                        </p>

                        <a
                        href="faleconosco.php"
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
                    © 2026 Bear Books -
                    Todos os direitos reservados.
                </p>

                <span>
                    Literatura e tecnologia em um só lugar.
                </span>

            </div>

        </div>

    </footer>

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>