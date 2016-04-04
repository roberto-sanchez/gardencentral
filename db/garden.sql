-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-04-2016 a las 13:13:41
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `garden`
--
CREATE DATABASE garden;
USE garden;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE IF NOT EXISTS `alertas` (
  `id` int(11) NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(10) unsigned NOT NULL,
  `clave` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `clave`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'AC01', 'Almacen 1', 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(2, 'weeww', 'dwe', 1, '2016-03-01 18:05:12', '2016-03-01 18:05:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(10) unsigned NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `rfc`, `usuario_id`, `agente_id`, `nivel_descuento_id`, `nombre_cliente`, `paterno`, `materno`, `nombre_comercial`, `razon_social`, `numero_cliente`, `created_at`, `updated_at`) VALUES
(13, 'efrefgerg', 69, 51, 1, 'Yari', 'Jaramillo', 'Mestiza', 'Nose', 'Nose', '', '2015-12-03 00:41:02', '2015-12-03 00:41:02'),
(22, 'cupu800825569', 78, 0, 1, 'Alfonso', 'Espino', '', '', '', '', '2015-12-03 02:11:09', '2015-12-03 02:11:09'),
(23, 'melm8305281h0', 79, 0, 1, 'Ulises', 'Martinez', 'Garcia', 'Policia', 'No me la se', '', '2015-12-03 02:13:33', '2015-12-03 02:13:33'),
(24, 'LOLM9007231D9', 80, 0, 1, 'Jose Luis', 'Garfias', '', '', '', '', '2015-12-03 02:21:26', '2015-12-03 02:21:26'),
(25, 'mohl931012ooo', 81, 0, 1, 'Luis Angel', 'Mondragon', 'Herrera', 'angelmh', 'XD', '', '2015-12-03 02:34:38', '2015-12-03 02:34:38'),
(29, 'melm8305281h0', 85, 0, 1, 'Diana', 'melendez', '', '', '', '', '2015-12-04 01:46:07', '2015-12-04 01:46:07'),
(30, 'hmsl8302188h6', 86, 0, 1, 'Julia', 'Benitez', '', '', '', '', '2015-12-04 01:48:38', '2015-12-04 01:48:38'),
(33, 'melm830512ako', 89, 0, 1, 'Yatziri', 'Avilez', '', '', '', '', '2015-12-04 12:46:29', '2015-12-04 12:46:29'),
(34, 'melm8305281h0', 90, 0, 1, 'Yovanny', 'Herrera', '', '', '', '', '2015-12-04 17:47:09', '2015-12-04 17:47:09'),
(35, 'melm8305281h0', 91, 0, 1, 'Angelmon', 'Mondragon', 'Herrera', 'No se', 'No se', '', '2015-12-04 18:26:23', '2015-12-04 18:26:23'),
(46, 'edfrgthyujklo', 102, 0, 1, 'Victor', 'Acosta', '', '', '', '', '2015-12-17 06:52:09', '2015-12-17 06:52:09'),
(47, 'tghyuiolpñkjh', 103, 0, 1, 'dedede', 'dedede', 'dedede', 'dwefrg', 'rthrthtr', '', '2015-12-17 06:58:57', '2015-12-17 06:58:57'),
(50, 'melm830512ako', 106, 0, 1, 'Pedrito', 'Chavez', '', '', '', '', '2015-12-17 07:20:41', '2015-12-17 07:20:41'),
(51, 'melm830512ako', 107, 0, 1, 'Rafita', 'Chavez', '', '', '', '', '2015-12-17 07:25:32', '2015-12-17 07:25:32'),
(55, 'MELM8305281H0', 111, 0, 1, 'Pricila', 'Herrera', 'Ortega', 'No se ', 'No se', '', '2015-12-18 02:05:44', '2015-12-18 02:05:44'),
(56, 'MELM8305281H0', 112, 0, 1, 'Samuel', 'Sanchez', 'Cardozo', 'No se XD', 'No se XD', '', '2015-12-18 04:38:20', '2015-12-18 04:38:20'),
(63, 'melm8305281h0', 121, 0, 1, 'Ignacio', 'Sanchez', '', '', '', '0001', '2016-01-11 23:54:38', '2016-01-11 23:54:38'),
(64, 'MELM8305281h0', 122, 0, 1, 'Rodolfo', 'Carmona', '', '', '', '20160111021', '2016-01-11 23:58:50', '2016-01-11 23:58:50'),
(65, 'MELM8305281HO', 123, 0, 1, 'Juan Luis', 'Gomez', '', '', '', '20160111123632', '2016-01-11 18:36:32', '2016-01-11 18:36:32'),
(66, 'MELM8305281H0', 125, 0, 1, 'Arturo', 'Quiensabe', '', '', '', '20160111124034125', '2016-01-11 18:40:34', '2016-01-11 18:40:34'),
(67, 'MELM8305281H0', 126, 0, 1, 'Luis Angel', 'Mondragon ', 'Herrera', '', '', '20160111125107126', '2016-01-11 18:51:07', '2016-01-11 18:51:07'),
(68, 'melm8305281h0', 128, 27, 1, 'Leonor', 'Vallesteros', '', '', '', '20160112233209128', '2016-01-13 05:32:09', '2016-04-01 01:10:29'),
(69, 'melm8305281h0', 129, 0, 1, 'James', 'Figueroa', 'Perez', '', '', '20160113235327129', '2016-01-14 05:53:27', '2016-01-14 05:53:27'),
(70, 'MELM8305281H0', 130, 0, 1, 'Luis', 'Mondragon', 'Herrera', '', '', '20160116224505130', '2016-01-17 04:45:05', '2016-01-17 04:45:05'),
(71, 'MELM8305281H0', 131, 0, 1, 'Carmen', 'Esquivel', '', '', '', '2016012131401131', '2016-01-21 09:14:01', '2016-01-21 09:14:01'),
(72, 'MELM8305281H0', 132, 0, 1, 'Erick Alberto', 'Lopez', '', '', '', '20160121114800132', '2016-01-21 17:48:00', '2016-01-21 17:48:00'),
(73, 'MELM8305281H0', 133, 0, 1, 'Pepe', 'Pepe', 'pepe', '', '', '20160122115339133', '2016-01-22 17:53:39', '2016-01-22 17:53:39'),
(74, 'MELM8305281H0', 134, 0, 1, 'Robertiño', 'Sanches', '', '', '', '20160122202523134', '2016-01-23 02:25:23', '2016-01-23 02:25:23'),
(75, 'MELM8305281H0', 135, 92, 1, 'ChalesXD', 'Chales', '', '', '', '20160122214716135', '2016-01-23 03:47:16', '2016-01-23 03:47:16'),
(76, 'MELM8305281H0', 136, 92, 1, 'Vegeta', 'No se XD', 'No se XD', '', '', '20160122225054136', '2016-01-23 04:50:54', '2016-04-01 01:10:14'),
(77, 'MELM8305281H0', 137, 0, 1, 'Gohan', 'Sajayin', '', '', '', '20160123104955137', '2016-01-23 16:49:55', '2016-01-23 16:49:55'),
(78, 'MELM8305281H0', 138, 92, 1, 'Krilin', 'No se XD', '', '', '', '2016012402303138', '2016-01-24 06:23:03', '2016-03-29 14:13:03'),
(79, 'MELM8305281H0', 139, 0, 1, 'Yamcha', 'XDxd', 'xdxd', '', '', '20160203121641139', '2016-02-03 18:16:41', '2016-02-03 18:16:41'),
(80, 'MELM8305281H0', 140, 0, 1, 'El maestro roshi', 'Peleador', '', '', '', '20160203212306140', '2016-02-04 03:23:06', '2016-02-04 03:23:06'),
(81, 'MELM8305281H0', 141, 92, 1, 'Brolyn', 'Legendario', 'Sayayin', '', '', '20160204111517141', '2016-02-04 17:15:17', '2016-02-04 17:15:17'),
(82, 'MELM8305281H0', 142, 0, 1, 'Sepala', 'Goma', '', '', '', '20160205150009142', '2016-02-05 21:00:09', '2016-02-05 21:00:09'),
(83, 'MELM8305281H0', 143, 27, 1, 'MajinBoo', 'Malvado', '', '', '', '20160209183901143', '2016-02-10 00:39:01', '2016-02-10 00:39:01'),
(84, 'MELM8305281H0', 144, 51, 1, 'Celle', 'Destructor', 'De la maldad', '', '', '20160209185701144', '2016-02-10 00:57:01', '2016-04-01 01:11:05'),
(85, 'MELM8305281H0', 145, 0, 1, 'Frezzer', 'Malvado XD', '', '', '', '20160209213824145', '2016-02-10 03:38:24', '2016-02-10 03:38:24'),
(86, 'MELM8305281H0', 146, 108, 1, 'Yeins', 'Memes', '', '', '', '20160210214225146', '2016-02-11 03:42:25', '2016-04-02 17:46:13'),
(87, 'melm8305281h0', 147, 0, 1, 'Tapion', 'Nose XD', '', '', '', '20160214101232147', '2016-02-14 16:12:32', '2016-02-14 16:12:32'),
(88, 'melm8305281h0', 148, 0, 1, 'Naruto', 'Shippudem', '', '', '', '20160214162709148', '2016-02-14 22:27:09', '2016-02-14 22:27:09'),
(89, 'uyigiugiughiu', 149, 92, 2, 'Cliente', 'Apellido', 'Apellido2', 'Comercial', '', '20160216123159149', '2016-02-16 18:31:59', '2016-02-16 18:31:59'),
(90, 'melm8305281h0', 150, 0, 1, 'Juan', 'No se', '', '', '', '2016021752813150', '2016-02-17 11:28:13', '2016-02-17 11:28:13'),
(91, 'melm8305281h0', 151, 0, 1, 'Oviler', 'Atom', '', '', '', '20160218170555151', '2016-02-18 23:05:55', '2016-02-18 23:05:55'),
(92, 'melm8305281h0', 152, 27, 1, 'Benyi', 'Prais :p', '', 'Super Benyi', 'Portero Niupi', '20160220140001152', '2016-02-20 20:00:01', '2016-02-20 20:00:01'),
(93, 'melm8305281h0', 153, 0, 1, 'Admin XD', 'SIn apellidos', '', '', '', '20160222182129153', '2016-02-23 00:21:29', '2016-02-23 00:21:29'),
(94, 'melm8305281h0', 154, 0, 1, 'Homero', 'Simpsom', '', 'Contador', '', '20160223152914154', '2016-02-23 21:29:14', '2016-02-23 21:29:14'),
(95, 'melm8305281h0', 155, 92, 1, 'Barck', 'Simpsom', '', 'simpsom', 'Simpsom', '20160224231608155', '2016-02-25 05:16:08', '2016-02-25 05:16:08'),
(96, 'gtrgrtbgrtbrt', 156, 27, 1, 'Prueba1', 'ApPrueba', 'MaPrueba', 'CoPrueba', 'RaPrueba', '20160228145946156', '2016-02-28 20:59:46', '2016-02-28 20:59:46'),
(97, 'melm8305281h0', 157, 27, 2, 'Mayorista', 'Mayorista', '', 'Mayorista', 'Mayorista', '20160305105736157', '2016-03-05 16:57:36', '2016-03-05 16:57:36'),
(98, 'melm8305281h0', 158, 0, 3, 'Distribuidor', 'Distribuidor', '', 'Distribuidor', 'Distribuidor', '20160305105833158', '2016-03-05 16:58:33', '2016-03-05 16:58:33'),
(99, 'melm8305281h0', 159, 27, 1, 'Happyni', 'Rosita', '', '', '', '20160309201139159', '2016-03-10 02:11:39', '2016-03-10 02:11:39'),
(100, 'melm8305281h0', 160, 92, 1, 'Ejemplo1', 'Ejemplo1', '', '', '', '2016031624651160', '2016-03-16 08:46:51', '2016-03-16 08:46:51'),
(101, 'melm8305281h0', 161, 27, 1, 'Ejemplo2', 'ejemplo2', '', '', '', '2016031625216161', '2016-03-16 08:52:16', '2016-03-16 08:52:16'),
(102, 'melm8305281h0', 162, 92, 1, 'Yeins', 'Memes', '', '', '', '20160317132158162', '2016-03-17 19:21:58', '2016-04-01 01:10:47'),
(103, 'melm8305281h0', 163, 92, 1, 'Brock', 'No se', 'XDXD', '', '', '20160326143033163', '2016-03-26 20:30:33', '2016-03-29 14:15:12'),
(104, 'melm8305281h0', 164, 108, 1, 'Miau ', 'Rocket', '', '', '', '20160331135722164', '2016-03-31 19:57:22', '2016-04-02 01:49:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_forma_pago`
--

CREATE TABLE IF NOT EXISTS `cliente_forma_pago` (
  `id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `forma_pago_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente_forma_pago`
--

INSERT INTO `cliente_forma_pago` (`id`, `cliente_id`, `forma_pago_id`, `created_at`, `updated_at`) VALUES
(1, 86, 2, '2016-04-02 05:44:18', '2016-04-02 05:44:18'),
(2, 86, 2, '2016-04-02 05:49:57', '2016-04-02 05:49:57'),
(3, 86, 2, '2016-04-02 05:55:38', '2016-04-02 05:55:38'),
(4, 86, 2, '2016-04-02 06:07:53', '2016-04-02 06:07:53'),
(5, 76, 2, '2016-04-02 06:13:03', '2016-04-02 06:13:03'),
(6, 76, 2, '2016-04-02 06:16:48', '2016-04-02 06:16:48'),
(7, 68, 2, '2016-04-02 06:20:32', '2016-04-02 06:20:32'),
(8, 68, 2, '2016-04-02 06:23:05', '2016-04-02 06:23:05'),
(9, 68, 1, '2016-04-02 06:24:20', '2016-04-02 06:24:20'),
(10, 67, 2, '2016-04-02 23:39:38', '2016-04-02 23:39:38'),
(11, 67, 3, '2016-04-02 23:42:48', '2016-04-02 23:42:48'),
(12, 67, 4, '2016-04-02 23:45:40', '2016-04-02 23:45:40'),
(13, 67, 2, '2016-04-02 23:50:09', '2016-04-02 23:50:09'),
(14, 67, 2, '2016-04-02 23:54:33', '2016-04-02 23:54:33'),
(15, 67, 2, '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(16, 84, 2, '2016-04-03 00:00:25', '2016-04-03 00:00:25'),
(17, 84, 1, '2016-04-03 00:03:01', '2016-04-03 00:03:01'),
(18, 84, 3, '2016-04-03 00:06:08', '2016-04-03 00:06:08'),
(19, 79, 3, '2016-04-03 00:14:07', '2016-04-03 00:14:07'),
(20, 79, 4, '2016-04-03 00:16:28', '2016-04-03 00:16:28'),
(21, 79, 2, '2016-04-03 00:18:38', '2016-04-03 00:18:38'),
(22, 79, 1, '2016-04-03 00:23:39', '2016-04-03 00:23:39'),
(23, 84, 2, '2016-04-04 16:29:31', '2016-04-04 16:29:31'),
(24, 104, 4, '2016-04-04 16:54:22', '2016-04-04 16:54:22'),
(25, 104, 3, '2016-04-04 16:58:10', '2016-04-04 16:58:10'),
(26, 104, 3, '2016-04-04 19:50:48', '2016-04-04 19:50:48'),
(27, 104, 2, '2016-04-04 19:52:47', '2016-04-04 19:52:47'),
(28, 104, 1, '2016-04-04 19:56:48', '2016-04-04 19:56:48'),
(29, 84, 3, '2016-04-04 20:05:10', '2016-04-04 20:05:10'),
(30, 84, 4, '2016-04-04 20:06:21', '2016-04-04 20:06:21'),
(31, 104, 2, '2016-04-04 20:08:23', '2016-04-04 20:08:23'),
(32, 104, 3, '2016-04-04 20:10:47', '2016-04-04 20:10:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercializador`
--

CREATE TABLE IF NOT EXISTS `comercializador` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comercializador`
--

INSERT INTO `comercializador` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Luis', '2016-02-16 18:25:49', '2016-02-16 18:25:49'),
(2, 'Angel', '2016-02-16 06:00:00', '0000-00-00 00:00:00'),
(3, 'Hector', '2016-02-16 06:00:00', '0000-00-00 00:00:00'),
(4, 'Roberto', '2016-02-16 06:00:00', '0000-00-00 00:00:00'),
(5, 'Saul', '2016-02-16 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cron_job`
--

CREATE TABLE IF NOT EXISTS `cron_job` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `return` text COLLATE utf8_unicode_ci NOT NULL,
  `runtime` float(8,2) NOT NULL,
  `cron_manager_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cron_job`
--

INSERT INTO `cron_job` (`id`, `name`, `return`, `runtime`, `cron_manager_id`) VALUES
(1, 'example1', 'No', 0.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cron_manager`
--

CREATE TABLE IF NOT EXISTS `cron_manager` (
  `id` int(10) unsigned NOT NULL,
  `rundate` datetime NOT NULL,
  `runtime` float(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cron_manager`
--

INSERT INTO `cron_manager` (`id`, `rundate`, `runtime`) VALUES
(1, '2016-03-24 19:57:56', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE IF NOT EXISTS `descuento` (
  `id` int(10) unsigned NOT NULL,
  `familia_id` int(10) unsigned NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` double(11,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`id`, `familia_id`, `descripcion`, `descuento`, `created_at`, `fecha_inicio`, `fecha_fin`, `updated_at`, `estatus`) VALUES
(1, 1, 'Esschert Holanda', 0.30, '2015-11-30 06:00:00', '2016-03-02', '0000-00-00', '0000-00-00 00:00:00', 1),
(2, 2, 'Familia 2', 0.50, '2016-02-09 06:00:00', '2016-03-02', '0000-00-00', '0000-00-00 00:00:00', 1),
(3, 3, 'Familia 3', 0.15, '2016-03-04 06:00:00', '2016-03-04', '0000-00-00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_cliente`
--

CREATE TABLE IF NOT EXISTS `direccion_cliente` (
  `id` int(10) unsigned NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `direccion_cliente`
--

INSERT INTO `direccion_cliente` (`id`, `cliente_id`, `pais_id`, `estado_id`, `municipio_id`, `telefono_cliente_id`, `calle1`, `calle2`, `colonia`, `delegacion`, `codigo_postal`, `tipo`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 86, 1, 2, 15, 1, 'aaaaa', 'aaaaa', 'aaaa', 'aaaa', '33456', 'Fiscal', 1, '2016-04-02 05:49:57', '2016-04-02 05:49:57'),
(2, 86, 1, 3, 20, 1, 'bbbb', 'bbbbb', 'bbbbb', 'bbbbb', '44456', 'Otro', 1, '2016-04-02 05:55:38', '2016-04-02 05:55:38'),
(3, 76, 1, 3, 21, 2, 'aaaaa', 'aaaaa', 'aaaaa', 'aaaaa', '33456', 'Fiscal', 1, '2016-04-02 06:16:48', '2016-04-02 06:16:48'),
(4, 68, 1, 3, 21, 3, 'aaaa', 'aaaa', 'aaaaa', 'aaaa', '44562', 'Fiscal', 1, '2016-04-02 06:20:32', '2016-04-02 06:20:32'),
(5, 68, 1, 3, 19, 4, 'bbbbb', 'bbbb', 'bbbb', 'bbbb', '66678', 'Otro', 1, '2016-04-02 06:23:05', '2016-04-02 06:23:05'),
(6, 67, 1, 2, 14, 5, 'aaaa', 'aaaa', 'aaaaa', 'aaaa', '33345', 'Fiscal', 1, '2016-04-02 23:42:48', '2016-04-02 23:42:48'),
(7, 67, 1, 2, 16, 5, 'bbbb', 'bbbb', 'bbbb', 'bbbb', '55678', 'Otro', 1, '2016-04-02 23:50:09', '2016-04-02 23:50:09'),
(8, 67, 1, 4, 26, 5, 'vvvv', 'vvvv', 'vvvv', 'vvvv', '55678', 'Otro', 1, '2016-04-02 23:54:33', '2016-04-02 23:54:33'),
(9, 67, 1, 2, 16, 6, 'dddd', 'dddd', 'ddddd', 'ddddd', '55678', 'Otro', 1, '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(10, 84, 1, 2, 16, 7, 'aaaaa', 'aaaaa', 'aaaaa', 'aaaaa', '44567', 'Fiscal', 1, '2016-04-03 00:03:01', '2016-04-03 00:03:01'),
(11, 79, 1, 3, 21, 8, 'aaaa', 'aaaa', 'aaaaa', 'aaaa', '34561', 'Fiscal', 1, '2016-04-03 00:14:07', '2016-04-03 00:14:07'),
(12, 79, 1, 2, 16, 9, 'bbbb', 'bbbbb', 'bbbb', 'bbbb', '67553', 'Otro', 1, '2016-04-03 00:16:28', '2016-04-03 00:16:28'),
(13, 104, 1, 3, 19, 10, 'aaaa', 'aaaaa', 'aaaaa', 'aaaa', '33456', 'Fiscal', 1, '2016-04-04 16:54:21', '2016-04-04 16:54:21'),
(14, 104, 1, 4, 25, 11, 'bbbb', 'bbbbb', 'bbbbb', 'bbbbb', '55678', 'Otro', 1, '2016-04-04 19:52:47', '2016-04-04 19:52:47'),
(15, 104, 1, 2, 13, 12, 'ccccc', 'ccccc', 'cccc', 'cccc', '55678', 'Otro', 1, '2016-04-04 19:56:47', '2016-04-04 19:56:47'),
(16, 84, 1, 2, 15, 7, 'bbbbb', 'bbbb', 'bbbb', 'bbbb', '66789', 'Otro', 1, '2016-04-04 20:06:21', '2016-04-04 20:06:21'),
(17, 104, 1, 3, 21, 13, 'dddd', 'dddd', 'ddddd', 'dddd', '66778', 'Otro', 1, '2016-04-04 20:10:47', '2016-04-04 20:10:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_proveedor`
--

CREATE TABLE IF NOT EXISTS `direccion_proveedor` (
  `id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `pais_id` int(10) unsigned NOT NULL,
  `estado_id` int(10) unsigned NOT NULL,
  `municipio_id` int(10) unsigned NOT NULL,
  `telefono_proveedor` int(11) NOT NULL,
  `calle1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `calle2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `colonia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delegacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE IF NOT EXISTS `entrada` (
  `id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_entrada` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000-00-00',
  `factura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_factura` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000-00-00',
  `num_pedimento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id`, `proveedor_id`, `created_at`, `fecha_entrada`, `factura`, `fecha_factura`, `num_pedimento`, `observaciones`, `estatus`, `updated_at`) VALUES
(1, 1, '2016-04-02 04:57:09', '01/04/2016', '0012', '01/04/2016', '9912-001', 'Primera entrada.', 1, '2016-04-02 04:57:09'),
(2, 2, '2016-04-02 05:05:04', '01/04/2016', '0098', '01/04/2016', '8811-022', '', 1, '2016-04-02 05:05:04'),
(3, 2, '2016-04-02 05:14:02', '01/04/2016', '0066', '01/04/2016', '7722-088', 'Tercera entrada :)', 1, '2016-04-02 05:14:02'),
(4, 4, '2016-04-02 05:19:04', '01/04/2016', '0066', '01/04/2016', '1135-011', 'Cuarta entrada', 1, '2016-04-02 05:19:04'),
(5, 1, '2016-04-02 05:24:52', '01/04/2016', '4456', '01/04/2016', '5501-333', 'no se que comentar', 1, '2016-04-02 05:24:52'),
(6, 2, '2016-04-02 05:31:01', '01/04/2016', '8876', '01/04/2016', '002-055', 'XD', 1, '2016-04-02 05:31:01'),
(7, 1, '2016-04-02 06:31:13', '01/04/2016', '6678', '01/04/2016', '6600-331', 'Hola :)', 1, '2016-04-02 06:31:13'),
(8, 1, '2016-04-02 17:37:11', '02/04/2016', '89712', '02/04/2016', '342-0044', 'Esta es una nueva entrada.', 1, '2016-04-02 17:37:11'),
(9, 2, '2016-04-02 17:38:08', '02/04/2016', '6678', '02/04/2016', '0876-007', '', 1, '2016-04-02 17:38:08'),
(10, 4, '2016-04-02 17:39:19', '02/04/2016', '879', '02/04/2016', '199-8876', 'Una nueva entrada.', 1, '2016-04-02 17:39:19'),
(11, 3, '2016-04-02 17:40:50', '02/04/2016', '5468', '02/04/2016', '349-870', '', 1, '2016-04-02 17:40:50'),
(12, 1, '2016-04-02 22:07:34', '02/04/2016', '66789', '02/04/2016', '111-9987', '', 1, '2016-04-02 22:07:34'),
(13, 3, '2016-04-02 22:08:48', '02/04/2016', '33456', '02/04/2016', '136-876', '', 1, '2016-04-02 22:08:48'),
(14, 4, '2016-04-02 22:09:32', '02/04/2016', '6546', '02/04/2016', '870-076', '', 1, '2016-04-02 22:09:32'),
(15, 1, '2016-04-03 00:32:06', '02/04/2016', '22311', '02/04/2016', '776-987', 'Hola.', 1, '2016-04-03 00:32:06'),
(16, 2, '2016-04-03 00:34:01', '02/04/2016', '4556', '02/04/2016', '654-0087', '', 1, '2016-04-03 00:34:01'),
(17, 3, '2016-04-03 00:34:32', '02/04/2016', '6765455', '02/04/2016', '3223-96', 'Una nueva entrada.', 1, '2016-04-03 00:34:32'),
(18, 4, '2016-04-03 00:35:14', '02/04/2016', '7656', '02/04/2016', '083-0982', '', 1, '2016-04-03 00:35:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_detalle`
--

CREATE TABLE IF NOT EXISTS `entrada_detalle` (
  `id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `entrada_id` int(10) unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `precio_compra` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `entrada_detalle`
--

INSERT INTO `entrada_detalle` (`id`, `producto_id`, `entrada_id`, `cantidad`, `precio_compra`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 150, '70.00', '2016-04-02 04:57:09', '2016-04-02 04:57:09'),
(2, 7, 1, 300, '52.00', '2016-04-02 04:57:09', '2016-04-02 04:57:09'),
(3, 9, 1, 200, '130.00', '2016-04-02 04:57:09', '2016-04-02 04:57:09'),
(4, 2, 1, 400, '50.00', '2016-04-02 04:57:10', '2016-04-02 04:57:10'),
(5, 4, 1, 50, '100.00', '2016-04-02 04:57:10', '2016-04-02 04:57:10'),
(6, 11, 2, 50, '70.00', '2016-04-02 05:05:04', '2016-04-02 05:05:04'),
(7, 7, 2, 100, '52.00', '2016-04-02 05:05:04', '2016-04-02 05:05:04'),
(8, 9, 2, 200, '130.00', '2016-04-02 05:05:05', '2016-04-02 05:05:05'),
(9, 2, 2, 150, '50.00', '2016-04-02 05:05:05', '2016-04-02 05:05:05'),
(10, 4, 2, 100, '100.00', '2016-04-02 05:05:05', '2016-04-02 05:05:05'),
(11, 10, 3, 100, '60.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(12, 1, 3, 120, '55.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(13, 3, 3, 200, '80.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(14, 4, 3, 250, '45.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(15, 5, 3, 50, '70.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(16, 6, 3, 150, '75.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(17, 8, 3, 160, '85.00', '2016-04-02 05:14:03', '2016-04-02 05:14:03'),
(18, 1, 4, 60, '$80.00', '2016-04-02 05:19:04', '2016-04-02 05:19:04'),
(19, 2, 4, 250, '$90.00', '2016-04-02 05:19:04', '2016-04-02 05:19:04'),
(20, 7, 4, 150, '$68.00', '2016-04-02 05:19:04', '2016-04-02 05:19:04'),
(21, 1, 5, 170, '$80.00', '2016-04-02 05:24:53', '2016-04-02 05:24:53'),
(22, 4, 5, 20, '$120.00', '2016-04-02 05:24:53', '2016-04-02 05:24:53'),
(23, 8, 5, 140, '$108.00', '2016-04-02 05:24:53', '2016-04-02 05:24:53'),
(24, 4, 6, 120, '$120.00', '2016-04-02 05:31:01', '2016-04-02 05:31:01'),
(25, 8, 6, 40, '$108.00', '2016-04-02 05:31:01', '2016-04-02 05:31:01'),
(26, 9, 6, 200, '$120.00', '2016-04-02 05:31:02', '2016-04-02 05:31:02'),
(27, 10, 6, 150, '$60.00', '2016-04-02 05:31:02', '2016-04-02 05:31:02'),
(28, 11, 6, 600, '$75.00', '2016-04-02 05:31:02', '2016-04-02 05:31:02'),
(29, 2, 7, 18, '$90.00', '2016-04-02 06:31:13', '2016-04-02 06:31:13'),
(30, 4, 7, 40, '$120.00', '2016-04-02 06:31:13', '2016-04-02 06:31:13'),
(31, 6, 7, 35, '$95.00', '2016-04-02 06:31:13', '2016-04-02 06:31:13'),
(32, 5, 7, 7, '$79.00', '2016-04-02 06:31:13', '2016-04-02 06:31:13'),
(33, 8, 7, 11, '$108.00', '2016-04-02 06:31:13', '2016-04-02 06:31:13'),
(34, 9, 7, 100, '$120.00', '2016-04-02 06:31:13', '2016-04-02 06:31:13'),
(35, 10, 7, 20, '$60.00', '2016-04-02 06:31:14', '2016-04-02 06:31:14'),
(36, 6, 8, 50, '$95.00', '2016-04-02 17:37:11', '2016-04-02 17:37:11'),
(37, 5, 8, 40, '$79.00', '2016-04-02 17:37:11', '2016-04-02 17:37:11'),
(38, 7, 8, 20, '$68.00', '2016-04-02 17:37:11', '2016-04-02 17:37:11'),
(39, 10, 8, 70, '$60.00', '2016-04-02 17:37:11', '2016-04-02 17:37:11'),
(40, 11, 8, 40, '$75.00', '2016-04-02 17:37:11', '2016-04-02 17:37:11'),
(41, 11, 9, 50, '70.00', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(42, 7, 9, 100, '52.00', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(43, 9, 9, 200, '130.00', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(44, 2, 9, 150, '50.00', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(45, 4, 9, 100, '100.00', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(46, 10, 10, 100, '60.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(47, 1, 10, 120, '55.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(48, 3, 10, 200, '80.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(49, 4, 10, 250, '45.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(50, 5, 10, 50, '70.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(51, 6, 10, 150, '75.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(52, 8, 10, 160, '85.00', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(53, 1, 11, 48, '$80.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(54, 2, 11, 10, '$90.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(55, 3, 11, 60, '$89.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(56, 4, 11, 10, '$120.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(57, 6, 11, 60, '$95.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(58, 5, 11, 100, '$79.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(59, 7, 11, 5, '$68.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(60, 8, 11, 80, '$108.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(61, 9, 11, 100, '$120.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(62, 10, 11, 99, '$60.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(63, 11, 11, 65, '$75.00', '2016-04-02 17:40:50', '2016-04-02 17:40:50'),
(64, 11, 12, 50, '70.00', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(65, 7, 12, 100, '52.00', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(66, 9, 12, 200, '130.00', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(67, 2, 12, 150, '50.00', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(68, 4, 12, 100, '100.00', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(69, 1, 13, 300, '$80.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(70, 2, 13, 300, '$90.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(71, 3, 13, 300, '$89.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(72, 4, 13, 300, '$120.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(73, 6, 13, 300, '$95.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(74, 5, 13, 300, '$79.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(75, 7, 13, 300, '$68.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(76, 8, 13, 300, '$108.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(77, 9, 13, 300, '$120.00', '2016-04-02 22:08:48', '2016-04-02 22:08:48'),
(78, 10, 13, 300, '$60.00', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(79, 11, 13, 300, '$75.00', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(80, 1, 14, 200, '$80.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(81, 2, 14, 200, '$90.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(82, 3, 14, 200, '$89.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(83, 4, 14, 200, '$120.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(84, 6, 14, 200, '$95.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(85, 5, 14, 200, '$79.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(86, 7, 14, 200, '$68.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(87, 8, 14, 200, '$108.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(88, 9, 14, 200, '$120.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(89, 10, 14, 200, '$60.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(90, 11, 14, 200, '$75.00', '2016-04-02 22:09:32', '2016-04-02 22:09:32'),
(91, 1, 15, 60, '$80.00', '2016-04-03 00:32:06', '2016-04-03 00:32:06'),
(92, 6, 15, 80, '$95.00', '2016-04-03 00:32:06', '2016-04-03 00:32:06'),
(93, 1, 16, 100, '$80.00', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(94, 2, 16, 100, '$90.00', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(95, 5, 16, 100, '$79.00', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(96, 8, 16, 100, '$108.00', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(97, 10, 16, 100, '$60.00', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(98, 11, 17, 50, '70.00', '2016-04-03 00:34:32', '2016-04-03 00:34:32'),
(99, 7, 17, 100, '52.00', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(100, 9, 17, 200, '130.00', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(101, 2, 17, 150, '50.00', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(102, 4, 17, 100, '100.00', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(103, 10, 18, 100, '60.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(104, 1, 18, 120, '55.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(105, 3, 18, 200, '80.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(106, 4, 18, 250, '45.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(107, 5, 18, 50, '70.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(108, 6, 18, 150, '75.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(109, 8, 18, 160, '85.00', '2016-04-03 00:35:14', '2016-04-03 00:35:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(10) unsigned NOT NULL,
  `pais_id` int(10) unsigned NOT NULL,
  `estados` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Estructura de tabla para la tabla `extra_pedido`
--

CREATE TABLE IF NOT EXISTS `extra_pedido` (
  `id` int(10) unsigned NOT NULL,
  `pedido_id` int(10) unsigned NOT NULL,
  `clave` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `extra_pedido`
--

INSERT INTO `extra_pedido` (`id`, `pedido_id`, `clave`, `descripcion`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 'EX001', '1 Camión de arena.', 500, '2016-04-02 05:44:18', '2016-04-02 05:47:29'),
(2, 3, 'EX001', 'Abono para las plantas.', 300, '2016-04-02 05:55:39', '2016-04-02 05:58:21'),
(3, 5, 'EX001', 'No se que poner XD', 200, '2016-04-02 06:14:16', '2016-04-02 06:14:16'),
(4, 8, 'EX001', '1 Camión de arena.', 0, '2016-04-02 06:23:06', '2016-04-02 06:23:06'),
(5, 12, 'EX001', '1 Camión de arena.', 500, '2016-04-02 23:45:40', '2016-04-02 23:46:34'),
(6, 15, 'EX001', 'Abono para las plantas.', 0, '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(8, 16, 'EX001', 'Abono para las plantas', 599, '2016-04-03 00:09:00', '2016-04-03 00:09:00'),
(9, 22, 'EX001', 'No se que agregar', 800, '2016-04-04 16:33:10', '2016-04-04 16:33:10'),
(10, 25, 'EX001', 'Abono para las plantas.', 0, '2016-04-04 16:58:10', '2016-04-04 16:58:10'),
(11, 24, 'EX001', 'Abono para la tierra.', 800, '2016-04-04 19:05:50', '2016-04-04 19:05:50'),
(12, 28, 'EX001', '2 kilos de abono para las plantas.', 0, '2016-04-04 19:56:48', '2016-04-04 19:56:48'),
(13, 32, 'EX001', '5 Kilos de abono para las plantas.', 0, '2016-04-04 20:10:47', '2016-04-04 20:10:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE IF NOT EXISTS `familia` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Esschert Holanda', 1, '2015-11-30 06:00:00', '0000-00-00 00:00:00'),
(2, 'Familia 2', 1, '2016-02-13 06:00:00', '0000-00-00 00:00:00'),
(3, 'Familia 3', 1, '2016-02-13 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE IF NOT EXISTS `forma_pago` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Tarjeta de crédito', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Tarjeta de debito', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Efectivo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Transferencia', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importador`
--

CREATE TABLE IF NOT EXISTS `importador` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto_id`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 11, 822, '2016-04-02 04:57:09', '2016-04-04 20:08:23'),
(2, 7, 968, '2016-04-02 04:57:09', '2016-04-04 19:56:49'),
(3, 9, 1207, '2016-04-02 04:57:10', '2016-04-04 16:29:32'),
(4, 2, 1090, '2016-04-02 04:57:10', '2016-04-04 20:06:21'),
(5, 4, 1282, '2016-04-02 04:57:10', '2016-04-04 20:10:48'),
(6, 10, 920, '2016-04-02 05:14:03', '2016-04-04 16:58:11'),
(7, 1, 837, '2016-04-02 05:14:03', '2016-04-04 20:08:23'),
(8, 3, 905, '2016-04-02 05:14:03', '2016-04-04 20:10:47'),
(9, 5, 708, '2016-04-02 05:14:03', '2016-04-04 19:56:49'),
(10, 6, 1020, '2016-04-02 05:14:03', '2016-04-04 19:56:48'),
(11, 8, 873, '2016-04-02 05:14:03', '2016-04-04 19:50:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_detalle`
--

CREATE TABLE IF NOT EXISTS `inventario_detalle` (
  `id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `cantidad` double NOT NULL,
  `num_pedimento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario_detalle`
--

INSERT INTO `inventario_detalle` (`id`, `producto_id`, `cantidad`, `num_pedimento`, `created_at`, `updated_at`) VALUES
(19, 2, 12, '1135-011', '2016-04-02 05:19:04', '2016-04-04 20:06:22'),
(20, 7, 143, '1135-011', '2016-04-02 05:19:04', '2016-04-04 19:56:49'),
(28, 11, 67, '002-055', '2016-04-02 05:31:02', '2016-04-04 20:08:23'),
(29, 2, 18, '6600-331', '2016-04-02 06:31:14', '2016-04-02 06:31:14'),
(31, 6, 30, '6600-331', '2016-04-02 06:31:14', '2016-04-04 19:56:48'),
(34, 9, 7, '6600-331', '2016-04-02 06:31:14', '2016-04-04 16:29:32'),
(36, 6, 50, '342-0044', '2016-04-02 17:37:12', '2016-04-02 17:37:12'),
(38, 7, 20, '342-0044', '2016-04-02 17:37:12', '2016-04-02 17:37:12'),
(39, 10, 21, '342-0044', '2016-04-02 17:37:12', '2016-04-04 16:58:11'),
(40, 11, 40, '342-0044', '2016-04-02 17:37:12', '2016-04-02 17:37:12'),
(41, 11, 50, '0876-007', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(42, 7, 100, '0876-007', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(43, 9, 200, '0876-007', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(44, 2, 150, '0876-007', '2016-04-02 17:38:08', '2016-04-02 17:38:08'),
(45, 4, 72, '0876-007', '2016-04-02 17:38:08', '2016-04-04 20:10:48'),
(46, 10, 100, '199-8876', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(48, 3, 145, '199-8876', '2016-04-02 17:39:19', '2016-04-04 20:10:47'),
(49, 4, 250, '199-8876', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(51, 6, 150, '199-8876', '2016-04-02 17:39:19', '2016-04-02 17:39:19'),
(52, 8, 33, '199-8876', '2016-04-02 17:39:19', '2016-04-04 19:50:49'),
(54, 2, 10, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(55, 3, 60, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(56, 4, 10, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(57, 6, 60, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(58, 5, 58, '349-870', '2016-04-02 17:40:51', '2016-04-04 19:56:49'),
(59, 7, 5, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(60, 8, 80, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(61, 9, 100, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(62, 10, 99, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(63, 11, 65, '349-870', '2016-04-02 17:40:51', '2016-04-02 17:40:51'),
(64, 11, 50, '111-9987', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(65, 7, 100, '111-9987', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(66, 9, 200, '111-9987', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(67, 2, 150, '111-9987', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(68, 4, 100, '111-9987', '2016-04-02 22:07:35', '2016-04-02 22:07:35'),
(69, 1, 217, '136-876', '2016-04-02 22:08:49', '2016-04-04 20:08:23'),
(70, 2, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(71, 3, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(72, 4, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(73, 6, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(74, 5, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(75, 7, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(76, 8, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(77, 9, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(78, 10, 300, '136-876', '2016-04-02 22:08:49', '2016-04-02 22:08:49'),
(79, 11, 300, '136-876', '2016-04-02 22:08:50', '2016-04-02 22:08:50'),
(80, 1, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(81, 2, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(82, 3, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(83, 4, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(84, 6, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(85, 5, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(86, 7, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(87, 8, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(88, 9, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(89, 10, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(90, 11, 200, '870-076', '2016-04-02 22:09:33', '2016-04-02 22:09:33'),
(91, 1, 200, '776-987', '2016-04-03 00:32:06', '2016-04-03 00:33:12'),
(92, 6, 80, '776-987', '2016-04-03 00:32:06', '2016-04-03 00:32:06'),
(93, 1, 100, '654-0087', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(94, 2, 100, '654-0087', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(95, 5, 100, '654-0087', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(96, 8, 100, '654-0087', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(97, 10, 100, '654-0087', '2016-04-03 00:34:01', '2016-04-03 00:34:01'),
(98, 11, 50, '3223-96', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(99, 7, 100, '3223-96', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(100, 9, 200, '3223-96', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(101, 2, 150, '3223-96', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(102, 4, 100, '3223-96', '2016-04-03 00:34:33', '2016-04-03 00:34:33'),
(103, 10, 100, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(104, 1, 120, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(105, 3, 200, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(106, 4, 250, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(107, 5, 50, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(108, 6, 150, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14'),
(109, 8, 160, '083-0982', '2016-04-03 00:35:14', '2016-04-03 00:35:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `pedido_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus_inicial` tinyint(1) NOT NULL,
  `estatus_final` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `usuario_id`, `pedido_id`, `created_at`, `estatus_inicial`, `estatus_final`, `updated_at`) VALUES
(1, 154, 3, '2016-04-02 05:58:46', 0, 2, '2016-04-02 05:58:46'),
(2, 153, 1, '2016-04-02 06:01:08', 0, 2, '2016-04-02 06:01:08'),
(3, 153, 1, '2016-04-02 06:01:43', 2, 3, '2016-04-02 06:01:43'),
(4, 154, 5, '2016-04-02 06:15:50', 0, 1, '2016-04-02 06:15:50'),
(5, 154, 7, '2016-04-02 06:21:37', 0, 2, '2016-04-02 06:21:37'),
(6, 153, 9, '2016-04-02 06:26:08', 0, 3, '2016-04-02 06:26:08'),
(7, 153, 6, '2016-04-02 06:26:33', 0, 3, '2016-04-02 06:26:33'),
(8, 154, 12, '2016-04-02 23:47:56', 0, 1, '2016-04-02 23:47:56'),
(9, 154, 13, '2016-04-02 23:51:30', 0, 2, '2016-04-02 23:51:30'),
(10, 154, 15, '2016-04-02 23:58:07', 0, 1, '2016-04-02 23:58:07'),
(11, 27, 8, '2016-04-03 00:07:28', 0, 3, '2016-04-03 00:07:28'),
(12, 51, 18, '2016-04-03 00:08:25', 0, 3, '2016-04-03 00:08:25'),
(13, 51, 17, '2016-04-03 00:08:40', 0, 3, '2016-04-03 00:08:40'),
(14, 153, 20, '2016-04-03 00:25:50', 0, 2, '2016-04-03 00:25:50'),
(15, 153, 22, '2016-04-03 00:26:07', 0, 3, '2016-04-03 00:26:07'),
(16, 153, 19, '2016-04-03 00:26:26', 0, 1, '2016-04-03 00:26:26'),
(17, 154, 22, '2016-04-04 16:34:06', 3, 1, '2016-04-04 16:34:06'),
(18, 154, 24, '2016-04-04 19:06:06', 0, 2, '2016-04-04 19:06:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE IF NOT EXISTS `mensajeria` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mensajeria`
--

INSERT INTO `mensajeria` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Tarjeta de debito', '2016-04-02 05:44:18', '2016-04-02 05:44:18'),
(2, 'Tarjeta de debito', '2016-04-02 05:49:57', '2016-04-02 05:49:57'),
(3, 'Tarjeta de debito', '2016-04-02 05:55:38', '2016-04-02 05:55:38'),
(4, 'Tarjeta de debito', '2016-04-02 06:07:53', '2016-04-02 06:07:53'),
(5, 'Tarjeta de debito', '2016-04-02 06:13:03', '2016-04-02 06:13:03'),
(6, 'Tarjeta de debito', '2016-04-02 06:16:48', '2016-04-02 06:16:48'),
(7, 'Tarjeta de debito', '2016-04-02 06:20:32', '2016-04-02 06:20:32'),
(8, 'Tarjeta de debito', '2016-04-02 06:23:05', '2016-04-02 06:23:05'),
(9, 'Tarjeta de crédito', '2016-04-02 06:24:20', '2016-04-02 06:24:20'),
(10, 'Tarjeta de debito', '2016-04-02 23:39:38', '2016-04-02 23:39:38'),
(11, 'Efectivo', '2016-04-02 23:42:48', '2016-04-02 23:42:48'),
(12, 'Transferencia', '2016-04-02 23:45:40', '2016-04-02 23:45:40'),
(13, 'Tarjeta de debito', '2016-04-02 23:50:09', '2016-04-02 23:50:09'),
(14, 'Tarjeta de debito', '2016-04-02 23:54:33', '2016-04-02 23:54:33'),
(15, 'Tarjeta de debito', '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(16, 'Tarjeta de debito', '2016-04-03 00:00:26', '2016-04-03 00:00:26'),
(17, 'Tarjeta de crédito', '2016-04-03 00:03:01', '2016-04-03 00:03:01'),
(18, 'Efectivo', '2016-04-03 00:06:08', '2016-04-03 00:06:08'),
(19, 'Efectivo', '2016-04-03 00:14:07', '2016-04-03 00:14:07'),
(20, 'Transferencia', '2016-04-03 00:16:28', '2016-04-03 00:16:28'),
(21, 'Tarjeta de debito', '2016-04-03 00:18:38', '2016-04-03 00:18:38'),
(22, 'Tarjeta de crédito', '2016-04-03 00:23:39', '2016-04-03 00:23:39'),
(23, 'Tarjeta de debito', '2016-04-04 16:29:31', '2016-04-04 16:29:31'),
(24, 'Transferencia', '2016-04-04 16:54:22', '2016-04-04 16:54:22'),
(25, 'Efectivo', '2016-04-04 16:58:10', '2016-04-04 16:58:10'),
(26, 'Efectivo', '2016-04-04 19:50:48', '2016-04-04 19:50:48'),
(27, 'Tarjeta de debito', '2016-04-04 19:52:47', '2016-04-04 19:52:47'),
(28, 'Tarjeta de crédito', '2016-04-04 19:56:48', '2016-04-04 19:56:48'),
(29, 'Efectivo', '2016-04-04 20:05:10', '2016-04-04 20:05:10'),
(30, 'Transferencia', '2016-04-04 20:06:21', '2016-04-04 20:06:21'),
(31, 'Tarjeta de debito', '2016-04-04 20:08:23', '2016-04-04 20:08:23'),
(32, 'Efectivo', '2016-04-04 20:10:47', '2016-04-04 20:10:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `num_pedimento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_anterior` double NOT NULL,
  `cantidad_nueva` double NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `producto_id`, `usuario_id`, `num_pedimento`, `cantidad_anterior`, `cantidad_nueva`, `comentarios`, `created_at`, `updated_at`) VALUES
(1, 5, 153, '6600-331', 7, 20, 'Faltaron productos.', '2016-04-02 06:32:38', '2016-04-02 06:32:38'),
(2, 4, 153, '6600-331', 40, 65, 'Faltaron 25 productos.', '2016-04-02 17:24:07', '2016-04-02 17:24:07'),
(3, 7, 153, '9912-001', 261, 350, 'Hicieron falta 350 productos con esa clave.', '2016-04-02 17:27:23', '2016-04-02 17:27:23'),
(4, 9, 153, '6600-331', 100, 80, 'Se registraron 20 productos de mas.', '2016-04-02 17:30:46', '2016-04-02 17:30:46'),
(5, 1, 153, '776-987', 60, 200, 'Faltaron 140 productos.', '2016-04-03 00:33:11', '2016-04-03 00:33:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(10) unsigned NOT NULL,
  `estado_id` int(10) unsigned NOT NULL,
  `municipio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `nivel_descuento`
--

INSERT INTO `nivel_descuento` (`id`, `descripcion`, `descuento`, `created_at`, `updated_at`, `estatus`) VALUES
(1, 'Retail', 5, '2015-11-27 06:00:00', '0000-00-00 00:00:00', 1),
(2, 'Mayorista', 15, '2015-11-27 06:00:00', '0000-00-00 00:00:00', 1),
(3, 'Distribuidor', 30, '2015-11-27 06:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL,
  `sección` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `texto` text,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `sección`, `nombre`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(101, 'Pedidos', 'Forma de pago 2016', 'Se paga en dolares', 1, '2016-03-01 05:16:22', '2016-03-15 18:14:09'),
(122, 'Pedidos', 'Nota de pedidos', 'No ta de ejemplo.', 1, '2016-03-07 20:48:16', '2016-03-15 18:25:51'),
(134, 'Detalle del pedido', 'Detalle', 'Nota de ejemplo', 0, '2016-03-07 23:54:31', '2016-03-15 19:17:33'),
(140, 'Pedidos', 'Forma de pago', 'Seleccione la forma de pago', 1, '2016-03-15 17:53:33', '2016-03-15 19:33:01'),
(142, 'Detalle del pedido', 'Nota 1', 'Nota de ejemplo 1', 1, '2016-03-15 19:30:47', '2016-03-15 19:46:27'),
(143, 'Detalle del pedido', 'Nota 2', 'Nota de ejemplo 2', 1, '2016-03-15 19:46:51', '2016-03-15 19:46:51'),
(144, 'Detalle del pedido', ' Nota 3', 'Nota de ejemplo 3 ', 1, '2016-03-15 19:47:10', '2016-03-15 19:47:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
  `id` int(11) NOT NULL,
  `descripción` varchar(50) DEFAULT NULL,
  `texto` text,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Terminos de ejemplo 1', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.', 0, '2016-03-01 06:00:00', '0000-00-00 00:00:00'),
(2, 'Terminos de ejemplo 2', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.', 0, '2016-03-01 06:00:00', '0000-00-00 00:00:00'),
(3, 'Terminos de ejemplo 3', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.', 0, '2016-03-01 06:00:00', '0000-00-00 00:00:00'),
(4, 'Terminos de ejemplo 4', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.', 0, '2016-03-01 06:00:00', '0000-00-00 00:00:00'),
(5, 'Terminos de ejemplo 5', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.', 0, '2016-03-01 06:00:00', '0000-00-00 00:00:00'),
(6, 'Términos de ejemplo', 'Contenido de ejemplo', 0, '2016-03-02 00:21:59', '2016-03-02 06:31:34');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(9, 'Términos con imagen', '<span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center;">El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo.</span><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAVwAA/+4ADkFkb2JlAGTAAAAAAf/bAIQAAgEBAQEBAgEBAgIBAQECAwICAgIDAwICAwICAwQDAwMDAwMEBAUFBQUFBAYGBwcGBgkJCQkJCgoKCgoKCgoKCgECAgIDAwMGBAQGCQcGBwkKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoK/8AAEQgCbQH5AwERAAIRAQMRAf/EANYAAQABBAMBAQAAAAAAAAAAAAAJBQYHCAEECgMCAQEAAQUBAQEAAAAAAAAAAAAABQIDBAYHCAEJEAABAwMDAgMGAwQGBwUFBQkBAgMEAAUGEQcIIRIxEwlBUWEiFApxMhWBQlIjkaFiMyQWscFygkNTF9GSonMlY4M0JhjhwkRUdPCy0pOzZIQ1GREAAQMCBAMFBAYIBQMEAQIHAQACAxEEITESBUFRBmFxgSITkaEyB7HB0UJSFPDhYnKCIxUIkqIzQySyNBbxwlNjg0Q10uJzk7PDJf/aAAwDAQACEQMRAD8An8oiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiLB3L31KeCnA21G48r9zsX2knqa85izSJBn5LIbI1Co1lgpfmuJP8SWSn3kURaRX37rTi5mkSXG4cbK7+cwr+259NbXbJjgtuPS5neE9i5/myn2U6HXVUQke1I8aidx37bbD/ALq4jipj53taadxNV8qFaUr1/fV8v6wxg3p/ZhAVLVow5ecglNtgHwLvdZowHx1WK1eT5pdJMBJ3CHDk6v0VVQBKtfEvuPPVnxHJi9yA4KZq7gEV5TcxzFEX5N0YbQdFONB+3SWn+33AoCv4h41mwfMPpiUgMv4Kn/7Gj6SF8Ww3H/7pb0r92cgGB7w3TLuF+5TSg1Is+6llftDbcjUAoXPgqmMNDr4yFNfsra7e4inYJInB7TkWkEHuIwRb47P787IchMYGa7DZhi+9GIKUEfqeK3SFf4IWoahCn4LrqUq+BOtXkV2URKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIsP8ANjnhxb9PTZmTvpyrymHt1h8bvZt8U/4m9XW4IR3pgWmAg+ZJfV7kjRI+ZakoBUCKIi/+qN60/rVXObY/T2sqPTk4PznFxFbnZB3HLp8QK7VqhzUJWQ6odQi3N6tkFKpXtrmvWvzV2Ppuscr/AFbj/wCJlC4fvHJg7zXkCjcTgrz4u/b68HdlLodx9/W7pzd33ujxm3TJNw3XJdtduDuinXkWjzFoc1V11luPqPvry31R88epN1JZA8WsR4R/HTtkOP8Ah0q4Gc1u3am8XwuzM4/j7dvxLHrY2Go0C3oZgQmmkjRKGo8cJQkAewJrj8r3yvL5CXOOZJqT3k4lC9jeIC+Sswx8LKPPKtP3ghZSfwOlU0Vv81FzRnNbOpztQ66jTwV2kD+o618LV8F1Gsdck+IPD7mpZf0DklhmN7ultpTMafNbMa/RUueP0d0jqZlM/ghwD3g1sGwdU7vskmvb7h8XMA1af3mGrT4hVh8bjgRVaQXP7eHJuM246d/vSn30zHifu9aFF6JAvjhuVoeSk96YT86Ehta4yiNFNyY0hKh+YGu7dPf3HXsRDNztmyN4viOl3fpdVp8HNVRYtjONXr68guJu6Nq4seurhkLYa+ZStMTF98sVQqTtpenQe3uuPlFaIqvArcbICSdXGWEfNXpDpTrbaOo7cy2Euoj4mHB7f3mnEdhFQeBKoIIUrdiv1jymyRMlxmbEyPHL/GbmQLhAebmQpMOSgOMvx32ipDja0kKSpJIIOora18XboiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiLS31ifWk2M9KLbONb3443i5abpMlrAdtoC1KnS33llhqfcvJClsQku/KCB3vKHltAkKUil72saXOIAAqScAAMySijj4zelHyM5z7vteoF64V6k7rbmXdIlYxtK+vybBY7a4rzmY9wiNK8phtGo0hN+35pClrKk15Q+Zfz0fKXWOxuo3J0/E8xFyH7ef4fxKr0654KQ5eR2PGbaxjuHxY8O12dlMaKzHQmPBYYaHahphpsJASkDQAAAeyvMTnOe4ucSSTUk4knmTxKxn3TWDSwKizr1dbkf8Y+txH8APYj/ALqdBXxYb5nuzK6ugHh0r6raURc+FEQLUPjRFVLPlVxtqg2tRlRR/wANw66D+yrxFfKLIiuXM7Qv3udtlsxyc21uO0u81hte5+3WTt9lwsl4aS+0VAaIebPRbTqCdUOtKStJ6pUDWdte6Xm23Lbm0kdFK3JzTQ9x4EHiDUHiFIxytkGC0Kiz+dH26GXjc7j9MyDmL6QMu4GRle21yd+vyfCYstZLsq1yHB/LZQpfcHE9rSz8shCFlL9ezPlh85LbftNjuFIrzIHJkv7v4X82cfu1yBzaKaDizyk2P5nbEY/yQ47XyPn21O5MMSoMxn5XmnU/K/DmMk9zMlhYLbra+qVAg13VUrINESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJRFrH6tPqcbT+lRxFu3InPksZLnE9RtGDYoXhHk3vJ30FTLAI1UmOyAXZDgB7EA6arUhKiKMn0peA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', 0, '2016-03-02 00:32:59', '2016-03-02 00:32:59');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(10, 'Estos son términos', '<span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center;">El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo.</span>', 0, '2016-03-02 00:36:30', '2016-03-02 00:36:30'),
(11, 'Uno mas', '<img src="data:image/jpeg;base64,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">Este es goku XD<div>Aque es cuando era un niño :p , no tengo nada mejor que publicar xD</div>', 0, '2016-03-02 01:00:44', '2016-03-02 06:33:12');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(12, 'Términos con imagen XD', '<span style="font-weight: bold; font-style: italic;">Esta es una imagen :p</span><div><span style="font-style: italic; text-decoration: underline;">Esta misteriosa :o</span></div><div><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAVwAA/+4ADkFkb2JlAGTAAAAAAf/bAIQAAgEBAQEBAgEBAgIBAQECAwICAgIDAwICAwICAwQDAwMDAwMEBAUFBQUFBAYGBwcGBgkJCQkJCgoKCgoKCgoKCgECAgIDAwMGBAQGCQcGBwkKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoK/8AAEQgCbQH5AwERAAIRAQMRAf/EANYAAQABBAMBAQAAAAAAAAAAAAAJBQYHCAEECgMCAQEAAQUBAQEAAAAAAAAAAAAABQIDBAYHCAEJEAABAwMDAgMGAwQGBwUFBQkBAgMEAAUGEQcIIRIxEwlBUWEiFApxMhWBQlIjkaFiMyQWscFygkNTF9GSonMlY4M0JhjhwkRUdPCy0pOzZIQ1GREAAQMCBAMFBAYIBQMEAQIHAQACAxEEITESBUFRBmFxgSITkaEyB7HB0UJSFPDhYnKCIxUIkqIzQySyNBbxwlNjg0Q10uJzk7PDJf/aAAwDAQACEQMRAD8An8oiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiLB3L31KeCnA21G48r9zsX2knqa85izSJBn5LIbI1Co1lgpfmuJP8SWSn3kURaRX37rTi5mkSXG4cbK7+cwr+259NbXbJjgtuPS5neE9i5/myn2U6HXVUQke1I8aidx37bbD/ALq4jipj53taadxNV8qFaUr1/fV8v6wxg3p/ZhAVLVow5ecglNtgHwLvdZowHx1WK1eT5pdJMBJ3CHDk6v0VVQBKtfEvuPPVnxHJi9yA4KZq7gEV5TcxzFEX5N0YbQdFONB+3SWn+33AoCv4h41mwfMPpiUgMv4Kn/7Gj6SF8Ww3H/7pb0r92cgGB7w3TLuF+5TSg1Is+6llftDbcjUAoXPgqmMNDr4yFNfsra7e4inYJInB7TkWkEHuIwRb47P787IchMYGa7DZhi+9GIKUEfqeK3SFf4IWoahCn4LrqUq+BOtXkV2URKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIsP8ANjnhxb9PTZmTvpyrymHt1h8bvZt8U/4m9XW4IR3pgWmAg+ZJfV7kjRI+ZakoBUCKIi/+qN60/rVXObY/T2sqPTk4PznFxFbnZB3HLp8QK7VqhzUJWQ6odQi3N6tkFKpXtrmvWvzV2Ppuscr/AFbj/wCJlC4fvHJg7zXkCjcTgrz4u/b68HdlLodx9/W7pzd33ujxm3TJNw3XJdtduDuinXkWjzFoc1V11luPqPvry31R88epN1JZA8WsR4R/HTtkOP8Ah0q4Gc1u3am8XwuzM4/j7dvxLHrY2Go0C3oZgQmmkjRKGo8cJQkAewJrj8r3yvL5CXOOZJqT3k4lC9jeIC+Sswx8LKPPKtP3ghZSfwOlU0Vv81FzRnNbOpztQ66jTwV2kD+o618LV8F1Gsdck+IPD7mpZf0DklhmN7ultpTMafNbMa/RUueP0d0jqZlM/ghwD3g1sGwdU7vskmvb7h8XMA1af3mGrT4hVh8bjgRVaQXP7eHJuM246d/vSn30zHifu9aFF6JAvjhuVoeSk96YT86Ehta4yiNFNyY0hKh+YGu7dPf3HXsRDNztmyN4viOl3fpdVp8HNVRYtjONXr68guJu6Nq4seurhkLYa+ZStMTF98sVQqTtpenQe3uuPlFaIqvArcbICSdXGWEfNXpDpTrbaOo7cy2Euoj4mHB7f3mnEdhFQeBKoIIUrdiv1jymyRMlxmbEyPHL/GbmQLhAebmQpMOSgOMvx32ipDja0kKSpJIIOora18XboiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiLS31ifWk2M9KLbONb3443i5abpMlrAdtoC1KnS33llhqfcvJClsQku/KCB3vKHltAkKUil72saXOIAAqScAAMySijj4zelHyM5z7vteoF64V6k7rbmXdIlYxtK+vybBY7a4rzmY9wiNK8phtGo0hN+35pClrKk15Q+Zfz0fKXWOxuo3J0/E8xFyH7ef4fxKr0654KQ5eR2PGbaxjuHxY8O12dlMaKzHQmPBYYaHahphpsJASkDQAAAeyvMTnOe4ucSSTUk4knmTxKxn3TWDSwKizr1dbkf8Y+txH8APYj/ALqdBXxYb5nuzK6ugHh0r6raURc+FEQLUPjRFVLPlVxtqg2tRlRR/wANw66D+yrxFfKLIiuXM7Qv3udtlsxyc21uO0u81hte5+3WTt9lwsl4aS+0VAaIebPRbTqCdUOtKStJ6pUDWdte6Xm23Lbm0kdFK3JzTQ9x4EHiDUHiFIxytkGC0Kiz+dH26GXjc7j9MyDmL6QMu4GRle21yd+vyfCYstZLsq1yHB/LZQpfcHE9rSz8shCFlL9ezPlh85LbftNjuFIrzIHJkv7v4X82cfu1yBzaKaDizyk2P5nbEY/yQ47XyPn21O5MMSoMxn5XmnU/K/DmMk9zMlhYLbra+qVAg13VUrINESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJREoiURKIlESiJRFrH6tPqcbT+lRxFu3InPksZLnE9RtGDYoXhHk3vJ30FTLAI1UmOyAXZDgB7EA6arUhKiKMn0peA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', 0, '2016-03-02 01:05:26', '2016-03-02 01:05:26');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(13, 'Otra imagen', '<img src="data:image/png;base64,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5eFtv2+Q+z3Rvdp+33iL7ZsLLvxU9kwYqld13q+Wr6YnoCfVoDbvC36mBRLZvUwM+Q2Bvj5/hDvv/HfzqteeagOEPQYGZ+12cWBLts6GLd+md2t3+y86+ZU5xySisqfR+fiG7MA0/pEeUJ33qfmrn/eP9Ar1qeFf/7qzOeQZR7V7jHXafk99bn1vG6fNm/uutWGz5vqb2caL0DJ9HVF99KHN+0d6hfrUMGSHbeIQawha4bR5AM0XIbKPlX9be2J43AtOsl06du/ceq1d0rQXWWO9zZrV2sXz8U98MufsMFbHLIjaoBhr35i8suH0M85q7tGe52HPzb5G35MHrb7uJs291ly/ed0b35Jz/eehdx/kPwW33367Xam6233XadZsB8gGB3sMS7sBgg7pfdfaqNlsm52aX/7q17mExcfYhI4WQC3PrItjVv+F4puXftsWAhaA9bXtrScJNmy8cKj74pe+ajTO5d0OBeqO6h+9irWyAXuOI485trn7auu2W6/N8gC1i8IWRt7F5909d/3wwcn74590iOWfBgvtE58/kqetY8xvyD5NPdPGAfz5uuuahz3iMXaewb5PfSz9nYn6NdpDrXusvqw58aRXNP/+979zSZNYnu3wqJU/0yGWYtY8tQCAIZvi1ltva5757OOa/273HGttmPYciboBImGBkOCzduuPRfWa15+WS+ugdQ/FOATap009avpZgDJIC8FQGbi/hD239ns6rGXfez4RzkdwOPzil76yuXNgkQBL2Q7KPq1hpTnEihqj+Ne//tXuOY5rT7qx59DF0RHPP2p0/3Z3D/rcxV/MpU5irMOIaf2IWf0XisWoz5dx7vvOb+69xgbtZO/6v/R5PqTiBqlny4TDYWykXnHK63OJ41iKdihqNurLIVaNiMhWozH/yF7TAeBf8OKXtYdJ61onW8djF547Hrty21vYLj0NUuFpy773XnODZvudH26XKFl2jbx9TPa+Q7jpppuba665tvnZL37ZXPG9q5pvXHrZBF151febX/zy18211/6pufnvf885Y0R1q25eIq76/g/tvpK/Woh+NSr9XKE8HjgnwRic9tYzcsnjfRjZ5qGorEinFC4Qn8nLY6T+xJBdbUrEqW9+m+2esZtGJ9tJoaVtp2d+YrCM0qLgJV/u+rEVO+Two2yvBPg6I35a2QMXFH79m6ubz3z+kgZX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"><div>No se que es esto :)</div>', 0, '2016-03-02 01:08:01', '2016-03-02 06:32:55');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(14, 'Estas son los terminos y condiciones', '<span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center;">Lorem Ipsum es que tiene una <span style="font-weight: bold;">distribución más</span> o menos <span style="text-decoration: underline;">normal de las letras</span>, al contrario de usar textos como por ejemplo.</span><div><img src="data:image/jpeg;base64,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"></div><div><span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center;">orem Ipsum es que tiene una&nbsp;</span><span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center; font-weight: bold;">distribución más</span><span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center;">&nbsp;o menos&nbsp;</span><span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center; text-decoration: underline;">normal de las letras</span><span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: medium; line-height: normal; text-align: center;">, al contrario de usar textos como por ejemplo.</span></div>', 0, '2016-03-02 01:23:11', '2016-03-24 05:59:38');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(17, 'Términos y condiciones 2016', '<div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;Estos textos hacen parecerlo un español que se puede leer.&nbsp;</span></div><div style="text-align: center;"><hr id="null"><img src="data:image/png;base64,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5eFtv2+Q+z3Rvdp+33iL7ZsLLvxU9kwYqld13q+Wr6YnoCfVoDbvC36mBRLZvUwM+Q2Bvj5/hDvv/HfzqteeagOEPQYGZ+12cWBLts6GLd+md2t3+y86+ZU5xySisqfR+fiG7MA0/pEeUJ33qfmrn/eP9Ar1qeFf/7qzOeQZR7V7jHXafk99bn1vG6fNm/uutWGz5vqb2caL0DJ9HVF99KHN+0d6hfrUMGSHbeIQawha4bR5AM0XIbKPlX9be2J43AtOsl06du/ceq1d0rQXWWO9zZrV2sXz8U98MufsMFbHLIjaoBhr35i8suH0M85q7tGe52HPzb5G35MHrb7uJs291ly/ed0b35Jz/eehdx/kPwW33367Xam6233XadZsB8gGB3sMS7sBgg7pfdfaqNlsm52aX/7q17mExcfYhI4WQC3PrItjVv+F4puXftsWAhaA9bXtrScJNmy8cKj74pe+ajTO5d0OBeqO6h+9irWyAXuOI485trn7auu2W6/N8gC1i8IWRt7F5909d/3wwcn74590iOWfBgvtE58/kqetY8xvyD5NPdPGAfz5uuuahz3iMXaewb5PfSz9nYn6NdpDrXusvqw58aRXNP/+979zSZNYnu3wqJU/0yGWYtY8tQCAIZvi1ltva5757OOa/273HGttmPYciboBImGBkOCzduuPRfWa15+WS+ugdQ/FOATap009avpZgDJIC8FQGbi/hD239ns6rGXfez4RzkdwOPzil76yuXNgkQBL2Q7KPq1hpTnEihqj+Ne//tXuOY5rT7qx59DF0RHPP2p0/3Z3D/rcxV/MpU5irMOIaf2IWf0XisWoz5dx7vvOb+69xgbtZO/6v/R5PqTiBqlny4TDYWykXnHK63OJ41iKdihqNurLIVaNiMhWozH/yF7TAeBf8OKXtYdJ61onW8djF547Hrty21vYLj0NUuFpy773XnODZvudH26XKFl2jbx9TPa+Q7jpppuba665tvnZL37ZXPG9q5pvXHrZBF151febX/zy18211/6pufnvf885Y0R1q25eIq76/g/tvpK/Woh+NSr9XKE8HjgnwRic9tYzcsnjfRjZ5qGorEinFC4Qn8nLY6T+xJBdbUrEqW9+m+2esZtGJ9tJoaVtp2d+YrCM0qLgJV/u+rEVO+Two2yvBPg6I35a2QMXFH79m6ubz3z+kgZX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"></div><div style="text-align: center;"><hr id="null"><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</span></div>', 1, '2016-03-02 03:30:53', '2016-03-24 05:59:38'),
(18, 'Ejemplo XD', '<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</span>', 0, '2016-03-02 04:18:39', '2016-03-02 08:00:34'),
(19, 'Otro ejemplo mas :p', '<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify; font-weight: bold; font-style: italic; text-decoration: underline;">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.</span><div><div style="text-align: justify;"><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px;">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.</span></div><div><hr id="null"><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.</span></div></div>', 0, '2016-03-02 04:21:52', '2016-03-02 08:09:13');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(24, 'aaaaaaa', '<br><div><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;"><span style="font-weight: bold; font-style: italic;">Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, </span>pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.&nbsp;</span></div><div><img src="data:image/jpeg;base64,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"></div>', 0, '2016-03-02 06:40:41', '2016-03-02 08:11:18');
INSERT INTO `paginas` (`id`, `descripción`, `texto`, `estatus`, `created_at`, `updated_at`) VALUES
(34, 'assaassa', '<div><br></div><div><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;"><span style="font-weight: bold; font-style: italic;">Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto.</span>&nbsp;</span></div><div><hr id="null"></div><div><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latín, combinadas con estructuras muy útiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable. Este Lorem Ipsum generado siempre estará libre de repeticiones, humor agregado o palabras no características del lenguaje, etc.</span><img src="data:image/png;base64,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5eFtv2+Q+z3Rvdp+33iL7ZsLLvxU9kwYqld13q+Wr6YnoCfVoDbvC36mBRLZvUwM+Q2Bvj5/hDvv/HfzqteeagOEPQYGZ+12cWBLts6GLd+md2t3+y86+ZU5xySisqfR+fiG7MA0/pEeUJ33qfmrn/eP9Ar1qeFf/7qzOeQZR7V7jHXafk99bn1vG6fNm/uutWGz5vqb2caL0DJ9HVF99KHN+0d6hfrUMGSHbeIQawha4bR5AM0XIbKPlX9be2J43AtOsl06du/ceq1d0rQXWWO9zZrV2sXz8U98MufsMFbHLIjaoBhr35i8suH0M85q7tGe52HPzb5G35MHrb7uJs291ly/ed0b35Jz/eehdx/kPwW33367Xam6233XadZsB8gGB3sMS7sBgg7pfdfaqNlsm52aX/7q17mExcfYhI4WQC3PrItjVv+F4puXftsWAhaA9bXtrScJNmy8cKj74pe+ajTO5d0OBeqO6h+9irWyAXuOI485trn7auu2W6/N8gC1i8IWRt7F5909d/3wwcn74590iOWfBgvtE58/kqetY8xvyD5NPdPGAfz5uuuahz3iMXaewb5PfSz9nYn6NdpDrXusvqw58aRXNP/+979zSZNYnu3wqJU/0yGWYtY8tQCAIZvi1ltva5757OOa/273HGttmPYciboBImGBkOCzduuPRfWa15+WS+ugdQ/FOATap009avpZgDJIC8FQGbi/hD239ns6rGXfez4RzkdwOPzil76yuXNgkQBL2Q7KPq1hpTnEihqj+Ne//tXuOY5rT7qx59DF0RHPP2p0/3Z3D/rcxV/MpU5irMOIaf2IWf0XisWoz5dx7vvOb+69xgbtZO/6v/R5PqTiBqlny4TDYWykXnHK63OJ41iKdihqNurLIVaNiMhWozH/yF7TAeBf8OKXtYdJ61onW8djF547Hrty21vYLj0NUuFpy773XnODZvudH26XKFl2jbx9TPa+Q7jpppuba665tvnZL37ZXPG9q5pvXHrZBF151febX/zy18211/6pufnvf885Y0R1q25eIq76/g/tvpK/Woh+NSr9XKE8HjgnwRic9tYzcsnjfRjZ5qGorEinFC4Qn8nLY6T+xJBdbUrEqW9+m+2esZtGJ9tJoaVtp2d+YrCM0qLgJV/u+rEVO+Two2yvBPg6I35a2QMXFH79m6ubz3z+kgZX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" style="line-height: 1.42857;"></div>', 0, '2016-03-02 08:07:02', '2016-03-16 21:10:58'),
(38, ' con tabla', '<span style="font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 12.8px; line-height: normal; text-align: center;">Favor de leer con atencion nuestros terminos y condiciones... Esto es muy Importante.. Empesamos con toda la actidud XD ...</span><br><table class="table" border="1" cellspacing="1" cellpadding="1" style="width: 400px;"><tbody><tr><td>&nbsp;tr 1</td><td><span style="line-height: 22.8571px;">tr 1</span>&nbsp;</td><td>&nbsp;<span style="line-height: 22.8571px;">tr 1</span></td><td><span style="line-height: 22.8571px;">tr 1</span>&nbsp;</td><td><span style="line-height: 22.8571px;">tr 1</span>&nbsp;</td><td><span style="line-height: 22.8571px;">tr 1</span>&nbsp;</td><td><span style="line-height: 22.8571px;">tr 1</span>&nbsp;</td><td>&nbsp;<span style="line-height: 22.8571px;">tr 1</span></td></tr><tr><td>&nbsp;aaaa</td><td>&nbsp;aaaa</td><td>&nbsp;aaaa</td><td>&nbsp;aaaaa</td><td>&nbsp;aaaaa</td><td>&nbsp;aaaa</td><td>aaaaa&nbsp;</td><td>aaaaa&nbsp;</td></tr><tr><td>&nbsp;bbbbbb</td><td>&nbsp;bbbbbbb</td><td>&nbsp;bbbb</td><td>&nbsp;bbb</td><td>&nbsp;bbb</td><td>&nbsp;bbbb</td><td>&nbsp;bbbb</td><td>&nbsp;bbb</td></tr><tr><td>&nbsp;h</td><td>&nbsp;h</td><td>&nbsp;h</td><td>&nbsp;h</td><td>&nbsp;h</td><td>&nbsp;h</td><td>&nbsp;h</td><td>&nbsp;h</td></tr><tr><td>&nbsp;xxxxxxxxxxx</td><td>&nbsp;xxxx</td><td>&nbsp;xxxx</td><td>&nbsp;xxxx</td><td>&nbsp;xxxx</td><td>&nbsp;x</td><td>&nbsp;x</td><td>&nbsp;xxxxxxxxx</td></tr></tbody></table><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify; font-weight: bold; font-style: italic;">Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles,&nbsp;</span><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles.</span><div></div>', 0, '2016-03-13 01:34:37', '2016-03-16 21:09:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(10) unsigned NOT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `mensajeria_id` int(10) unsigned NOT NULL,
  `direccion_cliente_id` int(10) unsigned NOT NULL,
  `forma_pago_id` int(10) unsigned NOT NULL,
  `num_pedido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_entrega` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cotizar_envio` tinyint(1) NOT NULL,
  `extra_pedido` tinyint(1) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `mensajeria_id`, `direccion_cliente_id`, `forma_pago_id`, `num_pedido`, `total`, `fecha_registro`, `created_at`, `updated_at`, `fecha_entrega`, `cotizar_envio`, `extra_pedido`, `observaciones`, `estatus`) VALUES
(1, 86, 1, 0, 2, '20160401861', 23371.68, '2016-04-01', '2016-04-02 05:44:18', '2016-04-02 06:01:43', '0000-00-00 00:00:00', 0, 1, ' ', 3),
(2, 86, 2, 1, 2, '20160401862', 9218.4, '2016-04-01', '2016-04-02 05:49:57', '2016-04-02 05:49:57', '0000-00-00 00:00:00', 1, 0, 'Hola.!', 0),
(3, 86, 3, 2, 2, '20160401863', 33913.478, '2016-04-01', '2016-04-02 05:55:39', '2016-04-02 05:58:46', '0000-00-00 00:00:00', 1, 1, 'Hola Mundo..!', 2),
(4, 86, 4, 1, 2, '20160402486', 60800.24, '2016-04-02', '2016-04-02 06:07:53', '2016-04-02 06:07:53', '0000-00-00 00:00:00', 1, 0, ' ', 0),
(5, 76, 5, 0, 2, '20160402765', 4629.154, '2016-04-02', '2016-04-02 06:13:03', '2016-04-02 06:15:50', '0000-00-00 00:00:00', 0, 1, ' ', 1),
(6, 76, 6, 3, 2, '20160402766', 15718.928, '2016-04-02', '2016-04-02 06:16:48', '2016-04-02 06:26:33', '0000-00-00 00:00:00', 1, 0, ':)', 3),
(7, 68, 7, 4, 2, '20160402687', 8760.784, '2016-04-02', '2016-04-02 06:20:32', '2016-04-02 06:21:37', '0000-00-00 00:00:00', 1, 0, 'Hi.!', 2),
(8, 68, 8, 5, 2, '20160402688', 13056.96, '2016-04-02', '2016-04-02 06:23:06', '2016-04-03 00:07:28', '0000-00-00 00:00:00', 1, 1, 'No se que comentar..', 3),
(9, 68, 9, 4, 1, '20160402968', 8816, '2016-04-02', '2016-04-02 06:24:20', '2016-04-02 06:26:08', '0000-00-00 00:00:00', 1, 0, ' ', 3),
(10, 67, 10, 0, 2, '201604026710', 18274.466, '2016-04-02', '2016-04-02 23:39:38', '2016-04-02 23:39:38', '0000-00-00 00:00:00', 0, 0, ' ', 0),
(11, 67, 11, 6, 3, '201604026711', 38044, '2016-04-02', '2016-04-02 23:42:48', '2016-04-02 23:42:48', '0000-00-00 00:00:00', 1, 0, 'Hola.!', 0),
(12, 67, 12, 6, 4, '201604021267', 19489.972, '2016-04-02', '2016-04-02 23:45:40', '2016-04-02 23:47:56', '0000-00-00 00:00:00', 1, 1, ' ', 1),
(13, 67, 13, 7, 2, '201604026713', 41708.608, '2016-04-02', '2016-04-02 23:50:10', '2016-04-02 23:51:30', '0000-00-00 00:00:00', 1, 0, 'Hola Mundo..!', 2),
(14, 67, 14, 8, 2, '201604026714', 19337.306, '2016-04-02', '2016-04-02 23:54:33', '2016-04-02 23:54:33', '0000-00-00 00:00:00', 1, 0, ':)', 0),
(15, 67, 15, 9, 2, '201604026715', 14790.928, '2016-04-02', '2016-04-02 23:57:23', '2016-04-02 23:58:07', '0000-00-00 00:00:00', 1, 1, 'XD', 1),
(16, 84, 16, 0, 2, '201604028416', 28364.03, '2016-04-02', '2016-04-03 00:00:26', '2016-04-03 00:09:00', '0000-00-00 00:00:00', 0, 1, ' ', 0),
(17, 84, 17, 10, 1, '201604028417', 18914, '2016-04-02', '2016-04-03 00:03:01', '2016-04-03 00:09:48', '0000-00-00 00:00:00', 1, 0, 'Hola.!', 3),
(18, 84, 18, 10, 3, '201604021884', 18935.79, '2016-04-02', '2016-04-03 00:06:08', '2016-04-03 00:08:25', '0000-00-00 00:00:00', 1, 0, ' ', 3),
(19, 79, 19, 11, 3, '201604027919', 33436.16, '2016-04-02', '2016-04-03 00:14:07', '2016-04-03 00:26:26', '0000-00-00 00:00:00', 1, 0, 'Sin comentarios..', 1),
(20, 79, 20, 12, 4, '201604027920', 19539.04, '2016-04-02', '2016-04-03 00:16:28', '2016-04-03 00:25:50', '0000-00-00 00:00:00', 1, 0, 'XD', 2),
(21, 79, 21, 11, 2, '201604022179', 3545.5, '2016-04-02', '2016-04-03 00:18:38', '2016-04-03 00:18:38', '0000-00-00 00:00:00', 1, 0, ' ', 0),
(22, 79, 22, 11, 1, '201604022279', 3168.018, '2016-04-02', '2016-04-03 00:23:39', '2016-04-04 16:34:06', '0000-00-00 00:00:00', 1, 1, ' ', 1),
(23, 84, 23, 0, 2, '201604048423', 2850.72, '2016-04-04', '2016-04-04 16:29:31', '2016-04-04 16:29:31', '0000-00-00 00:00:00', 0, 0, ' ', 0),
(24, 104, 24, 13, 4, '2016040410424', 2038.7, '2016-04-04', '2016-04-04 16:54:22', '2016-04-04 19:06:06', '0000-00-00 00:00:00', 1, 1, 'No se que comentar..', 2),
(25, 104, 25, 0, 3, '2016040410425', 6092.1, '2016-04-04', '2016-04-04 16:58:10', '2016-04-04 16:58:10', '0000-00-00 00:00:00', 0, 1, ' ', 0),
(26, 104, 26, 0, 3, '2016040410426', 600.88, '2016-04-04', '2016-04-04 19:50:48', '2016-04-04 19:50:48', '0000-00-00 00:00:00', 0, 0, ' ', 0),
(27, 104, 27, 14, 2, '2016040410427', 4612.9, '2016-04-04', '2016-04-04 19:52:47', '2016-04-04 19:52:47', '0000-00-00 00:00:00', 1, 0, 'Hola.!', 0),
(28, 104, 28, 15, 1, '2016040410428', 23009.76, '2016-04-04', '2016-04-04 19:56:48', '2016-04-04 19:56:48', '0000-00-00 00:00:00', 1, 1, '', 0),
(29, 84, 29, 0, 3, '201604048429', 584.64, '2016-04-04', '2016-04-04 20:05:10', '2016-04-04 20:05:10', '0000-00-00 00:00:00', 0, 0, ' ', 0),
(30, 84, 30, 16, 4, '201604048430', 829.4, '2016-04-04', '2016-04-04 20:06:21', '2016-04-04 20:06:21', '0000-00-00 00:00:00', 1, 0, 'Hola.!', 0),
(31, 104, 31, 0, 2, '2016040410431', 3177.58, '2016-04-04', '2016-04-04 20:08:23', '2016-04-04 20:08:23', '0000-00-00 00:00:00', 0, 0, ' ', 0),
(32, 104, 32, 17, 3, '2016040410432', 12838.184, '2016-04-04', '2016-04-04 20:10:47', '2016-04-04 20:10:47', '0000-00-00 00:00:00', 1, 1, 'Hola.!', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE IF NOT EXISTS `pedido_detalle` (
  `id` int(10) unsigned NOT NULL,
  `pedido_id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `producto_precio_id` int(10) unsigned NOT NULL,
  `precio` double NOT NULL,
  `num_pedimento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id`, `pedido_id`, `producto_id`, `producto_precio_id`, `precio`, `num_pedimento`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 32, 84, '7722-088', 22, '2016-04-02 05:44:18', '2016-04-02 05:44:18'),
(2, 1, 2, 33, 65, '9912-001', 60, '2016-04-02 05:44:19', '2016-04-02 05:44:19'),
(3, 1, 4, 35, 80, '9912-001', 40, '2016-04-02 05:44:19', '2016-04-02 05:44:19'),
(4, 1, 9, 40, 112, '9912-001', 100, '2016-04-02 05:44:19', '2016-04-02 05:44:19'),
(5, 2, 6, 37, 94.5, '7722-088', 40, '2016-04-02 05:49:57', '2016-04-02 05:49:57'),
(6, 2, 10, 65, 70, '7722-088', 20, '2016-04-02 05:49:58', '2016-04-02 05:49:58'),
(7, 2, 8, 39, 74, '7722-088', 40, '2016-04-02 05:49:58', '2016-04-02 05:49:58'),
(8, 3, 2, 33, 65, '9912-001', 40, '2016-04-02 05:55:39', '2016-04-02 05:55:39'),
(9, 3, 11, 66, 80.5, '9912-001', 100, '2016-04-02 05:55:39', '2016-04-02 05:55:39'),
(10, 3, 7, 38, 91.8, '9912-001', 33, '2016-04-02 05:55:39', '2016-04-02 05:55:39'),
(11, 3, 9, 40, 112, '9912-001', 70, '2016-04-02 05:55:39', '2016-04-02 05:55:39'),
(12, 3, 4, 35, 80, '9912-001', 10, '2016-04-02 05:55:40', '2016-04-02 05:55:40'),
(13, 3, 4, 35, 80, '8811-022', 50, '2016-04-02 05:55:40', '2016-04-02 05:55:40'),
(14, 3, 10, 65, 70, '7722-088', 19, '2016-04-02 05:55:40', '2016-04-02 05:55:40'),
(15, 3, 6, 37, 94.5, '7722-088', 2, '2016-04-02 05:55:40', '2016-04-02 05:55:40'),
(16, 3, 5, 36, 101.15, '7722-088', 1, '2016-04-02 05:55:40', '2016-04-02 05:55:40'),
(17, 3, 8, 39, 74, '7722-088', 35, '2016-04-02 05:55:40', '2016-04-02 05:55:40'),
(18, 4, 1, 32, 84, '7722-088', 11, '2016-04-02 06:07:54', '2016-04-02 06:07:54'),
(19, 4, 8, 39, 74, '7722-088', 45, '2016-04-02 06:07:54', '2016-04-02 06:07:54'),
(20, 4, 9, 40, 112, '9912-001', 30, '2016-04-02 06:07:54', '2016-04-02 06:07:54'),
(21, 4, 9, 40, 112, '8811-022', 200, '2016-04-02 06:07:54', '2016-04-02 06:07:54'),
(22, 4, 9, 40, 112, '002-055', 200, '2016-04-02 06:07:54', '2016-04-02 06:07:54'),
(23, 5, 1, 32, 84, '7722-088', 17, '2016-04-02 06:13:03', '2016-04-02 06:13:03'),
(24, 5, 2, 33, 65, '9912-001', 4, '2016-04-02 06:13:04', '2016-04-02 06:13:04'),
(25, 5, 3, 34, 109.65, '7722-088', 21, '2016-04-02 06:13:04', '2016-04-02 06:13:04'),
(26, 6, 7, 38, 91.8, '9912-001', 6, '2016-04-02 06:16:49', '2016-04-02 06:16:49'),
(27, 6, 2, 33, 65, '9912-001', 200, '2016-04-02 06:16:49', '2016-04-02 06:16:49'),
(28, 7, 4, 35, 80, '8811-022', 50, '2016-04-02 06:20:33', '2016-04-02 06:20:33'),
(29, 7, 4, 35, 80, '7722-088', 10, '2016-04-02 06:20:33', '2016-04-02 06:20:33'),
(30, 7, 5, 36, 101.15, '7722-088', 16, '2016-04-02 06:20:33', '2016-04-02 06:20:33'),
(31, 7, 6, 37, 94.5, '7722-088', 12, '2016-04-02 06:20:33', '2016-04-02 06:20:33'),
(32, 8, 1, 32, 84, '7722-088', 70, '2016-04-02 06:23:06', '2016-04-02 06:23:06'),
(33, 8, 1, 32, 84, '1135-011', 60, '2016-04-02 06:23:06', '2016-04-02 06:23:06'),
(34, 8, 1, 32, 84, '5501-333', 4, '2016-04-02 06:23:06', '2016-04-02 06:23:06'),
(35, 9, 4, 35, 80, '7722-088', 95, '2016-04-02 06:24:20', '2016-04-02 06:24:20'),
(36, 10, 1, 32, 84, '5501-333', 35, '2016-04-02 23:39:39', '2016-04-02 23:39:39'),
(37, 10, 2, 33, 65, '9912-001', 47, '2016-04-02 23:39:39', '2016-04-02 23:39:39'),
(38, 10, 3, 34, 109.65, '7722-088', 89, '2016-04-02 23:39:39', '2016-04-02 23:39:39'),
(39, 11, 7, 38, 91.8, '9912-001', 120, '2016-04-02 23:42:49', '2016-04-02 23:42:49'),
(40, 11, 8, 39, 74, '7722-088', 40, '2016-04-02 23:42:49', '2016-04-02 23:42:49'),
(41, 11, 8, 39, 74, '5501-333', 26, '2016-04-02 23:42:49', '2016-04-02 23:42:49'),
(42, 11, 10, 65, 70, '7722-088', 50, '2016-04-02 23:42:49', '2016-04-02 23:42:49'),
(43, 11, 11, 66, 80.5, '9912-001', 50, '2016-04-02 23:42:50', '2016-04-02 23:42:50'),
(44, 11, 11, 66, 80.5, '8811-022', 50, '2016-04-02 23:42:50', '2016-04-02 23:42:50'),
(45, 11, 11, 66, 80.5, '002-055', 100, '2016-04-02 23:42:50', '2016-04-02 23:42:50'),
(46, 12, 6, 37, 94.5, '7722-088', 47, '2016-04-02 23:45:40', '2016-04-02 23:45:40'),
(47, 12, 5, 36, 101.15, '7722-088', 33, '2016-04-02 23:45:40', '2016-04-02 23:45:40'),
(48, 12, 5, 36, 101.15, '6600-331', 20, '2016-04-02 23:45:41', '2016-04-02 23:45:41'),
(49, 12, 5, 36, 101.15, '342-0044', 15, '2016-04-02 23:45:41', '2016-04-02 23:45:41'),
(50, 12, 1, 32, 84, '5501-333', 8, '2016-04-02 23:45:41', '2016-04-02 23:45:41'),
(51, 12, 8, 39, 74, '5501-333', 65, '2016-04-02 23:45:41', '2016-04-02 23:45:41'),
(52, 13, 4, 35, 80, '7722-088', 145, '2016-04-02 23:50:10', '2016-04-02 23:50:10'),
(53, 13, 4, 35, 80, '5501-333', 13, '2016-04-02 23:50:10', '2016-04-02 23:50:10'),
(54, 13, 7, 38, 91.8, '9912-001', 66, '2016-04-02 23:50:10', '2016-04-02 23:50:10'),
(55, 13, 2, 33, 65, '9912-001', 49, '2016-04-02 23:50:10', '2016-04-02 23:50:10'),
(56, 13, 2, 33, 65, '8811-022', 150, '2016-04-02 23:50:11', '2016-04-02 23:50:11'),
(57, 13, 2, 33, 65, '1135-011', 21, '2016-04-02 23:50:11', '2016-04-02 23:50:11'),
(58, 13, 10, 65, 70, '7722-088', 11, '2016-04-02 23:50:11', '2016-04-02 23:50:11'),
(59, 13, 10, 65, 70, '002-055', 38, '2016-04-02 23:50:11', '2016-04-02 23:50:11'),
(60, 14, 3, 34, 109.65, '7722-088', 32, '2016-04-02 23:54:33', '2016-04-02 23:54:33'),
(61, 14, 9, 40, 112, '6600-331', 4, '2016-04-02 23:54:34', '2016-04-02 23:54:34'),
(62, 14, 11, 66, 80.5, '002-055', 104, '2016-04-02 23:54:34', '2016-04-02 23:54:34'),
(63, 14, 5, 36, 101.15, '342-0044', 7, '2016-04-02 23:54:34', '2016-04-02 23:54:34'),
(64, 14, 1, 32, 84, '5501-333', 57, '2016-04-02 23:54:35', '2016-04-02 23:54:35'),
(65, 15, 1, 32, 84, '5501-333', 4, '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(66, 15, 2, 33, 65, '1135-011', 44, '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(67, 15, 3, 34, 109.65, '7722-088', 12, '2016-04-02 23:57:24', '2016-04-02 23:57:24'),
(68, 15, 4, 35, 80, '5501-333', 7, '2016-04-02 23:57:24', '2016-04-02 23:57:24'),
(69, 15, 4, 35, 80, '002-055', 70, '2016-04-02 23:57:24', '2016-04-02 23:57:24'),
(70, 15, 6, 37, 94.5, '7722-088', 22, '2016-04-02 23:57:24', '2016-04-02 23:57:24'),
(71, 16, 8, 39, 74, '5501-333', 25, '2016-04-03 00:00:26', '2016-04-03 00:00:26'),
(72, 16, 9, 40, 112, '6600-331', 58, '2016-04-03 00:00:26', '2016-04-03 00:00:26'),
(73, 16, 7, 38, 91.8, '9912-001', 98, '2016-04-03 00:00:26', '2016-04-03 00:00:26'),
(74, 16, 5, 36, 101.15, '342-0044', 18, '2016-04-03 00:00:26', '2016-04-03 00:00:26'),
(75, 16, 5, 36, 101.15, '199-8876', 29, '2016-04-03 00:00:27', '2016-04-03 00:00:27'),
(76, 16, 6, 37, 94.5, '7722-088', 11, '2016-04-03 00:00:27', '2016-04-03 00:00:27'),
(77, 16, 3, 34, 109.65, '7722-088', 12, '2016-04-03 00:00:27', '2016-04-03 00:00:27'),
(78, 17, 10, 65, 70, '002-055', 77, '2016-04-03 00:03:02', '2016-04-03 00:03:02'),
(79, 17, 11, 66, 80.5, '002-055', 168, '2016-04-03 00:03:02', '2016-04-03 00:03:02'),
(80, 18, 1, 32, 84, '5501-333', 36, '2016-04-03 00:06:08', '2016-04-03 00:06:08'),
(81, 18, 2, 33, 65, '1135-011', 13, '2016-04-03 00:06:08', '2016-04-03 00:06:08'),
(82, 18, 3, 34, 109.65, '7722-088', 34, '2016-04-03 00:06:08', '2016-04-03 00:06:08'),
(83, 18, 3, 34, 109.65, '199-8876', 19, '2016-04-03 00:06:08', '2016-04-03 00:06:08'),
(84, 18, 4, 35, 80, '002-055', 47, '2016-04-03 00:06:09', '2016-04-03 00:06:09'),
(85, 18, 11, 66, 80.5, '002-055', 27, '2016-04-03 00:06:09', '2016-04-03 00:06:09'),
(86, 18, 7, 38, 91.8, '9912-001', 11, '2016-04-03 00:06:09', '2016-04-03 00:06:09'),
(87, 19, 1, 32, 84, '5501-333', 26, '2016-04-03 00:14:07', '2016-04-03 00:14:07'),
(88, 19, 1, 32, 84, '199-8876', 109, '2016-04-03 00:14:07', '2016-04-03 00:14:07'),
(89, 19, 2, 33, 65, '1135-011', 134, '2016-04-03 00:14:08', '2016-04-03 00:14:08'),
(90, 19, 8, 39, 74, '5501-333', 24, '2016-04-03 00:14:08', '2016-04-03 00:14:08'),
(91, 19, 8, 39, 74, '002-055', 40, '2016-04-03 00:14:08', '2016-04-03 00:14:08'),
(92, 19, 8, 39, 74, '6600-331', 11, '2016-04-03 00:14:08', '2016-04-03 00:14:08'),
(93, 19, 8, 39, 74, '199-8876', 24, '2016-04-03 00:14:09', '2016-04-03 00:14:09'),
(94, 19, 10, 65, 70, '002-055', 24, '2016-04-03 00:14:09', '2016-04-03 00:14:09'),
(95, 20, 1, 32, 84, '199-8876', 11, '2016-04-03 00:16:29', '2016-04-03 00:16:29'),
(96, 20, 1, 32, 84, '349-870', 48, '2016-04-03 00:16:29', '2016-04-03 00:16:29'),
(97, 20, 1, 32, 84, '136-876', 64, '2016-04-03 00:16:29', '2016-04-03 00:16:29'),
(98, 20, 8, 39, 74, '199-8876', 88, '2016-04-03 00:16:29', '2016-04-03 00:16:29'),
(99, 21, 10, 65, 70, '002-055', 11, '2016-04-03 00:18:38', '2016-04-03 00:18:38'),
(100, 21, 10, 65, 70, '6600-331', 20, '2016-04-03 00:18:38', '2016-04-03 00:18:38'),
(101, 21, 10, 65, 70, '342-0044', 7, '2016-04-03 00:18:38', '2016-04-03 00:18:38'),
(102, 21, 11, 66, 80.5, '002-055', 11, '2016-04-03 00:18:39', '2016-04-03 00:18:39'),
(103, 22, 5, 36, 101.15, '199-8876', 21, '2016-04-03 00:23:39', '2016-04-03 00:23:39'),
(104, 22, 5, 36, 101.15, '349-870', 6, '2016-04-03 00:23:39', '2016-04-03 00:23:39'),
(105, 23, 9, 40, 112, '6600-331', 11, '2016-04-04 16:29:32', '2016-04-04 16:29:32'),
(106, 23, 10, 65, 70, '342-0044', 16, '2016-04-04 16:29:33', '2016-04-04 16:29:33'),
(107, 23, 2, 33, 65, '1135-011', 4, '2016-04-04 16:29:33', '2016-04-04 16:29:33'),
(108, 24, 1, 32, 84, '136-876', 6, '2016-04-04 16:54:22', '2016-04-04 16:54:22'),
(109, 24, 8, 39, 74, '199-8876', 8, '2016-04-04 16:54:23', '2016-04-04 16:54:23'),
(110, 24, 6, 37, 94.5, '7722-088', 7, '2016-04-04 16:54:24', '2016-04-04 16:54:24'),
(111, 25, 10, 65, 70, '342-0044', 26, '2016-04-04 16:58:11', '2016-04-04 16:58:11'),
(112, 25, 11, 66, 80.5, '002-055', 45, '2016-04-04 16:58:12', '2016-04-04 16:58:12'),
(113, 25, 4, 35, 80, '002-055', 3, '2016-04-04 16:58:12', '2016-04-04 16:58:12'),
(114, 25, 4, 35, 80, '6600-331', 4, '2016-04-04 16:58:12', '2016-04-04 16:58:12'),
(115, 26, 8, 39, 74, '199-8876', 7, '2016-04-04 19:50:49', '2016-04-04 19:50:49'),
(116, 27, 2, 33, 65, '1135-011', 11, '2016-04-04 19:52:48', '2016-04-04 19:52:48'),
(117, 27, 11, 66, 80.5, '002-055', 47, '2016-04-04 19:52:48', '2016-04-04 19:52:48'),
(118, 28, 6, 37, 94.5, '7722-088', 9, '2016-04-04 19:56:48', '2016-04-04 19:56:48'),
(119, 28, 6, 37, 94.5, '6600-331', 5, '2016-04-04 19:56:48', '2016-04-04 19:56:48'),
(120, 28, 7, 38, 91.8, '9912-001', 55, '2016-04-04 19:56:49', '2016-04-04 19:56:49'),
(121, 28, 7, 38, 91.8, '8811-022', 100, '2016-04-04 19:56:49', '2016-04-04 19:56:49'),
(122, 28, 7, 38, 91.8, '1135-011', 7, '2016-04-04 19:56:49', '2016-04-04 19:56:49'),
(123, 28, 5, 36, 101.15, '349-870', 36, '2016-04-04 19:56:49', '2016-04-04 19:56:49'),
(124, 29, 1, 32, 84, '136-876', 6, '2016-04-04 20:05:10', '2016-04-04 20:05:10'),
(125, 30, 2, 33, 65, '1135-011', 11, '2016-04-04 20:06:21', '2016-04-04 20:06:21'),
(126, 31, 1, 32, 84, '136-876', 7, '2016-04-04 20:08:23', '2016-04-04 20:08:23'),
(127, 31, 11, 66, 80.5, '002-055', 31, '2016-04-04 20:08:23', '2016-04-04 20:08:23'),
(128, 32, 3, 34, 109.65, '199-8876', 36, '2016-04-04 20:10:47', '2016-04-04 20:10:47'),
(129, 32, 4, 35, 80, '6600-331', 61, '2016-04-04 20:10:47', '2016-04-04 20:10:47'),
(130, 32, 4, 35, 80, '0876-007', 28, '2016-04-04 20:10:48', '2016-04-04 20:10:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE IF NOT EXISTS `precio` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(10) unsigned NOT NULL,
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
  `iva0` tinyint(1) NOT NULL,
  `cantidad_minima` int(11) NOT NULL,
  `estatus_web` tinyint(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `clave`, `numero_articulo`, `nombre`, `ean_code`, `color`, `numero_color`, `unidad_medida_id`, `piezas_paquete`, `dimensiones`, `piezas_pallet`, `total_piezas`, `foto`, `importador_id`, `almacen_id`, `familia_id`, `iva0`, `cantidad_minima`, `estatus_web`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'AC01', 'C3031', 'Maceta cerámica antiguas para plantas. Juego de 3 piezas cuadradas', '8714982046483', 'anthracit', 24, 1, 2, '260x260x395', 60, 190, 'Macetacerámicaantiguas.png', 1, 1, 1, 1, 50, 1, 1, '2016-02-05 06:00:00', '0000-00-00 00:00:00'),
(2, 'AC03', 'C3089', 'Flower pot Perla ø 11', '8590415002963', 'purple pearl', 41, 1, 32, '260x260x395', 60, 1920, 'Macetacerámicacolganteantigua.png', 2, 1, 2, 1, 50, 1, 1, '2016-02-05 06:00:00', '0000-00-00 00:00:00'),
(3, 'AC04', 'c2345', 'Maceta cerámica para pared antigua para plantas', '8590415002970', 'pearl', 54, 1, 32, '260x260x395', 60, 1920, 'Macetacerámicaparaparedantigua.png', 1, 1, 3, 1, 30, 1, 1, '2016-02-05 06:00:00', '0000-00-00 00:00:00'),
(4, 'AC10', 'C5069', 'Bebedero para pájaros cerámico con diseño decorativo antiguo  ', '5560415004470', 'pearl', 54, 1, 12, '260x260x395', 60, 1920, 'Bebederoparapájaros.png', 1, 1, 2, 1, 50, 1, 1, '2016-02-14 06:00:00', '0000-00-00 00:00:00'),
(5, 'AC134', 'C8089', 'Velas decorativas. Tamaño Grande ', '8590415002963', 'white', 23, 1, 23, '260x260x395', 60, 1920, 'velasdecorativastamanogrande.png', 1, 1, 3, 1, 40, 1, 1, '2016-02-14 06:00:00', '0000-00-00 00:00:00'),
(6, 'AC133', 'C5066', 'Velas decorativas. Tamaño Chico', '1110415002963', 'white', 23, 1, 12, '260x260x395', 60, 1920, 'VelasdecorativasChico.png', 1, 1, 1, 1, 30, 1, 1, '2016-02-14 06:00:00', '0000-00-00 00:00:00'),
(7, 'AC135', 'C7066', 'Maceta cerámica para plantas con diseño decorativo antiguo', '9910415002988', 'blue', 89, 1, 4, '260x260x395', 60, 1920, 'Macetacerámicaparaplantasdecorativoantiguo.png', 1, 1, 3, 1, 20, 1, 1, '2016-02-14 06:00:00', '0000-00-00 00:00:00'),
(8, 'AC15', 'C9056', 'Porta vela cerámica con vidrio', '8810415002976', 'white', 56, 1, 12, '260x260x395', 60, 1920, 'Portavelaceramicaconvidrio.png', 1, 1, 2, 1, 50, 1, 1, '2016-02-14 06:00:00', '0000-00-00 00:00:00'),
(9, 'AC29', 'C6032', 'Maceta cerámica rectangular para balcón con diseño decorativo antiguo', '3710415002955', 'pearl', 78, 1, 12, '260x260x395', 60, 11920, 'Macetaceramicarectangularparabalcondecorativoantiguo.png', 1, 1, 1, 1, 30, 1, 1, '2016-02-14 06:00:00', '0000-00-00 00:00:00'),
(10, 'AH001', 'C6044', 'Planta de Tomillo en maceta terracota (CH)', '3710415002999', 'grey', 47, 1, 4, '260x260x395', 60, 11920, 'PlantadeTomilloenmacetaterracota.png', 1, 1, 1, 0, 23, 1, 1, '2016-02-23 06:00:00', '0000-00-00 00:00:00'),
(11, 'AH003', 'C6088', 'Planta de Menta en maceta terracota (CH)', '3710415002761', 'grey', 47, 1, 2, '260x260x395', 60, 11920, 'PlantadeMentaenmacetaterracota(CH).png', 1, 1, 1, 0, 70, 1, 1, '2016-02-23 06:00:00', '0000-00-00 00:00:00'),
(12, 'EX001', 'EX066', 'Extras', '4560415002777', '', 0, 0, 0, '', 0, 0, '', 0, 0, 0, 1, 0, 1, 1, '2016-03-21 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio`
--

CREATE TABLE IF NOT EXISTS `producto_precio` (
  `id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `precio` double NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `moneda` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vigencia` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto_precio`
--

INSERT INTO `producto_precio` (`id`, `producto_id`, `precio`, `tipo`, `moneda`, `vigencia`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 80, 0, '$', '2015-11-30 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(2, 2, 90, 0, '$', '2015-11-30 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(3, 3, 89, 0, '$', '2015-12-08 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(5, 4, 120, 0, '$', '2015-12-08 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(6, 5, 79, 0, '$', '2015-12-08 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(7, 6, 95, 0, '$', '2016-02-14 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(8, 7, 68, 0, '$', '2016-02-14 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(9, 8, 108, 0, '$', '2016-02-14 06:00:00', 1, '2016-03-16 06:00:00', '0000-00-00 00:00:00'),
(31, 9, 120, 0, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 120, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 2, 130, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 3, 129, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 4, 160, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 5, 119, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 6, 135, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 7, 108, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 8, 148, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 9, 160, 1, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, 110, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 2, 120, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 3, 119, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 4, 150, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 5, 109, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 6, 125, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 7, 98, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 8, 138, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 9, 150, 2, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 100, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 2, 110, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 3, 109, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 4, 140, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 5, 99, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 6, 115, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 7, 88, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 8, 128, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 9, 140, 3, '$', '2016-03-14 06:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 10, 60, 0, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(60, 11, 75, 0, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(61, 10, 80, 3, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(62, 11, 95, 3, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(63, 10, 90, 2, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(64, 11, 105, 2, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(65, 10, 100, 1, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00'),
(66, 11, 115, 1, '$', '2016-03-29 06:00:00', 1, '2016-03-29 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(10) unsigned NOT NULL,
  `comercializador_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `comercializador_id`, `nombre`, `nombre_comercial`, `razon_social`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'Proveedor 1', 'Jose 99', 'No se XD', 1, '2016-02-16 06:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Este es el proveedor 2', 'No se', 'No se', 1, '2016-02-16 06:00:00', '0000-00-00 00:00:00'),
(3, 3, 'Proveedor 3', 'aaaa', 'aaaa', 1, '2016-02-16 06:00:00', '0000-00-00 00:00:00'),
(4, 4, 'Cuarto proveedor', 'bbb', 'bbb', 1, '2016-02-16 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `telefono_cliente`
--

INSERT INTO `telefono_cliente` (`id`, `cliente_id`, `numero`, `tipo_tel`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 86, '4445567', 'Celular', 1, '2016-04-02 05:49:57', '2016-04-02 05:49:57'),
(2, 76, '222334455', 'Celular', 1, '2016-04-02 06:16:48', '2016-04-02 06:16:48'),
(3, 68, '2223344', 'Celular', 1, '2016-04-02 06:20:32', '2016-04-02 06:20:32'),
(4, 68, '5556677', 'Fijo', 1, '2016-04-02 06:23:05', '2016-04-02 06:23:05'),
(5, 67, '22233345', 'Celular', 1, '2016-04-02 23:42:48', '2016-04-02 23:42:48'),
(6, 67, '33344567', 'Fijo', 1, '2016-04-02 23:57:23', '2016-04-02 23:57:23'),
(7, 84, '1112234', 'Celular', 1, '2016-04-03 00:03:01', '2016-04-03 00:03:01'),
(8, 79, '11122345', 'Celular', 1, '2016-04-03 00:14:07', '2016-04-03 00:14:07'),
(9, 79, '4445567', 'Fijo', 1, '2016-04-03 00:16:28', '2016-04-03 00:16:28'),
(10, 104, '7861245609', 'Celular', 1, '2016-04-04 16:54:21', '2016-04-04 16:54:21'),
(11, 104, '7778889906', 'Celular', 1, '2016-04-04 19:52:47', '2016-04-04 19:52:47'),
(12, 104, '8884440011', 'Fijo', 1, '2016-04-04 19:56:47', '2016-04-04 19:56:47'),
(13, 104, '7778897', 'Otro', 1, '2016-04-04 20:10:47', '2016-04-04 20:10:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono_proveedor`
--

CREATE TABLE IF NOT EXISTS `telefono_proveedor` (
  `id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_tel` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_producto`
--

CREATE TABLE IF NOT EXISTS `total_producto` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `clave` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(10) unsigned NOT NULL,
  `rol_id` int(10) unsigned NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rol_id`, `usuario`, `password`, `email`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 1, 'angelitomh', '$2y$10$dSbYqUSQt0eO1rnJ5VpUreuyJ4pi0HoD2QE2IlmHAE9PpzdiTqc/m', 'angel@live.com', '', '2015-11-28 09:32:54', '2015-11-28 09:32:54'),
(27, 2, 'flor99', '$2y$10$B0qG1786tvDFY8uFH2rlmO.aCMM12rgQrISaZkPvHltMf5PSI1wd6', 'angeldarkkiller99@live.com', 'JJrF5Rn9YEEmXJXFxR4QEfCcsahQ4NsoMDvpwsIkV1QX2b8lclebo9OJDmA9', '2015-11-29 04:27:52', '2016-04-03 00:07:35'),
(29, 3, 'Hector', '$2y$10$NEl79X9MHHEl3PhvxOcebOqzosUySo4aXe0FcFIPhPh4MXrgYIOkO', '', 'jCoONH8zXQ9oCLV8EYOoBXM4iWDuujdNtdKmp6ZRRf7cuIhgbpSiWc61T64W', '2015-11-29 04:31:28', '2016-03-28 20:29:46'),
(51, 2, 'charly', '$2y$10$vt./IVh6CWWnxhNy8oAdQeAHhwAXxIsW48J3YclEyHqc7Kkiv9xz.', '', '8p0qbx9iXHSRMiuXXxSv48GCYaM5YaCjGCYUWLvxQJd7BFVoT3nc5Yve1bN3', '2015-11-30 02:33:31', '2016-04-03 00:09:54'),
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
(85, 1, 'Dianita1', '$2y$10$iM3A.jDhcSFQz4jUOD8ivuOf2kxySPRmbEDbR7jiRmY5nvT6mLE/u', '', '', '2015-12-04 01:46:06', '2015-12-04 01:46:06'),
(86, 1, 'Julia', '$2y$10$OWWTP8KmzErIf/VcsCjp6uutdTDqLtYkP0H4GPn12LqNJv9Ek7Qh2', '', 'hN9UUYEiL1gAR2FzRlW4eooL032AOz15wNOsoH1Ivfamp46YQtwbVSyiexpg', '2015-12-04 01:48:38', '2015-12-04 01:49:00'),
(88, 1, 'Gama', '$2y$10$hOMzS1I3cmgb3VPu7YID7.GhTC/TBF3XlWdYIh8wqH7EikTXidepe', '', '', '2015-12-04 02:03:37', '2015-12-04 02:03:37'),
(89, 1, 'Yatziri', '$2y$10$9e/N6biQINZ4eJ/y2R49E.sjjEWfNjcjGyIMwytWdQMJWuqI2ylXu', '', '', '2015-12-04 12:46:29', '2015-12-04 12:46:29'),
(90, 1, 'yovamh', '$2y$10$gLZmfXsVJ.LZqyC3XZcUkuV/DaY9epcigsfWmzxbQ7cKD/8xu3aU6', 'yova@gmail.com', '', '2015-12-04 17:47:09', '2015-12-04 17:47:09'),
(91, 1, 'darkkangel', '$2y$10$2FPexXlPNTQ2onh.YPvUmujVgKpfK/FJW.9j8vonSHtuPyOB2e43i', 'angeldarkkiller99@live.com', '0DzRNEmvA1tY5FX9OfKxSWSeOedHo1OVxOJS3MPOTGjpXjKGqLpZGIel0giE', '2015-12-04 18:26:23', '2015-12-04 18:27:20'),
(92, 2, 'Adri', '$2y$10$CTCAnuFunPCfiyiuHtRPi.tUnc0TLmjYpNBIGjxXj/IdGxQ4nyIGa', 'adri@hotmail.com', 'Whr0fAq28CBN4oCQ1bZTNyWew4qzZE0lOlJ4j3lx9QEdzarHcfo2TtMfmnio', '2015-12-15 23:54:39', '2016-04-03 00:07:55'),
(93, 1, 'Luis99', '$2y$10$mVgY.RnBElSZmcBqTpMPHeG4xNt6m.eyQp.5jD5Z0LONudpT/PZ7K', 'xsxs@live.com', '', '2015-12-17 02:57:37', '2015-12-17 02:57:37'),
(95, 1, 'Luisito99', '$2y$10$h0sTinJks2X8srtsabYKFueJgMpsKcqf01wXmwqbLjjovjZlcEZNi', 'aaadda@live.com', '', '2015-12-17 03:05:29', '2015-12-17 03:05:29'),
(97, 1, 'aqaqaqsqs', '$2y$10$TQr6s9i4zMkrjjx1f94j7eB4wAo0DJiffbB7qhfCPPTr.pkyIJ9G6', '', '', '2015-12-17 04:16:00', '2015-12-17 04:16:00'),
(99, 1, 'xxxzzz', '$2y$10$EPa34z7mGD4ZhbovRt1jw.ODL4vgfgYgX8NrcP7bfGo0tZww6OG3u', 'xxxx@outlook.es', '', '2015-12-17 04:51:37', '2015-12-17 04:51:37'),
(100, 1, 'XDXDXDXD', '$2y$10$Z2dLTdqMLB.vuz/89BBKuOCZD3HvTZORNTvSi0LOksioEZ3D6nib.', 'xdxd@live.com', '', '2015-12-17 04:54:26', '2015-12-17 04:54:26'),
(101, 1, 'kiki', '$2y$10$8GGvk4GupoldRPIjI7.YXu5VUy/TzfWWPUguTCoskwC6ZtxIZD93u', 'kiki@live.com', '', '2015-12-17 06:31:47', '2015-12-17 06:31:47'),
(102, 1, 'Vic33', '$2y$10$qlP8qP4qGlDZK4MOK0MQgOXP8YssnCzG6fJ9OdLrw2EF9zyi8Mote', 'vic@hotmail.com', '', '2015-12-17 06:52:09', '2015-12-17 06:52:09'),
(103, 1, 'dededededdde', '$2y$10$HIFjcGjsbSZfDX16akcuK.g.2E9jSTv37U4ax0H3I8AhA2mvjQb16', 'rbtrtr@live.com', '', '2015-12-17 06:58:57', '2015-12-17 06:58:57'),
(106, 1, 'pdrin89', '$2y$10$/zsgv0Z2O1CJ0.EKYK3XxubWdNf2j7KCDnLa6.j6bMAqoamK6HhLK', 'pdrin@hotmail.com', '', '2015-12-17 07:20:41', '2015-12-17 07:20:41'),
(107, 1, 'Rafin', '$2y$10$5DOA4I5sIQ64sVr9Q1REUuAKfXuBDizhOigv8HKS3d8EE5RTiZxMS', 'rafin@live.com', '', '2015-12-17 07:25:32', '2015-12-17 07:25:32'),
(108, 2, 'Jorch17', '$2y$10$PtRwpkF0q8j43c3f608y0u8Y3OUG1x4i1x/HBs44zhsRdRAnWjqvq', 'jorch@hotmail.com', 'sKR2lE6OTOSG2hRm7c2JQck2gNj6xIcpowdHjGexR6c16iujnj5MAlvghXiT', '2015-12-17 07:27:47', '2016-03-19 00:46:57'),
(109, 1, 'gkgkgk', '$2y$10$Chct6b8OOxh2cA7Fp9gL1epaN9AdP1Ca4jVHe7kG8G8APiUIaeG36', 'gkgkgk@live.com', '', '2015-12-17 07:33:49', '2015-12-17 07:33:49'),
(110, 1, 'dcsdcs', '$2y$10$OViBw3fkKDkLLxvprR/xUepD6Z8iEn9aNQvkbcfXx7h33cDI13ite', 'sxxas@live.com', '', '2015-12-17 07:35:38', '2015-12-17 07:35:38'),
(111, 1, 'Prix17', '$2y$10$LGu6imKj8.yxXGHlOSbT8u.FjnRVp2wPuw28kxbxYYMG8vjLpOfzS', 'prix@live.com', '', '2015-12-18 02:05:44', '2015-12-18 02:05:44'),
(112, 1, 'Sami12', '$2y$10$cOXbPgRG9UYSzfeVYPGZaOYxeM687TWqq02cD1ozol0F.Er4uNAIK', 'sami12@hotmail.com', 'wNjDwrxbUYYSndqjpCdc1BG7JgNGJq8cWtVqBabFLbv3taJCu3ulNHpP8IjP', '2015-12-18 04:38:19', '2015-12-22 08:02:20'),
(121, 1, 'Avioneta', '$2y$10$l8r7B6ztTAwLDjPk9cz99.l5V2fAYb5dYuMu/dlmX.qPqxyV282He', 'avion@live.com', '', '2016-01-11 23:54:38', '2016-01-11 23:54:38'),
(122, 1, 'Rodo', '$2y$10$ej0fJmSCGJP35O.LwRND0OXoOYBV0ihH1DAoJxW6vSMeByVoI6582', 'rod@hotmail.com', '', '2016-01-11 23:58:50', '2016-01-11 23:58:50'),
(123, 1, 'Juanito', '$2y$10$W2cJbZID2Uapl8erjoZQ5ep0toXEfq4yYsYtL.Gc04T/0XLXDFHqu', 'juan@live.com', '', '2016-01-11 18:36:32', '2016-01-11 18:36:32'),
(124, 1, 'VictorXD', '$2y$10$W.5buKxONnIIlOjwFVLLhuzNe35aLh6rXTIBSEV4gNiEkr8C0g.Ay', 'vic@live.com', '', '2016-01-11 18:38:54', '2016-01-11 18:38:54'),
(125, 1, 'Arturin', '$2y$10$lKTI6urzZnWrIoaXQ0ea1Ol75sn1eNY7xH/TosFCVXkYIUT5TbQfu', 'art@hotmail.com', '', '2016-01-11 18:40:34', '2016-01-11 18:40:34'),
(126, 1, 'Luisito12', '$2y$10$gdThfmFTw6.SsSSl9PZH1uwgROWAFN96kJumORRb83x1soDudxEUG', 'luisangel@hotmail.com', 'kfd5lFXvlE7JXP8jwIecPSmcelS7VfAJcpNYnjNPz7FSnBWeRZRclOFFSZrs', '2016-01-11 18:51:06', '2016-04-04 17:21:08'),
(128, 1, 'Leo99', '$2y$10$wprCLBjsDs031KDbmSmAQOmql3sCZfIoSdQX6kS9h0USqQ6H05HFW', 'leo@outlook.es', 'iPAKUdTaRu5YO0ckj2Hu6MOnD170dMNfPf1my719ne3bDt62nJrJoLBDulYm', '2016-01-13 05:32:08', '2016-04-02 06:25:10'),
(129, 1, 'James12', '$2y$10$Wo06s3fvBFZ1EqkrMYK5h.0hro8361HgSDPCF1tL.Tapsgcf/FDhy', 'ja@live.com', 'DgxeONjqDxQ7JrsLnWL0oDx4OYv6mMz8VRLaQsGAvPtsGHrKpKdSiIYouQQJ', '2016-01-14 05:53:27', '2016-01-21 09:13:04'),
(130, 1, 'LuisMh99', '$2y$10$XC2zQk1H2YzVsTu54fdEX.9Cg1rYiGSCaXS826BzV5bX4Ef7Y45uC', 'luis_@live.com', 'NBlyDjUWbTpKpcIUDq8j0w9tZoD5sMesSLchf97zBtipRSYFsQfsLcmtWkWo', '2016-01-17 04:45:05', '2016-02-15 03:20:50'),
(131, 1, 'Carmen99', '$2y$10$dqeAbc/FQRG78qloEfpkaOHEKJ2RaLSsnSdXrKE8c5tsbX/Z6U/hC', 'car@live.com', 'OSE1yjQFNE4ho27Zp30Izvwqc2WbEfBcWMRBSjLSuuxVC6p4YG8PvrkGUhia', '2016-01-21 09:14:01', '2016-01-21 17:48:49'),
(132, 1, 'Er_12', '$2y$10$oI1kkkP4Y/CPuNFz6NLE/Oqw/ERtuc4bxFmJoqibu0zA52cia5GY6', 'er_@hotmail.com', 'P8jdeKUvL42TcmbRM123dojG0fX0GX42n8HZxjnoJEwwiWeQ5bqssu2PsEKo', '2016-01-21 17:47:59', '2016-01-21 19:04:31'),
(133, 1, 'Pepe99', '$2y$10$WFqEpIztHNdEusdm1hHcRe/RIav7SLBaBtIRb0kjToHiLnXDkJM1a', 'pepe@outlook.es', '', '2016-01-22 17:53:39', '2016-01-22 17:53:39'),
(134, 1, 'Rbt99', '$2y$10$MuVyAB4qqBVcMZrRpS/.euytOuKK8SwTuX6.WO1.kt99X6xkWjj0y', 'angeldarkkiller99@live.comwe', '', '2016-01-23 02:25:23', '2016-01-23 02:25:23'),
(135, 1, 'ChalesXD', '$2y$10$ysTapq4iqof6v2qUQ6vX..2hMFPwgmF1Ik3EnGKQQHSstGYOXyxBu', 'chales@live.com', '', '2016-01-23 03:47:16', '2016-01-23 03:47:16'),
(136, 1, 'Vegeta99', '$2y$10$//odMx4jVUV.q.dpD2OEyuVKAwTFqJaGf./2Rbo.Vntv9TilSOShm', 'vegeta@live.com', '7UY3D7FW1xngQcVz4vzEgJcYTz3isqyiCWDYNYxcbjESmqfSb6VbWWEAUn0W', '2016-01-23 04:50:54', '2016-04-02 06:18:08'),
(137, 1, 'Gohan99', '$2y$10$JXd5CMJL8DwcpbJwdV.4xOdAxrW3gtmpxQToEEtOius9O34GlOi4K', 'gohan@live.com', '', '2016-01-23 16:49:55', '2016-01-23 16:49:55'),
(138, 1, 'Krilin99', '$2y$10$fRzVN8KnCc5ybej0.jOi0OKXbsFXIQA8eqjYC/JyUAL4yzBeHfSyK', 'krilin@live.com', '87OVDuatnwLsckJqkjhFr0FLbE2brRlT84FMLL7JkHcWinxSCwaHshu186Tj', '2016-01-24 06:23:03', '2016-03-25 22:57:35'),
(139, 1, 'Yamcha99', '$2y$10$6SOUCV2Lw0Rr3ITw2YE9I.RzYMtCNIyzbQMz/Sd4S6vo7jhPy9sP.', 'yamcha@outlook.es', 'rZVhyTsKTAUxY3rfEhn8Md3xHTtjotFySZ9LQ9iNUojX6zP1Eero17jYo3XU', '2016-02-03 18:16:40', '2016-04-03 00:40:18'),
(140, 1, 'Roshi99', '$2y$10$kZUzXVBxvA07DnY3We0hHu1PqcHZeGRdRsCEKjR51gCOqNRHTfUKy', 'roshi@live.com', '', '2016-02-04 03:23:06', '2016-02-04 03:23:06'),
(141, 1, 'Brolyn99', '$2y$10$yszudqW67OmCIcBvKU1VTe.4Nz2qIJK/RJ8tV0n7gRq2y7TCFfT1y', 'broly@gmail.com', '6ZMucJTn9mpR5aWpO6EG56ejS9gJ2Xk32m1Wi8bTGdJtMiRAtP1xuF3fk89r', '2016-02-04 17:15:17', '2016-03-22 18:16:12'),
(142, 1, 'Sepala99', '$2y$10$hlsH6qny6Ued4cRv1ehw.eVx907B1JNaZsHvW51pxvN9x/hM/ZJve', 'sepala@live.com', 'ker3rmxq8joVCQROxIjXQ2XiYyY7wXvsN5qSeSfFPZhktcbRJaleiAzHeum0', '2016-02-05 21:00:09', '2016-02-14 17:59:32'),
(143, 1, 'MajinBoo99', '$2y$10$czkzKExdYC7uOzRm7uD6AOUuOY5ZOs5WwBqLqQV53pmMWMeef0VS.', 'majon@outlook.es', '', '2016-02-10 00:39:00', '2016-02-10 00:39:00'),
(144, 1, 'Cell99', '$2y$10$H0tBwBW/RXPa3Z5UMAHsjOLC5c8Rl/4PvTz9zkCMAwthvVFG4oV5C', 'cell@hotmail.com', 'K1dIUmr1RR3mJvAuTSHOQhDtLjJzvev17O72iMbSOGd2SAKcsTPUQKdSUxE6', '2016-02-10 00:57:01', '2016-04-04 20:06:52'),
(145, 1, 'Frezeer99', '$2y$10$52U3//Wuu/y/Dy81kk0N1eNN.TmEDkvGTnfZ6xssrMU7JAopEEpm6', 'fre@live.com', 'DXiRK88s9YT1BjnEwKqMOedty3QgoclnFEvpbR4zMgHvp0LXyxUPLXQ3dF08', '2016-02-10 03:38:24', '2016-02-14 20:36:13'),
(146, 1, 'Yeins99', '$2y$10$1LL16XJyZBN18vdM0gNMQOcbJewpaXMSFoBBKS.aseUgL/RhVUlwW', 'ye@live.com', 'ON6ccnwaQCLmk9UutkYeuuSBJO0zH7ssx5B4Xi5RW48ALyvQf5RuoljVNOZ4', '2016-02-11 03:42:25', '2016-04-04 17:16:42'),
(147, 1, 'Tapion99', '$2y$10$lIoC7p2RR4foGyCtz0vnGO.BEuIjvgLW5Ou1ELVXOwOQmLBpqjRnq', 'Tapion@live.com', 'sUvwADaRVjwAGQ6CK6aHtCpUafMAfDS0LzOtBLx3Ik67WlFlLC1GvhOhTShk', '2016-02-14 16:12:31', '2016-02-14 17:42:25'),
(148, 1, 'Naruto99', '$2y$10$VHpi/JHeOqifCET4NlanMOO1bcGHtInHpxf838NZuaLK3GybzTfE6', 'naruto@hotmail.com', 'UMyKarMzhFTDsQLqIYH3CX3japEHPVBu64XLF3p8acI0ON3VfWP09dJQ18c2', '2016-02-14 22:27:09', '2016-02-17 11:26:42'),
(149, 1, 'Mr.Satan XD', '$2y$10$wLftYS0zC08rK8TQv5p.veJlxBoI4ASWNvDHGvz9pND8FX1cJrkhC', 'cell@live.com', '', '2016-02-16 18:31:59', '2016-02-16 18:31:59'),
(150, 1, 'Chales99', '$2y$10$RoUOTYv1aHIpd05gYsZNdOu.wzyQoVEEqlWeC9pP/1ao5Q2E34vTO', 'chalesxd@live.com', 'naWr4BRwiZUNwzQ7S9m2FV5RaiFEZJeWQ8T83ul1tnp1xKMmoU7veBC2u7mm', '2016-02-17 11:28:13', '2016-02-17 11:53:12'),
(151, 1, 'Oliver99', '$2y$10$Kkkm2e0zz/fw8RMWFwOKce8f6jDssyj80ohsX8CyXjrz8q7MILrqu', 'oli@hotmail.com', 'JEfCXFjRaQeHQzEZrziDNMTFdPFyH5VDs1hDcAWSQphv8qKuta2hZZWHujIa', '2016-02-18 23:05:55', '2016-03-19 00:31:58'),
(152, 1, 'Benyi99', '$2y$10$jKnzkUVCS.qn6mPX.eJIYu3S41GRfSRiO7995gZCzPuTMyVwbwyIa', 'benyi@live.com', 'NZ9NmotsU0vNqISPCkL2xtaXga5Mzu6WssV6LpYhuK2H0w9rNYgWo4X2MScE', '2016-02-20 20:00:01', '2016-03-10 02:07:49'),
(153, 3, 'Admin99', '$2y$10$EBzhCS4J4klqv7D6kn/qOuuzlUMoB2Hy2RRykFHbHlzk.s4Ct3nZS', 'admin@outlook.es', '1zhlL6eLfZh6NUKo982DMkboN3cghIUKEdrzbYQxYt3Xwxm2gZMgv1Kft7wn', '2016-02-23 00:21:29', '2016-04-04 19:49:15'),
(154, 4, 'Homero99', '$2y$10$9zVLkLWZTOUEc5ZPOlYGROWOMbHyg03fIkPWBonVZ1NswilIBTkui', 'homero@hotmail.com', 'NfV1MZnLRowyDat28pxOaNVfuDNKP9QWdwqtNY20rgixXFwOu9CarETfYdMO', '2016-02-23 21:29:13', '2016-04-04 20:11:56'),
(155, 1, 'Barck99', '$2y$10$B8IPPEysvO14X7YwVubJ2eR/A3z5tBvUmgDqLem2l0q5ZAgLG92gq', 'barck@live.com', 'ZZ2BlVlWEIwR2DCR4lKIkD9ePzJQbJ32xCPaHZkWGvLhptjlyhGYY3akZRqg', '2016-02-25 05:16:08', '2016-04-04 17:20:30'),
(156, 1, 'Prueba99', '$2y$10$2QBGBZZPCpm3JLKv5zIzX.UfDV3utaNOCF0MhsS8ORdzBxvi1vkra', 'prueba@outlook.es', '', '2016-02-28 20:59:46', '2016-02-28 20:59:46'),
(157, 1, 'Mayorista99', '$2y$10$inONR0qzyV/P1hyfwdB1d.g/m3ZJpoRaIt1k3egq3rz8XLPzMSmaC', 'mayorista@live.com', 'ucAo20qUuU4wH52ECO8OKNBX0lpP2IMHtDc6uVCVt1poDrjoPWQUEbZ4r3b2', '2016-03-05 16:57:36', '2016-03-29 19:22:16'),
(158, 1, 'Distribuidor99', '$2y$10$azGL.hGUrSXZ.UDU9y8UnOm7m9LgbNenJf2rOxrrNifz4b4NJNQYG', 'Distribuidor@outlook.es', 'sFs3qpDfzJrKQkEA8oacxT6JXaZuckY7y3Ar3QrMzKjboU2wKpE6maB2jxxM', '2016-03-05 16:58:32', '2016-03-25 23:15:30'),
(159, 1, 'Happy99', '$2y$10$NZjCdR6juLWYCqIadohMn.MtaBQsMpHvwky7Js4OYhSheSzhktdRS', 'hapy@hotmail.com', 'HtI8VvKLtms7X09iAc6mNgz2y85A3J0eZ0UqPr7xPimuVU8sYXBEBSAoLogv', '2016-03-10 02:11:39', '2016-03-13 01:23:52'),
(160, 1, 'Ejemplo1', '$2y$10$R7HX9xixQl37rls3Uor75On2lWe0242FUG35xzDwMe69exCw1vxba', 'ejem@live.com', 'yPAQJNFpuSM2xHe8szuqg0e63nZoGzrnaTXGRasAOlnlGOosNiIlZ7GY6vUi', '2016-03-16 08:46:51', '2016-03-29 19:29:36'),
(161, 1, 'ejemplo2', '$2y$10$Bh6B0NLTkK3tUGaQQfFES.U701ukbTgPYyICXanMN4WkvB8rb5coe', 'ejem@outlook.es', 'PON3nWvqTUWwJsjqLpHaBCrycrn12LYcx5ucLsC6LKWNFmdkQhwXdIgZ5tLH', '2016-03-16 08:52:16', '2016-03-16 09:30:29'),
(162, 1, 'Yeins999', '$2y$10$5.0Uchrai5H351M/5EIkVuYJgY1zVd4RB/cdMgFk/7lon5l/vfh2y', 'yein@hotmail.com', 'B4Gq7gWPialBctUJ3kdrFlvMU7lEuN7SRx2o6s74eDPYxbemZYcbieCIVUA0', '2016-03-17 19:21:57', '2016-03-30 03:45:22'),
(163, 1, 'Brock99', '$2y$10$cRlFFyMCBnLnF.xOU27hBuaAiRODmLN.xOCMmzg4N.SKsUd4OjWnS', 'br@gmail.com', 'qxV3Dp8zSPUNWOCIDagoyr9Bk9TjWro33c8Q6eYM1rn1J8wIyOWwn8ZLV5qR', '2016-03-26 20:30:33', '2016-03-26 21:16:03'),
(164, 1, 'Miau99', '$2y$10$ZAlQhnVCeuzhx1fwpGSKHeyQGlnGfAgJxc.jTJd.iXJest6sVoOWe', 'luis_mh@outlook.es', 'qtArzP30KBqetfayUh5E3xDYyPMr9scqn2MAoADe6CoMsMDu4YmN7U9rvxTl', '2016-03-31 19:57:22', '2016-04-04 20:11:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_detalle`
--

CREATE TABLE IF NOT EXISTS `usuario_detalle` (
  `id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alertas_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_usuario_id_foreign` (`usuario_id`),
  ADD KEY `cliente_nivel_descuento_id_foreign` (`nivel_descuento_id`);

--
-- Indices de la tabla `cliente_forma_pago`
--
ALTER TABLE `cliente_forma_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_forma_pago_cliente_id_foreign` (`cliente_id`),
  ADD KEY `cliente_forma_pago_forma_pago_id_foreign` (`forma_pago_id`);

--
-- Indices de la tabla `comercializador`
--
ALTER TABLE `comercializador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacto_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `cron_job`
--
ALTER TABLE `cron_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cron_job_name_cron_manager_id_index` (`name`,`cron_manager_id`);

--
-- Indices de la tabla `cron_manager`
--
ALTER TABLE `cron_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descuento_familia_id_foreign` (`familia_id`);

--
-- Indices de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direccion_cliente_cliente_id_foreign` (`cliente_id`),
  ADD KEY `direccion_cliente_pais_id_foreign` (`pais_id`),
  ADD KEY `direccion_cliente_estado_id_foreign` (`estado_id`),
  ADD KEY `direccion_cliente_municipio_id_foreign` (`municipio_id`),
  ADD KEY `direccion_cliente_telefono_cliente_id_foreign` (`telefono_cliente_id`);

--
-- Indices de la tabla `direccion_proveedor`
--
ALTER TABLE `direccion_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direccion_proveedor_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `direccion_proveedor_pais_id_foreign` (`pais_id`),
  ADD KEY `direccion_proveedor_estado_id_foreign` (`estado_id`),
  ADD KEY `direccion_proveedor_municipio_id_foreign` (`municipio_id`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrada_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `entrada_detalle`
--
ALTER TABLE `entrada_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrada_detalle_producto_id_foreign` (`producto_id`),
  ADD KEY `entrada_detalle_entrada_id_foreign` (`entrada_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_pais_id_foreign` (`pais_id`);

--
-- Indices de la tabla `extra_pedido`
--
ALTER TABLE `extra_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_pedido_pedido_id_foreign` (`pedido_id`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `importador`
--
ALTER TABLE `importador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventario_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `inventario_detalle`
--
ALTER TABLE `inventario_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventario_detalle_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_usuario_id_foreign` (`usuario_id`),
  ADD KEY `log_pedido_id_foreign` (`pedido_id`);

--
-- Indices de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_producto_id_foreign` (`producto_id`),
  ADD KEY `movimientos_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipio_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `nivel_descuento`
--
ALTER TABLE `nivel_descuento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reminders`
--
ALTER TABLE `password_reminders`
  ADD KEY `password_reminders_email_index` (`email`),
  ADD KEY `password_reminders_token_index` (`token`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_cliente_id_foreign` (`cliente_id`),
  ADD KEY `pedido_mensajeria_id_foreign` (`mensajeria_id`),
  ADD KEY `pedido_direccion_cliente_id_foreign` (`direccion_cliente_id`),
  ADD KEY `pedido_forma_pago_id_foreign` (`forma_pago_id`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_detalle_pedido_id_foreign` (`pedido_id`),
  ADD KEY `pedido_detalle_producto_id_foreign` (`producto_id`),
  ADD KEY `pedido_detalle_producto_precio_id_foreign` (`producto_precio_id`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_unidad_medida_id_foreign` (`unidad_medida_id`),
  ADD KEY `producto_importador_id_foreign` (`importador_id`),
  ADD KEY `producto_almacen_id_foreign` (`almacen_id`),
  ADD KEY `producto_familia_id_foreign` (`familia_id`);

--
-- Indices de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_precio_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_comercializador_id_foreign` (`comercializador_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `telefono_cliente`
--
ALTER TABLE `telefono_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefono_cliente_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `telefono_proveedor`
--
ALTER TABLE `telefono_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefono_proveedor_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `total_producto`
--
ALTER TABLE `total_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_rol_id_foreign` (`rol_id`);

--
-- Indices de la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_detalle_usuario_id_foreign` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT de la tabla `cliente_forma_pago`
--
ALTER TABLE `cliente_forma_pago`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `comercializador`
--
ALTER TABLE `comercializador`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cron_job`
--
ALTER TABLE `cron_job`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cron_manager`
--
ALTER TABLE `cron_manager`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `direccion_proveedor`
--
ALTER TABLE `direccion_proveedor`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `entrada_detalle`
--
ALTER TABLE `entrada_detalle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `extra_pedido`
--
ALTER TABLE `extra_pedido`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `importador`
--
ALTER TABLE `importador`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `inventario_detalle`
--
ALTER TABLE `inventario_detalle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `nivel_descuento`
--
ALTER TABLE `nivel_descuento`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `telefono_cliente`
--
ALTER TABLE `telefono_cliente`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `telefono_proveedor`
--
ALTER TABLE `telefono_proveedor`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `total_producto`
--
ALTER TABLE `total_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT de la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_nivel_descuento_id_foreign` FOREIGN KEY (`nivel_descuento_id`) REFERENCES `nivel_descuento` (`id`),
  ADD CONSTRAINT `cliente_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
