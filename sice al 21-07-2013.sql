-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2013 a las 08:23:27
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_est`
--

CREATE TABLE IF NOT EXISTS `datos_est` (
  `ced_esc` varchar(15) NOT NULL,
  `prim_apell` varchar(35) NOT NULL,
  `seg_apell` varchar(35) DEFAULT NULL,
  `prim_nomb` varchar(35) NOT NULL,
  `seg_nomb` varchar(35) DEFAULT NULL,
  `ced` int(11) DEFAULT NULL,
  `ced_rep` int(10) NOT NULL,
  `lugar_nac` varchar(35) NOT NULL,
  `mun_nac` varchar(35) DEFAULT NULL,
  `estado_nac` varchar(35) NOT NULL,
  `pais_nac` varchar(30) NOT NULL,
  `dia_nac` int(2) NOT NULL,
  `mes_nac` int(2) NOT NULL,
  `ano_nac` int(4) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `direccion_est` varchar(80) NOT NULL,
  `tlf_est` varchar(14) DEFAULT NULL,
  `nomb_plant` varchar(60) NOT NULL,
  `estado_plant` varchar(30) NOT NULL,
  `grado_culm` int(1) DEFAULT NULL,
  `nuevo_ing` int(1) NOT NULL,
  `grado_act` int(1) NOT NULL,
  `repitiente` int(1) NOT NULL,
  `calif_ant` varchar(1) NOT NULL,
  `beca` int(1) NOT NULL,
  `organismo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`ced_esc`),
  UNIQUE KEY `ced` (`ced`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personal`
--

CREATE TABLE IF NOT EXISTS `datos_personal` (
  `ced_personal` int(10) NOT NULL,
  `nomb_personal` varchar(30) NOT NULL,
  `apell_personal` varchar(30) NOT NULL,
  `tipo` int(1) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ced_personal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_personal`
--

INSERT INTO `datos_personal` (`ced_personal`, `nomb_personal`, `apell_personal`, `tipo`, `activo`) VALUES
(20100768, 'Christiam', 'Hurtado', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_rep`
--

CREATE TABLE IF NOT EXISTS `datos_rep` (
  `ced_rep` int(10) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telf_rep` varchar(14) NOT NULL,
  `direccion_rep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fisico_est`
--

CREATE TABLE IF NOT EXISTS `fisico_est` (
  `ced_esc` varchar(15) NOT NULL,
  `talla` varchar(10) NOT NULL,
  `peso` varchar(15) NOT NULL,
  `talla_c` varchar(10) NOT NULL,
  `talla_p` varchar(10) NOT NULL,
  `talla_z` varchar(10) NOT NULL,
  PRIMARY KEY (`ced_esc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_fam`
--

CREATE TABLE IF NOT EXISTS `grupo_fam` (
  `ced_esc` varchar(15) NOT NULL,
  `ced_madre` varchar(11) DEFAULT NULL,
  `ced_padre` varchar(11) DEFAULT NULL,
  `ced_otro` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ced_esc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `id_insc` varchar(30) NOT NULL,
  `ced_esc` varchar(15) NOT NULL,
  `ano_esc` varchar(10) NOT NULL,
  `grado` varchar(1) NOT NULL,
  `seccion` varchar(3) NOT NULL,
  PRIMARY KEY (`id_insc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud_est`
--

CREATE TABLE IF NOT EXISTS `salud_est` (
  `ced_esc` varchar(15) NOT NULL,
  `parto_tipo` int(1) NOT NULL,
  `parto_tiempo` int(1) NOT NULL,
  `enf_padece` varchar(80) DEFAULT NULL,
  `enf_padecida` varchar(80) DEFAULT NULL,
  `operaciones` varchar(80) DEFAULT NULL,
  `medicamento` varchar(80) DEFAULT NULL,
  `alergia` int(1) NOT NULL,
  `alergias` varchar(80) DEFAULT NULL,
  `protesis` int(1) NOT NULL,
  `visual` int(1) NOT NULL,
  `auditiva` int(1) NOT NULL,
  `lentes` int(1) NOT NULL,
  `aparatos` int(1) NOT NULL,
  `equilibrio` int(1) NOT NULL,
  `dif_aprend` varchar(80) DEFAULT NULL,
  `tipo_sangre` varchar(5) NOT NULL,
  `polio` int(1) NOT NULL,
  `vcg` int(1) NOT NULL,
  `toxoide` int(1) NOT NULL,
  `triple` int(1) NOT NULL,
  `fiebre_ama` int(1) NOT NULL,
  `sarampion` int(1) NOT NULL,
  `hepatitis` int(1) NOT NULL,
  `influenza` int(1) NOT NULL,
  `meningitis` int(1) NOT NULL,
  `otras_vacunas` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ced_esc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soc_eco_est`
--

CREATE TABLE IF NOT EXISTS `soc_eco_est` (
  `ced_esc` varchar(15) NOT NULL,
  `conviven` varchar(80) NOT NULL,
  `orientador` varchar(80) NOT NULL,
  `hermanos` int(11) DEFAULT NULL,
  `actividades` varchar(80) DEFAULT NULL,
  `tipo_vivienda` int(1) NOT NULL,
  `tenencia` int(1) NOT NULL,
  `agua` int(1) NOT NULL,
  `electricidad` int(1) NOT NULL,
  `internet` int(1) NOT NULL,
  `telefono` int(1) NOT NULL,
  `cloacas` int(1) NOT NULL,
  `tv_cable` int(1) NOT NULL,
  `ingreso` varchar(20) NOT NULL,
  `religion` varchar(50) NOT NULL,
  PRIMARY KEY (`ced_esc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soc_eco_madre`
--

CREATE TABLE IF NOT EXISTS `soc_eco_madre` (
  `apellidos` varchar(80) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `ced_madre` varchar(11) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `lugar_nac` varchar(80) DEFAULT NULL,
  `dia_nac` int(2) NOT NULL,
  `mes_nac` int(2) NOT NULL,
  `ano_nac` int(4) NOT NULL,
  `edad` varchar(3) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `instruccion` varchar(60) DEFAULT NULL,
  `oficio` varchar(80) DEFAULT NULL,
  `trabajo` varchar(80) DEFAULT NULL,
  `ingreso` varchar(10) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `convive` int(1) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `telf_madre` varchar(15) NOT NULL,
  PRIMARY KEY (`ced_madre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soc_eco_otro`
--

CREATE TABLE IF NOT EXISTS `soc_eco_otro` (
  `apellidos` varchar(80) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `ced_otro` int(11) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `lugar_nac` varchar(80) DEFAULT NULL,
  `dia_nac` int(2) NOT NULL,
  `mes_nac` int(2) NOT NULL,
  `ano_nac` int(4) NOT NULL,
  `edad` varchar(3) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `instruccion` varchar(60) DEFAULT NULL,
  `oficio` varchar(80) DEFAULT NULL,
  `trabajo` varchar(80) DEFAULT NULL,
  `ingreso` varchar(10) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `convive` int(1) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `telf_otro` varchar(15) NOT NULL,
  PRIMARY KEY (`ced_otro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soc_eco_padre`
--

CREATE TABLE IF NOT EXISTS `soc_eco_padre` (
  `apellidos` varchar(80) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `ced_padre` varchar(11) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `lugar_nac` varchar(80) DEFAULT NULL,
  `dia_nac` int(2) NOT NULL,
  `mes_nac` int(2) NOT NULL,
  `ano_nac` int(4) NOT NULL,
  `edad` int(3) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `instruccion` varchar(60) DEFAULT NULL,
  `oficio` varchar(80) DEFAULT NULL,
  `trabajo` varchar(80) DEFAULT NULL,
  `ingreso` varchar(10) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `convive` int(1) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `telf_padre` varchar(15) NOT NULL,
  PRIMARY KEY (`ced_padre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `user` varchar(30) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  PRIMARY KEY (`user`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user`, `pass`, `cedula`) VALUES
('admin', '1d366d287f04be240cd2b17f29e2339a', 20100768);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
