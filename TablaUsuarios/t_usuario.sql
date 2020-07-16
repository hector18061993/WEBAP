--------------------------------------------------------


CREATE TABLE IF NOT EXISTS `t_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  
  PRIMARY KEY (`id`)
);


INSERT INTO `t_usuario` (`id`, `nombre`, `direccion`, `telefono`, `email`, `cargo`, `usuario`, `password`) 
VALUES ('1', 'Administrador', 'San Juan s/n', '722148975626', 'administrador@gmail.com', 'administrador', 
	         'administrador1', 'administrador1 ');
