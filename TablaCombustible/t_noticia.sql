--------------------------------------------------------

CREATE TABLE IF NOT EXISTS `t_noticia` (
  `idnoticia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(50),
  PRIMARY KEY (`idnoticia`)
);

