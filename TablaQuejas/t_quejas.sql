--------------------------------------------------------
use sistemaap;

CREATE TABLE IF NOT EXISTS `t_quejas` (
  `idquejas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
   PRIMARY KEY (`idquejas`)
);

