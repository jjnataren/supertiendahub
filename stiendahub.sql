-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 03, 2018 at 07:46 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stiendahub`
--

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field` (
  `id_ndk_customization_field` int(10) NOT NULL AUTO_INCREMENT,
  `products` text COLLATE latin1_spanish_ci NOT NULL,
  `categories` text COLLATE latin1_spanish_ci NOT NULL,
  `type` int(1) NOT NULL,
  `nb_lines` int(1) NOT NULL,
  `maxlength` int(10) NOT NULL,
  `feature` int(10) NOT NULL DEFAULT '0',
  `target` int(10) NOT NULL DEFAULT '0',
  `target_child` int(10) NOT NULL DEFAULT '0',
  `x_axis` int(4) UNSIGNED NOT NULL,
  `y_axis` int(4) UNSIGNED NOT NULL,
  `svg_path` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `zone_width` int(3) UNSIGNED NOT NULL,
  `zone_height` int(3) UNSIGNED NOT NULL,
  `id_shop` int(10) NOT NULL DEFAULT '0',
  `position` int(10) NOT NULL DEFAULT '0',
  `ref_position` int(10) NOT NULL DEFAULT '0',
  `required` tinyint(4) NOT NULL DEFAULT '0',
  `recommend` tinyint(4) NOT NULL DEFAULT '0',
  `is_visual` tinyint(4) NOT NULL DEFAULT '0',
  `configurator` tinyint(4) NOT NULL DEFAULT '0',
  `draggable` tinyint(4) NOT NULL DEFAULT '0',
  `resizeable` tinyint(4) NOT NULL DEFAULT '0',
  `rotateable` tinyint(4) NOT NULL DEFAULT '0',
  `orienteable` tinyint(4) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `unit` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `preserve_ratio` tinyint(4) NOT NULL DEFAULT '0',
  `price_type` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'amount',
  `price_per_caracter` float NOT NULL,
  `validity` float NOT NULL,
  `zindex` int(10) NOT NULL DEFAULT '0',
  `fonts` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `colors` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `sizes` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `effects` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `alignments` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `color_effect` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'normal',
  `influences` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `quantity_min` int(10) NOT NULL DEFAULT '0',
  `quantity_max` int(10) NOT NULL DEFAULT '0',
  `open_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ndk_customization_field`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_cache`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_cache`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_cache` (
  `id_cache` int(10) NOT NULL AUTO_INCREMENT,
  `key_cache` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `content` longtext COLLATE latin1_spanish_ci NOT NULL,
  `expire` int(10) NOT NULL,
  PRIMARY KEY (`id_cache`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_configuration`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_configuration`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_configuration` (
  `id_ndk_customization_field_configuration` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL DEFAULT '0',
  `id_lang_default` int(10) NOT NULL DEFAULT '0',
  `id_product` int(10) NOT NULL,
  `id_customization` int(10) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `default_config` tinyint(4) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `json_values` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_configuration`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_configuration_lang`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_configuration_lang`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_configuration_lang` (
  `id_ndk_customization_field_configuration` int(10) NOT NULL AUTO_INCREMENT,
  `id_lang` int(10) NOT NULL,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tags` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_configuration`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_csv`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_csv`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_csv` (
  `id_ndk_customization_field_csv` int(10) NOT NULL AUTO_INCREMENT,
  `id_ndk_customization_field` int(10) NOT NULL DEFAULT '0',
  `width` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `height` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ndk_customization_field_csv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_group`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_group`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_group` (
  `id_ndk_customization_field_group` int(10) NOT NULL AUTO_INCREMENT,
  `fields` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `products` text COLLATE latin1_spanish_ci NOT NULL,
  `categories` text COLLATE latin1_spanish_ci NOT NULL,
  `mode` int(10) NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_group_lang`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_group_lang`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_group_lang` (
  `id_ndk_customization_field_group` int(10) NOT NULL AUTO_INCREMENT,
  `id_lang` int(10) NOT NULL,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_group_shop`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_group_shop`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_group_shop` (
  `id_ndk_customization_field_group` int(10) NOT NULL,
  `id_shop` int(10) NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_lang`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_lang`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_lang` (
  `id_ndk_customization_field` int(10) NOT NULL,
  `id_lang` int(10) NOT NULL,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `admin_name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `notice` text COLLATE latin1_spanish_ci NOT NULL,
  `tooltip` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_recipient`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_recipient`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_recipient` (
  `id_ndk_customization_field_recipient` int(10) NOT NULL AUTO_INCREMENT,
  `id_cart` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `id_combination` int(10) NOT NULL,
  `id_customization` int(10) NOT NULL,
  `id_order` int(10) NOT NULL DEFAULT '0',
  `firstname` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `lastname` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `message` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `details` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `code` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `availability` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `date` datetime NOT NULL,
  `send_mail` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ndk_customization_field_recipient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_shop`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_shop`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_shop` (
  `id_ndk_customization_field` int(10) NOT NULL,
  `id_shop` int(10) NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field`,`id_shop`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_specific_price`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_specific_price`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_specific_price` (
  `id_ndk_customization_field_specific_price` int(10) NOT NULL AUTO_INCREMENT,
  `id_ndk_customization_field` int(10) NOT NULL,
  `id_ndk_customization_field_value` int(10) NOT NULL,
  `reduction` float NOT NULL,
  `reduction_type` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `from_quantity` int(10) NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_specific_price`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_value`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_value`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_value` (
  `id_ndk_customization_field_value` int(10) NOT NULL AUTO_INCREMENT,
  `id_ndk_customization_field` int(10) NOT NULL,
  `price` float NOT NULL,
  `set_quantity` tinyint(4) NOT NULL DEFAULT '0',
  `quantity` int(10) NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `excludes_products` text COLLATE latin1_spanish_ci NOT NULL,
  `quantity_min` int(10) NOT NULL DEFAULT '0',
  `quantity_max` int(10) NOT NULL DEFAULT '0',
  `influences_restrictions` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `influences_obligations` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `default_value` tinyint(4) NOT NULL DEFAULT '0',
  `id_product_value` int(10) NOT NULL DEFAULT '0',
  `step_quantity` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `input_type` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'select',
  `reference` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ps_ndk_customization_field_value_lang`
--

DROP TABLE IF EXISTS `ps_ndk_customization_field_value_lang`;
CREATE TABLE IF NOT EXISTS `ps_ndk_customization_field_value_lang` (
  `id_ndk_customization_field_value` int(10) NOT NULL,
  `id_lang` int(10) NOT NULL,
  `value` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tags` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `textmask` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `description` varchar(2500) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ndk_customization_field_value`,`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article`
--

DROP TABLE IF EXISTS `tbl_article`;
CREATE TABLE IF NOT EXISTS `tbl_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `thumbnail_base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `published_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_author` (`created_by`),
  KEY `fk_article_updater` (`updated_by`),
  KEY `fk_article_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article_attachment`
--

DROP TABLE IF EXISTS `tbl_article_attachment`;
CREATE TABLE IF NOT EXISTS `tbl_article_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_attachment_article` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article_category`
--

DROP TABLE IF EXISTS `tbl_article_category`;
CREATE TABLE IF NOT EXISTS `tbl_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_category_section` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_article_category`
--

INSERT INTO `tbl_article_category` (`id`, `slug`, `title`, `body`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'news', 'News', NULL, NULL, 1, 1512840790, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo`
--

DROP TABLE IF EXISTS `tbl_articulo`;
CREATE TABLE IF NOT EXISTS `tbl_articulo` (
  `sku` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sku_fabricante` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `seccion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `linea` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `marca` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `serie` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `alto` float DEFAULT NULL,
  `largo` float DEFAULT NULL,
  `ancho` float DEFAULT NULL,
  `moneda` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `almacen` int(11) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `disponible` int(11) DEFAULT NULL,
  `ultima_modificacion` datetime DEFAULT NULL,
  `id_usuario_modifico` int(11) DEFAULT NULL,
  `id_snap` int(11) DEFAULT NULL,
  `utilidad_ml` float DEFAULT NULL,
  `utilidad_ps` float DEFAULT NULL,
  `existencia_ml` int(11) DEFAULT NULL,
  `existencia_ps` int(11) DEFAULT NULL,
  `utilidad_monto_ml` decimal(15,2) DEFAULT NULL,
  `utilidad_monto_ps` decimal(15,2) DEFAULT NULL,
  `tipo_utilidad_ml` int(11) DEFAULT NULL,
  `tipo_utilidad_ps` int(11) DEFAULT NULL,
  `comision_ml` int(1) DEFAULT NULL,
  PRIMARY KEY (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tbl_articulo`
--

INSERT INTO `tbl_articulo` (`sku`, `descripcion`, `sku_fabricante`, `seccion`, `linea`, `marca`, `serie`, `precio`, `peso`, `alto`, `largo`, `ancho`, `moneda`, `almacen`, `existencia`, `disponible`, `ultima_modificacion`, `id_usuario_modifico`, `id_snap`, `utilidad_ml`, `utilidad_ps`, `existencia_ml`, `existencia_ps`, `utilidad_monto_ml`, `utilidad_monto_ps`, `tipo_utilidad_ml`, `tipo_utilidad_ps`, `comision_ml`) VALUES
('AC-2098484-11', 'KIT ACTECK WKTE-006 TECLADO MULTIMEDIA / MOUSE / BOCINAS USB AK3-2700', '', 'ACCESORIOS', 'KIT', 'ACTECK', 'USB', '190.26', 1.3, 8.5, 45.8, 2, 'MN', NULL, 193, NULL, '2018-08-03 16:48:27', NULL, NULL, 10, 0.02, 10, 6, '3.00', '2.00', 2, 2, 2),
('AC-22140104-03', 'MOUSE LOGITECH G600 OPTICO 20 BOTONES MMO GAMING NEGRO (910-003879)', NULL, 'ACCESORIOS', 'MOUSE', 'LOGITECH', 'GAMER', '543.33', 0.38, 9.3, 21, 14, 'MN', NULL, 0, NULL, '2018-07-21 07:33:29', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 2, NULL, NULL),
('AC-2238104-04', 'MOUSE ACTECK MO-200 OPTICO USB ESTANDAR WKMO-001', NULL, 'ACCESORIOS', 'MOUSE', 'ACTECK', 'ALAMBRICO', '59.73', 0.13, 8, 21.5, 15.3, 'MN', NULL, 1, NULL, '2018-07-17 16:41:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
('AC-230663-110', 'TECLADO LOGITECH K230 INALAMBRICO USB NEGRO (920-004424)', NULL, 'ACCESORIOS', 'TECLADOS', 'LOGITECH', 'INALAMBRICO', '205.56', 0.5, 20, 40, 2, 'MN', NULL, 0, NULL, '2018-07-07 08:02:17', NULL, NULL, 0.1, 0.07, 0, 0, NULL, NULL, 1, 2, NULL),
('AC-230663-146', 'TECLADO LOGITECH K270  INALAMBRICO USB NEGRO (920-004426)', NULL, 'ACCESORIOS', 'TECLADOS', 'LOGITECH', 'INALAMBRICO', '296.61', 0.4, 20, 40, 2, 'MN', NULL, 0, NULL, '2018-08-03 17:13:04', NULL, NULL, 5, 5, 0, 0, NULL, NULL, 2, 2, 1),
('AC-230663-147', 'KIT LOGITECH MK270 TECLADO Y MOUSE INALAMBRICO (920-004432)', NULL, 'ACCESORIOS', 'KIT', 'LOGITECH', 'INALAMBRICO', '340.46', 1.33, 7.2, 47, 20.6, 'MN', NULL, 0, NULL, '2018-07-21 08:20:17', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
('AC-230663-97', 'KIT LOGITECH MK220 TECLADO Y MOUSE INALAMBRICO (920-004430)', NULL, 'ACCESORIOS', 'KIT', 'LOGITECH', 'INALAMBRICO', '188.89', 1.33, 7.2, 47, 20.6, 'MN', NULL, 10, NULL, '2018-07-21 08:20:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-343772-1', 'MEMORIA ADATA OTG AI920, USB 3.1-LIGHTNING, 32GB,NEGRO(AAI920-32G-CBK)', NULL, NULL, NULL, NULL, '32GB', '28.00', 0.36, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-21 07:24:43', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, NULL),
('AC-345796-1', 'RECEPTOR DE MUSICA BLUETOOTH 4.1 TP-LINK/20METROS/-HA100', NULL, 'ACCESORIOS', 'ADAPTADORES', 'TPLINK', 'BLUETOOTH', '16.25', 0.2, 5, 8, 8, 'USD', NULL, 45, NULL, '2018-07-21 06:28:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
('AC-353503-12', 'CABLE CORRIENTE CPU/MON-PARED MANHATTAN 1.8M BOLSA 300179', NULL, NULL, NULL, NULL, 'USB', '45.91', 0.4, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-21 06:40:00', NULL, NULL, 0.03, NULL, 0, 0, NULL, NULL, NULL, NULL, 1),
('AC-353503-13', 'CABLE VIDEO HDMI MANHATTAN 1.3 M-M  1.8M BOLSA 306119', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'HDMI', '43.95', 0.6, 3, 10, 10, 'MN', NULL, 0, NULL, '2018-07-21 07:33:15', NULL, NULL, 0.02, 0.09, 0, 0, NULL, NULL, 2, 2, NULL),
('AC-353503-14', 'CABLE VIDEO HDMI MANHATTAN 1.3 M-M  3.0M BOLSA 306126', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'HDMI', '93.00', 0.6, 3, 10, 10, 'MN', NULL, 2, NULL, '2018-06-13 16:58:52', NULL, NULL, 0.01, 0.03, 4, 6, '5.00', '6.00', 1, 2, NULL),
('AC-353503-15', 'CABLE VIDEO HDMI MANHATTAN 1.3 M-M  5.0M BOLSA 306133', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'HDMI', '148.54', 0.6, 3, 10, 10, 'MN', NULL, 3, NULL, NULL, NULL, NULL, 0.02, 0.04, 45, 8, NULL, NULL, 2, 2, NULL),
('AC-353503-16', 'CABLE MONITOR SVGA MANHATTAN 8MM HD15M-H  1.8M 309011', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'VGA', '60.38', 0.6, 3, 10, 10, 'MN', NULL, 4, NULL, '2018-06-12 21:23:54', NULL, NULL, 0.03, 0.03, 6, 10, NULL, NULL, 1, 1, NULL),
('AC-353503-29', 'CABLE USB V2.0 MANHATTAN EXT. 4.5M PLATA 340502', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'USB', '64.91', 0.3, 4, 10, 10, 'MN', NULL, 0, 0, '2018-07-19 21:30:12', NULL, NULL, 0.03, 0.02, 0, 0, NULL, NULL, 2, 1, NULL),
('AC-353503-3', 'EXTENSOR VIDEO MANHATTAN SVGA+AUDIO HASTA 300M 177344', NULL, 'ACCESORIOS', 'ADAPTADORES', 'MANHATTAN', 'EXTENSOR', '2295.68', 0.25, 12, 7.2, 2.5, 'MN', NULL, 8, NULL, '2018-06-13 15:33:34', NULL, NULL, 0.04, 0.03, 9, 2, NULL, NULL, 1, 1, NULL),
('AC-353503-30', 'CABLE SATA HDD MANHATTAN 50CM 340700', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'SATA', '23.58', 0.3, 4, 10, 10, 'MN', NULL, 2, NULL, '2018-06-12 21:24:21', NULL, NULL, 0.035, 0.02, 45, 11, NULL, NULL, 1, 1, NULL),
('AC-353503-31', 'CABLE MANHATTAN USB EXTENSION 4.5M GRIS 340960', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'USB', '52.93', 0.4, 3, 10, 10, 'MN', NULL, 14, NULL, NULL, NULL, NULL, 0.05, 0.02, 24, 2, NULL, NULL, 2, 2, NULL),
('AC-353503-45', 'MUX KVM MINI USB 4:1 MANHATTAN CON CABLES + AUDIO 151269', NULL, 'ACCESORIOS', 'ADAPTADORES', 'MANHATTAN', 'USB', '1645.22', 0.9, 1.85, 8.6, 2.6, 'MN', NULL, 12, NULL, NULL, NULL, NULL, 0.02, 0.01, 10, 3, NULL, NULL, 1, 1, NULL),
('AC-353503-46', 'BARRA MULTICONTACTO CON PROTECCION MANHATTAN 6 CONTACTOS 161138', NULL, 'ENERGIA', 'SUPRESORES', 'MANHATTAN', '6 CONTACTOS', '82.68', 0.24, 26, 4.9, 3, 'MN', NULL, 4, NULL, '2018-07-07 08:42:00', NULL, NULL, 0.04, 0.03, 2, 8, NULL, NULL, 2, 1, NULL),
('AC-353503-5', 'CARGADOR UNIVERSAL MANHATTAN PARA LAPTOP 70W 100854', NULL, 'ACCESORIOS', 'CARGADORES', 'MANHATTAN', 'UNIVERSAL', '457.90', 0.35, 5.8, 3.6, 11.5, 'MN', NULL, 0, NULL, '2018-07-07 08:43:19', NULL, NULL, 0.02, 0.04, 0, 0, NULL, NULL, 2, 1, NULL),
('AC-353503-56', 'CONVERTIDOR VIDEO MANHATTAN HDMI A SVGA+AUDIO 151559', NULL, NULL, NULL, NULL, 'CONVERTIDOR', '338.95', 0.3, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-19 17:47:41', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
('VP-427370-2', 'PROYECTOR EPSON POWERLITE 935W WXGA 3700 LUM HDMI (V11H565020)', NULL, 'PROYECTORES', 'VIDEOPROYECTOR', 'EPSON', 'WXGA', '24469.71', 2.9, 29.5, 22.9, 7.6, 'MN', NULL, 6, NULL, '2018-07-08 18:10:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_mayorista`
--

DROP TABLE IF EXISTS `tbl_articulo_mayorista`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_mayorista` (
  `sku` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sku_fabricante` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `seccion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `linea` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `marca` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `serie` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `alto` float DEFAULT NULL,
  `largo` float DEFAULT NULL,
  `ancho` float DEFAULT NULL,
  `moneda` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `almacen` int(11) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `disponible` int(11) DEFAULT NULL,
  `ultima_modificacion` datetime DEFAULT NULL,
  `id_usuario_modifico` int(11) DEFAULT NULL,
  `id_snap` int(11) DEFAULT NULL,
  PRIMARY KEY (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tbl_articulo_mayorista`
--

INSERT INTO `tbl_articulo_mayorista` (`sku`, `descripcion`, `sku_fabricante`, `seccion`, `linea`, `marca`, `serie`, `precio`, `peso`, `alto`, `largo`, `ancho`, `moneda`, `almacen`, `existencia`, `disponible`, `ultima_modificacion`, `id_usuario_modifico`, `id_snap`) VALUES
('AC-2098484-11', 'KIT ACTECK WKTE-006 TECLADO MULTIMEDIA / MOUSE / BOCINAS USB AK3-2700', '', NULL, 'KIT', 'ACTECK', 'USB', '201.26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-22140104-03', 'MOUSE LOGITECH G600 OPTICO 20 BOTONES MMO GAMING NEGRO (910-003879)', '', NULL, 'MOUSE', 'LOGITECH', 'GAMER', '590.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-2238104-04', 'MOUSE ACTECK MO-200 OPTICO USB ESTANDAR WKMO-001', '', NULL, 'MOUSE', 'ACTECK', 'ALAMBRICO', '59.61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-2238104-23', 'KIT ACTECK AK2-2700 TECLADO Y MOUSE NEGRO USB ALAMBRICO WKTE-005', '', NULL, 'KIT', 'ACTECK', 'ALAMBRICO', '136.75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-230663-110', 'TECLADO LOGITECH K230 INALAMBRICO USB NEGRO (920-004424)', '', NULL, 'TECLADOS', 'LOGITECH', 'INALAMBRICO', '205.56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-230663-132', 'MOUSE LOGITECH M317 INALAMBRICO BLANCO - CRISTAL WHITE  (910-003245)', '', NULL, 'MOUSE', 'LOGITECH', 'INALAMBRICO', '235.56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-343772-1', 'MEMORIA ADATA OTG AI920, USB 3.1-LIGHTNING, 32GB,NEGRO(AAI920-32G-CBK)', '', NULL, 'ACCESORIOS', 'ADATA', '32GB', '28.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-12', 'CABLE CORRIENTE CPU/MON-PARED MANHATTAN 1.8M BOLSA 300179', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'USB', '45.91', 0.4, 3, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-14', 'CABLE VIDEO HDMI MANHATTAN 1.3 M-M  3.0M BOLSA 306126', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'HDMI', '95.26', 0.6, 3, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-15', 'CABLE VIDEO HDMI MANHATTAN 1.3 M-M  5.0M BOLSA 306133', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'HDMI', '149.22', 0.6, 3, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-16', 'CABLE MONITOR SVGA MANHATTAN 8MM HD15M-H  1.8M 309011', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'VGA', '59.54', 0.6, 3, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-29', 'CABLE USB V2.0 MANHATTAN EXT. 4.5M PLATA 340502', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'USB', '62.91', 0.3, 4, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-3', 'EXTENSOR VIDEO MANHATTAN SVGA+AUDIO HASTA 300M 177344', NULL, 'ACCESORIOS', 'ADAPTADORES', 'MANHATTAN', 'EXTENSOR', '2900.78', 0.25, 12, 7.2, 2.5, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-30', 'CABLE SATA HDD MANHATTAN 50CM 340700', NULL, 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'SATA', '24.73', 0.3, 4, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-31', 'CABLE MANHATTAN USB EXTENSION 4.5M GRIS 340960', '', 'ACCESORIOS', 'CABLES', 'MANHATTAN', 'USB', '54.16', 0.4, 3, 10, 10, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-45', 'MUX KVM MINI USB 4:1 MANHATTAN CON CABLES + AUDIO 151269', NULL, 'ACCESORIOS', 'ADAPTADORES', 'MANHATTAN', 'USB', '1552.92', 0.9, 1.85, 8.6, 2.6, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-46', 'BARRA MULTICONTACTO CON PROTECCION MANHATTAN 6 CONTACTOS 161138', NULL, 'ENERGIA', 'SUPRESORES', 'MANHATTAN', '6 CONTACTOS', '80.27', 0.24, 26, 4.9, 3, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-5', 'CARGADOR UNIVERSAL MANHATTAN PARA LAPTOP 70W 100854', NULL, 'ACCESORIOS', 'CARGADORES', 'MANHATTAN', 'UNIVERSAL', '357.90', 0.35, 5.8, 3.6, 11.5, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('AC-353503-56', 'CONVERTIDOR VIDEO MANHATTAN HDMI A SVGA+AUDIO 151559', NULL, 'ACCESORIOS', 'ADAPTADORES', 'MANHATTAN', 'CONVERTIDOR', '338.95', 0.3, 5, 19, 18, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('VP-427370-2', 'PROYECTOR EPSON POWERLITE 935W WXGA 3700 LUM HDMI (V11H565020)', NULL, 'PROYECTORES', 'VIDEOPROYECTOR', 'EPSON', 'WXGA', '24285.50', 2.9, 29.5, 22.9, 7.6, 'MN', NULL, NULL, NULL, NULL, NULL, NULL),
('VP-427431-13', 'PROYECTOR BENQ MW820ST DLP LUM 3000 WXGA 1280x800 LAM 6500H HDMI 3D', '', 'PROYECTORES', 'VIDEOPROYECTOR', 'BENQ', 'WXGA', '13521.43', 2.8, 12, 23.5, 29, 'MN', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_mayorista_snap`
--

DROP TABLE IF EXISTS `tbl_articulo_mayorista_snap`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_mayorista_snap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `data` longtext COLLATE utf8_spanish2_ci,
  `disponible` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `numero_registros` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_meli`
--

DROP TABLE IF EXISTS `tbl_articulo_meli`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_meli` (
  `sku` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `id` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `marca` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `serie` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` DECIMAL(15,2) DEFAULT NULL DEFAULT '0',
  `precio_original` DECIMAL(15,2) DEFAULT NULL DEFAULT '0',
  `cambio` int(11) DEFAULT NULL,
  `tipo_cambio` int(1) DEFAULT '4',
  `site_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `subtitle` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `seller_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `category_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `price` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `base_price` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `original_price` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `currency_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `initial_quantity` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `available_quantity` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sold_quantity` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sale_terms` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `buying_mode` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `listing_type_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `start_time` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `historical_start_time` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `stop_time` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `end_time` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `expiration_time` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `condition` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `permalink` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `thumbnail` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `secure_thumbnail` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pictures` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `video_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descriptions` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `accepts_mercadopago` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `non_mercado_pago_payment_methods` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `shipping` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `international_delivery_mode` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `seller_address` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `seller_contact` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `location` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `geolocation` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `coverage_areas` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `attributes` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `warnings` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `listing_source` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `variations` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sub_status` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tags` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `warranty` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `catalog_product_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `domain_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tbl_articulo_melicol` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `seller_custom_field` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tbl_articulo_melicol1` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `parent_item_id` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `differential_pricing` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `deal_ids` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `automatic_relist` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `date_created` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `last_updated` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `health` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tbl_articulo_meli`
--

INSERT INTO `tbl_articulo_meli` (`sku`, `id`, `marca`, `serie`, `precio`, `precio_original`, `cambio`, `tipo_cambio`, `site_id`, `title`, `subtitle`, `seller_id`, `category_id`, `price`, `base_price`, `original_price`, `currency_id`, `initial_quantity`, `available_quantity`, `sold_quantity`, `sale_terms`, `buying_mode`, `listing_type_id`, `start_time`, `historical_start_time`, `stop_time`, `end_time`, `expiration_time`, `condition`, `permalink`, `thumbnail`, `secure_thumbnail`, `pictures`, `video_id`, `descriptions`, `accepts_mercadopago`, `non_mercado_pago_payment_methods`, `shipping`, `international_delivery_mode`, `seller_address`, `seller_contact`, `location`, `geolocation`, `coverage_areas`, `attributes`, `warnings`, `listing_source`, `variations`, `status`, `sub_status`, `tags`, `warranty`, `catalog_product_id`, `domain_id`, `tbl_articulo_melicol`, `seller_custom_field`, `tbl_articulo_melicol1`, `parent_item_id`, `differential_pricing`, `deal_ids`, `automatic_relist`, `date_created`, `last_updated`, `health`) VALUES
('AC-2098484-11', 'MLM627624429', 'ACTECK', 'USB', 200.26, NULL, 0, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_meli_snap`
--

DROP TABLE IF EXISTS `tbl_articulo_meli_snap`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_meli_snap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `data` longtext COLLATE utf8_spanish2_ci,
  `disponible` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `numero_registros` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_prestashop`
--

DROP TABLE IF EXISTS `tbl_articulo_prestashop`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_prestashop` (
  `sku` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `id_prestashop` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `serie` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` DECIMAL(15,2) NOT NULL DEFAULT '0',
  `cambio` int(11) DEFAULT NULL,
  `precio_original` DECIMAL(15,2) NOT NULL DEFAULT '0',
  `tipo_cambio` int(1) DEFAULT NULL,
  PRIMARY KEY (`sku`),
  UNIQUE KEY `sku_UNIQUE` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tbl_articulo_prestashop`
--

INSERT INTO `tbl_articulo_prestashop` (`sku`, `id_prestashop`, `marca`, `serie`, `precio`, `cambio`, `precio_original`, `tipo_cambio`) VALUES
('AC-2098484-11', '51', 'ACTECK', 'USB', 190.28, 0, 190.26, 4),
('AC-22140104-03', '52', 'LOGITECH', 'GAMER', 543.33, 1, 543.33, 5),
('AC-2238104-04', '50', 'ACTECK', 'ALAMBRICO', 59.73, 1, 59.73, 5),
('AC-230663-110', '53', 'LOGITECH', 'INALAMBRICO', 205.63, 1, 205.56, 5),
('AC-230663-146', '54', 'LOGITECH', 'INALAMBRICO', 301.61, 1, 296.61, 5),
('AC-230663-147', '-1', NULL, NULL, 340.46, NULL, 340.46, NULL),
('AC-230663-97', '-1', NULL, NULL, 188.89, NULL, 188.89, NULL),
('AC-343772-1', '56', NULL, '32GB', 522.76, 0, 28, 4),
('AC-345796-1', '55', 'TPLINK', 'BLUETOOTH', 303.39, 0, 16.25, 4),
('AC-353503-12', '-1', NULL, NULL, 45.91, NULL, 45.91, NULL),
('AC-353503-13', '-1', NULL, NULL, 43.95, NULL, 43.95, NULL),
('AC-353503-14', '-1', NULL, NULL, 93, NULL, 93, NULL),
('AC-353503-15', '-1', NULL, NULL, 148.54, NULL, 148.54, NULL),
('AC-353503-16', '-1', NULL, NULL, 60.38, NULL, 60.38, NULL),
('AC-353503-29', '-1', NULL, NULL, 64.91, NULL, 64.91, NULL),
('AC-353503-3', '-1', NULL, NULL, 2295.68, NULL, 2295.68, NULL),
('AC-353503-30', '-1', NULL, NULL, 23.58, NULL, 23.58, NULL),
('AC-353503-31', '-1', NULL, NULL, 52.93, NULL, 52.93, NULL),
('AC-353503-45', '-1', NULL, NULL, 1645.22, NULL, 1645.22, NULL),
('AC-353503-46', '-1', NULL, NULL, 82.68, NULL, 82.68, NULL),
('AC-353503-5', '-1', NULL, NULL, 457.9, NULL, 457.9, NULL),
('AC-353503-56', '-1', NULL, NULL, 338.95, NULL, 338.95, NULL),
('VP-427370-2', '-1', NULL, NULL, 24469.7, NULL, 24469.71, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_prestashop_snap`
--

DROP TABLE IF EXISTS `tbl_articulo_prestashop_snap`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_prestashop_snap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `data` longtext COLLATE utf8_spanish2_ci,
  `disponible` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `numero_registros` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articulo_snap`
--

DROP TABLE IF EXISTS `tbl_articulo_snap`;
CREATE TABLE IF NOT EXISTS `tbl_articulo_snap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `data` longtext COLLATE utf8_spanish2_ci,
  `disponible` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `numero_registros` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_storage_item`
--

DROP TABLE IF EXISTS `tbl_file_storage_item`;
CREATE TABLE IF NOT EXISTS `tbl_file_storage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_file_storage_item`
--

INSERT INTO `tbl_file_storage_item` (`id`, `component`, `base_url`, `path`, `type`, `size`, `name`, `upload_ip`, `created_at`) VALUES
(13, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/bluN7TJS4msWMLRLFo94tk80UjBh36Wv.jpg', 'image/jpeg', 5291, 'bluN7TJS4msWMLRLFo94tk80UjBh36Wv', '::1', 1512847019),
(14, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/XluP2Ua8H6wUed4ZU1i5nvwDycqG7nQn.jpg', 'image/jpeg', 29843, 'XluP2Ua8H6wUed4ZU1i5nvwDycqG7nQn', '::1', 1513530448),
(16, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/PcB-1MKG8jkcKaZEhnKpEhrScmufAnMB.jpg', 'image/jpeg', 57461, 'PcB-1MKG8jkcKaZEhnKpEhrScmufAnMB', '::1', 1513530743),
(19, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/vhZo8WDr40C7uYosvL-sPkwmWBRtOTQK.jpg', 'image/jpeg', 215949, 'vhZo8WDr40C7uYosvL-sPkwmWBRtOTQK', '::1', 1517955616),
(20, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/o2tpiWKHqKV9sxneA5cGKSLdHyYdaAIU.jpg', 'image/jpeg', 120228, 'o2tpiWKHqKV9sxneA5cGKSLdHyYdaAIU', '::1', 1517955983),
(21, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/DIk1ZSkvLnk424v_4w3BCi2U353JDuhb.jpg', 'image/jpeg', 29458, 'DIk1ZSkvLnk424v_4w3BCi2U353JDuhb', '::1', 1517956093),
(22, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/4fdo3TNjQx99mREn9S5QOEJNeVBpW7g3.jpg', 'image/jpeg', 54625, '4fdo3TNjQx99mREn9S5QOEJNeVBpW7g3', '::1', 1517956318),
(24, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/YdOK05vSXjSgR78rxWtp7KnfTM0-wDQW.png', 'image/png', 534390, 'YdOK05vSXjSgR78rxWtp7KnfTM0-wDQW', '::1', 1517956942),
(26, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/kDmrEqQKxJPIMWM7iUHhz8DiWXqDXN3M.jpg', 'image/jpeg', 29843, 'kDmrEqQKxJPIMWM7iUHhz8DiWXqDXN3M', '::1', 1517957501),
(27, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/rKk56ygkGPfRdHWmbJapkptcj2ggPo-D.jpg', 'image/jpeg', 105942, 'rKk56ygkGPfRdHWmbJapkptcj2ggPo-D', '::1', 1517957511),
(28, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/MMFdkpBAnU6ntiqvrUGaCxg20DAG-TDh.jpg', 'image/jpeg', 29843, 'MMFdkpBAnU6ntiqvrUGaCxg20DAG-TDh', '::1', 1517957546),
(30, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/twCYWMrW5qxJj3yIEuyD5_LA2BRXvAma.png', 'image/png', 115395, 'twCYWMrW5qxJj3yIEuyD5_LA2BRXvAma', '::1', 1517958571),
(31, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/gqutmQbC4WLaH6H6eDcHnCgF0ZDPgqeZ.jpg', 'image/jpeg', 54625, 'gqutmQbC4WLaH6H6eDcHnCgF0ZDPgqeZ', '::1', 1517958692),
(32, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/1gi68WlsCGKFtYgmMKaelVQINsfwCehX.jpg', 'image/jpeg', 29843, '1gi68WlsCGKFtYgmMKaelVQINsfwCehX', '::1', 1517958729),
(33, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/DZx1chsr1lXst8YySp0DnVd2fi4Ca8kg.jpg', 'image/jpeg', 60363, 'DZx1chsr1lXst8YySp0DnVd2fi4Ca8kg', '::1', 1517958904),
(35, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/dzrCMRZSAI01EV95lzNyIJralxo5P1Do.png', 'image/png', 5438, 'dzrCMRZSAI01EV95lzNyIJralxo5P1Do', '::1', 1518067083),
(36, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/ANblcWA-CbJumHqFtsBmaoH1caYXWwMg.jpg', 'image/jpeg', 29843, 'ANblcWA-CbJumHqFtsBmaoH1caYXWwMg', '::1', 1519621672),
(37, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/Yp32OcjJD6mo5OS4FYvsQsQ7nbs-E6sR.jpg', 'image/jpeg', 29843, 'Yp32OcjJD6mo5OS4FYvsQsQ7nbs-E6sR', '::1', 1519622765),
(39, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/HZ6CuzTNtkRIeNLN0PXRCte4BRTfNAba.jpg', 'image/jpeg', 29843, 'HZ6CuzTNtkRIeNLN0PXRCte4BRTfNAba', '::1', 1519873014),
(41, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/ROYhYKu9T8mYjisMv87M2HCtIGLw7PXV.jpg', 'image/jpeg', 29458, 'ROYhYKu9T8mYjisMv87M2HCtIGLw7PXV', '::1', 1520200750),
(42, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/LCBJZrDB8vEAdKIx7EuElHPG0w9ord8i.jpg', 'image/jpeg', 60312, 'LCBJZrDB8vEAdKIx7EuElHPG0w9ord8i', '::1', 1520200789),
(46, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/Im-c7L3gYOF0LiutXPeP5biowDuqSKk7.png', 'image/png', 1183184, 'Im-c7L3gYOF0LiutXPeP5biowDuqSKk7', '::1', 1520201277),
(53, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/Vqfupm0zNdRx9nLly1rBLrA7eQEq1duh.jpg', 'image/jpeg', 55905, 'Vqfupm0zNdRx9nLly1rBLrA7eQEq1duh', '::1', 1520205002),
(54, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/MhqCdA3Ph6aWERBE1jNK_RlFMr8Xi5Fc.png', 'image/png', 2026, 'MhqCdA3Ph6aWERBE1jNK_RlFMr8Xi5Fc', '::1', 1520205353),
(55, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/gpygOcUD1YEPQ4xRwoevhgpFxZz0uIDl.jpg', 'image/jpeg', 811260, 'gpygOcUD1YEPQ4xRwoevhgpFxZz0uIDl', '::1', 1520366372),
(58, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/pScPjfIODKhPvzB31mX5gNNikxwyb_0y.png', 'image/png', 13824, 'pScPjfIODKhPvzB31mX5gNNikxwyb_0y', '127.0.0.1', 1525904511),
(59, 'fileStorage', 'http://storage.supertiendahub.local/source', '1/6-gEMaM62n1Nc5KwT5hXAzpUM5S3aUe2.png', 'image/png', 13824, '6-gEMaM62n1Nc5KwT5hXAzpUM5S3aUe2', '127.0.0.1', 1525904579);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_i18n_message`
--

DROP TABLE IF EXISTS `tbl_i18n_message`;
CREATE TABLE IF NOT EXISTS `tbl_i18n_message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_i18n_source_message`
--

DROP TABLE IF EXISTS `tbl_i18n_source_message`;
CREATE TABLE IF NOT EXISTS `tbl_i18n_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_key_storage_item`
--

DROP TABLE IF EXISTS `tbl_key_storage_item`;
CREATE TABLE IF NOT EXISTS `tbl_key_storage_item` (
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `idx_key_storage_item_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_key_storage_item`
--

INSERT INTO `tbl_key_storage_item` (`key`, `value`, `comment`, `updated_at`, `created_at`) VALUES
('backend.layout-boxed', '1', NULL, 1517386737, NULL),
('backend.layout-collapsed-sidebar', '0', NULL, 1517386759, NULL),
('backend.layout-fixed', '1', NULL, 1517386732, NULL),
('backend.theme-skin', 'skin-purple', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', 1528912443, NULL),
('config.meli.client.filter', 'N/lU1w8XxivpMkrmcw2BgzI3NDdjMjI5NWJlZjY4MDJhNWM3ZDg4ODkzMTQwOWM0ZDA1ZTE5YzdkZmU4MDQxOGFkNjUwOGM4ZGQ4YWRjZmYjWWx69Rb1VHIhJn6JaaollN1tSO9Yi5Ha2MzjaAQGkA==', 'Filtro de búsqueda para Mercado Libre', 1527308303, 1527098083),
('config.meli.client.id', '9UQpNZsaIe/6lIaMiE7+njczNzkwNzQwMzk5NWIzMTk5NzRjYzUzNTA2ODYyNGFiODU3MjBlZDEyOTkwNWI0ZmVhMThlZWQ2MzA5NDZjZmHV7hIGz1aC0kRDmJ1WlC3/TaeT8YDcdPRfjgHQsdqUHv3I7ACJEGeTCgvOYU/TrC8=', 'OAuth2 Client Id para mercado libre', 1527308303, 1527098083),
('config.meli.client.secret', 'WVuU0s9hJgEUybRTvQmFDTA1ZWY1NzQ1NGUyZTkxNzNiNjExNDIyNzU3MzU1NDBkM2I5ZGIxZGIzNzc2YjA4Y2U1ZWZiZjUzYTMwN2RjOTQTy0UgVlbQgjtCgaoYj5h5K6T6bwgZNXZfnmMwmlEyv+fLEGbs7i6LmXG2GGe2S/BdANTDZxA6XvAHg6DY533e', 'OAuth2 Client secret para Mercado Libre', 1527308303, 1527098083),
('config.meli.client.timeout', 'W/pAfzrpmP68h0/h7aw0wTI4M2JjMzMxODJkNGU1MDcwZjU2ZmEzODVlOGIzODY2Y2FlYzJlNGU3ZWY3NjUwYzc1MThkZWE4OWI1YmU5NTJ9RU3pNU/j1YSPZwfyy08M7cVZcsBiKu3goHuqEfWt8A==', 'Timeout de respuesta del servicio', 1527308303, 1527098083),
('config.meli.client.url.api', 'LxMT2gtcmue5Nahbe5HpWjQxNDM0YTBmMmEzZGY0MTNhN2ViYTE5MDIwZWMzMDYxZmM5YmU4NDViYmU0MjIxZTA4MTFlYjA0NGNiZTFmMTOQcd3NFZHm2DwfNGLk85BdlLGho7t9GNtdrX9OecGvrKUEYqrFxX7KzwCnD+Uz0ZQ=', 'URL para conectarse a Mercado Libre', 1527308303, 1527098083),
('config.meli.client.url.token', 'yZ7nxPrY3YigPk8WHpBGGGVhNzM4NGMxYTQzOTAzNGEwYzg3MGNjMGEyZTYzNTQ3MDUzYjA1ZjlhOTcyMDZhN2ViNTMxMzNmZGIwNzE3ZDFgcuRI5kMvWflAj+zavq85wMU5Ct/JqQT5NSPj3gydzoWRMtoLtfsu25eFEz7aWMCBejym+XDOMPTZRvg7pjB5', 'URL para obtener token de mercado libre', 1527308303, 1527098083),
('config.meli.client.userid', '/izf/+t/c30c870PirdoqjdjNDEwODA0NWIyYjViNTk3OWRlNzU0NzNmYTJmM2M5NzRjMjI2MTU3YmQwZmQ5MDQ1MmY5OWFjMmQ2ODNkNzVsKU3BGP0TeGdvwh/n5dqLpo7nx8zuoJl/dzDhTyRx5w==', 'User Id de Mercado libre', 1527308303, 1527098083),
('config.phc.aviso.correo', 'dreadber@gmail.com', 'Correo electronico para aviso de cambios en PHC', 1527351987, 1527098083),
('config.phc.contacto.correo', 'phc@phc.com', 'Correo electrónico', 1527098083, 1527098083),
('config.phc.contacto.direccion', 'Av. Texcoco', 'Dirección de contacto', 1527098083, 1527098083),
('config.phc.contacto.telefono', '    +5255 51078305', 'Teléfono de contacto', 1527098083, 1527098083),
('config.phc.cron.activo', 'SI', '¿Proceso automático activo?', 1527098083, 1527098083),
('config.phc.cron.intervalo.hora', '2', 'Periodo tiempo en horas para el proceso automático', 1527308303, 1527098083),
('config.phc.precios.fluctuacion.mayor', '5', 'Fluctuación mayor de precios (%)', 1527098083, 1527098083),
('config.phc.precios.fluctuacion.menor', '5', 'Fluctuación menor de precios (%)', 1527098083, 1527098083),
('config.phc.webservice.cliente', '50527', 'Identificador del cliente', 1528657465, 1527098083),
('config.phc.webservice.endpoint', 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl', 'Url de servicio PHC Mayoristas', 1528657465, 1527098083),
('config.phc.webservice.llave', '487478', 'Llave del cliente', 1528657465, 1527098083),
('config.prestashop.client.filter', '1r6RV2P/lmzRexxlh36XiGE4ODYwZWVjM2VmZWI5ZGY2NGE4OGE4MTk5NDNiMWQwMGJhMWNiZjk2ODRkYjI3YTUwN2Q2NWZhYmEzYmUzMzdB/52Sn6V55c+efg4IkiHOXKPa3Nba5FjoAIDMK9N4OA==', 'Filtro para realizar la búsqueda en prestashop', 1527308303, 1527098083),
('config.prestashop.client.password', 'yc5uwH2HTwh61hRDclBiaGYyMDcwMDNiNTkxMjJkMmQxZGYwOTFlNzhlMDAzYjAyZDQ4NWQ2ZmY2MjRlZjE4YWVmYTMwNGViMDU2OWM4MDAsFgIG+ywUqSSNqbLvmt/xj+jDgoEK5Qp6uexZktC/MfUbRBj+j5h7Aq215n6UwYltpIeUqhLl49Gr8aLy3tuu', 'Password para conectarse a prestashop', 1527308303, 1527098083),
('config.prestashop.client.timeout', 'hAlYc8AUT2R2oboKmGTXxTE5ZWViYjNkMGIxOThjOGU0Y2RjNWEzOGI0NTBjZjFhNjRjZWQyOTI4YWYxNDQ4YjBlNDY5NzdkNDNkZjVmNmNMeBjnO34CtNb+t8ry1CUTCbyPeKxrX6xETuln9jn+Sg==', 'Timeout de respuesta del servicio.', 1527308303, 1527098083),
('config.prestashop.client.url.api', 'VrACX16Xy/vRBws2hxoijTA5ODdmMWQwNjlmZGZjOTM4NTU0NzhkZTZhZGJhNTE5MjMxZGY1YThlOGQxOTY5N2E5NjVjYzg0MGEyNmU3MTdiBYBblI+EM3x+f5SsUYajpfFZ4KZH3P5XoEYzrxaGO3Rj4QO7MrQoqxeitu4+KSeMx1Mh4OA4SS/xL60ghppP', 'Ruta para conectarse a prestashop', 1527308303, 1527098083),
('config.st.tienda.contacto.correo', 'omondragon@supertienda.mx', 'Correo electronico responsable', 1527098017, 1527098017),
('config.st.tienda.contacto.nombre', 'Omar Mondragón', 'Nombre del responsable', 1527098017, 1527098017),
('config.st.tienda.contacto.telefono', '555211587663', 'Telefono de contacto', 1527098017, 1527098017),
('config.st.tienda.direccion', 'Los reyes la paz edo. mex', 'Direccion de la tienda', 1527098017, 1527098017),
('config.st.tienda.nombre', 'Super Tienda', 'Nombre de la tienda', 1527098017, 1527098017),
('config.st.tienda.social.fb', '@supertienda', 'Pagina Facebook', 1527098017, 1527098017),
('config.st.tienda.social.tw', '@supertienda', 'Tweeter', 1527098017, 1527098017),
('config.st.tienda.soporte.correo', 'jesus.nataren@pinfo.com.mx', 'Correo soporte tecnico', 1527098017, 1527098017),
('config.st.tienda.soporte.telefono', '5551078307', 'Telefono soporte tecnico', 1527098017, 1527098017),
('frontend.maintenance', 'disabled', 'Set it to \"enabled\" to turn on maintenance mode', NULL, NULL),
('phc.articulo.precio.tolerancia.mayor', '5', 'Porcentaje tolerancia mayor  respecto al precio base.', 1527098083, 1527098083),
('phc.articulo.precio.tolerancia.menor', '5', 'Porcentaje de tolerancía menor respecto a su precio.', 1527098017, 1527098017);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `slug`, `title`, `body`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about', 'About', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 1, 1512840790, 1512840790);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rbac_auth_assignment`
--

DROP TABLE IF EXISTS `tbl_rbac_auth_assignment`;
CREATE TABLE IF NOT EXISTS `tbl_rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_rbac_auth_assignment`
--

INSERT INTO `tbl_rbac_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1512840796),
('manager', '2', 1512840796),
('user', '3', 1512840796);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rbac_auth_item`
--

DROP TABLE IF EXISTS `tbl_rbac_auth_item`;
CREATE TABLE IF NOT EXISTS `tbl_rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_rbac_auth_item`
--

INSERT INTO `tbl_rbac_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, NULL, NULL, 1512840796, 1512840796),
('editOwnModel', 2, NULL, 'ownModelRule', NULL, 1512840796, 1512840796),
('loginToBackend', 2, NULL, NULL, NULL, 1512840796, 1512840796),
('manager', 1, NULL, NULL, NULL, 1512840796, 1512840796),
('user', 1, NULL, NULL, NULL, 1512840796, 1512840796);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rbac_auth_item_child`
--

DROP TABLE IF EXISTS `tbl_rbac_auth_item_child`;
CREATE TABLE IF NOT EXISTS `tbl_rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_rbac_auth_item_child`
--

INSERT INTO `tbl_rbac_auth_item_child` (`parent`, `child`) VALUES
('user', 'editOwnModel'),
('manager', 'loginToBackend'),
('administrator', 'manager'),
('manager', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rbac_auth_rule`
--

DROP TABLE IF EXISTS `tbl_rbac_auth_rule`;
CREATE TABLE IF NOT EXISTS `tbl_rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_rbac_auth_rule`
--

INSERT INTO `tbl_rbac_auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('ownModelRule', 0x4f3a32393a22636f6d6d6f6e5c726261635c72756c655c4f776e4d6f64656c52756c65223a333a7b733a343a226e616d65223b733a31323a226f776e4d6f64656c52756c65223b733a393a22637265617465644174223b693a313531323834303739363b733a393a22757064617465644174223b693a313531323834303739363b7d, 1512840796, 1512840796);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_db_migration`
--

DROP TABLE IF EXISTS `tbl_system_db_migration`;
CREATE TABLE IF NOT EXISTS `tbl_system_db_migration` (
  `version` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_system_db_migration`
--

INSERT INTO `tbl_system_db_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1512840766),
('m140703_123000_user', 1512840775),
('m140703_123055_log', 1512840776),
('m140703_123104_page', 1512840776),
('m140703_123803_article', 1512840781),
('m140703_123813_rbac', 1512840783),
('m140709_173306_widget_menu', 1512840783),
('m140709_173333_widget_text', 1512840784),
('m140712_123329_widget_carousel', 1512840785),
('m140805_084745_key_storage_item', 1512840786),
('m141012_101932_i18n_tables', 1512840787),
('m150318_213934_file_storage_item', 1512840788),
('m150414_195800_timeline_event', 1512840788),
('m150725_192740_seed_data', 1512840790),
('m150929_074021_article_attachment_order', 1512840791),
('m160203_095604_user_token', 1512840792);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_log`
--

DROP TABLE IF EXISTS `tbl_system_log`;
CREATE TABLE IF NOT EXISTS `tbl_system_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_rbac_migration`
--

DROP TABLE IF EXISTS `tbl_system_rbac_migration`;
CREATE TABLE IF NOT EXISTS `tbl_system_rbac_migration` (
  `version` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_system_rbac_migration`
--

INSERT INTO `tbl_system_rbac_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1512840792),
('m150625_214101_roles', 1512840796),
('m150625_215624_init_permissions', 1512840796),
('m151223_074604_edit_own_model', 1512840796);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeline_event`
--

DROP TABLE IF EXISTS `tbl_timeline_event`;
CREATE TABLE IF NOT EXISTS `tbl_timeline_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `event` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_client_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '2',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `auth_key`, `access_token`, `password_hash`, `oauth_client`, `oauth_client_user_id`, `email`, `status`, `created_at`, `updated_at`, `logged_at`) VALUES
(1, 'webmaster', '9S0gVgMLM4071jF8KCCx6s_7-uncmI59', 'bGzjCWarbQzpUzXpfzQLXbOHKlHrwAVulyD9BeJ8', '$2y$13$QaJUckpnCQRG4GzLIgNKL.rB.Grq/yBRiwr.ESxJ56Ba4kFeS4EhC', NULL, NULL, 'webmaster@example.com', 2, 1512840789, 1512840789, 1533324818),
(2, 'manager', 'GKic_2mdKe1_WTi2J7Zl_5oEcpgJ3N9S', 'ZWciGNBeOhvO4ewufpXeZYf-M02bXHsd41dFpH6d', '$2y$13$AJIrzdz4.vKgNSrWxMwP0OtJ2F13mYFwtLagMbMftsFD1QcQuBSFS', NULL, NULL, 'manager@example.com', 2, 1512840789, 1512840789, NULL),
(3, 'user', 'it9zfuDGAMko1scgkxG71-D03QjdfcJe', 'MhLNgjAUZWJCB8HdYbjOzgf1MvHDu-cge6eT05as', '$2y$13$XdDSENVS0CykDjnVSGoj9exMRlRPInIni70cIllig5EVmRWfWpOtC', NULL, NULL, 'user@example.com', 2, 1512840790, 1520195888, 1520195848);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profile`
--

DROP TABLE IF EXISTS `tbl_user_profile`;
CREATE TABLE IF NOT EXISTS `tbl_user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_profile`
--

INSERT INTO `tbl_user_profile` (`user_id`, `firstname`, `middlename`, `lastname`, `avatar_path`, `avatar_base_url`, `locale`, `gender`) VALUES
(1, 'Super', 'Tienda', 'Tienda', '1/6-gEMaM62n1Nc5KwT5hXAzpUM5S3aUe2.png', 'http://storage.supertiendahub.local/source', 'es', 1),
(2, NULL, NULL, NULL, NULL, NULL, 'en-US', NULL),
(3, 'Maria', 'Angelica', 'Hernandez', NULL, NULL, 'es', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_token`
--

DROP TABLE IF EXISTS `tbl_user_token`;
CREATE TABLE IF NOT EXISTS `tbl_user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_carousel`
--

DROP TABLE IF EXISTS `tbl_widget_carousel`;
CREATE TABLE IF NOT EXISTS `tbl_widget_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_carousel`
--

INSERT INTO `tbl_widget_carousel` (`id`, `key`, `status`) VALUES
(1, 'index', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_carousel_item`
--

DROP TABLE IF EXISTS `tbl_widget_carousel_item`;
CREATE TABLE IF NOT EXISTS `tbl_widget_carousel_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carousel_id` int(11) NOT NULL,
  `base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carousel` (`carousel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_carousel_item`
--

INSERT INTO `tbl_widget_carousel_item` (`id`, `carousel_id`, `base_url`, `path`, `type`, `url`, `caption`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://storage.centroculturalapizaco.local/source', '1/bluN7TJS4msWMLRLFo94tk80UjBh36Wv.jpg', 'image/jpeg', '/', '<p>Hey you lucky bastard<br></p>', 1, 0, NULL, 1512847031);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_menu`
--

DROP TABLE IF EXISTS `tbl_widget_menu`;
CREATE TABLE IF NOT EXISTS `tbl_widget_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_menu`
--

INSERT INTO `tbl_widget_menu` (`id`, `key`, `title`, `items`, `status`) VALUES
(1, 'frontend-index', 'Frontend index menu', '[\n    {\n        \"label\": \"Get started with Yii2\",\n        \"url\": \"http://www.yiiframework.com\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-success\\\">{label}</a>\"\n    },\n    {\n        \"label\": \"Yii2 Starter Kit on GitHub\",\n        \"url\": \"https://github.com/trntv/yii2-starter-kit\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-primary\\\">{label}</a>\"\n    },\n    {\n        \"label\": \"Find a bug?\",\n        \"url\": \"https://github.com/trntv/yii2-starter-kit/issues\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-danger\\\">{label}</a>\"\n    }\n]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_text`
--

DROP TABLE IF EXISTS `tbl_widget_text`;
CREATE TABLE IF NOT EXISTS `tbl_widget_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_widget_text_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_text`
--

INSERT INTO `tbl_widget_text` (`id`, `key`, `title`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'backend_welcome', 'Welcome to backend', '<p>Welcome to Yii2 Starter Kit Dashboard</p>', 1, 1512840790, 1512840790),
(2, 'ads-example', 'Google Ads Example Block', '<div class=\"lead\">\r\n                <script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n                <ins class=\"adsbygoogle\"\r\n                     style=\"display:block\"\r\n                     data-ad-client=\"ca-pub-9505937224921657\"\r\n                     data-ad-slot=\"2264361777\"\r\n                     data-ad-format=\"auto\"></ins>\r\n                <script>\r\n                (adsbygoogle = window.adsbygoogle || []).push({});\r\n                </script>\r\n            </div>', 0, 1512840790, 1512840790);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD CONSTRAINT `fk_article_author` FOREIGN KEY (`created_by`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_updater` FOREIGN KEY (`updated_by`) REFERENCES `tbl_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_article_attachment`
--
ALTER TABLE `tbl_article_attachment`
  ADD CONSTRAINT `fk_article_attachment_article` FOREIGN KEY (`article_id`) REFERENCES `tbl_article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_article_category`
--
ALTER TABLE `tbl_article_category`
  ADD CONSTRAINT `fk_article_category_section` FOREIGN KEY (`parent_id`) REFERENCES `tbl_article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_i18n_message`
--
ALTER TABLE `tbl_i18n_message`
  ADD CONSTRAINT `fk_i18n_message_source_message` FOREIGN KEY (`id`) REFERENCES `tbl_i18n_source_message` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_rbac_auth_assignment`
--
ALTER TABLE `tbl_rbac_auth_assignment`
  ADD CONSTRAINT `tbl_rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rbac_auth_item`
--
ALTER TABLE `tbl_rbac_auth_item`
  ADD CONSTRAINT `tbl_rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `tbl_rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rbac_auth_item_child`
--
ALTER TABLE `tbl_rbac_auth_item_child`
  ADD CONSTRAINT `tbl_rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_widget_carousel_item`
--
ALTER TABLE `tbl_widget_carousel_item`
  ADD CONSTRAINT `fk_item_carousel` FOREIGN KEY (`carousel_id`) REFERENCES `tbl_widget_carousel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
