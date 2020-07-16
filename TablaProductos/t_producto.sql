--------------------------------------------------------


CREATE TABLE IF NOT EXISTS `t_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `costo` int(15) NOT NULL,
  `descuento` varchar(100),
  PRIMARY KEY (`id`)
);

