<?php
session_start();
include "../ARQUIVOS/conexao.php";

header("Content-Type: application/json");

if(!isset($_SESSION['id_user'])){
    echo json_encode(["login" => false]);
    exit;
}

$id_usuario = $_SESSION['id_user'];
$id_livro = $_POST['id_livro'];

$sql = "SELECT id FROM favoritos
WHERE id_usuario=? AND id_livro=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii",$id_usuario,$id_livro);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $sql = "DELETE FROM favoritos
    WHERE id_usuario=? AND id_livro=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii",$id_usuario,$id_livro);
    $stmt->execute();

    echo json_encode([
        "login" => true,
        "favorito" => false
    ]);

}else{

    $sql = "INSERT INTO favoritos
    (id_usuario,id_livro)
    VALUES (?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii",$id_usuario,$id_livro);
    $stmt->execute();

    echo json_encode([
        "login" => true,
        "favorito" => true
    ]);
}
?>