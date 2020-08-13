-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2020 a las 17:53:12
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `username`, `fullname`, `email`, `password`, `created_at`) VALUES
(4, 'administrador', 'administrador', 'administrador@gmail.com', 'administrador', '2020-08-13 10:17:30.000000'),
(6, 'usuario1', 'usuario1', 'usuario1@hotmail.com', 'usuario1', '2020-08-13 10:26:16.000000'),
(8, 'usuario1', 'usuario1', 'usuario1@hotmail.com', 'usuario1', '2020-08-13 10:41:18.000000'),
(9, 'usuario1', 'usuario1', 'usuario1@hotmail.com', 'usuario1', '2020-08-13 10:42:00.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustible`
--

CREATE TABLE `combustible` (
  `idcombustible` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `costo` decimal(11,2) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `combustible`
--

INSERT INTO `combustible` (`idcombustible`, `nombre`, `imagen`, `costo`, `activo`, `idestacion`) VALUES
(1, 'Diesel g500', 'diesel1.1 ', '18.22', 0, 1),
(2, 'Diesel G-500', 'diesel.png', '18.22', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diferenciador`
--

CREATE TABLE `diferenciador` (
  `iddiferenciador` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `liga` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `diferenciador`
--

INSERT INTO `diferenciador` (`iddiferenciador`, `imagen`, `descripcion`, `liga`) VALUES
(4, 'imagen3.9', 'crianza de perros', 'http:diferenciador/crianzaperros.com.mx'),
(5, 'imagen26.png', 'nueva gasolina g500', 'http:diferenciador.com.mx/nuevagasolina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacion`
--

CREATE TABLE `estacion` (
  `idestacion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `servicio` tinyint(1) NOT NULL,
  `razonsocial` varchar(100) NOT NULL,
  `rfc` varchar(100) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estacion`
--

INSERT INTO `estacion` (`idestacion`, `nombre`, `lat`, `lng`, `direccion`, `telefono`, `email`, `activo`, `servicio`, `razonsocial`, `rfc`, `imagen`) VALUES
(1, 'Estacion Toluca1', '19.290787', '-99.050816', 'Avenida Independencia No. 208 colonia Centro', '2140101', 'estaciontoluca@hotmail.com', 1, 1, 'centrotoluca01', 'centrotoluca01', 'img1'),
(2, 'Estacion Zitacuaro', '19.805609', '-100.205609', 'Avenida Lerma No. 1501 Colonia Centro ', '5508070605', NULL, 1, 1, 'lerma010', 'lerma010', 'lerma.imagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerenteturno`
--

CREATE TABLE `gerenteturno` (
  `idgerenteturno` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gerenteturno`
--

INSERT INTO `gerenteturno` (`idgerenteturno`, `nombre`, `apellido`, `direccion`, `telefono`, `email`, `usuario`, `password`, `activo`, `idestacion`) VALUES
(2, 'Carlos', 'Rodriguez', 'Avenida Carranza s/n col. La maquina, Metepec, Estado de Mexico', '7225011865', 'carlos.estacion@hotmail.com', 'carlosestacion', 'carlos1', 1, 1),
(3, 'Jose Miguel', 'Alcantara', 'Avenida Estado de Mexico No. 1850', NULL, 'migualestacionlerma@hotmail.com', 'miguellerma', 'miguellerma', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerenteturnopermiso`
--

CREATE TABLE `gerenteturnopermiso` (
  `idgerenteturnopermiso` int(11) NOT NULL,
  `idgerenteturno` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialcombustible`
--

CREATE TABLE `historialcombustible` (
  `idhistorialcombustible` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` decimal(11,2) NOT NULL,
  `fecha` datetime(6) NOT NULL,
  `costo` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idhorarios` int(11) NOT NULL,
  `nombredia` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idhorarios`, `nombredia`, `descripcion`, `idestacion`) VALUES
(1, 'De Lunes a Viernes', 'Se abre de 8 de la mañana a 11 de la noche\r\nSabados y Domingos se abre de 9 de la mañana a 10 de la ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nosotros`
--

CREATE TABLE `nosotros` (
  `idnosotros` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nosotros`
--

INSERT INTO `nosotros` (`idnosotros`, `titulo`, `descripcion`) VALUES
(2, 'Vision', 'Nuestra misión es comprometernos con nuestros clientes a brindarles un servicio de calidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `idnoticia` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fechaelaboracion` datetime(6) NOT NULL,
  `fechapublicacion` datetime(6) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`idnoticia`, `nombre`, `descripcion`, `imagen`, `fechaelaboracion`, `fechapublicacion`, `activo`, `idestacion`) VALUES
(1, 'Nueva Estación en Metepec!!', 'Se apertura una nueva estacion en el Centro de Metepec', 'apertura.png', '2020-06-18 16:40:20.000000', '2020-08-06 16:40:20.000000', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasfrecuentes`
--

CREATE TABLE `preguntasfrecuentes` (
  `idpreguntasfrecuentes` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntasfrecuentes`
--

INSERT INTO `preguntasfrecuentes` (`idpreguntasfrecuentes`, `titulo`, `descripcion`) VALUES
(4, '¿Cual es el mejor combustible del corporativo?', 'Tenemos muchos tipos de combustibles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `idprioridad` int(11) NOT NULL,
  `numero` int(3) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privacidad`
--

CREATE TABLE `privacidad` (
  `idprivacidad` int(5) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privacidad`
--

INSERT INTO `privacidad` (`idprivacidad`, `titulo`, `descripcion`) VALUES
(2, 'Privacidad2.2', 'Privacidad2.2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productossecundarios`
--

CREATE TABLE `productossecundarios` (
  `idproductossecundarios` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `costo` decimal(11,2) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serviciosamenidades`
--

CREATE TABLE `serviciosamenidades` (
  `idserviciosamenidades` int(11) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) NOT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `serviciosamenidades`
--

INSERT INTO `serviciosamenidades` (`idserviciosamenidades`, `imagen`, `nombre`, `descripcion`, `idestacion`) VALUES
(1, 'img1', 'Baños Publicos', 'Se cuenta con baños publicos en la Estacion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisor`
--

CREATE TABLE `supervisor` (
  `idsupervisor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `idestacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `supervisor`
--

INSERT INTO `supervisor` (`idsupervisor`, `nombre`, `apellido`, `email`, `telefono`, `idestacion`) VALUES
(1, 'Mario', 'Lara', 'm.lara@hotmail.com', '55010298978', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD PRIMARY KEY (`idcombustible`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `diferenciador`
--
ALTER TABLE `diferenciador`
  ADD PRIMARY KEY (`iddiferenciador`);

--
-- Indices de la tabla `estacion`
--
ALTER TABLE `estacion`
  ADD PRIMARY KEY (`idestacion`);

--
-- Indices de la tabla `gerenteturno`
--
ALTER TABLE `gerenteturno`
  ADD PRIMARY KEY (`idgerenteturno`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `gerenteturnopermiso`
--
ALTER TABLE `gerenteturnopermiso`
  ADD PRIMARY KEY (`idgerenteturnopermiso`),
  ADD KEY `idgerenteturno` (`idgerenteturno`,`idpermiso`),
  ADD KEY `idpermiso` (`idpermiso`);

--
-- Indices de la tabla `historialcombustible`
--
ALTER TABLE `historialcombustible`
  ADD PRIMARY KEY (`idhistorialcombustible`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idhorarios`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  ADD PRIMARY KEY (`idnosotros`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idnoticia`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `preguntasfrecuentes`
--
ALTER TABLE `preguntasfrecuentes`
  ADD PRIMARY KEY (`idpreguntasfrecuentes`);

--
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`idprioridad`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `privacidad`
--
ALTER TABLE `privacidad`
  ADD PRIMARY KEY (`idprivacidad`);

--
-- Indices de la tabla `productossecundarios`
--
ALTER TABLE `productossecundarios`
  ADD PRIMARY KEY (`idproductossecundarios`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `serviciosamenidades`
--
ALTER TABLE `serviciosamenidades`
  ADD PRIMARY KEY (`idserviciosamenidades`),
  ADD KEY `idestacion` (`idestacion`);

--
-- Indices de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`idsupervisor`),
  ADD KEY `idestacion` (`idestacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `combustible`
--
ALTER TABLE `combustible`
  MODIFY `idcombustible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `diferenciador`
--
ALTER TABLE `diferenciador`
  MODIFY `iddiferenciador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estacion`
--
ALTER TABLE `estacion`
  MODIFY `idestacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gerenteturno`
--
ALTER TABLE `gerenteturno`
  MODIFY `idgerenteturno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `gerenteturnopermiso`
--
ALTER TABLE `gerenteturnopermiso`
  MODIFY `idgerenteturnopermiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historialcombustible`
--
ALTER TABLE `historialcombustible`
  MODIFY `idhistorialcombustible` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  MODIFY `idnosotros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idnoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntasfrecuentes`
--
ALTER TABLE `preguntasfrecuentes`
  MODIFY `idpreguntasfrecuentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `idprioridad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `privacidad`
--
ALTER TABLE `privacidad`
  MODIFY `idprivacidad` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productossecundarios`
--
ALTER TABLE `productossecundarios`
  MODIFY `idproductossecundarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `serviciosamenidades`
--
ALTER TABLE `serviciosamenidades`
  MODIFY `idserviciosamenidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `idsupervisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD CONSTRAINT `combustible_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gerenteturno`
--
ALTER TABLE `gerenteturno`
  ADD CONSTRAINT `gerenteturno_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gerenteturnopermiso`
--
ALTER TABLE `gerenteturnopermiso`
  ADD CONSTRAINT `gerenteturnopermiso_ibfk_1` FOREIGN KEY (`idgerenteturno`) REFERENCES `gerenteturno` (`idgerenteturno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gerenteturnopermiso_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD CONSTRAINT `prioridad_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productossecundarios`
--
ALTER TABLE `productossecundarios`
  ADD CONSTRAINT `productossecundarios_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `serviciosamenidades`
--
ALTER TABLE `serviciosamenidades`
  ADD CONSTRAINT `serviciosamenidades_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`idestacion`) REFERENCES `estacion` (`idestacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
