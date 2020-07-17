-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2020 a las 00:57:32
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
-- Base de datos: `sistemaap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_combustible`
--

CREATE TABLE `t_combustible` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `costoactual` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_combustible`
--

INSERT INTO `t_combustible` (`id`, `nombre`, `descripcion`, `costoactual`) VALUES
(2, 'Combustible Magna', 'Para todo tipo de motores con inyeccion directa', '$15.78');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_contacto`
--

CREATE TABLE `t_contacto` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_contacto`
--

INSERT INTO `t_contacto` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Correo', 'corporativoAP@gmail.com'),
(2, 'facebook', 'facebook/CorporativoAP'),
(4, 'Whats App', 'Whats App: 7225454545');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estaciones`
--

CREATE TABLE `t_estaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `cx` varchar(20) NOT NULL,
  `cy` varchar(20) NOT NULL,
  `razonsocial` varchar(250) NOT NULL,
  `rfc` varchar(250) NOT NULL,
  `zona` varchar(250) NOT NULL,
  `supervisor` varchar(250) NOT NULL,
  `prioridad` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `activo` int(2) NOT NULL,
  `enservicio` int(2) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `idgerente1` int(11) NOT NULL,
  `idgerente2` int(11) NOT NULL,
  `idgerente3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_estaciones`
--

INSERT INTO `t_estaciones` (`id`, `nombre`, `descripcion`, `cx`, `cy`, `razonsocial`, `rfc`, `zona`, `supervisor`, `prioridad`, `direccion`, `telefono`, `correo`, `activo`, `enservicio`, `idproducto`, `idservicio`, `idgerente1`, `idgerente2`, `idgerente3`) VALUES
(2, 'Metepec', 'metepec centro', '19.25938304319944', '-99.60462912601363', 'Moral', 'WER456TTT', 'CENTRO', 'Call', 'Bajo', 'Metepec Centro', '7865484848', 'estacionmetepec@gmail.com', 1, 1, 1, 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_gerenteturno`
--

CREATE TABLE `t_gerenteturno` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `turno` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuariogerente` varchar(255) NOT NULL,
  `clavegerente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_gerenteturno`
--

INSERT INTO `t_gerenteturno` (`id`, `nombre`, `apellidos`, `turno`, `direccion`, `telefono`, `email`, `usuariogerente`, `clavegerente`) VALUES
(5, 'Rafael', 'Sanchez Cruz', 'Vespertino', 'La cruz Comalco', '754845454152415', 'rafael@gmail.com', 'rafael1', 'rafael1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_informacionempresa`
--

CREATE TABLE `t_informacionempresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `subdescripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_informacionempresa`
--

INSERT INTO `t_informacionempresa` (`id`, `nombre`, `descripcion`, `subdescripcion`) VALUES
(2, 'Mision', 'Mision de la Empresa', 'Nuestra Mision es generar confianza con los clientes y para nosotros es nuesta satisfacción'),
(3, 'Valores', 'Valor de la confianza', 'Somos una empresa confiable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_noticia`
--

CREATE TABLE `t_noticia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_noticia`
--

INSERT INTO `t_noticia` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(2, 'Proximamente...', 'Proximamente se apertura nueva estacion', 'imagen2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_prioridad`
--

CREATE TABLE `t_prioridad` (
  `id` int(3) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_prioridad`
--

INSERT INTO `t_prioridad` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Alto', 'De suma importancia'),
(3, 'Medio-Alto', 'De poca importancia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_producto`
--

CREATE TABLE `t_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `costo` varchar(15) NOT NULL,
  `descuento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_producto`
--

INSERT INTO `t_producto` (`id`, `nombre`, `descripcion`, `categoria`, `costo`, `descuento`) VALUES
(2, 'Limpiador de parabrisas', 'Limpiador de parabrisas', 'Limpiador', '$150.00', 'No incluye descuento'),
(3, 'Cambio de llantas al 50%', 'Cambio de llantas', '', '$400.00', 'descuento del 50% en cambio de llantas'),
(4, 'Cambio de llantas al 50%', 'Cambio de llantas', '', '$400.00', 'Cambio de llantas al 50% de descuento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_quejas`
--

CREATE TABLE `t_quejas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_quejas`
--

INSERT INTO `t_quejas` (`id`, `nombre`, `descripcion`, `correo`) VALUES
(2, 'Queja de gasolina en mal estado', 'queja de gasolina en mal estado', 'queja@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servicio`
--

CREATE TABLE `t_servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `costo` int(10) NOT NULL,
  `descuento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_servicio`
--

INSERT INTO `t_servicio` (`id`, `nombre`, `descripcion`, `costo`, `descuento`) VALUES
(2, 'Cambio de aceite', 'cambio de aceite', 300, 'se cambia el aceite de tu automovil por $300');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_sugerencias`
--

CREATE TABLE `t_sugerencias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_sugerencias`
--

INSERT INTO `t_sugerencias` (`id`, `nombre`, `descripcion`, `correo`) VALUES
(3, 'agregar mas servicios', 'agregar mas servicios', 'agregar mas servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_supervisor`
--

CREATE TABLE `t_supervisor` (
  `id` int(5) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `apellidos` varchar(300) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `zona` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `estacion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_supervisor`
--

INSERT INTO `t_supervisor` (`id`, `nombre`, `apellidos`, `correo`, `zona`, `telefono`, `estacion`) VALUES
(3, 'Arturo', 'Rodriguez', 'arturo@gmail.com', 'Mexico', '7894949497', 'mexico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_combustible`
--
ALTER TABLE `t_combustible`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_contacto`
--
ALTER TABLE `t_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_estaciones`
--
ALTER TABLE `t_estaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_gerenteturno`
--
ALTER TABLE `t_gerenteturno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_informacionempresa`
--
ALTER TABLE `t_informacionempresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_noticia`
--
ALTER TABLE `t_noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_prioridad`
--
ALTER TABLE `t_prioridad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_producto`
--
ALTER TABLE `t_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_quejas`
--
ALTER TABLE `t_quejas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_servicio`
--
ALTER TABLE `t_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_sugerencias`
--
ALTER TABLE `t_sugerencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_supervisor`
--
ALTER TABLE `t_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_combustible`
--
ALTER TABLE `t_combustible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_contacto`
--
ALTER TABLE `t_contacto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_estaciones`
--
ALTER TABLE `t_estaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_gerenteturno`
--
ALTER TABLE `t_gerenteturno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `t_informacionempresa`
--
ALTER TABLE `t_informacionempresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_noticia`
--
ALTER TABLE `t_noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_prioridad`
--
ALTER TABLE `t_prioridad`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_producto`
--
ALTER TABLE `t_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_quejas`
--
ALTER TABLE `t_quejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_servicio`
--
ALTER TABLE `t_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_sugerencias`
--
ALTER TABLE `t_sugerencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_supervisor`
--
ALTER TABLE `t_supervisor`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
