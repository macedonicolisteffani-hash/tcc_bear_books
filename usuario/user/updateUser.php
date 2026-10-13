<?php
session_start();
include "../../ARQUIVOS/conexao.php";

if(!isset($_SESSION['id_user'])){
    header("Location: ../loginUsuario.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];

$cpf_user = $_POST['cpf_user'];
$nome_user = $_POST['nome_user'];
$email_user = $_POST['email_user'];
$nova_senha = $_POST['senha_user'];

/* Busca dados atuais */
$sql_usuario = "SELECT senha_user, foto_user
FROM usuario
WHERE id_user=$id_user";

$result_usuario = $conn->query($sql_usuario);
$usuario_atual = $result_usuario->fetch_assoc();

/* Senha */
if(!empty($nova_senha)){
    $senha_user = $nova_senha;
}else{
    $senha_user = $usuario_atual['senha_user'];
}

/* Foto atual */
$foto_user = $usuario_atual['foto_user'];

/* Nova foto */
if(isset($_FILES['foto_user']) &&
$_FILES['foto_user']['error'] === 0){

    $nome_arquivo = $_FILES['foto_user']['name'];
    $arquivo_temporario = $_FILES['foto_user']['tmp_name'];

    $extensao = strtolower(
        pathinfo($nome_arquivo,PATHINFO_EXTENSION)
    );

    $extensoes_permitidas = [
        "jpg",
        "jpeg",
        "png"
    ];

    if(!in_array($extensao,$extensoes_permitidas)){

        echo "<script>
        alert('Escolha uma imagem JPG ou PNG.');
        window.location.href='editarUser.php';
        </script>";

        exit;
    }

    $pasta = "../../ARQUIVOS/fotos_usuario/";

    /* Apaga foto antiga */
    if(!empty($foto_user) &&
    file_exists($pasta.$foto_user)){

        unlink($pasta.$foto_user);
    }

    /* Nome organizado */
    $novo_nome =
    "usuario_".$id_user.".".$extensao;

    if(move_uploaded_file(
        $arquivo_temporario,
        $pasta.$novo_nome
    )){

        $foto_user = $novo_nome;
    }
}

/* Atualiza usuário */
$sql = "UPDATE usuario SET
cpf_user=?,
nome_user=?,
email_user=?,
senha_user=?,
foto_user=?
WHERE id_user=?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssi",
    $cpf_user,
    $nome_user,
    $email_user,
    $senha_user,
    $foto_user,
    $id_user
);

if($stmt->execute()){

    $_SESSION['usuario'] = $nome_user;

    echo "<script>
    alert('Perfil atualizado com sucesso!');
    window.location.href='perfilUser.php';
    </script>";

}else{

    echo "Erro ao atualizar: ".$conn->error;
}
?>