-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Jun-2016 às 23:33
-- Versão do servidor: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appwork`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_nome` varchar(100) NOT NULL,
  `emp_cnpj` varchar(50) DEFAULT NULL,
  `emp_cep` varchar(10) NOT NULL,
  `emp_endereco` varchar(250) NOT NULL,
  `uf_codigo` int(11) NOT NULL,
  `cid_codigo` int(11) NOT NULL,
  `bai_codigo` int(11) NOT NULL,
  `emp_email` varchar(100) DEFAULT NULL,
  `emp_contato` varchar(100) DEFAULT NULL,
  `emp_fone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `fk_classificadoras_cidades` (`cid_codigo`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_classificadoras_cidades` FOREIGN KEY (`cid_codigo`) REFERENCES `cidades` (`cid_codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
