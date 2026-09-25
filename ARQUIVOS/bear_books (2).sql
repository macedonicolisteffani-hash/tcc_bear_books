-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/09/2026 às 23:15
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bear_books`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliaçao`
--

CREATE TABLE `avaliaçao` (
  `id_ava` int(5) NOT NULL,
  `id_usuario` int(5) NOT NULL,
  `id_liv` int(5) NOT NULL,
  `comentario` text NOT NULL,
  `classificacao` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_adm`
--

CREATE TABLE `cadastro_adm` (
  `id_adm` int(5) NOT NULL,
  `cpf_adm` varchar(14) DEFAULT NULL,
  `nome_adm` varchar(100) DEFAULT NULL,
  `email_adm` varchar(100) DEFAULT NULL,
  `senha_adm` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_adm`
--

INSERT INTO `cadastro_adm` (`id_adm`, `cpf_adm`, `nome_adm`, `email_adm`, `senha_adm`) VALUES
(34, '51624906877', 'Nicoli Steffani Macedo', 'macedonicolisteffani@gmail.com', 'Lalola'),
(37, '51624906877', 'RUAN LOPES GONZALES DIAS', 'RUANZEIRA@GMAIL.COM', '123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_liv`
--

CREATE TABLE `cadastro_liv` (
  `id_liv` int(5) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `id_editora` int(5) DEFAULT NULL,
  `autor` varchar(200) DEFAULT NULL,
  `id_classificacao` int(5) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL,
  `num_pagina` int(4) DEFAULT NULL,
  `edicao` varchar(250) DEFAULT NULL,
  `id_categoria` int(5) DEFAULT NULL,
  `foto_capa` varchar(300) DEFAULT NULL,
  `pdf_livro` varchar(300) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_liv`
--

INSERT INTO `cadastro_liv` (`id_liv`, `titulo`, `isbn`, `descricao`, `id_editora`, `autor`, `id_classificacao`, `ano`, `num_pagina`, `edicao`, `id_categoria`, `foto_capa`, `pdf_livro`, `status`) VALUES
(1, 'Memorias postumas de Bras cubas', ' 978-85-402-0716-5', 'Clássico do realismo brasileiro escrito por Machado de Assis, a obra é narrada por Brás Cubas, um \"defunto autor\" que decide contar as memórias da sua vida após a sua morte. Com ironia, pessimismo e bom humor, ele analisa a sociedade carioca do século XIX, seus próprios fracassos amorosos e suas ambições frustradas.', 1, 'Machado de Assis', 1, '2018', 183, '67', 1, 'capa.jpg', 'memorias_postumas_bras_cubas.pdf', 'destaque');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(5) NOT NULL,
  `nome_categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Romance'),
(2, 'Drama'),
(3, 'Realismo'),
(4, 'Fantasia'),
(5, 'Aventura'),
(6, 'Suspense'),
(7, 'Mistério'),
(8, 'Filosofia'),
(9, 'Reflexão'),
(10, 'Infantojuvenil'),
(11, 'Contos'),
(12, 'Poesia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `classificacao`
--

CREATE TABLE `classificacao` (
  `id_classificacao` int(5) NOT NULL,
  `nome_classificacao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `classificacao`
--

INSERT INTO `classificacao` (`id_classificacao`, `nome_classificacao`) VALUES
(1, 'Literatura Brasileira'),
(2, 'Literatura Estrangeira'),
(3, 'Literatura Portuguesa'),
(4, 'Filosofia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `downloads_liv`
--

CREATE TABLE `downloads_liv` (
  `id_dow` int(5) NOT NULL,
  `id_user` int(5) DEFAULT NULL,
  `id_livro` int(5) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `id_editora` int(5) NOT NULL,
  `nome_editora` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`id_editora`, `nome_editora`) VALUES
(1, 'Darkside ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(5) NOT NULL,
  `cpf_user` varchar(20) DEFAULT NULL,
  `nome_user` varchar(200) DEFAULT NULL,
  `email_user` varchar(200) DEFAULT NULL,
  `senha_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliaçao`
--
ALTER TABLE `avaliaçao`
  ADD PRIMARY KEY (`id_ava`),
  ADD KEY `fk_avaliacao_usuario` (`id_usuario`),
  ADD KEY `fk_avaliacao_livro` (`id_liv`);

--
-- Índices de tabela `cadastro_adm`
--
ALTER TABLE `cadastro_adm`
  ADD PRIMARY KEY (`id_adm`);

--
-- Índices de tabela `cadastro_liv`
--
ALTER TABLE `cadastro_liv`
  ADD PRIMARY KEY (`id_liv`),
  ADD KEY `fk_livros_editora` (`id_editora`),
  ADD KEY `fk_livros_categoria` (`id_categoria`),
  ADD KEY `fk_livro_classificacao` (`id_classificacao`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `classificacao`
--
ALTER TABLE `classificacao`
  ADD PRIMARY KEY (`id_classificacao`);

--
-- Índices de tabela `downloads_liv`
--
ALTER TABLE `downloads_liv`
  ADD PRIMARY KEY (`id_dow`),
  ADD KEY `fk_userid` (`id_user`),
  ADD KEY `fk_idliv` (`id_livro`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`id_editora`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliaçao`
--
ALTER TABLE `avaliaçao`
  MODIFY `id_ava` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro_adm`
--
ALTER TABLE `cadastro_adm`
  MODIFY `id_adm` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `cadastro_liv`
--
ALTER TABLE `cadastro_liv`
  MODIFY `id_liv` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `classificacao`
--
ALTER TABLE `classificacao`
  MODIFY `id_classificacao` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `downloads_liv`
--
ALTER TABLE `downloads_liv`
  MODIFY `id_dow` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `id_editora` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliaçao`
--
ALTER TABLE `avaliaçao`
  ADD CONSTRAINT `fk_avaliacao_livro` FOREIGN KEY (`id_liv`) REFERENCES `cadastro_liv` (`id_liv`),
  ADD CONSTRAINT `fk_avaliacao_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`);

--
-- Restrições para tabelas `cadastro_liv`
--
ALTER TABLE `cadastro_liv`
  ADD CONSTRAINT `fk_livro_classificacao` FOREIGN KEY (`id_classificacao`) REFERENCES `classificacao` (`id_classificacao`),
  ADD CONSTRAINT `fk_livros_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_livros_editora` FOREIGN KEY (`id_editora`) REFERENCES `editora` (`id_editora`);

--
-- Restrições para tabelas `downloads_liv`
--
ALTER TABLE `downloads_liv`
  ADD CONSTRAINT `fk_idliv` FOREIGN KEY (`id_livro`) REFERENCES `cadastro_liv` (`id_liv`),
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
