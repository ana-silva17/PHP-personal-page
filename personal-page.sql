-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jul-2021 às 12:21
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `personal_page`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL COMMENT 'identifier',
  `name` varchar(50) NOT NULL COMMENT 'name',
  `email` varchar(50) NOT NULL COMMENT 'email',
  `phone` int(11) DEFAULT NULL COMMENT 'phone',
  `message` varchar(500) NOT NULL COMMENT 'message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Ana Silva', 'asfsilva87@gmail.com', 910000000, 'Olá!'),
(2, 'Teste', 'teste@gmail.com', 0, 'Olá');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL COMMENT 'identifier',
  `ufcd_code` varchar(10) NOT NULL COMMENT 'ufcd code',
  `ufcd_description` varchar(60) NOT NULL COMMENT 'ufcd description',
  `hours` int(11) NOT NULL COMMENT 'number of hours'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `subjects`
--

INSERT INTO `subjects` (`id`, `ufcd_code`, `ufcd_description`, `hours`) VALUES
(1, '0000', 'Mediação', 65),
(2, '0782', 'C++/Estrutura Básica', 50),
(3, '0778', 'Folha de Cálculo', 50),
(4, '0786', 'SGBD', 50),
(6, '0788', 'Servidores Web', 50),
(7, '0792', 'HTML', 25),
(8, '0793', 'CSS', 25),
(9, '0754', 'Processador de Texto', 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL COMMENT 'identifier',
  `ufcd_code_subjects` varchar(10) NOT NULL COMMENT 'ufcd code of subjects',
  `work_name` varchar(30) NOT NULL COMMENT 'work name',
  `file_work` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `works`
--

INSERT INTO `works` (`id`, `ufcd_code_subjects`, `work_name`, `file_work`) VALUES
(2, '0000', 'Portefólio', ''),
(3, '0788', 'Projeto PHP', ''),
(4, '0000', 'PRA', ''),
(5, '0778', 'Tabelas Dinâmicas', 'tabelasdinamicas.xlsx'),
(6, '0778', 'Formatação Condicional', 'formatacaocondicional.xlsx'),
(7, '0782', 'Calculadora', ''),
(8, '0778', 'Gráficos', 'graficos.xlsx'),
(9, '0754', 'Estações do Ano', 'estacoesano.docx');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ufcd_code` (`ufcd_code`);

--
-- Índices para tabela `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ufcd_code_subjects` (`ufcd_code_subjects`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifier', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifier', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifier', AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`ufcd_code_subjects`) REFERENCES `subjects` (`ufcd_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
