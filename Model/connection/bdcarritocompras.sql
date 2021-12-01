-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 21:57:01
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcarritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(130, '2021-11-23 04:48:13', 6),
(131, '2021-11-23 16:29:30', 2),
(132, '2021-11-23 16:30:46', 6),
(133, '2021-11-23 16:31:05', 6),
(134, '2021-11-24 18:15:20', 6),
(135, '2021-11-24 19:36:36', 6),
(136, '2021-11-24 19:49:56', 2),
(137, '2021-11-24 19:52:40', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT current_timestamp(),
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(35, 130, 4, '2021-11-23 04:48:13', '2021-11-24 20:19:57'),
(36, 131, 4, '2021-11-23 16:29:30', '2021-11-24 19:50:20'),
(37, 132, 4, '2021-11-23 16:30:46', '2021-11-24 18:29:02'),
(38, 133, 4, '2021-11-23 16:31:06', '2021-11-24 18:55:35'),
(39, 134, 4, '2021-11-24 18:15:20', '2021-11-24 18:36:05'),
(40, 135, 1, '2021-11-24 19:36:37', '0000-00-00 00:00:00'),
(41, 136, 4, '2021-11-24 19:49:57', '2021-11-24 19:50:23'),
(42, 137, 1, '2021-11-24 19:52:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL,
  `cipreciototal` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraitem`
--

INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`, `cipreciototal`) VALUES
(160, 8, 130, 5, 119995),
(161, 5, 130, 2, 45998),
(162, 2, 131, 1, 23999),
(163, 8, 132, 2, 47998),
(164, 5, 133, 2, 45998),
(165, 13, 133, 2, 83998),
(166, 5, 134, 1, 22999),
(167, 5, 135, 1, 22999),
(168, 5, 136, 3, 68997),
(169, 21, 136, 5, 84995),
(170, 5, 137, 1, 22999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(1, 'Menu Administrador', 'menu del administrador', NULL, NULL),
(2, 'Menu Deposito', 'kkkkk', NULL, NULL),
(3, 'Menu Cliente', 'kkkkk', NULL, NULL),
(4, 'Usuarios', 'Menu abm solo para administrador', 1, NULL),
(5, 'Abm_menus', 'Agregar nuevas opciones ', 1, NULL),
(7, 'Roles de usuarios', 'kkkkk', 1, NULL),
(8, 'Roles', 'kkkkk', 1, NULL),
(9, 'Asignar roles', 'kkkkk', 1, NULL),
(10, 'nuevo', 'kkkkk', NULL, NULL),
(11, 'nuevo', 'kkkkk', NULL, NULL),
(12, 'Nuevo Producto', 'Agregar un producto nuevo', 2, NULL),
(13, 'Modificar Productos', '', 2, NULL),
(14, 'Estado Producto', '', 2, NULL),
(15, 'Stock', '', 2, NULL),
(16, 'Editar Datos Cliente', '', 3, NULL),
(17, 'Comprar', 'menu para clientes', 3, '2021-11-24 23:47:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menurol`
--

INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1),
(5, 1),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 3),
(17, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `pronombre` varchar(50) NOT NULL,
  `prodetalle` varchar(2500) NOT NULL,
  `procantstock` int(11) NOT NULL,
  `proprecio` int(7) NOT NULL,
  `propreciooferta` int(7) DEFAULT NULL,
  `prodeshabilitado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `procantstock`, `proprecio`, `propreciooferta`, `prodeshabilitado`) VALUES
(2, 'LG K41s', '{\"marca\":\"LG\",\"desc1\":\"El LG K41S se define como un smartphone todoterreno: en primer lugar, cuenta con un sistema de cinco camaras muy versatil para capturar infinidades de momentos, desde angulos completamente distintos. Ademas, viene con 32GB de almacenamiento los cuales son necesarios para atesorar en el celu todos los recuerdos que realmente importan.\",\"desc2\":\"Ademas, el LG K41S es sinonimo de autonomia garantizada, ya que la energia que tiene dura todo el dia. Su bateria de 4,000 mAh te acompana desde el amanecer hasta el anochecer para transmitir en vivo, chatear, jugar o sacar fotos sin preocuparse por el cargador.\",\"Camara Principal\":\"<br /><b>Notice</b>:  Undefined index: Camara Principal in <b>F:xampphtdocsPWD_TPFinalViewNuevo Producto.php</b> on line <b>122</b><br />\",\"Display\":\"6.5\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\'\' HD+\",\"Procesador\":\"Octa Core 2.0 GHz\",\"Celular Liberado\":\"Si\",\"Camara principal\":\"13 mpx con flash LED | Cuadruple | Zoom digital 4x\",\"Modelo\":\"LM-K410HM\",\"Camara frontal\":\"8 mpx\",\"Sistema Operativo\":\"Android 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 28, 38 y 66.\",\"Bateria\":\"4000 mAh\",\"Memoria RAM\":\"3 GB\",\"Memoria Interna\":\"32 GB | Disponibles 13 GB\",\"Memoria Externa\":\"MicroSD hasta 2TB\",\"Peso\":\"189 gr\",\"Dimension del equipo\":\"165,8 x 76,4 x 8,2 mm\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 2, 23999, 17999, NULL),
(3, 'LG K22', '{\"marca\":\"LG\",\"desc1\":\"El LG K22 promete una mejor y mas grande experiencia visual que otros modelos. De hecho, la compania afirma haber creado una gran pantalla para ver todo. Este equipo permite realizar videollamadas, jugar, reproducir peliculas y series todo en una pantalla HD+ de 6.2 pulgadas 19:9 con V notch que va de extremo a extremo.\",\"desc2\":\"Ademas, el LG K22 permite hacer mas cosas a la vez, como por ejemplo cambiar entre aplicaciones y tareas sin interrupciones, ni problemas. Esto es posible gracias a la plataforma movil Qualcomm 215 con procesador Quad-core de 1.3GHz el cual mejora el rendimiento para que todo funcione de forma rapida y eficaz.\",\"Camara principal\":\"13 mpx con flash LED | Dual | Zoom Digital 8x\",\"Display\":\"6.2 HD+ IPS\",\"Procesador\":\"Quad Core 1.3 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"LM-K200HM\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 28, 38 y 66.\",\"Bateria\":\"3000 mAh\",\"Bateria en modo Stand By\":\"545 h\",\"Tiempo de conversacion\":\"10 h\",\"Memoria RAM\":\"2 GB\",\"Memoria Interna\":\"32 GB | Disponibles 18 GB\",\"Memoria Externa\":\"MicroSD hasta 32 GB\",\"Peso\":\"169,5 g\",\"Dimension del equipo\":\"157,7 x 75,4 x 8,4 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. MicroUSB.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 18999, 14249, '2021-11-23 03:47:10'),
(4, 'LG K50s', '{\"marca\":\"LG\",\"desc1\":\"La linea K de los LG trae cada vez mas funciones como es el caso del nuevo LG K50S. Pantalla full vision, sonido envolvente y, como si fuera poco, una bateria que dura todo el dia.\",\"desc2\":\"Ademas, el LG K50S cuenta con un sistema de triple camara con el que vas a poder sacar fotos extremadamente nitidas y de calidad. Con todas estas funciones, el LG K50S no tiene nada que envidiar a celulares de alta gama y podes encontrarlo a un precio mas que accesible.\",\"Camara Principal\":\"15\",\"Display\":\"6.5 HD+\",\"Procesador\":\"Octa Core 2.0 GHz\",\"Celular Liberado\":\"Si\",\"Camara principal\":\"13 mpx con Flash LED | Triple | Zoom digital 4x | Zoom optico 1x\",\"Modelo\":\"LM-X540HM\",\"Camara frontal\":\"13 mpx\",\"Sistema Operativo\":\"Android 9.0\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 28, 40, 66.\",\"Bateria\":\"4000 mAh\",\"Bateria en modo Stand By\":\"360 h\",\"Tiempo de conversacion\":\"11 h\",\"Memoria RAM\":\"3 GB\",\"Memoria Interna\":\"32 GB | Disponibles 19.4 GB\",\"Memoria Externa\":\"MicroSD hasta 1 TB\",\"Peso\":\"194 g\",\"Dimension del equipo\":\"165.8 x 77.5 x 8.2 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 2, 25999, NULL, NULL),
(5, 'Moto E7i Power', '{\"marca\":\"Motorola\",\"desc1\":\"El nuevo Moto E7i Power permite aprovechar tu celular como nunca antes gracias a la gran bateria de 5000 mAh que dura mas de 40 horas con una unica carga. Este modelo no solo porta un diseno elegante y dinamico para el agarre sino tambien una resistencia unica ya que es repelente al agua: se mantiene protegido de derrames, salpicaduras y bajo la lluvia.\",\"desc2\":\"Ademas, el Moto E7i Power cuenta con una impresionante pantalla ultra ancha de 6,5 pulgadas Max Vision HD+ para disfrutar de todo el contenido con la mejor calidad. Ahora podes jugar, mirar y videochatear con la mejor calidad gracias a su relacion de aspecto 20:9 y una gran proporcion pantalla-cuerpo.\",\"Camara principal\":\"13 mpx con flash LED | Dual | Zoom digital 4x\",\"Display\":\"6.5 IPS HD+\",\"Procesador\":\"Octa Core 1.6 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"XT2097-12\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, 6 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 19, 28 y 66.\",\"Bateria\":\"5000 mAh\",\"Memoria RAM\":\"2 GB\",\"Memoria Interna\":\"32 GB | Disponibles 24 GB\",\"Memoria Externa\":\"MicroSD hasta 1 TB\",\"Peso\":\"200 gr\",\"Dimension del equipo\":\"165 x 75,8 x 9,2 mm\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 22999, 20699, NULL),
(7, 'Moto G20', '{\"marca\":\"Motorola\",\"desc1\":\"El nuevo Moto G20 es un celular gama media con prestaciones unicas que lo hacen el equipo perfecto para todos los usuarios que buscan un rendimiento de alta categoria a un buen precio. Con una pantalla Max Vision de 6.5 pulgadas y HD+ vas a navegar por la web, mirar videos y jugar con una frecuencia de actualizacion de pantalla mas veloz y fluida.\",\"desc2\":\"La bateria de alta duracion del Moto G20 se complementa tambien con un diseno moderno en donde predominan las curvas suaves para un agarre ideal. Ademas, es un celular agradable al tacto (lo cual brinda mayor comodidad de uso) y se destaca por su resistencia al agua, derrames y salpicaduras.\",\"Camara principal\":\"48 mpx con flash LED | Cuadruple | Zoom digital 4x\",\"Display\":\"6.5\'\' IPS HD+\",\"Procesador\":\"Octa Core 1.8 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"XT2128-1\",\"Camara frontal\":\"13 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 19, 28, 40 y 66.\",\"Bateria\":\"5000 mAh\",\"Bateria en modo Stand By\":\"2 dias\",\"Tiempo de conversacion\":\"2 dias\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"64 GB | Disponibles 50 GB\",\"Memoria Externa\":\"MicroSD hasta 256 GB\",\"Peso\":\"200 g\",\"Dimension del equipo\":\"165,2 x 75,7 x 9,1 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 34499, 29324, NULL),
(8, 'Moto E20', '{\"marca\":\"Motorola\",\"desc1\":\"El nuevo moto E20 tiene todo lo que queres y necesitas en un celular. Maximo rendimiento, el mejor diseno y materiales de primera calidad que convierten a este smartphone en una opcion ideal si tenes que comprarte uno nuevo o hacer un buen regalo.\",\"desc2\":\"Su pantalla Max Vision HD+ de 6.5 y su camara dual son dos de las especificiaciones a destacar de este celular. La pantalla ultra wide te permitira disfrutar de tus videollamadas y peliculas favoritas y su camara dual con inteligencia artificial hara que no te pierdas ningun momento gracias a su enfoque rapido. Vas a poder capturar retratos de aspecto profesional de manera auromatica. Otras de las caracteristicas destacables del moto E20 estan relacionadas con la conectividad y la seguridad. La bateria del moto E20 te permitira disfrutar de tu smartphone durante 40 hs seguidas y conectarte con lo que necesites solo presionando el boton de acceso al Asistente de Google que esta en el costado del telefono. Por ultimo y no por ello menos importante, el desbloqueo de este celular es a traves de la huella digital, lo cual lo hace seguro y practico al mismo tiempo.\",\"Camara principal\":\"13 mpx con flash LED | Dual | Zoom digital 4x\",\"Display\":\"6.52 HD+\",\"Procesador\":\"Octa Core 1.6 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"XT2155-1\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, 6 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 19, 28, 40 y 66.\",\"Bateria\":\"4000 mAh\",\"Memoria RAM\":\"2 GB\",\"Memoria Interna\":\"32 GB | Disponibles 23 GB\",\"Peso\":\"200 g\",\"Dimension del equipo\":\"164,8 x 75,5 x 8,4 mm\",\"NFC\":\"No\"}', 6, 23999, NULL, NULL),
(9, 'Moto G60s', '{\"marca\":\"Motorola\",\"desc1\":\"Sorprendentemente real con increible fluidez. Disfruta de la pantalla mas grande, amplia y envolvente jamas vista en un moto g. La pantalla Max Vision FHD+ de 6.8\'\' ofrece una gama de colores de un 10 % mas amplia.\",\"desc2\":\"Colores vividos y reales con contraste unicos y ademas un aumento del 25 % de brillo ante la luz solar. La frecuencia de actualizacion de 120 Hz te ofrece una increible fluidez en las transiciones en cualquier situacion. Sistema de 4 camaras con sensor Principal de 64 MP (80.1°) F1.7 + Ultra Gran Angular de 8MP (118°) F2.2 + Macro de 5MP (87.4°) F2.2 + Profundidad de 2MP (80.1°) F2.4.\",\"Camara principal\":\"64 mpx con flash LED | Quad | Zoom digital 8x\",\"Display\":\"6.78\'\' FHD+\",\"Procesador\":\"Octa Core 2.0 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"XT2133-1\",\"Camara frontal\":\"16 mpx con flash LED\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 28, 40 y 66.\",\"Bateria\":\"5000 mAh\",\"Memoria RAM\":\"6 GB\",\"Memoria Interna\":\"128 GB | Disponibles 110 GB\",\"Memoria Externa\":\"MicroSD hasta 512 GB\",\"Peso\":\"188 g\",\"Dimension del equipo\":\"163,2 x 75,9 x 7,9 mm\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 4, 53999, NULL, NULL),
(10, 'Moto G30', '{\"marca\":\"Motorola\",\"desc1\":\"Motorola presenta el nuevo Moto G30: un telefono de gama media que presume de caracteristicas muy exigentes, empezando por su camara de fotos de alta resolucion y su pantalla. De hecho, ofrece desde su diseno interno y externo un equipo de alto rendimiento.\",\"desc2\":\"El Moto G30 presume tambien de mucha potencia. Posee un procesador Snapdragon 662 que puede ejecutar cualquier tarea del dia a dia con suma facilidad y con un consumo eficiente. Cuenta ademas con 4GB de memoria RAM, asi como un almacenamiento interno de 128GB ampliables mediante tarjetas microSD hasta los 256GB.\",\"Camara principal\":\"64 mpx con flash LED | Cuadruple | Zoom digital 8x\",\"Display\":\"6.5\'\' IPS HD+\",\"Procesador\":\"Octa Core 2 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"XT2129-1\",\"Camara frontal\":\"13 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 19, 28, 40 y 66.\",\"Bateria\":\"5000 mAh\",\"Bateria en modo Stand By\":\"2 dias\",\"Tiempo de conversacion\":\"2 dias\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"128 GB | Disponibles 110 GB\",\"Memoria Externa\":\"MicroSD hasta 256 GB\",\"Peso\":\"200 gr\",\"Dimension del equipo\":\"165,2 x 75,7 x 9,1 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 39999, NULL, NULL),
(11, 'Moto G9 Plus', '{\"marca\":\"Motorola\",\"desc1\":\"Llego el Moto G9 Plus con todo lo que queres. Su diseno elegante y compacto, es ideal para utilizarlo con una sola mano durante todo el dia sin sentir cansancio. Ademas de ser un equipo que combina esteticamente con cualquier look, Motorola desarrollo en la carcasa del dispositivo un boton especial que, al presionarlo, inicia rapidamente el asistente de Google para recibir toda la ayuda que necesites con un solo toque.\",\"desc2\":\"Ademas de ser un equipo atractivo, el Moto G9 Plus cuenta con caracteristicas verdaderamente sorprendentes: tiene cuatro camaras con sensor principal de 64 MP, una pantalla Max Vision HDR 10 de 6,8 pulgadas, un procesador Qualcomm Snapdragon 730G y una bateria que resiste hasta 2 dias sin ser cargada, para navegar con la mejor definicion en tus contenidos favoritos.\",\"Camara principal\":\"64 mpx con flash LED | Quad | Zoom digital 8x\",\"Display\":\"6.8\'\' HD+ IPS\",\"Procesador\":\"Octa Core 2.2 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"XT2087-1\",\"Camara frontal\":\"16 mpx\",\"Sistema Operativo\":\"Android 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 17, 28 y 66.\",\"Bateria\":\"5000 mAh\",\"Bateria en modo Stand By\":\"2 dias\",\"Tiempo de conversacion\":\"2 dias\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"128 GB | Disponibles 112 GB\",\"Memoria Externa\":\"MicroSD hasta 512 GB\",\"Peso\":\"223 g\",\"Dimension del equipo\":\"169.9 x 78.1 x 9.6 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 46999, NULL, NULL),
(12, 'Samsung Galaxy A52s', '{\"marca\":\"Samsung\",\"desc1\":\"El nuevo Samsung A52s Detalles super nitidos gracias a la pantalla FHD+ Super AMOLED, que, gracias a los 800 nits, te permite tener claridad incluso cuando hay demasiada luminosidad. La tecnologia Eye Comfort Shield reduce la luz azul y la tecnologia Super Smooth mantiene la imagen suave aunque estes jugando o haciendo scroll. Todo esto en la amplia pantalla Infinity-O de 6,5\'\'.\",\"desc2\":\"El Samsung A52 presenta elegantes curvas y un impecable diseno. El minimo borde de la camara combina con el acabado mate en la parte posterior para lograr un aspecto iconico y unificado. Expresa tu estilo con un negro asombroso que combinara a la perfeccion con todos tus looks.\",\"Camara principal\":\"64 mpx con flash LED | Triple | Zoom digital 10x\",\"Display\":\"6.5\'\' Full HD+ Super AMOLED\",\"Procesador\":\"Octa Core 2.4 GHz, 1.8 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-A037M\",\"Camara frontal\":\"32 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4 y 5.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 20, 26, 28 y 66.\",\"Bateria\":\"4500 mAh\",\"Memoria RAM\":\"6 GB\",\"Memoria Interna\":\"128 GB | Disponibles 106 GB\",\"Memoria Externa\":\"MicroSD hasta 1 TB\",\"Peso\":\"189 gr\",\"Dimension del equipo\":\"159.9 x 75.1 x 8.4 mm\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 23, 75999, NULL, NULL),
(13, 'Samsung Galaxy A22', '{\"marca\":\"Samsung\",\"desc1\":\"Pantalla asombrosa para un desplazamiento verdaderamente fluido. Amplia tu vision con la pantalla Infinity-U de 6,4\'\'\'\'\'\'\'\' del Galaxy A22 y mira todo lo que te estabas perdiendo. Gracias a la pantalla Super Amoled HD+ que alcanza los 600 nits1 para lograr mas claridad, tus contenidos se ven nitidos, definidos y deslumbrantes. Ademas, Real Smooth mantiene el desplazamiento fluido en tus juegos y redes sociales.\",\"desc2\":\"El diseno elegante del Galaxy A22 le brinda un aspecto atractivo y moderno. Sus curvas refinadas hacen que agarrarlo sea comodo y que la navegacion en pantalla sea mas facil.\",\"Camara principal\":\"48 mpx con flash LED | Quad | Zoom digital 10x\",\"Display\":\"6.4\'\'\'\'\'\'\'\' HD+\",\"Procesador\":\"Octa Core 2 GHz, 1.8GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-A225M\",\"Camara frontal\":\"13 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 17, 20, 26, 28, y 66.\",\"Bateria\":\"5000 mAh\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"128 GB | 103 Disponibles\",\"Memoria Externa\":\"MicroSD hasta 1 TB\",\"Peso\":\"186 g\",\"Dimension del equipo\":\"159,3 x 73,6 x 8,4 mm\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"Si\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 2, 41999, NULL, NULL),
(14, 'Samsung Galaxy A02s', '{\"marca\":\"Samsung\",\"desc1\":\"El nuevo Samsung Galaxy A02s llego para demostrar un compromiso con el desarrollo de productos y experiencias en todos los rangos de precio sin hacer excepciones. Brinda una visualizacion ininterrumpida gracias a su pantalla HD+ Infinity-V de 6.5 pulgada la cual ofrece una gran claridad en la imagen.\",\"desc2\":\"Por otro lado, gracias a la bateria de larga duracion de 5.000 mAh que porta el Samsung Galaxy A02s se pueden ver peliculas, videos y series sin interrupciones. De hecho, no tendras que preocuparte por donde esta el cargador y, como si fuera poco, el nuevo Samsung A02s cuenta con una carga rapida de 15 W de larga duracion.\",\"Camara principal\":\"13 mpx con flash LED | Triple | Zoom Digital 8x\",\"Display\":\"6.5\'\' HD+\",\"Procesador\":\"Octa Core 1.8 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-A025M\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 17, 28, 66.\",\"Bateria\":\"5000 mAh\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"64 GB | Disponibles 53 GB\",\"Memoria Externa\":\"MicroSD hasta 1 TB\",\"Peso\":\"168 g\",\"Dimension del equipo\":\"156.9 x 75,8 x 7,8 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"Si\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 26999, NULL, NULL),
(15, 'Samsung Galaxy S21 Ultra', '{\"marca\":\"Samsung\",\"desc1\":\"El nuevo Samsung Galaxy S21 Ultra se define como epico en todos los sentidos. Este Ultra 5G esta disenado con una sola camara en los contornos de un marco delgado que busca crear una revolucion en fotografia: el modulo permite realizar videos cinematograficos en 8K y tomar fotos con excelente calidad.\",\"desc2\":\"Ademas, el Samsung Galaxy S21 Ultra cuenta con el chip mas rapido de la linea Galaxy, con el vidrio mas resistente de la marca, una velocidad 5G y una bateria que dura todo.\",\"Camara principal\":\"108 mpx con Flash LED | Cuadruple | Zoom optico hibrido 10x | Zoom digital 100x\",\"Display\":\"6.8\'\' Quad HD+ Dynamic Amoled 2x\",\"Procesador\":\"Octa Core 2.9 GHz, 2.8 GHz, 2.2 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-G998B\",\"Camara frontal\":\"40 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM / e-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 18, 19, 20, 25, 26, 28, 32, 38, 39, 40, 41 y 66.\",\"Bateria\":\"5000 mAh\",\"Memoria RAM\":\"12 GB\",\"Memoria Interna\":\"256 GB\",\"Memoria Externa\":\"No\",\"Peso\":\"227 g\",\"Dimension del equipo\":\"165,1 x 75,6 x 8,9 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"No\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 5, 179999, NULL, NULL),
(16, 'Samsung Galaxy S21', '{\"marca\":\"Samsung\",\"desc1\":\"El nuevo Samsung Galaxy S21 fue disenado con la intencion de revolucionar el video y la fotografia que portan los smartphones, y por eso presento una resolucion cinematografica de 8K para poder tomar fotos epicas mientras se hace un video. Ademas, es un modelo que cuenta con 64 MP, un chip muy rapido y una bateria increible que dura todo el dia.\",\"desc2\":\"Otra de las caracteristicas que hacen del Samsung Galaxy S21 un equipo unico es el nivel de proteccion con el que cuenta: tiene un Gorilla Glass Victus el cual ofrece resistencia a los rayones y los danos, convirtiendo a este equipo en el companero ideal para salir de fiesta o incluso viajar por el mundo.\",\"Camara principal\":\"64 mpx con flash LED | Triple | Zoom digital 30x | Zoom optico 10x\",\"Display\":\"6.2\'\' FHD+ Dynamic Amoled 2x\",\"Procesador\":\"Octa Core 2.9 GHz, 2.8 GHz, 2.2 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-G991B\",\"Camara frontal\":\"10 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM / e-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 18, 19, 20, 25, 26, 28, 32, 38, 39, 40, 41 y 66.\",\"Bateria\":\"4000 mAh\",\"Memoria RAM\":\"8 GB\",\"Memoria Interna\":\"128 GB | Disponibles 102 GB\",\"Memoria Externa\":\"No\",\"Peso\":\"169 g\",\"Dimension del equipo\":\"151,7 x 71,2 x 7,9 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"No\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 6, 124999, NULL, NULL),
(17, 'Samsung Galaxy S21 Plus', '{\"marca\":\"Samsung\",\"desc1\":\"El Samsung Galaxy S21 Plus busca ser el aliado de todos los amantes de la fotografia: se diseno para revolucionar el video y la fotografia de los smartphones y para que no se escapen las tomas perfectas. Cuenta con una resolucion 8K cinematografica superior, para extraer fotos impresionantes de las grabaciones. Disponible en un tamano comodo y amplio, este modelo tambien posee 64 MP de camara, un chip incorporado mas rapido y con bateria para todo el dia. ¿Estas preparado?.\",\"desc2\":\"Ademas el Samsung Galaxy S21 Plus cuenta con una pantalla de 120 Hz Super Smooth, la cual provee un deslizamiento mas suave y, al mismo tiempo, mantiene actualizado al usuario de todas sus notificaciones. Increiblemente reactiva, esta pantalla optimiza la frecuencia de refresco para que cada toque cree sensacion en todo lo que se oprime. Cabe destacar que este modelo posee la certificacion eye care gracias a su capacidad de reducir drasticamente las emisiones perjudiciales de luz azul.\",\"Camara principal\":\"64 mpx con flash LED | Triple | Zoom digital 30x | Zoom optico 10x\",\"Display\":\"6.7\'\'\'\' FHD+ Dynamic Amoled 2x\",\"Procesador\":\"Octa Core 2.9 GHz, 2.8 GHz, 2.2 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-G996B\",\"Camara frontal\":\"10 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM / e-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 18, 19, 20, 25, 26, 28, 32, 38, 39, 40, 41 y 66.\",\"Bateria\":\"4800 mAh\",\"Memoria RAM\":\"8 GB\",\"Memoria Interna\":\"128 GB | Disponibles 102 GB\",\"Memoria Externa\":\"No\",\"Peso\":\"200 g\",\"Dimension del equipo\":\"161,5 x 75,6 x 7,8 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"Si\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"No\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 6, 144999, NULL, '2021-11-23 03:48:09'),
(18, 'Samsung Galaxy A03s', '{\"marca\":\"Samsung\",\"desc1\":\"Mas pantalla significa mas espacio para jugar. Con la pantalla Infinity-V de 6,5 pulgadas vas a disfrutar detalles que nunca antes habias notado. Su tecnologia HD+ te asegura siempre contenido claro y nitido.\",\"desc2\":\"Mas formas de capturar el mundo con una camara triple. Capta escenas memorables con la camara principal: de 13 MP. Tambien podes personalizar el enfoque con la camara de profundidad, o penetrar en los detalles escondidos con la camara macro.\",\"Camara principal\":\"13 mpx con flash LED | Triple | Zoom digital 10x\",\"Display\":\"6.5\'\' HD+\",\"Procesador\":\"Octa Core 2.3 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"SM-A037M\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, y 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 20, 28, 30 y 66.\",\"Bateria\":\"5000 mAh\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"64 GB | Disponibles 44 GB\",\"Peso\":\"196 g\",\"Dimension del equipo\":\"164,2 x 75,9 x 9,1 mm\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"Si\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 29999, NULL, NULL),
(19, 'Nokia 2.3', '{\"marca\":\"Nokia\",\"desc1\":\"Con la doble camara del Nokia 2.3 y con apoyo de la inteligencia artificial, podras tomar imagenes de alta calidad incluso con poca luz y la capacidad de su bateria adaptable, de 4.000 mAh, te promete una autonomia de hasta dos dias.\",\"desc2\":\"El Nokia 2.3 cuenta con pantalla HD+ de 6.2 pulgadas y esta preparado para actualizarse a Android 11 y pertenece al programa Android One, lo que garantiza dos anos de actualizaciones de seguridad mensuales.\",\"Camara principal\":\"13 mpx con Flash LED | Dual\",\"Display\":\"6.2\'\' HD+\",\"Procesador\":\"Quad Core 2.0 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"TA-1214\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 17, 28, 66.\",\"Bateria\":\"4000 mAh\",\"Bateria en modo Stand By\":\"480 h\",\"Tiempo de conversacion\":\"14 h\",\"Memoria RAM\":\"2 GB\",\"Memoria Interna\":\"32 GB | Disponibles 19 GB\",\"Memoria Externa\":\"MicroSD hasta 512 GB\",\"Peso\":\"184 g\",\"Dimension del equipo\":\"158 x 75,4 x 8,7 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"Si\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. MicroUSB.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 19999, NULL, NULL),
(20, 'TCL 20E', '{\"marca\":\"TCL\",\"desc1\":\"Con el nuevo TCL 20E no vas a dejar de sorprenderte. Podras experimentar la excelencia en cada funcion ya que cuenta con una triple camara, tecnologia NXTVISION y una bateria de 4000mAh que posibilitara que uses tu celular al maximo durante todo el dia sin necesidad de cargarlo.\",\"desc2\":\"Con la tecnologia NXTVISION podras disfrutar de una mejora visual y aprovechar al maximo la pantalla de 6.52\'\' que este smartphone ofrece. Ademas, cuenta con caracteristicas de seguridad de los smartphones de alta gama: ofrece desbloqueo por huella, pero tambien reconocimiento facial.\",\"Camara principal\":\" 13 mpx con flash LED | Triple | Zoom digital 4x\",\"Display\":\" 6.5\'\' HD+\",\"Procesador\":\" Octa Core 1.8 GHz, 1.5 GHz\",\"Celular Liberado\":\" Si\",\"Modelo\":\"6125F\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android 11\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\":\"Bandas 2, 3, 4, 5, 7, 8, 13, 17, 26, 28, y 66.\",\"Bateria\":\"4000 mAh\",\"Memoria RAM\":\"4 GB\",\"Memoria Interna\":\"128 GB | 113 Disponibles\",\"Memoria Externa\":\"MicroSD hasta 512 GB\",\"Peso\":\"180 g\",\"Dimension del equipo\":\"165,6 x 75,5 x 8,8 mm\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. Tipo C.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 12, 16999, NULL, NULL),
(21, 'TCL L7+', '{\"marca\":\"TCL\",\"desc1\":\"Con el TCL L7+ no vas a dejar de sorprenderte. Vas a poder aprovechar al maximo su rendimiento y contaras con todas las facilidades de accesibilidad que este celular ofrece. El TCL L7+ cuenta con una bateria de 3000mAh y, gracias a su capacidad de almacenamiento, podras guardar los mejores momentos en tu smartphone para tenerlos siempre a mano y llevarlos con vos.\",\"desc2\":\"El TCL L7+ viene en color negro y cuenta con una pantalla de 5,5 HD+ para ver tus videos, peliculas o series favoritas.\",\"Camara principal\":\"8 mpx con flash LED | Zoom digital 4x\",\"Display\":\"5.5 HD\",\"Procesador\":\"Quad Core 1.3 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"5102B\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android Go 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, y 8.\",\"Frecuencia 4G\":\"Bandas 2, 3, 4, 5, 7, 8, 13, 17, 28 y 66.\",\"Bateria\":\"3000 mAh\",\"Memoria RAM\":\"2 GB\",\"Memoria Interna\":\"32 GB | Disponibles 26.9 GB\",\"Memoria Externa\":\"MicroSD hasta 128GB\",\"Peso\":\"168 g\",\"Dimension del equipo\":\"146,1 x 71,6 x 9,9 mm\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"No\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. MicroUSB.\",\"Cover Incluido\":\"Si\",\"Otros Accesorios Incluidos\":\"No\"}', 27, 16999, NULL, NULL),
(22, 'Nokia 1.3', '{\"marca\":\"Nokia\",\"desc1\":\"Pantalla HD+ de 5,71 pulgadas, mas brillo, imagenes mejoradas con poca luz y una bateria que dura todo el dia son algunas de las principales caracteristicas del nuevo Nokia 1.3.\",\"desc2\":\"Con sistema operativo Android 10, edicion Go, vas a tener mas rapidez y mayor seguridad, ya que el Nokia 1.3 servira para futuras actualizaciones del sistema Android.\",\"Camara principal\":\"8 mpx con Flash LED | Zoom digital 8x\",\"Display\":\"5.7\'\' HD+\",\"Procesador\":\"Quad Core 1.3 GHz\",\"Celular Liberado\":\"Si\",\"Modelo\":\"TA-1207\",\"Camara frontal\":\"5 mpx\",\"Sistema Operativo\":\"Android Go 10\",\"Tipo de SIM\":\"Nano-SIM\",\"Red\":\"2G, 3G, 4G\",\"Frecuencia 2G\":\"850/900/1800/1900 MHz\",\"Frecuencia 3G\":\"Bandas 1, 2, 4, 5, 8.\",\"Frecuencia 4G\":\"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 17, 28, 66.\",\"Bateria\":\"3000 mAh\",\"Bateria en modo Stand By\":\"350 h\",\"Tiempo de conversacion\":\"10 h\",\"Memoria RAM\":\"1 GB\",\"Memoria Interna\":\"16 GB | Disponibles 10 GB\",\"Memoria Externa\":\"MicroSD hasta 256 GB\",\"Peso\":\"154 g\",\"Dimension del equipo\":\"147.3 x 71.2 x 9.35 mm\",\"Llamadas por WiFi\":\"Si\",\"NFC\":\"No\",\"Auriculares Incluidos\":\"Si\",\"Cargador Incluido\":\"Si\",\"Cable USB Incluido\":\"Si. MicroUSB.\",\"Cover Incluido\":\"No\",\"Otros Accesorios Incluidos\":\"No\"}', 0, 10999, NULL, NULL),
(24, 'Moto G11', '{\"marca\":\"Motorola\",\"desc1\":\"Moto\",\"desc2\":\"G11\",\"Camara Principal\":\"15\",\"Display\":\"12\",\"Procesador\":\"13\",\"Celular Liberado\":\"Si\",\"Sumergible\":\"Si\"}', 5, 49999, 47999, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `rodescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'administrador'),
(2, 'deposito'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `usnombre` varchar(50) NOT NULL,
  `uspass` varchar(32) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'administrador1', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador@gmail.com', NULL),
(2, 'administrador2', '81b073de9370ea873f548e31b8adc081', 'administrador2@gmail.com', NULL),
(3, 'deposito1', 'def7924e3199be5e18060bb3e1d547a7', 'deposito1@gmail.com', NULL),
(4, 'deposito2', '6562c5c1f33db6e05a082a88cddab5ea', 'deposito2@gmail.com', NULL),
(5, 'deposito3', '674f3c2c1a8a6f90461e8a66fb5550ba', 'deposito3@gmail.com', NULL),
(6, 'usuario1', '46d045ff5190f6ea93739da6c0aa19bc', 'usuario1@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(5, 3),
(6, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- Indices de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- Indices de la tabla `compraestadotipo`
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

--
-- Indices de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
