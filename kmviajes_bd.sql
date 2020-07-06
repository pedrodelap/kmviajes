-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-07-2020 a las 05:39:10
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_kmviajes`
--
CREATE DATABASE IF NOT EXISTS `bd_kmviajes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_kmviajes`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `usp_insert_cotizacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_insert_cotizacion` (IN `pIDCliente` INT, IN `pVUsuarioCreacion` TEXT)  BEGIN 
		INSERT INTO `tb_cotizaciones`
		(
			id_cliente,
			usuario_creacion,
			fecha_creacion,
			usuario_modificacion,
			fecha_modificacion,
			venta,
			estado
			
		)VALUES
		(
			pIDCliente, 
			pVUsuarioCreacion,
			NOW(), 
			pVUsuarioCreacion,
			NOW(),
			0,
			1
		);		
		
		SELECT @@identity AS id_cotizacion ;		
		  
		
END$$

DROP PROCEDURE IF EXISTS `usp_insert_propuesta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_insert_propuesta` (IN `pIDCotizacion` INT, IN `pVTipoViaje` TEXT, IN `pIDAerolinea` INT, IN `pIDMoneda` INT, IN `pIDetracion` INT, IN `pIAdultosCantidad` INT, IN `pFAdultosSF` FLOAT, IN `pFAdultosFee` FLOAT, IN `pINinioCantidad` INT, IN `pFNinioSF` FLOAT, IN `pFNinioFee` FLOAT, IN `pIInfanteCantidad` INT, IN `pFInfanteSF` FLOAT, IN `pFInfanteFee` FLOAT, IN `pVUsuarioCreacion` TEXT)  BEGIN 
		INSERT INTO `tb_propuestas`
		(
			id_cotizacion,
			tipo_viaje,
			id_aerolinea,
			id_moneda,
			detracion,
			adultos_cantidad,
			adultos_sf,
			adultos_fee,
			ninio_cantidad,
			ninio_sf,
			ninio_fee,
			infante_cantidad,
			infante_sf,
			infante_fee,
			usuario_creacion,
			fecha_creacion,
			usuario_modificacion,
			fecha_modificacion,
			estado
			
		)VALUES
		(
			pIDCotizacion,
			pVTipoViaje,
			pIDAerolinea,
			pIDMoneda,
			pIDetracion,
			pIAdultosCantidad,
			pFAdultosSF,
			pFAdultosFee,
			pINinioCantidad,
			pFNinioSF,
			pFNinioFee,
			pIInfanteCantidad,
			pFInfanteSF,
			pFInfanteFee,
			pVUsuarioCreacion,
			now(),
			pVUsuarioCreacion,
			now(),
			1
			
			
		);
		SELECT @@identity AS id_propuesta ;
END$$

DROP PROCEDURE IF EXISTS `usp_listar_propuestas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_listar_propuestas` (IN `pIDCotizacion` INT)  BEGIN
	SELECT  propuestas.id_cotizacion,
	        propuestas.id_propuesta,
		propuestas.tipo_viaje,
		propuestas.id_aerolinea,
		aerolineas.compania AS 'aerolinea',
		ufnt_obtener_cantidad_pasajeros_x_propuesta(propuestas.id_propuesta) AS cantidad_pasajeros,
		propuestas.id_moneda,
		monedas.nombre,
		ufnt_obtener_cantidad_sf_x_propuesta(propuestas.id_propuesta) AS cantidad_sf,
		ufnt_obtener_cantidad_fee_x_propuesta(propuestas.id_propuesta) AS cantidad_fee,
		IF(propuestas.estado = 1, 'Registrado','Cancelado') AS estado ,
		propuestas.usuario_modificacion,
		propuestas.fecha_modificacion
	  FROM  tb_propuestas propuestas
    INNER JOIN  tb_aerolineas aerolineas
	    ON  (propuestas.id_aerolinea =  aerolineas.id_aerolinea)
    INNER JOIN  tb_monedas monedas
	    ON  (propuestas.id_moneda = monedas.id_moneda)
	 WHERE  propuestas.id_cotizacion = pIDCotizacion
      ORDER BY  propuestas.fecha_creacion ASC;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `ufnt_obtener_cantidad_fee_x_propuesta`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `ufnt_obtener_cantidad_fee_x_propuesta` (`pIDPropuesta` INT) RETURNS INT(11) BEGIN
    DECLARE cantidadFEE int;
    
	SELECT SUM( adultos_fee + ninio_fee + infante_fee ) AS 'cantidad_sf'
	  INTO cantidadFEE
	  FROM tb_propuestas
	 WHERE id_propuesta = pIDPropuesta;	 
RETURN cantidadFEE;
	
END$$

DROP FUNCTION IF EXISTS `ufnt_obtener_cantidad_pasajeros_x_propuesta`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `ufnt_obtener_cantidad_pasajeros_x_propuesta` (`pIDPropuesta` INT) RETURNS INT(11) BEGIN
    DECLARE cantidadPasajeros int;
    
	SELECT SUM( adultos_cantidad + ninio_cantidad + infante_cantidad ) AS 'cantidad_pasajeros'
	  INTO cantidadPasajeros
	  FROM tb_propuestas
	 WHERE id_propuesta = pIDPropuesta;
RETURN cantidadPasajeros;
	
END$$

DROP FUNCTION IF EXISTS `ufnt_obtener_cantidad_sf_x_propuesta`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `ufnt_obtener_cantidad_sf_x_propuesta` (`pIDPropuesta` INT) RETURNS INT(11) BEGIN
    DECLARE cantidadSF int;
    
	SELECT SUM( adultos_sf + ninio_sf + infante_sf ) AS 'cantidad_sf'
	  INTO cantidadSF
	  FROM tb_propuestas
	 WHERE id_propuesta = pIDPropuesta;	 
RETURN cantidadSF;
	
END$$

DROP FUNCTION IF EXISTS `ufnt_obtener_itinerario_x_propuesta`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `ufnt_obtener_itinerario_x_propuesta` (`pIDPropuesta` INT) RETURNS INT(11) BEGIN
    DECLARE itinerarios int DEFAULT 0 ;
    
	SELECT COUNT(1)
	  INTO itinerarios
	  FROM tb_itinerarios
	 WHERE id_propuesta = pIDPropuesta;
	
RETURN itinerarios;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_aerolineas`
--

DROP TABLE IF EXISTS `tb_aerolineas`;
CREATE TABLE IF NOT EXISTS `tb_aerolineas` (
  `id_aerolinea` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text COLLATE utf8_spanish_ci,
  `url` text COLLATE utf8_spanish_ci,
  `compania` text COLLATE utf8_spanish_ci,
  `direccion` text COLLATE utf8_spanish_ci,
  `telefono` text COLLATE utf8_spanish_ci,
  `telefono_carga` text COLLATE utf8_spanish_ci,
  `tipo` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aerolinea`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_aerolineas`
--

INSERT INTO `tb_aerolineas` (`id_aerolinea`, `codigo`, `url`, `compania`, `direccion`, `telefono`, `telefono_carga`, `tipo`, `fecha_creacion`, `estado`) VALUES
(1, 'Q6', 'http://www.aerocondor.com.pe', 'AEROCONDOR', 'JR. JUAN DE ARONA 781 - SAN ISIDRO / AV. JAVIER PRADO OESTE 1972 - SAN BORJA', '614-6014 / 225-7816 / 225-7877', '', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(2, 'AT', 'http://www.atsaperu.com', 'AERO TRANSPORTE S.A.', 'AEROPUERTO INTERNACIONAL JORGE CHÁVEZ', '575-1702', '', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(3, 'CA', '', 'CIELOS ANDINOS', '', '462-7107', '', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(4, 'LCB', '', 'LC BUSRE', 'CALLE LOS TULIPANES 218 URB. SAN EUGENIO - LINCE', '619-1313 / 9813*1665', '', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(5, '2I', 'https://www.starperu.com/es/', 'STAR PERÚ', 'AV. JOSÉ PARDO 485 - MIRAFLORES', '705-9000', '484-0199 / 9755-4110', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(6, 'TA', 'https://www.avianca.com/pe/es/', 'AVIANCA', 'PISO 04, AV. JOSÉ PARDO 831, MIRAFLORES', '511-8222', '484-0510 / 9837*8188', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(7, 'LA', 'https://www.latam.com/es_pe/', 'LAN PERÚ', 'AV. JOSÉ PARDO 513 2DO. PISO - MIRAFLORES', '0-801-112-34 213-8200', '574-1835 574-2132', 'AEROLÍNEA NACIONAL', '2019-04-12 04:13:01', 1),
(8, 'AR', '', 'AEROLÍNEAS ARGENTINAS', 'AV. CANAVAL Y MOREIRA 370 - SAN ISIDRO', '0-800-522-00', '575-1050', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(9, 'AM', '', 'AEROMÉXICO', 'AV. PARDO Y ALIAGA 699 OF. 501C - SAN ISIDRO / SWISSOTEL - VÍA CENTRAL 150 CENTRO EMPRESARIAL REAL - SAN ISIDRO', '421-3500 / 421-4400', '574-5982', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(10, '5L', '', 'AEROSUR', 'CALLE BOLOGNESI 291, MIRAFLORES', '241-6767', '', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(11, 'AC', 'https://www.aircanada.com/pe/es/aco/home.html', 'AIR CANADA', 'CALLE ITALIA 389 OF. 101 - MIRAFLORES', '0-800-520-73 241-1457', '421-2482 / 422-2135', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(12, 'AF', 'https://www.airfrance.es', 'AIR FRANCE', 'AV. ALVAREZ CALDERÓN 185 6TO.PISO - SAN ISIDRO', '213-0200', '574-5493', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(13, 'NM', '', 'AIR MADRID', 'AV. JOSÉ PARDO 269 - MIRAFLORES', '214-1040', '', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(14, 'A7', '', 'AIR COMET', 'AV. CANAVAL Y MOREIRA 370 - SAN ISIDRO / AV. PARDO Nº. 482 - MIRAFLORES', ' ', '', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(15, 'AZ', 'https://www.alitalia.com/es_es', 'ALITALIA', 'AV. JOSÉ PARDO 601 OF. 804 - MIRAFLORES', '444-9285', '344-0286 / 9830*6771', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(16, 'AA', 'https://www.aa.com.pe/homePage.do?locale=es_PE', 'AMERICAN AIRLINES', 'AV. CANAVAL Y MOREIRA 390 1ER. PISO - SAN ISIDRO / AV. LARCO 687 2DO. PISO B13 - MIRAFLORES', '0-800-403-50 211-7000 / 575-1547 575-1087', '484-0440 484-0666', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(17, 'AV', 'http://www.avianca.com/', 'AVIANCA', 'AV. JOSÉ PARDO 140 - MIRAFLORES', '0-800-519-36', '484-0111 / 484-0640', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(18, 'CO', '', 'CONTINENTAL AIRLINES', 'VÍCTOR ANDRÉS BELAÚNDE 147 OF. 101 EDIFICIO REAL 5 - SAN ISIDRO / AV. LARCO 1315 - MIRAFLORES', '0-800-700-30 / 712-9230', '575-5054 / 575-2720', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(19, 'CM', 'https://www.copaair.com/es/web/gs', 'COPA AIRLINES', 'CENTRO EMPRESARIAL TORRE CHOCAVENTO OF. 105 - SAN ISIDRO', '610-0808', '574-8320', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(20, 'DL', '', 'DELTA AIRLINES2', 'VÍCTOR ANDRÉS BELAÚNDE 147 OF. 701 EDIFICIO REAL 3 - SAN ISIDRO', '0-800-432-10 211-921', '575-4908', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(21, 'IB', 'https://www.iberia.com/pe/', 'IBERIA', 'AV. CAMINO REAL 390 TORRE CENTRAL OF. 902 - SAN ISIDRO', '411-7801', '574-2398 / 574-2399', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(23, 'KL', '', 'KLM', 'AV. ALVAREZ CALDERÓN 185 OF. 601 - SAN ISIDRO', '213-0200', '574-5493 / 574-5494', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(24, 'LA', '', 'LAN AIRLINES', 'AV. JOSÉ PARDO 513 2DO. PISO - MIRAFLORES / JR. DE LA UNIÓN 908 - LIMA (GRAN HOTEL BOLÍVAR) / AV. JAVIER PRADO ESTE 4200 - SANTIAGO DE SURCO (C.C. JOCKEY PLAZA) / AV. ALFREDO MENDIOLA 3698 - INDEPENDENCIA', '0-801-112-34 213-8200', '574-1835 / 574-2132', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(25, 'LB', '', 'LLOYD AÉREO BOLIVIANO', 'AV. JOSÉ PARDO 231 1ER. Y 7MO. PISO - MIRAFLORES', '241-5210 444-0510', '574-5625 / 9836*1318', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(26, 'SP', '', 'SPIRIT AIRLINES', '', '', '', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(27, 'TA', '', 'TACA PERÚ', 'AV. COMANDANTE ESPINAR 331 - MIRAFLORES', '511-8222', '484-0510 / 9837*8188', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
(28, 'RG', '', 'VARIG', 'AV. CAMINO REAL 456 OF. 803 - 804 TORRE REAL - SAN ISIDRO', '221-0628 221-0645', '575-6666 9814*1348', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_aeropuertos`
--

DROP TABLE IF EXISTS `tb_aeropuertos`;
CREATE TABLE IF NOT EXISTS `tb_aeropuertos` (
  `id_aeropuerto` int(11) NOT NULL AUTO_INCREMENT,
  `id_ciudad` int(11) DEFAULT NULL,
  `codigo` text COLLATE utf8_spanish_ci,
  `nombre` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_aeropuerto`),
  KEY `id_ciudad` (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_aeropuertos`
--

INSERT INTO `tb_aeropuertos` (`id_aeropuerto`, `id_ciudad`, `codigo`, `nombre`, `fecha_creacion`, `estado`) VALUES
(1, 1, 'TXL', 'TEGEL', '2019-04-12 18:50:21', 1),
(2, 1, 'THF', 'TEMPELHOF', '2019-04-12 18:50:21', 1),
(3, 1, 'SXF', 'SCHONEFELD', '2019-04-12 18:50:21', 1),
(4, 2, 'CGN', 'COLONIA', '2019-04-12 18:50:21', 1),
(5, 3, 'DUS', 'DUSSELDORF', '2019-04-12 18:50:21', 1),
(6, 4, 'FRA', 'FRANKFURT INT.', '2019-04-12 18:50:21', 1),
(7, 5, 'HAM', 'FUHLSBUETTEL', '2019-04-12 18:50:21', 1),
(8, 6, 'MUC', 'FRANZ STRAUSS', '2019-04-12 18:50:21', 1),
(9, 7, 'STR', 'ECHTERDINGEN', '2019-04-12 18:50:21', 1),
(10, 8, 'LAD', '4 DE FEVEREIRO', '2019-04-12 18:50:21', 1),
(11, 9, 'CUR', 'APTO. HATO', '2019-04-12 18:50:21', 1),
(12, 10, 'ANU', 'V. C. BIRD INT.', '2019-04-12 18:50:21', 1),
(13, 11, 'ALG', 'HOUARI-BOUMEDIENNE', '2019-04-12 18:50:21', 1),
(14, 12, 'BRC', 'BARILOCHE', '2019-04-12 18:50:21', 1),
(15, 13, 'BUE', 'EZEIZA', '2019-04-12 18:50:21', 1),
(16, 13, 'AEP', 'AEROPARQUE', '2019-04-12 18:50:21', 1),
(17, 14, 'FTE', 'CALAFATE', '2019-04-12 18:50:21', 1),
(18, 15, 'COR', 'CÓRDOBA', '2019-04-12 18:50:21', 1),
(19, 16, 'IGR', 'PUERTO IGUAZÚ', '2019-04-12 18:50:21', 1),
(20, 17, 'ROS', 'ISLAS MALVINAS', '2019-04-12 18:50:21', 1),
(21, 18, 'MDZ', 'PLUMERILLO', '2019-04-12 18:50:21', 1),
(22, 19, 'SFN', 'SAUCE VIEJO', '2019-04-12 18:50:21', 1),
(23, 20, 'USH', 'USHUAIA', '2019-04-12 18:50:21', 1),
(24, 21, 'AUA', 'REINA BEATRIX', '2019-04-12 18:50:21', 1),
(25, 22, 'MEL', 'TULLAMARINE', '2019-04-12 18:50:21', 1),
(26, 23, 'SYD', 'KINGSFORD SMITH', '2019-04-12 18:50:21', 1),
(27, 24, 'GRZ', 'THALERHOF', '2019-04-12 18:50:21', 1),
(28, 25, 'VIE', 'VIENA INT.', '2019-04-12 18:50:21', 1),
(29, 26, 'NAS', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(30, 26, 'PID', 'PARADISE ISLAND', '2019-04-12 18:50:21', 1),
(31, 27, 'BGI', 'G. ADAMS INT.', '2019-04-12 18:50:21', 1),
(32, 28, 'BRU', 'NATIONAL', '2019-04-12 18:50:21', 1),
(33, 29, 'CBB', 'WILSTERMAN', '2019-04-12 18:50:21', 1),
(34, 30, 'LPB', 'EL ALTO', '2019-04-12 18:50:21', 1),
(35, 31, 'VVI', 'VIRU VIRU INT.', '2019-04-12 18:50:21', 1),
(36, 32, 'SJJ', 'BUTMIR', '2019-04-12 18:50:21', 1),
(37, 33, 'BEL', 'VAL DE CANS', '2019-04-12 18:50:21', 1),
(38, 34, 'CNF', 'TANCREDO NEVES', '2019-04-12 18:50:21', 1),
(39, 34, 'PLU', 'PAMPULHA', '2019-04-12 18:50:21', 1),
(40, 35, 'BSB', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(41, 36, 'CPQ', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(42, 37, 'CWB', 'ALFONSO PENA', '2019-04-12 18:50:21', 1),
(43, 38, 'FLN', 'HERCILIO LUZ', '2019-04-12 18:50:21', 1),
(44, 39, 'FOR', 'PINTO MARTINS', '2019-04-12 18:50:21', 1),
(45, 40, 'IGU', 'CATARATAS', '2019-04-12 18:50:21', 1),
(46, 41, 'IOS', 'EDUARDO GOMES', '2019-04-12 18:50:21', 1),
(47, 42, 'MCZ', 'PALMARES', '2019-04-12 18:50:21', 1),
(48, 43, 'MAO', 'EDUARDO GÓMES INT.', '2019-04-12 18:50:21', 1),
(49, 44, 'POA', 'SALGADO FILHO', '2019-04-12 18:50:21', 1),
(50, 45, 'PVH', 'BELMONTE', '2019-04-12 18:50:21', 1),
(51, 46, 'REC', 'GUARARAPES INT.', '2019-04-12 18:50:21', 1),
(52, 47, 'GIG', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(53, 47, 'SDU', 'SANTOS DUMONT', '2019-04-12 18:50:21', 1),
(54, 48, 'SSA', 'LUIS E. MAGALHAES', '2019-04-12 18:50:21', 1),
(55, 49, 'SLZ', 'MAL CUNHA MACHA', '2019-04-12 18:50:21', 1),
(56, 50, 'CGH', 'CONGONHAS', '2019-04-12 18:50:21', 1),
(57, 50, 'GRU', 'GUARULHOS', '2019-04-12 18:50:21', 1),
(58, 50, 'VCP', 'VIRACOPOS', '2019-04-12 18:50:21', 1),
(59, 51, 'TBT', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(60, 52, 'SOF', 'VRAZHDEBNA', '2019-04-12 18:50:21', 1),
(61, 53, 'YUL', 'DORVAL', '2019-04-12 18:50:21', 1),
(62, 53, 'YMX', 'MIRABEL INT.', '2019-04-12 18:50:21', 1),
(63, 54, 'YOW', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(64, 55, 'YYZ', 'PEARSON INT.', '2019-04-12 18:50:21', 1),
(65, 55, 'YKZ', 'BUTTONVILLE', '2019-04-12 18:50:21', 1),
(66, 56, 'YVR', 'INTERNATIONAL', '2019-04-12 18:50:21', 1),
(67, 57, 'SVO', 'SHEREMETYEVO', '2019-04-12 18:50:21', 1),
(68, 57, 'DME', 'DOMODEDOVO', '2019-04-12 18:50:21', 1),
(69, 57, 'VKO', 'VNUKOVO', '2019-04-12 18:50:21', 1),
(70, 58, 'ANF', 'CERRO MORENO', '2019-04-12 18:50:21', 1),
(71, 59, 'ARI', 'CHACALLUTA', '2019-04-12 18:50:21', 1),
(72, 60, 'IQQ', 'DIEGO ARACENA', '2019-04-12 18:50:21', 1),
(73, 61, 'PMC', 'TEPUAL', '2019-04-12 18:50:21', 1),
(74, 62, 'PUQ', 'PRESIDENTE IBÁÑEZ', '2019-04-12 18:50:21', 1),
(75, 63, 'SCL', 'A. M. BENÍTEZ', '2019-04-12 18:50:21', 1),
(76, 64, 'BJS', 'BEIJING', '2019-04-12 18:50:21', 1),
(77, 65, 'SHA', 'HONGQIAO', '2019-04-12 18:50:21', 1),
(78, 66, 'BAQ', 'E. CORTISSOZ', '2019-04-12 18:50:22', 1),
(79, 67, 'BOG', 'EL DORADO', '2019-04-12 18:50:22', 1),
(80, 68, 'CLO', 'A. BONILLA ARAGÓN', '2019-04-12 18:50:22', 1),
(81, 69, 'CTG', 'RAFAEL NUÑEZ INT.', '2019-04-12 18:50:22', 1),
(82, 70, 'PEI', 'INT. MATECAÑA', '2019-04-12 18:50:22', 1),
(83, 71, 'MDE', 'JOSÉ MARÍA CORDOVA', '2019-04-12 18:50:22', 1),
(84, 72, 'BZV', 'MAYA MAYA', '2019-04-12 18:50:22', 1),
(85, 73, 'SEL', 'INCHEON INTERNACIONAL', '2019-04-12 18:50:22', 1),
(86, 74, 'SJO', 'JUAN SANTAMARÍA INT.', '2019-04-12 18:50:22', 1),
(87, 75, 'HAV', 'JOSÉ MARTÍ INT.', '2019-04-12 18:50:22', 1),
(88, 76, 'VRA', 'JUAN GUALBERTO GÓMEZ', '2019-04-12 18:50:22', 1),
(89, 77, 'CPH', 'COPENHAGUE', '2019-04-12 18:50:22', 1),
(90, 78, 'GYE', 'SIMÓN BOLÍVAR', '2019-04-12 18:50:22', 1),
(91, 79, 'UIO', 'MARISCAL SUCRE', '2019-04-12 18:50:22', 1),
(92, 80, 'CAI', 'INTERNATIONAL', '2019-04-12 18:50:22', 1),
(93, 81, 'SAL', 'COMALAPA INT.', '2019-04-12 18:50:22', 1),
(94, 82, 'GLA', 'GLASGOW', '2019-04-12 18:50:22', 1),
(95, 82, 'PIK', 'PRESTWICK', '2019-04-12 18:50:22', 1),
(96, 83, 'BTS', 'IVANKA', '2019-04-12 18:50:22', 1),
(97, 84, 'LJU', 'BRNIK', '2019-04-12 18:50:22', 1),
(98, 85, 'ALI', 'EL ALTET', '2019-04-12 18:50:22', 1),
(99, 86, 'BCN', 'EL PRAT', '2019-04-12 18:50:22', 1),
(100, 87, 'BIO', 'SONDICA', '2019-04-12 18:50:22', 1),
(101, 88, 'IBZ', 'IBIZA', '2019-04-12 18:50:22', 1),
(102, 89, 'ACE', 'LANZAROTE', '2019-04-12 18:50:22', 1),
(103, 90, 'LPA', 'GANDO', '2019-04-12 18:50:22', 1),
(104, 91, 'MAD', 'BARAJAS', '2019-04-12 18:50:22', 1),
(105, 92, 'AGP', 'PABLO PICASSO', '2019-04-12 18:50:22', 1),
(106, 93, 'PMI', 'SON SAN JUAN', '2019-04-12 18:50:22', 1),
(107, 94, 'SCQ', 'LA BACOLLA', '2019-04-12 18:50:22', 1),
(108, 95, 'TFN', 'LOS RODEOS', '2019-04-12 18:50:22', 1),
(109, 95, 'TFS', 'REINA SOFÍA', '2019-04-12 18:50:22', 1),
(110, 96, 'VLC', 'MANISES', '2019-04-12 18:50:22', 1),
(111, 97, 'VGO', 'PEINADOR', '2019-04-12 18:50:22', 1),
(112, 98, 'MNL', 'NINOY AQUINO INT.', '2019-04-12 18:50:22', 1),
(113, 99, 'HEL', 'HELSINKI-VANTAA', '2019-04-12 18:50:22', 1),
(114, 100, 'LYS', 'SATOLAS', '2019-04-12 18:50:22', 1),
(115, 101, 'CDG', 'CHARLES DE GAULLE', '2019-04-12 18:50:22', 1),
(116, 101, 'ORY', 'ORLY', '2019-04-12 18:50:22', 1),
(117, 102, 'ATH', 'ELEFTHERIOS VENIZELOS', '2019-04-12 18:50:22', 1),
(118, 103, 'PTP', 'LE RAIZET', '2019-04-12 18:50:22', 1),
(119, 104, 'GUA', 'LA AURORA', '2019-04-12 18:50:22', 1),
(120, 105, 'CAY', 'ROCHAMBEAU', '2019-04-12 18:50:22', 1),
(121, 106, 'GEO', 'CHEDDI JAGAN', '2019-04-12 18:50:22', 1),
(122, 107, 'PAP', 'INTERNATIONAL', '2019-04-12 18:50:22', 1),
(123, 108, 'HNL', 'INTERNATIONAL', '2019-04-12 18:50:22', 1),
(124, 109, 'AMS', 'SCHIPHOL INT.', '2019-04-12 18:50:22', 1),
(125, 110, 'RTM', 'ROTTERDAM', '2019-04-12 18:50:22', 1),
(126, 111, 'TGU', 'TONCONTIN', '2019-04-12 18:50:22', 1),
(127, 112, 'HKG', 'INTERNATIONAL', '2019-04-12 18:50:22', 1),
(128, 113, 'BUD', 'FERIHEGY', '2019-04-12 18:50:22', 1),
(129, 114, 'CCU', 'NETAJI SUBHAS', '2019-04-12 18:50:22', 1),
(130, 115, 'DEL', 'INDIRA GANDHI INT.', '2019-04-12 18:50:22', 1),
(131, 116, 'BOM', 'BOMBAY', '2019-04-12 18:50:22', 1),
(132, 117, 'CGK', 'SOEKARNO-HATTA INT.', '2019-04-12 18:50:22', 1),
(133, 117, 'HLP', 'HALIM PERDANA KUSAMA', '2019-04-12 18:50:22', 1),
(134, 118, 'BFS', 'BELFAST INT.', '2019-04-12 18:50:22', 1),
(135, 118, 'BHD', 'BELFAST CITY', '2019-04-12 18:50:22', 1),
(136, 119, 'LHR', 'HEATHROW', '2019-04-12 18:50:22', 1),
(137, 119, 'LGW', 'GATWICK', '2019-04-12 18:50:22', 1),
(138, 119, 'STN', 'STANSTED', '2019-04-12 18:50:22', 1),
(139, 119, 'LTN', 'LUTON INT.', '2019-04-12 18:50:22', 1),
(140, 119, 'LCY', 'LONDON CITY AIRPORT', '2019-04-12 18:50:22', 1),
(141, 120, 'THR', 'MEHRABAD', '2019-04-12 18:50:22', 1),
(142, 121, 'SNN', 'SHANNON', '2019-04-12 18:50:22', 1),
(143, 122, 'TLV', 'BEN GURION', '2019-04-12 18:50:22', 1),
(144, 123, 'BRI', 'PALESE', '2019-04-12 18:50:22', 1),
(145, 124, 'GOA', 'C. COLOMBO', '2019-04-12 18:50:22', 1),
(146, 125, 'LIN', 'LINATE', '2019-04-12 18:50:22', 1),
(147, 125, 'MXP', 'MALPENSA', '2019-04-12 18:50:22', 1),
(148, 126, 'NAP', 'NÁPOLES INT.', '2019-04-12 18:50:22', 1),
(149, 127, 'FCO', 'FIUMICINO', '2019-04-12 18:50:22', 1),
(150, 128, 'KIN', 'NORMAN MANLEY', '2019-04-12 18:50:22', 1),
(151, 128, 'KTP', 'TINSON', '2019-04-12 18:50:22', 1),
(152, 129, 'NGO', 'KOMAKI', '2019-04-12 18:50:22', 1),
(153, 130, 'KIX', 'KANSAI INT.', '2019-04-12 18:50:22', 1),
(154, 131, 'HND', 'HANEDA', '2019-04-12 18:50:22', 1),
(155, 131, 'NRT', 'NARITA', '2019-04-12 18:50:23', 1),
(156, 132, 'NBO', 'KENYATTA', '2019-04-12 18:50:23', 1),
(157, 132, 'WIL', 'WILSON', '2019-04-12 18:50:23', 1),
(158, 133, 'BEY', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(159, 134, 'KUL', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(160, 135, 'MLA', 'LUQA', '2019-04-12 18:50:23', 1),
(161, 136, 'CMN', 'MOHAMMED V', '2019-04-12 18:50:23', 1),
(162, 137, 'RBA', 'SALE', '2019-04-12 18:50:23', 1),
(163, 138, 'ACA', 'INT. GRAL. JUAN ALVAREZ', '2019-04-12 18:50:23', 1),
(164, 139, 'CUN', 'CANCÚN', '2019-04-12 18:50:23', 1),
(165, 140, 'MID', 'MANUEL REJON', '2019-04-12 18:50:23', 1),
(166, 141, 'MEX', 'BENITO JUÁREZ', '2019-04-12 18:50:23', 1),
(167, 142, 'RGN', 'YANGON INT.', '2019-04-12 18:50:23', 1),
(168, 143, 'MGA', 'INT. AUGUSTO SANDINO', '2019-04-12 18:50:23', 1),
(169, 144, 'L0S', 'MURTALA MUHAMMED', '2019-04-12 18:50:23', 1),
(170, 145, 'BGO', 'FLESLAND', '2019-04-12 18:50:23', 1),
(171, 146, 'FBU', 'FORNEBU', '2019-04-12 18:50:23', 1),
(172, 146, 'GEN', 'GARDERMOEN', '2019-04-12 18:50:23', 1),
(173, 147, 'AKL', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(174, 148, 'KHI', 'QUAID - E - AZAM', '2019-04-12 18:50:23', 1),
(175, 149, 'PTY', 'TOCUMEN INTL.', '2019-04-12 18:50:23', 1),
(176, 150, 'ASU', 'SILVIO PETTIROSSI', '2019-04-12 18:50:23', 1),
(177, 151, 'IQT', 'FCO. SECADA', '2019-04-12 18:50:23', 1),
(178, 152, 'LIM', 'JORGE CHAVEZ INT.', '2019-04-12 18:50:23', 1),
(179, 153, 'PIU', 'PIURA', '2019-04-12 18:50:23', 1),
(180, 154, 'PPT', 'FAAA', '2019-04-12 18:50:23', 1),
(181, 155, 'WAW', 'OKECIE', '2019-04-12 18:50:23', 1),
(182, 156, 'LIS', 'LISBOA', '2019-04-12 18:50:23', 1),
(183, 157, 'OPO', 'PORTO', '2019-04-12 18:50:23', 1),
(184, 158, 'SJU', 'L. MUÑÓZ MARÍN INT.', '2019-04-12 18:50:23', 1),
(185, 158, 'SIG', 'ISLA GRANDE', '2019-04-12 18:50:23', 1),
(186, 159, 'PRG', 'RUZYNE', '2019-04-12 18:50:23', 1),
(187, 160, 'SDQ', 'LAS AMÉRICAS', '2019-04-12 18:50:23', 1),
(188, 161, 'BBU', 'BANEASA', '2019-04-12 18:50:23', 1),
(189, 161, 'OTP', 'OTOPENI', '2019-04-12 18:50:23', 1),
(190, 162, 'DKR', 'YOFF', '2019-04-12 18:50:23', 1),
(191, 163, 'SIN', 'CHANGI', '2019-04-12 18:50:23', 1),
(192, 164, 'CPT', 'CAPETOWN INT.', '2019-04-12 18:50:23', 1),
(193, 165, 'JNB', 'JOHANNESBURG INT.', '2019-04-12 18:50:23', 1),
(194, 166, 'ARN', 'ARLANDA', '2019-04-12 18:50:23', 1),
(195, 166, 'BMA', 'BROMMA', '2019-04-12 18:50:23', 1),
(196, 167, 'BSL', 'BASEL', '2019-04-12 18:50:23', 1),
(197, 168, 'GVA', 'GENEVA/COINTRIN', '2019-04-12 18:50:23', 1),
(198, 169, 'ZRH', 'ZURICH', '2019-04-12 18:50:23', 1),
(199, 170, 'PMB', 'ZANDERIJ', '2019-04-12 18:50:23', 1),
(200, 171, 'TPE', 'CHIANG KAI SHEK INT.', '2019-04-12 18:50:23', 1),
(201, 172, 'BKK', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(202, 173, 'POS', 'PIARCO', '2019-04-12 18:50:23', 1),
(203, 174, 'IST', 'ATATURK', '2019-04-12 18:50:23', 1),
(204, 175, 'KBP', 'BORISPOL', '2019-04-12 18:50:23', 1),
(205, 175, 'IEV', 'ZHULHANY', '2019-04-12 18:50:23', 1),
(206, 176, 'MVD', 'CARRASCO', '2019-04-12 18:50:23', 1),
(207, 177, 'MCO', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(208, 178, 'ATL', 'HARTSFIELD INT.', '2019-04-12 18:50:23', 1),
(209, 179, 'BWI', 'BALTIMORE-WASH INT.', '2019-04-12 18:50:23', 1),
(210, 180, 'BOS', 'LOGAN INT.', '2019-04-12 18:50:23', 1),
(211, 181, 'ORD', 'O\'HARE-INTERNATIONAL', '2019-04-12 18:50:23', 1),
(212, 181, 'MDW', 'MIDWAY', '2019-04-12 18:50:23', 1),
(213, 181, 'CGX', 'MEIGS FIELD', '2019-04-12 18:50:23', 1),
(214, 182, 'DFW', 'DALLAS/FT.WORTH INT.', '2019-04-12 18:50:23', 1),
(215, 183, 'HOU', 'HOBBY', '2019-04-12 18:50:23', 1),
(216, 183, 'IAH', 'GEORGE BUSH', '2019-04-12 18:50:23', 1),
(217, 184, 'LAX', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(218, 185, 'MEM', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(219, 186, 'MIA', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(220, 187, 'MSY', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(221, 188, 'JFK', 'J. F. KENNEDY INT.', '2019-04-12 18:50:23', 1),
(222, 188, 'LGA', 'LA GUARDIA', '2019-04-12 18:50:23', 1),
(223, 188, 'EWR', 'NEWARK INT.', '2019-04-12 18:50:23', 1),
(224, 189, 'PDX', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(225, 190, 'SFO', 'INTERNATIONAL', '2019-04-12 18:50:23', 1),
(226, 190, 'OAK', 'METROPOLITAN OAKLAND', '2019-04-12 18:50:23', 1),
(227, 191, 'SEA', 'SEATTLE-TACOMA INT.', '2019-04-12 18:50:23', 1),
(228, 192, 'IAD', 'DULLES INT.', '2019-04-12 18:50:23', 1),
(229, 192, 'DCA', 'REAGAN INT.', '2019-04-12 18:50:23', 1),
(230, 192, 'BWI', 'BALTIMORE/WASHINGTON INT.', '2019-04-12 18:50:23', 1),
(231, 193, 'CCS', 'SIMÓN BOLÍVAR', '2019-04-12 18:50:23', 1),
(232, 194, 'MAR', 'LA CHINITA', '2019-04-12 18:50:23', 1),
(233, 195, 'PMV', 'DEL CARIBE', '2019-04-12 18:50:23', 1),
(234, 196, 'BEG', 'BELGRADE', '2019-04-12 18:50:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ciudades`
--

DROP TABLE IF EXISTS `tb_ciudades`;
CREATE TABLE IF NOT EXISTS `tb_ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) DEFAULT NULL,
  `nombre` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_ciudad`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_ciudades`
--

INSERT INTO `tb_ciudades` (`id_ciudad`, `id_pais`, `nombre`, `fecha_creacion`, `estado`) VALUES
(1, 1, 'BERLÍN', '2019-04-12 18:48:54', 1),
(2, 1, 'COLONIA', '2019-04-12 18:48:54', 1),
(3, 1, 'DUSSELDORF', '2019-04-12 18:48:54', 1),
(4, 1, 'FRANKFURT', '2019-04-12 18:48:54', 1),
(5, 1, 'HAMBURGO', '2019-04-12 18:48:54', 1),
(6, 1, 'MUNICH', '2019-04-12 18:48:54', 1),
(7, 1, 'STUTTGART', '2019-04-12 18:48:54', 1),
(8, 2, 'LUANDA', '2019-04-12 18:48:54', 1),
(9, 3, 'CURACAO', '2019-04-12 18:48:54', 1),
(10, 4, 'ANTIGUA', '2019-04-12 18:48:54', 1),
(11, 5, 'ARGEL', '2019-04-12 18:48:54', 1),
(12, 6, 'BARILOCHE', '2019-04-12 18:48:54', 1),
(13, 6, 'BUENOS AIRES', '2019-04-12 18:48:54', 1),
(14, 6, 'CALAFATE', '2019-04-12 18:48:54', 1),
(15, 6, 'CÓRDOBA', '2019-04-12 18:48:54', 1),
(16, 6, 'PUERTO IGUAZÚ', '2019-04-12 18:48:54', 1),
(17, 6, 'ROSARIO', '2019-04-12 18:48:54', 1),
(18, 6, 'MENDOZA', '2019-04-12 18:48:54', 1),
(19, 6, 'SANTA FÉ', '2019-04-12 18:48:54', 1),
(20, 6, 'USHUAIA', '2019-04-12 18:48:54', 1),
(21, 7, 'ARUBA', '2019-04-12 18:48:54', 1),
(22, 8, 'MELBOURNE', '2019-04-12 18:48:54', 1),
(23, 8, 'SYDNEY', '2019-04-12 18:48:54', 1),
(24, 9, 'GRAZ', '2019-04-12 18:48:54', 1),
(25, 9, 'VIENA', '2019-04-12 18:48:54', 1),
(26, 10, 'NASSAU', '2019-04-12 18:48:54', 1),
(27, 11, 'BARBADOS', '2019-04-12 18:48:54', 1),
(28, 12, 'BRUSELAS', '2019-04-12 18:48:54', 1),
(29, 13, 'COCHABAMBA', '2019-04-12 18:48:54', 1),
(30, 13, 'LA PAZ', '2019-04-12 18:48:54', 1),
(31, 13, 'STA. CRUZ DE LA SIERRA', '2019-04-12 18:48:54', 1),
(32, 14, 'SARAJEVO', '2019-04-12 18:48:54', 1),
(33, 15, 'BELEM', '2019-04-12 18:48:54', 1),
(34, 15, 'BELO HORIZONTE', '2019-04-12 18:48:54', 1),
(35, 15, 'BRASILIA', '2019-04-12 18:48:54', 1),
(36, 15, 'CAMPINAS', '2019-04-12 18:48:54', 1),
(37, 15, 'CURITIBA', '2019-04-12 18:48:54', 1),
(38, 15, 'FLORIANÓPOLIS', '2019-04-12 18:48:54', 1),
(39, 15, 'FORTALEZA', '2019-04-12 18:48:54', 1),
(40, 15, 'FOZ DE IGUAZÚ', '2019-04-12 18:48:54', 1),
(41, 15, 'ILHEUS', '2019-04-12 18:48:54', 1),
(42, 15, 'MACEIÓ', '2019-04-12 18:48:54', 1),
(43, 15, 'MANAOS', '2019-04-12 18:48:54', 1),
(44, 15, 'PORTO ALEGRE', '2019-04-12 18:48:54', 1),
(45, 15, 'PORTO VELHO', '2019-04-12 18:48:54', 1),
(46, 15, 'RECIFE', '2019-04-12 18:48:54', 1),
(47, 15, 'RÍO DE JANEIRO', '2019-04-12 18:48:54', 1),
(48, 15, 'SALVADOR', '2019-04-12 18:48:54', 1),
(49, 15, 'SAO LUIZ', '2019-04-12 18:48:55', 1),
(50, 15, 'SAO PAULO', '2019-04-12 18:48:55', 1),
(51, 15, 'TABATINGA', '2019-04-12 18:48:55', 1),
(52, 16, 'SOFÍA', '2019-04-12 18:48:55', 1),
(53, 17, 'MONTREAL', '2019-04-12 18:48:55', 1),
(54, 17, 'OTTAWA', '2019-04-12 18:48:55', 1),
(55, 17, 'TORONTO', '2019-04-12 18:48:55', 1),
(56, 17, 'VANCOUVER', '2019-04-12 18:48:55', 1),
(57, 18, 'MOSCÚ', '2019-04-12 18:48:55', 1),
(58, 19, 'ANTOFAGASTA', '2019-04-12 18:48:55', 1),
(59, 19, 'ARICA', '2019-04-12 18:48:55', 1),
(60, 19, 'IQUIQUE', '2019-04-12 18:48:55', 1),
(61, 19, 'PUERTO MONTT', '2019-04-12 18:48:55', 1),
(62, 19, 'PUNTA ARENAS', '2019-04-12 18:48:55', 1),
(63, 19, 'SANTIAGO DE CHILE', '2019-04-12 18:48:55', 1),
(64, 20, 'BEIJING', '2019-04-12 18:48:55', 1),
(65, 20, 'SHANGHAI', '2019-04-12 18:48:55', 1),
(66, 21, 'BARRANQUILLA', '2019-04-12 18:48:55', 1),
(67, 21, 'BOGOTÁ', '2019-04-12 18:48:55', 1),
(68, 21, 'CALI', '2019-04-12 18:48:55', 1),
(69, 21, 'CARTAGENA', '2019-04-12 18:48:55', 1),
(70, 21, 'PEREIRA', '2019-04-12 18:48:55', 1),
(71, 21, 'MEDELLÍN', '2019-04-12 18:48:55', 1),
(72, 22, 'BRAZZAVILLE', '2019-04-12 18:48:55', 1),
(73, 23, 'SEÚL', '2019-04-12 18:48:55', 1),
(74, 24, 'SAN JOSÉ', '2019-04-12 18:48:55', 1),
(75, 25, 'HABANA', '2019-04-12 18:48:55', 1),
(76, 25, 'VARADERO', '2019-04-12 18:48:55', 1),
(77, 26, 'COPENHAGUE', '2019-04-12 18:48:55', 1),
(78, 27, 'GUAYAQUIL', '2019-04-12 18:48:55', 1),
(79, 27, 'QUITO', '2019-04-12 18:48:55', 1),
(80, 28, 'EL CAIRO', '2019-04-12 18:48:55', 1),
(81, 29, 'SAN SALVADOR', '2019-04-12 18:48:55', 1),
(82, 30, 'GLASGOW', '2019-04-12 18:48:55', 1),
(83, 31, 'BRATISLAVA', '2019-04-12 18:48:55', 1),
(84, 32, 'LJULBJAND', '2019-04-12 18:48:55', 1),
(85, 33, 'ALICANTE', '2019-04-12 18:48:55', 1),
(86, 33, 'BARCELONA', '2019-04-12 18:48:55', 1),
(87, 33, 'BILBAO', '2019-04-12 18:48:55', 1),
(88, 33, 'IBIZA', '2019-04-12 18:48:55', 1),
(89, 33, 'LANZAROTE', '2019-04-12 18:48:55', 1),
(90, 33, 'LAS PALMAS', '2019-04-12 18:48:55', 1),
(91, 33, 'MADRID', '2019-04-12 18:48:55', 1),
(92, 33, 'MÁLAGA', '2019-04-12 18:48:55', 1),
(93, 33, 'PALMA DE MALLORCA', '2019-04-12 18:48:55', 1),
(94, 33, 'STGO. DE COMPOSTELA', '2019-04-12 18:48:55', 1),
(95, 33, 'TENERIFE', '2019-04-12 18:48:55', 1),
(96, 33, 'VALENCIA', '2019-04-12 18:48:55', 1),
(97, 33, 'VIGO', '2019-04-12 18:48:55', 1),
(98, 34, 'MANILA', '2019-04-12 18:48:55', 1),
(99, 35, 'HELSINKI', '2019-04-12 18:48:55', 1),
(100, 36, 'LYON', '2019-04-12 18:48:55', 1),
(101, 36, 'PARÍS', '2019-04-12 18:48:55', 1),
(102, 37, 'ATENAS', '2019-04-12 18:48:55', 1),
(103, 38, 'POINTE A PITRE', '2019-04-12 18:48:55', 1),
(104, 39, 'GUATEMALA', '2019-04-12 18:48:55', 1),
(105, 40, 'CAYENNE', '2019-04-12 18:48:55', 1),
(106, 41, 'GEORGETOWN', '2019-04-12 18:48:55', 1),
(107, 42, 'PORT', '2019-04-12 18:48:55', 1),
(108, 43, 'HONOLULU', '2019-04-12 18:48:55', 1),
(109, 44, 'AMSTERDAM', '2019-04-12 18:48:55', 1),
(110, 44, 'ROTTERDAM', '2019-04-12 18:48:55', 1),
(111, 45, 'TEGUCIGALPA', '2019-04-12 18:48:55', 1),
(112, 46, 'HONG KONG', '2019-04-12 18:48:55', 1),
(113, 47, 'BUDAPEST', '2019-04-12 18:48:55', 1),
(114, 48, 'CALCUTA', '2019-04-12 18:48:55', 1),
(115, 48, 'NUEVA DELHI', '2019-04-12 18:48:55', 1),
(116, 48, 'MUMBAY', '2019-04-12 18:48:55', 1),
(117, 49, 'JAKARTA', '2019-04-12 18:48:55', 1),
(118, 50, 'BELFAST', '2019-04-12 18:48:55', 1),
(119, 50, 'LONDRES', '2019-04-12 18:48:55', 1),
(120, 51, 'TEHERÁN', '2019-04-12 18:48:55', 1),
(121, 52, 'SHANNON', '2019-04-12 18:48:55', 1),
(122, 53, 'TEL AVIV', '2019-04-12 18:48:55', 1),
(123, 54, 'BARI', '2019-04-12 18:48:55', 1),
(124, 54, 'GÉNOVA', '2019-04-12 18:48:55', 1),
(125, 54, 'MILÁN', '2019-04-12 18:48:55', 1),
(126, 54, 'NÁPOLES', '2019-04-12 18:48:55', 1),
(127, 54, 'ROMA', '2019-04-12 18:48:55', 1),
(128, 55, 'KINGSTON', '2019-04-12 18:48:55', 1),
(129, 56, 'NAGOYA', '2019-04-12 18:48:55', 1),
(130, 56, 'OSAKA', '2019-04-12 18:48:55', 1),
(131, 56, 'TOKIO', '2019-04-12 18:48:55', 1),
(132, 57, 'NAIROBI', '2019-04-12 18:48:55', 1),
(133, 58, 'BEIRUT', '2019-04-12 18:48:55', 1),
(134, 59, 'KUALA LUMPUR', '2019-04-12 18:48:55', 1),
(135, 60, 'MALTA', '2019-04-12 18:48:55', 1),
(136, 61, 'CASABLANCA', '2019-04-12 18:48:55', 1),
(137, 61, 'RABAT', '2019-04-12 18:48:55', 1),
(138, 62, 'ACAPULCO', '2019-04-12 18:48:55', 1),
(139, 62, 'CANCÚN', '2019-04-12 18:48:55', 1),
(140, 62, 'MÉRIDA', '2019-04-12 18:48:55', 1),
(141, 62, 'MÉXICO', '2019-04-12 18:48:55', 1),
(142, 63, 'YANGON', '2019-04-12 18:48:55', 1),
(143, 64, 'MANAGUA', '2019-04-12 18:48:56', 1),
(144, 65, 'LAGOS', '2019-04-12 18:48:56', 1),
(145, 66, 'BERGEN', '2019-04-12 18:48:56', 1),
(146, 66, 'OSLO', '2019-04-12 18:48:56', 1),
(147, 67, 'AUCKLAND', '2019-04-12 18:48:56', 1),
(148, 68, 'KARACHI', '2019-04-12 18:48:56', 1),
(149, 69, 'PANAMÁ', '2019-04-12 18:48:56', 1),
(150, 70, 'ASUNCIÓN', '2019-04-12 18:48:56', 1),
(151, 71, 'IQUITOS', '2019-04-12 18:48:56', 1),
(152, 71, 'LIMA', '2019-04-12 18:48:56', 1),
(153, 71, 'PIURA', '2019-04-12 18:48:56', 1),
(154, 72, 'PAPETE', '2019-04-12 18:48:56', 1),
(155, 73, 'VARSOVIA', '2019-04-12 18:48:56', 1),
(156, 74, 'LISBOA', '2019-04-12 18:48:56', 1),
(157, 74, 'OPORTO', '2019-04-12 18:48:56', 1),
(158, 75, 'SAN JUAN', '2019-04-12 18:48:56', 1),
(159, 76, 'PRAGA', '2019-04-12 18:48:56', 1),
(160, 77, 'STO. DOMINGO', '2019-04-12 18:48:56', 1),
(161, 78, 'BUCAREST', '2019-04-12 18:48:56', 1),
(162, 79, 'DAKAR', '2019-04-12 18:48:56', 1),
(163, 80, 'SINGAPUR', '2019-04-12 18:48:56', 1),
(164, 81, 'CIUDAD DEL CABO', '2019-04-12 18:48:56', 1),
(165, 81, 'JOHANNESBURGO', '2019-04-12 18:48:56', 1),
(166, 82, 'ESTOCOLMO', '2019-04-12 18:48:56', 1),
(167, 83, 'BASILEA', '2019-04-12 18:48:56', 1),
(168, 83, 'GINEBRA', '2019-04-12 18:48:56', 1),
(169, 83, 'ZURICH', '2019-04-12 18:48:56', 1),
(170, 84, 'PARAMARIBO', '2019-04-12 18:48:56', 1),
(171, 85, 'TAIPEI', '2019-04-12 18:48:56', 1),
(172, 86, 'BANGKOK', '2019-04-12 18:48:56', 1),
(173, 87, 'PUERTO ESPAÑA', '2019-04-12 18:48:56', 1),
(174, 88, 'ESTAMBUL', '2019-04-12 18:48:56', 1),
(175, 89, 'KIEV', '2019-04-12 18:48:56', 1),
(176, 90, 'MONTEVIDEO', '2019-04-12 18:48:56', 1),
(177, 91, 'ORLANDO', '2019-04-12 18:48:56', 1),
(178, 91, 'ATLANTA', '2019-04-12 18:48:56', 1),
(179, 91, 'BALTIMORE', '2019-04-12 18:48:56', 1),
(180, 91, 'BOSTON', '2019-04-12 18:48:56', 1),
(181, 91, 'CHICAGO', '2019-04-12 18:48:56', 1),
(182, 91, 'DALLAS', '2019-04-12 18:48:56', 1),
(183, 91, 'HOUSTON', '2019-04-12 18:48:56', 1),
(184, 91, 'LOS ANGELES', '2019-04-12 18:48:56', 1),
(185, 91, 'MEMPHIS', '2019-04-12 18:48:56', 1),
(186, 91, 'MIAMI', '2019-04-12 18:48:56', 1),
(187, 91, 'NUEVA ORLEANS', '2019-04-12 18:48:56', 1),
(188, 91, 'NUEVA YORK', '2019-04-12 18:48:56', 1),
(189, 91, 'PORTLAND', '2019-04-12 18:48:56', 1),
(190, 91, 'SAN FRANCISCO', '2019-04-12 18:48:56', 1),
(191, 91, 'SEATTLE', '2019-04-12 18:48:56', 1),
(192, 91, 'WASHINGTON', '2019-04-12 18:48:56', 1),
(193, 92, 'CARACAS', '2019-04-12 18:48:56', 1),
(194, 92, 'MARACAIBO', '2019-04-12 18:48:56', 1),
(195, 92, 'PORLAMAR', '2019-04-12 18:48:56', 1),
(196, 93, 'BELGRADO', '2019-04-12 18:48:56', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

DROP TABLE IF EXISTS `tb_clientes`;
CREATE TABLE IF NOT EXISTS `tb_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` text COLLATE utf8_spanish_ci,
  `apellidos` text COLLATE utf8_spanish_ci,
  `tipo_documento` text COLLATE utf8_spanish_ci,
  `numero_documento` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` text COLLATE utf8_spanish_ci,
  `correo` text COLLATE utf8_spanish_ci,
  `fecha_nacimiento` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `nombres`, `apellidos`, `tipo_documento`, `numero_documento`, `telefono`, `correo`, `fecha_nacimiento`, `fecha_creacion`, `estado`) VALUES
(1, 'ENRIC', 'PARRAMON FLORES', 'PASAPORTE', '6086175809', '900228420', 'yadigoco@yahoo.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(2, 'LINA JHINET', 'ESPITIA LEON', 'PASAPORTE', '8283987389', '900558916', 'mirleycita@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(3, 'MONICA', 'MONROY CAICEDO', 'PASAPORTE', '3844933728', '901242181', 'elleinabonfante@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(4, 'ZANDRA LUCIA', 'ALFONSO PEÑA', 'RUC', '4380159824', '902007058', 'ceprevi@terra.com.br', '1980-11-02', '2019-04-10 22:33:18', 1),
(5, 'OLGA MERCEDES ', 'HIGUERA RODRIGUEZ', 'RUC', '1846015304', '903221940', 'psicologia@vercontigo.com.mx', '1980-11-02', '2019-04-10 22:33:18', 1),
(6, 'DOUNYA ', 'ZAFRA FIGULS', 'RUC', '1402178983', '903548658', 'oyarmar@hotmail.com  ', '1980-11-02', '2019-04-10 22:33:18', 1),
(7, 'NATALIA ELVIRA ', 'TORRIJOS VELASQUEZ', 'DNI', '4608630488', '903888517', 'braso.lissette@gmail.com ', '1980-11-02', '2019-04-10 22:33:18', 1),
(8, 'CELMIRA PATRICIA ', 'ARROYAVE CORREDOR', 'PASAPORTE', '6865321070', '904197429', 'leonidas.martinez@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:18', 1),
(9, 'MARY LUZ ', 'CORTES MUÑOZ', 'OTROS', '3765005909', '904732308', 'albran@mineduc.gob.gt', '1980-11-02', '2019-04-10 22:33:18', 1),
(10, 'YURY LISSETH ', 'ESPITIA VILLALVA', 'PASAPORTE', '2360531780', '904916891', 'elleinabonfante@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(11, 'SANDRA MILENA ', 'COLMENARES RINCON', 'RUC', '23656074', '905467659', 'ibc@ibcbolivia.org', '1980-11-02', '2019-04-10 22:33:18', 1),
(12, 'TANIA JIMENA ', 'TRUJILLO PEREZ', 'OTROS', '5411518338', '905603028', 'mirleycita@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(13, 'VALENTÍ ', 'GARCIA GARCÍA', 'RUC', '2628641056', '905655765', 'crio@isri.gob.sv', '1980-11-02', '2019-04-10 22:33:18', 1),
(14, 'MARTHA ADRIANA ', 'VILLARREAL MASMELA', 'OTROS', '5658073900', '905715864', 'bienestarestudiantil@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(15, 'KETTY ', 'LOPEZ CONEO', 'RUC', '1413576250', '906267897', 'crac.colombia@etb.net.co', '1980-11-02', '2019-04-10 22:33:18', 1),
(16, 'CRYSHNA CONSUELO ', 'MOSCOSO PEÑA', 'CARNET EXT.', '8599102283', '906295866', 'geraldina.gonzalez@infomed.sld.cu', '1980-11-02', '2019-04-10 22:33:18', 1),
(17, 'HERMES JACOBO ', 'GARCIA GUACANEME', 'CARNET EXT.', '5938133476', '906479908', 'patty-c.p@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(18, 'WILSON ', ' HERNANDEZ MOLANO', 'PASAPORTE', '2633005754', '906694444', 'yadigoco@yahoo.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(19, 'SILVIA ', ' RASERO GAVILAN', 'DNI', '9551686929', '906762539', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:18', 1),
(20, 'LEONARDO ', ' GARZON RAMIREZ', 'DNI', '6324483183', '907319118', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:18', 1),
(21, 'ANDREA ', ' ARIZA ZAMBRANO', 'RUC', '2711955438', '907403078', 'centroderecursos.olgaestrella@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(22, 'SERGI ', ' TORRUELLA GARCIA', 'OTROS', '8010456268', '907796266', 'depneemec@gmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(23, 'GILMA ', ' ESPINOSA DIAZ', 'PASAPORTE', '6257958028', '907989865', 'rosalva.garces@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:18', 1),
(24, 'DIANA PATRICIA ', ' BENAVIDEZ SOLORZA', 'RUC', '9540927808', '908140710', 'depneemec@gmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(25, 'SANDRA PATRICIA ', ' GARZON JIMENEZ', 'OTROS', '4531704091', '908437730', 'alexanderaguirre53hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(26, 'DIANA MARCELA ', ' HERRERA HERRERA', 'CARNET EXT.', '2317782631', '971733547', 'sama1_2@yahoo.es', '1980-11-02', '2019-04-10 22:33:18', 1),
(27, 'LUZ ELENA ', ' VARGAS BALAGUERA', 'CARNET EXT.', '4592251505', '972083594', 'morellaboissiere@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(28, 'GABY ELENITH ', ' MANZANO URIBE', 'PASAPORTE', '3847258996', '972471908', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:18', 1),
(29, 'DIANA CAROLINA ', ' PALACIOS ZAQUE', 'DNI', '3140422929', '972756012', 'sama1_2@yahoo.es', '1980-11-02', '2019-04-10 22:33:18', 1),
(30, 'YANIRA ', ' ARIAS IZQUIERDO', 'OTROS', '3107239875', '972881293', 'patty-c.p@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(31, 'FRANCE JURANNI ', ' CENDALES LADINO', 'PASAPORTE', '2646139282', '973130973', 'noeldita@gmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(32, 'ELKIN RONALD ', ' PUCHE VEGA', 'DNI', '1443040924', '973732397', 'sama1_2@yahoo.es', '1980-11-02', '2019-04-10 22:33:18', 1),
(33, 'CLAUDIA PATRICIA ', ' BOLIVAR CARREÑO', 'CARNET EXT.', '5648818698', '975669874', 'psicologia@vercontigo.com.mx', '1980-11-02', '2019-04-10 22:33:18', 1),
(34, 'MARIA LILIANA ', ' MARTINEZ RIVADENEIRA', 'RUC', '1939771779', '976175908', 'iphe2010@hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(35, 'INGRID YANETH ', ' ENCISO RODRIGUEZ', 'DNI', '2474882024', '976482511', 'alexanderaguirre53hotmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
(36, 'JAVIER ORLANDO ', ' CORREDOR GARCIA', 'DNI', '8447258919', '976540231', 'rosalva.garces@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(37, 'GRACIELA ', ' TORRES TORRES', 'DNI', '1329351023', '976934574', 'eam@once.es', '1980-11-02', '2019-04-10 22:33:19', 1),
(38, 'MADIAN ', ' BOLIVAR SASTOQUE', 'DNI', '3264392709', '977042231', 'leonidas.martinez@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(39, 'RAMON ', ' MORALES GESE', 'OTROS', '4570965919', '977735828', 'rosalva.garces@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(40, 'KETTY ', ' LOZANO PEREA', 'DNI', '9610938684', '978838463', 'rosalva.garces@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(41, 'FABIAN ', ' RICO RODRIGUEZ', 'RUC', '8177553340', '979586720', 'militza.aguero@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(42, 'NORMA CONSTANZA ', ' RAMIREZ PAEZ', 'CARNET EXT.', '5904824727', '979746171', 'albran@mineduc.gob.gt', '1980-11-02', '2019-04-10 22:33:19', 1),
(43, 'JAIRO ', ' MORALES GESE', 'DNI', '228147891', '979769327', 'lili_12812@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(44, 'INGRID ', ' BIDAULT PÉREZ', 'CARNET EXT.', '4907680355', '979781471', 'luzciego@yahoo.es', '1980-11-02', '2019-04-10 22:33:19', 1),
(45, 'LUZ NANCY ', ' LANZA ANGULO', 'OTROS', '2699418533', '915230547', 'depneemec@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(46, 'GLORIA ROCIO ', ' CABRERA SANCHEZ', 'DNI', '6646642887', '916182540', 'crac.colombia@etb.net.co', '1980-11-02', '2019-04-10 22:33:19', 1),
(47, 'ROSA TULIA ', ' AMEZQUITA RIPE', 'PASAPORTE', '3486204891', '916289826', 'pcorrea@utem.cl', '1980-11-02', '2019-04-10 22:33:19', 1),
(48, 'LUIS FELIPE ', ' REINOSA LOPEZ', 'DNI', '629937344', '916996169', 'helenkeller@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(49, 'MARIA ISABEL ', ' MENDEZ TORRES', 'DNI', '9377807896', '918092794', 'psialelongo@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(50, 'NESTOR ELIAS ', ' SABOGAL DIAZ', 'OTROS', '4906564138', '918605265', 'palomaguarachi@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(51, 'SANDRA CRISTINA ', ' DUEÑAS RUIZ', 'CARNET EXT.', '6602719816', '918941699', 'depneemec@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(52, 'ADRIANA ', ' GIRALDO GOMEZ', 'DNI', '3867952482', '919031127', 'alexanderaguirre53hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(53, 'MARTHA JEANETH ', ' AVILA MEDINA', 'DNI', '2773180942', '919233875', 'sama1_2@yahoo.es', '1980-11-02', '2019-04-10 22:33:19', 1),
(54, 'PAOLA ANDREA ', ' GALVIS ZAMORA', 'PASAPORTE', '7508914348', '919552647', 'palomaguarachi@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(55, 'QUERALT ', ' VISO GILABERT', 'DNI', '3664588817', '919572795', 'ceprevi@terra.com.br', '1980-11-02', '2019-04-10 22:33:19', 1),
(56, 'ISABEL GUIOMAR ', ' ANGELINA VILLAREAL TORRES', 'DNI', '2188360291', '919669289', 'alexanderaguirre53hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(57, 'MONICA ', ' QUINTERO PARRA', 'PASAPORTE', '8144574063', '919766636', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:19', 1),
(58, 'MARIA ', ' MOLINER GARRIDO', 'DNI', '810314197', '919912566', 'iphe2010@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(59, 'CAMILO ALEXANDER ', ' BOLIVAR FORERO', 'DNI', '7876606426', '920584995', 'iphe2010@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(60, 'MARIA DEL ROSARIO ', ' LOZANO MURILLO', 'RUC', '5199272072', '921288146', 'yadigoco@yahoo.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(61, 'NIDIA LUZ ', ' ATEHORTUA GIRALDO', 'DNI', '6248911269', '922628686', 'monica.destellosdeluz@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(62, 'GUILLEM ', ' CANELLAS GOMEZ', 'CARNET EXT.', '5762227156', '923339292', 'geraldina.gonzalez@infomed.sld.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(63, 'SANDRA MILENA ', ' SUAREZ AMAYA', 'DNI', '3000558805', '923379808', 'crio@isri.gob.sv', '1980-11-02', '2019-04-10 22:33:19', 1),
(64, 'ALCIRA ', ' SANTANILLA CARVAJAL', 'CARNET EXT.', '9225452085', '924508078', 'patty-c.p@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(65, 'MARIA DEL PILAR ', ' BARAJAS TABIMA', 'OTROS', '229626439', '924629843', 'leonidas.martinez@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(66, 'ALVARO ', ' CALDERON ARTUNDUAGA', 'OTROS', '1819720781', '924790289', 'ceprevi@terra.com.br', '1980-11-02', '2019-04-10 22:33:19', 1),
(67, 'YEIMI YAMILE ', ' CASTILLO ROJAS', 'OTROS', '1732737609', '924938787', 'crio@isri.gob.sv', '1980-11-02', '2019-04-10 22:33:19', 1),
(68, 'VICTORIA EDITH ', ' SANCHEZ TORRES', 'RUC', '2037387163', '925700828', 'mirleycita@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(69, 'JESUS ALVEIRO ', ' VERGEL GRECO', 'RUC', '6989217662', '926234609', 'crac.colombia@etb.net.co', '1980-11-02', '2019-04-10 22:33:19', 1),
(70, 'MONICA LOURDES ', ' CORTINA SILVA', 'RUC', '3428527499', '928277519', 'ASOCIEGOSMANABI@HOTMAIL.COM', '1980-11-02', '2019-04-10 22:33:19', 1),
(71, 'MIREIA ', ' SÁNCHEZ GÓMEZ', 'PASAPORTE', '1353083557', '930102864', 'ASOCIEGOSMANABI@HOTMAIL.COM', '1980-11-02', '2019-04-10 22:33:19', 1),
(72, 'LUZ ROSARIO ', ' ARENAS LOPEZ', 'OTROS', '7609274622', '930300341', 'noeldita@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(73, 'NANCY MIREYA ', ' GONZALEZ TAUTIVA', 'DNI', '9859164224', '930338342', 'crac.colombia@etb.net.co', '1980-11-02', '2019-04-10 22:33:19', 1),
(74, 'NESTOR IVAN ', ' BARRIOS JARAMILLO', 'OTROS', '6248944542', '930572827', 'nedelsy@yahoo.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(75, 'MARTHA ELVIRA ', ' ZAMBRANO BALLEN', 'DNI', '6121523985', '930738988', 'geraldina.gonzalez@infomed.sld.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(76, 'GERARD ', ' CANO GÓMEZ', 'OTROS', '1274004790', '931216335', 'militza.aguero@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(77, 'ANDREA LILIANA ', ' SAMPER MARTINEZ', 'CARNET EXT.', '6635339389', '931478666', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:19', 1),
(78, 'VICTORIA EUGENIA ', ' CASTAÑEDA QUICENO', 'CARNET EXT.', '88569679', '932103787', 'palomaguarachi@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(79, 'ELIZABETH ', ' CARDENAS MARTINEZ', 'RUC', '3406718802', '932202787', 'braso.lissette@gmail.com ', '1980-11-02', '2019-04-10 22:33:19', 1),
(80, 'MAGDA LILIANA ', ' ALAIX ACOSTA', 'OTROS', '7665514446', '932766088', 'iphe2010@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(81, 'NESTOR LEONARDO ', ' PATIÑO NEIRA', 'PASAPORTE', '8000165341', '934367539', 'infracnovi_hn@yahoo.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(82, 'SANDRA BEATRIZ ', ' SARMIENTO BEJARANO', 'RUC', '8841378533', '934761309', 'ceprevi@terra.com.br', '1980-11-02', '2019-04-10 22:33:19', 1),
(83, 'MIRLEDIS JOHANA ', ' CERA BELEÑO', 'CARNET EXT.', '8413100430', '935153253', 'depneemec@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(84, 'INGRID MAGALY ', ' GONZALEZ ROMERO', 'PASAPORTE', '5817921591', '935460461', 'infracnovi_hn@yahoo.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(85, 'LUISA ', ' FERNANDA SANCHEZ', 'DNI', '1673342465', '936186391', 'psicologia@vercontigo.com.mx', '1980-11-02', '2019-04-10 22:33:19', 1),
(86, 'GLORIA AMPARO ', ' PEREZ OSSA', 'CARNET EXT.', '6401195932', '938842036', 'YOVIRROSANIA@HOTMAIL.COM', '1980-11-02', '2019-04-10 22:33:19', 1),
(87, 'MARIA DEL PILAR ', ' CASTILLO PINILLA', 'PASAPORTE', '293774672', '938892437', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:19', 1),
(88, 'DIANA PATRICIA ', ' AVILA SAENZ', 'CARNET EXT.', '23666053', '939061072', 'psictlaso@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(89, 'MARIO ', ' PASCUAL FLORES', 'DNI', '2741656452', '939097791', 'elleinabonfante@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(90, 'ANNA ', ' RIVERO FLORIDO', 'CARNET EXT.', '1291563776', '939420463', 'infracnovi_hn@yahoo.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(91, 'SANDRA PATRICIA ', ' MANOSALVA AGUDELO', 'CARNET EXT.', '609849926', '940462739', 'patty-c.p@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(92, 'TANIA MARCELA ', ' MANJARRES GARCIA', 'DNI', '6841912567', '940535184', 'stella_nino@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(93, 'MARIBEL ', ' PATIÑO ROMERO', 'OTROS', '89172011', '941409792', 'oyarmar@hotmail.com  ', '1980-11-02', '2019-04-10 22:33:19', 1),
(94, 'BERTHA XIMENA ', 'PATRICIA BARBOSA TORRES', 'CARNET EXT.', '9352927720', '941658910', 'luzciego@yahoo.es', '1980-11-02', '2019-04-10 22:33:19', 1),
(95, 'ROSA ', ' RODRIGUEZ LEON', 'CARNET EXT.', '8453079788', '942180957', 'lili_12812@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(96, 'CONSUELO ', ' GUERRERO CALDERON', 'RUC', '3789692273', '942202071', 'centroderecursos.olgaestrella@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(97, 'PIEDAD CONSTANZA ', ' MORALES YARURO', 'CARNET EXT.', '3231849098', '943277751', 'cultura@anci.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(98, 'IVAN ', ' LIBORI FIGUERAS', 'PASAPORTE', '1950402912', '943876930', 'crac.colombia@etb.net.co', '1980-11-02', '2019-04-10 22:33:19', 1),
(99, 'RAQUEL ', ' RAYA GARCIA', 'CARNET EXT.', '7325856840', '943952622', 'pcorrea@utem.cl', '1980-11-02', '2019-04-10 22:33:19', 1),
(100, 'ANDREA YOHANNA ', ' PINZON YEPES', 'RUC', '4592847261', '944305017', 'militza.aguero@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(101, 'ANDREA MARCELA ', ' BARRAGAN GARCIA', 'DNI', '8513248061', '944919857', 'palomaguarachi@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(102, 'WILDER ', ' JAVIER RINCON', 'DNI', '8236816670', '945006959', 'cultura@anci.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(103, 'CAROLINA ', ' ISAZA RAMIREZ ', 'CARNET EXT.', '8397155204', '945310654', 'agora@faica.org.ar', '1980-11-02', '2019-04-10 22:33:19', 1),
(104, 'ELIZABETH ', ' JAIMES SANCHEZ', 'PASAPORTE', '7887842397', '945444291', 'eam@once.es', '1980-11-02', '2019-04-10 22:33:19', 1),
(105, 'BETSABE ', ' BAUTISTA VARGAS', 'PASAPORTE', '4976731937', '945445317', 'patty-c.p@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(106, 'LIGIA YANETD ', ' GUERRERO MAHECHA', 'RUC', '5243540188', '945925112', 'cultura@anci.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(107, 'GEMMA ', ' PORTELLA GISPETS', 'PASAPORTE', '5476083610', '946443098', 'iphe2010@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(108, 'PAOLA ANDREA ', ' DIAZ TELLEZ', 'OTROS', '8608818508', '947100448', 'oyarmar@hotmail.com  ', '1980-11-02', '2019-04-10 22:33:19', 1),
(109, 'AGUSTÍ ', ' RIDÓ GÓMEZ', 'CARNET EXT.', '7522215964', '947116500', 'braso.lissette@gmail.com ', '1980-11-02', '2019-04-10 22:33:19', 1),
(110, 'ANDREA PAOLA ', ' GUTIERREZ ROMERO', 'PASAPORTE', '1101095880', '947117065', 'elleinabonfante@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(111, 'KAREN IVETTE ', ' MANOSALVA GOMEZ', 'DNI', '4057558293', '947184150', 'cultura@anci.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(112, 'LAURA GISELA ', ' RODRIGUEZ LEGUIZAMON', 'PASAPORTE', '8881193789', '947903266', 'monica.destellosdeluz@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(113, 'GEMMA GARCIA ', ' ALMOGUERA', 'CARNET EXT.', '4604010863', '948009092', 'centroderecursos.olgaestrella@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(114, 'MARTHA CONSUELO ', ' GOMEZ CORREDOR', 'CARNET EXT.', '4989671750', '948066901', 'crio@isri.gob.sv', '1980-11-02', '2019-04-10 22:33:19', 1),
(115, 'AMELIA ', ' PEREZ TABARES', 'CARNET EXT.', '4751281721', '948178463', 'ibc@ibcbolivia.org', '1980-11-02', '2019-04-10 22:33:19', 1),
(116, 'LUISA FERNANDA ', ' MONTENEGRO VANEGAS', 'DNI', '551693286', '948968385', 'mirleycita@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(117, 'LUCRECIA ', ' PINEDA VARGAS', 'PASAPORTE', '4140782545', '948976464', 'bienestarestudiantil@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(118, 'MARIA ELENA ', ' SALGADO MORENO', 'PASAPORTE', '6053360544', '949165011', 'psictlaso@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(119, 'LUIS FERNANDO ', ' TORRADO LEMUS', 'OTROS', '1489158053', '949581067', 'braso.lissette@gmail.com ', '1980-11-02', '2019-04-10 22:33:19', 1),
(120, 'ANA MARIA ', ' LOZANO SANTOS', 'RUC', '4109376858', '949778132', 'luzciego@yahoo.es', '1980-11-02', '2019-04-10 22:33:19', 1),
(121, 'CLAUDIA MARCELAS ', ' LOZADA ARAGON', 'DNI', '202761642', '950098679', 'rosalva.garces@meduca.gob.pa', '1980-11-02', '2019-04-10 22:33:19', 1),
(122, 'ALEXIA ', ' VALLÉS GIRVENT', 'DNI', '975788843', '950348298', 'monica.destellosdeluz@gmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(123, 'LUZ AMANDA ', ' LEON BERNAL', 'PASAPORTE', '2882438939', '950392432', 'cultura@anci.cu', '1980-11-02', '2019-04-10 22:33:19', 1),
(124, 'SONIA PATRICIA ', ' CAMARGO URREA', 'DNI', '9198073325', '951644967', 'psialelongo@hotmail.com', '1980-11-02', '2019-04-10 22:33:19', 1),
(125, 'MICHAEL ALEXANDER ', ' MURCIA LEGUIZAMON', 'OTROS', '2476476244', '952102981', 'YOVIRROSANIA@HOTMAIL.COM', '1980-11-02', '2019-04-10 22:33:20', 1),
(126, 'JUAN DE JESUS ', ' VALENCIA AREVALO', 'DNI', '2346214648', '952541382', 'pcorrea@utem.cl', '1980-11-02', '2019-04-10 22:33:20', 1),
(127, 'ADRIÀ ', ' RUEDA ALVAREZ', 'OTROS', '2208217149', '952762344', 'ibc@ibcbolivia.org', '1980-11-02', '2019-04-10 22:33:20', 1),
(128, 'DAVID-JESE ', ' BLANCO FONTANET', 'CARNET EXT.', '1658368213', '955046963', 'monica.destellosdeluz@gmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(129, 'ESTHER ', ' PASCUAL ALOY', 'RUC', '9417656285', '955842201', 'oyarmar@hotmail.com  ', '1980-11-02', '2019-04-10 22:33:20', 1),
(130, 'JORGE HUMBERTO ', ' REINA RUEDA', 'CARNET EXT.', '4341916709', '957902362', 'yadigoco@yahoo.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(131, 'NANCY MARCELA ', ' HERNANDEZ PINILLA', 'PASAPORTE', '3298457682', '958052560', 'eam@once.es', '1980-11-02', '2019-04-10 22:33:20', 1),
(132, 'GLORIA PATRICIA ', ' LOPEZ FIGUEROA', 'OTROS', '5425423228', '958523649', 'psictlaso@gmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(133, 'CESAR AUGUSTO ', ' RAMIREZ LAVERDE', 'PASAPORTE', '1530890010', '958580689', 'albran@mineduc.gob.gt', '1980-11-02', '2019-04-10 22:33:20', 1),
(134, 'MARIA ', ' TORRESCASANA GARCIA', 'RUC', '4827046533', '960224856', 'psicologia@vercontigo.com.mx', '1980-11-02', '2019-04-10 22:33:20', 1),
(135, 'YADIRA XIMENA ', ' MORENO SARMIENTO', 'DNI', '5887794521', '960747039', 'geraldina.gonzalez@infomed.sld.cu', '1980-11-02', '2019-04-10 22:33:20', 1),
(136, 'KAREN MARYLIN', 'PIO SAIRE', 'RUC', '1312536239', '960969924', 'psictlaso@gmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(137, 'PAOLA', 'NIÑO AGUILAR', 'OTROS', '6237552859', '961053991', 'palomaguarachi@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(138, 'DIANA MILENA', 'SABOGAL RAMIREZ', 'CARNET EXT.', '7210586551', '961450917', 'albran@mineduc.gob.gt', '1980-11-02', '2019-04-10 22:33:20', 1),
(139, 'MIQUEL', 'LUQUE GARRIGASAIT', 'DNI', '7110159670', '962745393', 'yadigoco@yahoo.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(140, 'BERTA', 'GALOBART GARCIA', 'PASAPORTE', '2767170106', '963716397', 'ASOCIEGOSMANABI@HOTMAIL.COM', '1980-11-02', '2019-04-10 22:33:20', 1),
(141, 'ROCIO', 'MORA RODRIGUEZ', 'DNI', '7933064497', '963755354', 'stella_nino@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(142, 'JORDI', 'BIOSCA FONTANET', 'DNI', '4953095532', '964049474', 'oyarmar@hotmail.com  ', '1980-11-02', '2019-04-10 22:33:20', 1),
(143, 'MARIA CONSTANZA', 'NIÑO RODRIGUEZ', 'CARNET EXT.', '1184833454', '964512850', 'noeldita@gmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(144, 'MARTHA CECILIA', 'TRIVIÑO MELLIZOS', 'DNI', '2994411909', '964655833', 'lili_12812@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(145, 'MARCELA', 'GARCIA TORRES', 'RUC', '6382541136', '964677898', 'stella_nino@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(146, 'ERIKA ANDREA', 'VANEGAS HERRERA', 'DNI', '6523076674', '965423836', 'noeldita@gmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(147, 'ADRIANA MARCELA', 'SALCEDO SEGURA', 'OTROS', '7532280990', '965701189', 'eam@once.es', '1980-11-02', '2019-04-10 22:33:20', 1),
(148, 'MARTHA', 'VILLAMIL GONZALEZ', 'DNI', '1601339489', '966115756', 'sama1_2@yahoo.es', '1980-11-02', '2019-04-10 22:33:20', 1),
(149, 'ALEJANDRA MARIA', 'AGUDELO SUAREZ', 'OTROS', '9888298112', '966264465', 'morellaboissiere@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(150, 'LINA PAOLA', 'VARGA RIVEROS', 'RUC', '369495544', '966392188', 'bienestarestudiantil@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(151, 'YULIAN VIVIANA', 'ARIZA MOSQUERA', 'RUC', '7382737349', '967345576', 'iphe2010@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(152, 'LAURA', 'BIDAULT CULLERÉS', 'RUC', '9699780442', '967852367', 'morellaboissiere@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(153, 'GUSTAVO', 'DIAZ VERA', 'RUC', '2943335759', '968168207', 'ibc@ibcbolivia.org', '1980-11-02', '2019-04-10 22:33:20', 1),
(154, 'GERARD', 'LÓPEZ DE PABLO GARCIA UCEDA', 'RUC', '951636941', '968754960', 'braso.lissette@gmail.com ', '1980-11-02', '2019-04-10 22:33:20', 1),
(156, 'LUZ MARINA', 'MORALES GARCIA', 'PASAPORTE', '6337199046', '970651280', 'alexanderaguirre53hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(157, 'SONIA ESPERANZA', 'ALFONSO PEÑA', 'DNI', '3740696895', '970979901', 'YOVIRROSANIA@HOTMAIL.COM', '1980-11-02', '2019-04-10 22:33:20', 1),
(158, 'MARTHA PATRICIA', 'FORERO SILVA', 'CARNET EXT.', '2389659644', '971145472', 'mayra_sierra@ceiac.org', '1980-11-02', '2019-04-10 22:33:20', 1),
(159, 'LAURA', 'VALLÉS GIRVENT', 'RUC', '34892978', '971262534', 'oyarmar@hotmail.com', '10/11/02yy', '2019-04-10 22:33:20', 1),
(160, 'SANDRA YUCELY', 'GONZALEZ HERNANDEZ', 'RUC', '5461061638', '971520986', 'elleinabonfante@hotmail.com', '1980-11-02', '2019-04-10 22:33:20', 1),
(161, 'JORDI', 'SUAREZ GARZÓN', 'OTROS', '7450267594', '971532269', 'sama1_2@yahoo.es', '1980-11-02', '2019-04-10 22:33:20', 1),
(162, 'PEDRO', 'DELGADO APARICIO', 'DNI', '43775452', '987540474', 'pedro@gmail.com', '09/06/1986', '2019-04-11 00:39:10', 1),
(164, 'JACK2', 'BAUER', 'DNI', '43775859', '987540474', 'jack@gmail.com', '10/06/1982', '2019-04-11 00:48:33', 1),
(165, 'RICARDO ALONSO', 'RODRIGUEZ GONZALES', 'DNI', '25478975', '9857415896', 'rarg@gmail.com', '01/01/1976', '2020-04-15 05:26:22', 1),
(166, 'LAURA', 'DELGADO APARICIO', 'DNI', '43558978', '96524781', 'laura@gmail.com', '02/08/1984', '2020-04-15 05:42:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cotizaciones`
--

DROP TABLE IF EXISTS `tb_cotizaciones`;
CREATE TABLE IF NOT EXISTS `tb_cotizaciones` (
  `id_cotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `usuario_creacion` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `usuario_modificacion` text COLLATE utf8_spanish_ci,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `venta` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cotizacion`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_cotizaciones`
--

INSERT INTO `tb_cotizaciones` (`id_cotizacion`, `id_cliente`, `usuario_creacion`, `fecha_creacion`, `usuario_modificacion`, `fecha_modificacion`, `venta`, `estado`) VALUES
(97, 166, 'kmpio', '2020-05-25 04:58:37', 'kmpio', '2020-05-25 04:58:37', 0, 1),
(98, 136, 'kmpio', '2020-05-28 04:11:43', 'kmpio', '2020-05-28 04:11:43', 0, 1),
(99, 136, 'kmpio', '2020-05-28 15:35:29', 'kmpio', '2020-05-28 15:35:29', 0, 1),
(100, 33, 'kmpio', '2020-05-28 15:39:26', 'kmpio', '2020-05-28 15:39:26', 0, 1),
(101, 136, 'kmpio', '2020-05-30 05:01:37', 'kmpio', '2020-05-30 05:01:37', 0, 1),
(102, 136, 'kmpio', '2020-06-04 05:21:41', 'kmpio', '2020-06-04 05:21:41', 0, 1),
(103, 29, 'kmpio', '2020-07-04 03:35:12', 'kmpio', '2020-07-04 03:35:12', 0, 1),
(104, 29, 'kmpio', '2020-07-04 04:35:59', 'kmpio', '2020-07-04 04:35:59', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_galeria`
--

DROP TABLE IF EXISTS `tb_galeria`;
CREATE TABLE IF NOT EXISTS `tb_galeria` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `v_ruta` text,
  `i_orden` int(11) DEFAULT NULL,
  `v_fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `i_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_galeria`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_galeria`
--

INSERT INTO `tb_galeria` (`id_galeria`, `v_ruta`, `i_orden`, `v_fecha_registro`, `i_estado`) VALUES
(28, 'vistas/assets/images/galeria/galeria341.jpg', 5, '2020-03-26 07:45:12', NULL),
(26, 'vistas/assets/images/galeria/galeria687.jpg', 2, '2020-03-26 07:45:04', NULL),
(25, 'vistas/assets/images/galeria/galeria228.jpg', 3, '2020-03-26 07:45:01', NULL),
(24, 'vistas/assets/images/galeria/galeria495.jpg', 4, '2020-03-26 07:44:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_itinerarios`
--

DROP TABLE IF EXISTS `tb_itinerarios`;
CREATE TABLE IF NOT EXISTS `tb_itinerarios` (
  `id_itinerario` int(11) NOT NULL AUTO_INCREMENT,
  `id_propuesta` int(11) DEFAULT NULL,
  `aeropuerto_origen` int(11) DEFAULT NULL,
  `aeropuerto_destino` int(11) DEFAULT NULL,
  `fecha_viaje` text COLLATE utf8_spanish_ci,
  `usuario_creacion` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `usuario_modificacio` text COLLATE utf8_spanish_ci,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_itinerario`),
  KEY `id_propuesta` (`id_propuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_itinerarios`
--

INSERT INTO `tb_itinerarios` (`id_itinerario`, `id_propuesta`, `aeropuerto_origen`, `aeropuerto_destino`, `fecha_viaje`, `usuario_creacion`, `fecha_creacion`, `usuario_modificacio`, `fecha_modificacion`, `estado`) VALUES
(49, 60, 178, 61, '01 mayo, 2020 01:00 AM - 02 mayo, 2020 02:00 AM', 'kmpio', '2020-05-25 04:58:37', 'kmpio', '2020-05-25 04:58:37', 1),
(50, 60, 61, 114, '03 mayo, 2020 03:00 AM - 04 mayo, 2020 04:00 AM', 'kmpio', '2020-05-25 04:58:37', 'kmpio', '2020-05-25 04:58:37', 1),
(51, 60, 2, 4, '05 mayo, 2020 05:00 AM - 06 mayo, 2020 06:00 AM', 'kmpio', '2020-05-25 04:58:37', 'kmpio', '2020-05-25 04:58:37', 1),
(52, 60, 3, 8, '07 mayo, 2020 07:00 AM - 08 mayo, 2020 08:00 AM', 'kmpio', '2020-05-25 04:58:37', 'kmpio', '2020-05-25 04:58:37', 1),
(53, 61, 3, 178, '09 mayo, 2020 09:00 AM - 10 mayo, 2020 10:00 AM', 'kmpio', '2020-05-25 05:00:23', 'kmpio', '2020-05-25 05:00:23', 1),
(54, 62, 61, 178, '27 mayo, 2020 11:00 PM - 30 mayo, 2020 03:00 AM', 'kmpio', '2020-05-28 04:11:43', 'kmpio', '2020-05-28 04:11:43', 1),
(55, 63, 37, 192, '28 mayo, 2020 10:00 AM - 30 mayo, 2020 02:00 PM', 'kmpio', '2020-05-28 15:35:29', 'kmpio', '2020-05-28 15:35:29', 1),
(56, 64, 192, 192, '28 mayo, 2020 10:00 AM - 31 mayo, 2020 02:00 PM', 'kmpio', '2020-05-28 15:39:26', 'kmpio', '2020-05-28 15:39:26', 1),
(57, 65, 178, 7, '01 junio, 2020 12:00 AM - 03 junio, 2020 04:00 AM', 'kmpio', '2020-05-30 05:01:37', 'kmpio', '2020-05-30 05:01:37', 1),
(58, 66, 7, 116, '04 junio, 2020 12:00 AM - 05 junio, 2020 04:00 AM', 'kmpio', '2020-05-30 05:03:37', 'kmpio', '2020-05-30 05:03:37', 1),
(59, 67, 115, 4, '15 mayo, 2020 12:00 AM - 17 mayo, 2020 04:00 AM', 'kmpio', '2020-05-30 05:05:48', 'kmpio', '2020-05-30 05:05:48', 1),
(62, 70, 4, 7, '18 mayo, 2020 12:00 AM - 22 mayo, 2020 04:00 AM', 'kmpio', '2020-05-30 05:07:55', 'kmpio', '2020-05-30 05:07:55', 1),
(63, 71, 76, 178, '05 junio, 2020 12:00 AM - 07 junio, 2020 04:00 AM', 'kmpio', '2020-06-04 05:21:41', 'kmpio', '2020-06-04 05:21:41', 1),
(64, 72, 61, 178, '01 julio, 2020 10:00 PM - 12 julio, 2020 02:00 AM', 'kmpio', '2020-07-04 03:35:12', 'kmpio', '2020-07-04 03:35:12', 1),
(65, 72, 178, 37, '13 julio, 2020 10:00 PM - 19 julio, 2020 02:00 AM', 'kmpio', '2020-07-04 03:35:12', 'kmpio', '2020-07-04 03:35:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_mensajes`
--

DROP TABLE IF EXISTS `tb_mensajes`;
CREATE TABLE IF NOT EXISTS `tb_mensajes` (
  `id_mensajes` int(11) NOT NULL AUTO_INCREMENT,
  `v_nombre` text,
  `v_email` text,
  `v_asunto` text,
  `v_mensaje` text,
  `i_revision` int(11) DEFAULT NULL,
  `v_fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `i_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mensajes`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_mensajes`
--

INSERT INTO `tb_mensajes` (`id_mensajes`, `v_nombre`, `v_email`, `v_asunto`, `v_mensaje`, `i_revision`, `v_fecha_registro`, `i_estado`) VALUES
(1, 'Natalia', 'naty@hotmail.com', NULL, 'Lorem ipsum 2 dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1, '2016-12-13 15:59:57', 1),
(2, 'Miguel', 'miguel@hotmail.com', NULL, 'Phasellus dui dui, hendrerit eget luctus eget, lobortis in nibh. Pellentesque orci justo, lacinia iaculis nisl pretium, pharetra congue quam. Vivamus vulputate magna sit amet velit laoreet vestibulum. Aliquam maximus, diam vel dapibus pretium, neque nisi tincidunt est, dapibus placerat elit lacus eget turpis. Duis gravida, purus lobortis pulvinar fermentum, tellus magna dignissim ante, sed sollicitudin massa odio eget mi. Maecenas gravida elit vel porta luctus. Phasellus feugiat nisl in quam efficitur scelerisque. Aenean at ultricies nibh, suscipit vulputate nunc. Donec sit amet tortor in arcu vulputate aliquet et sit amet arcu. Nulla dignissim, massa nec pharetra luctus, dolor dolor tempor leo, id tempus lorem turpis non odio.', 0, '2017-01-13 14:07:02', 1),
(3, 'Ana', 'ana@hotmail.com', NULL, 'Aliquam erat volutpat. Vestibulum ullamcorper vestibulum enim, vel pretium lorem maximus non. Ut ut diam eu quam ornare ultrices. Pellentesque eleifend, dolor non aliquet egestas, sapien diam cursus sem, id iaculis risus ex eget diam. In non nunc quis nisl placerat euismod quis id dui. Donec at lorem eu erat mollis rutrum in ac massa. Quisque nulla arcu, sollicitudin dapibus ex sit amet, tristique iaculis neque. Sed sed tempor neque. Ut maximus, arcu at fermentum cursus, ligula massa ultrices neque, id tempor mauris eros ut lectus. Fusce hendrerit ornare lorem ut auctor. Praesent varius feugiat nulla, vitae euismod tortor tempor nec. Cras cursus tincidunt nunc, ac porta quam bibendum at. Aliquam eleifend lacus mi, non rhoncus felis interdum ut. Maecenas interdum ultrices ornare. Nullam sit amet nunc ac enim posuere imperdiet.', 1, '2017-01-13 14:15:19', 1),
(4, 'Maria', 'maria@hotmail.com', NULL, 'Phasellus dui dui, hendrerit eget luctus eget, lobortis in nibh. Pellentesque orci justo, lacinia iaculis nisl pretium, pharetra congue quam. Vivamus vulputate magna sit amet velit laoreet vestibulum. Aliquam maximus, diam vel dapibus pretium, neque nisi tincidunt est, dapibus placerat elit lacus eget turpis. Duis gravida, purus lobortis pulvinar fermentum, tellus magna dignissim ante, sed sollicitudin massa odio eget mi. Maecenas gravida elit vel porta luctus. Phasellus feugiat nisl in quam efficitur scelerisque. Aenean at ultricies nibh, suscipit vulputate nunc. Donec sit amet tortor in arcu vulputate aliquet et sit amet arcu. Nulla dignissim, massa nec pharetra luctus, dolor dolor tempor leo, id tempus lorem turpis non odio.', 0, '2017-01-13 14:07:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_monedas`
--

DROP TABLE IF EXISTS `tb_monedas`;
CREATE TABLE IF NOT EXISTS `tb_monedas` (
  `id_moneda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci,
  `simbolo` text COLLATE utf8_spanish_ci,
  `compra` text COLLATE utf8_spanish_ci,
  `venta` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_moneda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_monedas`
--

INSERT INTO `tb_monedas` (`id_moneda`, `nombre`, `simbolo`, `compra`, `venta`, `fecha_creacion`, `estado`) VALUES
(1, 'EUROS', '€', '4.00', '4.00', '2019-04-11 01:38:17', 1),
(2, 'DOLARES', '$', '3.14', '5.12', '2019-04-11 17:57:19', 1),
(3, 'NUEVOS SOLES', 'S/.', '1', '1', '2019-04-27 05:15:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_paises`
--

DROP TABLE IF EXISTS `tb_paises`;
CREATE TABLE IF NOT EXISTS `tb_paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_paises`
--

INSERT INTO `tb_paises` (`id_pais`, `nombre`, `fecha_creacion`, `estado`) VALUES
(1, 'ALEMANIA', '2019-04-12 18:47:42', 1),
(2, 'ANGOLA', '2019-04-12 18:47:42', 1),
(3, 'ANTILLAS HOL.', '2019-04-12 18:47:42', 1),
(4, 'ANTIGUA', '2019-04-12 18:47:42', 1),
(5, 'ARGELIA', '2019-04-12 18:47:42', 1),
(6, 'ARGENTINA', '2019-04-12 18:47:42', 1),
(7, 'ARUBA', '2019-04-12 18:47:42', 1),
(8, 'AUSTRALIA', '2019-04-12 18:47:42', 1),
(9, 'AUSTRIA', '2019-04-12 18:47:42', 1),
(10, 'BAHAMAS', '2019-04-12 18:47:42', 1),
(11, 'BARBADOS', '2019-04-12 18:47:42', 1),
(12, 'BÉLGICA', '2019-04-12 18:47:42', 1),
(13, 'BOLIVIA', '2019-04-12 18:47:42', 1),
(14, 'BOSNIA', '2019-04-12 18:47:42', 1),
(15, 'BRASIL', '2019-04-12 18:47:42', 1),
(16, 'BULGARIA', '2019-04-12 18:47:42', 1),
(17, 'CANADÁ', '2019-04-12 18:47:42', 1),
(18, 'CEI', '2019-04-12 18:47:42', 1),
(19, 'CHILE', '2019-04-12 18:47:42', 1),
(20, 'CHINA', '2019-04-12 18:47:42', 1),
(21, 'COLOMBIA', '2019-04-12 18:47:42', 1),
(22, 'CONGO', '2019-04-12 18:47:42', 1),
(23, 'COREA', '2019-04-12 18:47:42', 1),
(24, 'COSTA RICA', '2019-04-12 18:47:42', 1),
(25, 'CUBA', '2019-04-12 18:47:42', 1),
(26, 'DINAMARCA', '2019-04-12 18:47:42', 1),
(27, 'ECUADOR', '2019-04-12 18:47:42', 1),
(28, 'EGIPTO', '2019-04-12 18:47:42', 1),
(29, 'EL SALVADOR', '2019-04-12 18:47:42', 1),
(30, 'ESCOCIA', '2019-04-12 18:47:42', 1),
(31, 'ESLOVAQUIA', '2019-04-12 18:47:43', 1),
(32, 'ESLOVENIA', '2019-04-12 18:47:43', 1),
(33, 'ESPAÑA', '2019-04-12 18:47:43', 1),
(34, 'FILIPINAS', '2019-04-12 18:47:43', 1),
(35, 'FINLANDIA', '2019-04-12 18:47:43', 1),
(36, 'FRANCIA', '2019-04-12 18:47:43', 1),
(37, 'GRECIA', '2019-04-12 18:47:43', 1),
(38, 'GUADALUPE', '2019-04-12 18:47:43', 1),
(39, 'GUATEMALA', '2019-04-12 18:47:43', 1),
(40, 'GUYANA FR.', '2019-04-12 18:47:43', 1),
(41, 'GUYANA', '2019-04-12 18:47:43', 1),
(42, 'HAITI', '2019-04-12 18:47:43', 1),
(43, 'HAWAII', '2019-04-12 18:47:43', 1),
(44, 'HOLANDA', '2019-04-12 18:47:43', 1),
(45, 'HONDURAS', '2019-04-12 18:47:43', 1),
(46, 'HONG KONG', '2019-04-12 18:47:43', 1),
(47, 'HUNGRÍA', '2019-04-12 18:47:43', 1),
(48, 'INDIA', '2019-04-12 18:47:43', 1),
(49, 'INDONESIA', '2019-04-12 18:47:43', 1),
(50, 'INGLATERRA', '2019-04-12 18:47:43', 1),
(51, 'IRÁN', '2019-04-12 18:47:43', 1),
(52, 'IRLANDA', '2019-04-12 18:47:43', 1),
(53, 'ISRAEL', '2019-04-12 18:47:43', 1),
(54, 'ITALIA', '2019-04-12 18:47:43', 1),
(55, 'JAMAICA', '2019-04-12 18:47:43', 1),
(56, 'JAPÓN', '2019-04-12 18:47:43', 1),
(57, 'KENYA', '2019-04-12 18:47:43', 1),
(58, 'LÍBANO', '2019-04-12 18:47:43', 1),
(59, 'MALASIA', '2019-04-12 18:47:43', 1),
(60, 'MALTA', '2019-04-12 18:47:43', 1),
(61, 'MARRUECOS', '2019-04-12 18:47:43', 1),
(62, 'MÉXICO', '2019-04-12 18:47:43', 1),
(63, 'MYANMAR', '2019-04-12 18:47:43', 1),
(64, 'NICARAGUA', '2019-04-12 18:47:43', 1),
(65, 'NIGERIA', '2019-04-12 18:47:43', 1),
(66, 'NORUEGA', '2019-04-12 18:47:43', 1),
(67, 'NVA. ZELANDA', '2019-04-12 18:47:43', 1),
(68, 'PAKISTÁN', '2019-04-12 18:47:43', 1),
(69, 'PANAMÁ', '2019-04-12 18:47:43', 1),
(70, 'PARAGUAY', '2019-04-12 18:47:43', 1),
(71, 'PERÚ', '2019-04-12 18:47:43', 1),
(72, 'POLINESIA FR.', '2019-04-12 18:47:43', 1),
(73, 'POLONIA', '2019-04-12 18:47:43', 1),
(74, 'PORTUGAL', '2019-04-12 18:47:43', 1),
(75, 'PUERTO RICO', '2019-04-12 18:47:43', 1),
(76, 'REP. CHECA', '2019-04-12 18:47:43', 1),
(77, 'REP. DOMINICANA', '2019-04-12 18:47:43', 1),
(78, 'RUMANIA', '2019-04-12 18:47:43', 1),
(79, 'SENEGAL', '2019-04-12 18:47:43', 1),
(80, 'SINGAPUR', '2019-04-12 18:47:43', 1),
(81, 'SUDÁFRICA', '2019-04-12 18:47:43', 1),
(82, 'SUECIA', '2019-04-12 18:47:43', 1),
(83, 'SUIZA', '2019-04-12 18:47:43', 1),
(84, 'SURINAM', '2019-04-12 18:47:43', 1),
(85, 'TAIWAN', '2019-04-12 18:47:43', 1),
(86, 'TAILANDIA', '2019-04-12 18:47:43', 1),
(87, 'TRINIDAD', '2019-04-12 18:47:43', 1),
(88, 'TURQUÍA', '2019-04-12 18:47:43', 1),
(89, 'UCRANIA', '2019-04-12 18:47:43', 1),
(90, 'URUGUAY', '2019-04-12 18:47:43', 1),
(91, 'USA', '2019-04-12 18:47:43', 1),
(92, 'VENEZUELA', '2019-04-12 18:47:43', 1),
(93, 'YUGOSLAVIA', '2019-04-12 18:47:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_propuestas`
--

DROP TABLE IF EXISTS `tb_propuestas`;
CREATE TABLE IF NOT EXISTS `tb_propuestas` (
  `id_propuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int(11) DEFAULT NULL,
  `tipo_viaje` text COLLATE utf8_spanish_ci,
  `id_aerolinea` int(11) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `detracion` int(11) DEFAULT NULL,
  `adultos_cantidad` int(11) DEFAULT NULL,
  `adultos_sf` float DEFAULT NULL,
  `adultos_fee` float DEFAULT NULL,
  `ninio_cantidad` int(11) DEFAULT NULL,
  `ninio_sf` float DEFAULT NULL,
  `ninio_fee` float DEFAULT NULL,
  `infante_cantidad` int(11) DEFAULT NULL,
  `infante_sf` float DEFAULT NULL,
  `infante_fee` float DEFAULT NULL,
  `usuario_creacion` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `usuario_modificacion` text COLLATE utf8_spanish_ci,
  `fecha_modificacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_propuesta`),
  KEY `id_cotizacion` (`id_cotizacion`),
  KEY `id_aerolinea` (`id_aerolinea`),
  KEY `id_moneda` (`id_moneda`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_propuestas`
--

INSERT INTO `tb_propuestas` (`id_propuesta`, `id_cotizacion`, `tipo_viaje`, `id_aerolinea`, `id_moneda`, `detracion`, `adultos_cantidad`, `adultos_sf`, `adultos_fee`, `ninio_cantidad`, `ninio_sf`, `ninio_fee`, `infante_cantidad`, `infante_sf`, `infante_fee`, `usuario_creacion`, `fecha_creacion`, `usuario_modificacion`, `fecha_modificacion`, `estado`) VALUES
(60, 97, 'Ida y vuelta', 17, 2, 10, 1, 2.5, 3.5, 4, 5.5, 6.5, 7, 8.5, 9.5, 'kmpio', '2020-05-25 04:58:37', 'kmpio', '2020-05-25 04:58:37', 1),
(61, 97, 'Solo ida', 24, 2, 5, 15, 16.5, 17.5, 18, 19.5, 20.5, 21, 22.5, 23.5, 'kmpio', '2020-05-25 05:00:23', 'kmpio', '2020-05-25 05:00:23', 1),
(62, 98, 'Ida y vuelta', 17, 2, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'kmpio', '2020-05-28 04:11:43', 'kmpio', '2020-05-28 04:11:43', 1),
(63, 99, 'Ida y vuelta', 24, 2, 1, 2, 2, 2, 2, 2, 2, 0, 0, 0, 'kmpio', '2020-05-28 15:35:29', 'kmpio', '2020-05-28 15:35:29', 1),
(64, 100, 'Ida y vuelta', 7, 2, 2, 2, 2, 2, 2, 2, 2, 0, 0, 0, 'kmpio', '2020-05-28 15:39:26', 'kmpio', '2020-05-28 15:39:26', 1),
(65, 101, 'Ida y vuelta', 24, 2, 10, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'kmpio', '2020-05-30 05:01:37', 'kmpio', '2020-05-30 05:01:37', 1),
(66, 101, 'Destinos Múltiples', 17, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 'kmpio', '2020-05-30 05:03:37', 'kmpio', '2020-05-30 05:03:37', 1),
(67, 101, 'Ida y vuelta', 24, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 'kmpio', '2020-05-30 05:05:48', 'kmpio', '2020-05-30 05:05:48', 1),
(70, 101, 'Ida y vuelta', 17, 2, 0, 1, 2, 2, 0, 0, 0, 0, 0, 0, 'kmpio', '2020-05-30 05:07:55', 'kmpio', '2020-05-30 05:07:55', 1),
(71, 102, 'Ida y vuelta', 24, 2, 0, 1, 20, 200, 0, 0, 0, 0, 0, 0, 'kmpio', '2020-06-04 05:21:41', 'kmpio', '2020-06-04 05:21:41', 1),
(72, 103, 'Solo ida', 7, 3, 0, 2, 100, 30, 0, 0, 0, 0, 0, 0, 'kmpio', '2020-07-04 03:35:12', 'kmpio', '2020-07-04 03:35:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_slide`
--

DROP TABLE IF EXISTS `tb_slide`;
CREATE TABLE IF NOT EXISTS `tb_slide` (
  `id_slide` int(11) NOT NULL AUTO_INCREMENT,
  `v_ruta_back` text,
  `v_ruta_front` text,
  `v_titulo` text,
  `v_descripcion` text,
  `i_orden` int(11) DEFAULT NULL,
  `i_estado` int(11) DEFAULT NULL,
  `v_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_slide`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_slide`
--

INSERT INTO `tb_slide` (`id_slide`, `v_ruta_back`, `v_ruta_front`, `v_titulo`, `v_descripcion`, `i_orden`, `i_estado`, `v_fecha_registro`) VALUES
(45, 'vistas/assets/images/slide_back/523.jpg', 'vistas/assets/images/slide_front/523.jpg', 'Nevado Pastoruri', 'Huaraz - Perú', 5, NULL, '2020-05-16 02:45:15'),
(46, 'vistas/assets/images/slide_back/844.jpg', 'vistas/assets/images/slide_front/844.jpg', 'Geckos Travel Group Company', 'Adquiere tu Seguro de Deportes de Aventura extra con Nosotros', 6, NULL, '2020-05-16 02:48:03'),
(47, 'vistas/assets/images/slide_back/923.jpg', 'vistas/assets/images/slide_front/923.jpg', 'Nevado Mateo', 'Huaraz - Perú', 2, NULL, '2020-05-16 02:48:33'),
(48, 'vistas/assets/images/slide_back/945.jpg', 'vistas/assets/images/slide_front/945.jpg', 'Nevado Mateo', 'Huaraz - Perú', 3, NULL, '2020-05-16 02:49:06'),
(49, 'vistas/assets/images/slide_back/425.jpg', 'vistas/assets/images/slide_front/425.jpg', 'Geckos Travel Group Company', 'Sesión fotográfica', 7, NULL, '2020-05-16 02:49:37'),
(50, 'vistas/assets/images/slide_back/585.jpg', 'vistas/assets/images/slide_front/585.jpg', 'Rappel', 'Geckos Travel Group Company', 4, NULL, '2020-05-16 02:52:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_suscriptores`
--

DROP TABLE IF EXISTS `tb_suscriptores`;
CREATE TABLE IF NOT EXISTS `tb_suscriptores` (
  `id_suscriptor` int(11) NOT NULL AUTO_INCREMENT,
  `v_nombre` text,
  `v_telefono` text,
  `v_email` text,
  `i_revision` int(11) DEFAULT NULL,
  `i_estado` int(11) DEFAULT NULL,
  `v_fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_suscriptor`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_suscriptores`
--

INSERT INTO `tb_suscriptores` (`id_suscriptor`, `v_nombre`, `v_telefono`, `v_email`, `i_revision`, `i_estado`, `v_fecha_registro`) VALUES
(1, 'Natalia', '987540361', 'naty@hotmail.com', 1, 1, '2016-12-13 15:59:57'),
(2, 'Miguel', '987540362', 'miguel@hotmail.com', 1, 1, '2017-01-13 14:07:02'),
(3, 'Ana', '987540363', 'ana@hotmail.com', 1, 1, '2017-01-13 14:15:19'),
(4, 'Maria', '987540364', 'maria@hotmail.com', 1, 1, '2017-01-13 14:07:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL,
  `tipo_documento` text COLLATE utf8_spanish_ci,
  `numero_documento` text COLLATE utf8_spanish_ci,
  `telefono` text COLLATE utf8_spanish_ci,
  `correo` text COLLATE utf8_spanish_ci,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombres`, `apellidos`, `usuario`, `password`, `perfil`, `fecha`, `tipo_documento`, `numero_documento`, `telefono`, `correo`, `foto`, `ultimo_login`, `estado`) VALUES
(1, 'Administrador', '', 'admin', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2019-04-06 03:03:49', NULL, NULL, NULL, NULL, 'vistas/images/usuarios/admin.jpg', '2017-12-27 12:12:01', 0),
(3, 'Pedro', 'Delgado Aparicio', 'pdelgado', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2019-04-06 03:03:49', 'DNI', '43775453', '940402920', 'pedro@gmail.com', 'vistas/images/usuarios/pdelgado.jpg', '2020-07-05 19:12:11', 1),
(4, 'Ricardo', 'Rodriguez Gonzales', 'rgonzales', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2019-04-06 03:03:49', 'DNI', '43775454', '940402921', 'ricardo@gmail.com', 'vistas/images/usuarios/rrodriguez.jpg', '2020-07-05 19:12:11', 1),
(5, 'Karen', 'Pio Saire', 'kmpio', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2019-04-06 03:03:49', 'DNI', '43775451', '940402919', 'karen@gmail.com', 'vistas/images/usuarios/kmpio.jpg', '2020-07-06 00:28:51', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_aeropuertos`
--
ALTER TABLE `tb_aeropuertos`
  ADD CONSTRAINT `tb_aeropuertos_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `tb_ciudades` (`id_ciudad`);

--
-- Filtros para la tabla `tb_ciudades`
--
ALTER TABLE `tb_ciudades`
  ADD CONSTRAINT `tb_ciudades_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `tb_paises` (`id_pais`);

--
-- Filtros para la tabla `tb_cotizaciones`
--
ALTER TABLE `tb_cotizaciones`
  ADD CONSTRAINT `tb_cotizaciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`);

--
-- Filtros para la tabla `tb_itinerarios`
--
ALTER TABLE `tb_itinerarios`
  ADD CONSTRAINT `tb_itinerarios_ibfk_1` FOREIGN KEY (`id_propuesta`) REFERENCES `tb_propuestas` (`id_propuesta`);

--
-- Filtros para la tabla `tb_propuestas`
--
ALTER TABLE `tb_propuestas`
  ADD CONSTRAINT `tb_propuestas_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `tb_cotizaciones` (`id_cotizacion`),
  ADD CONSTRAINT `tb_propuestas_ibfk_2` FOREIGN KEY (`id_aerolinea`) REFERENCES `tb_aerolineas` (`id_aerolinea`),
  ADD CONSTRAINT `tb_propuestas_ibfk_3` FOREIGN KEY (`id_moneda`) REFERENCES `tb_monedas` (`id_moneda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
