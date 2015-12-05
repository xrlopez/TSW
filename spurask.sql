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
(8, '¿Por qué se esterilizan las agujas para las inyecciones letales?', 'No logro comprenderlo', '2015-12-03 20:00:00', 'ruben'),
(9, '¿Alguien sabe de que tipo era el armario de Narnia?', 'El otro día vi la película y tengo ganas de verlo en persona', '2015-12-04 16:20:00', 'luisa'),
(10, '¿Cómo se llaman los fans de Metallica?', 'Discutiendo con mi hermano surgió la pregunta', '2015-12-04 16:40:00', 'ruben'),
(11, '¿Cómo metió Noé todos los animales en el arca?', 'Necesito saber como lo hizo', '2015-12-04 17:02:55', 'victor'),
(12, '¿Quien mató al mar muerto?', '¿Por qué está tan salado?', '2015-12-04 17:14:37', 'monica'),
(13, '¿Es ilegal hacer viajes en el tiempo?', 'Me gustaría realizar viajes en el tiempo pero quiero estar informado', '2015-12-04 17:23:56', 'javier'),
(14, '¿Dónde se puede comprar felicidad embotellada?', 'He ido a un montón de sitios pero no la encuentro', '2015-12-04 17:27:47', 'luisa'),
(15, '¿Como sigue el trabalenguas?', 'Tres tristes tigres comen trigo en un...', '2015-12-04 17:32:24', 'alicia');

INSERT INTO `respuestas` (`idRespuesta`, `idPregunta`, `descripcion`, `votosPositivos`, `votosNegativos`, `idUsuario`) VALUES
(1, 5, 'Sentido común', 0, 0, 'ruben'),
(2, 1, 'Existen muchas páginas en internet con tutoriales para cualquier lenguaje de programación.', 0, 0, 'luisa'),
(3, 3, 'Si esta muy caliente te puedes quemar', 0, 0, 'luisa'),
(4, 2, 'Se consiguen en el mercado negro', 0, 0, 'ruben'),
(5, 1, 'Para cualquier duda stackoverflow', 0, 0, 'monica'),
(6, 3, 'Si tomas muchos no duermes bien', 0, 0, 'javier'),
(7, 9, 'Es de tipo mágico', 0, 0, 'ruben'),
(8, 10, 'No se son muchos.\r\nDepende de como los hayan llamado sus padres', 0, 0, 'ruben'),
(9, 11, 'Los comprimió con winrar', 0, 0, 'monica'),
(10, 13, 'Solo si los haces con exceso de valocidad, en estado de ebriedad o realizando un salto cuántico por la derecha', 0, 0, 'luisa'),
(11, 14, 'Sí que hay. En los supermercados puedes comprar vodka, tequila...', 0, 0, 'alicia'),
(12, 15, 'Trigal', 0, 0, 'ruben'),
(13, 15, 'En ningún lado. Los tigres comen carne', 0, 0, 'alicia');

