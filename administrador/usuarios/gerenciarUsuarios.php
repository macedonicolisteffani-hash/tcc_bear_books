<?php
include "../../ARQUIVOS/conexao.php";

$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <!-- Menu -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="../menuAdministrador.php">
                <img src="../../ARQUIVOS/img/logo.png" class="me-3">
            </a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../menuAdministrador.php">
                    <i class="bi bi-house-door-fill"></i>
                    Home do ADM
                </a>
            </div>

        </div>
    </nav>

    <!-- Usuários -->
    <div class="container mt-5 mb-5">

        <h2 class="titulo-pagina">Usuários Cadastrados</h2>

        <div class="table-responsive">

            <table class="table table-striped-columns table-bordered">

                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while ($row = $result->fetch_assoc()) { ?>

                        <tr>

                            <td class="text-center">
                                <?php echo $row['id_user']; ?>
                            </td>

                            <td>
                                <?php echo $row['cpf_user']; ?>
                            </td>

                            <td>
                                <?php echo $row['nome_user']; ?>
                            </td>

                            <td>
                                <?php echo $row['email_user']; ?>
                            </td>

                            <td class="text-center">
                                <?php echo $row['status_user']; ?>
                            </td>

                            <td class="text-center">

                                <?php if ($row['status_user'] == 'Ativo') { ?>

                                    <a href="bloquearUsuario.php?id_user=<?php echo $row['id_user']; ?>&status=Bloqueado"
                                        class="btn btn-danger">
                                        Bloquear
                                    </a>

                                <?php } else { ?>

                                    <a href="bloquearUsuario.php?id_user=<?php echo $row['id_user']; ?>&status=Ativo"
                                        class="btn btn-primary">
                                        Desbloquear
                                    </a>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- Rodapé -->
    <footer class="footer">
        <p class="mb-0">© 2026 Bear Books - Todos os direitos reservados.</p>
    </footer>

</body>

</html>