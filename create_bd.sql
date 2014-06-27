
-- 
-- Estructura de tabla para la tabla `apostantes`
-- 

CREATE TABLE `apostantes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE_UNIQUE` (`NOMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `apuestas`
-- 

CREATE TABLE `apuestas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PARTIDO` int(11) NOT NULL,
  `APUESTA` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `APOSTADO` float DEFAULT NULL,
  `COTIZACION` float DEFAULT NULL,
  `ACERTADA` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `AP_PARTIDO` (`PARTIDO`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=131 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `chat`
-- 

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `MENSAJE` varchar(1000) COLLATE latin1_spanish_ci DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `equipos`
-- 

CREATE TABLE `equipos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `GRUPO` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `ESCUDO` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE_UNIQUE` (`NOMBRE`),
  UNIQUE KEY `ESCUDO_UNIQUE` (`ESCUDO`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fases`
-- 

CREATE TABLE `fases` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(45) DEFAULT NULL,
  `ACTIVA` int(11) DEFAULT NULL,
  `CLAVE` varchar(45) DEFAULT NULL,
  `MAX_APUESTA` float DEFAULT '0',
  `NUM_APOSTANTES` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `partido_apost_apuesta`
-- 

CREATE TABLE `partido_apost_apuesta` (
  `idapuesta` int(11) NOT NULL,
  `idpartidoapost` int(11) NOT NULL,
  PRIMARY KEY (`idapuesta`,`idpartidoapost`),
  KEY `apuesta_idx` (`idapuesta`),
  KEY `apuesta_part_idx` (`idpartidoapost`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `partido_apostante`
-- 

CREATE TABLE `partido_apostante` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `idpartido` int(11) NOT NULL,
  `idapostante` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `partido_partido_idx` (`idpartido`),
  KEY `apost_apost_idx` (`idapostante`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `partidos`
-- 

CREATE TABLE `partidos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOCAL` int(11) NOT NULL,
  `VISITANTE` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL,
  `FASE` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `EQ_PART` (`LOCAL`),
  KEY `EQ_PART_2` (`VISITANTE`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `propiedades`
-- 

CREATE TABLE `propiedades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `VALOR` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sort_apostantes_restantes`
-- 

CREATE TABLE `sort_apostantes_restantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `json_apostante` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `json_apostantes_en_rosco` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sort_sorteados`
-- 

CREATE TABLE `sort_sorteados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `json_partido` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `json_apostante` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sort_sorteo`
-- 

CREATE TABLE `sort_sorteo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `json_partido_actual` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `json_partido_prox` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `json_apostante_actual` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `user`
-- 

CREATE TABLE `user` (
  `username` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `password_sha1` varchar(40) COLLATE latin1_spanish_ci NOT NULL DEFAULT '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',
  `userid` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `partido_apost_apuesta`
-- 
ALTER TABLE `partido_apost_apuesta`
  ADD CONSTRAINT `apuesta` FOREIGN KEY (`idapuesta`) REFERENCES `apuestas` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `partido` FOREIGN KEY (`idpartidoapost`) REFERENCES `partido_apostante` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `partido_apostante`
-- 
ALTER TABLE `partido_apostante`
  ADD CONSTRAINT `apost_apost` FOREIGN KEY (`idapostante`) REFERENCES `apostantes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `partidos`
-- 
ALTER TABLE `partidos`
  ADD CONSTRAINT `EQ_PART` FOREIGN KEY (`LOCAL`) REFERENCES `equipos` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `EQ_PART_2` FOREIGN KEY (`VISITANTE`) REFERENCES `equipos` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
