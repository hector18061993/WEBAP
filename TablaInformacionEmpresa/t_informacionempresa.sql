--------------------------------------------------------

CREATE TABLE IF NOT EXISTS `t_informacionempresa` (
  `idinformacionempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `subdescripcion` varchar(10),
  PRIMARY KEY (`idinformacionempresa`)
);

