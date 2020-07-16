--------------------------------------------------------
use sistemaap;

CREATE TABLE IF NOT EXISTS `t_gerenteturno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255),
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
   PRIMARY KEY (`id`)
);

