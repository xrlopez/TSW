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
	titulo VARCHAR(20) NOT NULL,
	descripcion CHAR(100) NOT NULL,
	fecha DATE NOT NULL,
	idUsuario VARCHAR(15) NOT NULL,
	CONSTRAINT FK_usuarios_preguntas FOREIGN KEY  (idUsuario) REFERENCES usuarios(idUsuario)	
);

CREATE TABLE respuestas(
	idRespuesta INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	idPregunta INT NOT NULL,
	descripcion CHAR(100) NOT NULL,
	votosPositivos INT NOT NULL,
	votosNegativos INT NOT NULL,
	idUsuario VARCHAR(15) NOT NULL,
	CONSTRAINT FK_usuarios_respuestas FOREIGN KEY  (idUsuario) REFERENCES usuarios(idUsuario),	
	CONSTRAINT FK_preguntas_respuestas FOREIGN KEY  (idPregunta) REFERENCES preguntas(idPregunta)
);

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `correo`, `password`) VALUES
('antonio', 'antonio', 'an@tonio.com', 'antonio'),
('luisa', 'luisa', 'lu@isa.com', 'luisa'),
('maria', 'maria', 'ma@ria.com', 'maria'),
('pepe', 'pepe', 'pepe@pepe.com', 'pepe');

INSERT INTO `preguntas` (`idPregunta`, `titulo`, `descripcion`, `fecha`, `idUsuario`) VALUES
(1, 'Preg 1', 'descripcion preg 1', '2015-11-22', 'maria'),
(2, 'Preg 2', 'descripcion preg 2', '2015-11-21', 'pepe'),
(3, 'Pregunta Luisa', 'algo', '2015-11-04', 'luisa'),
(4, 'Pregunta Antoni', 'no se', '2015-11-22', 'antonio');

INSERT INTO `respuestas` (`idRespuesta`, `idPregunta`, `descripcion`, `votosPositivos`, `votosNegativos`, `idUsuario`) VALUES
(1, 1, 'respuesta 1', 1, 0, 'maria'),
(2, 2, 'respuesta 1', 2, 0, 'pepe'),
(3, 2, 'respuesta 2', 3, 0, 'maria');