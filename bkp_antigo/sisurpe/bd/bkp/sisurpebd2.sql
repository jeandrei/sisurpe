-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 04/01/2019 às 13:03
-- Versão do servidor: 5.7.23
-- Versão do PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisurpe`
--
CREATE DATABASE sisurpe CHARACTER SET utf8 COLLATE utf8_general_ci;

use sisurpe;
-- --------------------------------------------------------



--
-- Estrutura para tabela `escola`
--

CREATE TABLE `escola` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `bairro_id` int(11) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `escola`
--

INSERT INTO `escola` (`id`, `nome`, `bairro_id`, `logradouro`, `numero`) VALUES
(4, 'CEI ANJOS DO ITAPOCOROI', 1, 'Avenida São João', 445),
(5, 'CEI DONA BELINHA', 3, 'Rua Vereador Arnô Reinaldo da Silva', 0),
(6, 'CEI MARA LÚCIA DE SOUZA DE MELO', 1, 'Rua Vereador Arnô Reinaldo da Silva', 0),
(7, 'CEI PINGO DE GENTE', 1, 'RUA ABÍLIO DE SOUZA - TRAV. BARBACENA', 488),
(8, 'CEI PROFª ORLANDINA BENTO MENDES', 3, 'Rua Antônio João Caldeira', 0),
(9, 'CEI PROFESSORA SIMONE APARECIDA REIS DE SOUZA', 5, 'Rua Lauro Zimerman Filho', 200),
(10, 'CRECHE CASA DA AMIZADE', 5, 'Rua Artur Silvino dos Reis', 63),
(11, 'CRECHE MUNICIPAL JOÃO BATISTA DA CRUZ', 5, 'Rua João Carlos Alves', 40),
(12, 'CRECHE MUNICIPAL TEREZINHA MARLENE CORREIA', 5, 'Rua Maria Joaquina Bento', 85);

-- --------------------------------------------------------

--
-- Estrutura para tabela `etapa`
--

CREATE TABLE `etapa` (
  `id` int(11) NOT NULL,
  `idade` int(2) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `etapa`
--

INSERT INTO `etapa` (`id`, `idade`, `descricao`) VALUES
(1, 1, 'BERÇÁRIO-I'),
(2, 2, 'BERÇÁRIO-II'),
(3, 3, 'MATERNAL'),
(4, 4, 'PRÉ-I');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` char(5) DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Jeandrei', 'jeandreiwalter@gmail.com', '$2y$10$lyyCqzV/cJw5A8TpddC47Ow8K2iVHOHbKl.Nzs0fm/CgjuDBRZoMq','admin' '2018-11-23 10:19:18'),
(2, 'teste1', 'teste1r@gmail.com', '$2y$10$Y3Phy8lW7ACZ41qrXjqOjuS26Jzj5WEoWa3mjNrNwWcHpyPKnOtji', '2018-11-27 15:29:36'),
(3, 'teste', 'jean.walter@penha.sc.gov.br', '$2y$10$EwxO3Gf78AQdSoVhVf6yxefdZFR2n3ON2w.t9XnyXsZPLJTNXfTGi', '2019-01-09 16:46:20');

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome_aluno` varchar(255) NOT NULL,
  `nascimento` datetime DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `telefone_aluno` char(20) DEFAULT NULL,
  `email_aluno` varchar(255) DEFAULT NULL,
  `nome_pai` varchar(255) DEFAULT NULL,
  `telefone_pai` char(20) DEFAULT NULL,
  `nome_mae` varchar(255) DEFAULT NULL,
  `telefone_mae` char(20) DEFAULT NULL,
  `nome_responsavel` varchar(255) DEFAULT NULL,
  `telefone_resp` char(20) DEFAULT NULL,
  `naturalidade` varchar(255) DEFAULT NULL,
  `nacionalidade` varchar(255) DEFAULT NULL,
  `rg` char(15) DEFAULT NULL,
  `uf_rg` char(2) DEFAULT NULL,
  `orgao_emissor` char(5) DEFAULT NULL,
  `titulo_eleitor` varchar(20) DEFAULT NULL,
  `zona` char(11) DEFAULT NULL,
  `secao` char(11) DEFAULT NULL,
  `certidao` varchar(255) DEFAULT NULL,
  `uf_cert` char(2) DEFAULT NULL,
  `cartorio_cert` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `numero` char(11) DEFAULT NULL,
  `folha` char(11) DEFAULT NULL,
  `livro` varchar(255) DEFAULT NULL,
  `data_emissao_cert` datetime DEFAULT NULL,
  `municipio_cert` varchar(255) DEFAULT NULL,
  `cpf` char(15) DEFAULT NULL,
  `tipo_sanguineo` char(3) DEFAULT NULL,
  `faz_uso_medicacao` char(3) DEFAULT NULL,
  `medicamentos` varchar(255) DEFAULT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  `deficiencias` varchar(255) DEFAULT NULL,
  `restric_alimentos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estrutura para tabela `ano`
--

CREATE TABLE `ano` (
  `id_ano` int(11) NOT NULL,
  `ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_anuais`
--

CREATE TABLE `dados_anuais` (
  `id_da` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `ano_id` int(11) NOT NULL,
  `usa_transporte` char(3) DEFAULT NULL,
  `linha` varchar(255) DEFAULT NULL,
  `tam_moletom` varchar(50) DEFAULT NULL,
  `tam_camiseta` varchar(50) DEFAULT NULL,
  `tam_calca` varchar(50) DEFAULT NULL,
  `tam_bermuda` varchar(50) DEFAULT NULL,
  `tam_calcado` varchar(50) DEFAULT NULL,
  `tam_meia` varchar(50) DEFAULT NULL,
  `escola` varchar(255) DEFAULT NULL,
  `turma` char(50) DEFAULT NULL,
  `turno` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `etapa`
--
ALTER TABLE `etapa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `ano`
--
ALTER TABLE `ano`
  ADD PRIMARY KEY (`id_ano`);

--
-- Índices de tabela `dados_anuais`
--
ALTER TABLE `dados_anuais`
  ADD PRIMARY KEY (`id_da`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `ano_id` (`ano_id`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `etapa`
--
ALTER TABLE `etapa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ano`
--
ALTER TABLE `ano`
  MODIFY `id_ano` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dados_anuais`
--
ALTER TABLE `dados_anuais`
  MODIFY `id_da` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `dados_anuais`
--
ALTER TABLE `dados_anuais`
  ADD CONSTRAINT `dados_anuais_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `dados_anuais_ibfk_2` FOREIGN KEY (`ano_id`) REFERENCES `ano` (`id_ano`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id_aluno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
