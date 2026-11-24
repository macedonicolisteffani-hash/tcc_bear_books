<?php
session_start();
include "../ARQUIVOS/conexao.php";

/* Confere o livro */
if (!isset($_GET['id'])) {
    header("Location: catalogo.php");
    exit;
}
$id_livro = (int) $_GET['id'];
$sql = "SELECT id_liv, titulo, autor, pdf_livro
FROM cadastro_liv
WHERE id_liv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_livro);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: catalogo.php");
    exit;
}
$livro = $result->fetch_assoc();
$stmt->close();

/* Confere o PDF */
if (empty($livro['pdf_livro'])) {
    header("Location: detalhesLivro.php?id=" . $id_livro);
    exit;
}
$nome_pdf = basename($livro['pdf_livro']);
$caminho_pdf = __DIR__ . "/../ARQUIVOS/pdf_livros/" . $nome_pdf;
if (!file_exists($caminho_pdf)) {
    header("Location: detalhesLivro.php?id=" . $id_livro);
    exit;
}
$url_pdf = "../ARQUIVOS/pdf_livros/" . rawurlencode($nome_pdf);
$url_pdf .= "?v=" . filemtime($caminho_pdf);

/* ID fixo do PDF */
$hash_pdf = md5("bearbooks-" . $id_livro . "-" . $nome_pdf);
$pdf_id = substr($hash_pdf, 0, 8) . "-" .
    substr($hash_pdf, 8, 4) . "-" .
    substr($hash_pdf, 12, 4) . "-" .
    substr($hash_pdf, 16, 4) . "-" .
    substr($hash_pdf, 20, 12);

/* Usuário */
$usuario_logado = isset($_SESSION['id_user']);
$id_user = $usuario_logado ? (int) $_SESSION['id_user'] : 0;
$nome_usuario = "";
if (isset($_SESSION['usuario'])) {
    $nome_usuario = ucwords(trim($_SESSION['usuario']));
}

/* Recupera a página salva */
$pagina_salva = 1;
if ($usuario_logado) {
    $sql_progresso = "SELECT pagina_atual
    FROM progresso_leitura
    WHERE id_user = ? AND id_liv = ?";
    $stmt_progresso = $conn->prepare($sql_progresso);
    $stmt_progresso->bind_param("ii", $id_user, $id_livro);
    $stmt_progresso->execute();
    $result_progresso = $stmt_progresso->get_result();
    if ($result_progresso->num_rows > 0) {
        $progresso = $result_progresso->fetch_assoc();
        $pagina_salva = (int) $progresso['pagina_atual'];
    }
    $stmt_progresso->close();
}

/* Recupera as marcações salvas */
$anotacoes_salvas = [];
if ($usuario_logado) {
    $sql_anotacoes = "SELECT anotacao
    FROM anotacao_livro
    WHERE id_user = ? AND id_liv = ?
    LIMIT 1";
    $stmt_anotacoes = $conn->prepare($sql_anotacoes);
    $stmt_anotacoes->bind_param("ii", $id_user, $id_livro);
    $stmt_anotacoes->execute();
    $result_anotacoes = $stmt_anotacoes->get_result();
    if ($result_anotacoes->num_rows > 0) {
        $dados_anotacoes = $result_anotacoes->fetch_assoc();
        $json_anotacoes = json_decode($dados_anotacoes['anotacao'], true);
        if (is_array($json_anotacoes)) {
            $anotacoes_salvas = $json_anotacoes;
        }
    }
    $stmt_anotacoes->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($livro['titulo']); ?> - Bear Books</title>
    <link rel="preconnect" href="https://acrobatservices.adobe.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .leitura-ferramentas {
            background: #F5F3EE;
            border-top: 1px solid #E8E0D5;
            border-bottom: 1px solid #E8E0D5;
            padding: 10px 15px;
        }

        .leitura-ferramentas-conteudo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .leitura-ferramenta {
            background: #fff;
            color: #1F3A56;
            border: 1px solid #C6A25A;
            border-radius: 8px;
            padding: 7px 14px;
            font-size: 14px;
            transition: 0.2s;
        }

        .leitura-ferramenta:hover:not(:disabled) {
            background: #F1E7D0;
        }

        .leitura-ferramenta.ativa {
            background: #1F3A56;
            color: #fff;
            border-color: #1F3A56;
        }

        .leitura-ferramenta:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .leitura-ferramenta i {
            margin-right: 5px;
        }

        .leitura-status {
            margin-left: 8px;
            color: #777;
            font-size: 13px;
        }

        .area-leitura {
            margin: 0;
            padding: 0;
            background: #E8E8E8;
        }

        .area-leitura .container-fluid {
            padding: 0;
        }

        .leitor-container {
            width: 100%;
            margin: 0;
            padding: 0;
            position: relative;
        }

        #adobe-dc-view {
            width: 100%;
            height: 68vh;
            min-height: 520px;
        }

        .leitor-carregando {
            position: absolute;
            inset: 0;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 12px;
            background: #F5F3EE;
            color: #1F3A56;
            text-align: center;
        }

        .leitor-carregando.oculto {
            display: none;
        }

        @media(max-width:768px) {
            .leitura-ferramenta {
                padding: 7px 10px;
                font-size: 13px;
            }

            .leitura-status {
                width: 100%;
                text-align: center;
                margin: 4px 0 0;
            }

            #adobe-dc-view {
                height: 65vh;
                min-height: 480px;
            }
        }
    </style>
</head>

<body class="pagina-leitura">
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
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalogo.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                    <?php if ($usuario_logado) { ?>
                        <li class="nav-item ms-lg-4">
                            <a class="nav-link" href="user/perfilUser.php">
                                Olá, <?php echo htmlspecialchars($nome_usuario); ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item ms-lg-4">
                            <a class="nav-link" href="loginUsuario.php">Entrar</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="leitura-barra">
        <div class="container-fluid">
            <div class="leitura-barra-conteudo">
                <a href="detalhesLivro.php?id=<?php echo $livro['id_liv']; ?>" class="leitura-voltar"
                    onclick="if(window.history.length > 1){window.history.back();return false;}">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <div class="leitura-livro">
                    <strong><?php echo htmlspecialchars($livro['titulo']); ?></strong>
                    <span><?php echo htmlspecialchars($livro['autor']); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Ferramentas somente para usuários logados -->
    <?php if ($usuario_logado) { ?>
        <section class="leitura-ferramentas">
            <div class="leitura-ferramentas-conteudo">
                <button type="button" class="leitura-ferramenta ferramenta-anotacao ferramenta-marcacao"
                    onclick="ativarFerramenta('highlight',this)" disabled>
                    <i class="bi bi-highlighter"></i> Destacar
                </button>
                <button type="button" class="leitura-ferramenta ferramenta-anotacao ferramenta-marcacao"
                    onclick="ativarFerramenta('underline',this)" disabled>
                    <i class="bi bi-type-underline"></i> Sublinhar
                </button>
                <button type="button" class="leitura-ferramenta ferramenta-anotacao ferramenta-marcacao"
                    onclick="ativarFerramenta('shape',this)" disabled>
                    <i class="bi bi-pencil"></i> Desenhar
                </button>
                <button type="button" class="leitura-ferramenta ferramenta-anotacao ferramenta-marcacao"
                    onclick="ativarFerramenta('eraser',this)" disabled>
                    <i class="bi bi-eraser"></i> Borracha
                </button>
                <button type="button" class="leitura-ferramenta ferramenta-anotacao" id="botao-comentarios"
                    onclick="alternarComentarios()" aria-pressed="false" disabled>
                    <i class="bi bi-chat-left-text"></i> Anotações
                </button>
                <span class="leitura-status" id="status-anotacao">Carregando ferramentas...</span>
            </div>
        </section>
    <?php } ?>

    <main class="area-leitura">
        <div class="container-fluid">
            <div class="leitor-container">
                <div class="leitor-carregando" id="leitor-carregando">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <span id="status-leitor">Abrindo seu livro...</span>
                </div>
                <div id="adobe-dc-view"></div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const urlPDF = <?php echo json_encode($url_pdf); ?>;
        const nomePDF = <?php echo json_encode($nome_pdf); ?>;
        const idLivro = <?php echo $id_livro; ?>;
        const paginaSalva = <?php echo $pagina_salva; ?>;
        const usuarioLogado = <?php echo $usuario_logado ? 'true' : 'false'; ?>;
        const anotacoesSalvas = <?php echo json_encode($anotacoes_salvas, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

        let adobeIniciado = false;
        let adobeViewerAtual = null;
        let pdfViewerReady = false;
        let primeiraPaginaPronta = false;
        let paginaRestaurada = false;
        let anotacoesIniciadas = false;
        let preparandoAnotacoes = false;
        let eventosRegistrados = false;
        let gerenciadorAnotacoes = null;
        let apisPDF = null;
        let intervaloProgresso = null;
        let tempoSalvarAnotacoes = null;
        let modoAtual = null;
        let comentariosAbertos = false;

        function atualizarStatusLeitor(texto) {
            const status = document.getElementById("status-leitor");
            if (status) status.innerText = texto;
        }

        function esconderCarregamento() {
            document.getElementById("leitor-carregando").classList.add("oculto");
        }

        function alterarStatus(texto) {
            const status = document.getElementById("status-anotacao");
            if (status) status.innerText = texto;
        }

        function atualizarBotaoComentarios() {
            const botao = document.getElementById("botao-comentarios");
            if (!botao) return;
            botao.classList.toggle("ativa", comentariosAbertos);
            botao.setAttribute("aria-pressed", String(comentariosAbertos));
        }

        /* Recupera a página salva */
        function tentarRestaurarPagina() {
            if (!apisPDF || !primeiraPaginaPronta || paginaRestaurada || paginaSalva <= 1) return;
            paginaRestaurada = true;
            apisPDF.gotoLocation(paginaSalva).catch(function (error) {
                console.log("Erro ao restaurar página:", error);
            });
        }

        /* Salva o progresso */
        function iniciarSalvamentoProgresso() {
            if (!usuarioLogado || !apisPDF || intervaloProgresso) return;
            let ultimaPagina = paginaSalva;
            intervaloProgresso = setInterval(function () {
                apisPDF.getCurrentPage().then(function (pagina) {
                    if (pagina > 0 && pagina !== ultimaPagina) {
                        ultimaPagina = pagina;
                        const dados = new URLSearchParams();
                        dados.append("id_livro", idLivro);
                        dados.append("pagina", pagina);
                        fetch("salvarProgresso.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: dados.toString()
                        }).catch(function (error) {
                            console.log("Erro ao salvar progresso:", error);
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }, 2000);
        }

        /* Inicia o leitor Adobe */
        function iniciarAdobe() {
            if (adobeIniciado || typeof AdobeDC === "undefined") return;
            adobeIniciado = true;
            const adobeDCView = new AdobeDC.View({
                clientId: "3b7769027df64a1d8636d65ce94bcb48",
                divId: "adobe-dc-view",
                locale: "pt-BR"
            });
            adobeDCView.registerCallback(
                AdobeDC.View.Enum.CallbackType.EVENT_LISTENER,
                function (event) {
                    if (event.type === "APP_RENDERING_START") {
                        atualizarStatusLeitor("Abrindo seu livro...");
                    }
                    if (event.type === "APP_RENDERING_DONE") {
                        primeiraPaginaPronta = true;
                        esconderCarregamento();
                        tentarRestaurarPagina();
                        if (usuarioLogado && !anotacoesIniciadas) {
                            alterarStatus("Preparando ferramentas...");
                        }
                    }
                    if (event.type === "PDF_VIEWER_READY") {
                        pdfViewerReady = true;
                        if (usuarioLogado && adobeViewerAtual) {
                            prepararAnotacoes(adobeViewerAtual);
                        }
                    }
                    if (event.type === "APP_RENDERING_FAILED") {
                        atualizarStatusLeitor("Não foi possível abrir este PDF.");
                        document.getElementById("leitor-carregando").classList.remove("oculto");
                        alterarStatus("Erro ao carregar o PDF");
                    }
                }, {
                enableFilePreviewEvents: true
            }
            );
            const previewFilePromise = adobeDCView.previewFile({
                content: {
                    location: {
                        url: urlPDF
                    }
                },
                metaData: {
                    fileName: nomePDF,
                    id: <?php echo json_encode($pdf_id); ?>
                }
            }, {
                embedMode: "FULL_WINDOW",
                defaultViewMode: "FIT_WIDTH",
                showZoomControl: true,
                showAnnotationTools: usuarioLogado,
                enableAnnotationAPIs: usuarioLogado,
                includePDFAnnotations: false,
                showDownloadPDF: false,
                showPrintPDF: false,
                showThumbnails: false,
                showBookmarks: false,
                enableLinearization: true
            });
            previewFilePromise.then(function (adobeViewer) {
                adobeViewerAtual = adobeViewer;
                adobeViewer.getAPIs().then(function (apis) {
                    apisPDF = apis;
                    tentarRestaurarPagina();
                    iniciarSalvamentoProgresso();
                }).catch(function (error) {
                    console.log("Erro ao preparar APIs do PDF:", error);
                });
                if (pdfViewerReady && usuarioLogado) {
                    prepararAnotacoes(adobeViewer);
                }
            }).catch(function (error) {
                console.log("Erro ao abrir PDF:", error);
                atualizarStatusLeitor("Não foi possível abrir o livro.");
                alterarStatus("Erro ao abrir o PDF");
                document.getElementById("leitor-carregando").classList.remove("oculto");
            });
        }

        /* Prepara as ferramentas */
        function prepararAnotacoes(adobeViewer) {
            if (!usuarioLogado || anotacoesIniciadas || preparandoAnotacoes) return;
            preparandoAnotacoes = true;
            alterarStatus("Ativando ferramentas...");
            adobeViewer.getAnnotationManager().then(function (annotationManager) {
                gerenciadorAnotacoes = annotationManager;
                return gerenciadorAnotacoes.setConfig({
                    showToolbar: false,
                    showCommentsPanel: false,
                    showToolsOnTextSelection: false,
                    downloadWithAnnotations: false,
                    printWithAnnotations: false
                });
            }).then(function () {
                return carregarAnotacoes();
            }).then(function (carregou) {
                registrarEventos();
                anotacoesIniciadas = true;
                preparandoAnotacoes = false;
                liberarFerramentas();
                if (carregou && anotacoesSalvas.length > 0) {
                    alterarStatus("Marcações carregadas");
                } else if (!carregou) {
                    alterarStatus("Algumas marcações não carregaram");
                }
            }).catch(function (error) {
                console.log("Erro ao preparar ferramentas:", error);
                preparandoAnotacoes = false;
                alterarStatus("Não foi possível preparar as ferramentas");
            });
        }

        function carregarAnotacoes() {
            if (!Array.isArray(anotacoesSalvas) || anotacoesSalvas.length === 0) {
                return Promise.resolve(true);
            }
            return gerenciadorAnotacoes.addAnnotations(anotacoesSalvas).then(function () {
                return true;
            }).catch(function (error) {
                console.log("Erro ao carregar marcações:", error);
                return false;
            });
        }

        function liberarFerramentas() {
            document.querySelectorAll(".ferramenta-anotacao").forEach(function (botao) {
                botao.disabled = false;
            });
            alterarStatus("Ferramentas prontas");
        }

        /* Destacar, sublinhar, desenhar e apagar */
        function ativarFerramenta(modo, botao) {
            if (!gerenciadorAnotacoes || !usuarioLogado) return;
            const opcoes = {
                cursor: "crosshair"
            };
            if (modo === "highlight") {
                opcoes.defaultColor = "#FFD54F";
                opcoes.cursor = "text";
            }
            if (modo === "underline") {
                opcoes.defaultColor = "#1F3A56";
                opcoes.cursor = "text";
            }
            if (modo === "shape") {
                opcoes.defaultColor = "#C6A25A";
                opcoes.strokeWidth = 3;
            }
            limparBotoes();
            modoAtual = modo;
            comentariosAbertos = false;
            atualizarBotaoComentarios();
            gerenciadorAnotacoes.setConfig({
                showCommentsPanel: false
            }).then(function () {
                return gerenciadorAnotacoes.startAnnotationMode(modo, opcoes);
            }).then(function () {
                botao.classList.add("ativa");
                if (modo === "highlight") {
                    alterarStatus("Selecione o trecho que deseja destacar");
                } else if (modo === "underline") {
                    alterarStatus("Selecione o trecho que deseja sublinhar");
                } else if (modo === "shape") {
                    alterarStatus("Desenhe no PDF");
                } else {
                    alterarStatus("Apague uma marcação de desenho");
                }
            }).catch(function (error) {
                console.log(error);
                modoAtual = null;
                alterarStatus("Não foi possível ativar a ferramenta");
            });
        }

        /* Abre e fecha as anotações */
        function alternarComentarios() {
            if (!gerenciadorAnotacoes || !usuarioLogado) return;
            const abrir = !comentariosAbertos;
            gerenciadorAnotacoes.endAnnotationMode();
            limparBotoes();
            comentariosAbertos = abrir;
            modoAtual = abrir ? "note" : null;
            atualizarBotaoComentarios();
            if (!abrir) {
                gerenciadorAnotacoes.unselectAnnotation();
            }
            gerenciadorAnotacoes.setConfig({
                showCommentsPanel: abrir
            }).then(function () {
                if (abrir) {
                    return gerenciadorAnotacoes.startAnnotationMode("note", {
                        defaultColor: "#C6A25A",
                        cursor: "crosshair"
                    });
                }
            }).then(function () {
                alterarStatus(abrir ? "Clique no PDF para adicionar uma anotação" : "Anotações fechadas");
            }).catch(function (error) {
                console.log(error);
                comentariosAbertos = false;
                modoAtual = null;
                atualizarBotaoComentarios();
                gerenciadorAnotacoes.setConfig({
                    showCommentsPanel: false
                });
                alterarStatus("Não foi possível alterar as anotações");
            });
        }

        /* Volta ao cursor normal */
        function voltarAoCursor(manterComentarios = false) {
            if (!gerenciadorAnotacoes) return;
            gerenciadorAnotacoes.endAnnotationMode();
            modoAtual = null;
            limparBotoes();
            comentariosAbertos = manterComentarios;
            atualizarBotaoComentarios();
            gerenciadorAnotacoes.setConfig({
                showCommentsPanel: manterComentarios
            }).then(function () {
                alterarStatus("Pronto");
            }).catch(function (error) {
                console.log(error);
            });
        }

        function limparBotoes() {
            document.querySelectorAll(".ferramenta-marcacao").forEach(function (botao) {
                botao.classList.remove("ativa");
            });
        }

        /* Eventos das marcações */
        function registrarEventos() {
            if (!gerenciadorAnotacoes || eventosRegistrados) return;
            eventosRegistrados = true;
            gerenciadorAnotacoes.registerEventListener(function (event) {
                if (event.type === "ANNOTATION_ADDED" ||
                    event.type === "ANNOTATION_UPDATED" ||
                    event.type === "ANNOTATION_DELETED") {
                    prepararSalvarAnotacoes();
                }

                if (event.type === "ANNOTATION_ADDED") {
                    const modoCriado = modoAtual;
                    if (modoCriado === "note" && comentariosAbertos) {
                        setTimeout(function () {
                            if (modoAtual === "note" && comentariosAbertos) {
                                voltarAoCursor(true);
                                alterarStatus("Escreva sua anotação e clique em Postar");
                            }
                        }, 150);
                    } else if (modoCriado !== null) {
                        setTimeout(function () {
                            if (modoAtual === modoCriado && !comentariosAbertos) {
                                gerenciadorAnotacoes.unselectAnnotation();
                                voltarAoCursor(false);
                            }
                        }, 150);
                    }
                }

                /* Não abre comentários ao selecionar marcações */
                if (event.type === "ANNOTATION_CLICKED" && !comentariosAbertos) {
                    gerenciadorAnotacoes.setConfig({
                        showCommentsPanel: false
                    }).catch(function (error) {
                        console.log(error);
                    });
                }

                /* Mantém os comentários fechados ao apagar */
                if (event.type === "ANNOTATION_DELETED" ||
                    event.type === "ANNOTATION_UPDATED") {
                    if (modoAtual === "eraser") {
                        setTimeout(function () {
                            if (modoAtual === "eraser" && !comentariosAbertos) {
                                voltarAoCursor(false);
                            }
                        }, 150);
                    } else if (!comentariosAbertos) {
                        gerenciadorAnotacoes.setConfig({
                            showCommentsPanel: false
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                }
            }, {
                listenOn: [
                    "ANNOTATION_ADDED",
                    "ANNOTATION_UPDATED",
                    "ANNOTATION_DELETED",
                    "ANNOTATION_CLICKED"
                ]
            });
        }

        /* Salva as marcações */
        function prepararSalvarAnotacoes() {
            clearTimeout(tempoSalvarAnotacoes);
            alterarStatus("Salvando...");
            tempoSalvarAnotacoes = setTimeout(salvarAnotacoes, 500);
        }

        function salvarAnotacoes() {
            if (!gerenciadorAnotacoes || !usuarioLogado) return;
            gerenciadorAnotacoes.getAnnotations({}).then(function (anotacoes) {
                const dados = new URLSearchParams();
                dados.append("id_livro", idLivro);
                dados.append("anotacoes", JSON.stringify(anotacoes));
                return fetch("salvarAnotacoes.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: dados.toString()
                });
            }).then(function (resposta) {
                return resposta.json();
            }).then(function (resultado) {
                alterarStatus(resultado.sucesso ? "Marcações salvas" : "Erro ao salvar");
            }).catch(function (error) {
                console.log("Erro ao salvar marcações:", error);
                alterarStatus("Erro ao salvar marcações");
            });
        }

        /* Carrega o SDK da Adobe */
        function carregarAdobeSDK() {
            const scriptAdobe = document.createElement("script");
            scriptAdobe.src = "https://acrobatservices.adobe.com/view-sdk/viewer.js";
            scriptAdobe.async = true;
            scriptAdobe.onload = function () {
                if (typeof AdobeDC !== "undefined") {
                    iniciarAdobe();
                }
            };
            scriptAdobe.onerror = function () {
                atualizarStatusLeitor("Não foi possível carregar o Adobe. Verifique sua conexão.");
                alterarStatus("Falha ao carregar o Adobe");
            };
            document.head.appendChild(scriptAdobe);
        }
        document.addEventListener("adobe_dc_view_sdk.ready", iniciarAdobe);
        carregarAdobeSDK();
    </script>
</body>

</html>