<?php

include "../../ARQUIVOS/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Usuário</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Fonte Lora -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">

    <!-- CSS DO PROJETO -->
    <link rel="stylesheet" href="../../css/style.css">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: "Lora", serif;
        }

        /* Área principal */
        .cadastro-usuario {
            max-width: 1200px;
            margin: 50px auto;
        }

        /* Card do cadastro */
        .card-cadastro {
            background-color: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: none;
        }

        /* Logo */
        .logo-cadastro {
            width: 180px;
            max-width: 100%;
            margin-bottom: 20px;
        }

        /* Título */
        .titulo-usuario {
            color: #1F3A56;
            font-weight: 600;
            text-align: center;
            margin-bottom: 35px;
        }

        /* Labels */
        .label-usuario {
            font-weight: 600;
            margin-bottom: 8px;
            color: #222;
        }

        /* Campos */
        .form-user {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 14px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #1F3A56;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        /* Botões */
        .botoes-usuario {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 35px;
        }

        .botao-cadastrar,
        .botao-cancelar-usuario {
            border: none;
            border-radius: 10px;
            padding: 11px 25px;
            font-size: 16px;
            font-family: "Lora", serif;
            margin: 5px;
            transition: 0.2s;
        }

        .botao-cadastrar {
            background-color: #1F3A56;
            color: white;
        }

        .botao-cadastrar:hover {
            background-color: #1F3A56;
            transform: translateY(-2px);
        }

        ss .botao-cancelar-usuario {
            background-color: #6c757d;
            color: white;
        }

        .botao-cancelar-usuario:hover {
            background-color: #5c636a;
            transform: translateY(-2px);
        }

        /* Tabela */
        .tabela-user {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .tabela-user thead {
            background-color: #1F3A56;
            color: white;
        }

        .tabela-user th {
            padding: 15px;
            font-weight: 600;
            text-align: center;
        }

        .tabela-user td {
            padding: 13px;
            text-align: center;
            vertical-align: middle;
            background-color: white;
            border-bottom: 1px solid #eeeeee;
        }

        .tabela-user tbody tr:hover td {
            background-color: #f1f6ff;
        }

        /* Ações */
        .acoes-usuario {
            white-space: nowrap;
        }

        .acoes-usuario a {
            text-decoration: none;
            margin: 0 5px;
        }

        .acoes-usuario img {
            transition: 0.2s;
        }

        .acoes-usuario img:hover {
            transform: scale(1.2);
        }

        /* Responsividade */
        @media (max-width: 768px) {

            .cadastro-usuario {
                margin: 20px auto;
            }

            .card-cadastro {
                padding: 25px 18px;
            }

            .tabela-user {
                font-size: 13px;
            }

            .tabela-user th,
            .tabela-user td {
                padding: 8px 5px;
            }

        }
    </style>

</head>

<body>

    <div class="container cadastro-usuario">

        <div class="card-cadastro">

            <!-- LOGO -->
            <div class="text-center">

                <img src="../../ARQUIVOS/img/logo.png" alt="Logo Bear Books" class="logo-cadastro">

            </div>


            <!-- TÍTULO -->

            <h2 class="titulo-usuario">
                Cadastro de Usuário
            </h2>


            <!-- FORMULÁRIO -->

            <form method="post" action="insertUser.php">

                <input type="hidden" name="id_user">


                <div class="row">

                    <!-- CPF -->

                    <div class="col-md-6 mb-3">

                        <label class="label-usuario">
                            CPF
                        </label>

                        <input type="text" name="cpf_user" class="form-control" placeholder="Digite o CPF" required>

                    </div>


                    <!-- NOME -->

                    <div class="col-md-6 mb-3">

                        <label class="label-usuario">
                            Nome
                        </label>

                        <input type="text" name="nome_user" class="form-control" placeholder="Digite o nome" required>

                    </div>


                    <!-- E-MAIL -->

                    <div class="col-md-6 mb-3">

                        <label class="label-usuario">
                            E-mail
                        </label>

                        <input type="email" name="email_user" class="form-control" placeholder="Digite o e-mail"
                            required>

                    </div>


                    <!-- SENHA -->

                    <div class="col-md-6 mb-3">

                        <label class="label-usuario">
                            Senha
                        </label>

                        <input type="password" name="senha_user" class="form-control" placeholder="Digite a senha"
                            required>

                    </div>

                </div>


                <!-- BOTÕES -->

                <div class="botoes-usuario">

                    <input type="submit" value="CADASTRAR" class="botao-cadastrar">

                    <input type="reset" value="CANCELAR" class="botao-cancelar-usuario">

                </div>

            </form>


          

        </div>


        <!-- Bootstrap JS -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>