-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dic 09, 2015 alle 17:50
-- Versione del server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catalogo_symfony_old`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acme_users`
--

CREATE TABLE IF NOT EXISTS `acme_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_55884A7F85E0677` (`username`),
  UNIQUE KEY `UNIQ_55884A7E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `cross_tbl_catalogue_category_x_tbl_catalogue_category`
--

CREATE TABLE IF NOT EXISTS `cross_tbl_catalogue_category_x_tbl_catalogue_category` (
  `id_item` bigint(20) NOT NULL,
  `id_parent` bigint(20) NOT NULL,
  PRIMARY KEY (`id_item`,`id_parent`),
  KEY `IDX_9C339AF943B391C` (`id_item`),
  KEY `IDX_9C339AF1BB9D5A2` (`id_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cross_tbl_catalogue_category_x_tbl_catalogue_feature`
--

CREATE TABLE IF NOT EXISTS `cross_tbl_catalogue_category_x_tbl_catalogue_feature` (
  `id_parent` bigint(20) NOT NULL,
  `id_item` bigint(20) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_item`),
  KEY `IDX_900E2F2F1BB9D5A2` (`id_parent`),
  KEY `IDX_900E2F2F943B391C` (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `cross_tbl_catalogue_category_x_tbl_catalogue_feature`
--

INSERT INTO `cross_tbl_catalogue_category_x_tbl_catalogue_feature` (`id_parent`, `id_item`) VALUES
(2, 9),
(2, 11),
(2, 21),
(10, 1),
(10, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `cross_tbl_catalogue_category_x_tbl_catalogue_product`
--

CREATE TABLE IF NOT EXISTS `cross_tbl_catalogue_category_x_tbl_catalogue_product` (
  `id_item` bigint(20) NOT NULL,
  `id_parent` bigint(20) NOT NULL,
  PRIMARY KEY (`id_item`,`id_parent`),
  KEY `IDX_5C935EE4943B391C` (`id_item`),
  KEY `IDX_5C935EE41BB9D5A2` (`id_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `cross_tbl_catalogue_category_x_tbl_catalogue_product`
--

INSERT INTO `cross_tbl_catalogue_category_x_tbl_catalogue_product` (`id_item`, `id_parent`) VALUES
(2269, 10),
(2270, 2),
(2271, 10),
(2272, 2),
(2276, 2),
(2282, 2),
(2284, 2),
(2285, 12),
(2286, 12),
(2287, 12),
(2288, 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue`
--

CREATE TABLE IF NOT EXISTS `cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue` (
  `id_item` bigint(20) NOT NULL,
  `id_parent` bigint(20) NOT NULL,
  PRIMARY KEY (`id_item`,`id_parent`),
  KEY `IDX_466C262A943B391C` (`id_item`),
  KEY `IDX_466C262A1BB9D5A2` (`id_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue`
--

INSERT INTO `cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue` (`id_item`, `id_parent`) VALUES
(1, 1),
(2, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 3),
(11, 3),
(12, 3),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(25, 6),
(26, 6),
(28, 7),
(29, 7),
(30, 7),
(31, 7),
(32, 7),
(33, 7),
(34, 8),
(36, 8),
(37, 8),
(38, 8),
(39, 8),
(40, 8),
(41, 8),
(42, 8),
(43, 8),
(44, 8),
(46, 9),
(47, 9),
(48, 9),
(49, 9),
(50, 9),
(52, 10),
(53, 10),
(54, 10),
(63, 11),
(64, 11),
(71, 2),
(72, 3),
(76, 1),
(81, 6),
(87, 1),
(89, 6),
(90, 6),
(91, 6),
(92, 6),
(94, 6),
(98, 6),
(99, 1),
(100, 6),
(101, 6),
(103, 2),
(105, 7),
(106, 10),
(107, 10),
(110, 16),
(111, 16),
(112, 17),
(113, 17),
(114, 17),
(115, 17),
(116, 18),
(117, 19),
(118, 19),
(119, 18),
(120, 16),
(121, 16),
(122, 16),
(123, 16),
(124, 16),
(125, 16),
(126, 18),
(127, 18),
(128, 18),
(129, 16),
(134, 16),
(135, 18),
(138, 6),
(140, 1),
(141, 21),
(142, 21),
(143, 21),
(144, 21),
(145, 21),
(146, 21),
(147, 21),
(148, 21),
(149, 21),
(150, 21),
(151, 21),
(152, 21),
(153, 21),
(154, 21),
(155, 21),
(156, 21),
(157, 21),
(158, 21),
(159, 21),
(160, 21),
(161, 21),
(162, 6),
(163, 1),
(164, 18),
(166, 21),
(167, 21),
(168, 21),
(170, 2),
(171, 7),
(172, 21),
(173, 1),
(175, 6),
(422, 6),
(425, 21),
(428, 18),
(431, 19),
(434, 1),
(437, 21),
(440, 18),
(443, 21),
(446, 21),
(449, 21),
(452, 6),
(455, 6),
(461, 58),
(464, 58),
(468, 58),
(471, 58),
(474, 58),
(477, 58),
(480, 58),
(483, 58),
(486, 4),
(489, 4),
(492, 21),
(498, 21),
(501, 21),
(504, 21),
(507, 21),
(510, 21),
(513, 1),
(516, 6),
(519, 21),
(522, 1),
(525, 18),
(528, 21),
(531, 21),
(534, 21),
(537, 21),
(539, 59);

-- --------------------------------------------------------

--
-- Struttura della tabella `cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue`
--

CREATE TABLE IF NOT EXISTS `cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue` (
  `id_item` bigint(20) NOT NULL,
  `id_parent` bigint(20) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_item`),
  KEY `IDX_73EE4A46943B391C` (`id_item`),
  KEY `IDX_73EE4A461BB9D5A2` (`id_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue`
--

INSERT INTO `cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue` (`id_item`, `id_parent`) VALUES
(1, 2270),
(2, 2269),
(2, 2270),
(2, 2271),
(2, 2276),
(5, 2269),
(6, 2269),
(6, 2271),
(9, 2276),
(10, 2270),
(10, 2276),
(46, 2270),
(47, 2282),
(63, 2270),
(63, 2282),
(141, 2282),
(142, 2270);

-- --------------------------------------------------------

--
-- Struttura della tabella `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20150708105104'),
('20150708110154'),
('20150708110808'),
('20150708114008'),
('20150909085801'),
('20150909085829'),
('20150909094334'),
('20150909101515'),
('20150910171836'),
('20150911161842'),
('20150915163415'),
('20151022092139'),
('20151102111627'),
('20151203150439'),
('20151209161627'),
('20151209161854'),
('20151209162642');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_category`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_category` bigint(20) NOT NULL,
  `id_tbl_lingua` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `pub` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `tbl_catalogue_category`
--

INSERT INTO `tbl_catalogue_category` (`id`, `id_tbl_catalogue_category`, `id_tbl_lingua`, `title`, `description`, `img`, `position`, `pub`) VALUES
(2, 2, 4, 'Case Vacanza', 'Case Vacanza', '', 2, 1),
(10, 10, 4, 'Vendita', 'Vendita', NULL, 0, 1),
(12, 12, 1, 'Home', 'Home for holidays', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_category_metatag`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_category_metatag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_category` bigint(20) DEFAULT NULL,
  `id_tbl_lingua` int(11) DEFAULT NULL,
  `meta_tag_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_charset` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_generator` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_tbl_cataloguefip_category` (`id_tbl_catalogue_category`,`id_tbl_lingua`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_feature`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_feature` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_feature` bigint(20) NOT NULL,
  `id_tbl_lingua` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compulsory` int(11) NOT NULL,
  `display` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `inherit_from` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E2032C015ABD5BDD` (`inherit_from`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dump dei dati per la tabella `tbl_catalogue_feature`
--

INSERT INTO `tbl_catalogue_feature` (`id`, `id_tbl_catalogue_feature`, `id_tbl_lingua`, `title`, `description`, `type_input`, `compulsory`, `display`, `position`, `inherit_from`) VALUES
(1, 1, 4, 'Località vendite', '', 'select', 1, 'float:left;', 1, NULL),
(2, 2, 4, 'Tipologia', '', 'select', 1, 'float:left;', 3, NULL),
(3, 3, 4, 'Locali', '', 'select', 1, 'float:left;', 4, NULL),
(4, 4, 4, 'Fascia di Prezzo', '', 'select', 1, 'float:left;', 10, NULL),
(6, 6, 4, 'Zona', '', 'select', 0, 'float:left;', 2, 1),
(7, 7, 4, 'Accessori', '', 'checkbox', 0, 'float:left;', 6, NULL),
(8, 8, 4, 'Dotazioni', '', 'checkbox', 1, '', 0, NULL),
(9, 9, 4, 'Posti letto', '', 'select', 0, 'float:left;', 0, NULL),
(10, 10, 4, 'Tipologia affitti', '', 'select', 1, 'float:left;', 0, NULL),
(11, 11, 4, 'Località affitti', '', 'select', 1, 'float:left;', 0, NULL),
(16, 16, 4, 'Località aziende', '', 'select', 1, 'float:left;', 0, NULL),
(17, 17, 4, 'Tipologia aziende', '', 'select', 1, 'float:left;', 0, NULL),
(18, 18, 4, 'Località palazzi', '', 'select', 1, 'float:left;', 0, NULL),
(19, 19, 4, 'Tipologia palazzi', '', 'select', 1, 'float:left;', 0, NULL),
(21, 21, 4, 'Residence Affitti', '', 'select', 0, 'float:left;', 0, NULL),
(58, 58, 4, 'Classe energetica', '', 'select', 0, 'float:left;', 0, NULL),
(59, 59, 1, 'Feature 1', 'Category of Feature 1', 'select', 1, 'float:left', 0, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_featurevalue`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_featurevalue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_featurevalue` int(11) NOT NULL,
  `id_tbl_lingua` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=540 ;

--
-- Dump dei dati per la tabella `tbl_catalogue_featurevalue`
--

INSERT INTO `tbl_catalogue_featurevalue` (`id`, `id_tbl_catalogue_featurevalue`, `id_tbl_lingua`, `title`, `img`, `position`, `updatedAt`) VALUES
(1, 1, 4, 'Eraclea', NULL, 5, '0000-00-00 00:00:00'),
(2, 2, 4, 'Venezia', '', 4, '0000-00-00 00:00:00'),
(6, 6, 4, 'Appartamento', NULL, 6, '0000-00-00 00:00:00'),
(7, 7, 4, 'Villa / Casa singola', '', 7, '0000-00-00 00:00:00'),
(8, 8, 4, 'Rustico/Casale', NULL, 8, '0000-00-00 00:00:00'),
(9, 9, 4, 'Terreno Edificabile', NULL, 9, '0000-00-00 00:00:00'),
(10, 10, 4, '1 camera da letto', '', 10, '0000-00-00 00:00:00'),
(11, 11, 4, '2 camere da letto', '', 11, '0000-00-00 00:00:00'),
(12, 12, 4, '3 camere da letto', '', 12, '0000-00-00 00:00:00'),
(15, 15, 4, 'Fino a 100.000', 'scarica-la-planimetria.png', 15, '2015-12-09 16:37:58'),
(16, 16, 4, 'da 100.000 a 150.000', '/public/nuove_fasce_prezzo/fascia2n.jpg', 16, '0000-00-00 00:00:00'),
(17, 17, 4, 'da 150.000 a 200.000', '/public/nuove_fasce_prezzo/fascia3n.jpg', 17, '0000-00-00 00:00:00'),
(18, 18, 4, 'da 200.000 a 250.000', '/public/nuove_fasce_prezzo/fascia4n.jpg', 18, '0000-00-00 00:00:00'),
(19, 19, 4, 'da 250.000 a 300.000', '/public/nuove_fasce_prezzo/fascia5n.jpg', 19, '0000-00-00 00:00:00'),
(20, 20, 4, 'da 300.000 a 350.000', '/public/nuove_fasce_prezzo/fascia6n.jpg', 20, '0000-00-00 00:00:00'),
(25, 25, 4, 'Pineta', '', 0, '0000-00-00 00:00:00'),
(26, 26, 4, 'Lido', '', 0, '0000-00-00 00:00:00'),
(28, 28, 4, 'Ascensore', NULL, 0, '0000-00-00 00:00:00'),
(29, 29, 4, 'Riscaldamento', NULL, 0, '0000-00-00 00:00:00'),
(30, 30, 4, 'Giardino', NULL, 0, '0000-00-00 00:00:00'),
(31, 31, 4, 'Piscina', NULL, 0, '0000-00-00 00:00:00'),
(32, 32, 4, 'Posto auto', NULL, 0, '0000-00-00 00:00:00'),
(33, 33, 4, 'Garage', NULL, 0, '0000-00-00 00:00:00'),
(34, 34, 4, 'Fronte Mare', '', 0, '0000-00-00 00:00:00'),
(36, 36, 4, 'Servizio Spiaggia', '/public/nuove_fasce_prezzo/fascia5n.jpg', 0, '0000-00-00 00:00:00'),
(37, 37, 4, 'Piscina', '', 0, '0000-00-00 00:00:00'),
(38, 38, 4, 'Giardino', '', 0, '0000-00-00 00:00:00'),
(39, 39, 4, 'Ascensore', '', 0, '0000-00-00 00:00:00'),
(40, 40, 4, 'Riscaldamento', '', 0, '0000-00-00 00:00:00'),
(41, 41, 4, 'Aria Condizionata', '', 0, '0000-00-00 00:00:00'),
(42, 42, 4, 'Posto Auto', '', 0, '0000-00-00 00:00:00'),
(43, 43, 4, 'Autorimessa', '', 0, '0000-00-00 00:00:00'),
(44, 44, 4, 'Lavatrice', '', 0, '0000-00-00 00:00:00'),
(46, 46, 4, '2 posti letto', '', 0, '0000-00-00 00:00:00'),
(47, 47, 4, '3 posti letto', '', 0, '0000-00-00 00:00:00'),
(48, 48, 4, '4 posti letto', '', 0, '0000-00-00 00:00:00'),
(49, 49, 4, '5 posti letto', '', 0, '0000-00-00 00:00:00'),
(50, 50, 4, 'Piu'' di 5 posti letto', '', 0, '0000-00-00 00:00:00'),
(52, 52, 4, 'B - Bilo 2/5 posti letto', '', 3, '0000-00-00 00:00:00'),
(53, 53, 4, 'C - Trilo 4/6 posti letto', '', 4, '0000-00-00 00:00:00'),
(54, 54, 4, 'D - Quadrilo 5/7 posti letto', '', 5, '0000-00-00 00:00:00'),
(63, 63, 4, 'Cavallino', '', 2, '0000-00-00 00:00:00'),
(64, 64, 4, 'Jesolo', '', 1, '0000-00-00 00:00:00'),
(71, 71, 4, 'Bifamigliari / Schiere', '', 0, '0000-00-00 00:00:00'),
(72, 72, 4, 'Piu'' di 3 camere da letto', '', 0, '0000-00-00 00:00:00'),
(76, 76, 4, 'Cavallino/Treporti', '', 2, '0000-00-00 00:00:00'),
(81, 81, 4, 'Paese', '', 0, '0000-00-00 00:00:00'),
(85, 85, 4, 'Fornera', '', 0, '0000-00-00 00:00:00'),
(87, 87, 4, 'Jesolo', '', 1, '0000-00-00 00:00:00'),
(89, 89, 4, 'Cortellazzo', '', 0, '0000-00-00 00:00:00'),
(90, 90, 4, 'S.Maria di Piave', '', 0, '0000-00-00 00:00:00'),
(91, 91, 4, 'Passarella', '', 0, '0000-00-00 00:00:00'),
(92, 92, 4, 'Ca''Pirami', '', 0, '0000-00-00 00:00:00'),
(94, 94, 4, 'Ca''Fornera', '', 0, '0000-00-00 00:00:00'),
(98, 98, 4, 'Lido', '', 0, '0000-00-00 00:00:00'),
(99, 99, 4, 'S.Donà di Piave', NULL, 3, '0000-00-00 00:00:00'),
(100, 100, 4, 'Ca''Turcata', '', 0, '0000-00-00 00:00:00'),
(101, 101, 4, 'Passarella', '', 0, '0000-00-00 00:00:00'),
(103, 103, 4, 'Garages', '', 0, '0000-00-00 00:00:00'),
(105, 105, 4, 'Nuovo', '', 0, '0000-00-00 00:00:00'),
(106, 106, 4, 'A - mono 2/4 posti letto', '', 2, '0000-00-00 00:00:00'),
(107, 107, 4, 'Casa singola', '', 1, '0000-00-00 00:00:00'),
(110, 110, 4, 'Sicilia', '', 0, '0000-00-00 00:00:00'),
(111, 111, 4, 'Veneto', '', 0, '0000-00-00 00:00:00'),
(112, 112, 4, 'Alberghi', '', 0, '0000-00-00 00:00:00'),
(113, 113, 4, 'Bar/Gelaterie', '', 0, '0000-00-00 00:00:00'),
(114, 114, 4, 'Ristoranti/Pizzerie', '', 0, '0000-00-00 00:00:00'),
(115, 115, 4, 'Attivita'' varie', '', 0, '0000-00-00 00:00:00'),
(116, 116, 4, 'Venezia', '', 5, '0000-00-00 00:00:00'),
(117, 117, 4, 'Ville', '', 0, '0000-00-00 00:00:00'),
(118, 118, 4, 'Palazzo', '', 0, '0000-00-00 00:00:00'),
(119, 119, 4, 'Treviso', '', 10, '0000-00-00 00:00:00'),
(120, 120, 4, 'Liguria', '', 0, '0000-00-00 00:00:00'),
(121, 121, 4, 'Lazio', '', 0, '0000-00-00 00:00:00'),
(122, 122, 4, 'Lombardia', '', 0, '0000-00-00 00:00:00'),
(123, 123, 4, 'Toscana', '', 0, '0000-00-00 00:00:00'),
(124, 124, 4, 'Friuli VG', '', 0, '0000-00-00 00:00:00'),
(125, 125, 4, 'Campania', '', 0, '0000-00-00 00:00:00'),
(126, 126, 4, 'Vicenza', '', 15, '0000-00-00 00:00:00'),
(127, 127, 4, 'Verona', '', 20, '0000-00-00 00:00:00'),
(128, 128, 4, 'Perugia', '', 40, '0000-00-00 00:00:00'),
(129, 129, 4, 'Sardegna', '', 0, '0000-00-00 00:00:00'),
(134, 134, 4, 'Croazia', '', 0, '0000-00-00 00:00:00'),
(135, 135, 4, 'Firenze', '', 30, '0000-00-00 00:00:00'),
(138, 138, 4, 'Piave Nuovo', '', 0, '0000-00-00 00:00:00'),
(140, 140, 4, 'Treviso', '', 6, '0000-00-00 00:00:00'),
(141, 141, 4, 'Alla Vigna', '', 0, '0000-00-00 00:00:00'),
(142, 142, 4, 'Mediterranee', '', 480, '0000-00-00 00:00:00'),
(143, 143, 4, 'El Palmar', '', 150, '0000-00-00 00:00:00'),
(144, 144, 4, 'Il Faro', '', 210, '0000-00-00 00:00:00'),
(145, 145, 4, 'Le Conchiglie', '', 360, '0000-00-00 00:00:00'),
(146, 146, 4, 'Milano', '', 570, '0000-00-00 00:00:00'),
(147, 147, 4, 'Nuovo Sile', '', 0, '0000-00-00 00:00:00'),
(148, 148, 4, 'Playa Grande', '', 630, '0000-00-00 00:00:00'),
(149, 149, 4, 'Santa Fe''', '', 0, '0000-00-00 00:00:00'),
(150, 150, 4, 'Cansiglio', '', 90, '0000-00-00 00:00:00'),
(151, 151, 4, 'Cristina', '', 120, '0000-00-00 00:00:00'),
(152, 152, 4, 'Linda', '', 390, '0000-00-00 00:00:00'),
(153, 153, 4, 'Meerblick', '', 510, '0000-00-00 00:00:00'),
(154, 154, 4, 'Meerblick II', '', 540, '0000-00-00 00:00:00'),
(155, 155, 4, 'Trieste', '', 690, '0000-00-00 00:00:00'),
(156, 156, 4, 'Villa Laura', '', 700, '0000-00-00 00:00:00'),
(157, 157, 4, 'Villa Mazzon', '', 715, '0000-00-00 00:00:00'),
(158, 158, 4, 'Golf Club', '', 180, '0000-00-00 00:00:00'),
(159, 159, 4, 'Porto Turistico', '', 0, '0000-00-00 00:00:00'),
(160, 160, 4, 'Aceri Rossi', '', 30, '0000-00-00 00:00:00'),
(161, 161, 4, 'Patelli', '', 0, '0000-00-00 00:00:00'),
(162, 162, 4, 'S.Marco', '', 0, '0000-00-00 00:00:00'),
(163, 163, 4, 'Vicenza', '', 7, '0000-00-00 00:00:00'),
(164, 164, 4, 'Belluno', '', 25, '0000-00-00 00:00:00'),
(166, 166, 4, 'Le Terrazze', '', 0, '0000-00-00 00:00:00'),
(167, 167, 4, 'Il Sole', '', 240, '0000-00-00 00:00:00'),
(168, 168, 4, 'Maricel', '', 420, '0000-00-00 00:00:00'),
(170, 170, 4, 'Attico', '', 0, '0000-00-00 00:00:00'),
(171, 171, 4, 'Fronte mare', '', 0, '0000-00-00 00:00:00'),
(172, 172, 4, 'Kristal', '', 270, '0000-00-00 00:00:00'),
(173, 173, 4, 'Zoldo Alto', '', 16, '0000-00-00 00:00:00'),
(175, 175, 4, 'Pecol', '', 0, '0000-00-00 00:00:00'),
(422, 422, 4, 'Ponte Crepaldo', '', 0, '0000-00-00 00:00:00'),
(425, 425, 4, 'Ca''Gamba', '', 60, '0000-00-00 00:00:00'),
(428, 428, 4, 'Sardegna', '', 50, '0000-00-00 00:00:00'),
(431, 431, 4, 'Appartamenti', '', 0, '0000-00-00 00:00:00'),
(434, 434, 4, 'Sardegna', '', 20, '0000-00-00 00:00:00'),
(437, 437, 4, 'Pineta', '', 600, '0000-00-00 00:00:00'),
(440, 440, 4, 'Arezzo', '', 45, '0000-00-00 00:00:00'),
(443, 443, 4, 'Zeta', '', 800, '0000-00-00 00:00:00'),
(446, 446, 4, 'Laguna Park', '', 300, '0000-00-00 00:00:00'),
(449, 449, 4, 'Talamini', '', 660, '0000-00-00 00:00:00'),
(452, 452, 4, 'Cannaregio', '', 0, '0000-00-00 00:00:00'),
(455, 455, 4, 'S.Polo', '', 0, '0000-00-00 00:00:00'),
(461, 461, 4, 'A+', '/public/classi_energetiche/aa.jpg', 1, '0000-00-00 00:00:00'),
(464, 464, 4, 'A', '/public/classi_energetiche/a.jpg', 2, '0000-00-00 00:00:00'),
(468, 468, 4, 'B', '/public/classi_energetiche/b.jpg', 3, '0000-00-00 00:00:00'),
(471, 471, 4, 'C', '/public/classi_energetiche/c.jpg', 4, '0000-00-00 00:00:00'),
(474, 474, 4, 'F', '/public/classi_energetiche/f.jpg', 7, '0000-00-00 00:00:00'),
(477, 477, 4, 'D', '/public/classi_energetiche/d.jpg', 5, '0000-00-00 00:00:00'),
(480, 480, 4, 'G', '/public/classi_energetiche/g.jpg', 8, '0000-00-00 00:00:00'),
(483, 483, 4, 'E', '/public/classi_energetiche/e.jpg', 6, '0000-00-00 00:00:00'),
(486, 486, 4, 'da 350.000 a 400.000', '/public/nuove_fasce_prezzo/fascia7n.jpg', 21, '0000-00-00 00:00:00'),
(489, 489, 4, 'oltre 400.000', '/public/nuove_fasce_prezzo/fascia8n.jpg', 22, '0000-00-00 00:00:00'),
(492, 492, 4, 'Levante', '', 310, '0000-00-00 00:00:00'),
(498, 498, 4, 'Equilio', '', 155, '0000-00-00 00:00:00'),
(501, 501, 4, 'CascinadelMar', '', 100, '0000-00-00 00:00:00'),
(504, 504, 4, 'La Duna', '', 280, '0000-00-00 00:00:00'),
(507, 507, 4, 'Casa Rossa', '', 110, '0000-00-00 00:00:00'),
(510, 510, 4, 'Sea Palace', '', 650, '0000-00-00 00:00:00'),
(513, 513, 4, 'Friuli V Giulia', '', 15, '0000-00-00 00:00:00'),
(516, 516, 4, 'Dolegna del Collio', '', 0, '0000-00-00 00:00:00'),
(519, 519, 4, 'Tommasi', '', 670, '0000-00-00 00:00:00'),
(522, 522, 4, 'Carinzia -A-', '', 25, '0000-00-00 00:00:00'),
(525, 525, 4, 'Jesolo', '', 1, '0000-00-00 00:00:00'),
(528, 528, 4, 'Minerva', '', 580, '0000-00-00 00:00:00'),
(531, 531, 4, 'Foscolo', '', 160, '0000-00-00 00:00:00'),
(534, 534, 4, 'Villa Rosa', '', 730, '0000-00-00 00:00:00'),
(537, 537, 4, 'Valle Dolce', '', 695, '0000-00-00 00:00:00'),
(539, 539, 1, 'Featurevalues 2', NULL, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_featurevalue_inherit`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_featurevalue_inherit` (
  `id_catalogue_featurevalue` bigint(20) NOT NULL,
  `id_catalogue_featurevalue_father` bigint(20) NOT NULL,
  PRIMARY KEY (`id_catalogue_featurevalue`,`id_catalogue_featurevalue_father`),
  KEY `IDX_21DEDBFBE2FCFDE6` (`id_catalogue_featurevalue`),
  KEY `IDX_21DEDBFBED87B3E` (`id_catalogue_featurevalue_father`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `tbl_catalogue_featurevalue_inherit`
--

INSERT INTO `tbl_catalogue_featurevalue_inherit` (`id_catalogue_featurevalue`, `id_catalogue_featurevalue_father`) VALUES
(25, 87),
(26, 87),
(81, 87),
(89, 87),
(90, 87),
(91, 87),
(92, 87),
(94, 87),
(98, 2),
(100, 1),
(101, 99),
(138, 87),
(162, 2),
(175, 173),
(422, 1),
(452, 2),
(455, 2),
(516, 513);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_fieldsearch`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_fieldsearch` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_fieldsearch` bigint(20) NOT NULL,
  `id_tbl_lingua` tinyint(1) NOT NULL,
  `id_tbl_catalogue_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `getname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `typeinput` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compulsory` tinyint(1) NOT NULL,
  `showOnlyValued` tinyint(1) NOT NULL,
  `typesearch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tablerif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elementrif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `findin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `conditionBetweenField` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `inherit_from` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `getname` (`getname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_import_log`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_import_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tablerif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idrif` bigint(20) DEFAULT NULL,
  `act` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` tinyint(1) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `date_import` datetime NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `ip_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_product`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_product` bigint(20) NOT NULL,
  `id_tbl_lingua` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `description_notag` longtext COLLATE utf8_unicode_ci,
  `short_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tbl_photo_cat` int(11) NOT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pub` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `coordinate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indirizzo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classe_energetica` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prezzo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `planimetria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anno_costruzione` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `piano` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `posti_letto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2289 ;

--
-- Dump dei dati per la tabella `tbl_catalogue_product`
--

INSERT INTO `tbl_catalogue_product` (`id`, `id_tbl_catalogue_product`, `id_tbl_lingua`, `title`, `description`, `description_notag`, `short_description`, `cod`, `id_tbl_photo_cat`, `template`, `pub`, `featured`, `position`, `coordinate`, `indirizzo`, `classe_energetica`, `prezzo`, `planimetria`, `anno_costruzione`, `piano`, `mq`, `posti_letto`) VALUES
(2269, 2269, 4, 'Immobile', '<p>Immobile di prova</p>', NULL, 'Immobile', 'A687', 7, NULL, 1, 0, 1, '45.60, 12.60', 'Via ...', 'A', '150.000,00', '/uploads/planimetrie\\appartamenti-vendita-immobile-planimetria.pdf', NULL, NULL, NULL, NULL),
(2270, 2270, 4, 'Villa Adria 1', '<p>Villa Adria 1.2.3.4.5.6</p>', NULL, 'Immobile 1', NULL, 8, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, '/uploads/planimetrie\\ciccio.jpg', NULL, NULL, NULL, '2 posti letto'),
(2271, 2271, 4, 'Immobile in vendita', '<p>Immobile in vendita</p>', NULL, 'Immobile in vendita', NULL, 10, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2272, 2272, 4, 'Villa Bella', '<p>Villa bella</p>', NULL, 'Villa bella', NULL, 11, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2276, 2276, 4, 'Villone', '<p>Villone</p>', NULL, 'Villone', 'B4987', 16, NULL, 0, 0, 3, '32.53, 21.49', 'Via Roma destra', 'B', '80.000,00', NULL, NULL, NULL, NULL, NULL),
(2282, 2282, 4, 'Prova', '<p>Prova</p>', NULL, 'Prova', NULL, 24, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, '/uploads/planimetrie\\appartamenti-case-vacanza-prova-planimetria.jpg', NULL, NULL, NULL, '3 posti letto'),
(2284, 2284, 1, 'Prodotto Inglese', '<p>Prodotto</p>', NULL, 'Prodotto con lingua diversa', NULL, 26, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2286, 2286, 1, 'Home 1', NULL, NULL, 'Home for holiday 1', NULL, 28, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2287, 2287, 1, 'Home2', NULL, NULL, 'Home for holiday 2', NULL, 29, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2288, 2288, 1, 'Home3', NULL, NULL, 'Home for holiday 3', NULL, 30, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_catalogue_product_metatag`
--

CREATE TABLE IF NOT EXISTS `tbl_catalogue_product_metatag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tbl_catalogue_product` bigint(20) NOT NULL,
  `id_tbl_lingua` int(11) DEFAULT NULL,
  `meta_tag_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_charset` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_generator` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_tbl_cataloguefip_product` (`id_tbl_catalogue_product`,`id_tbl_lingua`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_photo`
--

CREATE TABLE IF NOT EXISTS `tbl_photo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tbl_photo` bigint(20) NOT NULL,
  `id_tbl_lingua` bigint(20) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_big` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_x` bigint(20) NOT NULL,
  `thumbnail_y` bigint(20) NOT NULL,
  `id_tbl_photo_cat` bigint(20) NOT NULL,
  `posizione` bigint(20) NOT NULL,
  `pub` bigint(20) NOT NULL,
  `didascalia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dump dei dati per la tabella `tbl_photo`
--

INSERT INTO `tbl_photo` (`id`, `id_tbl_photo`, `id_tbl_lingua`, `nome`, `img`, `img_big`, `thumbnail_x`, `thumbnail_y`, `id_tbl_photo_cat`, `posizione`, `pub`, `didascalia`) VALUES
(9, 9, 4, 'appartamenti-vendita-immobile-1.jpg', '/uploads/gallery\\appartamenti-vendita-immobile-1.jpg', NULL, 0, 0, 7, 0, 1, NULL),
(10, 10, 4, 'appartamenti-vendita-immobile-2.jpg', '/uploads/gallery\\appartamenti-vendita-immobile-2.jpg', NULL, 0, 0, 7, 1, 1, NULL),
(14, 14, 4, 'appartamenti-vendita-casa-di-prova-0.jpg', '/uploads/gallery\\appartamenti-vendita-casa-di-prova-0.jpg', NULL, 0, 0, 15, 0, 1, NULL),
(15, 15, 4, 'appartamenti-vendita-casa-di-prova-1.jpg', '/uploads/gallery\\appartamenti-vendita-casa-di-prova-1.jpg', NULL, 0, 0, 15, 0, 1, NULL),
(16, 16, 4, 'appartamenti-vendita-casa-di-prova-2.jpg', '/uploads/gallery\\appartamenti-vendita-casa-di-prova-2.jpg', NULL, 0, 0, 15, 0, 1, NULL),
(17, 17, 4, '55b.cbf573.jpg', '/uploads/gallery/55b.cbf573.jpg', NULL, 0, 0, 15, 0, 1, NULL),
(18, 18, 4, 'appartamenti-case-vacanza-villa-adria-1-0.jpg', '/uploads/gallery\\appartamenti-case-vacanza-villa-adria-1-0.jpg', NULL, 0, 0, 0, 0, 1, NULL),
(19, 19, 4, 'appartamenti-case-vacanza-villa-adria-1-1.jpg', '/uploads/gallery\\appartamenti-case-vacanza-villa-adria-1-1.jpg', NULL, 0, 0, 0, 1, 1, NULL),
(20, 20, 4, 'appartamenti-case-vacanza-prova-0.jpg', '/uploads/gallery\\appartamenti-case-vacanza-prova-0.jpg', NULL, 0, 0, 24, 0, 1, NULL),
(21, 21, 4, 'appartamenti-case-vacanza-prova-1.jpg', '/uploads/gallery\\appartamenti-case-vacanza-prova-1.jpg', NULL, 0, 0, 24, 0, 1, NULL),
(22, 22, 4, 'appartamenti-case-vacanza-prova-2.jpg', '/uploads/gallery\\appartamenti-case-vacanza-prova-2.jpg', NULL, 0, 0, 24, 0, 1, NULL),
(23, 23, 4, 'ver.18c697.jpg', '/uploads/gallery/ver.18c697.jpg', NULL, 0, 0, 24, 0, 1, NULL),
(24, 24, 4, 'appartamenti-case-vacanza-prova-4.jpg', '/uploads/gallery\\appartamenti-case-vacanza-prova-4.jpg', NULL, 0, 0, 24, 0, 1, NULL),
(34, 34, 4, 'appartamenti-case-vacanza-villa-bella-0.jpg', '/uploads/gallery\\appartamenti-case-vacanza-villa-bella-0.jpg', NULL, 0, 0, 11, 0, 1, NULL),
(40, 40, 4, 'appartamenti-case-vacanza-villa-adria-1-jesolo-0-11-19.jpg', '/uploads/gallery\\appartamenti-case-vacanza-villa-adria-1-jesolo-0-11-19.jpg', NULL, 0, 0, 8, 1, 1, NULL),
(41, 41, 4, 'appartamenti-case-vacanza-villa-adria-1-jesolo-1-11-22.jpg', '/uploads/gallery\\appartamenti-case-vacanza-villa-adria-1-jesolo-1-11-22.jpg', NULL, 0, 0, 8, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_photo_cat`
--

CREATE TABLE IF NOT EXISTS `tbl_photo_cat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_padre` bigint(20) NOT NULL,
  `id_tbl_photo_cat` int(11) NOT NULL,
  `id_tbl_lingua` bigint(20) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `smarty_template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posizione` int(11) NOT NULL,
  `set_loop` tinyint(1) DEFAULT NULL,
  `set_random` tinyint(1) DEFAULT NULL,
  `smarty_template_alternativo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dump dei dati per la tabella `tbl_photo_cat`
--

INSERT INTO `tbl_photo_cat` (`id`, `id_padre`, `id_tbl_photo_cat`, `id_tbl_lingua`, `nome`, `num`, `smarty_template`, `posizione`, `set_loop`, `set_random`, `smarty_template_alternativo`) VALUES
(7, 0, 7, 4, 'Immobile', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(8, 0, 8, 4, 'Villa Adria 1', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(9, 0, 9, 4, 'AAA', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(10, 0, 10, 4, 'Immobile in vendita', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(11, 0, 11, 4, 'Villa Bella', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(12, 0, 12, 4, 'Prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(13, 0, 13, 4, 'Nuovo Prodotto', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(14, 0, 14, 4, 'Prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(15, 0, 15, 4, 'Casa di prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(16, 0, 16, 4, 'Villone', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(17, 0, 17, 4, 'dsfasaf', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(18, 0, 18, 4, 'sdadsd', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(19, 0, 19, 4, 'Prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(20, 0, 20, 4, 'Prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(21, 0, 21, 4, 'Mattia', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(22, 0, 22, 4, 'dfsfasdfas', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(23, 0, 23, 4, 'asdaasd', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(24, 0, 24, 4, 'Prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(25, 0, 25, 4, 'prova', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(26, 0, 26, 4, 'Prodotto Inglese', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(27, 0, 27, 4, 'Home 1', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(28, 0, 28, 4, 'Home 1', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(29, 0, 29, 4, 'Home2', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl'),
(30, 0, 30, 4, 'Home3', 50, 'album-immobile.tpl', 1, 0, 0, 'preview-album-immobile.tpl');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `cognome` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `checkbox_tbl_gruppi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checkbox1_tbl_gruppi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_38B383A154BD530C` (`nome`),
  UNIQUE KEY `UNIQ_38B383A1807B13C4` (`cognome`),
  UNIQUE KEY `UNIQ_38B383A1AA08CB10` (`login`),
  UNIQUE KEY `UNIQ_38B383A1E7927C74` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=65 ;

--
-- Dump dei dati per la tabella `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nome`, `cognome`, `login`, `password`, `email`, `checkbox_tbl_gruppi`, `checkbox1_tbl_gruppi`) VALUES
(1, 'Amministratore', 'Q-WEB', 'qweb', 'eae98ab2a88808f9536aa9b96d8cb997', 'info@q-web.it', '1', ''),
(64, 'Marco', 'Vigani', 'm.vigani', '40e27ed28cc0a2b8c6aa20f108668ef2', '', '1', '');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cross_tbl_catalogue_category_x_tbl_catalogue_feature`
--
ALTER TABLE `cross_tbl_catalogue_category_x_tbl_catalogue_feature`
  ADD CONSTRAINT `FK_900E2F2F1BB9D5A2` FOREIGN KEY (`id_parent`) REFERENCES `tbl_catalogue_category` (`id`),
  ADD CONSTRAINT `FK_900E2F2F943B391C` FOREIGN KEY (`id_item`) REFERENCES `tbl_catalogue_feature` (`id`);

--
-- Limiti per la tabella `tbl_catalogue_feature`
--
ALTER TABLE `tbl_catalogue_feature`
  ADD CONSTRAINT `FK_E2032C015ABD5BDD` FOREIGN KEY (`inherit_from`) REFERENCES `tbl_catalogue_feature` (`id`);

--
-- Limiti per la tabella `tbl_catalogue_featurevalue_inherit`
--
ALTER TABLE `tbl_catalogue_featurevalue_inherit`
  ADD CONSTRAINT `FK_21DEDBFBE2FCFDE6` FOREIGN KEY (`id_catalogue_featurevalue`) REFERENCES `tbl_catalogue_featurevalue` (`id`),
  ADD CONSTRAINT `FK_21DEDBFBED87B3E` FOREIGN KEY (`id_catalogue_featurevalue_father`) REFERENCES `tbl_catalogue_featurevalue` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
