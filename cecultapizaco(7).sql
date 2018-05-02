-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 04:58 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cecultapizaco`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alumno`
--

CREATE TABLE `tbl_alumno` (
  `id` int(11) NOT NULL,
  `numero_registro` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `sexo` tinyint(4) DEFAULT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo_postal` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_baja` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo_electronico` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_movil` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_casa` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_padre` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `edad_padre` int(3) DEFAULT NULL,
  `ocupacion_padre` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tel_padre` int(15) DEFAULT NULL,
  `nombre_madre` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `edad_madre` int(3) DEFAULT NULL,
  `ocupacion_madre` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tel_madre` int(15) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `lugar_nacimiento` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tel_emergencia` int(15) DEFAULT NULL,
  `escuela_procedencia` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `alergia_enfermedad` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tipo_sangineo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `afiliacion_seguro` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `curp` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `taller_inscribe` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `imagen_url` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `base_url` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `path` varchar(300) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_alumno`
--

INSERT INTO `tbl_alumno` (`id`, `numero_registro`, `nombre`, `fecha_nacimiento`, `fecha_alta`, `sexo`, `direccion`, `nacionalidad`, `estado`, `codigo_postal`, `fecha_baja`, `correo_electronico`, `telefono_movil`, `telefono_casa`, `nombre_padre`, `edad_padre`, `ocupacion_padre`, `tel_padre`, `nombre_madre`, `edad_madre`, `ocupacion_madre`, `tel_madre`, `fecha_ingreso`, `lugar_nacimiento`, `tel_emergencia`, `escuela_procedencia`, `alergia_enfermedad`, `tipo_sangineo`, `afiliacion_seguro`, `curp`, `taller_inscribe`, `imagen_url`, `base_url`, `path`) VALUES
(1, NULL, 'Carlos Nataren Ramirez', '1989-12-12', NULL, 1, 'test', 'test', NULL, NULL, NULL, NULL, '123123', '13123', 'test', 12, 'test', 121212, 'test1', 12, 'test', 1212121212, '2012-12-12', 'test', 12121212, 'test', 'tes', '1', '1', '123123sdasd', 'test', '', 'http://storage.centroculturalapizaco.local/source', '1/HZ6CuzTNtkRIeNLN0PXRCte4BRTfNAba.jpg'),
(2, NULL, 'jesus', '1980-12-12', NULL, 1, 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hola', NULL, '', '', ''),
(3, NULL, 'Rosa Hernandez Garcia', NULL, NULL, 0, '', '', NULL, NULL, NULL, NULL, '', '', '', NULL, '', NULL, '', NULL, '', NULL, NULL, '', NULL, '', '', '0', '2', '', 'ninguno', '', '', ''),
(4, NULL, 'Laura Garza Garcia', '1970-10-09', '2018-03-04', 0, 'Calle Guatemala #12', 'Tetla de la Solidaridad', NULL, NULL, NULL, NULL, '67781235', '12356788', 'Alberto Ramirez', 55, 'Obrero', 88843, 'Gelacia Martinez', 44, 'Ingeniero', 688, '2018-03-04', 'Tlaxcala', 123569, 'Oficial 1. Andres Manuel', 'ninguna', '2', '2', 'NARJ851225', NULL, NULL, 'http://storage.centroculturalapizaco.local/source', '1/MhqCdA3Ph6aWERBE1jNK_RlFMr8Xi5Fc.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article`
--

CREATE TABLE `tbl_article` (
  `id` int(11) NOT NULL,
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
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article_attachment`
--

CREATE TABLE `tbl_article_attachment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article_category`
--

CREATE TABLE `tbl_article_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_article_category`
--

INSERT INTO `tbl_article_category` (`id`, `slug`, `title`, `body`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'news', 'News', NULL, NULL, 1, 1512840790, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aula`
--

CREATE TABLE `tbl_aula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_max_personas` int(11) DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_aula`
--

INSERT INTO `tbl_aula` (`id`, `nombre`, `descripcion`, `numero_max_personas`, `disponible`) VALUES
(1, 'Principal', 'ninguna', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id`, `nombre`, `descripcion`, `disponible`) VALUES
(1, 'Musica', 'Musica para todas las edades', 1),
(2, 'Teatro', 'Teatro para todas las edades', 1),
(3, 'Danza', 'Danza para todas las edades', 1),
(4, 'Artes plasticas', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuota`
--

CREATE TABLE `tbl_cuota` (
  `id` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `concepto` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `concepto_impresion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_cuota`
--

INSERT INTO `tbl_cuota` (`id`, `creado_por`, `concepto`, `descripcion`, `concepto_impresion`, `monto`, `fecha_creacion`, `disponible`) VALUES
(1, 1, 'Inscripcion', 'Insripcion al taller', 'Incripcio centro cultural apizaco', 180, NULL, 1),
(2, 1, 'Colegiatura', 'pago de colegiatura', 'Pago de colegiatura de taller', 150, NULL, 1),
(3, 1, 'Colegiatura extemporanea', 'Pago por colegiatura extemporanea', 'Pago por colegiatura extemporanea.', 15, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuota_taller`
--

CREATE TABLE `tbl_cuota_taller` (
  `id` int(11) NOT NULL,
  `id_cuota` int(11) DEFAULT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `obligatoria` tinyint(4) DEFAULT NULL,
  `comentario` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `tipo_periodo` tinyint(4) DEFAULT NULL,
  `fecha_max_pago` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `concepto_imp` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_cuota_taller`
--

INSERT INTO `tbl_cuota_taller` (`id`, `id_cuota`, `id_taller`, `nombre`, `obligatoria`, `comentario`, `tipo_periodo`, `fecha_max_pago`, `monto`, `concepto_imp`) VALUES
(8, 1, 3, 'insc inicial', 1, 'se debe cubrir', 3, NULL, NULL, NULL),
(12, 2, 3, 'enero', 1, '', 1, NULL, NULL, NULL),
(13, 3, 3, 'enero', 0, '', 1, NULL, NULL, NULL),
(16, 2, 1, 'Cuota de abril', 0, 'Ninguno', 1, NULL, NULL, NULL),
(17, 2, 1, 'Colegiatura Juni', 1, 'Ninguno', 1, NULL, NULL, NULL),
(18, 1, 1, 'inscripcion', 1, '', 3, NULL, NULL, NULL),
(21, 2, 5, 'Abril', 1, '', 1, NULL, 190, NULL),
(22, 2, 5, 'Mayo', 1, '', 1, NULL, 100, NULL),
(23, 2, 5, 'Junio', 1, '', 1, NULL, 150, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuota_taller_imp`
--

CREATE TABLE `tbl_cuota_taller_imp` (
  `id` int(11) NOT NULL,
  `id_taller_imp` int(11) DEFAULT NULL,
  `id_cuota` int(11) DEFAULT NULL,
  `obligatoria` tinyint(4) DEFAULT NULL,
  `comentario` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_max_pago` date DEFAULT NULL,
  `tipo_periodo` tinyint(4) DEFAULT NULL,
  `concepto_imp` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `estatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_cuota_taller_imp`
--

INSERT INTO `tbl_cuota_taller_imp` (`id`, `id_taller_imp`, `id_cuota`, `obligatoria`, `comentario`, `fecha_max_pago`, `tipo_periodo`, `concepto_imp`, `monto`, `estatus`) VALUES
(2, 4, 2, 1, 'ninguno', '2018-01-01', 1, 'Pago de colegiatura de taller', 198, NULL),
(3, 4, 3, 0, 'Solo sino se paga la cuota', '2018-01-01', 1, 'Pago por colegiatura extemporanea.', 15, NULL),
(4, 6, 1, 1, 'se debe cubrir', NULL, 3, 'Incripcio centro cultural apizaco', 180, NULL),
(5, 6, 2, 1, '', NULL, 1, 'Pago de colegiatura de taller', 150, NULL),
(6, 6, 3, 0, '', NULL, 1, 'Pago por colegiatura extemporanea.', 15, NULL),
(7, 7, 1, 1, 'se debe cubrir', NULL, 3, 'Incripcio centro cultural apizaco', 190, NULL),
(8, 7, 2, 1, '', NULL, 1, 'Pago de colegiatura de taller', 150, NULL),
(9, 7, 3, 0, '', NULL, 1, 'Pago por colegiatura extemporanea.', 15, NULL),
(12, 4, 1, 1, 'test', '2018-02-28', 3, 'inscripcion', 180, NULL),
(13, 4, 2, 1, '', '2018-03-10', 1, 'Colegiatura Marzo', NULL, NULL),
(14, 10, 2, 0, 'Ninguno', NULL, 1, 'Pago de colegiatura de taller', 150, NULL),
(15, 10, 2, 1, 'Ninguno', NULL, 1, 'Pago de colegiatura de taller', 150, NULL),
(16, 10, 1, 1, '', NULL, 3, 'Incripcio centro cultural apizaco', 180, NULL),
(17, 11, 1, 1, 'Solo se cubre una vez', NULL, 1, 'Incripcio centro cultural apizaco', 180, NULL),
(19, 11, 2, 0, '', '2018-01-31', 1, 'Enero', 180, NULL),
(20, 11, 2, 1, '', '2018-02-28', 1, 'Febrero', 180, NULL),
(21, 11, 3, 0, '', '2018-04-01', 1, 'Ext Enero', 15, NULL),
(22, 13, 1, 1, 'Solo se cubre una vez', NULL, 1, 'Incripcio centro cultural apizaco', NULL, NULL),
(23, 13, 2, 1, '', NULL, 1, 'Pago de colegiatura de taller', NULL, NULL),
(24, 13, 2, 1, '', NULL, 1, 'Pago de colegiatura de taller', 190, NULL),
(25, 13, 2, 1, '', NULL, 1, 'Pago de colegiatura de taller', 100, NULL),
(26, 13, 2, 1, '', NULL, 1, 'Pago de colegiatura de taller', 150, NULL),
(27, 12, 1, 0, '', '2018-03-23', 1, 'Inscripcion', 180, NULL),
(28, 12, 2, 1, '', '2018-03-30', 1, 'Colegiatura', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_storage_item`
--

CREATE TABLE `tbl_file_storage_item` (
  `id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(51, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/bixGQLyByxthg0f6zQqV7rHvqEH2I1si.jpg', 'image/jpeg', 22670, 'bixGQLyByxthg0f6zQqV7rHvqEH2I1si', '::1', 1520203576),
(53, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/Vqfupm0zNdRx9nLly1rBLrA7eQEq1duh.jpg', 'image/jpeg', 55905, 'Vqfupm0zNdRx9nLly1rBLrA7eQEq1duh', '::1', 1520205002),
(54, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/MhqCdA3Ph6aWERBE1jNK_RlFMr8Xi5Fc.png', 'image/png', 2026, 'MhqCdA3Ph6aWERBE1jNK_RlFMr8Xi5Fc', '::1', 1520205353),
(55, 'fileStorage', 'http://storage.centroculturalapizaco.local/source', '1/gpygOcUD1YEPQ4xRwoevhgpFxZz0uIDl.jpg', 'image/jpeg', 811260, 'gpygOcUD1YEPQ4xRwoevhgpFxZz0uIDl', '::1', 1520366372);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_i18n_message`
--

CREATE TABLE `tbl_i18n_message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_i18n_source_message`
--

CREATE TABLE `tbl_i18n_source_message` (
  `id` int(11) NOT NULL,
  `category` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inscripcion`
--

CREATE TABLE `tbl_inscripcion` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_taller_imp` int(11) DEFAULT NULL,
  `id_pago` int(11) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `folio_inscripcion` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_operacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_inscripcion`
--

INSERT INTO `tbl_inscripcion` (`id`, `id_alumno`, `id_taller_imp`, `id_pago`, `fecha_inscripcion`, `folio_inscripcion`, `fecha_operacion`) VALUES
(3, 2, 4, 1, '2018-01-08', NULL, '2018-01-08'),
(4, 1, 4, NULL, '2018-01-09', NULL, '2018-01-09'),
(5, 3, 4, 15, '2018-02-21', NULL, '2018-02-21'),
(6, 3, 11, 16, '2018-02-26', NULL, '2018-02-26'),
(7, 1, 11, 21, '2018-03-02', NULL, '2018-03-02'),
(8, 2, 11, 25, '2018-03-02', NULL, '2018-03-02'),
(9, 4, 11, 26, '2018-03-06', NULL, '2018-03-06'),
(10, 1, 12, 28, '2018-03-06', NULL, '2018-03-06'),
(11, 4, 12, 29, '2018-03-06', NULL, '2018-03-06'),
(12, 3, 14, 30, '2018-03-06', NULL, '2018-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instructor`
--

CREATE TABLE `tbl_instructor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_cedula` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_registro` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `url_foto` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_fb` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_tw` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_cv` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` tinyint(4) DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT NULL,
  `localidad` tinyint(4) DEFAULT NULL,
  `correo_electroinico` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_instructor`
--

INSERT INTO `tbl_instructor` (`id`, `nombre`, `fecha_nacimiento`, `direccion`, `numero_cedula`, `numero_registro`, `fecha_alta`, `fecha_baja`, `url_foto`, `url_fb`, `url_tw`, `url_cv`, `sexo`, `disponible`, `localidad`, `correo_electroinico`, `telefono`) VALUES
(2, 'Jose de Jesus Nataren Ramirez', NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(3, 'Rafael Ramirez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, 'Angelica Hernandez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 'Adan Cruz', '1960-11-03', 'no tiene', 'CED', NULL, '2018-03-06', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL),
(6, 'Gelacio Ramirez', '2018-03-07', 'test', 'test', NULL, '2018-03-06', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'jesus.nataren@gmail.com', 6774212);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_key_storage_item`
--

CREATE TABLE `tbl_key_storage_item` (
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_key_storage_item`
--

INSERT INTO `tbl_key_storage_item` (`key`, `value`, `comment`, `updated_at`, `created_at`) VALUES
('backend.theme-skin', 'skin-black', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', 1519324952, NULL),
('backend.layout-fixed', '1', NULL, 1517386732, NULL),
('backend.layout-boxed', '1', NULL, 1517386737, NULL),
('backend.layout-collapsed-sidebar', '0', NULL, 1517386759, NULL),
('frontend.maintenance', 'disabled', 'Set it to "enabled" to turn on maintenance mode', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `slug` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `slug`, `title`, `body`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about', 'About', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 1, 1512840790, 1512840790);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pago_taller_cuota`
--

CREATE TABLE `tbl_pago_taller_cuota` (
  `id` int(11) NOT NULL,
  `id_taller_imp` int(11) DEFAULT NULL,
  `id_cuota_taller_imp` int(11) DEFAULT NULL,
  `id_cuota` int(11) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `concepto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `metodo_pago` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_instructor` int(11) DEFAULT NULL,
  `fecha_operacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_pago_taller_cuota`
--

INSERT INTO `tbl_pago_taller_cuota` (`id`, `id_taller_imp`, `id_cuota_taller_imp`, `id_cuota`, `monto`, `id_alumno`, `concepto`, `fecha_pago`, `metodo_pago`, `comentario`, `id_instructor`, `fecha_operacion`) VALUES
(1, 4, NULL, 1, 1200, 1, 'Inscripcion de mi chamaquito', '2018-01-01', NULL, NULL, 1, NULL),
(2, 7, 2, 2, 800, 1, 'inscripcion', '2018-01-17', NULL, NULL, 1, NULL),
(7, 4, NULL, 2, 155, 2, 'Pago de colegiatura de taller', '2018-01-22', '1', 'ninguno', NULL, '2018-01-26 02:54:02'),
(8, 4, 2, 2, 198, 2, 'Pago de colegiatura de taller', '2018-01-22', '1', 'ninguno', NULL, '2018-01-26 02:54:34'),
(9, 4, 3, 3, 15, 1, 'Pago por colegiatura extemporanea.', '2018-02-21', '1', '', NULL, '2018-02-16 02:56:07'),
(10, 4, 2, 2, 198, 1, 'Pago de colegiatura de taller', '2018-02-28', '1', '', NULL, '2018-02-16 03:59:53'),
(11, 4, 2, 2, 198, 1, 'Pago de colegiatura de taller', '2018-02-20', '1', 'ninguno', NULL, '2018-02-17 03:50:34'),
(12, 4, 2, 2, 198, 2, 'Pago de colegiatura de taller', '2018-02-28', '1', 'test', NULL, '2018-02-17 03:54:45'),
(13, 4, 2, 2, 198, 2, 'Pago de colegiatura de taller', '2018-02-21', '1', 'test', NULL, '2018-02-17 04:31:40'),
(14, 4, NULL, 2, 159, 1, 'Libros', '2018-02-28', '1', '', NULL, '2018-02-17 04:38:57'),
(15, 4, NULL, 1, 180, 3, 'inscripcion', '2018-02-21', '1', 'test', NULL, NULL),
(16, 11, NULL, 1, 180, 3, 'Incripcio centro cultural apizaco', '2018-02-26', '1', '', NULL, NULL),
(17, 11, NULL, 2, 150, 3, 'Pago de colegiatura de taller', '2018-02-28', '1', '', NULL, '2018-02-26 18:40:59'),
(18, 11, NULL, 2, 150, 3, 'Pago de colegiatura de taller', NULL, '1', '', NULL, '2018-02-26 18:42:10'),
(19, 11, NULL, 2, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 11, NULL, 2, 150, 3, 'Pago de colegiatura de taller', '2018-02-28', '1', '', NULL, '2018-03-01 05:03:30'),
(21, 11, NULL, 1, 180, 1, 'Incripcion taller de guitarra basica', '2018-03-02', '2', 'es joto', NULL, NULL),
(22, 11, 20, 2, 180, 1, 'Febrero', '2018-03-29', '1', '', NULL, '2018-03-02 03:41:29'),
(23, 11, 21, 3, 15, 1, 'Ext Enero', '2018-03-01', '1', '', NULL, '2018-03-02 03:47:15'),
(24, 11, 20, 2, 180, 3, 'Colegiatura Febrero', NULL, '1', '', NULL, '2018-03-02 04:03:07'),
(25, 11, NULL, 1, 180, 2, 'Incripcio centro cultural apizaco', '2018-03-02', '1', '', NULL, NULL),
(26, 11, NULL, 1, 180, 4, 'Incripcio centro cultural apizaco', '2018-03-06', '1', '', NULL, NULL),
(27, 11, 19, 2, 180, 1, 'Enero', '2018-03-21', '1', '', NULL, '2018-03-06 08:18:14'),
(28, 12, NULL, 1, 180, 1, 'Inscripcion', '2018-03-06', '1', '', NULL, NULL),
(29, 12, NULL, 1, 200, 4, 'Inscripcion', '2018-03-06', '1', 'te', NULL, NULL),
(30, 14, NULL, 1, 120, 3, 'Inscripcion', '2018-03-06', '1', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rbac_auth_assignment`
--

CREATE TABLE `tbl_rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
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

CREATE TABLE `tbl_rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
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

CREATE TABLE `tbl_rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tbl_rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
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

CREATE TABLE `tbl_system_db_migration` (
  `version` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
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

CREATE TABLE `tbl_system_log` (
  `id` bigint(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_system_log`
--

INSERT INTO `tbl_system_log` (`id`, `level`, `category`, `log_time`, `prefix`, `message`) VALUES
(1, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520270391.5807, '[backend][/categoria/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(2, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520270404.9925, '[backend][/alumno/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(3, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520304962.5207, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(4, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520304967.1627, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(5, 1, 'yii\\base\\UnknownPropertyException', 1520306755.9309, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\Inscripcion::cuotaTallerImps in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'cuotaTallerImps\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\reporte-anual.php(46): yii\\db\\BaseActiveRecord->__get(\'cuotaTallerImps\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerImpController))\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(415): yii\\base\\View->render(\'reporte-anual\', Array, Object(backend\\controllers\\TallerImpController))\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(454): yii\\base\\Controller->renderPartial(\'reporte-anual\', Array)\n#7 [internal function]: backend\\controllers\\TallerImpController->actionImprimirAnual(\'6\')\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'imprimir-anual\', Array)\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller-imp/impr...\', Array)\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#14 {main}'),
(6, 1, 'yii\\web\\HeadersAlreadySentException', 1520306866.6283, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(7, 1, 'yii\\web\\HeadersAlreadySentException', 1520307128.2513, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(8, 1, 'yii\\web\\HeadersAlreadySentException', 1520307236.2125, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(9, 1, 'yii\\web\\HeadersAlreadySentException', 1520307333.181, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(10, 1, 'yii\\web\\HeadersAlreadySentException', 1520307404.4131, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(11, 1, 'yii\\web\\HeadersAlreadySentException', 1520308043.5197, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(12, 1, 'yii\\web\\HeadersAlreadySentException', 1520308128.4615, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(13, 1, 'yii\\base\\ErrorException:64', 1520308522.9674, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\base\\ErrorException: Cannot use [] for reading in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\reporte-anual.php:65\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(415): yii\\base\\View->render()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(454): yii\\base\\Controller->renderPartial()\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): backend\\controllers\\TallerImpController->actionImprimirAnual()\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): ::call_user_func_array:{C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php:57}()\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams()\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction()\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction()\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#10 {main}'),
(14, 1, 'yii\\web\\HeadersAlreadySentException', 1520308543.0735, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(15, 1, 'yii\\web\\HeadersAlreadySentException', 1520308706.8789, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(16, 1, 'yii\\web\\HeadersAlreadySentException', 1520308783.6453, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(17, 1, 'yii\\web\\HeadersAlreadySentException', 1520308953.5368, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(18, 1, 'yii\\web\\HeadersAlreadySentException', 1520308997.9843, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(19, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309227.0869, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(20, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309231.3462, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(21, 1, 'yii\\web\\HeadersAlreadySentException', 1520309260.4448, '[backend][/taller-imp/imprimir-anual?id=6&_pjax=%23w8-pjax]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(22, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309358.0084, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(23, 1, 'yii\\web\\HeadersAlreadySentException', 1520309372.7723, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(24, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309387.5671, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(25, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309519.8577, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(26, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309555.8337, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(27, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309606.7555, '[backend][/alumno/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(28, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309614.427, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(29, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520309617.5681, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(30, 1, 'yii\\web\\HeadersAlreadySentException', 1520309726.3544, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(31, 1, 'yii\\web\\HeadersAlreadySentException', 1520309920.0166, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(32, 1, 'yii\\web\\HeadersAlreadySentException', 1520309989.9906, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(33, 1, 'yii\\web\\HeadersAlreadySentException', 1520310018.9393, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(34, 1, 'yii\\web\\HeadersAlreadySentException', 1520310072.5753, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(35, 1, 'yii\\web\\HeadersAlreadySentException', 1520310119.1317, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(36, 1, 'yii\\web\\HeadersAlreadySentException', 1520310148.2964, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(37, 1, 'yii\\web\\HeadersAlreadySentException', 1520310183.9344, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(38, 1, 'yii\\web\\HeadersAlreadySentException', 1520310702.5837, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(39, 1, 'yii\\web\\HeadersAlreadySentException', 1520310799.7612, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(40, 1, 'yii\\web\\HeadersAlreadySentException', 1520310900.0649, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(41, 1, 'yii\\web\\HeadersAlreadySentException', 1520311021.5882, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(42, 1, 'yii\\web\\HeadersAlreadySentException', 1520311099.8576, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(43, 1, 'yii\\web\\HeadersAlreadySentException', 1520311112.8724, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(44, 1, 'yii\\web\\HeadersAlreadySentException', 1520311135.1967, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(45, 1, 'yii\\web\\HeadersAlreadySentException', 1520311217.6634, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(46, 1, 'yii\\web\\HeadersAlreadySentException', 1520311291.6726, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(47, 1, 'yii\\web\\HeadersAlreadySentException', 1520311343.7386, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(48, 1, 'yii\\web\\HeadersAlreadySentException', 1520311378.0106, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(49, 1, 'yii\\web\\HeadersAlreadySentException', 1520311460.3313, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(50, 1, 'yii\\web\\HeadersAlreadySentException', 1520311511.7312, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(51, 1, 'yii\\web\\HeadersAlreadySentException', 1520311602.431, '[backend][/taller-imp/imprimir-comprobante?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(52, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520311946.8457, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(53, 1, 'yii\\web\\HeadersAlreadySentException', 1520311968.611, '[backend][/taller-imp/imprimir-comprobante?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(54, 1, 'yii\\web\\HeadersAlreadySentException', 1520311985.3089, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(55, 1, 'yii\\web\\HeadersAlreadySentException', 1520312009.3673, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(56, 1, 'yii\\web\\HeadersAlreadySentException', 1520312018.9589, '[backend][/taller-imp/imprimir-comprobante?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(57, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520312095.7883, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(58, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520312269.3842, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(59, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520312333.3799, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(60, 1, 'yii\\web\\HeadersAlreadySentException', 1520312352.1669, '[backend][/taller-imp/imprimir-cole?id=18]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(61, 1, 'yii\\web\\HeadersAlreadySentException', 1520312464.6294, '[backend][/taller-imp/imprimir-cole?id=18]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(62, 1, 'yii\\web\\HeadersAlreadySentException', 1520312542.1408, '[backend][/taller-imp/imprimir-cole?id=18]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(63, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520313044.7645, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(64, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520313084.1608, '[backend][/taller/dashboard?id=8]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(65, 1, 'yii\\base\\UnknownPropertyException', 1520314225.0926, '[backend][/instructor/create]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\Instructor::correo_electronico in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'correo_electron...\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\helpers\\BaseHtml.php(2188): yii\\db\\BaseActiveRecord->__get(\'correo_electron...\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\helpers\\BaseHtml.php(1319): yii\\helpers\\BaseHtml::getAttributeValue(Object(backend\\models\\Instructor), \'correo_electron...\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\helpers\\BaseHtml.php(1373): yii\\helpers\\BaseHtml::activeInput(\'text\', Object(backend\\models\\Instructor), \'correo_electron...\', Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\ActiveField.php(404): yii\\helpers\\BaseHtml::activeTextInput(Object(backend\\models\\Instructor), \'correo_electron...\', Array)\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\instructor\\_form.php(102): yii\\widgets\\ActiveField->textInput(Array)\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, NULL)\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\instructor\\create.php(16): yii\\base\\View->render(\'_form\', Array)\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\InstructorController))\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'create\', Array, Object(backend\\controllers\\InstructorController))\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\InstructorController.php(71): yii\\base\\Controller->render(\'create\', Array)\n#15 [internal function]: backend\\controllers\\InstructorController->actionCreate()\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#17 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#18 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'create\', Array)\n#19 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'instructor/crea...\', Array)\n#20 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#21 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#22 {main}'),
(66, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520314582.1529, '[backend][/instructor/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(67, 1, 'yii\\web\\HeadersAlreadySentException', 1520314621.5772, '[backend][/gridview/export/download]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9437. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(68, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520314664.7406, '[backend][/instructor/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(69, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520320765.768, '[backend][/alumno/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php');
INSERT INTO `tbl_system_log` (`id`, `level`, `category`, `log_time`, `prefix`, `message`) VALUES
(70, 1, 'yii\\web\\HeadersAlreadySentException', 1520320779.496, '[backend][/alumno/imprimir-comprobante?id=1]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(71, 1, 'yii\\web\\HeadersAlreadySentException', 1520321345.3532, '[backend][/alumno/imprimir-comprobante?id=1]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(72, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520322351.7263, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(73, 1, 'yii\\base\\UnknownPropertyException', 1520322357.7635, '[backend][/taller-imp/dashboard?id=11]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\TallerImp::categoria in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'categoria\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\dashboard.php(95): yii\\db\\BaseActiveRecord->__get(\'categoria\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerImpController))\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerImpController))\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(92): yii\\base\\Controller->render(\'dashboard\', Array)\n#7 [internal function]: backend\\controllers\\TallerImpController->actionDashboard(\'11\')\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller-imp/dash...\', Array)\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#14 {main}'),
(74, 1, 'yii\\base\\UnknownPropertyException', 1520322473.9751, '[backend][/taller-imp/dashboard?id=11]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\TallerImp::aula in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'aula\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\dashboard.php(102): yii\\db\\BaseActiveRecord->__get(\'aula\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerImpController))\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerImpController))\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(92): yii\\base\\Controller->render(\'dashboard\', Array)\n#7 [internal function]: backend\\controllers\\TallerImpController->actionDashboard(\'11\')\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller-imp/dash...\', Array)\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#14 {main}'),
(75, 1, 'yii\\base\\UnknownPropertyException', 1520322501.2294, '[backend][/taller-imp/dashboard?id=11]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\TallerImp::numero_personas in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'numero_personas\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\dashboard.php(104): yii\\db\\BaseActiveRecord->__get(\'numero_personas\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerImpController))\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerImpController))\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(92): yii\\base\\Controller->render(\'dashboard\', Array)\n#7 [internal function]: backend\\controllers\\TallerImpController->actionDashboard(\'11\')\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller-imp/dash...\', Array)\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#14 {main}'),
(76, 1, 'yii\\base\\UnknownPropertyException', 1520322540.167, '[backend][/taller-imp/dashboard?id=11]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\TallerImp::fecha_creacion in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'fecha_creacion\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\dashboard.php(141): yii\\db\\BaseActiveRecord->__get(\'fecha_creacion\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerImpController))\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerImpController))\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(92): yii\\base\\Controller->render(\'dashboard\', Array)\n#7 [internal function]: backend\\controllers\\TallerImpController->actionDashboard(\'11\')\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller-imp/dash...\', Array)\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#14 {main}'),
(77, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520322577.9045, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(78, 1, 'yii\\web\\HeadersAlreadySentException', 1520324050.0418, '[backend][/taller-imp/imprimir-anual?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(79, 1, 'yii\\web\\HeadersAlreadySentException', 1520324100.0907, '[backend][/taller-imp/imprimir-comprobante?id=6]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(80, 1, 'yii\\web\\HeadersAlreadySentException', 1520324172.1844, '[backend][/taller-imp/imprimir-cole?id=16]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(81, 1, 'yii\\web\\HeadersAlreadySentException', 1520324321.6059, '[backend][/taller-imp/imprimir-cole?id=27]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(82, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324337.7725, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(83, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324461.4193, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(84, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324480.155, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D%5B%5D=1&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(85, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324536.7087, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(86, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324556.0059, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D%5B%5D=4&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(87, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324579.2655, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(88, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324598.1104, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=10&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(89, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324602.416, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=9&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(90, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324607.018, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=6&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(91, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324610.7308, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(92, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324671.1965, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-03-01%20a%202018-04-14&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(93, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324688.6685, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(94, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324732.7038, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-01-01%20a%202018-03-30&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(95, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324755.1875, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D%5B%5D=2&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-01-01%20a%202018-03-30&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(96, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324761.5367, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-01-01%20a%202018-03-30&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(97, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324766.7471, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D%5B%5D=5&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-01-01%20a%202018-03-30&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(98, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324790.0565, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=9&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D%5B%5D=5&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-01-01%20a%202018-03-30&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(99, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324796.5617, '[backend][/pago-taller-cuota/index?PagoTallerCuotaSearch%5Bid%5D=&PagoTallerCuotaSearch%5Bid_taller_imp%5D=4&PagoTallerCuotaSearch%5Bid_cuota%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D=&PagoTallerCuotaSearch%5Bid_instructor%5D%5B%5D=5&PagoTallerCuotaSearch%5Bmonto%5D=&PagoTallerCuotaSearch%5Bconcepto%5D=&PagoTallerCuotaSearch%5Bfecha_pago%5D=2018-01-01%20a%202018-03-30&PagoTallerCuotaSearch%5Bid_alumno%5D=&_pjax=%23w0-pjax]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(100, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324988.2789, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(101, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520324992.3671, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(102, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325104.1941, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(103, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325115.7537, '[backend][/taller-imp/dashboard?id=11]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(104, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325164.379, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(105, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325203.1324, '[backend][/instructor/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(106, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325232.7015, '[backend][/instructor/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(107, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325240.5191, '[backend][/alumno/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(108, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520325261.8941, '[backend][/alumno/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(109, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359434.1799, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(110, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359645.4529, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(111, 1, 'yii\\base\\ErrorException:8', 1520359645.948, '[backend][/taller/dashboard?id=5]', 'yii\\base\\ErrorException: Use of undefined constant currentUrl - assumed \'currentUrl\' in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\layouts\\common.php:72\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\ContentDecorator.php(79): yii\\base\\View->renderFile()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Widget.php(109): yii\\widgets\\ContentDecorator->run()\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(509): yii\\base\\Widget::end()\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\layouts\\main.php(12): yii\\base\\View->endContent()\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): yii\\base\\View->unknown()\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile()\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(399): yii\\base\\View->renderFile()\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(385): yii\\base\\Controller->renderContent()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerController.php(130): yii\\base\\Controller->render()\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): backend\\controllers\\TallerController->actionDashboard()\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): ::call_user_func_array:{C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php:57}()\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams()\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction()\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction()\n#15 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest()\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#17 {main}'),
(112, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359659.7338, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(113, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359674.8466, '[backend][/taller/dashboard?id=2]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(114, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359682.17, '[backend][/taller/dashboard?id=1]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(115, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359694.6588, '[backend][/taller-imp/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(116, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359780.9467, '[backend][/taller/dashboard?id=1]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(117, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359852.5668, '[backend][/taller/dashboard?id=1]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(118, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520359865.3475, '[backend][/taller-imp/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(119, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360157.6972, '[backend][/taller-imp/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(120, 1, 'yii\\base\\ErrorException:2', 1520360158.3703, '[backend][/taller-imp/dashboard?id=9]', 'yii\\base\\ErrorException: strpos() expects at least 2 parameters, 1 given in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\layouts\\common.php:74\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): yii\\base\\View->unknown()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'???\', \'???\')\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\ContentDecorator.php(79): yii\\base\\View->renderFile(\'???\', \'???\', \'???\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Widget.php(109): yii\\widgets\\ContentDecorator->run()\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(509): yii\\base\\Widget::end()\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\layouts\\main.php(12): yii\\base\\View->endContent()\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): yii\\base\\View->unknown()\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'???\', \'???\')\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(399): yii\\base\\View->renderFile(\'???\', \'???\', \'???\')\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(385): yii\\base\\Controller->renderContent(\'???\')\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(92): yii\\base\\Controller->render(\'???\', \'???\')\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): backend\\controllers\\TallerImpController->actionDashboard(\'???\')\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): ::call_user_func_array:{C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php:57}(\'???\', \'???\')\n#13 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(\'???\')\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'???\', \'???\')\n#15 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'???\', \'???\')\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(\'???\')\n#17 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#18 {main}'),
(121, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360171.519, '[backend][/taller-imp/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(122, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360346.296, '[backend][/taller-imp/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(123, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360363.481, '[backend][/taller-imp/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(124, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360440.7174, '[backend][/taller/dashboard?id=3]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(125, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360461.1686, '[backend][/taller-imp/dashboard?id=6]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(126, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360549.8247, '[backend][/taller/dashboard?id=3]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(127, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360822.8243, '[backend][/taller-imp/dashboard?id=6]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(128, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520360962.3003, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(129, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520361497.2789, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(130, 1, 'yii\\base\\UnknownPropertyException', 1520361497.4529, '[backend][/taller/dashboard?id=5]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\CuotaTaller::idCuota in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'idCuota\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller\\dashboard.php(190): yii\\db\\BaseActiveRecord->__get(\'idCuota\')\n#2 [internal function]: yii\\base\\View->{closure}(Object(backend\\models\\CuotaTaller), 19, 0, Object(kartik\\grid\\DataColumn))\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\Column.php(165): call_user_func(Object(Closure), Object(backend\\models\\CuotaTaller), 19, 0, Object(kartik\\grid\\DataColumn))\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\DataColumn.php(247): yii\\grid\\Column->renderDataCellContent(Object(backend\\models\\CuotaTaller), 19, 0)\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\DataColumn.php(354): yii\\grid\\DataColumn->renderDataCellContent(Object(backend\\models\\CuotaTaller), 19, 0)\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(519): kartik\\grid\\DataColumn->renderDataCell(Object(backend\\models\\CuotaTaller), 19, 0)\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(488): yii\\grid\\GridView->renderTableRow(Object(backend\\models\\CuotaTaller), 19, 0)\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1054): yii\\grid\\GridView->renderTableBody()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(352): kartik\\grid\\GridView->renderTableBody()\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(160): yii\\grid\\GridView->renderItems()\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(321): yii\\widgets\\BaseListView->renderSection(\'{items}\')\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(135): yii\\grid\\GridView->renderSection(\'{items}\')\n#13 [internal function]: yii\\widgets\\BaseListView->yii\\widgets\\{closure}(Array)\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(138): preg_replace_callback(\'/{\\\\w+}/\', Object(Closure), \'<div class="pan...\')\n#15 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(296): yii\\widgets\\BaseListView->run()\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1025): yii\\grid\\GridView->run()\n#17 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Widget.php(140): kartik\\grid\\GridView->run()\n#18 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller\\dashboard.php(267): yii\\base\\Widget::widget(Array)\n#19 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#20 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#21 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerController))\n#22 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerController))\n#23 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerController.php(130): yii\\base\\Controller->render(\'dashboard\', Array)\n#24 [internal function]: backend\\controllers\\TallerController->actionDashboard(\'5\')\n#25 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#26 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#27 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#28 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller/dashboar...\', Array)\n#29 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#30 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#31 {main}'),
(131, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520361534.692, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(132, 1, 'yii\\base\\UnknownPropertyException', 1520361534.873, '[backend][/taller/dashboard?id=5]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\CuotaTaller::idCuota in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'idCuota\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller\\dashboard.php(190): yii\\db\\BaseActiveRecord->__get(\'idCuota\')\n#2 [internal function]: yii\\base\\View->{closure}(Object(backend\\models\\CuotaTaller), 19, 0, Object(kartik\\grid\\DataColumn))\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\Column.php(165): call_user_func(Object(Closure), Object(backend\\models\\CuotaTaller), 19, 0, Object(kartik\\grid\\DataColumn))\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\DataColumn.php(247): yii\\grid\\Column->renderDataCellContent(Object(backend\\models\\CuotaTaller), 19, 0)\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\DataColumn.php(354): yii\\grid\\DataColumn->renderDataCellContent(Object(backend\\models\\CuotaTaller), 19, 0)\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(519): kartik\\grid\\DataColumn->renderDataCell(Object(backend\\models\\CuotaTaller), 19, 0)\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(488): yii\\grid\\GridView->renderTableRow(Object(backend\\models\\CuotaTaller), 19, 0)\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1054): yii\\grid\\GridView->renderTableBody()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(352): kartik\\grid\\GridView->renderTableBody()\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(160): yii\\grid\\GridView->renderItems()\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(321): yii\\widgets\\BaseListView->renderSection(\'{items}\')\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(135): yii\\grid\\GridView->renderSection(\'{items}\')\n#13 [internal function]: yii\\widgets\\BaseListView->yii\\widgets\\{closure}(Array)\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(138): preg_replace_callback(\'/{\\\\w+}/\', Object(Closure), \'<div class="pan...\')\n#15 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(296): yii\\widgets\\BaseListView->run()\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1025): yii\\grid\\GridView->run()\n#17 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Widget.php(140): kartik\\grid\\GridView->run()\n#18 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller\\dashboard.php(267): yii\\base\\Widget::widget(Array)\n#19 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#20 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#21 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerController))\n#22 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerController))\n#23 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerController.php(130): yii\\base\\Controller->render(\'dashboard\', Array)\n#24 [internal function]: backend\\controllers\\TallerController->actionDashboard(\'5\')\n#25 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#26 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#27 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#28 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller/dashboar...\', Array)\n#29 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#30 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#31 {main}'),
(133, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520361550.1999, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php');
INSERT INTO `tbl_system_log` (`id`, `level`, `category`, `log_time`, `prefix`, `message`) VALUES
(134, 1, 'yii\\base\\UnknownPropertyException', 1520361550.3799, '[backend][/taller/dashboard?id=5]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\CuotaTaller::idCuota in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'idCuota\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller\\dashboard.php(190): yii\\db\\BaseActiveRecord->__get(\'idCuota\')\n#2 [internal function]: yii\\base\\View->{closure}(Object(backend\\models\\CuotaTaller), 19, 0, Object(kartik\\grid\\DataColumn))\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\Column.php(165): call_user_func(Object(Closure), Object(backend\\models\\CuotaTaller), 19, 0, Object(kartik\\grid\\DataColumn))\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\DataColumn.php(247): yii\\grid\\Column->renderDataCellContent(Object(backend\\models\\CuotaTaller), 19, 0)\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\DataColumn.php(354): yii\\grid\\DataColumn->renderDataCellContent(Object(backend\\models\\CuotaTaller), 19, 0)\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(519): kartik\\grid\\DataColumn->renderDataCell(Object(backend\\models\\CuotaTaller), 19, 0)\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(488): yii\\grid\\GridView->renderTableRow(Object(backend\\models\\CuotaTaller), 19, 0)\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1054): yii\\grid\\GridView->renderTableBody()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(352): kartik\\grid\\GridView->renderTableBody()\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(160): yii\\grid\\GridView->renderItems()\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(321): yii\\widgets\\BaseListView->renderSection(\'{items}\')\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(135): yii\\grid\\GridView->renderSection(\'{items}\')\n#13 [internal function]: yii\\widgets\\BaseListView->yii\\widgets\\{closure}(Array)\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(138): preg_replace_callback(\'/{\\\\w+}/\', Object(Closure), \'<div class="pan...\')\n#15 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(296): yii\\widgets\\BaseListView->run()\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1025): yii\\grid\\GridView->run()\n#17 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Widget.php(140): kartik\\grid\\GridView->run()\n#18 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller\\dashboard.php(267): yii\\base\\Widget::widget(Array)\n#19 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#20 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#21 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerController))\n#22 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerController))\n#23 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerController.php(130): yii\\base\\Controller->render(\'dashboard\', Array)\n#24 [internal function]: backend\\controllers\\TallerController->actionDashboard(\'5\')\n#25 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#26 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#27 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#28 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller/dashboar...\', Array)\n#29 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#30 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#31 {main}'),
(135, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520361616.2397, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(136, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520361924.9183, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(137, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520361957.1792, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(138, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520362050.4115, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(139, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520362125.0228, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(140, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520363102.8477, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(141, 1, 'yii\\base\\UnknownPropertyException', 1520363823.7509, '[backend][/taller/implement?id=5]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\CuotaTaller::idCuota in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'idCuota\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerController.php(166): yii\\db\\BaseActiveRecord->__get(\'idCuota\')\n#2 [internal function]: backend\\controllers\\TallerController->actionImplement(\'5\')\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'implement\', Array)\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller/implemen...\', Array)\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#9 {main}'),
(142, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520364027.5236, '[backend][/taller-imp/dashboard?id=13]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(143, 1, 'yii\\base\\UnknownPropertyException', 1520364027.6956, '[backend][/taller-imp/dashboard?id=13]', 'yii\\base\\UnknownPropertyException: Getting unknown property: backend\\models\\CuotaTallerImp::cuota in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Component.php:154\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(295): yii\\base\\Component->__get(\'cuota\')\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\dashboard.php(181): yii\\db\\BaseActiveRecord->__get(\'cuota\')\n#2 [internal function]: yii\\base\\View->{closure}(Object(backend\\models\\CuotaTallerImp), 22, 0, Object(kartik\\grid\\DataColumn))\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\Column.php(165): call_user_func(Object(Closure), Object(backend\\models\\CuotaTallerImp), 22, 0, Object(kartik\\grid\\DataColumn))\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\DataColumn.php(247): yii\\grid\\Column->renderDataCellContent(Object(backend\\models\\CuotaTallerImp), 22, 0)\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\DataColumn.php(354): yii\\grid\\DataColumn->renderDataCellContent(Object(backend\\models\\CuotaTallerImp), 22, 0)\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(519): kartik\\grid\\DataColumn->renderDataCell(Object(backend\\models\\CuotaTallerImp), 22, 0)\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(488): yii\\grid\\GridView->renderTableRow(Object(backend\\models\\CuotaTallerImp), 22, 0)\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1054): yii\\grid\\GridView->renderTableBody()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(352): kartik\\grid\\GridView->renderTableBody()\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(160): yii\\grid\\GridView->renderItems()\n#11 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(321): yii\\widgets\\BaseListView->renderSection(\'{items}\')\n#12 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(135): yii\\grid\\GridView->renderSection(\'{items}\')\n#13 [internal function]: yii\\widgets\\BaseListView->yii\\widgets\\{closure}(Array)\n#14 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\widgets\\BaseListView.php(138): preg_replace_callback(\'/{\\\\w+}/\', Object(Closure), \'<div class="pan...\')\n#15 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\grid\\GridView.php(296): yii\\widgets\\BaseListView->run()\n#16 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\kartik-v\\yii2-grid\\GridView.php(1025): yii\\grid\\GridView->run()\n#17 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Widget.php(140): kartik\\grid\\GridView->run()\n#18 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\dashboard.php(262): yii\\base\\Widget::widget(Array)\n#19 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(336): require(\'C:\\\\Users\\\\CONSUL...\')\n#20 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile(\'C:\\\\Users\\\\CONSUL...\', Array)\n#21 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile(\'C:\\\\Users\\\\CONSUL...\', Array, Object(backend\\controllers\\TallerImpController))\n#22 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(384): yii\\base\\View->render(\'dashboard\', Array, Object(backend\\controllers\\TallerImpController))\n#23 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(92): yii\\base\\Controller->render(\'dashboard\', Array)\n#24 [internal function]: backend\\controllers\\TallerImpController->actionDashboard(\'13\')\n#25 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#26 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams(Array)\n#27 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction(\'dashboard\', Array)\n#28 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction(\'taller-imp/dash...\', Array)\n#29 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#30 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#31 {main}'),
(144, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520364085.8429, '[backend][/taller-imp/dashboard?id=13]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(145, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365135.827, '[backend][/taller/dashboard?id=8]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(146, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365141.9643, '[backend][/taller/dashboard?id=1]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(147, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365146.2716, '[backend][/taller-imp/dashboard?id=4]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(148, 1, 'yii\\web\\HeadersAlreadySentException', 1520365164.8446, '[backend][/taller-imp/imprimir-cole?id=1]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(149, 1, 'yii\\web\\HeadersAlreadySentException', 1520365172.7031, '[backend][/taller-imp/imprimir-anual?id=3]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(150, 1, 'yii\\base\\ErrorException:8', 1520365173.2441, '[backend][/taller-imp/imprimir-comprobante?id=4]', 'yii\\base\\ErrorException: Trying to get property of non-object in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\views\\taller-imp\\reporte-inscripcion.php:114\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(254): yii\\base\\View->renderPhpFile()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\View.php(156): yii\\base\\View->renderFile()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(415): yii\\base\\View->render()\n#3 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\controllers\\TallerImpController.php(255): yii\\base\\Controller->renderPartial()\n#4 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): backend\\controllers\\TallerImpController->actionImprimirComprobante()\n#5 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): ::call_user_func_array:{C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\InlineAction.php:57}()\n#6 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams()\n#7 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Module.php(528): yii\\base\\Controller->runAction()\n#8 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\base\\Module->runAction()\n#9 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest()\n#10 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#11 {main}'),
(151, 1, 'yii\\web\\HeadersAlreadySentException', 1520365224.5311, '[backend][/taller-imp/imprimir-comprobante?id=5]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(152, 1, 'yii\\web\\HeadersAlreadySentException', 1520365266.7605, '[backend][/taller-imp/imprimir-cole?id=1]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(153, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365290.7278, '[backend][/alumno/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(154, 1, 'yii\\web\\HeadersAlreadySentException', 1520365304.7846, '[backend][/alumno/imprimir-comprobante?id=1]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(155, 1, 'yii\\web\\HeadersAlreadySentException', 1520365312.3151, '[backend][/alumno/imprimir-credencial?id=1]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(156, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365321.2156, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(157, 1, 'yii\\web\\HeadersAlreadySentException', 1520365333.3473, '[backend][/taller/imprimir-info?id=5]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(158, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365381.355, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(159, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365387.7524, '[backend][/taller/dashboard?id=5]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(160, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365396.7119, '[backend][/taller-imp/dashboard?id=12]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(161, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365415.262, '[backend][/taller-imp/dashboard?id=12]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(162, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365440.0694, '[backend][/taller-imp/dashboard?id=12]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(163, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365611.8642, '[backend][/taller-imp/dashboard?id=12]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(164, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520365633.1954, '[backend][/taller-imp/dashboard?id=12]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(165, 1, 'yii\\web\\HeadersAlreadySentException', 1520365654.8227, '[backend][/taller-imp/imprimir-comprobante?id=11]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(166, 1, 'yii\\web\\HeadersAlreadySentException', 1520365661.9011, '[backend][/taller-imp/imprimir-anual?id=11]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(167, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520366359.887, '[backend][/taller/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(168, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520366389.6937, '[backend][/taller/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(169, 1, 'yii\\web\\HeadersAlreadySentException', 1520366401.2824, '[backend][/taller/imprimir-info?id=9]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(170, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520366420.1234, '[backend][/taller-imp/dashboard?id=14]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(171, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520366492.3706, '[backend][/taller-imp/dashboard?id=14]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(172, 1, 'yii\\web\\HeadersAlreadySentException', 1520366508.4825, '[backend][/taller-imp/imprimir-anual?id=12]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(173, 1, 'yii\\web\\HeadersAlreadySentException', 1520366517.932, '[backend][/taller-imp/imprimir-comprobante?id=12]', 'yii\\web\\HeadersAlreadySentException: Headers already sent in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\mpdf\\mpdf\\mpdf.php on line 9416. in C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php:366\nStack trace:\n#0 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\web\\Response.php(339): yii\\web\\Response->sendHeaders()\n#1 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\vendor\\yiisoft\\yii2\\base\\Application.php(392): yii\\web\\Response->send()\n#2 C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\backend\\web\\index.php(23): yii\\base\\Application->run()\n#3 {main}'),
(174, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520366548.3788, '[backend][/taller/dashboard?id=9]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php'),
(175, 2, 'yii\\i18n\\PhpMessageSource::loadMessages', 1520366566.1888, '[backend][/pago-taller-cuota/index]', 'The message file for category \'kvgrid\' does not exist: C:\\Users\\CONSULTOR\\git\\centroculturalapizaco.gob.mx\\common/messages/es/kvgrid.php');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_rbac_migration`
--

CREATE TABLE `tbl_system_rbac_migration` (
  `version` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
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
-- Table structure for table `tbl_taller`
--

CREATE TABLE `tbl_taller` (
  `id` int(11) NOT NULL,
  `id_instructor` int(11) DEFAULT NULL,
  `id_aula` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_temario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_personas` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen_url` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `temario_url` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `duracion_mes` int(11) DEFAULT NULL,
  `duracion_hora` int(11) DEFAULT NULL,
  `lunes` tinyint(4) DEFAULT NULL,
  `martes` tinyint(4) DEFAULT NULL,
  `miercoles` tinyint(4) DEFAULT NULL,
  `jueves` tinyint(4) DEFAULT NULL,
  `viernes` tinyint(4) DEFAULT NULL,
  `sabado` tinyint(4) DEFAULT NULL,
  `domingo` tinyint(4) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `base_url` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `path` varchar(300) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Talleres que seran imaprtidos en el centro cultural';

--
-- Dumping data for table `tbl_taller`
--

INSERT INTO `tbl_taller` (`id`, `id_instructor`, `id_aula`, `nombre`, `descripcion`, `descripcion_temario`, `numero_personas`, `imagen_url`, `temario_url`, `fecha_creacion`, `creado_por`, `duracion_mes`, `duracion_hora`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`, `hora_inicio`, `disponible`, `id_categoria`, `base_url`, `path`) VALUES
(1, 2, 1, 'Piano basico', 'Piano orientado a niños', '', '', 'http://storage.centroculturalapizaco.local/source/1/-pZrdG_nUtOxeDu4WlLZblF2UQUHPkeo.jpg', '', NULL, NULL, 12, 2, 1, 1, 1, 0, 1, 0, 1, '13:00:00', 1, 2, 'http://storage.centroculturalapizaco.local/source', '1/LCBJZrDB8vEAdKIx7EuElHPG0w9ord8i.jpg'),
(2, NULL, NULL, 'Danza folklor', 'Danza para niñas', '', '', '', '', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 2, NULL, '1/Im-c7L3gYOF0LiutXPeP5biowDuqSKk7.png'),
(3, 4, 1, 'Ajedrez basico', 'ajedrez', '', '', 'http://storage.centroculturalapizaco.local/source/1/_CkUnhdLrUrd81dVzx3nD5xAI_8VlTE_.jpg', '', NULL, NULL, 2, NULL, 1, 1, 1, 0, 0, 0, 0, NULL, 1, 4, 'http://storage.centroculturalapizaco.local/source', '1/DZx1chsr1lXst8YySp0DnVd2fi4Ca8kg.jpg'),
(4, NULL, 1, 'Piano Intermedio', 'piano intermedio para ninos ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 4, 1, 'Guitarra basica', 'guitarra', '', '12', NULL, '', NULL, NULL, 2, NULL, 0, 1, 0, 1, 0, 0, 0, NULL, 1, 1, NULL, '1/ROYhYKu9T8mYjisMv87M2HCtIGLw7PXV.jpg'),
(8, NULL, NULL, 'Piano', 'test', NULL, NULL, NULL, NULL, '2018-03-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL),
(9, 2, 1, 'Musica africana', 'Musica', '', '', NULL, '', '2018-03-06 00:00:00', NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, NULL, '1/gpygOcUD1YEPQ4xRwoevhgpFxZz0uIDl.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taller_imp`
--

CREATE TABLE `tbl_taller_imp` (
  `id` int(11) NOT NULL,
  `id_curso_base` int(11) DEFAULT NULL,
  `id_instructor` int(11) DEFAULT NULL,
  `clave_unica_curso` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_max_personas` int(11) DEFAULT NULL,
  `comentarios` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_img_publicitaria` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lunes` time DEFAULT NULL,
  `martes` time DEFAULT NULL,
  `miercoles` time DEFAULT NULL,
  `jueves` time DEFAULT NULL,
  `viernes` time DEFAULT NULL,
  `sabado` time DEFAULT NULL,
  `domingo` time DEFAULT NULL,
  `duracion_hora` int(11) DEFAULT NULL,
  `lunes_fin` time DEFAULT NULL,
  `martes_fin` time DEFAULT NULL,
  `miercoles_fin` time DEFAULT NULL,
  `jueves_fin` time DEFAULT NULL,
  `viernes_fin` time DEFAULT NULL,
  `sabado_fin` time DEFAULT NULL,
  `domingo_fin` time DEFAULT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  `duracion_mes` int(11) DEFAULT NULL,
  `disponible` tinyint(4) DEFAULT NULL,
  `id_aula_lunes` int(11) DEFAULT NULL,
  `id_aula_martes` int(11) DEFAULT NULL,
  `id_aula_miercoles` int(11) DEFAULT NULL,
  `id_aula_jueves` int(11) DEFAULT NULL,
  `id_aula_viernes` int(11) DEFAULT NULL,
  `id_aula_sabado` int(11) DEFAULT NULL,
  `id_aula_domingo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tbl_taller_imp`
--

INSERT INTO `tbl_taller_imp` (`id`, `id_curso_base`, `id_instructor`, `clave_unica_curso`, `nombre`, `fecha_inicio`, `fecha_fin`, `descripcion`, `numero_max_personas`, `comentarios`, `url_img_publicitaria`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`, `duracion_hora`, `lunes_fin`, `martes_fin`, `miercoles_fin`, `jueves_fin`, `viernes_fin`, `sabado_fin`, `domingo_fin`, `estatus`, `duracion_mes`, `disponible`, `id_aula_lunes`, `id_aula_martes`, `id_aula_miercoles`, `id_aula_jueves`, `id_aula_viernes`, `id_aula_sabado`, `id_aula_domingo`) VALUES
(4, 1, 2, '', 'Piano basico', '2017-12-29', '2017-12-29', 'Piano orientado a niños', NULL, '', '', '13:00:00', NULL, '13:00:00', NULL, '13:00:00', NULL, NULL, NULL, '00:00:12', NULL, '00:00:12', NULL, '00:00:12', NULL, NULL, 2, NULL, 1, 1, 1, 1, 1, 1, 1, 1),
(6, 3, 2, '', 'Ajedrez basico sabatino', '2018-01-30', '2018-03-30', 'ajedrez', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:12', '00:00:12', '00:00:12', NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, 4, '', 'Ajedrez basico', '2017-12-30', '2017-12-30', 'ajedrez', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00:00:12', '00:00:12', '00:00:12', NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 3, NULL, 'Piano tardes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 2, NULL, 'Piano basico vespertino', '2018-02-26', '2018-04-30', 'Piano orientado a niños', NULL, NULL, NULL, '21:45:00', '22:45:00', '20:00:00', NULL, NULL, NULL, NULL, NULL, '00:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1),
(11, 5, 4, NULL, 'Guitarra basica verano', '2018-02-26', '2018-02-28', 'guitarra', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1),
(12, 5, 4, NULL, 'Guitarra basica', '2018-03-06', '2018-03-31', 'guitarra', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1),
(13, 5, 4, NULL, 'Guitarra basica', '2018-03-06', '2018-03-31', 'guitarra', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1),
(14, 9, 2, NULL, 'Musica africana 1', '2018-03-06', '2018-03-31', 'Musica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeline_event`
--

CREATE TABLE `tbl_timeline_event` (
  `id` int(11) NOT NULL,
  `application` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `event` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_timeline_event`
--

INSERT INTO `tbl_timeline_event` (`id`, `application`, `category`, `event`, `data`, `created_at`) VALUES
(1, 'frontend', 'user', 'signup', '{"public_identity":"webmaster","user_id":1,"created_at":1512840788}', 1512840788),
(2, 'frontend', 'user', 'signup', '{"public_identity":"manager","user_id":2,"created_at":1512840788}', 1512840788),
(3, 'frontend', 'user', 'signup', '{"public_identity":"user","user_id":3,"created_at":1512840788}', 1512840788);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
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
  `logged_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `auth_key`, `access_token`, `password_hash`, `oauth_client`, `oauth_client_user_id`, `email`, `status`, `created_at`, `updated_at`, `logged_at`) VALUES
(1, 'webmaster', '9S0gVgMLM4071jF8KCCx6s_7-uncmI59', 'bGzjCWarbQzpUzXpfzQLXbOHKlHrwAVulyD9BeJ8', '$2y$13$QaJUckpnCQRG4GzLIgNKL.rB.Grq/yBRiwr.ESxJ56Ba4kFeS4EhC', NULL, NULL, 'webmaster@example.com', 2, 1512840789, 1512840789, 1520358843),
(2, 'manager', 'GKic_2mdKe1_WTi2J7Zl_5oEcpgJ3N9S', 'ZWciGNBeOhvO4ewufpXeZYf-M02bXHsd41dFpH6d', '$2y$13$AJIrzdz4.vKgNSrWxMwP0OtJ2F13mYFwtLagMbMftsFD1QcQuBSFS', NULL, NULL, 'manager@example.com', 2, 1512840789, 1512840789, NULL),
(3, 'user', 'it9zfuDGAMko1scgkxG71-D03QjdfcJe', 'MhLNgjAUZWJCB8HdYbjOzgf1MvHDu-cge6eT05as', '$2y$13$XdDSENVS0CykDjnVSGoj9exMRlRPInIni70cIllig5EVmRWfWpOtC', NULL, NULL, 'user@example.com', 2, 1512840790, 1520195888, 1520195848);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profile`
--

CREATE TABLE `tbl_user_profile` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_profile`
--

INSERT INTO `tbl_user_profile` (`user_id`, `firstname`, `middlename`, `lastname`, `avatar_path`, `avatar_base_url`, `locale`, `gender`) VALUES
(1, 'Centro', 'Cultural', 'Apizaco', '1/bixGQLyByxthg0f6zQqV7rHvqEH2I1si.jpg', 'http://storage.centroculturalapizaco.local/source', 'es', 1),
(2, NULL, NULL, NULL, NULL, NULL, 'en-US', NULL),
(3, 'Maria', 'Angelica', 'Hernandez', NULL, NULL, 'es', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_token`
--

CREATE TABLE `tbl_user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_carousel`
--

CREATE TABLE `tbl_widget_carousel` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_carousel`
--

INSERT INTO `tbl_widget_carousel` (`id`, `key`, `status`) VALUES
(1, 'index', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_carousel_item`
--

CREATE TABLE `tbl_widget_carousel_item` (
  `id` int(11) NOT NULL,
  `carousel_id` int(11) NOT NULL,
  `base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_carousel_item`
--

INSERT INTO `tbl_widget_carousel_item` (`id`, `carousel_id`, `base_url`, `path`, `type`, `url`, `caption`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://storage.centroculturalapizaco.local/source', '1/bluN7TJS4msWMLRLFo94tk80UjBh36Wv.jpg', 'image/jpeg', '/', '<p>Hey you lucky bastard<br></p>', 1, 0, NULL, 1512847031);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_menu`
--

CREATE TABLE `tbl_widget_menu` (
  `id` int(11) NOT NULL,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_menu`
--

INSERT INTO `tbl_widget_menu` (`id`, `key`, `title`, `items`, `status`) VALUES
(1, 'frontend-index', 'Frontend index menu', '[\n    {\n        "label": "Get started with Yii2",\n        "url": "http://www.yiiframework.com",\n        "options": {\n            "tag": "span"\n        },\n        "template": "<a href=\\"{url}\\" class=\\"btn btn-lg btn-success\\">{label}</a>"\n    },\n    {\n        "label": "Yii2 Starter Kit on GitHub",\n        "url": "https://github.com/trntv/yii2-starter-kit",\n        "options": {\n            "tag": "span"\n        },\n        "template": "<a href=\\"{url}\\" class=\\"btn btn-lg btn-primary\\">{label}</a>"\n    },\n    {\n        "label": "Find a bug?",\n        "url": "https://github.com/trntv/yii2-starter-kit/issues",\n        "options": {\n            "tag": "span"\n        },\n        "template": "<a href=\\"{url}\\" class=\\"btn btn-lg btn-danger\\">{label}</a>"\n    }\n]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget_text`
--

CREATE TABLE `tbl_widget_text` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_widget_text`
--

INSERT INTO `tbl_widget_text` (`id`, `key`, `title`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'backend_welcome', 'Welcome to backend', '<p>Welcome to Yii2 Starter Kit Dashboard</p>', 1, 1512840790, 1512840790),
(2, 'ads-example', 'Google Ads Example Block', '<div class="lead">\r\n                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n                <ins class="adsbygoogle"\r\n                     style="display:block"\r\n                     data-ad-client="ca-pub-9505937224921657"\r\n                     data-ad-slot="2264361777"\r\n                     data-ad-format="auto"></ins>\r\n                <script>\r\n                (adsbygoogle = window.adsbygoogle || []).push({});\r\n                </script>\r\n            </div>', 0, 1512840790, 1512840790);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alumno`
--
ALTER TABLE `tbl_alumno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_author` (`created_by`),
  ADD KEY `fk_article_updater` (`updated_by`),
  ADD KEY `fk_article_category` (`category_id`);

--
-- Indexes for table `tbl_article_attachment`
--
ALTER TABLE `tbl_article_attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_attachment_article` (`article_id`);

--
-- Indexes for table `tbl_article_category`
--
ALTER TABLE `tbl_article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_category_section` (`parent_id`);

--
-- Indexes for table `tbl_aula`
--
ALTER TABLE `tbl_aula`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cuota`
--
ALTER TABLE `tbl_cuota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cuota_taller`
--
ALTER TABLE `tbl_cuota_taller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cuota_cuota_taller_idx` (`id_cuota`),
  ADD KEY `fk_taller_cuota_taller_idx` (`id_taller`);

--
-- Indexes for table `tbl_cuota_taller_imp`
--
ALTER TABLE `tbl_cuota_taller_imp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cuota_cuota_taller_imp_idx` (`id_cuota`),
  ADD KEY `fk_taller_imp_cuota_taller_imp_idx` (`id_taller_imp`);

--
-- Indexes for table `tbl_file_storage_item`
--
ALTER TABLE `tbl_file_storage_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_i18n_message`
--
ALTER TABLE `tbl_i18n_message`
  ADD PRIMARY KEY (`id`,`language`);

--
-- Indexes for table `tbl_i18n_source_message`
--
ALTER TABLE `tbl_i18n_source_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inscripcion`
--
ALTER TABLE `tbl_inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pago_UNIQUE` (`id_pago`),
  ADD KEY `inscripcion_alumno_idx` (`id_alumno`),
  ADD KEY `inscripcion_taller_imp_idx` (`id_taller_imp`),
  ADD KEY `inscripcion_pago_idx` (`id_pago`);

--
-- Indexes for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_key_storage_item`
--
ALTER TABLE `tbl_key_storage_item`
  ADD PRIMARY KEY (`key`),
  ADD UNIQUE KEY `idx_key_storage_item_key` (`key`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pago_taller_cuota`
--
ALTER TABLE `tbl_pago_taller_cuota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pago_taller_cuota_cuota_idx` (`id_cuota`),
  ADD KEY `fk_pago_taller_cuota_taller_imp_idx` (`id_taller_imp`),
  ADD KEY `fk_pago_taller_cuota_alumno_idx` (`id_alumno`),
  ADD KEY `fk_pago_taller_cuota_cuota_taller_imp_idx` (`id_cuota_taller_imp`);

--
-- Indexes for table `tbl_rbac_auth_assignment`
--
ALTER TABLE `tbl_rbac_auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `tbl_rbac_auth_item`
--
ALTER TABLE `tbl_rbac_auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `tbl_rbac_auth_item_child`
--
ALTER TABLE `tbl_rbac_auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `tbl_rbac_auth_rule`
--
ALTER TABLE `tbl_rbac_auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `tbl_system_db_migration`
--
ALTER TABLE `tbl_system_db_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_system_log`
--
ALTER TABLE `tbl_system_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_log_level` (`level`),
  ADD KEY `idx_log_category` (`category`);

--
-- Indexes for table `tbl_system_rbac_migration`
--
ALTER TABLE `tbl_system_rbac_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_taller`
--
ALTER TABLE `tbl_taller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_instructor_idx` (`id_instructor`),
  ADD KEY `fk_aulta_taller_idx` (`id_aula`),
  ADD KEY `fk_categoria_idx` (`id_categoria`);

--
-- Indexes for table `tbl_taller_imp`
--
ALTER TABLE `tbl_taller_imp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_taller_taller_imp_idx` (`id_curso_base`),
  ADD KEY `fk_instructor_taller_imp_idx` (`id_instructor`),
  ADD KEY `fk_aula_lunes_taller_imp_idx` (`id_aula_lunes`),
  ADD KEY `fk_aula_martes_taller_imp_idx` (`id_aula_martes`),
  ADD KEY `fk_aula_miercoles_taller_imp_idx` (`id_aula_miercoles`),
  ADD KEY `fk_aula_jueves_taller_imp_idx` (`id_aula_jueves`),
  ADD KEY `fk_aula_viernes_taller_imp_idx` (`id_aula_viernes`),
  ADD KEY `fk_aula_sabado_taller_imp_idx` (`id_aula_sabado`),
  ADD KEY `fk_aula_domingo_taller_imp_idx` (`id_aula_domingo`);

--
-- Indexes for table `tbl_timeline_event`
--
ALTER TABLE `tbl_timeline_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_widget_carousel`
--
ALTER TABLE `tbl_widget_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_widget_carousel_item`
--
ALTER TABLE `tbl_widget_carousel_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_carousel` (`carousel_id`);

--
-- Indexes for table `tbl_widget_menu`
--
ALTER TABLE `tbl_widget_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_widget_text`
--
ALTER TABLE `tbl_widget_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_widget_text_key` (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_alumno`
--
ALTER TABLE `tbl_alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_article`
--
ALTER TABLE `tbl_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_article_attachment`
--
ALTER TABLE `tbl_article_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_article_category`
--
ALTER TABLE `tbl_article_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_aula`
--
ALTER TABLE `tbl_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_cuota`
--
ALTER TABLE `tbl_cuota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_cuota_taller`
--
ALTER TABLE `tbl_cuota_taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_cuota_taller_imp`
--
ALTER TABLE `tbl_cuota_taller_imp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_file_storage_item`
--
ALTER TABLE `tbl_file_storage_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `tbl_i18n_source_message`
--
ALTER TABLE `tbl_i18n_source_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_inscripcion`
--
ALTER TABLE `tbl_inscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_pago_taller_cuota`
--
ALTER TABLE `tbl_pago_taller_cuota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_system_log`
--
ALTER TABLE `tbl_system_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `tbl_taller`
--
ALTER TABLE `tbl_taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_taller_imp`
--
ALTER TABLE `tbl_taller_imp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_timeline_event`
--
ALTER TABLE `tbl_timeline_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_widget_carousel`
--
ALTER TABLE `tbl_widget_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_widget_carousel_item`
--
ALTER TABLE `tbl_widget_carousel_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_widget_menu`
--
ALTER TABLE `tbl_widget_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_widget_text`
--
ALTER TABLE `tbl_widget_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- Constraints for table `tbl_cuota_taller`
--
ALTER TABLE `tbl_cuota_taller`
  ADD CONSTRAINT `fk_cuota_cuota_taller` FOREIGN KEY (`id_cuota`) REFERENCES `tbl_cuota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_taller_cuota_taller` FOREIGN KEY (`id_taller`) REFERENCES `tbl_taller` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_cuota_taller_imp`
--
ALTER TABLE `tbl_cuota_taller_imp`
  ADD CONSTRAINT `fk_cuota_cuota_taller_imp` FOREIGN KEY (`id_cuota`) REFERENCES `tbl_cuota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_taller_imp_cuota_taller_imp` FOREIGN KEY (`id_taller_imp`) REFERENCES `tbl_taller_imp` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_i18n_message`
--
ALTER TABLE `tbl_i18n_message`
  ADD CONSTRAINT `fk_i18n_message_source_message` FOREIGN KEY (`id`) REFERENCES `tbl_i18n_source_message` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_inscripcion`
--
ALTER TABLE `tbl_inscripcion`
  ADD CONSTRAINT `inscripcion_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `tbl_alumno` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `inscripcion_pago` FOREIGN KEY (`id_pago`) REFERENCES `tbl_pago_taller_cuota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `inscripcion_taller_imp` FOREIGN KEY (`id_taller_imp`) REFERENCES `tbl_taller_imp` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_pago_taller_cuota`
--
ALTER TABLE `tbl_pago_taller_cuota`
  ADD CONSTRAINT `fk_pago_taller_cuota_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `tbl_alumno` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_pago_taller_cuota_cuota` FOREIGN KEY (`id_cuota`) REFERENCES `tbl_cuota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_pago_taller_cuota_cuota_taller_imp` FOREIGN KEY (`id_cuota_taller_imp`) REFERENCES `tbl_cuota_taller_imp` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_pago_taller_cuota_taller_imp` FOREIGN KEY (`id_taller_imp`) REFERENCES `tbl_taller_imp` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
-- Constraints for table `tbl_taller`
--
ALTER TABLE `tbl_taller`
  ADD CONSTRAINT `fk_aulta_taller` FOREIGN KEY (`id_aula`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_id_instructor` FOREIGN KEY (`id_instructor`) REFERENCES `tbl_instructor` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_taller_imp`
--
ALTER TABLE `tbl_taller_imp`
  ADD CONSTRAINT `fk_aula_domingo_taller_imp` FOREIGN KEY (`id_aula_domingo`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_aula_jueves_taller_imp` FOREIGN KEY (`id_aula_jueves`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_aula_lunes_taller_imp` FOREIGN KEY (`id_aula_lunes`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_aula_martes_taller_imp` FOREIGN KEY (`id_aula_martes`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_aula_miercoles_taller_imp` FOREIGN KEY (`id_aula_miercoles`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_aula_sabado_taller_imp` FOREIGN KEY (`id_aula_sabado`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_aula_viernes_taller_imp` FOREIGN KEY (`id_aula_viernes`) REFERENCES `tbl_aula` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_instructor_taller_imp` FOREIGN KEY (`id_instructor`) REFERENCES `tbl_instructor` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_taller_taller_imp` FOREIGN KEY (`id_curso_base`) REFERENCES `tbl_taller` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
