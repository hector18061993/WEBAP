--------------------------------------------------------
use sistemaap;

CREATE TABLE IF NOT EXISTS `t_servicio` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `costo` int(10) NOT NULL,
  `descuento` varchar(100),
  PRIMARY KEY (`idservicio`)
);

