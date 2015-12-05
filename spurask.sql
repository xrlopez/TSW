drop database if exists spurask;
create database spurask default character set utf8 default collate utf8_spanish_ci;
grant usage on *.* to 'userspurask'@'localhost';
drop user 'userspurask'@'localhost';
create user 'userspurask'@'localhost' identified by 'userspurask';
grant all on spurask.* to 'userspurask'@'localhost';

use spurask;

CREATE TABLE usuarios(
	idUsuario VARCHAR(15) PRIMARY KEY NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	apellidos VARCHAR(100) NOT NULL,
	correo VARCHAR(15) NOT NULL,
	password CHAR(32) NOT NULL	
);

CREATE TABLE preguntas(
	idPregunta INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	titulo VARCHAR(100) NOT NULL,
	descripcion CHAR(200) NOT NULL,
	fecha DATETIME NOT NULL,
	idUsuario VARCHAR(15) NOT NULL,
	CONSTRAINT FK_usuarios_preguntas FOREIGN KEY  (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE	
);

CREATE TABLE respuestas(
	idRespuesta INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	idPregunta INT NOT NULL,
	descripcion CHAR(200) NOT NULL,
	votosPositivos INT NOT NULL,
	votosNegativos INT NOT NULL,
	idUsuario VARCHAR(15) NOT NULL,
	CONSTRAINT FK_usuarios_respuestas FOREIGN KEY  (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE,	
	CONSTRAINT FK_preguntas_respuestas FOREIGN KEY  (idPregunta) REFERENCES preguntas(idPregunta) ON DELETE CASCADE
);

CREATE TABLE votos(
	idRespuesta INT NOT NULL,
	idUsuario VARCHAR(15) NOT NULL,
	voto ENUM('positivo','negativo') NOT NULL,
	PRIMARY KEY(idRespuesta,idUsuario),
	CONSTRAINT FK_usuarios_votos FOREIGN KEY  (idUsuario) REFERENCES usuarios(idUsuario) ON DELETE CASCADE,	
	CONSTRAINT FK_preguntas_votos FOREIGN KEY  (idRespuesta) REFERENCES respuestas(idRespuesta) ON DELETE CASCADE
);

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellidos`, `correo`, `password`) VALUES
('alicia', 'Alicia', 'López', 'alicia@gmail.co', 'e94ef563867e9c9df3fcc999bdb045f5'),
('javier', 'Javier', 'Pérez', 'javier@gmail.co', '3c9c03d6008a5adf42c2a55dd4a1a9f2'),
('luisa', 'luisa', 'fernandez', 'luisa@gmail.com', '327229a1f11cc3c7ce66ee5d1341ae51'),
('monica', 'Mónica', 'García', 'monica@gmail.co', 'ff0d813dd5d2f64dd372c6c4b6aed086'),
('ruben', 'Ruben', 'González', 'ruben@gmail.com', '32252792b9dccf239f5a5bd8e778dbc2'),
('victor', 'Victor', 'Rodriguez', 'victor@gmail.co', 'ffc150a160d37e92012c196b6af4160d');

INSERT INTO `preguntas` (`idPregunta`, `titulo`, `descripcion`, `fecha`, `idUsuario`) VALUES
(1, '¿Como puedo aprender a programar?', 'Necesito aprender a programar en Java', '2015-12-03 13:00:00', 'alicia'),
(2, '¿Que venenos no son detectados en una autopsia?', 'Me gustaría saber que venenos no son detectados y como conseguirlos', '2015-12-03 14:00:00', 'alicia'),
(3, '¿El café es dañino para la salud?', 'He leído que el café puede ser muy dañino.', '2015-12-03 15:00:00', 'javier'),
(4, '¿Por qué el ventilador del portátil se ensucia?', '¿Es porque le entra polvo?', '2015-12-03 16:00:00', 'javier'),
(5, '¿Como se llama la fobia a las sierras eléctricas?', 'Es urgente', '2015-12-03 17:00:00', 'javier'),
(6, '¿Por que el sol aclara el pelo y oscurece la piel?', 'Necesito una respuesta rápido.', '2015-12-03 18:00:00', 'luisa'),
(7, '¿Por qué no hay comida para gatos con sabor a ratón?', 'Mi gato lo necesita', '2015-12-03 19:00:00', 'monica'),
(8, '¿Por qué se esterilizan las agujas para las inyecciones letales?', 'No logro comprenderlo', '2015-12-03 20:00:00', 'ruben');