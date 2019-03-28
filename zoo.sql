-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 07. pro 2015, 21:58
-- Verze serveru: 5.6.21
-- Verze PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `zoo`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `cisteni`
--

CREATE TABLE IF NOT EXISTS `cisteni` (
`id` int(11) NOT NULL,
  `idvy` int(11) NOT NULL,
  `idpr` bigint(20) NOT NULL,
  `pocetos` int(11) NOT NULL,
  `tools` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `beg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `cisteni`
--

INSERT INTO `cisteni` (`id`, `idvy`, `idpr`, `pocetos`, `tools`, `beg`, `fin`) VALUES
(4, 12, 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `krmeni`
--

CREATE TABLE IF NOT EXISTS `krmeni` (
`id` int(255) NOT NULL,
  `idzv` int(11) NOT NULL,
  `idpr` bigint(20) DEFAULT NULL,
  `mnozstvi` int(11) DEFAULT NULL,
  `beg` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `krmeni`
--

INSERT INTO `krmeni` (`id`, `idzv`, `idpr`, `mnozstvi`, `beg`, `fin`) VALUES
(2, 4, 1, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `osetrovatel`
--

CREATE TABLE IF NOT EXISTS `osetrovatel` (
  `rc` bigint(20) NOT NULL,
  `role` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `jmeno` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `vzdelani` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `osetrovatel`
--

INSERT INTO `osetrovatel` (`rc`, `role`, `password`, `jmeno`, `prijmeni`, `vzdelani`) VALUES
(1, 'admin', '$2y$10$69M5SIMEekrQo6TbqUcnGOOVLHkPe7quS9Q0tVCdT0XKBGVUHMWf.', 'David', 'Bulawa', 'Maturita'),
(2, 'user', '$2y$10$u0z9RU7Y1bea8DsfEdsm4./zxWTPStKlkv3IKGXx44ODI9O3rb4mK', 'Matej', 'Bobula', 'Maturita'),
(3, 'user', '$2y$10$ww5MAqqOL7lOVQjeHvlriuFfjagIqQIZi.Q8kzLuHp/8SNi2ic5fW', 'Jan', 'Čeleda', 'Maturita');

-- --------------------------------------------------------

--
-- Struktura tabulky `skoleni`
--

CREATE TABLE IF NOT EXISTS `skoleni` (
`id` int(11) NOT NULL,
  `idpr` bigint(20) NOT NULL,
  `druh` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `skoleni`
--

INSERT INTO `skoleni` (`id`, `idpr`, `druh`) VALUES
(6, 2, 'Klec'),
(7, 2, 'bird');

-- --------------------------------------------------------

--
-- Struktura tabulky `vybeh`
--

CREATE TABLE IF NOT EXISTS `vybeh` (
`id` int(11) NOT NULL,
  `lastc` int(11) NOT NULL,
  `prof` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `tools` varchar(60) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `vybeh`
--

INSERT INTO `vybeh` (`id`, `lastc`, `prof`, `type`, `tools`) VALUES
(12, 0, '', 'Klec', 'kladivo'),
(13, 0, '', 'Vybeh', 'hrabe'),
(14, 0, '', 'Akvarium', 'prut');

-- --------------------------------------------------------

--
-- Struktura tabulky `zvire`
--

CREATE TABLE IF NOT EXISTS `zvire` (
`id` int(11) NOT NULL,
  `jmeno` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `druh` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `occurence` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `idvy` int(20) NOT NULL,
  `bd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rip` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lf` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `zvire`
--

INSERT INTO `zvire` (`id`, `jmeno`, `druh`, `occurence`, `idvy`, `bd`, `rip`, `lf`) VALUES
(4, 'yoru', 'bird', 'australie', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `cisteni`
--
ALTER TABLE `cisteni`
 ADD PRIMARY KEY (`id`), ADD KEY `idvy` (`idvy`), ADD KEY `idpr` (`idpr`);

--
-- Klíče pro tabulku `krmeni`
--
ALTER TABLE `krmeni`
 ADD PRIMARY KEY (`id`), ADD KEY `krmeni_ibfk_2` (`idzv`), ADD KEY `idpr` (`idpr`);

--
-- Klíče pro tabulku `osetrovatel`
--
ALTER TABLE `osetrovatel`
 ADD PRIMARY KEY (`rc`);

--
-- Klíče pro tabulku `skoleni`
--
ALTER TABLE `skoleni`
 ADD PRIMARY KEY (`id`), ADD KEY `idpr` (`idpr`);

--
-- Klíče pro tabulku `vybeh`
--
ALTER TABLE `vybeh`
 ADD PRIMARY KEY (`id`), ADD KEY `lastc` (`lastc`);

--
-- Klíče pro tabulku `zvire`
--
ALTER TABLE `zvire`
 ADD PRIMARY KEY (`id`), ADD KEY `idvy` (`idvy`), ADD KEY `lf` (`lf`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `cisteni`
--
ALTER TABLE `cisteni`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `krmeni`
--
ALTER TABLE `krmeni`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `skoleni`
--
ALTER TABLE `skoleni`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `vybeh`
--
ALTER TABLE `vybeh`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pro tabulku `zvire`
--
ALTER TABLE `zvire`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `cisteni`
--
ALTER TABLE `cisteni`
ADD CONSTRAINT `cisteni_ibfk_2` FOREIGN KEY (`idvy`) REFERENCES `vybeh` (`id`),
ADD CONSTRAINT `cisteni_ibfk_3` FOREIGN KEY (`idpr`) REFERENCES `osetrovatel` (`rc`);

--
-- Omezení pro tabulku `krmeni`
--
ALTER TABLE `krmeni`
ADD CONSTRAINT `krmeni_ibfk_2` FOREIGN KEY (`idzv`) REFERENCES `zvire` (`id`),
ADD CONSTRAINT `krmeni_ibfk_3` FOREIGN KEY (`idpr`) REFERENCES `osetrovatel` (`rc`),
ADD CONSTRAINT `krmeni_ibfk_4` FOREIGN KEY (`idpr`) REFERENCES `osetrovatel` (`rc`);

--
-- Omezení pro tabulku `skoleni`
--
ALTER TABLE `skoleni`
ADD CONSTRAINT `skoleni_ibfk_1` FOREIGN KEY (`idpr`) REFERENCES `osetrovatel` (`rc`);

--
-- Omezení pro tabulku `zvire`
--
ALTER TABLE `zvire`
ADD CONSTRAINT `zvire_ibfk_1` FOREIGN KEY (`idvy`) REFERENCES `vybeh` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
