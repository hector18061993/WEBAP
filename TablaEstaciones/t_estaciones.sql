--------------------------------------------------------


CREATE TABLE IF NOT EXISTS `t_estaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cx` int(10) NOT NULL,
  `cy` int(10) NOT NULL,
  `tipocombustible` varchar(255) NOT NULL,
  `costocombustible` varchar(10) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `idgerente1` int(11) NOT NULL,
  `idgerente2` int(11) NOT NULL,
  `idgerente3` int(11) NOT NULL,
  `activo` int() NOT NULL,
  `enservicio` int() NOT NULL,
  `razonsocial` varchar(250) NOT NULL,
  `rfc` varchar(250),
  `zona` varchar(250),
  `supervisor` varchar(250),
  `prioridad` varchar(250),
  `direccion` varchar(250),
  `telefono` int(10),
  `correo` varchar(250),
  PRIMARY KEY (`id`)
);
