<?php
session_start();

header(
    "Content-Type: application/json; charset=utf-8"
);

include "../ARQUIVOS/conexao.php";

/* Precisa estar logado */

if (!isset($_SESSION['id_user'])) {

    http_response_code(401);

    echo json_encode([
        "sucesso" => false
    ]);

    exit;
}

/* Só aceita POST */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    http_response_code(405);

    echo json_encode([
        "sucesso" => false
    ]);

    exit;
}

$id_user =
    (int) $_SESSION['id_user'];

$id_livro =
    (int) ($_POST['id_livro'] ?? 0);

$anotacoes =
    $_POST['anotacoes'] ?? "";


/* Confere os dados */

if (
    $id_livro <= 0 ||
    $anotacoes === ""
) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false
    ]);

    exit;
}


/* Confere se é JSON */

$dados =
    json_decode(
        $anotacoes,
        true
    );

if (!is_array($dados)) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false
    ]);

    exit;
}


/* Salva ou atualiza */

$sql = "INSERT INTO anotacao_livro
(id_user, id_liv, anotacao, data_atualizacao)
VALUES (?, ?, ?, NOW())

ON DUPLICATE KEY UPDATE
anotacao = VALUES(anotacao),
data_atualizacao = NOW()";

$stmt =
    $conn->prepare($sql);

if (!$stmt) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false
    ]);

    exit;
}

$stmt->bind_param(
    "iis",
    $id_user,
    $id_livro,
    $anotacoes
);

if ($stmt->execute()) {

    echo json_encode([
        "sucesso" => true
    ]);

} else {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false
    ]);
}

$stmt->close();
$conn->close();
?>