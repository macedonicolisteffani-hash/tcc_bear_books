-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/08/2026 às 22:28
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
-- Estrutura para tabela `avaliacao_liv`
--

CREATE TABLE `avaliacao_liv` (
  `id_ava` int(5) NOT NULL,
  `id_usuario` int(5) DEFAULT NULL,
  `descricao_ava` text DEFAULT NULL,
  `data_ava` date DEFAULT NULL,
  `nivel_ava` int(5) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_liv`
--

CREATE TABLE `cadastro_liv` (
  `id_liv` int(5) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL,
  `autor` varchar(200) DEFAULT NULL,
  `classificacao` varchar(200) DEFAULT NULL,
  `ano` date DEFAULT NULL,
  `num_pagina` int(4) DEFAULT NULL,
  `edicao` varchar(250) DEFAULT NULL,
  `categoria_livexibicao` varchar(20) DEFAULT NULL,
  `foto_capa` varchar(300) DEFAULT NULL,
  `pdf_livro` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Índices de tabela `avaliacao_liv`
--
ALTER TABLE `avaliacao_liv`
  ADD PRIMARY KEY (`id_ava`),
  ADD KEY `fk_iduser` (`id_usuario`);

--
-- Índices de tabela `cadastro_adm`
--
ALTER TABLE `cadastro_adm`
  ADD PRIMARY KEY (`id_adm`);

--
-- Índices de tabela `cadastro_liv`
--
ALTER TABLE `cadastro_liv`
  ADD PRIMARY KEY (`id_liv`);

--
-- Índices de tabela `downloads_liv`
--
ALTER TABLE `downloads_liv`
  ADD PRIMARY KEY (`id_dow`),
  ADD KEY `fk_userid` (`id_user`),
  ADD KEY `fk_idliv` (`id_livro`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao_liv`
--
ALTER TABLE `avaliacao_liv`
  MODIFY `id_ava` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro_adm`
--
ALTER TABLE `cadastro_adm`
  MODIFY `id_adm` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro_liv`
--
ALTER TABLE `cadastro_liv`
  MODIFY `id_liv` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `downloads_liv`
--
ALTER TABLE `downloads_liv`
  MODIFY `id_dow` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacao_liv`
--
ALTER TABLE `avaliacao_liv`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`);

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
