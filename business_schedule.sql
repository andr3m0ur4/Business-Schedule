-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 23/08/2021 às 20:49
-- Versão do servidor: 8.0.26-0ubuntu0.20.04.2
-- Versão do PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `business_schedule`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrators`
--

CREATE TABLE `administrators` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `employee_hours`
--

CREATE TABLE `employee_hours` (
  `id` int NOT NULL,
  `start_time` time NOT NULL,
  `final_time` time NOT NULL,
  `date` date NOT NULL,
  `id_employee` int DEFAULT NULL,
  `id_schedule` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `schedules`
--

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `start_date` date NOT NULL,
  `final_date` date NOT NULL,
  `year` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `studios`
--

CREATE TABLE `studios` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `switchers`
--

CREATE TABLE `switchers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tv_shows`
--

CREATE TABLE `tv_shows` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `final_time` time NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `id_switcher` int DEFAULT NULL,
  `id_studio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tv_shows_hours`
--

CREATE TABLE `tv_shows_hours` (
  `id` int NOT NULL,
  `id_tv_show` int NOT NULL,
  `id_employee_hour` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `employee_hours`
--
ALTER TABLE `employee_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- Índices de tabela `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `switchers`
--
ALTER TABLE `switchers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tv_shows`
--
ALTER TABLE `tv_shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_switcher` (`id_switcher`),
  ADD KEY `id_studio` (`id_studio`);

--
-- Índices de tabela `tv_shows_hours`
--
ALTER TABLE `tv_shows_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tv_show` (`id_tv_show`),
  ADD KEY `id_employee_hour` (`id_employee_hour`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `employee_hours`
--
ALTER TABLE `employee_hours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `studios`
--
ALTER TABLE `studios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `switchers`
--
ALTER TABLE `switchers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tv_shows`
--
ALTER TABLE `tv_shows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tv_shows_hours`
--
ALTER TABLE `tv_shows_hours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `employee_hours`
--
ALTER TABLE `employee_hours`
  ADD CONSTRAINT `employee_hours_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `employee_hours_ibfk_2` FOREIGN KEY (`id_schedule`) REFERENCES `schedules` (`id`);

--
-- Restrições para tabelas `tv_shows`
--
ALTER TABLE `tv_shows`
  ADD CONSTRAINT `tv_shows_ibfk_1` FOREIGN KEY (`id_switcher`) REFERENCES `switchers` (`id`),
  ADD CONSTRAINT `tv_shows_ibfk_2` FOREIGN KEY (`id_studio`) REFERENCES `studios` (`id`);

--
-- Restrições para tabelas `tv_shows_hours`
--
ALTER TABLE `tv_shows_hours`
  ADD CONSTRAINT `tv_shows_hours_ibfk_1` FOREIGN KEY (`id_tv_show`) REFERENCES `tv_shows` (`id`),
  ADD CONSTRAINT `tv_shows_hours_ibfk_2` FOREIGN KEY (`id_employee_hour`) REFERENCES `employee_hours` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
