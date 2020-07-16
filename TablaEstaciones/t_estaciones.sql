--------------------------------------------------------


CREATE TABLE IF NOT EXISTS `t_estaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ubicacionlatitud` int(10) NOT NULL,
  `ubicacionlongitud` int(10) NOT NULL,
  `tipocombustible` varchar(255) NOT NULL,
  `costocombustible` varchar(10) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `idgerenteturno` int(11) NOT NULL,
  `idquejas` int(11) NOT NULL,
  `idsugerencias` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);
