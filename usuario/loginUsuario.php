<?php
session_start();
include "../ARQUIVOS/conexao.php";

$erro = "";

/* Login */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email_user = $_POST['email_user'];
    $senha_user = $_POST['senha_user'];

    $sql = "SELECT * FROM usuario WHERE email_user = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if ($senha_user == $usuario['senha_user']) {
            if ($usuario['status_user'] == 'Bloqueado') {
                $erro = "Sua conta está bloqueada.";
            } else {
                $_SESSION['usuario'] = $usuario['nome_user'];
                $_SESSION['id_user'] = $usuario['id_user'];
                header("Location: index.php");
                exit;
            }
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
    <title>Login Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="login-usuario-page">
<div class="container">
    <div class="login-usuario-container">

        <!-- Login -->
        <div class="logo-login-usuario">
            <img src="../ARQUIVOS/img/logo.png" alt="Logo Bear Books" class="img-fluid">
        </div>

        <div class="formulario-login-usuario">
            <div class="card p-5 shadow-lg w-100 rounded-4">
                <h2 class="text-center mb-5 text-primary">
                    Welcome<br>
                    <span class="fs-5">usuário</span>
                </h2>

                <?php if ($erro): ?>
                    <div class="alert alert-danger"><?= $erro ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="login" value="1">

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email_user" placeholder="Insira seu e-mail" required>
                    </div>

                    <div class="mb-4">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha_user" placeholder="Insira sua senha" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 btn-lg">Entrar</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-2">Ainda não possui cadastro?</p>
                    <a href="#" id="abrirCadastro">Cadastre-se</a>
                </div>
            </div>
        </div>

        <!-- Cadastro -->
        <div class="formulario-cadastro-usuario">
            <div class="card p-5 shadow-lg w-100 rounded-4">
                <h2 class="text-center mb-2 text-primary">Criar conta</h2>
                <h5 class="text-center mb-4 text-primary">Bear Books</h5>

                <form method="POST" action="user/insertUser.php">
                    <div class="mb-3">
                        <label for="cpf_user" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf_user" name="cpf_user" placeholder="Insira seu CPF" required>
                    </div>

                    <div class="mb-3">
                        <label for="nome_user" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome_user" name="nome_user" placeholder="Insira seu nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="email_user" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Insira seu e-mail" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha_user" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha_user" name="senha_user" placeholder="Crie uma senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>

                <div class="text-center">
                    <a href="#" id="voltarLogin">Já sou cadastrado</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="../js/loginUsuario.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>