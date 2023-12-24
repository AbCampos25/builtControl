-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 02-Jun-2023 às 21:28
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gabinete`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `costrucao`
--

DROP TABLE IF EXISTS `costrucao`;
CREATE TABLE IF NOT EXISTS `costrucao` (
  `fk_empresas_id` int(11) NOT NULL,
  PRIMARY KEY (`fk_empresas_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `categoria` varchar(50) DEFAULT NULL,
  `numero_cadastro` varchar(50) DEFAULT NULL,
  `ano` date DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`categoria`, `numero_cadastro`, `ano`, `nome`, `id`) VALUES
('Fiscalização', 'JEYLTDA/2023', '2023-05-08', 'Jey Ltda', 16),
('Fiscalização', 'EDYLDT/2023', '2023-05-24', 'EdyLdt', 17),
('Construção', 'OMATAPALO/2023', '2023-05-21', 'Omatapalo', 20),
('Construção', 'ANILC/2023', '2023-05-25', 'Anil Construções', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fiscalizacao`
--

DROP TABLE IF EXISTS `fiscalizacao`;
CREATE TABLE IF NOT EXISTS `fiscalizacao` (
  `fk_empresas_id` int(11) NOT NULL,
  PRIMARY KEY (`fk_empresas_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

DROP TABLE IF EXISTS `imagens`;
CREATE TABLE IF NOT EXISTS `imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `fk_obra_id` int(11) DEFAULT NULL,
  `fk_usuario_id` int(11) DEFAULT NULL,
  `fk_relatorio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_imagens_2` (`fk_obra_id`),
  KEY `FK_imagens_3` (`fk_relatorio_id`),
  KEY `FK_imagens_4` (`fk_usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id`, `nome`, `fk_obra_id`, `fk_usuario_id`, `fk_relatorio_id`) VALUES
(31, 'dc2922ee454440e51f8b30b02e5beb3b.jpg', NULL, NULL, 9),
(30, '623fc14e18160e5b9d40fee7c824e935.jpg', NULL, NULL, 9),
(29, 'e2846f59af5348be1bc5ace2110a187c.jpg', 23, NULL, NULL),
(28, 'f0ea7d4dbbf4ddc5cc5cb944654ce8b7.jpg', NULL, NULL, 8),
(27, '70d2f5f2c63737fc1bb1659f0cd2afdf.jpg', NULL, NULL, 8),
(26, '82b663e1e9804f849146114fc3d58205.jpg', NULL, NULL, 8),
(25, '1e11a9a36636575ecd0e90d0851d9fac.jpg', NULL, NULL, 7),
(23, 'fa2f3ddb43f4c74a24dff39757cff919.jpg', NULL, NULL, 6),
(22, 'e449475fe590c036a703a2d440c6496a.jpg', NULL, NULL, 6),
(24, 'ae4bf24e47d37572ac5e04bb6a422dac.jpg', 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `id_medico` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `especialidade` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `dataa` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`id_medico`, `nome`, `email`, `especialidade`, `telefone`, `dataa`, `hora`) VALUES
(1, 'Mateus Orlando', 'joao12@gmail.com', 'OrtopÃ©dico', '987643557', '2023-05-22', '13:07:00'),
(2, 'Mateus Orlando', 'medico1@gmail.com', 'Dentista', '987643557', '2023-05-24', '11:13:00'),
(3, 'Artur Paulo', 'medico2@gmail.com', 'Ginecologista', '933354456', '2023-05-23', '13:16:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obra`
--

DROP TABLE IF EXISTS `obra`;
CREATE TABLE IF NOT EXISTS `obra` (
  `duracao` smallint(6) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `orcamento` varchar(32) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  `fk_fiscalizacao_id` int(11) DEFAULT NULL,
  `fk_costrucao_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_obra_2` (`fk_fiscalizacao_id`),
  KEY `FK_obra_3` (`fk_costrucao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `obra`
--

INSERT INTO `obra` (`duracao`, `nome`, `orcamento`, `id`, `estado`, `fk_fiscalizacao_id`, `fk_costrucao_id`) VALUES
(4, 'Estrada 250', '12,435,345.999', 22, 'Em construção', 16, 21),
(6, 'fsee', '12435345', 23, 'Em construção', 16, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE IF NOT EXISTS `paciente` (
  `id_paciente` int(11) NOT NULL,
  `motivo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `morada` varchar(45) NOT NULL,
  `idade` int(11) NOT NULL,
  `contacto` varchar(45) NOT NULL,
  `profissao` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
CREATE TABLE IF NOT EXISTS `relatorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) DEFAULT NULL,
  `ponto_situacao` varchar(255) DEFAULT NULL,
  `irregularidades` varchar(255) DEFAULT NULL,
  `recomendacoes` varchar(255) DEFAULT NULL,
  `exec_financeira` int(11) DEFAULT NULL,
  `exec_fisica` int(11) DEFAULT NULL,
  `fk_obra_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_relatorio_2` (`fk_obra_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `relatorio`
--

INSERT INTO `relatorio` (`id`, `nome`, `ponto_situacao`, `irregularidades`, `recomendacoes`, `exec_financeira`, `exec_fisica`, `fk_obra_id`) VALUES
(7, 'Relatório1', 'Ponto1; Ponto2; Ponto3; Ponto4', 'Ponto1; Ponto2; Ponto3; Ponto4', 'Ponto1; Ponto2; Ponto3; Ponto4', 22, 35, 22),
(8, 'relatório2', 'Este é um ponto de situação; Este é outro ponto de situação; Este também é um  ponto de situação.', 'Este é um ponto de irregularidade; Este é outro ponto de irregularidade; Este também é um  ponto de irregularidade.', 'Este é um ponto de recomendação; Este é outro ponto de recomendação; Este também é um  ponto de recomendação.', 31, 50, 22),
(9, 'Jey', 'Colocaçao de Mosaico; Colocacao de cobertura', 'Atraso de execuçao', 'Os trabalhos estao em conformidade, porem havera a necessidade de substituir os materias necessarios para o reboco', 12, 15, 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretaria`
--

DROP TABLE IF EXISTS `secretaria`;
CREATE TABLE IF NOT EXISTS `secretaria` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `seccao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `secretaria`
--

INSERT INTO `secretaria` (`id`, `nome`, `email`, `telefone`, `seccao`) VALUES
(1, 'Manuela Antunes', 'manuela@gmail.com', '987643557', 'SecÃ§Ã£o1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `senha` varchar(99) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`) VALUES
(5, 'Ab&iacute;lio jey', 'e10adc3949ba59abbe56e057f20f883e', 'jey@hotmail.com'),
(3, 'testando', 'e10adc3949ba59abbe56e057f20f883e', 'j@hotmail.com'),
(4, 'Ab&iacute;lio jeyy', 'e10adc3949ba59abbe56e057f20f883e', 'aj@hotmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
