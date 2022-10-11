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
DROP DATABASE IF EXISTS sisurpe;

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
(01, 'CEI ANJOS DO ITAPOCOROI', 1, 'Avenida São João', 445),
(02, 'CEI DONA BELINHA', 1, 'Rua Vereador Arnô Reinaldo da Silva', 0),
(03, 'CEI JULIO CORREA DE MELLO', 1, 'Rua Sebastião Schmitz', 0),
(04, 'CEI MARA LÚCIA DE SOUZA DE MELO', 1, 'RUA PEDRO JOSÉ GOMES', 0),
(05, 'CEI MARIA DE LOURDES FRANCISCO GONÇALVES', 1, 'RUA PEDRO JOSÉ GOMES', 0),
(06, 'CEI MARIA LÚCIA FLORIANO', 1, 'Rua André Serafim Francisco', 108),
(07, 'CEI PINGO DE GENTE', 1, 'RUA ABÍLIO DE SOUZA - TRAV. BARBACENA', 488),
(08, 'CEI PROFª ORLANDINA BENTO MENDES', 1, 'Rua Antônio João Caldeira', 0),
(09, 'CEI PROFESSORA SIMONE APARECIDA REIS DE SOUZA', 1, 'Rua Lauro Zimerman Filho', 200),
(10, 'CRECHE CASA DA AMIZADE', 1, 'Rua Artur Silvino dos Reis', 63),
(11, 'CRECHE MUNICIPAL JOÃO BATISTA DA CRUZ', 1, 'Rua João Carlos Alves', 40),
(12, 'CRECHE MUNICIPAL TEREZINHA MARLENE CORREIA', 1, 'Rua Maria Joaquina Bento', 85),
(13, 'EI ANTONIO JOAQUIM TAVARES', 1, 'Rua Vereador João Manoel Bento', 0),
(14, 'EI CIPRIANO SILVINO CUSTODIO', 1, 'Avenida Geral da Santa Lidia', 0),
(15, 'EI MUN HORACINA SOARES FRANCISCO', 1, 'Rua Tiradentes', 0),
(16, 'EI SÃO NICOLAU', 1, 'Rua Ernesto dos Santos', 0),
(17, 'ESCOLA BÁSICA MUNICIPAL JOAO ANTONIO PINTO', 1, 'Rua Tijucas', 126),
(18, 'ESCOLA BÁSICA MUNICIPAL JOÃO BATISTA DA CRUZ', 1, 'Rua Margarida Vieira', 885),
(19, 'ESCOLA BÁSICA MUNICIPAL RUBENS JOÃO DE SOUZA', 1, 'Rua Calixto Luiz Honório', 325),
(20, 'ESCOLA MUNICIPAL MARIA EMILIA DA COSTA', 1, 'Rua Arnô Becker', 0),
(21, 'ESCOLA MUNICIPAL PROFESSORA IVONE NYMPHA MAIA ADRIANO', 1, 'Rua Paraná', 39),
(22, 'ESCOLA MUNICIPAL ROSALIA VALENTINA DALLAGO', 1, 'Rua Júlia da Costa Flores', 1922),
(23, 'GRUPO ESCOLAR MUNICIPAL ANTÔNIO JOSÉ TIAGO', 1, 'Rua Felipe João Anacleto', 1058),
(24, 'GRUPO ESCOLAR MUNICIPAL LACI SIMÃO CORREA', 1, 'Avenida São João', 0),
(25, 'GRUPO ESCOLAR MUNICIPAL RAQUEL FIGUEREDO DE ASSIS', 1, 'RUA JOÃO MARIANO FURTADO', 274);



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
(4, 3, 'PRÉ-I'),
(5, 3, 'PRÉ-II'),
(6, 3, 'PRÉ-III'),
(7, 3, '1º ANO'),
(8, 3, '2º ANO'),
(9, 3, '3º ANO'),
(10, 3, '4º ANO'),
(11, 3, '5º ANO'),
(12, 3, '6º ANO'),
(13, 3, '7º ANO'),
(14, 4, '8º ANO'),
(15, 4, '9º ANO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `linhas`
--

CREATE TABLE `linhas` (
  `id` int(11) NOT NULL,
  `linha` varchar(55) NOT NULL,
  `rota` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `linhas`
--

INSERT INTO `linhas` (`id`, `linha`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(4, '04'),
(5, '05'),
(6, '06'),
(7, '07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf` varchar(15),
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(10) DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `created_at`) VALUES
(1, 'Jeandrei', 'jeandreiwalter@gmail.com', '$2y$10$lyyCqzV/cJw5A8TpddC47Ow8K2iVHOHbKl.Nzs0fm/CgjuDBRZoMq','admin', '2018-11-23 10:19:18');


--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome_aluno` varchar(255) NOT NULL,
  `nascimento` date DEFAULT NULL,
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
  `end_rua` varchar(255) DEFAULT NULL,
  `end_numero` int(11) DEFAULT NULL,
  `end_bairro_id` int(11) DEFAULT NULL,
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
  `data_emissao_cert` date DEFAULT NULL,
  `municipio_cert` varchar(255) DEFAULT NULL,
  `cpf` char(15) DEFAULT NULL,
  `tipo_sanguineo` char(3) DEFAULT NULL,
  `fazUsoMed` char(3) DEFAULT NULL,
  `medicamentos` varchar(255) DEFAULT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  `deficiencias` varchar(255) DEFAULT NULL,
  `restric_alimentos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura para tabela `aluno_linha`
--

CREATE TABLE `aluno_linhas` (
  `id` int(11) NOT NULL,
  `linha_id` int(11) NOT NULL,
  `ano` char(4),
  `aluno_id` int(11) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_anuais`
--

CREATE TABLE `dados_anuais` (
  `id_da` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `escola_id` int(11) NOT NULL, 
  `etapa_id` int(11) NOT NULL, 
  `ano` char(4), 
  `kit_inverno` varchar(50) DEFAULT NULL,
  `kit_verao` varchar(50) DEFAULT NULL,  
  `tam_calcado` varchar(50) DEFAULT NULL,  
  `turno` char(1) DEFAULT NULL,
  `ultima_atual` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(11) NOT NULL, 
  `bairro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `bairros`
--


INSERT INTO `bairros` (`id`, `bairro`) VALUES
(1, 'CENTRO'),
(2, 'SANTA LIDIA'),
(3, 'SÃO NICOLAU'),
(4, 'MARISCAL');

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
-- Índices de tabela `linhas`
--
ALTER TABLE `linhas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `linhas`
--
ALTER TABLE `aluno_linhas`
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
  ADD PRIMARY KEY (`aluno_id`),
  ADD KEY `user_id` (`user_id`);


--
-- Índices de tabela `dados_anuais`
--
ALTER TABLE `dados_anuais`
  ADD PRIMARY KEY (`id_da`),
  ADD KEY `aluno_id` (`aluno_id`);
  

--
-- Índices de tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`);
 

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
-- AUTO_INCREMENT de tabela `linhas`
--
ALTER TABLE `linhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `linhas`
--
ALTER TABLE `aluno_linhas`
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
  MODIFY `aluno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


--
-- AUTO_INCREMENT de tabela `dados_anuais`
--
ALTER TABLE `dados_anuais`
  MODIFY `id_da` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--


ALTER TABLE `aluno_linhas`
  ADD CONSTRAINT `aluno_id` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`aluno_id`);


ALTER TABLE `aluno_linhas` 
  ADD CONSTRAINT `linha_id` FOREIGN KEY (`linha_id`) REFERENCES `linhas`(`id`);


--
-- Restrições para tabelas `dados_anuais`
--
ALTER TABLE `dados_anuais`
  ADD CONSTRAINT `dados_anuais_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`aluno_id`);
COMMIT;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- TRIGGERS
DELIMITER $

CREATE TRIGGER currentyear_dados_anuais BEFORE INSERT
ON dados_anuais
FOR EACH ROW
BEGIN
    SET new.ano = YEAR(NOW());
END$


DELIMITER ;



DELIMITER $

CREATE TRIGGER currentyear_aluno_linha BEFORE INSERT
ON aluno_linhas
FOR EACH ROW
BEGIN
    SET new.ano = YEAR(NOW());
END$







