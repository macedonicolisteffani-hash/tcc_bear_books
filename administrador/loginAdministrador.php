<?php
session_start();
include "../ARQUIVOS/conexao.php";
$erro = "";

/*O login precisa solicitar acesso ao servidor
SGBD MySQL para que ele possa verificar o login
e senha para entrar no sistema*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email_adm = $_POST['email_adm'];
    $senha_adm = $_POST['senha_adm'];

    /*Na linha SQL será realizado através do comando
SELECT o login pegando o email e a senha do administrador
e adicionado o comando LIMIT 1 para dizer que só
pode pegar 1 dado apenas*/
    $sql = "SELECT * FROM cadastro_adm
    WHERE email_adm = ? LIMIT 1";

    /*Na sequência dos códigos abaixo a variável $stmt
recebe o comando SQL e através do bind_param (
que é utilizado para se comunicar com o bd) ele 
envia a quantidade de informações que o banco precisa
para logar, o banco recebe, consulta na tabela
administrador e retorna se este usuário existe*/
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_adm);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $administrador = $resultado->fetch_assoc();

        //if (password_verify($senha_adm, $administrador['senha_adm'])) { // Linha com criptografia
        if ($senha_adm === $administrador['senha_adm']) {
            $_SESSION['admin'] = $administrador['nome_adm'];
            $_SESSION['id_adm'] = $administrador['id_adm'];

            header("Location: menuAdministrador.php");
            exit;
        } else {
            $erro = "Email ou senha incorretos.";
        }
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="login-page">
    <div class="container mt-5">
        <div class="row align-items-center justify-content-center g-4">

            <!-- COLUNA DA ESQUERDA: LOGO -->
            <div class="col-12 col-md-5 col-lg-4 text-center">
                <img src="../ARQUIVOS/img/logo.png" alt="Logo ADM" class="img-fluid">
            </div>

            <!-- COLUNA DA DIREITA: FORMULÁRIO -->
            <div class="col-12 col-md-7 col-lg-6 d-flex justify-content-center">
                <div class="card p-5 shadow-lg w-100 rounded-4"> <!--rounded-4: classe pronta do Bootstrap para arredondar o card-->

                    <h2 class="text-center mb-5 text-primary">
                        Welcome<br><span class="fs-5">adm</span> <!--fs-5: classe do Bootstrap para deixar o botão maior-->
                    </h2>


                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= $erro ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-4">
                            <label for="email" class="form-label text-black">Email</label>
                            <input type="email" class="form-control" id="email" name="email_adm"
                                placeholder="insira seu e-mail" required>
                        </div>

                        <div class="mb-4">
                            <label for="senha" class="form-label text-black">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha_adm"
                                placeholder="Insira sua Senha" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4 btn-lg"> <!--bnt-lg: classe do Bootstrap para deixar o botão maior---->
                                Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>