-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13/12/2017 às 17:23
-- Versão do servidor: 10.1.24-MariaDB
-- Versão do PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `topway_teste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `participantes`
--

CREATE TABLE `participantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) NOT NULL,
  `date_insert` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `participantes`
--

INSERT INTO `participantes` (`id`, `nome`, `foto`, `descricao`, `date_insert`, `date_update`) VALUES
(4, 'Thor', 'Thor-Ragnarok-Chris-Hemsworth-0c939641.jpg', 'Deus do Trovão', '2017-12-13 10:39:52', '2017-12-13 12:43:30'),
(5, 'Alma Negra', 'alma_negra.jpg', 'Matou o Mar Morto', '2017-12-13 10:50:41', '2017-12-13 11:10:00'),
(7, 'Loki', 'loki.jpg', 'Deus da trapaça', '2017-12-13 10:55:20', '2017-12-13 11:12:48'),
(8, 'Chuck Norris', 'chuck_norris.jpg', 'Deus do Universo', '2017-12-13 10:56:24', '2017-12-13 11:08:44'),
(9, 'Capitão América', 'capita-america-entendi-a-referencia.jpg', 'O Primeiro VIngador', '2017-12-13 12:43:14', '2017-12-13 12:43:14'),
(10, 'Tony Stark', 'b0428653be79a1b4075ef11a63e5c5803a9fc119.jpg', 'Um gênio, bilionário, playboy, filantropo.', '2017-12-13 12:45:12', '2017-12-13 12:45:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `votos`
--

CREATE TABLE `votos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `participante_id` int(11) NOT NULL,
  `voto` tinyint(1) NOT NULL COMMENT '0 - Dislike, 1 - Like',
  `session` varchar(255) NOT NULL,
  `date_insert` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `votos`
--

INSERT INTO `votos` (`id`, `participante_id`, `voto`, `session`, `date_insert`, `date_update`) VALUES
(3, 4, 0, '5a3121b27fafc', '2017-12-13 10:49:08', '2017-12-13 10:49:08'),
(4, 5, 1, '5a3121b27fafc', '2017-12-13 10:51:16', '2017-12-13 13:31:52'),
(8, 8, 1, '5a3121b27fafc', '2017-12-13 10:56:36', '2017-12-13 10:56:36'),
(9, 8, 1, '5a3124c290514', '2017-12-13 11:01:57', '2017-12-13 11:01:57'),
(10, 8, 1, '5a3124ccda654', '2017-12-13 11:02:07', '2017-12-13 11:02:07'),
(11, 8, 0, '5a3124d7c883f', '2017-12-13 11:02:21', '2017-12-13 11:02:21'),
(12, 8, 1, '5a3124e30b490', '2017-12-13 11:02:29', '2017-12-13 11:02:29'),
(13, 8, 1, '5a3124f1b2f7e', '2017-12-13 11:02:44', '2017-12-13 11:02:44'),
(14, 8, 1, '5a3124f9e25bc', '2017-12-13 11:02:52', '2017-12-13 11:02:52'),
(15, 8, 1, '5a312501b51c3', '2017-12-13 11:03:00', '2017-12-13 11:03:00'),
(16, 8, 1, '5a3125086ba61', '2017-12-13 11:03:09', '2017-12-13 11:03:09'),
(17, 8, 1, '5a31251c0793f', '2017-12-13 11:03:27', '2017-12-13 11:03:27'),
(18, 8, 1, '5a3125250355d', '2017-12-13 11:03:35', '2017-12-13 11:03:35'),
(19, 4, 1, '5a3125250355d', '2017-12-13 11:03:44', '2017-12-13 11:03:44'),
(20, 7, 0, '5a3125250355d', '2017-12-13 11:03:50', '2017-12-13 11:04:03');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `votos`
--
ALTER TABLE `votos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
