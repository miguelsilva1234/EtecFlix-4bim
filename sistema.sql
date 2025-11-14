-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/11/2025 às 04:46
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Criação do banco de dados (se não existir)
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
-- Adicionado campo 'imagem' para armazenar o caminho da imagem do filme
--

CREATE TABLE `filmes` (
  `idFilmes` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,  -- Título do filme
  `descricao` varchar(255) DEFAULT NULL,  -- Descrição do filme
  `data_lancamento` int(11) DEFAULT NULL,  -- Ano de lançamento (opcional)
  `tempo_filme` varchar(255) DEFAULT NULL,  -- Duração do filme (ex.: "120 min")
  `imagem` varchar(255) DEFAULT NULL  -- Caminho da imagem (ex.: "uploads/12345.jpg")
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `review`
-- Tabela para armazenar avaliações/reviews dos filmes
--

CREATE TABLE `review` (
  `idReview` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,  -- FK para o usuário que fez a review
  `idFilmes` int(11) DEFAULT NULL,  -- FK para o filme avaliado
  `nota` varchar(255) DEFAULT NULL,  -- Nota da avaliação (ex.: "8/10")
  `descricao` varchar(255) DEFAULT NULL  -- Descrição/comentário da review
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
-- Removida a FK 'idReview' pois não fazia sentido (um usuário não tem uma review única)
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,  -- Nome do usuário
  `email` varchar(255) DEFAULT NULL,  -- E-mail do usuário
  `senha` varchar(255) DEFAULT NULL  -- Senha do usuário (considere hashing para segurança)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`idFilmes`);

--
-- Índices de tabela `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idFilmes` (`idFilmes`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `idFilmes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `review`
--
ALTER TABLE `review`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`idFilmes`) REFERENCES `filmes` (`idFilmes`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;