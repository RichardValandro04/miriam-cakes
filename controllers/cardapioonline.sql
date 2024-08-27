-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26-Ago-2024 às 04:12
-- Versão do servidor: 5.7.36
-- versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cardapioonline`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `doces`
--

CREATE TABLE `doces` (
  `pk_id_doce` int(11) NOT NULL,
  `nome_sabor` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_dezena` decimal(10,2) NOT NULL,
  `link_foto` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `doces`
--

INSERT INTO `doces` (`pk_id_doce`, `nome_sabor`, `valor_dezena`, `link_foto`, `descricao`) VALUES
(1, 'Beijinho', '9.90', 'imagens/beijo.jpg', 'Leite Condensado, Coco e Ninho'),
(2, 'Brigadeiro Gourmet', '10.45', 'imagens/brigadeiro.jpg', 'Leite Condensado, Cacau em Pó e Granulado'),
(3, 'Romeu e Julieta', '9.50', 'imagens/docegourmet.jpg', 'Leite Condensado, Queijo Ralado e Goiabada'),
(5, 'Brigadeiro de Cafe', '11.00', 'imagens/brigCafe.jpg', 'Leite Condensado, Café e Granulado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `pk_id_endereco` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `cep` int(11) NOT NULL,
  `rua` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_casa` int(11) NOT NULL,
  `complemento` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`pk_id_endereco`, `fk_id_usuario`, `cep`, `rua`, `bairro`, `cidade`, `uf`, `numero_casa`, `complemento`) VALUES
(4, 5, 29170177, 'Rua Ouro Preto', 'Nova Carapina ll', 'Serra', 'ES', 231, 'Portao de Madeira'),
(6, 28, 29175236, 'Rua Santa Mariana', 'Sao Francisco', 'Serra', 'ES', 65, 'Segunda Casa'),
(9, 30, 29170177, 'Rua Ouro Preto', 'Nova Carapina II', 'Serra', 'ES', 231, 'Casa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itembolo`
--

CREATE TABLE `itembolo` (
  `pk_id_item_bolo` int(11) NOT NULL,
  `fk_id_pedido` int(11) NOT NULL,
  `fk_id_tamanho_bolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `itembolo`
--

INSERT INTO `itembolo` (`pk_id_item_bolo`, `fk_id_pedido`, `fk_id_tamanho_bolo`) VALUES
(2, 7, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemdoce`
--

CREATE TABLE `itemdoce` (
  `fk_id_pedido` int(11) NOT NULL,
  `fk_id_doce` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valortotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `itemdoce`
--

INSERT INTO `itemdoce` (`fk_id_pedido`, `fk_id_doce`, `quantidade`, `valortotal`) VALUES
(7, 1, 100, '99.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pk_id_pedido` int(11) NOT NULL,
  `data_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `valortotal_pedido` decimal(10,2) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_endereco` int(11) DEFAULT NULL,
  `metodo_entrega` enum('entrega','retirada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'retirada',
  `situacao` enum('aguardando','em andamento','concluido','cancelado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aguardando'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`pk_id_pedido`, `data_entrega`, `hora_entrega`, `valortotal_pedido`, `fk_id_usuario`, `fk_id_endereco`, `metodo_entrega`, `situacao`) VALUES
(1, '2024-08-16', '23:25:08', '139.90', 5, 4, 'entrega', 'aguardando'),
(3, '2024-08-16', '23:25:08', '100.00', 5, 4, 'entrega', 'em andamento'),
(4, '2024-08-16', '23:25:08', '100.00', 5, 4, 'entrega', 'concluido'),
(5, '2024-08-16', '23:25:08', '100.00', 5, 4, 'entrega', 'cancelado'),
(7, '2024-08-30', '19:00:00', '219.00', 5, 4, 'entrega', 'aguardando');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recheiosbolo`
--

CREATE TABLE `recheiosbolo` (
  `pk_id_recheio` int(11) NOT NULL,
  `nome_recheio` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `recheiosbolo`
--

INSERT INTO `recheiosbolo` (`pk_id_recheio`, `nome_recheio`) VALUES
(1, 'Chocolate Cremoso'),
(2, 'Ninho com Nutella'),
(3, 'Laka Oreo'),
(4, 'Ninho Cremoso'),
(5, 'Nozes'),
(6, 'Ninho com KitKat'),
(8, 'Maracujá C/ Doce de Leite'),
(9, 'Côco Cremoso'),
(10, 'Ninho Com Morangos'),
(11, 'KitKat com Nutella');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recheiosescolhidos`
--

CREATE TABLE `recheiosescolhidos` (
  `pk_id_recheios_escolhidos` int(11) NOT NULL,
  `fk_id_item_bolo` int(11) NOT NULL,
  `fk_id_recheio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `recheiosescolhidos`
--

INSERT INTO `recheiosescolhidos` (`pk_id_recheios_escolhidos`, `fk_id_item_bolo`, `fk_id_recheio`) VALUES
(2, 2, 1),
(3, 2, 6),
(4, 2, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanhosbolo`
--

CREATE TABLE `tamanhosbolo` (
  `pk_id_tamanho_bolo` int(11) NOT NULL,
  `quantidade_fatias` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tamanhosbolo`
--

INSERT INTO `tamanhosbolo` (`pk_id_tamanho_bolo`, `quantidade_fatias`, `valor`) VALUES
(1, 4, '40.00'),
(2, 10, '80.00'),
(3, 20, '160.00'),
(4, 35, '200.00'),
(5, 45, '250.00'),
(6, 15, '120.00'),
(7, 50, '280.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `pk_id_usuario` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_usuario` enum('comum','confeiteira') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'comum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`pk_id_usuario`, `nome`, `email`, `cpf`, `telefone`, `senha`, `tipo_usuario`) VALUES
(5, 'Ríchard Batista Valandro', 'richardvalandro1@gmail.com', '20707433738', '(27) 99862-8468', '25d55ad283aa400af464c76d713c07ad', 'comum'),
(28, 'Mirian Rodrigues Littig', 'miriancakes@gmail.com', '\0\0\06\0\0\08\0\0\09\0\0\01\0\0\09\0\0\05\0\0\06\0\0\06\0\0\00\0\0\09\0\0\07', '\0\0\02\0\0\07\0\0\09\0\0\09\0\0\08\0\0\06\0\0\08\0\0\01\0\0\01\0\0\03\0\0\02', '8e2888c1bd2051831b676b052ff62fb8', 'confeiteira'),
(30, 'Victoria Batista Valandro', 'vicV@gmail.com', '20707510740', '(27) 99613-3509', '2ff5a75b7d8e43b448dea7e55de4eb1a', 'comum');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `doces`
--
ALTER TABLE `doces`
  ADD PRIMARY KEY (`pk_id_doce`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`pk_id_endereco`),
  ADD KEY `fk_id_usuario_endereco` (`fk_id_usuario`);

--
-- Índices para tabela `itembolo`
--
ALTER TABLE `itembolo`
  ADD PRIMARY KEY (`pk_id_item_bolo`),
  ADD KEY `fk_id_pedido_itembolo` (`fk_id_pedido`),
  ADD KEY `fk_id_tamanho_bolo_itembolo` (`fk_id_tamanho_bolo`);

--
-- Índices para tabela `itemdoce`
--
ALTER TABLE `itemdoce`
  ADD KEY `fk_id_doce_itemdoce` (`fk_id_doce`),
  ADD KEY `fk_id_pedido_itemdoce` (`fk_id_pedido`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pk_id_pedido`),
  ADD KEY `fk_id_endereco_pedidos` (`fk_id_endereco`),
  ADD KEY `fk_id_usuario_pedidos` (`fk_id_usuario`);

--
-- Índices para tabela `recheiosbolo`
--
ALTER TABLE `recheiosbolo`
  ADD PRIMARY KEY (`pk_id_recheio`);

--
-- Índices para tabela `recheiosescolhidos`
--
ALTER TABLE `recheiosescolhidos`
  ADD PRIMARY KEY (`pk_id_recheios_escolhidos`),
  ADD KEY `fk_id_item_bolo_escolhidos` (`fk_id_item_bolo`),
  ADD KEY `fk_id_recheio_escolhidos` (`fk_id_recheio`);

--
-- Índices para tabela `tamanhosbolo`
--
ALTER TABLE `tamanhosbolo`
  ADD PRIMARY KEY (`pk_id_tamanho_bolo`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`pk_id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `doces`
--
ALTER TABLE `doces`
  MODIFY `pk_id_doce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `pk_id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `itembolo`
--
ALTER TABLE `itembolo`
  MODIFY `pk_id_item_bolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pk_id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `recheiosbolo`
--
ALTER TABLE `recheiosbolo`
  MODIFY `pk_id_recheio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `recheiosescolhidos`
--
ALTER TABLE `recheiosescolhidos`
  MODIFY `pk_id_recheios_escolhidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tamanhosbolo`
--
ALTER TABLE `tamanhosbolo`
  MODIFY `pk_id_tamanho_bolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `pk_id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_id_usuario_endereco` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`pk_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `itembolo`
--
ALTER TABLE `itembolo`
  ADD CONSTRAINT `fk_id_pedido_itembolo` FOREIGN KEY (`fk_id_pedido`) REFERENCES `pedidos` (`pk_id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_tamanho_bolo_itembolo` FOREIGN KEY (`fk_id_tamanho_bolo`) REFERENCES `tamanhosbolo` (`pk_id_tamanho_bolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `itemdoce`
--
ALTER TABLE `itemdoce`
  ADD CONSTRAINT `fk_id_doce_itemdoce` FOREIGN KEY (`fk_id_doce`) REFERENCES `doces` (`pk_id_doce`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_pedido_itemdoce` FOREIGN KEY (`fk_id_pedido`) REFERENCES `pedidos` (`pk_id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_id_endereco_pedidos` FOREIGN KEY (`fk_id_endereco`) REFERENCES `endereco` (`pk_id_endereco`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_usuario_pedidos` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`pk_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `recheiosescolhidos`
--
ALTER TABLE `recheiosescolhidos`
  ADD CONSTRAINT `fk_id_item_bolo_escolhidos` FOREIGN KEY (`fk_id_item_bolo`) REFERENCES `itembolo` (`pk_id_item_bolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_recheio_escolhidos` FOREIGN KEY (`fk_id_recheio`) REFERENCES `recheiosbolo` (`pk_id_recheio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
