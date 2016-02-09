-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2016 a las 22:06:03
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `garden`
--
CREATE DATABASE garden;
USE garden;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `clave`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'AC01', 'Almacen 1', 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfc` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `agente_id` int(10) unsigned NOT NULL,
  `nivel_descuento_id` int(10) unsigned NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paterno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `materno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cliente_usuario_id_foreign` (`usuario_id`),
  KEY `cliente_nivel_descuento_id_foreign` (`nivel_descuento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `rfc`, `usuario_id`, `agente_id`, `nivel_descuento_id`, `nombre_cliente`, `paterno`, `materno`, `nombre_comercial`, `razon_social`, `numero_cliente`, `created_at`, `updated_at`) VALUES
(6, 'ngfdnhfg', 3, 0, 2, 'Luis', 'Mondragon', 'Herrera', 'No se', '', '', '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(8, 'gtgtgtgtg', 6, 0, 1, '', '', '', '', '', '', '2015-12-03 00:07:55', '2015-12-03 00:07:55'),
(9, 'xxxxxxx', 6, 0, 1, 'xxxxxx', 'xxxxxxx', 'xxxxxxx', 'xxx', 'xxxx', '', '2015-12-03 00:15:25', '2015-12-03 00:15:25'),
(11, 'zz', 6, 0, 1, 'zz', 'zz', 'zz', 'zz', 'zz', '', '2015-12-03 00:28:06', '2015-12-03 00:28:06'),
(12, 'uiui', 68, 0, 1, '', '', '', '', '', '', '2015-12-03 00:37:26', '2015-12-03 00:37:26'),
(13, 'efrefgerg', 69, 0, 1, 'Yari', 'Jaramillo', 'Mestiza', 'Nose', 'Nose', '', '2015-12-03 00:41:02', '2015-12-03 00:41:02'),
(22, 'cupu800825569', 78, 0, 1, 'Alfonso', 'Espino', '', '', '', '', '2015-12-03 02:11:09', '2015-12-03 02:11:09'),
(23, 'melm8305281h0', 79, 0, 1, 'Ulises', 'Martinez', 'Garcia', 'Policia', 'No me la se', '', '2015-12-03 02:13:33', '2015-12-03 02:13:33'),
(24, 'LOLM9007231D9', 80, 0, 1, 'Jose Luis', 'Garfias', '', '', '', '', '2015-12-03 02:21:26', '2015-12-03 02:21:26'),
(25, 'mohl931012ooo', 81, 0, 1, 'Luis Angel', 'Mondragon', 'Herrera', 'angelmh', 'XD', '', '2015-12-03 02:34:38', '2015-12-03 02:34:38'),
(26, 'melm8305281h0', 82, 0, 1, 'Roberto', 'Sanchez', '', '', '', '', '2015-12-03 08:37:50', '2015-12-03 08:37:50'),
(27, 'cupu800825569', 83, 0, 1, 'Juanito', 'Gonzales', '', '', '', '', '2015-12-03 08:47:12', '2015-12-03 08:47:12'),
(28, 'COPA800825569', 84, 0, 1, 'Lorena', 'Garfias', '', '', '', '', '2015-12-03 08:48:32', '2015-12-03 08:48:32'),
(29, 'melm8305281h0', 85, 0, 1, 'Diana', 'melendez', '', '', '', '', '2015-12-04 01:46:07', '2015-12-04 01:46:07'),
(30, 'hmsl8302188h6', 86, 0, 1, 'Julia', 'Benitez', '', '', '', '', '2015-12-04 01:48:38', '2015-12-04 01:48:38'),
(31, 'hjml8305181h0', 87, 0, 1, 'Graciela', 'Garfias', '', '', '', '', '2015-12-04 01:59:18', '2015-12-04 01:59:18'),
(32, 'melm830512ako', 88, 0, 1, 'Gama', 'No se', '', '', '', '', '2015-12-04 02:03:37', '2015-12-04 02:03:37'),
(33, 'melm830512ako', 89, 0, 1, 'Yatziri', 'Avilez', '', '', '', '', '2015-12-04 12:46:29', '2015-12-04 12:46:29'),
(34, 'melm8305281h0', 90, 0, 1, 'Yovanny', 'Herrera', '', '', '', '', '2015-12-04 17:47:09', '2015-12-04 17:47:09'),
(35, 'melm8305281h0', 91, 0, 1, 'Angelmon', 'Mondragon', 'Herrera', 'No se', 'No se', '', '2015-12-04 18:26:23', '2015-12-04 18:26:23'),
(36, 'melm830512ako', 92, 0, 1, 'Adriana', 'Zuñica', '', '', '', '', '2015-12-15 23:54:39', '2015-12-15 23:54:39'),
(46, 'edfrgthyujklo', 102, 0, 1, 'Victor', 'Acosta', '', '', '', '', '2015-12-17 06:52:09', '2015-12-17 06:52:09'),
(47, 'tghyuiolpñkjh', 103, 0, 1, 'dedede', 'dedede', 'dedede', 'dwefrg', 'rthrthtr', '', '2015-12-17 06:58:57', '2015-12-17 06:58:57'),
(49, '', 105, 0, 1, '', '', '', '', '', '', '2015-12-17 07:16:28', '2015-12-17 07:16:28'),
(50, 'melm830512ako', 106, 0, 1, 'Pedrito', 'Chavez', '', '', '', '', '2015-12-17 07:20:41', '2015-12-17 07:20:41'),
(51, 'melm830512ako', 107, 0, 1, 'Rafita', 'Chavez', '', '', '', '', '2015-12-17 07:25:32', '2015-12-17 07:25:32'),
(52, 'melm830512ako', 108, 0, 1, 'Jorch', 'Torres', 'Chavez', 'Ni idea', 'Ni idea', '', '2015-12-17 07:27:47', '2015-12-17 07:27:47'),
(53, '', 109, 0, 1, '', '', '', '', '', '', '2015-12-17 07:33:49', '2015-12-17 07:33:49'),
(54, '', 110, 0, 1, '', '', '', '', '', '', '2015-12-17 07:35:38', '2015-12-17 07:35:38'),
(55, 'MELM8305281H0', 111, 0, 1, 'Pricila', 'Herrera', 'Ortega', 'No se ', 'No se', '', '2015-12-18 02:05:44', '2015-12-18 02:05:44'),
(56, 'MELM8305281H0', 112, 0, 1, 'Samuel', 'Sanchez', 'Cardozo', 'No se XD', 'No se XD', '', '2015-12-18 04:38:20', '2015-12-18 04:38:20'),
(63, 'melm8305281h0', 121, 0, 1, 'Ignacio', 'Sanchez', '', '', '', '0001', '2016-01-11 23:54:38', '2016-01-11 23:54:38'),
(64, 'MELM8305281h0', 122, 0, 1, 'Rodolfo', 'Carmona', '', '', '', '20160111021', '2016-01-11 23:58:50', '2016-01-11 23:58:50'),
(65, 'MELM8305281HO', 123, 0, 1, 'Juan Luis', 'Gomez', '', '', '', '20160111123632', '2016-01-11 18:36:32', '2016-01-11 18:36:32'),
(66, 'MELM8305281H0', 125, 0, 1, 'Arturo', 'Quiensabe', '', '', '', '20160111124034125', '2016-01-11 18:40:34', '2016-01-11 18:40:34'),
(67, 'MELM8305281H0', 126, 0, 1, 'Luis Angel', 'Mondragon ', 'Herrera', '', '', '20160111125107126', '2016-01-11 18:51:07', '2016-01-11 18:51:07'),
(68, 'melm8305281h0', 128, 0, 1, 'Leonor', 'Vallesteros', '', '', '', '20160112233209128', '2016-01-13 05:32:09', '2016-01-13 05:32:09'),
(69, 'melm8305281h0', 129, 0, 1, 'James', 'Figueroa', 'Perez', '', '', '20160113235327129', '2016-01-14 05:53:27', '2016-01-14 05:53:27'),
(70, 'MELM8305281H0', 130, 0, 1, 'Luis', 'Mondragon', 'Herrera', '', '', '20160116224505130', '2016-01-17 04:45:05', '2016-01-17 04:45:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_forma_pago`
--

CREATE TABLE IF NOT EXISTS `cliente_forma_pago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned NOT NULL,
  `forma_pago_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cliente_forma_pago_cliente_id_foreign` (`cliente_id`),
  KEY `cliente_forma_pago_forma_pago_id_foreign` (`forma_pago_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `cliente_forma_pago`
--

INSERT INTO `cliente_forma_pago` (`id`, `cliente_id`, `forma_pago_id`, `created_at`, `updated_at`) VALUES
(1, 68, 4, '2016-01-13 09:49:24', '2016-01-13 09:49:24'),
(2, 68, 3, '2016-01-13 10:09:02', '2016-01-13 10:09:02'),
(3, 68, 1, '2016-01-13 10:21:36', '2016-01-13 10:21:36'),
(4, 68, 1, '2016-01-13 10:25:06', '2016-01-13 10:25:06'),
(22, 68, 1, '2016-01-13 19:23:20', '2016-01-13 19:23:20'),
(23, 68, 1, '2016-01-13 19:24:47', '2016-01-13 19:24:47'),
(24, 68, 2, '2016-01-13 19:25:58', '2016-01-13 19:25:58'),
(25, 68, 3, '2016-01-13 19:28:47', '2016-01-13 19:28:47'),
(26, 68, 4, '2016-01-13 19:30:09', '2016-01-13 19:30:09'),
(27, 67, 1, '2016-01-14 01:50:59', '2016-01-14 01:50:59'),
(28, 67, 2, '2016-01-14 01:52:41', '2016-01-14 01:52:41'),
(29, 67, 3, '2016-01-14 01:54:00', '2016-01-14 01:54:00'),
(30, 67, 4, '2016-01-14 02:32:56', '2016-01-14 02:32:56'),
(31, 69, 1, '2016-01-14 06:27:30', '2016-01-14 06:27:30'),
(32, 69, 1, '2016-01-14 06:34:48', '2016-01-14 06:34:48'),
(33, 69, 3, '2016-01-14 06:45:15', '2016-01-14 06:45:15'),
(34, 69, 4, '2016-01-14 06:54:46', '2016-01-14 06:54:46'),
(35, 70, 2, '2016-01-17 04:46:17', '2016-01-17 04:46:17'),
(36, 70, 4, '2016-01-17 04:48:36', '2016-01-17 04:48:36'),
(37, 70, 1, '2016-01-17 04:50:25', '2016-01-17 04:50:25'),
(38, 70, 4, '2016-01-17 04:59:24', '2016-01-17 04:59:24'),
(39, 70, 1, '2016-01-17 05:01:43', '2016-01-17 05:01:43'),
(40, 70, 3, '2016-01-17 05:06:37', '2016-01-17 05:06:37'),
(41, 70, 1, '2016-01-17 05:12:42', '2016-01-17 05:12:42'),
(42, 70, 3, '2016-01-17 06:51:21', '2016-01-17 06:51:21'),
(43, 70, 2, '2016-01-18 20:48:47', '2016-01-18 20:48:47'),
(44, 70, 2, '2016-01-18 20:52:19', '2016-01-18 20:52:19'),
(45, 70, 1, '2016-01-18 20:58:21', '2016-01-18 20:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercializador`
--

CREATE TABLE IF NOT EXISTS `comercializador` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `contacto_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE IF NOT EXISTS `descuento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`id`, `descripcion`, `descuento`, `created_at`, `updated_at`, `estatus`) VALUES
(1, 'Normal', '5%', '2015-11-30 06:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_cliente`
--

CREATE TABLE IF NOT EXISTS `direccion_cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned NOT NULL,
  `pais_id` int(10) unsigned NOT NULL,
  `estado_id` int(10) unsigned NOT NULL,
  `municipio_id` int(10) unsigned NOT NULL,
  `telefono_cliente_id` int(10) unsigned NOT NULL,
  `calle1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `calle2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `colonia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delegacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `direccion_cliente_cliente_id_foreign` (`cliente_id`),
  KEY `direccion_cliente_pais_id_foreign` (`pais_id`),
  KEY `direccion_cliente_estado_id_foreign` (`estado_id`),
  KEY `direccion_cliente_municipio_id_foreign` (`municipio_id`),
  KEY `direccion_cliente_telefono_cliente_id_foreign` (`telefono_cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `direccion_cliente`
--

INSERT INTO `direccion_cliente` (`id`, `cliente_id`, `pais_id`, `estado_id`, `municipio_id`, `telefono_cliente_id`, `calle1`, `calle2`, `colonia`, `delegacion`, `codigo_postal`, `tipo`, `estatus`, `created_at`, `updated_at`) VALUES
(2, 70, 1, 2, 14, 117, 'aaa', 'aa', 'aaa', 'aaa', '45678', 'Otro', 1, '2016-01-18 20:48:47', '2016-01-18 20:48:47'),
(3, 70, 1, 2, 14, 118, 'eee', 'eee', 'eee', 'eee', '45678', 'Otro', 1, '2016-01-18 20:52:19', '2016-01-18 20:52:19'),
(4, 70, 1, 2, 13, 119, 'oooo', 'ooo', 'oooo', 'ooo', '67890', 'Fiscal', 1, '2016-01-18 20:58:21', '2016-01-18 20:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_proveedor`
--

CREATE TABLE IF NOT EXISTS `direccion_proveedor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL,
  `pais_id` int(10) unsigned NOT NULL,
  `estado_id` int(10) unsigned NOT NULL,
  `municipio_id` int(10) unsigned NOT NULL,
  `calle1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `calle2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `colonia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delegacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `direccion_proveedor_proveedor_id_foreign` (`proveedor_id`),
  KEY `direccion_proveedor_pais_id_foreign` (`pais_id`),
  KEY `direccion_proveedor_estado_id_foreign` (`estado_id`),
  KEY `direccion_proveedor_municipio_id_foreign` (`municipio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE IF NOT EXISTS `entrada` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_entrada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `factura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_factura` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entrada_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_detalle`
--

CREATE TABLE IF NOT EXISTS `entrada_detalle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) unsigned NOT NULL,
  `entrada_id` int(10) unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `precio_compra` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `entrada_detalle_producto_id_foreign` (`producto_id`),
  KEY `entrada_detalle_entrada_id_foreign` (`entrada_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pais_id` int(10) unsigned NOT NULL,
  `estados` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `estado_pais_id_foreign` (`pais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `pais_id`, `estados`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'Aguascalientes', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Baja California', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Baja California Sur', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Campeche', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Coahuila de Zaragoza', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(6, 1, 'Colima', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Chiapas', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Chihuahua', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Distrito Federal', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(10, 1, 'Durango', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(11, 1, 'Guanajuato', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(12, 1, 'Guerrero', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(13, 1, 'Hidalgo', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(14, 1, 'Jalisco', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(15, 1, 'México', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(16, 1, 'Michoacán de Ocampo', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(17, 1, 'Morelos', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(18, 1, 'Nayarit', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(19, 1, 'Nuevo León', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(20, 1, 'Oaxaca', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(21, 1, 'Puebla', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(22, 1, 'Querétaro', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(23, 1, 'Quintana Roo', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(24, 1, 'San Luis Potosí', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(25, 1, 'Sinaloa', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(26, 1, 'Sonora', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(27, 1, 'Tabasco', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(28, 1, 'Tamaulipas', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(29, 1, 'Tlaxcala', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(30, 1, 'Veracruz de Ignacio de la Llave', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(31, 1, 'Yucatán', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00'),
(32, 1, 'Zacatecas', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE IF NOT EXISTS `familia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descuento_id` int(10) unsigned NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `factor_descuento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `familia_descuento_id_foreign` (`descuento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id`, `descuento_id`, `descripcion`, `factor_descuento`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'Esschert Holanda', 'No lo se XD', 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE IF NOT EXISTS `forma_pago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id`, `descripcion`) VALUES
(1, 'Tarjeta de crédito'),
(2, 'Tarjeta de debito'),
(3, 'Efectivo'),
(4, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importador`
--

CREATE TABLE IF NOT EXISTS `importador` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `importador`
--

INSERT INTO `importador` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Imorador 1', '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(2, 'Segundo Importador', '2015-11-23 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) unsigned NOT NULL,
  `cantidad` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inventario_producto_id_foreign` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto_id`, `cantidad`) VALUES
(1, 1, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE IF NOT EXISTS `mensajeria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- Volcado de datos para la tabla `mensajeria`
--

INSERT INTO `mensajeria` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(26, '3', '2016-01-13 10:09:02', '2016-01-13 10:09:02'),
(27, '1', '2016-01-13 10:21:36', '2016-01-13 10:21:36'),
(28, '1', '2016-01-13 10:25:06', '2016-01-13 10:25:06'),
(29, '2', '2016-01-13 10:44:19', '2016-01-13 10:44:19'),
(30, '3', '2016-01-13 10:51:54', '2016-01-13 10:51:54'),
(31, '4', '2016-01-13 11:08:21', '2016-01-13 11:08:21'),
(32, '1', '2016-01-13 11:10:47', '2016-01-13 11:10:47'),
(46, '1', '2016-01-13 19:23:20', '2016-01-13 19:23:20'),
(47, '1', '2016-01-13 19:24:47', '2016-01-13 19:24:47'),
(48, '2', '2016-01-13 19:25:58', '2016-01-13 19:25:58'),
(49, '3', '2016-01-13 19:28:47', '2016-01-13 19:28:47'),
(50, '4', '2016-01-13 19:30:09', '2016-01-13 19:30:09'),
(51, '1', '2016-01-14 01:50:59', '2016-01-14 01:50:59'),
(52, '2', '2016-01-14 01:52:41', '2016-01-14 01:52:41'),
(53, '3', '2016-01-14 01:54:00', '2016-01-14 01:54:00'),
(54, '4', '2016-01-14 02:32:56', '2016-01-14 02:32:56'),
(55, '1', '2016-01-14 06:27:30', '2016-01-14 06:27:30'),
(56, '1', '2016-01-14 06:34:48', '2016-01-14 06:34:48'),
(57, '3', '2016-01-14 06:45:15', '2016-01-14 06:45:15'),
(58, '4', '2016-01-14 06:54:46', '2016-01-14 06:54:46'),
(59, '2', '2016-01-17 04:46:17', '2016-01-17 04:46:17'),
(60, '4', '2016-01-17 04:48:36', '2016-01-17 04:48:36'),
(61, '1', '2016-01-17 04:50:25', '2016-01-17 04:50:25'),
(62, '4', '2016-01-17 04:59:24', '2016-01-17 04:59:24'),
(63, '1', '2016-01-17 05:01:43', '2016-01-17 05:01:43'),
(64, '3', '2016-01-17 05:06:37', '2016-01-17 05:06:37'),
(65, '1', '2016-01-17 05:12:42', '2016-01-17 05:12:42'),
(66, '3', '2016-01-17 06:51:21', '2016-01-17 06:51:21'),
(67, '2', '2016-01-18 20:48:47', '2016-01-18 20:48:47'),
(68, '2', '2016-01-18 20:52:19', '2016-01-18 20:52:19'),
(69, '1', '2016-01-18 20:58:21', '2016-01-18 20:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_11_28_030608_rol', 1),
('2015_11_28_030739_usuario', 1),
('2015_11_28_033501_nivel_descuento', 2),
('2015_11_28_035540_cliente', 3),
('2015_11_28_042147_cliente', 4),
('2015_11_28_042530_cliente', 5),
('2015_11_28_045122_cliente', 6),
('2015_11_29_183851_usuario_detalle', 7),
('2015_11_29_184309_forma_pago', 8),
('2015_11_29_184723_mensajeria', 9),
('2015_11_29_185228_pedido', 10),
('2015_11_29_190244_unidad_medida', 11),
('2015_11_29_190611_almacen', 12),
('2015_11_29_190855_importador', 13),
('2015_11_29_191133_descuento', 14),
('2015_11_29_191409_familia', 15),
('2015_11_29_191923_producto', 16),
('2015_11_29_192956_pedido_detalle', 17),
('2015_11_29_193327_producto_precio', 18),
('2015_11_29_193926_inventario', 19),
('2015_11_29_194342_comercializador', 20),
('2015_11_29_194636_proveedor', 21),
('2015_11_29_195003_contacto', 22),
('2015_11_29_195504_entrada', 23),
('2015_11_29_200002_entrada_detalle', 24),
('2015_11_29_200344_telefono', 25),
('2015_11_29_200711_pais', 26),
('2015_11_29_200917_estado', 27),
('2015_11_29_201127_municipio', 28),
('2015_11_29_201322_direccion', 29),
('2015_11_29_202627_direccion', 30),
('2015_12_04_063205_password_reminders', 31),
('2015_11_29_184309_cliente_forma_pago', 32),
('2015_12_16_031358_forma_pago', 33),
('2015_12_16_034505_cliente_forma_pago', 34),
('2015_11_29_202627_direccion_proveedor', 35),
('2015_12_16_040819_direccion_cliente', 36),
('2015_11_29_200344_telefono_proveedor', 37),
('2015_12_16_043358_telefono_cliente', 38),
('2016_01_13_004618_pedido', 39),
('2016_01_13_005512_pedido_detalle', 40),
('2016_01_13_040326_pedido', 41),
('2016_01_13_040529_pedido_detalle', 42),
('2016_01_18_144117_direccion_cliente', 43),
('2016_01_18_144314_pedido', 44),
('2016_01_18_144432_pedido_detalle', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado_id` int(10) unsigned NOT NULL,
  `municipio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `municipio_estado_id_foreign` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `estado_id`, `municipio`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'Aguascalientes', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Asientos', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Calvillo', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Cosío', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(5, 1, 'El Llano', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(6, 1, 'Jesús María', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Pabellón de Arteaga', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Rincón de Romos', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(9, 1, 'San Francisco de los Romo', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(10, 1, 'San José de Gracia', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(11, 1, 'Tepezalá', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(12, 2, 'Ensenada', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(13, 2, 'Mexicali', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(14, 2, 'Tecate', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(15, 2, 'Tijuana', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(16, 2, 'Playas de Rosarito', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(17, 3, 'Comondú', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(18, 3, 'La Paz', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(19, 3, 'Loreto', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(20, 3, 'Los Cabos', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(21, 3, 'Mulegé', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(22, 4, 'Calakmul', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(23, 4, 'Calkiní', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(24, 4, 'Campeche', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(25, 4, 'Candelaria', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(26, 4, 'Carmen', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(27, 4, 'Champotón', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(28, 4, 'Escárcega', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(29, 4, 'Hecelchakán', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(30, 4, 'Hopelchén', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(31, 4, 'Palizada', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(32, 4, 'Tenabo', 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_descuento`
--

CREATE TABLE IF NOT EXISTS `nivel_descuento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `nivel_descuento`
--

INSERT INTO `nivel_descuento` (`id`, `descripcion`, `descuento`, `created_at`, `updated_at`, `estatus`) VALUES
(1, 'Normal', '5%', '2015-11-27 06:00:00', '0000-00-00 00:00:00', 1),
(2, 'Frecuente', '15%', '2015-11-27 06:00:00', '0000-00-00 00:00:00', 1),
(3, 'Mayorista', '30%', '2015-11-27 06:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'México', 1, '2015-12-29 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_reminders`
--

INSERT INTO `password_reminders` (`email`, `token`, `created_at`) VALUES
('ejemplo2@live.com', '8e519d9eddce9e96c5491a90bae2b363ad9f5fdf', '2015-12-04 14:27:54'),
('ejemplo1@live.com', '06804e7ea464f1a0713c92244cea077bc3eb5744', '2015-12-04 14:29:34'),
('', '2bc9f285e78dc1b218fc067db376390ac48f9ac9', '2015-12-04 14:33:39'),
('ejemplo@live.com', '451cf575417eb2dbfee2e954065f7445ebf5f129', '2015-12-04 14:40:31'),
('angel@live.com', '3275f969d0d6aa3cab25fc121c5666c9d4436066', '2015-12-04 15:04:48'),
('angeldarkkiller99@live.com', 'ad832f330e17c0505a06536bf39f90d41d1421de', '2015-12-04 19:02:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned NOT NULL,
  `mensajeria_id` int(10) unsigned NOT NULL,
  `direccion_cliente_id` int(10) unsigned NOT NULL,
  `forma_pago_id` int(10) unsigned NOT NULL,
  `num_pedido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_entrega` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_cliente_id_foreign` (`cliente_id`),
  KEY `pedido_mensajeria_id_foreign` (`mensajeria_id`),
  KEY `pedido_direccion_cliente_id_foreign` (`direccion_cliente_id`),
  KEY `pedido_forma_pago_id_foreign` (`forma_pago_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `mensajeria_id`, `direccion_cliente_id`, `forma_pago_id`, `num_pedido`, `created_at`, `updated_at`, `fecha_entrega`, `observaciones`, `estatus`) VALUES
(1, 70, 67, 2, 2, '2016011803170', '2016-01-18 20:48:47', '2016-01-18 20:48:47', '0000-00-00 00:00:00', 'aaa...', 0),
(2, 70, 68, 3, 2, '2016011803170', '2016-01-18 20:52:19', '2016-01-18 20:52:19', '0000-00-00 00:00:00', 'eee.....', 0),
(3, 70, 69, 4, 1, '2016011803170', '2016-01-18 20:58:21', '2016-01-18 20:58:21', '0000-00-00 00:00:00', 'sin comentarios...', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE IF NOT EXISTS `pedido_detalle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pedido_detalle_pedido_id_foreign` (`pedido_id`),
  KEY `pedido_detalle_producto_id_foreign` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE IF NOT EXISTS `precio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`id`, `producto_id`, `nombre`) VALUES
(1, 1, 'Precio uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `numero_articulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ean_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero_color` int(11) NOT NULL,
  `unidad_medida_id` int(10) unsigned NOT NULL,
  `piezas_paquete` int(11) NOT NULL,
  `dimensiones` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `piezas_pallet` int(11) NOT NULL,
  `total_piezas` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importador_id` int(10) unsigned NOT NULL,
  `almacen_id` int(10) unsigned NOT NULL,
  `familia_id` int(10) unsigned NOT NULL,
  `estatus_web` tinyint(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `producto_unidad_medida_id_foreign` (`unidad_medida_id`),
  KEY `producto_importador_id_foreign` (`importador_id`),
  KEY `producto_almacen_id_foreign` (`almacen_id`),
  KEY `producto_familia_id_foreign` (`familia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `clave`, `numero_articulo`, `nombre`, `ean_code`, `color`, `numero_color`, `unidad_medida_id`, `piezas_paquete`, `dimensiones`, `piezas_pallet`, `total_piezas`, `foto`, `importador_id`, `almacen_id`, `familia_id`, `estatus_web`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'AC01', 'C3031', 'Maceta cerámica antiguas para plantas. Juego de 3 piezas cuadradas', '8714982046483 ', 'anthracit', 24, 1, 2, '260x260x395', 60, 190, 'Macetacerámicaantiguas.png', 1, 1, 1, 1, 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(2, 'AC03', 'C3089', 'Flower pot Perla ø 11 ', '8590415002963', 'purple pearl', 43, 1, 32, '260x260x395', 60, 1920, 'Macetacerámicacolganteantigua.png', 2, 1, 1, 1, 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(3, 'AC04', 'c2345', 'Maceta cerámica para pared antigua para plantas', '8590415002970', 'pearl', 54, 1, 32, '260x260x395', 60, 1920, 'Macetacerámicaparaparedantigua.png', 1, 1, 1, 1, 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(4, 'AC10', 'c1189', 'Bebedero para pájaros cerámico con diseño decorativo antiguo', '8590415002989', 'marron', 33, 1, 23, '260x260x300', 60, 1920, 'Bebederoparapájaros.png', 2, 1, 1, 1, 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00'),
(5, 'AC134', 'cb890', 'Velas decorativas. Tamaño Grande', '8714982100796', 'white', 27, 1, 12, '260x260x360', 60, 1920, 'velasdecorativastamanogrande.png', 2, 1, 1, 1, 1, '2015-12-08 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio`
--

CREATE TABLE IF NOT EXISTS `producto_precio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) unsigned NOT NULL,
  `precio_compra` double NOT NULL,
  `precio_venta` double NOT NULL,
  `moneda` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vigencia` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_precio_producto_id_foreign` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `producto_precio`
--

INSERT INTO `producto_precio` (`id`, `producto_id`, `precio_compra`, `precio_venta`, `moneda`, `vigencia`, `estatus`) VALUES
(1, 1, 30, 180, '$', '2015-11-30 06:00:00', 1),
(2, 2, 40, 70, '$', '2015-11-30 06:00:00', 1),
(3, 3, 79, 89, '$', '2015-12-08 06:00:00', 1),
(5, 4, 120, 350, '$', '2015-12-08 06:00:00', 1),
(6, 5, 50, 79, '$', '2015-12-08 06:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comercializador_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `proveedor_comercializador_id_foreign` (`comercializador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cliente', '2015-11-27 06:00:00', '0000-00-00 00:00:00'),
(2, 'Agente', '2015-11-27 06:00:00', '0000-00-00 00:00:00'),
(3, 'Administrador', '2015-11-27 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono_cliente`
--

CREATE TABLE IF NOT EXISTS `telefono_cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `telefono_cliente_cliente_id_foreign` (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=120 ;

--
-- Volcado de datos para la tabla `telefono_cliente`
--

INSERT INTO `telefono_cliente` (`id`, `cliente_id`, `numero`, `tipo_tel`, `estatus`, `created_at`, `updated_at`) VALUES
(73, 68, '768765478', 'Celular', 1, '2016-01-13 09:35:42', '2016-01-13 09:35:42'),
(74, 68, '768765478', 'Celular', 1, '2016-01-13 09:49:24', '2016-01-13 09:49:24'),
(75, 68, '768765478', 'Celular', 1, '2016-01-13 10:09:02', '2016-01-13 10:09:02'),
(76, 68, '7861278681', 'Celular', 1, '2016-01-13 10:21:36', '2016-01-13 10:21:36'),
(77, 68, '6751278781', 'Celular', 1, '2016-01-13 10:25:06', '2016-01-13 10:25:06'),
(96, 68, ' 3333333333', 'Celular', 1, '2016-01-13 19:24:47', '2016-01-13 19:24:47'),
(97, 68, '9990001122', 'Fijo', 1, '2016-01-13 19:25:57', '2016-01-13 19:25:57'),
(98, 68, '4445556677', 'Celular', 1, '2016-01-13 19:28:47', '2016-01-13 19:28:47'),
(99, 68, ' 7778889911', 'Fijo', 1, '2016-01-13 19:30:09', '2016-01-13 19:30:09'),
(100, 67, '1112223344', 'Celular', 1, '2016-01-14 01:50:59', '2016-01-14 01:50:59'),
(101, 67, ' 4445556677', 'Fijo', 1, '2016-01-14 01:52:40', '2016-01-14 01:52:40'),
(102, 67, ' 8889991122', 'Otro', 1, '2016-01-14 01:54:00', '2016-01-14 01:54:00'),
(103, 67, ' 8889996655', 'Otro', 1, '2016-01-14 02:32:56', '2016-01-14 02:32:56'),
(104, 69, ' ', 'Otro', 1, '2016-01-14 06:27:30', '2016-01-14 06:27:30'),
(105, 69, '7151234567', 'Celular', 1, '2016-01-14 06:34:48', '2016-01-14 06:34:48'),
(106, 69, ' 7152678976', 'Otro', 1, '2016-01-14 06:45:15', '2016-01-14 06:45:15'),
(107, 69, '7865432134 ', 'Fijo', 1, '2016-01-14 06:54:45', '2016-01-14 06:54:45'),
(108, 70, '333333333', 'Celular', 1, '2016-01-17 04:46:17', '2016-01-17 04:46:17'),
(109, 70, '223333', 'Celular', 1, '2016-01-17 04:48:36', '2016-01-17 04:48:36'),
(110, 70, '1111111', 'Celular', 1, '2016-01-17 04:50:25', '2016-01-17 04:50:25'),
(111, 70, '3333333333', 'Celular', 1, '2016-01-17 04:59:23', '2016-01-17 04:59:23'),
(112, 70, '44444444', 'Celular', 1, '2016-01-17 05:01:42', '2016-01-17 05:01:42'),
(113, 70, '56789543', 'Celular', 1, '2016-01-17 05:06:37', '2016-01-17 05:06:37'),
(114, 70, '6665554488', 'Celular', 1, '2016-01-17 05:12:41', '2016-01-17 05:12:41'),
(115, 70, '234567', 'Celular', 1, '2016-01-17 06:51:21', '2016-01-17 06:51:21'),
(116, 70, '3456789876', 'Celular', 1, '2016-01-18 20:45:43', '2016-01-18 20:45:43'),
(117, 70, '1234567898', 'Celular', 1, '2016-01-18 20:48:47', '2016-01-18 20:48:47'),
(118, 70, '1234567876', 'Celular', 1, '2016-01-18 20:52:19', '2016-01-18 20:52:19'),
(119, 70, ' 786278688', 'Otro', 1, '2016-01-18 20:58:21', '2016-01-18 20:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono_proveedor`
--

CREATE TABLE IF NOT EXISTS `telefono_proveedor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `telefono_proveedor_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Unidad de medida 1', 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol_id` int(10) unsigned NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `usuario_rol_id_foreign` (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=131 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rol_id`, `usuario`, `password`, `email`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 1, 'angel99', '12345678', '', '', '2015-11-28 09:27:14', '2015-11-28 09:27:14'),
(6, 1, 'angelitomh', '$2y$10$dSbYqUSQt0eO1rnJ5VpUreuyJ4pi0HoD2QE2IlmHAE9PpzdiTqc/m', 'angel@live.com', '', '2015-11-28 09:32:54', '2015-11-28 09:32:54'),
(27, 2, 'flor99', '$2y$10$B0qG1786tvDFY8uFH2rlmO.aCMM12rgQrISaZkPvHltMf5PSI1wd6', 'angeldarkkiller99@live.com', '8dIIX1qoWiiGYCq20fGK7CgouVUz4t63h1ZBzO6rHanw5F7iJSQ29KLalmrM', '2015-11-29 04:27:52', '2016-01-06 00:12:53'),
(29, 3, 'Hector', '$2y$10$NEl79X9MHHEl3PhvxOcebOqzosUySo4aXe0FcFIPhPh4MXrgYIOkO', '', 'q9ZLFkTx9fVcW6atv8pQz4JR3cNGsBhQwysEOuUtBiHGvH4XY1nwV4Zlrqfn', '2015-11-29 04:31:28', '2016-01-09 06:12:24'),
(51, 1, 'charly', '$2y$10$vt./IVh6CWWnxhNy8oAdQeAHhwAXxIsW48J3YclEyHqc7Kkiv9xz.', '', 'W9ZlvzMYza2z1Ypca7SX6togPyTGsa7eJlQPh186popO6hHA9kTUjvGaaNN0', '2015-11-30 02:33:31', '2015-11-30 02:39:57'),
(52, 1, 'Luisillo', '$2y$10$eGReK7445dlcRVXjfD6dLuL35uSEHXeMgZBKOhD8Fje4tdrXxZNxC', '', '', '2015-12-02 23:47:30', '2015-12-02 23:47:30'),
(66, 1, 'tytyyty', '$2y$10$gD.4.0oZB.sd7EgSZlOB1.3i70p/w293HMspkO6eMbQrz5TQSJqmu', '', '', '2015-12-03 00:35:13', '2015-12-03 00:35:13'),
(67, 1, 'seesse', '$2y$10$CKJQ2aJuwk56xAJuQ5P9p.pVfUqYkOm1hTfFK1Pgs3nrKaLZYR0yC', '', '', '2015-12-03 00:36:21', '2015-12-03 00:36:21'),
(68, 1, 'uiuiuii', '$2y$10$mSRwjAzfs40yBQpbfeveg.h/A25E14KSmqSXpPBPn7.KjRzGw4/hu', '', '', '2015-12-03 00:37:26', '2015-12-03 00:37:26'),
(69, 1, 'Jary99', '$2y$10$fdR.Secxh8dy5i3LXjsAS.8W1gJqfGgmPV7EGlTZzCmqFA10guqqK', '', '3IcqC6MK414px5npszJBanHDxs0cLYrZBm8yuPYVusKs2nuQgQPw01Gx06f2', '2015-12-03 00:41:02', '2015-12-03 00:42:39'),
(78, 1, 'Alfonso16', '$2y$10$Xut4Ce9RS3AdmdCDdqeMOeKpv1PMA/AceXNM5pLQ/yldzeUv1GTZq', '', 'Crse2KMdQjpq1dNwtUJ4BokxKeMkW4pgfPiFUwyUriX5hPYMHi7s0msKJg8J', '2015-12-03 02:11:08', '2015-12-03 02:11:30'),
(79, 1, 'Poli', '$2y$10$mWyOC8ZpSFrDcILUtGViJu3.4zoi0TrN1xkeWIjTfsBaANXUXzrvu', '', '', '2015-12-03 02:13:33', '2015-12-03 02:13:33'),
(80, 1, 'Jose17', '$2y$10$yR0/jTJrQyJQyr3aw1nV..3Vr9GNzPD3/XrB/T6DXlOaCUpebwonq', '', '', '2015-12-03 02:21:26', '2015-12-03 02:21:26'),
(81, 1, 'angeldarkk', '$2y$10$lhEjJCHsqzm3cTJSOagga.CtvPJ.rzGiUfSZ4zT0.OmoFYPbggpwO', 'ejemplo3@live.com', '', '2015-12-03 02:34:38', '2015-12-03 02:34:38'),
(82, 1, 'Robertin', '$2y$10$u1Mt13M8410nBKugMwtlo.Be3RtaZ6w0ikrmgCDL1YhF2Kr.ThRY2', '', 'Ko8dSXbNvEaz8Hwcjw70dbHvjbnDkRdK8OevQyv7b587N8xRTJcvh8bzosXZ', '2015-12-03 08:37:50', '2015-12-03 08:38:29'),
(83, 1, 'Juanito99', '$2y$10$QCsJTmlDaKBRm9cDsT6VROSIvjfPhyUi2HJ9EZD.pAlv8hxncPpD2', '', 'p6ga3Gyx1LM6Yo0NCq1WX3wOnIl6W56UWrgwk2EBiL6TT9VvtU0ct4zDawWq', '2015-12-03 08:47:12', '2015-12-03 08:47:28'),
(84, 1, 'Lore', '$2y$10$DIAFTE6kinRjm8xT832qqe0bYYyZY1HxEt8vSidi.iD7YcxGTz8LG', '', 'XqgU1SqnBlmUVkAWC23YR5tEkYqva5e8nYYv8UWu0qOIlPSOukZEYzxlaApD', '2015-12-03 08:48:32', '2015-12-03 08:48:47'),
(85, 1, 'Dianita1', '$2y$10$iM3A.jDhcSFQz4jUOD8ivuOf2kxySPRmbEDbR7jiRmY5nvT6mLE/u', '', '', '2015-12-04 01:46:06', '2015-12-04 01:46:06'),
(86, 1, 'Julia', '$2y$10$OWWTP8KmzErIf/VcsCjp6uutdTDqLtYkP0H4GPn12LqNJv9Ek7Qh2', '', 'hN9UUYEiL1gAR2FzRlW4eooL032AOz15wNOsoH1Ivfamp46YQtwbVSyiexpg', '2015-12-04 01:48:38', '2015-12-04 01:49:00'),
(87, 1, 'Graciela', '$2y$10$B8jxB6psHHB4ygcyzEWR1.vWvrfs6vljuE7q2szZnt4MRPKbHzWY6', '', '', '2015-12-04 01:59:18', '2015-12-04 01:59:18'),
(88, 1, 'Gama', '$2y$10$hOMzS1I3cmgb3VPu7YID7.GhTC/TBF3XlWdYIh8wqH7EikTXidepe', '', '', '2015-12-04 02:03:37', '2015-12-04 02:03:37'),
(89, 1, 'Yatziri', '$2y$10$9e/N6biQINZ4eJ/y2R49E.sjjEWfNjcjGyIMwytWdQMJWuqI2ylXu', '', '', '2015-12-04 12:46:29', '2015-12-04 12:46:29'),
(90, 1, 'yovamh', '$2y$10$gLZmfXsVJ.LZqyC3XZcUkuV/DaY9epcigsfWmzxbQ7cKD/8xu3aU6', 'yova@gmail.com', '', '2015-12-04 17:47:09', '2015-12-04 17:47:09'),
(91, 1, 'darkkangel', '$2y$10$2FPexXlPNTQ2onh.YPvUmujVgKpfK/FJW.9j8vonSHtuPyOB2e43i', 'angeldarkkiller99@live.com', '0DzRNEmvA1tY5FX9OfKxSWSeOedHo1OVxOJS3MPOTGjpXjKGqLpZGIel0giE', '2015-12-04 18:26:23', '2015-12-04 18:27:20'),
(92, 1, 'Adri', '$2y$10$CTCAnuFunPCfiyiuHtRPi.tUnc0TLmjYpNBIGjxXj/IdGxQ4nyIGa', 'adri@hotmail.com', 'o1PjuQS3X5AJYEhEJBI2wMFJ0ybO3o5l7Lk0iSPHIJsyPngqTwCgasFQJmUu', '2015-12-15 23:54:39', '2015-12-16 00:40:06'),
(93, 1, 'Luis99', '$2y$10$mVgY.RnBElSZmcBqTpMPHeG4xNt6m.eyQp.5jD5Z0LONudpT/PZ7K', 'xsxs@live.com', '', '2015-12-17 02:57:37', '2015-12-17 02:57:37'),
(94, 1, 'Luis99', '$2y$10$fnoD92hyAzH/zGzA.8RTyOFkK76hcdV5RBY9SQHew0VCfJGiqucH2', 'wcw@live.com', '', '2015-12-17 03:02:21', '2015-12-17 03:02:21'),
(95, 1, 'Luisito99', '$2y$10$h0sTinJks2X8srtsabYKFueJgMpsKcqf01wXmwqbLjjovjZlcEZNi', 'aaadda@live.com', '', '2015-12-17 03:05:29', '2015-12-17 03:05:29'),
(96, 1, 'Luis99', '$2y$10$tOMoU6iXlPntj0mtMblBUeLK.wOJy5IXQeiXZA6DsjFTsJ5IgiJzm', 'aaaa@live.com', '', '2015-12-17 03:06:04', '2015-12-17 03:06:04'),
(97, 1, 'aqaqaqsqs', '$2y$10$TQr6s9i4zMkrjjx1f94j7eB4wAo0DJiffbB7qhfCPPTr.pkyIJ9G6', '', '', '2015-12-17 04:16:00', '2015-12-17 04:16:00'),
(98, 1, '', '$2y$10$6XFYLXSHJZenfa.pc1A.m./cGMyQJ/DS26ScrDFf0.gj/l74oYUGm', '', 'uOLEtpxbktzNgXg5XGc5ZoPEG5xx9ayMneUcPsw5WNyCoO4NBme6y3w79bNY', '2015-12-17 04:41:25', '2016-01-05 22:45:30'),
(99, 1, 'xxxzzz', '$2y$10$EPa34z7mGD4ZhbovRt1jw.ODL4vgfgYgX8NrcP7bfGo0tZww6OG3u', 'xxxx@outlook.es', '', '2015-12-17 04:51:37', '2015-12-17 04:51:37'),
(100, 1, 'XDXDXDXD', '$2y$10$Z2dLTdqMLB.vuz/89BBKuOCZD3HvTZORNTvSi0LOksioEZ3D6nib.', 'xdxd@live.com', '', '2015-12-17 04:54:26', '2015-12-17 04:54:26'),
(101, 1, 'kiki', '$2y$10$8GGvk4GupoldRPIjI7.YXu5VUy/TzfWWPUguTCoskwC6ZtxIZD93u', 'kiki@live.com', '', '2015-12-17 06:31:47', '2015-12-17 06:31:47'),
(102, 1, 'Vic33', '$2y$10$qlP8qP4qGlDZK4MOK0MQgOXP8YssnCzG6fJ9OdLrw2EF9zyi8Mote', 'vic@hotmail.com', '', '2015-12-17 06:52:09', '2015-12-17 06:52:09'),
(103, 1, 'dededededdde', '$2y$10$HIFjcGjsbSZfDX16akcuK.g.2E9jSTv37U4ax0H3I8AhA2mvjQb16', 'rbtrtr@live.com', '', '2015-12-17 06:58:57', '2015-12-17 06:58:57'),
(105, 1, '', '$2y$10$QRgmIuFj4fbyIV05xseaUOKImwN1S0M4harPnYCumgw/NLrtI/2z6', '', '', '2015-12-17 07:16:27', '2015-12-17 07:16:27'),
(106, 1, 'pdrin89', '$2y$10$/zsgv0Z2O1CJ0.EKYK3XxubWdNf2j7KCDnLa6.j6bMAqoamK6HhLK', 'pdrin@hotmail.com', '', '2015-12-17 07:20:41', '2015-12-17 07:20:41'),
(107, 1, 'Rafin', '$2y$10$5DOA4I5sIQ64sVr9Q1REUuAKfXuBDizhOigv8HKS3d8EE5RTiZxMS', 'rafin@live.com', '', '2015-12-17 07:25:32', '2015-12-17 07:25:32'),
(108, 1, 'Jorch17', '$2y$10$PtRwpkF0q8j43c3f608y0u8Y3OUG1x4i1x/HBs44zhsRdRAnWjqvq', 'jorch@hotmail.com', '0mUZZJgiKXKotom11S8DOSgowCLAGAwLxBOmWsboR4oou04IGqInxVeC5uaK', '2015-12-17 07:27:47', '2015-12-17 07:28:06'),
(109, 1, 'gkgkgk', '$2y$10$Chct6b8OOxh2cA7Fp9gL1epaN9AdP1Ca4jVHe7kG8G8APiUIaeG36', 'gkgkgk@live.com', '', '2015-12-17 07:33:49', '2015-12-17 07:33:49'),
(110, 1, 'dcsdcs', '$2y$10$OViBw3fkKDkLLxvprR/xUepD6Z8iEn9aNQvkbcfXx7h33cDI13ite', 'sxxas@live.com', '', '2015-12-17 07:35:38', '2015-12-17 07:35:38'),
(111, 1, 'Prix17', '$2y$10$LGu6imKj8.yxXGHlOSbT8u.FjnRVp2wPuw28kxbxYYMG8vjLpOfzS', 'prix@live.com', '', '2015-12-18 02:05:44', '2015-12-18 02:05:44'),
(112, 1, 'Sami12', '$2y$10$cOXbPgRG9UYSzfeVYPGZaOYxeM687TWqq02cD1ozol0F.Er4uNAIK', 'sami12@hotmail.com', 'wNjDwrxbUYYSndqjpCdc1BG7JgNGJq8cWtVqBabFLbv3taJCu3ulNHpP8IjP', '2015-12-18 04:38:19', '2015-12-22 08:02:20'),
(121, 1, 'Avioneta', '$2y$10$l8r7B6ztTAwLDjPk9cz99.l5V2fAYb5dYuMu/dlmX.qPqxyV282He', 'avion@live.com', '', '2016-01-11 23:54:38', '2016-01-11 23:54:38'),
(122, 1, 'Rodo', '$2y$10$ej0fJmSCGJP35O.LwRND0OXoOYBV0ihH1DAoJxW6vSMeByVoI6582', 'rod@hotmail.com', '', '2016-01-11 23:58:50', '2016-01-11 23:58:50'),
(123, 1, 'Juanito', '$2y$10$W2cJbZID2Uapl8erjoZQ5ep0toXEfq4yYsYtL.Gc04T/0XLXDFHqu', 'juan@live.com', '', '2016-01-11 18:36:32', '2016-01-11 18:36:32'),
(124, 1, 'VictorXD', '$2y$10$W.5buKxONnIIlOjwFVLLhuzNe35aLh6rXTIBSEV4gNiEkr8C0g.Ay', 'vic@live.com', '', '2016-01-11 18:38:54', '2016-01-11 18:38:54'),
(125, 1, 'Arturin', '$2y$10$lKTI6urzZnWrIoaXQ0ea1Ol75sn1eNY7xH/TosFCVXkYIUT5TbQfu', 'art@hotmail.com', '', '2016-01-11 18:40:34', '2016-01-11 18:40:34'),
(126, 1, 'Luisito12', '$2y$10$gdThfmFTw6.SsSSl9PZH1uwgROWAFN96kJumORRb83x1soDudxEUG', 'luisangel@hotmail.com', 'R8MyaecEN1U4eIggj2cw3U8afXwbmNlS55410KyvMy6vtUoO1tv074MUdPF5', '2016-01-11 18:51:06', '2016-01-14 06:25:27'),
(128, 1, 'Leo99', '$2y$10$wprCLBjsDs031KDbmSmAQOmql3sCZfIoSdQX6kS9h0USqQ6H05HFW', 'leo@outlook.es', '9YSmbwyIH0XVIhxfEzEJPUvDpIhFZgMNxnuSO8wbaMLsaqt06qO9dX8utN84', '2016-01-13 05:32:08', '2016-01-14 05:58:54'),
(129, 1, 'James12', '$2y$10$Wo06s3fvBFZ1EqkrMYK5h.0hro8361HgSDPCF1tL.Tapsgcf/FDhy', 'ja@live.com', 'bfsYVwyHGA4C9nZQzQGVytOx6FHdAAhnLslZQcocX8elRkQlys5qvfiI5DZa', '2016-01-14 05:53:27', '2016-01-14 05:55:52'),
(130, 1, 'LuisMh99', '$2y$10$XC2zQk1H2YzVsTu54fdEX.9Cg1rYiGSCaXS826BzV5bX4Ef7Y45uC', 'luis_@live.com', '3Usdu484hhJlRuXJxrNm7rjOTmikUqMcWqEvFYWJI4B3gfWhdh3RLT9Elsp6', '2016-01-17 04:45:05', '2016-01-17 06:55:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_detalle`
--

CREATE TABLE IF NOT EXISTS `usuario_detalle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `usuario_detalle_usuario_id_foreign` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_nivel_descuento_id_foreign` FOREIGN KEY (`nivel_descuento_id`) REFERENCES `nivel_descuento` (`id`),
  ADD CONSTRAINT `cliente_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `cliente_forma_pago`
--
ALTER TABLE `cliente_forma_pago`
  ADD CONSTRAINT `cliente_forma_pago_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `cliente_forma_pago_forma_pago_id_foreign` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD CONSTRAINT `direccion_cliente_telefono_cliente_id_foreign` FOREIGN KEY (`telefono_cliente_id`) REFERENCES `telefono_cliente` (`id`),
  ADD CONSTRAINT `direccion_cliente_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `direccion_cliente_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `direccion_cliente_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`),
  ADD CONSTRAINT `direccion_cliente_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `direccion_proveedor`
--
ALTER TABLE `direccion_proveedor`
  ADD CONSTRAINT `direccion_proveedor_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `direccion_proveedor_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`),
  ADD CONSTRAINT `direccion_proveedor_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`),
  ADD CONSTRAINT `direccion_proveedor_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `entrada_detalle`
--
ALTER TABLE `entrada_detalle`
  ADD CONSTRAINT `entrada_detalle_entrada_id_foreign` FOREIGN KEY (`entrada_id`) REFERENCES `entrada` (`id`),
  ADD CONSTRAINT `entrada_detalle_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `familia`
--
ALTER TABLE `familia`
  ADD CONSTRAINT `familia_descuento_id_foreign` FOREIGN KEY (`descuento_id`) REFERENCES `descuento` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_forma_pago_id_foreign` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`),
  ADD CONSTRAINT `pedido_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `pedido_direccion_cliente_id_foreign` FOREIGN KEY (`direccion_cliente_id`) REFERENCES `direccion_cliente` (`id`),
  ADD CONSTRAINT `pedido_mensajeria_id_foreign` FOREIGN KEY (`mensajeria_id`) REFERENCES `mensajeria` (`id`);

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `pedido_detalle_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `pedido_detalle_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_almacen_id_foreign` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`),
  ADD CONSTRAINT `producto_familia_id_foreign` FOREIGN KEY (`familia_id`) REFERENCES `familia` (`id`),
  ADD CONSTRAINT `producto_importador_id_foreign` FOREIGN KEY (`importador_id`) REFERENCES `importador` (`id`),
  ADD CONSTRAINT `producto_unidad_medida_id_foreign` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medida` (`id`);

--
-- Filtros para la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  ADD CONSTRAINT `producto_precio_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_comercializador_id_foreign` FOREIGN KEY (`comercializador_id`) REFERENCES `comercializador` (`id`);

--
-- Filtros para la tabla `telefono_cliente`
--
ALTER TABLE `telefono_cliente`
  ADD CONSTRAINT `telefono_cliente_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `telefono_proveedor`
--
ALTER TABLE `telefono_proveedor`
  ADD CONSTRAINT `telefono_proveedor_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  ADD CONSTRAINT `usuario_detalle_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
