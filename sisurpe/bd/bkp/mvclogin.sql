-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 15/08/2019 às 19:59
-- Versão do servidor: 5.7.25
-- Versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mvclogin`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `sexo` char(20) NOT NULL,
  `cor` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `sobrenome`, `sexo`, `cor`, `telefone`) VALUES
(1, 'Jeandrei', 'Walter', 'Masculino', 'Branca', '991169267'),
(2, 'Maricleia', 'Walter', 'Feminino', 'Branca', '991163863'),
(3, 'Dexter', 'Walter', 'Masculino', 'Preto', '4545644'),
(4, 'Biju', 'Walter', 'Feminino', 'Preta', '44548889'),
(5, 'Beinha', 'Walter', 'Feminino', 'Marrom', '446588'),
(6, 'Megui', 'Walter', 'Feminina', 'Preto', '4789789'),
(7, 'Bibi', 'Walter', 'Feminina', 'Preto', '4547864654'),
(8, 'Nina', 'Walter', 'Feminino', 'Branca', '454564512'),
(9, 'Orlando', 'Walter', 'Masculino', 'Branco', '5665456454'),
(10, 'Inez', 'Walter', 'Feminina', 'Branca', '44564464'),
(11, 'Carla', 'Quadke', 'Feminina', 'Branca', '4654445'),
(12, 'Patricia', 'Walerio', 'Feminina', 'Branca', '45446446'),
(13, 'Fabio', 'Quadke', 'Masculino', 'Branco', '545646546'),
(14, 'Gervasio', 'Walerio', 'Masculino', 'Branco', '5646546564');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(2, 1, 'Post Two', 'This is a test for post two', '2018-11-27 20:01:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Jeandrei', 'jeandreiwalter@gmail.com', '$2y$10$lyyCqzV/cJw5A8TpddC47Ow8K2iVHOHbKl.Nzs0fm/CgjuDBRZoMq', '2018-11-23 10:19:18'),
(2, 'teste1', 'teste1r@gmail.com', '$2y$10$Y3Phy8lW7ACZ41qrXjqOjuS26Jzj5WEoWa3mjNrNwWcHpyPKnOtji', '2018-11-27 15:29:36'),
(3, 'teste', 'jean.walter@penha.sc.gov.br', '$2y$10$EwxO3Gf78AQdSoVhVf6yxefdZFR2n3ON2w.t9XnyXsZPLJTNXfTGi', '2019-01-09 16:46:20');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
