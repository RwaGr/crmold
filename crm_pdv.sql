-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2017 a las 22:10:14
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm_pdv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_categories`
--

CREATE TABLE `pdv_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `parent` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `commission` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_categories`
--

INSERT INTO `pdv_categories` (`id`, `name`, `description`, `type`, `parent`, `commission`) VALUES
(0, 'Sin categoria', 'CategorÃ­a por defecto del sistema.', '', '', ''),
(2, 'Software', '', '0', '0', ''),
(3, 'DTE`s', 'Documentos tributarios electronicos', '0', '0', ''),
(4, 'Equipamiento', '', '0', '0', ''),
(5, 'Insumos', '', '0', '0', ''),
(6, 'Conexiones', '', '0', '0', ''),
(8, 'Servicios', '', '0', '0', ''),
(9, 'Redes', '', '0', '0', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_companies`
--

CREATE TABLE `pdv_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `fantasy_name` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `industry` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rf` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quant_employ` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `limit_credit` double NOT NULL,
  `responsable` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `companyimg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `assignto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `addedby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `addeddate` date NOT NULL,
  `website` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_companies`
--

INSERT INTO `pdv_companies` (`id`, `name`, `fantasy_name`, `industry`, `currency`, `rf`, `quant_employ`, `notes`, `limit_credit`, `responsable`, `address`, `companyimg`, `assignto`, `addedby`, `addeddate`, `website`) VALUES
(6, 'COMERCIAL ISABEL DE LAS MERCEDES MALDONADO ROA EIRL', 'PLAN DE VENTAS', 'Asesoria, capacitaciÃ³n y gestiÃ³n empresarial', 'CHI', '76223549-8', '9', '', 2000000, '5', 'Pocuro 2378', '', '', '5', '2017-11-16', 'S/I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_contact`
--

CREATE TABLE `pdv_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `notes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `imgcontact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `addedby` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `assignto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_contact`
--

INSERT INTO `pdv_contact` (`id`, `name`, `lastname`, `sex`, `email`, `phone`, `birthday`, `notes`, `company`, `cargo`, `imgcontact`, `addedby`, `assignto`, `added_date`) VALUES
(6, 'Antonio', 'Perez', 'Hombre', 'desarrollos.pdv@gmail.com', '00-000000', '2017-11-21', '', '6', 'Gerente de Operaciones', '', '5', '', '2017-11-16'),
(7, 'Elias', 'Schotborgh', 'Hombre', 'desarrollos.pdv1@gmail.com', '00-000000', '0000-00-00', '', '6', 'Jefe', '', '5', '', '2017-11-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_cuotes`
--

CREATE TABLE `pdv_cuotes` (
  `id` int(11) NOT NULL,
  `prospect` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` date NOT NULL,
  `total` double NOT NULL,
  `succeeded` int(11) NOT NULL,
  `discountofcuote` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_cuotes`
--

INSERT INTO `pdv_cuotes` (`id`, `prospect`, `added_date`, `total`, `succeeded`, `discountofcuote`) VALUES
(12, '6', '2017-11-20', 390000, 0, 0),
(13, '6', '2017-11-20', 1190336.1, 0, 0),
(14, '10', '2017-11-23', 390000, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_guests`
--

CREATE TABLE `pdv_guests` (
  `id` int(11) NOT NULL,
  `id_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_task` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `invitationdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_guests`
--

INSERT INTO `pdv_guests` (`id`, `id_user`, `id_task`, `invitationdate`) VALUES
(6, '9', '18', '2017-11-25'),
(7, '10', '18', '2017-11-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_meta`
--

CREATE TABLE `pdv_meta` (
  `id` int(11) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `meta_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_meta`
--

INSERT INTO `pdv_meta` (`id`, `meta_title`, `meta_value`, `meta_type`) VALUES
(1, 'Denegado', '0', 'prospects'),
(2, 'Indeciso', '25', 'prospects'),
(3, 'En proceso', '50', 'prospects'),
(4, 'Negociando', '75', 'prospects'),
(5, 'Aprobado', '100', 'prospects'),
(6, 'Agricultura, Ganadería, Caza y Silvicultura', '1', 'giro'),
(7, 'Pesca', '2', 'giro'),
(10, 'Explotación de Minas y Canteras', '3', 'giro'),
(11, 'Industrias Manufactureras No Metálicas', '4', 'giro'),
(12, 'Industrias Manufactureras Metálicas', '5', 'giro'),
(13, 'Suministro de Electricidad, Gas y Agua', '6', 'giro'),
(14, 'Construcción', '7', 'giro'),
(15, 'Comercio al Por Mayor y Menor; Rep. Vehículos Automotores/Enseres Domésticos', '8', 'giro'),
(16, 'Hoteles y Restaurantes', '9', 'giro'),
(17, 'Transporte, Almacenamiento y Comunicaciones', '10', 'giro'),
(18, 'Intermediación Financiera', '11', 'giro'),
(19, 'Actividades Inmobiliarias, Empresariales y de Alquiler', '12', 'giro'),
(20, 'Adm. Pública y Defensa; Planes de Seg. Social, Afiliación Obligatoria', '13', 'giro'),
(21, 'Organizaciones y Órganos Extraterritoriales', '14', 'giro'),
(22, 'Enseñanza', '15', 'giro'),
(23, 'Servicios Sociales y de Salud', '16', 'giro'),
(24, 'Otras Actividades de Servicios Comunitarias, Sociales y Personales', '17', 'giro'),
(25, 'Consejo de Administración de Edificios y Condominios', '18', 'giro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_msg`
--

CREATE TABLE `pdv_msg` (
  `id` int(11) NOT NULL,
  `from_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `to_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fromuser` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `touser` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_msg`
--

INSERT INTO `pdv_msg` (`id`, `from_user`, `to_user`, `subject`, `content`, `status`, `date`, `location`, `fromuser`, `touser`) VALUES
(1, '5', '9', 'Hola', 'Esto es un mensaje de prueba', '1', '2017-11-10 19:47:08', 'received', '5', '1'),
(2, '9', '5', 'Sin asunto', 'ok', '1', '2017-11-10 19:48:37', 'received', '5', '1'),
(3, '5', '9', 'fwfewfew', 'efwfewf', '1', '2017-11-21 14:56:55', 'received', '1', '1'),
(4, '10', '5', 'Reunion', 'Que tal elias? te mande una invitaciÃ³n para una reunion.\r\n\r\nSaludos', '1', '2017-11-22 16:12:35', 'received', '1', '1'),
(5, '5', '10', 'Sin asunto', 'Hola, recibido, nos vemos entonces', '2', '2017-11-22 16:13:05', 'received', '1', '1'),
(6, '9', '5', 'Sin asunto', 'ok', '1', '2017-11-22 16:13:31', 'received', '1', '1'),
(7, '5', '9', 'Sin asunto', 'Dime', '1', '2017-11-22 16:14:02', 'received', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_pp2`
--

CREATE TABLE `pdv_pp2` (
  `id` int(11) NOT NULL,
  `prospect` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `idproduct` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `currentprice` double NOT NULL,
  `priceafterdis` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_pp2`
--

INSERT INTO `pdv_pp2` (`id`, `prospect`, `idproduct`, `discount`, `quantity`, `currentprice`, `priceafterdis`) VALUES
(13, '6', '1', '0', '1', 390000, 390000),
(14, '6', '25', '0', '1', 30, 30),
(16, '10', '1', '0', '1', 390000, 390000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_pp3`
--

CREATE TABLE `pdv_pp3` (
  `id` int(11) NOT NULL,
  `cuotesid` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `idproduct` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `priceofthecuote` double NOT NULL,
  `priceafterdis` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_pp3`
--

INSERT INTO `pdv_pp3` (`id`, `cuotesid`, `idproduct`, `discount`, `quantity`, `priceofthecuote`, `priceafterdis`) VALUES
(22, '12', '1', '0', '1', 390000, 390000),
(23, '13', '1', '0', '1', 390000, 390000),
(24, '13', '25', '0', '1', 800336.1, 800336.1),
(25, '14', '1', '0', '1', 390000, 390000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_products`
--

CREATE TABLE `pdv_products` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(30) NOT NULL,
  `has_quant` int(11) NOT NULL,
  `critical_quant` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `unit` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sub_category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `product_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `assignto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `commission` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `useuf` int(11) NOT NULL,
  `is_service` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_products`
--

INSERT INTO `pdv_products` (`id`, `status`, `name`, `quantity`, `has_quant`, `critical_quant`, `price`, `unit`, `description`, `category`, `sub_category`, `product_img`, `assignto`, `commission`, `useuf`, `is_service`) VALUES
(1, 1, 'Lic. GestiÃ³n Comercial v 7.1 (Mono Usuario)', 0, 0, '0', 390000, 'NA', '', '2', '', '', '', '', 0, '0'),
(2, 1, 'Lic. Contabilidad v 7.0', 0, 0, '0', 390000, 'NA', '', '2', '', '', '', '', 0, '0'),
(3, 1, 'Lic. Remuneraciones V 7.0', 0, 0, '0', 390000, 'NA', '', '2', '', '', '', '', 0, '0'),
(4, 1, 'Lic. GestiÃ³n Comercial v 7.1 (Multiusuarios)', 0, 0, '0', 490000, 'NA', '(VersiÃ³n multiusuarios en Red)', '2', '', '', '', '', 0, '0'),
(5, 1, 'Lic. Contabilidad v 7.0 (Multiusuarios)', 0, 0, '0', 490000, 'NA', ' (VersiÃ³n multiusuarios en red)', '2', '', '', '', '', 0, '0'),
(6, 1, 'Lic. Remuneraciones V 7.0 (Multiusuarios)', 0, 0, '0', 490000, 'NA', '(VersiÃ³n multiusuarios en red)', '2', '', '', '', '', 0, '0'),
(7, 1, 'Usuario para sucursales monousuario', 0, 0, '0', 190000, 'NA', '', '2', '', '', '', '', 0, '0'),
(8, 1, 'Usuario para sucursales multiusuarios.', 0, 0, '0', 290000, 'NA', '', '2', '', '', '', '', 0, '0'),
(9, 1, 'Lic. adicional en red', 0, 0, '0', 99000, 'NA', '', '2', '', '', '', '', 0, '0'),
(10, 1, 'Lic. Para laptop (notebook) conectada al servidor.', 0, 0, '0', 290000, 'NA', '', '2', '', '', '', '', 0, '0'),
(11, 1, 'Gaveta de Dinero', 0, 0, '0', 49000, 'NA', '', '4', '', 'gaveta de dinero1754.png', '', '', 0, '0'),
(12, 1, 'CPU POS', 0, 0, '0', 390000, 'NA', '', '4', '', 'cpu pos0912.png', '', '', 0, '0'),
(13, 1, 'Lector Scanner 2D', 0, 0, '0', 193000, 'NA', '', '4', '', 'lector scanner 2d1755.png', '', '', 0, '0'),
(14, 1, 'Impresora ZEBRA', 0, 0, '0', 295000, 'NA', '', '4', '', 'impresora zebra1754.png', '', '', 0, '0'),
(15, 1, 'Impresora Fiscal Samsung Modelo SRP 350', 0, 0, '0', 420000, 'NA', '', '4', '', 'impresora fiscal samsung modelo srp 3501755.jpg', '', '', 0, '0'),
(16, 1, 'Impresora Ticket Samsung Plus', 0, 0, '0', 160000, 'NA', '', '4', '', '', '', '', 0, '0'),
(17, 1, 'Windows 8.1 â€“ 10 nuevo', 0, 0, '0', 192000, 'NA', '', '4', '', '', '', '', 0, '0'),
(18, 1, 'Lector Scanner USB Motorola', 0, 0, '0', 79000, 'NA', '', '4', '', '', '', '', 0, '0'),
(19, 1, 'Lector Sobre Mesa Omnidireccional', 0, 0, '0', 195000, 'NA', '', '4', '', 'lector sobre mesa omnidireccional1756.png', '', '', 0, '0'),
(20, 1, 'BALANZA DIGITAL MULTIPLES FUNCIONES ( USB)', 0, 0, '0', 680000, 'NA', '', '4', '', '', '', '', 0, '0'),
(21, 1, 'Papel TÃ©rmico 80mm x 80mm', 0, 0, '0', 60000, 'NA', '', '5', '', '', '', '', 0, '0'),
(22, 1, 'Cinta Trasferencia tÃ©rmica', 0, 0, '0', 8900, 'NA', '', '5', '', 'cinta trasferencia termica0925.png', '', '', 0, '0'),
(23, 1, '1000 Etiquetas de 10 mm x 40 mm', 0, 0, '0', 40000, 'NA', '', '5', '', '', '', '', 0, '0'),
(24, 1, '5.000 Etiquetas Semi Brillo 30 mm x 10mm', 0, 0, '0', 190000, 'NA', 'MÃ¡s de 20.000 Precio varÃ­a segÃºn tamaÃ±o.', '5', '', '', '', '', 0, '0'),
(25, 1, 'DTEâ€™S BÃ¡sicos', 0, 0, '0', 30, 'NA', '', '3', '', '', '', '', 1, '0'),
(26, 1, 'DTEâ€™S Medium', 0, 0, '0', 50, 'NA', '', '3', '', '', '', '', 1, '0'),
(27, 1, 'DTEâ€™S Premium', 0, 0, '0', 60, 'NA', '', '3', '', '', '', '', 1, '0'),
(28, 1, 'ConexiÃ³n VPN o Virtual Private Network.', 0, 0, '0', 8, 'NA', '', '6', '', '', '', '', 1, '0'),
(29, 1, 'Respaldo de datos', 0, 0, '0', 3, 'NA', '', '6', '', '', '', '', 1, '0'),
(30, 1, 'Servicios Mensuales TI - Outsourcing InformÃ¡tico', 0, 0, '0', 2, 'NA', '', '6', '', '', '', '', 1, 'Mensualmente'),
(31, 1, 'CapacitaciÃ³n BÃ¡sica', 0, 0, '0', 5, 'NA', '', '8', '', '', '', '', 1, '0'),
(32, 1, 'Puesta en Marcha. ( servicio sugerido)', 0, 0, '0', 10, 'NA', '', '8', '', '', '', '', 1, '0'),
(33, 1, 'MigraciÃ³n de datos Maestros', 0, 0, '0', 120000, 'NA', '', '8', '', '', '', '', 0, '0'),
(34, 1, 'CapacitaciÃ³n Extendida', 0, 0, '0', 200000, 'NA', '', '8', '', '', '', '', 0, '0'),
(35, 1, 'Punto Nuevo (precio cliente)', 0, 0, '0', 1.5, 'NA', '', '9', '', '', '', '', 1, '0'),
(36, 1, 'Re-ConfiguraciÃ³n por punto ', 0, 0, '0', 0.5, 'NA', '', '9', '', '', '', '', 1, '0'),
(37, 1, 'Punto Nuevo para no clientes', 0, 0, '0', 2, 'NA', '', '9', '', '', '', '', 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_prospects`
--

CREATE TABLE `pdv_prospects` (
  `id` int(11) NOT NULL,
  `contact` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `responsable` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` date NOT NULL,
  `has_tasks` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prospectnotes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `discountofneto` int(3) NOT NULL,
  `has_cuotes` int(11) NOT NULL,
  `lastmod_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_prospects`
--

INSERT INTO `pdv_prospects` (`id`, `contact`, `responsable`, `status`, `added_date`, `has_tasks`, `prospectnotes`, `total`, `discountofneto`, `has_cuotes`, `lastmod_date`) VALUES
(6, '6', '5', '75', '2017-11-20', '0', '', 390000, 0, 1, '2017-11-23'),
(10, '7', '10', '100', '2017-11-22', '0', '', 390000, 0, 1, '2017-12-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_sales`
--

CREATE TABLE `pdv_sales` (
  `id` int(11) NOT NULL,
  `prospectid` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cuoteid` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `creationdate` date NOT NULL,
  `has_nt` int(11) NOT NULL,
  `nt_notes` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `nt_iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_sales`
--

INSERT INTO `pdv_sales` (`id`, `prospectid`, `cuoteid`, `creationdate`, `has_nt`, `nt_notes`, `nt_iva`) VALUES
(1, '10', '14', '2017-12-21', 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_social`
--

CREATE TABLE `pdv_social` (
  `id` int(11) NOT NULL,
  `contact_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `social_content` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `social_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_company` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_tasks`
--

CREATE TABLE `pdv_tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `addeddate` datetime NOT NULL,
  `limit_date` datetime NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `asoc_id_client` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `asoc_id_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `isprivate` int(11) NOT NULL,
  `customtask` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_tasks`
--

INSERT INTO `pdv_tasks` (`id`, `name`, `description`, `addeddate`, `limit_date`, `type`, `asoc_id_client`, `asoc_id_user`, `isprivate`, `customtask`, `priority`) VALUES
(18, 'Reunion ASUNTO', 'Esta es una descripciÃ³n de prueba para el evento: ReuniÃ³n.', '2017-11-23 00:00:00', '2017-11-25 15:00:00', 'ReuniÃ³n', '', '5', 1, 'Sin definir', '3'),
(20, 'PresentaciÃ³n Prezi', 'Presentar prezi de gestiÃ³n comercial', '2017-11-23 00:00:00', '2017-11-25 15:00:00', 'Tarea', '', '9', 0, 'Sin definir', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdv_users`
--

CREATE TABLE `pdv_users` (
  `id` int(11) NOT NULL,
  `pdv_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pdv_lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_rut` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pdv_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pdv_phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pdv_rol` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pdv_sex` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fec_nac` date NOT NULL,
  `pdv_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_cargo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pdv_password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `key_sec` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_log` date NOT NULL,
  `user_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pdv_users`
--

INSERT INTO `pdv_users` (`id`, `pdv_name`, `pdv_lastname`, `user_rut`, `pdv_email`, `pdv_phone`, `pdv_rol`, `pdv_sex`, `fec_nac`, `pdv_description`, `user_cargo`, `department`, `pdv_password`, `key_sec`, `last_log`, `user_img`, `commission`) VALUES
(5, 'Elias', 'Gonzalez', 'S/I', 'desarrollos.pdv@gmail.com', '997281587', '1', '1', '2017-11-23', 'Ingeniero en telecomunicaciones', 'Gerente de operaciones', 'Proyectos a medida', '1868bde483cd729142c7beb', '45ac22dfd216dcd0c30d', '2017-12-21', '', '10'),
(9, 'Isabel', 'Maldonado Roa', 'S/I', 'ventas.dimasoft@gmail.com', 'S/I', '2', '2', '0000-00-00', '', 'Gerente de Ventas', 'S/I', '1868bde483cd729142c7beb', '53c8f21a09ef387e676a', '2017-11-23', '91744.png', '5'),
(10, 'Andres', 'Gonzalez', 'S/I', 'agonzalez@gmail.com', 'S/I', '2', '1', '0000-00-00', '', 'S/I', 'S/I', '1868bde483cd729142c7beb', 'f4ae1b677d8a36603b94', '2017-11-23', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pdv_categories`
--
ALTER TABLE `pdv_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_companies`
--
ALTER TABLE `pdv_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_contact`
--
ALTER TABLE `pdv_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_cuotes`
--
ALTER TABLE `pdv_cuotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_guests`
--
ALTER TABLE `pdv_guests`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_meta`
--
ALTER TABLE `pdv_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_msg`
--
ALTER TABLE `pdv_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_pp2`
--
ALTER TABLE `pdv_pp2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_pp3`
--
ALTER TABLE `pdv_pp3`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_products`
--
ALTER TABLE `pdv_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_prospects`
--
ALTER TABLE `pdv_prospects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_sales`
--
ALTER TABLE `pdv_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_social`
--
ALTER TABLE `pdv_social`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_tasks`
--
ALTER TABLE `pdv_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdv_users`
--
ALTER TABLE `pdv_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pdv_categories`
--
ALTER TABLE `pdv_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `pdv_companies`
--
ALTER TABLE `pdv_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pdv_contact`
--
ALTER TABLE `pdv_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pdv_cuotes`
--
ALTER TABLE `pdv_cuotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pdv_guests`
--
ALTER TABLE `pdv_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pdv_meta`
--
ALTER TABLE `pdv_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `pdv_msg`
--
ALTER TABLE `pdv_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pdv_pp2`
--
ALTER TABLE `pdv_pp2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `pdv_pp3`
--
ALTER TABLE `pdv_pp3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `pdv_products`
--
ALTER TABLE `pdv_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `pdv_prospects`
--
ALTER TABLE `pdv_prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `pdv_sales`
--
ALTER TABLE `pdv_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pdv_social`
--
ALTER TABLE `pdv_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pdv_tasks`
--
ALTER TABLE `pdv_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `pdv_users`
--
ALTER TABLE `pdv_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
