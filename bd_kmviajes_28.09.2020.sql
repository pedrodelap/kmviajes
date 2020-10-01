-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-09-2020 a las 12:13:11
-- Versión del servidor: 5.7.26
-- Versión de PHP: 5.6.40

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

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `usp_insert_cliente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_insert_cliente` (IN `pNombre` TEXT, IN `pApellido` TEXT, IN `pNumero_documento` TEXT, IN `pTelefono` TEXT, IN `pCorreo` TEXT)  BEGIN 
		INSERT INTO `tb_clientes`
		(
			`nombres`,
			`apellidos`,
			`numero_documento`,
			`telefono`,
			`correo`,
			`fecha_creacion`,
			`estado`
		)VALUES
		(
			pNombre, 
			pApellido,
			pNumero_documento,
			pTelefono,
			pCorreo,
			NOW(),
			1
		);		
		
		SELECT @@identity AS id_cliente ;
		
END$$

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

DROP PROCEDURE IF EXISTS `usp_insert_paquete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_insert_paquete` (IN `pVTitulo` TEXT, IN `pIDAerolinea` INT, IN `pVDescripcionCorta` TEXT, IN `pDescripcionLarga` TEXT, IN `pIDCiudad` INT, IN `pVPrecioSol` TEXT, IN `pVPrecioDolar` TEXT, IN `pVFechaInicio` TEXT, IN `pVFechaFin` TEXT, IN `pICantidadAdultos` INT, IN `pICantidadNinios` INT, IN `pVFechaMostrar` TEXT)  BEGIN 
		INSERT INTO `tb_paquetes`
		(
			titulo,
			id_aerolinea,
			descripcion_corta,
			descripcion_larga,
			id_ciudad,
			precio_sol,
			precio_dolar,
			fecha_inicio,
			fecha_fin,
			cantidad_adultos,
			cantidad_ninios,
			fecha_mostrar
		) VALUES 
		(
			pVTitulo,
			pIDAerolinea,
			pVDescripcionCorta,
			pDescripcionLarga,
			pIDCiudad,
			pVPrecioSol,
			pVPrecioDolar,
			pVFechaInicio,
			pVFechaFin,
			pICantidadAdultos,
			pICantidadNinios,
			pVFechaMostrar
		);
		SELECT @@identity AS id_paquete ;
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

DROP PROCEDURE IF EXISTS `usp_insert_solicitud`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_insert_solicitud` (IN `pId_paquete` INT, IN `pId_Ciudad` INT, IN `pFechaInicio` TEXT, IN `pFechaFin` TEXT, IN `pFechaMostrar` TEXT, IN `pNinos` INT, IN `pAdultos` INT, IN `pComentario` TEXT, IN `pIdCliente` INT)  BEGIN 
		INSERT INTO `tb_solicitud`
		(
			id_paquete,
			 id_ciudad,
			 fecha_inicio,
			 fecha_fin,
			 fecha_mostrar,
			 numero_ninios,
			 numero_adultos,
			 comentario,
			 estado_solictud,
			 fecha_registro,
			 estado,
			 id_cliente
		)VALUES
		(
			pId_paquete, 
			pId_Ciudad,
			pFechaInicio,
			pFechaFin,
			pFechaMostrar,
			pNinos,
			pAdultos,
			pComentario,
			'registrada',
			 NOW(),
			 1,
			pIdCliente
		);		
				
		SELECT @@identity AS id_solicitud ;
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
(25, 'LB', '', 'LLOYD AÉREO BOLIVIANO', 'AV. JOSÉ PARDO 231 1ER. Y 7MO. PISO - MIRAFLORES', '241-5210 444-0510', '574-5625 / 9836*1318', 'AEROLÍNEA INTERNACIONAL', '2019-04-12 04:13:01', 1),
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
-- Estructura de tabla para la tabla `tb_campanias_x_paquetes`
--

DROP TABLE IF EXISTS `tb_campanias_x_paquetes`;
CREATE TABLE IF NOT EXISTS `tb_campanias_x_paquetes` (
  `id_campania_x_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_campania` int(11) DEFAULT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `fecha_inicio` text,
  `fecha_fin` text,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_campania_x_paquete`),
  KEY `id_campania` (`id_campania`),
  KEY `id_paquete` (`id_paquete`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_campanias_x_paquetes`
--

INSERT INTO `tb_campanias_x_paquetes` (`id_campania_x_paquete`, `id_campania`, `id_paquete`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(36, 8, 74, '21-09-2020', '27-09-2020', 1),
(37, 9, 75, '28-09-2020', '04-10-2020', 1),
(38, 10, 76, '05-10-2020', '11-10-2020', 1),
(39, 43, 77, '27-10-2020', '01-11-2020', 1),
(40, 15, 78, '21-09-2020', '26-09-2020', 1),
(41, 9, 79, '06-10-2020', '11-10-2020', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_campenias`
--

DROP TABLE IF EXISTS `tb_campenias`;
CREATE TABLE IF NOT EXISTS `tb_campenias` (
  `id_campania` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci,
  `descripcion_corta` text COLLATE utf8_spanish_ci,
  `descripcion_larga` text COLLATE utf8_spanish_ci,
  `foto_corta` text COLLATE utf8_spanish_ci,
  `foto_larga` text COLLATE utf8_spanish_ci,
  `flag_nuevo` text COLLATE utf8_spanish_ci,
  `flag_oferta` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_campania`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_campenias`
--

INSERT INTO `tb_campenias` (`id_campania`, `nombre`, `descripcion_corta`, `descripcion_larga`, `foto_corta`, `foto_larga`, `flag_nuevo`, `flag_oferta`, `fecha_creacion`, `estado`) VALUES
(8, 'Verano 2010', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:38', 1),
(9, 'Verano 2011', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:38', 1),
(10, 'Verano 2012', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:38', 1),
(11, 'Verano 2013', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:38', 1),
(12, 'Verano 2014', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:38', 1),
(13, 'Verano 2015', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '1', '2020-09-25 03:20:38', 1),
(14, 'Verano 2016', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:38', 1),
(15, 'Verano 2017', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:38', 1),
(16, 'Verano 2018', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:38', 1),
(17, 'Verano 2019', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:38', 1),
(18, 'Verano 2020', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:38', 1),
(19, 'Europa 2010', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:38', 1),
(20, 'Europa 2011', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:38', 1),
(21, 'Europa 2012', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:38', 1),
(22, 'Europa 2013', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(23, 'Europa 2014', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(24, 'Europa 2015', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(25, 'Europa 2016', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(26, 'Europa 2017', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(27, 'Europa 2018', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(28, 'Europa 2019', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(29, 'Europa 2020', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '1', '2020-09-25 03:20:39', 1),
(30, 'Estados Unidos 2010', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(31, 'Estados Unidos 2011', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '1', '2020-09-25 03:20:39', 1),
(32, 'Estados Unidos 2012', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(33, 'Estados Unidos 2013', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(34, 'Estados Unidos 2014', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(35, 'Estados Unidos 2015', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(36, 'Estados Unidos 2016', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(37, 'Estados Unidos 2017', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(38, 'Estados Unidos 2018', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(39, 'Estados Unidos 2019', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(40, 'Estados Unidos 2020', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(41, 'Asia 2010', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(42, 'Asia 2011', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(43, 'Asia 2012', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(44, 'Asia 2013', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(45, 'Asia 2014', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(46, 'Asia 2015', 'Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per naeos.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(47, 'Asia 2016', 'Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas.', 'Pellentesque in tempor sapien. Suspendisse eget enim sit amet nisi consequat accumsan. Morbi fermentum non erat in ullamcorper. Vivamus vel quam euismod, hendrerit enim sit amet, rutrum dui. Proin sit amet tortor et felis congue consequat. Donec gravida, ipsum non luctus pellentesque, velit erat consectetur eros, nec dictum metus neque sit amet ante. Nam lacinia mi ac malesuada suscipit. Nullam eros risus, blandit nec pellentesque interdum, vulputate elementum tortor. In blandit blandit mauris, vel rutrum risus cursus vel. Aenean ac odio tellus. Fusce in erat egestas, porta turpis sed, pharetra odio.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(48, 'Asia 2017', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus tortor magna, sed consectetur nisi viverra et. Quisque suscipit consectetur malesuada. Morbi maximus sollicitudin sapien sed blandit. Vestibulum lobortis eleifend placerat. Phasellus vitae hendrerit mauris. Quisque a aliquam turpis. Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem. Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '1', '2020-09-25 03:20:39', 1),
(49, 'Asia 2018', 'Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit.', 'Phasellus non sapien dui. Maecenas nulla lacus, mollis eu libero in, ullamcorper congue lectus. Donec accumsan et nulla a hendrerit. Suspendisse placerat posuere felis, bibendum euismod diam mollis quis. Sed commodo porta purus, eu auctor risus dapibus a. Etiam at mauris eget neque lobortis volutpat ut ut orci. Aenean tristique sodales magna et facilisis. Ut maximus dapibus pharetra. Nunc tincidunt felis mauris, nec rutrum nisl mollis at.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1),
(50, 'Asia 2019', 'Etiam eu diam tellus. Nunc ac nibh eget urna gravida malesuada. Cras scelerisque, urna a convallis tincidunt, nisl ante pulvinar augue, id rhoncus nibh felis in nunc senectus et netus et malesuad convallis tincsa.', 'Fusce in tortor hendrerit enim lacinia lacinia. Nunc ornare tempus risus, sed hendrerit est blandit a. Nulla nec posuere lorem. Nullam sapien felis, fermentum quis mauris in, tincidunt fringilla nulla. Duis quis viverra odio. Suspendisse enim est, varius laoreet euismod at, commodo in augue. Phasellus nec dui sed erat auctor eleifend at aliquet metus. Sed at arcu elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '0', '0', '2020-09-25 03:20:39', 1),
(51, 'Asia 2020', 'Quisque ex eros, tincidunt id metus sed, varius suscipit ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris mi mi, tristique id sapien eu, varius efficitur sem.', 'Cras ultrices, nisl eget luctus vulputate, diam lectus pellentesque odio, id laoreet massa velit quis enim. Ut at aliquam ante. Sed vel diam erat. Nulla facilisi. Aliquam erat volutpat. Nullam ac enim eget mauris finibus scelerisque. Mauris fermentum, quam eget laoreet consequat, risus ante mollis ex, et iaculis nisi quam sed ipsum. Curabitur tristique arcu vel nulla consectetur, sed vehicula dui malesuada. Vestibulum vitae enim lobortis, euismod ligula eu, ultricies mi. Nullam ut turpis eget ipsum tincidunt tincidunt sed venenatis dui. Quisque hendrerit varius dui, sit amet sollicitudin purus vestibulum ac. Ut volutpat tellus sit amet tortor tincidunt cursus. Pellentesque ac mollis lorem. Vestibulum nec placerat purus. Suspendisse dignissim dolor eu felis vestibulum, vel dignissim dolor imperdiet. Nam non fermentum augue.', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', 'vistas/images/campana/foto_corta/6_foto_corta.jpeg', '1', '0', '2020-09-25 03:20:39', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(31, 'PEDRO', ' DELGADO', 'PASAPORTE', '2646139282', '973130973', 'pedrodelap@gmail.com', '1980-11-02', '2019-04-10 22:33:18', 1),
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
(259, 'PRUEBA1', 'PRUEBA1', NULL, '111111', '111111', 'CORREO@GMAIL.COM', NULL, '2020-09-28 04:47:38', 1),
(260, 'PEDRO', 'DELGADO', NULL, '4564', '984556', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:13:52', 1),
(261, 'PEDRO', 'DELGADO', NULL, '4564', '984556', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:13:59', 1),
(262, 'PEDRO', 'DELGADO', NULL, '54545', '45454', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:18:54', 1),
(263, 'JULIANA', 'OXENFORD', NULL, '454987', '9854781', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:30:49', 1),
(264, 'JULIANA ', 'OXFREDIBD', NULL, '46545', '5464', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:32:35', 1),
(265, 'JULIANA ', 'OXFREDIBD', NULL, '46545', '5464', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:33:12', 1),
(266, 'PEDRO', 'DELGADO', NULL, '4654564', '4564564', 'CORREO@GMAIL.COM', NULL, '2020-09-28 05:34:03', 1),
(267, 'CARLOS', 'AUSTIN', NULL, '56565', '565656', 'CORRE@GMAIL.COM', NULL, '2020-09-28 05:53:37', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_cotizaciones`
--

INSERT INTO `tb_cotizaciones` (`id_cotizacion`, `id_cliente`, `usuario_creacion`, `fecha_creacion`, `usuario_modificacion`, `fecha_modificacion`, `venta`, `estado`) VALUES
(2, 33, 'kmpio', '2020-09-18 23:22:11', 'kmpio', '2020-09-18 23:22:11', 0, 1),
(3, 33, 'kmpio', '2020-09-19 20:15:00', 'kmpio', '2020-09-19 20:15:00', 0, 1),
(4, 33, 'kmpio', '2020-09-19 22:27:00', 'kmpio', '2020-09-19 22:27:00', 0, 1),
(5, 31, 'kmpio', '2020-09-20 18:20:20', 'kmpio', '2020-09-20 18:20:20', 2, 1),
(6, 29, 'kmpio', '2020-09-27 04:36:37', 'kmpio', '2020-09-27 04:36:37', 0, 1),
(7, 64, 'kmpio', '2020-09-27 15:34:23', 'kmpio', '2020-09-27 15:34:23', 0, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_galeria`
--

INSERT INTO `tb_galeria` (`id_galeria`, `v_ruta`, `i_orden`, `v_fecha_registro`, `i_estado`) VALUES
(30, 'vistas/assets/images/galeria/galeria238.jpg', NULL, '2020-07-11 06:36:19', NULL),
(31, 'vistas/assets/images/galeria/galeria867.jpg', NULL, '2020-07-11 06:36:22', NULL),
(32, 'vistas/assets/images/galeria/galeria566.jpg', NULL, '2020-07-11 06:36:25', NULL),
(29, 'vistas/assets/images/galeria/galeria745.jpg', NULL, '2020-07-11 06:36:15', NULL),
(33, 'vistas/assets/images/galeria/galeria552.jpg', NULL, '2020-07-11 06:36:29', NULL),
(34, 'vistas/assets/images/galeria/galeria953.jpg', NULL, '2020-07-11 06:36:32', NULL),
(35, 'vistas/assets/images/galeria/galeria502.jpg', NULL, '2020-07-11 06:36:35', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_hoteles`
--

DROP TABLE IF EXISTS `tb_hoteles`;
CREATE TABLE IF NOT EXISTS `tb_hoteles` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_ciudad` int(11) DEFAULT NULL,
  `codigo` text COLLATE utf8_spanish_ci,
  `nombre` text COLLATE utf8_spanish_ci,
  `telefono` text COLLATE utf8_spanish_ci,
  `correo` text COLLATE utf8_spanish_ci,
  `direccion` text COLLATE utf8_spanish_ci,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`),
  KEY `id_ciudad` (`id_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_imagenes_paquete`
--

DROP TABLE IF EXISTS `tb_imagenes_paquete`;
CREATE TABLE IF NOT EXISTS `tb_imagenes_paquete` (
  `id_imagen_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagen` int(11) DEFAULT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `ruta_imagen` text,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_imagen_paquete`),
  KEY `id_paquete` (`id_paquete`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_imagenes_paquete`
--

INSERT INTO `tb_imagenes_paquete` (`id_imagen_paquete`, `id_imagen`, `id_paquete`, `ruta_imagen`, `fecha_registro`, `estado`) VALUES
(8, 1, 74, 'vistas/images/paquetes/74_img_1_20200926051408.png', '2020-09-26 17:14:08', 1),
(9, 2, 74, 'vistas/images/paquetes/74_img_2_20200926051408.png', '2020-09-26 17:14:08', 1),
(10, 3, 74, 'vistas/images/paquetes/74_img_3_20200926051408.png', '2020-09-26 17:14:08', 1),
(11, 4, 74, 'vistas/images/paquetes/74_img_4_20200926051408.png', '2020-09-26 17:14:08', 1),
(12, 1, 75, 'vistas/images/paquetes/75_img_1_20200926051648.png', '2020-09-26 17:16:48', 1),
(13, 2, 75, 'vistas/images/paquetes/75_img_2_20200926051648.png', '2020-09-26 17:16:48', 1),
(14, 3, 75, 'vistas/images/paquetes/75_img_3_20200926051648.png', '2020-09-26 17:16:48', 1),
(15, 4, 75, 'vistas/images/paquetes/75_img_4_20200926051648.png', '2020-09-26 17:16:48', 1),
(16, 1, 76, 'vistas/images/paquetes/76_img_1_20200926060351.png', '2020-09-26 18:03:51', 1),
(17, 2, 76, 'vistas/images/paquetes/76_img_2_20200926060351.png', '2020-09-26 18:03:51', 1),
(18, 3, 76, 'vistas/images/paquetes/76_img_3_20200926060351.png', '2020-09-26 18:03:51', 1),
(19, 4, 76, 'vistas/images/paquetes/76_img_4_20200926060351.png', '2020-09-26 18:03:51', 1),
(20, 5, 76, 'vistas/images/paquetes/76_img_5_20200926060351.png', '2020-09-26 18:03:51', 1),
(21, 1, 77, 'vistas/images/paquetes/77_img_1_20200926060828.png', '2020-09-26 18:08:28', 1),
(22, 2, 77, 'vistas/images/paquetes/77_img_2_20200926060828.png', '2020-09-26 18:08:28', 1),
(23, 3, 77, 'vistas/images/paquetes/77_img_3_20200926060828.png', '2020-09-26 18:08:28', 1),
(24, 4, 77, 'vistas/images/paquetes/77_img_4_20200926060828.png', '2020-09-26 18:08:28', 1),
(25, 1, 78, 'vistas/images/paquetes/78_img_1_20200927024423.png', '2020-09-27 02:44:23', 1),
(26, 2, 78, 'vistas/images/paquetes/78_img_2_20200927024423.png', '2020-09-27 02:44:23', 1),
(27, 3, 78, 'vistas/images/paquetes/78_img_3_20200927024423.png', '2020-09-27 02:44:23', 1),
(28, 1, 79, 'vistas/images/paquetes/79_img_1_20200927042837.png', '2020-09-27 04:28:37', 1),
(29, 2, 79, 'vistas/images/paquetes/79_img_2_20200927042837.png', '2020-09-27 04:28:37', 1),
(30, 3, 79, 'vistas/images/paquetes/79_img_3_20200927042837.png', '2020-09-27 04:28:37', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_itinerarios`
--

INSERT INTO `tb_itinerarios` (`id_itinerario`, `id_propuesta`, `aeropuerto_origen`, `aeropuerto_destino`, `fecha_viaje`, `usuario_creacion`, `fecha_creacion`, `usuario_modificacio`, `fecha_modificacion`, `estado`) VALUES
(1, 3, 61, 178, '16 julio, 2020 12:00 AM - 19 julio, 2020 04:00 AM', 'kmpio', '2020-07-14 05:27:55', 'kmpio', '2020-07-14 05:27:55', 1),
(2, 3, 178, 53, '20 julio, 2020 12:00 AM - 24 julio, 2020 04:00 AM', 'kmpio', '2020-07-14 05:27:55', 'kmpio', '2020-07-14 05:27:55', 1),
(5, 6, 168, 189, '25 julio, 2020 06:00 PM - 28 julio, 2020 10:00 PM', 'kmpio', '2020-07-25 23:54:26', 'kmpio', '2020-07-25 23:54:26', 1),
(6, 7, 168, 189, '15 julio, 2020 12:00 AM - 03 agosto, 2020 04:00 AM', 'kmpio', '2020-07-28 05:01:35', 'kmpio', '2020-07-28 05:01:35', 1),
(7, 7, 81, 178, '28 julio, 2020 12:00 AM - 01 agosto, 2020 04:00 AM', 'kmpio', '2020-07-28 05:01:35', 'kmpio', '2020-07-28 05:01:35', 1),
(8, 11, 81, 16, '22 septiembre, 2020 11:00 PM - 26 septiembre, 2020 03:00 AM', 'kmpio', '2020-09-27 05:43:17', 'kmpio', '2020-09-27 05:43:17', 1),
(9, 11, 98, 168, '08 septiembre, 2020 11:00 PM - 13 septiembre, 2020 03:00 AM', 'kmpio', '2020-09-27 05:43:17', 'kmpio', '2020-09-27 05:43:17', 1),
(10, 12, 178, 78, '16 septiembre, 2020 10:00 AM - 12 octubre, 2020 02:00 PM', 'kmpio', '2020-09-27 15:34:48', 'kmpio', '2020-09-27 15:34:48', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_mensajes`
--

INSERT INTO `tb_mensajes` (`id_mensajes`, `v_nombre`, `v_email`, `v_asunto`, `v_mensaje`, `i_revision`, `v_fecha_registro`, `i_estado`) VALUES
(49, 'pedro delgado aparicio', 'mantis_dropo@hotmail.com', 'use our electronic ticketing system', 'Are you curious about something? Do you have some kind of problem with our products? As am hastily invited settled at limited civilly fortune me. Really spring in extent an by. Judge but built gay party world. Of so am he remember although required. Bachelor unpacked be advanced at. Confined in declared marianne is vicinity.', 1, '2020-07-09 01:16:38', 1),
(2, 'Miguel', 'miguel@hotmail.com', NULL, 'Phasellus dui dui, hendrerit eget luctus eget, lobortis in nibh. Pellentesque orci justo, lacinia iaculis nisl pretium, pharetra congue quam. Vivamus vulputate magna sit amet velit laoreet vestibulum. Aliquam maximus, diam vel dapibus pretium, neque nisi tincidunt est, dapibus placerat elit lacus eget turpis. Duis gravida, purus lobortis pulvinar fermentum, tellus magna dignissim ante, sed sollicitudin massa odio eget mi. Maecenas gravida elit vel porta luctus. Phasellus feugiat nisl in quam efficitur scelerisque. Aenean at ultricies nibh, suscipit vulputate nunc. Donec sit amet tortor in arcu vulputate aliquet et sit amet arcu. Nulla dignissim, massa nec pharetra luctus, dolor dolor tempor leo, id tempus lorem turpis non odio.', 1, '2017-01-13 14:07:02', 1),
(4, 'Maria', 'maria@hotmail.com', NULL, 'Phasellus dui dui, hendrerit eget luctus eget, lobortis in nibh. Pellentesque orci justo, lacinia iaculis nisl pretium, pharetra congue quam. Vivamus vulputate magna sit amet velit laoreet vestibulum. Aliquam maximus, diam vel dapibus pretium, neque nisi tincidunt est, dapibus placerat elit lacus eget turpis. Duis gravida, purus lobortis pulvinar fermentum, tellus magna dignissim ante, sed sollicitudin massa odio eget mi. Maecenas gravida elit vel porta luctus. Phasellus feugiat nisl in quam efficitur scelerisque. Aenean at ultricies nibh, suscipit vulputate nunc. Donec sit amet tortor in arcu vulputate aliquet et sit amet arcu. Nulla dignissim, massa nec pharetra luctus, dolor dolor tempor leo, id tempus lorem turpis non odio.', 1, '2017-01-13 14:07:02', 1);

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
-- Estructura de tabla para la tabla `tb_paquetes`
--

DROP TABLE IF EXISTS `tb_paquetes`;
CREATE TABLE IF NOT EXISTS `tb_paquetes` (
  `id_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_aerolinea` int(11) DEFAULT NULL,
  `titulo` text,
  `descripcion_corta` text,
  `descripcion_larga` text,
  `precio_sol` text,
  `precio_dolar` text,
  `fecha_inicio` text,
  `fecha_fin` text,
  `cantidad_adultos` int(11) DEFAULT NULL,
  `cantidad_ninios` int(11) DEFAULT NULL,
  `foto_corta` text,
  `foto_larga` text,
  `id_ciudad` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `fecha_mostrar` text,
  PRIMARY KEY (`id_paquete`),
  KEY `id_aerolinea` (`id_aerolinea`),
  KEY `id_ciudad` (`id_ciudad`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_paquetes`
--

INSERT INTO `tb_paquetes` (`id_paquete`, `id_aerolinea`, `titulo`, `descripcion_corta`, `descripcion_larga`, `precio_sol`, `precio_dolar`, `fecha_inicio`, `fecha_fin`, `cantidad_adultos`, `cantidad_ninios`, `foto_corta`, `foto_larga`, `id_ciudad`, `flag`, `id_hotel`, `fecha_mostrar`) VALUES
(74, 1, 'Class aptent taciti sociosqu ad litora torquent per conubia nostra', 'Integer luctus, elit nec semper euismod, purus urna ultrices justo, ut faucibus nunc risus quis sapien. Fusce non dolor convallis lacus fermentum scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'Suspendisse massa ex, vestibulum sed lectus id, convallis pulvinar enim. Praesent tristique massa id mi convallis viverra. Etiam erat lectus, sollicitudin quis auctor vitae, semper in odio. Integer lacinia pharetra urna a semper. Quisque id lectus cursus, ultrices nisi a, molestie libero. Donec viverra porttitor bibendum. Integer nec nisl imperdiet, luctus tortor non, porttitor justo. Quisque ac fringilla neque. Mauris id lectus luctus, faucibus ante ut, imperdiet felis. Aenean ut lectus mattis, hendrerit nisl vel, accumsan eros. Maecenas non magna orci. ', '46000', '1600', '21-09-2020', '27-09-2020', 3, 2, NULL, NULL, 69, NULL, NULL, '21 septiembre, 2020 - 27 septiembre, 2020'),
(75, 2, 'Quisque faucibus nec ligula vel consequat sed mauris', 'Integer luctus, elit nec semper euismod, purus urna ultrices justo, ut faucibus nunc risus quis sapien. Fusce non dolor convallis lacus fermentum scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', 'Suspendisse massa ex, vestibulum sed lectus id, convallis pulvinar enim. Praesent tristique massa id mi convallis viverra. Etiam erat lectus, sollicitudin quis auctor vitae, semper in odio. Integer lacinia pharetra urna a semper. Quisque id lectus cursus, ultrices nisi a, molestie libero. Donec viverra porttitor bibendum. Integer nec nisl imperdiet, luctus tortor non, porttitor justo. Quisque ac fringilla neque. Mauris id lectus luctus, faucibus ante ut, imperdiet felis. Aenean ut lectus mattis, hendrerit nisl vel, accumsan eros. Maecenas non magna orci. ', '56000', '18000', '28-09-2020', '04-10-2020', 4, 3, NULL, NULL, 117, NULL, NULL, '28 septiembre, 2020 - 04 octubre, 2020'),
(76, 10, 'Pellentesque tincidunt tristique ornare In turpis ante', 'Nulla tempus lorem tincidunt aliquam scelerisque. Fusce non facilisis tortor. Donec euismod vitae augue id gravida. Morbi mi diam', 'Vivamus lacinia pharetra tincidunt. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim vitae libero nec rhoncus. Nulla eu arcu in arcu blandit bibendum. In rhoncus tortor ac posuere aliquam. Nunc faucibus at dui eu aliquam. Nunc id ornare nulla. Curabitur pulvinar leo quam, porta faucibus est pretium et. Suspendisse potenti. Nulla feugiat purus erat, ut interdum nisl feugiat in. Sed vitae risus at quam suscipit finibus. Curabitur et nisl dictum, maximus urna at, dignissim quam. Aenean aliquet tortor at scelerisque fringilla.', '36000', '17000', '05-10-2020', '11-10-2020', 3, 2, NULL, NULL, 152, NULL, NULL, '05 octubre, 2020 - 11 octubre, 2020'),
(77, 10, 'Vestibulum consectetur fermentum neque molestie volutpat', 'Maecenas accumsan, massa ut iaculis volutpat, massa odio malesuada enim, et eleifend elit mauris ut nunc. Aliquam turpis libero, varius a luctus et, sodales in sem.', ' Nulla eget porttitor mauris, ac tincidunt est. Morbi a sem id dolor eleifend porttitor. Sed sit amet metus finibus, feugiat sem at, feugiat elit. Suspendisse varius, dui at sagittis feugiat, odio dolor lobortis dolor, sit amet imperdiet dui purus finibus massa. Nam aliquet quam ligula, at ultrices velit bibendum at. In at libero et lorem commodo tincidunt. Nunc at erat venenatis, feugiat dui eleifend, suscipit mauris.', '2000', '4000', '27-10-2020', '01-11-2020', 2, 0, NULL, NULL, 13, NULL, NULL, '27 octubre, 2020 - 01 noviembre, 2020'),
(78, 9, 'Fusce leo dui, porta sit amet varius eu, eleifend a lacus', 'Aenean et fringilla nisi. In at enim vel urna hendrerit tempus ut non nulla. Praesent feugiat orci in elementum luctus. Phasellus turpis nulla, commodo et mattis vel, vestibulum nec eros.', 'Nunc convallis sapien ut nibh vehicula luctus. Ut sit amet justo eget nulla venenatis suscipit. Vestibulum et tincidunt est, sit amet sagittis sapien. Donec ultricies dui odio, vehicula tempus nisl lacinia quis. Quisque blandit enim eget massa sollicitudin, sed consectetur quam viverra. Sed eget augue leo. Fusce augue velit, feugiat sit amet hendrerit ut, placerat aliquet nibh. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '3500', '1800', '21-09-2020', '26-09-2020', 2, 1, NULL, NULL, 161, NULL, NULL, '21 septiembre, 2020 - 26 septiembre, 2020'),
(79, 8, 'Quisque sollicitudin, augue id rhoncus efficitur magna sapien', 'Sed mattis bibendum purus vitae auctor. Aliquam vel urna posuere, scelerisque neque sit amet, bibendum nibh.', 'Phasellus turpis nulla, commodo et mattis vel, vestibulum nec eros. Fusce quis purus quam. Suspendisse sed placerat neque. Fusce a diam eu mauris bibendum pharetra ac in magna. Quisque eget diam sed orci lacinia ultricies. In nec turpis lobortis, commodo turpis a, aliquet diam. Maecenas vulputate, nunc in interdum imperdiet, tortor nibh consequat lectus, eget gravida nisl diam sit amet mauris. Nulla mi turpis, ultrices in maximus sit amet, bibendum nec odio. Praesent tincidunt quis libero id imperdiet. Proin id sapien at mauris iaculis congue.', '4165', '1225', '06-10-2020', '11-10-2020', 2, 0, NULL, NULL, 47, NULL, NULL, '06 octubre, 2020 - 11 octubre, 2020');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_propuestas`
--

INSERT INTO `tb_propuestas` (`id_propuesta`, `id_cotizacion`, `tipo_viaje`, `id_aerolinea`, `id_moneda`, `detracion`, `adultos_cantidad`, `adultos_sf`, `adultos_fee`, `ninio_cantidad`, `ninio_sf`, `ninio_fee`, `infante_cantidad`, `infante_sf`, `infante_fee`, `usuario_creacion`, `fecha_creacion`, `usuario_modificacion`, `fecha_modificacion`, `estado`) VALUES
(3, 2, 'Solo ida', 7, 3, 11, 11, 11, 11, 0, 0, 0, 0, 0, 0, 'kmpio', '2020-07-14 05:27:55', 'kmpio', '2020-07-14 05:27:55', 1),
(6, 3, 'Ida y vuelta', 7, 3, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 'kmpio', '2020-07-25 23:54:26', 'kmpio', '2020-07-25 23:54:26', 1),
(7, 4, 'Solo ida', 7, 2, 2, 2, 10, 10, 0, 0, 0, 0, 0, 0, 'kmpio', '2020-07-28 05:01:35', 'kmpio', '2020-07-28 05:01:35', 1),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-23 18:30:35', NULL, '2020-09-23 18:30:35', 1),
(9, 6, 'Solo ida', 2, 2, 10, 5, 15, 100, 2, 2, 2, 1, 1, 1, 'kmpio', '2020-09-27 05:28:48', 'kmpio', '2020-09-27 05:28:48', 1),
(10, 6, 'Solo ida', 2, 2, 10, 5, 15, 100, 2, 2, 2, 1, 1, 1, 'kmpio', '2020-09-27 05:29:16', 'kmpio', '2020-09-27 05:29:16', 1),
(11, 6, 'Solo ida', 2, 2, 10, 5, 15, 100, 2, 2, 2, 1, 1, 1, 'kmpio', '2020-09-27 05:43:17', 'kmpio', '2020-09-27 05:43:17', 1),
(12, 7, 'Ida y vuelta', 2, 2, 10, 5, 100, 15, 2, 2, 2, 2, 2, 2, 'kmpio', '2020-09-27 15:34:48', 'kmpio', '2020-09-27 15:34:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_servicios`
--

DROP TABLE IF EXISTS `tb_servicios`;
CREATE TABLE IF NOT EXISTS `tb_servicios` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci,
  `icono` text COLLATE utf8_spanish_ci,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_servicios`
--

INSERT INTO `tb_servicios` (`id_servicio`, `nombre`, `icono`, `estado`) VALUES
(1, 'Boleto Aéreo', 'fas fa-plane', NULL),
(2, 'Traslados', 'fas fa-car-side', NULL),
(3, 'Noche de Alojamiento', 'fas fa-hotel', NULL),
(4, 'Sistema todo incluido', 'fas fa-utensils', NULL),
(5, 'Desayuno', 'fas fa-mug-hot', NULL),
(6, 'Tarjeta de Asistencia', 'fas fa-credit-card', NULL),
(7, 'Rastro de maletas', 'fas fa-briefcase', NULL),
(8, 'Impuestos', 'fas fa-money-bill-alt', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_servicios_x_paquetes`
--

DROP TABLE IF EXISTS `tb_servicios_x_paquetes`;
CREATE TABLE IF NOT EXISTS `tb_servicios_x_paquetes` (
  `id_servicio_x_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_paquete` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `estado` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_servicio_x_paquete`),
  KEY `id_paquete` (`id_paquete`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_servicios_x_paquetes`
--

INSERT INTO `tb_servicios_x_paquetes` (`id_servicio_x_paquete`, `id_paquete`, `id_servicio`, `estado`) VALUES
(12, 74, 8, '1'),
(13, 74, 7, '1'),
(14, 74, 6, '1'),
(15, 74, 5, '1'),
(16, 74, 4, '1'),
(17, 74, 3, '1'),
(18, 74, 2, '1'),
(19, 74, 1, '1'),
(20, 75, 8, '1'),
(21, 75, 6, '1'),
(22, 75, 5, '1'),
(23, 75, 3, '1'),
(24, 76, 8, '1'),
(25, 76, 1, '1'),
(26, 77, 7, '1'),
(27, 77, 6, '1'),
(28, 77, 4, '1'),
(29, 78, 8, '1'),
(30, 78, 5, '1'),
(31, 78, 3, '1'),
(32, 79, 7, '1'),
(33, 79, 6, '1'),
(34, 79, 5, '1'),
(35, 79, 4, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_slide`
--

INSERT INTO `tb_slide` (`id_slide`, `v_ruta_back`, `v_ruta_front`, `v_titulo`, `v_descripcion`, `i_orden`, `i_estado`, `v_fecha_registro`) VALUES
(52, 'vistas/assets/images/slide_back/629.jpg', 'vistas/assets/images/slide_front/629.jpg', '1111', '111', 2, NULL, '2020-07-11 06:32:52'),
(53, 'vistas/assets/images/slide_back/989.jpg', 'vistas/assets/images/slide_front/989.jpg', 'eeee', 'eeee', 1, NULL, '2020-07-11 06:32:57'),
(54, 'vistas/assets/images/slide_back/332.jpg', 'vistas/assets/images/slide_front/332.jpg', NULL, NULL, 3, NULL, '2020-07-11 06:33:03'),
(55, 'vistas/assets/images/slide_back/213.jpg', 'vistas/assets/images/slide_front/213.jpg', NULL, NULL, 4, NULL, '2020-07-11 06:33:06'),
(56, 'vistas/assets/images/slide_back/458.jpg', 'vistas/assets/images/slide_front/458.jpg', NULL, NULL, 5, NULL, '2020-07-11 06:33:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_solicitud`
--

DROP TABLE IF EXISTS `tb_solicitud`;
CREATE TABLE IF NOT EXISTS `tb_solicitud` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_paquete` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_inicio` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha_fin` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha_mostrar` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `numero_ninios` int(11) DEFAULT NULL,
  `numero_adultos` int(11) DEFAULT NULL,
  `comentario` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `estado_solictud` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `servicios` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `codigo_estado_solicitud` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_solicitud`
--

INSERT INTO `tb_solicitud` (`id_solicitud`, `id_paquete`, `id_ciudad`, `id_cliente`, `fecha_inicio`, `fecha_fin`, `fecha_mostrar`, `numero_ninios`, `numero_adultos`, `comentario`, `estado_solictud`, `servicios`, `fecha_registro`, `estado`, `codigo_estado_solicitud`) VALUES
(1, NULL, 10, 120, '01/05/2020', '09/10/2020', NULL, 2, 2, 'Ut accumsan massa eu urna feugiat, non molestie lacus aliquet. Nunc iaculis, quam in mattis finibus, nunc nibh ornare felis, accumsan pharetra mauris nisl id orci. Praesent odio enim, mollis sit amet eleifend posuere, ultrices eget ex. Nam eleifend risus nec tempor aliquam. Mauris eu mi dapibus, tempor lacus quis, ultrices risus. Nunc blandit vehicula ornare. Fusce nec mauris ex. Praesent feugiat sem at vestibulum aliquam. Nunc eget condimentum ligula. Nam a congue tellus, eget placerat lectus. Quisque imperdiet et nulla in convallis. Morbi finibus eros tellus, ut fermentum erat faucibus sed. Ut et fermentum sapien, et hendrerit mi.', 'registrada', NULL, '2020-09-26 01:26:04', 1, NULL),
(2, 74, 90, 2, '06/07/2020', '11/10/2020', NULL, 2, 2, 'Suspendisse aliquet velit quis semper molestie. Mauris ultricies sem sed lacinia accumsan. Donec vitae urna justo. Vivamus bibendum ex vitae pulvinar consequat. Cras consectetur ex ut purus sodales, eget iaculis metus finibus. Curabitur tempor, leo non condimentum placerat, felis arcu feugiat nibh, sit amet accumsan magna odio eget ipsum. Donec a eleifend turpis. Fusce dictum vel est id mattis. Phasellus nec tortor id leo luctus fermentum ac a dui. Suspendisse pulvinar arcu et ornare eleifend. Maecenas eget purus sodales, facilisis diam at, facilisis felis. Pellentesque tempor tincidunt magna vitae feugiat.', 'en reserva', NULL, '2020-09-07 21:37:03', 1, NULL),
(3, NULL, 60, 80, '26/09/2020', '26/11/2020', NULL, 1, 2, 'Suspendisse volutpat venenatis nulla. Maecenas at pretium est. Donec neque magna, ultricies quis diam quis, tristique accumsan est. Aliquam nec metus eget est feugiat finibus vel at metus. Donec porttitor ligula id imperdiet feugiat. Suspendisse potenti. Donec mollis ornare dictum. Donec congue ac nisi a congue. Suspendisse nisi elit, rhoncus sed risus sed, scelerisque cursus tellus. Suspendisse metus nisi, rhoncus sed scelerisque dictum, luctus quis risus.', 'cotizada', NULL, '2020-09-16 23:33:18', 1, NULL),
(4, 77, 35, 100, '01/09/2020', '01/10/2020', NULL, 1, 2, 'Nam in gravida urna. Donec malesuada aliquet turpis, commodo malesuada tortor molestie accumsan. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras ut metus sed metus vehicula dignissim. In in consectetur libero, ac posuere sem. Aliquam erat volutpat. Etiam eu porta ipsum, et commodo nibh. Maecenas varius blandit interdum. Suspendisse eu maximus purus, quis congue lorem. Integer elementum dui et sagittis consequat. Cras mi mi, egestas sit amet tortor vel, bibendum vulputate orci.', 'en reserva', NULL, '2020-09-13 23:36:31', 1, NULL),
(5, 75, 150, 50, '05/05/2020', '29/07/2020', NULL, 3, 1, 'Sed dapibus, sapien et mattis volutpat, dui nunc efficitur urna, vel posuere neque diam vitae lorem. Nam eu dolor est. In varius malesuada diam non efficitur. Donec non libero sollicitudin massa facilisis aliquet et id arcu. Morbi auctor eget dui vitae bibendum. Aenean sollicitudin tellus id magna tempor, vitae pretium mauris scelerisque. Proin molestie quam posuere ligula faucibus porta. Fusce eleifend at ligula sit amet malesuada. Ut eu rutrum orci. Ut viverra felis at nibh cursus varius. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi gravida erat in ullamcorper fermentum.', 'registrada', NULL, '2020-09-23 17:29:51', 1, NULL),
(6, NULL, 190, 150, '22/08/2020', '17/12/2020', NULL, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget velit convallis, aliquam risus vitae, mollis dolor. Aliquam eget lorem scelerisque velit cursus convallis sagittis ut erat. Cras eu nulla non dolor fringilla suscipit ut vel nisi. Ut accumsan massa eu urna feugiat, non molestie lacus aliquet. Nunc iaculis, quam in mattis finibus, nunc nibh ornare felis, accumsan pharetra mauris nisl id orci. Praesent odio enim, mollis sit amet eleifend posuere, ultrices eget ex. Nam eleifend risus nec tempor aliquam. Mauris eu mi dapibus, tempor lacus quis, ultrices risus. Nunc blandit vehicula ornare. Fusce nec mauris ex. Praesent feugiat sem at vestibulum aliquam. Nunc eget condimentum ligula. Nam a congue tellus, eget placerat lectus. Quisque imperdiet et nulla in convallis. Morbi finibus eros tellus, ut fermentum erat faucibus sed. Ut et fermentum sapien, et hendrerit mi.', 'cancelada', NULL, '2020-09-24 11:53:25', 1, NULL),
(7, NULL, 100, 166, '01/09/2020', '15/09/2020', NULL, 2, 3, 'Suspendisse volutpat venenatis nulla. Maecenas at pretium est. Donec neque magna, ultricies quis diam quis, tristique accumsan est. Aliquam nec metus eget est feugiat finibus vel at metus. Donec porttitor ligula id imperdiet feugiat. Suspendisse potenti. Donec mollis ornare dictum. Donec congue ac nisi a congue. Suspendisse nisi elit, rhoncus sed risus sed, scelerisque cursus tellus. Suspendisse metus nisi, rhoncus sed scelerisque dictum, luctus quis risus.', 'registrada', NULL, '2020-09-27 00:01:15', 1, NULL),
(49, NULL, 4, 259, '22-09-2020', '27-09-2020', NULL, NULL, 2, 'Servicios que desearía contar', 'registrada', NULL, '2020-09-28 04:47:38', 1, NULL),
(50, NULL, 1, 260, '28-09-2020', '04-10-2020', NULL, NULL, 2, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar', 'registrada', NULL, '2020-09-28 05:13:52', 1, NULL),
(51, NULL, 1, 261, '28-09-2020', '04-10-2020', NULL, NULL, 2, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar', 'registrada', NULL, '2020-09-28 05:13:59', 1, NULL),
(52, NULL, 1, 262, '28-09-2020', '03-10-2020', NULL, NULL, 2, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar ', 'registrada', NULL, '2020-09-28 05:18:54', 1, NULL),
(53, NULL, 1, 263, '28-09-2020', '28-09-2020', NULL, NULL, 1, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar \n', 'registrada', NULL, '2020-09-28 05:30:49', 1, NULL),
(54, NULL, 1, 264, '28-09-2020', '04-10-2020', NULL, NULL, 2, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar \n', 'registrada', NULL, '2020-09-28 05:32:35', 1, NULL),
(55, NULL, 1, 265, '28-09-2020', '04-10-2020', NULL, NULL, 2, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar \n', 'registrada', NULL, '2020-09-28 05:33:12', 1, NULL),
(56, NULL, 1, 266, '28-09-2020', '04-10-2020', NULL, NULL, 2, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar ', 'registrada', NULL, '2020-09-28 05:34:03', 1, NULL),
(57, NULL, 1, 267, '28-09-2020', '28-09-2020', NULL, NULL, 1, 'Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar Servicios que desearía contar ', 'registrada', NULL, '2020-09-28 05:53:37', 1, NULL);

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
(5, 'Karen', 'Pio Saire', 'kmpio', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '2019-04-06 03:03:49', 'DNI', '42225451', '987402919', 'karen@gmail.com', 'vistas/images/usuarios/kmpio.png', '2020-09-27 10:31:56', 1);

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
-- Filtros para la tabla `tb_hoteles`
--
ALTER TABLE `tb_hoteles`
  ADD CONSTRAINT `tb_hoteles_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `tb_ciudades` (`id_ciudad`);

--
-- Filtros para la tabla `tb_imagenes_paquete`
--
ALTER TABLE `tb_imagenes_paquete`
  ADD CONSTRAINT `tb_imagenes_paquete_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `tb_paquetes` (`id_paquete`);

--
-- Filtros para la tabla `tb_itinerarios`
--
ALTER TABLE `tb_itinerarios`
  ADD CONSTRAINT `tb_itinerarios_ibfk_1` FOREIGN KEY (`id_propuesta`) REFERENCES `tb_propuestas` (`id_propuesta`);

--
-- Filtros para la tabla `tb_paquetes`
--
ALTER TABLE `tb_paquetes`
  ADD CONSTRAINT `tb_paquetes_ibfk_1` FOREIGN KEY (`id_aerolinea`) REFERENCES `tb_aerolineas` (`id_aerolinea`),
  ADD CONSTRAINT `tb_paquetes_ibfk_2` FOREIGN KEY (`id_ciudad`) REFERENCES `tb_ciudades` (`id_ciudad`),
  ADD CONSTRAINT `tb_paquetes_ibfk_3` FOREIGN KEY (`id_hotel`) REFERENCES `tb_hoteles` (`id_hotel`);

--
-- Filtros para la tabla `tb_propuestas`
--
ALTER TABLE `tb_propuestas`
  ADD CONSTRAINT `tb_propuestas_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `tb_cotizaciones` (`id_cotizacion`),
  ADD CONSTRAINT `tb_propuestas_ibfk_2` FOREIGN KEY (`id_aerolinea`) REFERENCES `tb_aerolineas` (`id_aerolinea`),
  ADD CONSTRAINT `tb_propuestas_ibfk_3` FOREIGN KEY (`id_moneda`) REFERENCES `tb_monedas` (`id_moneda`);

--
-- Filtros para la tabla `tb_servicios_x_paquetes`
--
ALTER TABLE `tb_servicios_x_paquetes`
  ADD CONSTRAINT `tb_servicios_x_paquetes_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `tb_paquetes` (`id_paquete`),
  ADD CONSTRAINT `tb_servicios_x_paquetes_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `tb_servicios` (`id_servicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
