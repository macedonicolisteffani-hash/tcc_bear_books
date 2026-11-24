-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2026 às 15:03
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
-- Estrutura para tabela `anotacao_livro`
--

CREATE TABLE `anotacao_livro` (
  `id_anotacao` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_liv` int(11) NOT NULL,
  `anotacao` longtext NOT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anotacao_livro`
--

INSERT INTO `anotacao_livro` (`id_anotacao`, `id_user`, `id_liv`, `anotacao`, `data_atualizacao`) VALUES
(1, 2, 2, '[{\"@context\":[\"https://www.w3.org/ns/anno.jsonld\",\"https://comments.acrobat.com/ns/anno.jsonld\"],\"id\":\"6b0dc52d-095b-41e5-91d4-4c2071ca65f5\",\"type\":\"Annotation\",\"motivation\":\"commenting\",\"bodyValue\":\"\",\"target\":{\"source\":\"54745ced-c8bd-873a-0e22-f4a0dd7325e3\",\"selector\":{\"node\":{\"index\":1},\"quadPoints\":[56.948695019290916,579.4045487764529,173.7295632866976,579.4045487764529,56.948695019290916,565.3475924109317,173.7295632866976,565.3475924109317,56.948695019290916,551.2906360454106,106.32825968791659,551.2906360454106,56.948695019290916,539.7567231301111,106.32825968791659,539.7567231301111,56.948695019290916,539.7567231301111,107.76999880232901,539.7567231301111,56.948695019290916,529.3041145506211,107.76999880232901,529.3041145506211,56.948695019290916,522.8162885357651,121.82695516785019,522.8162885357651,56.948695019290916,511.2823756204657,121.82695516785019,511.2823756204657,56.948695019290916,511.2823756204657,169.0439111648572,511.2823756204657,56.948695019290916,500.8297670409755,169.0439111648572,500.8297670409755,56.948695019290916,493.98150624751656,144.89478099844905,493.98150624751656,56.948695019290916,482.8080281108202,144.89478099844905,482.8080281108202,56.948695019290916,482.8080281108202,172.64825895088828,482.8080281108202,56.948695019290916,471.99498475272696,172.64825895088828,471.99498475272696],\"opacity\":0.4,\"subtype\":\"highlight\",\"boundingBox\":[56.948695019290916,471.99498475272696,173.7295632866976,579.4045487764529],\"strokeColor\":\"#9643fc\",\"type\":\"AdobeAnnoSelector\"}},\"creator\":{\"id\":\"Guest\",\"name\":\"Guest\",\"type\":\"Person\"},\"created\":\"2026-10-30T21:42:46Z\",\"modified\":\"2026-10-30T21:42:57Z\"},{\"@context\":[\"https://www.w3.org/ns/anno.jsonld\",\"https://comments.acrobat.com/ns/anno.jsonld\"],\"id\":\"60723860-2bf9-4fee-b0c2-5e3cb72562a5\",\"type\":\"Annotation\",\"motivation\":\"commenting\",\"bodyValue\":\"\",\"target\":{\"source\":\"54745ced-c8bd-873a-0e22-f4a0dd7325e3\",\"selector\":{\"node\":{\"index\":1},\"quadPoints\":[56.58826024068781,465.8675935164742,224.1904322911326,465.8675935164742,56.58826024068781,454.33368060117476,224.1904322911326,454.33368060117476,56.58826024068781,454.33368060117476,137.3256506477838,454.33368060117476,56.58826024068781,443.88107202168464,137.3256506477838,443.88107202168464,56.58826024068781,437.3932460068287,249.060432014747,437.3932460068287,56.58826024068781,425.85933309152927,249.060432014747,425.85933309152927,56.58826024068781,425.85933309152927,125.43130295388126,425.85933309152927,56.58826024068781,415.4067245120392,125.43130295388126,415.4067245120392,56.58826024068781,408.91889849718325,201.12260646053375,408.91889849718325,56.58826024068781,397.3849855818838,201.12260646053375,397.3849855818838,56.58826024068781,397.3849855818838,117.5017378246129,397.3849855818838,56.58826024068781,386.93237700239376,117.5017378246129,386.93237700239376,56.58826024068781,380.4445509875378,240.0495625496693,380.4445509875378,56.58826024068781,368.9106380722384,240.0495625496693,368.9106380722384],\"opacity\":1,\"subtype\":\"underline\",\"boundingBox\":[56.58826024068781,368.9106380722384,249.060432014747,465.8675935164742],\"strokeColor\":\"#1F3A56\",\"type\":\"AdobeAnnoSelector\"}},\"creator\":{\"id\":\"Guest\",\"name\":\"Guest\",\"type\":\"Person\"},\"created\":\"2026-10-30T21:48:38Z\",\"modified\":\"2026-10-30T21:48:38Z\"},{\"@context\":[\"https://www.w3.org/ns/anno.jsonld\",\"https://comments.acrobat.com/ns/anno.jsonld\"],\"id\":\"0b174b5d-ac5d-4e86-be81-f4cb0a07931b\",\"type\":\"Annotation\",\"motivation\":\"commenting\",\"bodyValue\":\"\",\"target\":{\"source\":\"54745ced-c8bd-873a-0e22-f4a0dd7325e3\",\"selector\":{\"node\":{\"index\":1},\"opacity\":0.4,\"subtype\":\"note\",\"boundingBox\":[338.0878223297144,437.7536807854318,355.38869170266355,455.05455015838095],\"strokeColor\":\"#C6A25A\",\"type\":\"AdobeAnnoSelector\"}},\"creator\":{\"id\":\"Guest\",\"name\":\"Guest\",\"type\":\"Person\"},\"created\":\"2026-10-30T21:49:00Z\",\"modified\":\"2026-10-30T21:49:00Z\"}]', '2026-10-30 18:49:01'),
(35, 2, 6, '[]', '2026-11-10 08:53:12'),
(39, 2, 3, '[]', '2026-11-10 12:00:14');

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
  `ano` smallint(5) UNSIGNED DEFAULT NULL,
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
(1, 'Memorias postumas de Bras cubas', ' 978-85-402-0716-5', 'Clássico do realismo brasileiro escrito por Machado de Assis, a obra é narrada por Brás Cubas, um \"defunto autor\" que decide contar as memórias da sua vida após a sua morte. Com ironia, pessimismo e bom humor, ele analisa a sociedade carioca do século XIX, seus próprios fracassos amorosos e suas ambições frustradas.', 1, 'Machado de Assis', 1, 2018, 183, '67', 1, 'capa.jpg', 'memorias_postumas_bras_cubas.pdf', 'destaque'),
(2, 'O Cortiço', '978-85-402-0527-7', ' Esta versão é um recurso eletrônico (e-book) lançado em 2018 pela editora Edições Câmara, integrando o número 12 da Série Prazer de Ler. Trata-se de uma edição moderna que disponibiliza gratuitamente o texto integral de um dos maiores clássicos da literatura brasileira, cujo objetivo é preservar e compartilhar o patrimônio cultural nacional.', 3, 'Aluísio Azevedo ', 1, 1880, 227, '2018', 1, 'ocortico.jpeg', 'o_cortiço.pdf', 'novidade'),
(3, 'Iracema', ' 978-85-402-0048-7 ', 'Uma das maiores obras-primas do Romantismo brasileiro.\r\nEm Iracema, José de Alencar constrói uma belíssima metáfora poética sobre as origens do Brasil e do povo cearense. A história acompanha o amor proibido entre a \"virgem dos lábios de mel\", uma jovem índia tabajara que guarda o segredo da jurema, e Martim, um guerreiro branco colonizador português. Uma narrativa repleta de lirismo, paixão, conflitos culturais e a exuberância da natureza tropical.', 3, 'José de Alencar', 1, 1865, 166, '2013', 1, 'Captura de tela 2026-10-22 133051.png', 'iracema.pdf', 'novidade'),
(4, 'Quincas Borbas', '978-65-984419-0-6', 'Quincas Borba — Machado de Assis\r\nPublicado em 1891, Quincas Borba é um dos grandes romances da fase realista de Machado de Assis e integra a famosa trilogia iniciada por Memórias Póstumas de Brás Cubas. A trama acompanha Pedro Rubião de Alvarenga, um humilde professor de Barbacena (MG) que herda uma vasta fortuna do excêntrico filósofo Quincas Borba — com a única condição de cuidar do cão homônimo do falecido.', 4, 'Machado de Assis', 1, 1891, 323, '1994', 1, 'Captura de tela 2026-10-22 154017.png', 'quincas_borba.pdf', 'destaque'),
(5, 'Senhora', '978-85-0774-5', 'Senhora (1875), de José de Alencar, é um dos grandes clássicos do Romantismo brasileiro. A obra acompanha Aurélia Camargo, uma jovem que, após enriquecer herdeiramente, vira a mesa contra o ex-noivo interesseiro que a abandonou: ela o \"compra\" em um casamento arranjado, transformando a relação em um embate de orgulho, poder e redenção', 3, 'José de Alencar', 1, 1875, 255, '2019', 1, 'Captura de tela 2026-10-22 155023.png', 'senhora.pdf', 'destaque'),
(6, 'Alice no País das Maravilhas', ' 978-65-5957-760-6', 'Mergulhe no País das Maravilhas!\r\nAcompanhe a jovem Alice em uma jornada mágica, surreal e cheia de enigmas após seguir um pressuroso Coelho Branco até sua toca. Entre chás intermináveis, figuras excêntricas e a temida Rainha de Copas, este clássico de Lewis Carroll desafia a lógica e convida leitores de todas as idades a questionarem o mundo ao redor. Uma obra atemporal de fantasia e nonsense que nunca perdeu o encanto.', 5, 'Lewis Carroll', 1, 1865, 16, '2020', 10, 'Captura de tela 2026-10-22 160449.png', 'Alice-no-Pais-das-Maravilhas.pdf', 'destaque');

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
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_liv` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_comentario` datetime DEFAULT current_timestamp(),
  `status_comentario` varchar(20) DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_user`, `id_liv`, `comentario`, `data_comentario`, `status_comentario`) VALUES
(6, 5, 2, 'ana', '2026-10-29 16:13:56', 'Ativo');

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
(1, 'Darkside '),
(3, 'Edições Câmara'),
(4, 'Edição FUVEST'),
(5, 'Faro Editorial');

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(5) NOT NULL,
  `id_usuario` int(5) DEFAULT NULL,
  `id_livro` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_usuario`, `id_livro`) VALUES
(25, 2, 1),
(26, 2, 2),
(29, 1, 1),
(30, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem_contato`
--

CREATE TABLE `mensagem_contato` (
  `id_mensagem` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `assunto` varchar(200) NOT NULL,
  `mensagem` text NOT NULL,
  `data_mensagem` datetime DEFAULT current_timestamp(),
  `status_mensagem` varchar(20) DEFAULT 'Não lida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagem_contato`
--

INSERT INTO `mensagem_contato` (`id_mensagem`, `nome`, `email`, `assunto`, `mensagem`, `data_mensagem`, `status_mensagem`) VALUES
(1, 'rogerio martins', 'roger@gmail.com', 'livro', 'dificuldade em acessar um livro', '2026-10-27 16:53:34', 'Não lida');

-- --------------------------------------------------------

--
-- Estrutura para tabela `progresso_leitura`
--

CREATE TABLE `progresso_leitura` (
  `id_progresso` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_liv` int(11) NOT NULL,
  `pagina_atual` int(11) NOT NULL DEFAULT 1,
  `data_atualizacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `progresso_leitura`
--

INSERT INTO `progresso_leitura` (`id_progresso`, `id_user`, `id_liv`, `pagina_atual`, `data_atualizacao`) VALUES
(1, 2, 3, 13, '2026-11-10 11:59:59'),
(12, 2, 2, 1, '2026-10-30 18:49:08'),
(57, 2, 6, 6, '2026-11-10 11:44:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(5) NOT NULL,
  `cpf_user` varchar(20) DEFAULT NULL,
  `nome_user` varchar(200) DEFAULT NULL,
  `email_user` varchar(200) DEFAULT NULL,
  `senha_user` varchar(100) DEFAULT NULL,
  `status_user` varchar(20) NOT NULL DEFAULT 'Ativo',
  `foto_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `cpf_user`, `nome_user`, `email_user`, `senha_user`, `status_user`, `foto_user`) VALUES
(1, '514.209.068-78', 'rafaele', 'maria@gmail.com', 'Lalola', 'Ativo', 'usuario_1_1791489531.jpeg'),
(2, '514.209.068-77', 'rogerio martins', 'roger@gmail.com', 'lalola', 'Ativo', 'usuario_2.jpg'),
(4, '514.209.068-77', 'pedro', 'victin@gmail.com', '123', 'Ativo', NULL),
(5, '34343434343', 'pedrin', 'pedrocavalcante82@gmail.com', '123', 'Ativo', 'usuario_5.jpg'),
(6, '54767673801', 'Jubs Moraes', 'moraesjhulia08@gmail.com', 'jujubs', 'Ativo', 'usuario_6.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anotacao_livro`
--
ALTER TABLE `anotacao_livro`
  ADD PRIMARY KEY (`id_anotacao`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_liv`);

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
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_liv` (`id_liv`);

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
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iduser` (`id_usuario`),
  ADD KEY `fk_idlivo` (`id_livro`);

--
-- Índices de tabela `mensagem_contato`
--
ALTER TABLE `mensagem_contato`
  ADD PRIMARY KEY (`id_mensagem`);

--
-- Índices de tabela `progresso_leitura`
--
ALTER TABLE `progresso_leitura`
  ADD PRIMARY KEY (`id_progresso`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_liv`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anotacao_livro`
--
ALTER TABLE `anotacao_livro`
  MODIFY `id_anotacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `avaliaçao`
--
ALTER TABLE `avaliaçao`
  MODIFY `id_ava` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro_adm`
--
ALTER TABLE `cadastro_adm`
  MODIFY `id_adm` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `cadastro_liv`
--
ALTER TABLE `cadastro_liv`
  MODIFY `id_liv` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `classificacao`
--
ALTER TABLE `classificacao`
  MODIFY `id_classificacao` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `downloads_liv`
--
ALTER TABLE `downloads_liv`
  MODIFY `id_dow` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `id_editora` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `mensagem_contato`
--
ALTER TABLE `mensagem_contato`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `progresso_leitura`
--
ALTER TABLE `progresso_leitura`
  MODIFY `id_progresso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_liv`) REFERENCES `cadastro_liv` (`id_liv`);

--
-- Restrições para tabelas `downloads_liv`
--
ALTER TABLE `downloads_liv`
  ADD CONSTRAINT `fk_idliv` FOREIGN KEY (`id_livro`) REFERENCES `cadastro_liv` (`id_liv`),
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `fk_idlivo` FOREIGN KEY (`id_livro`) REFERENCES `cadastro_liv` (`id_liv`),
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
