-- show variables like 'max_allowed_packet'
-- set global max_allowed_packet=33554432

-- Crear BD
CREATE DATABASE IF NOT EXISTS posgrados character set utf8 collate utf8_general_ci;
USE posgrados;

-- Cotejamiento
ALTER DATABASE posgrados CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Crear Tablas
CREATE TABLE IF NOT EXISTS st (
	id_st int NOT NULL AUTO_INCREMENT,
	st VARCHAR(255) NOT NULL,
	CONSTRAINT pk_statusPedido PRIMARY KEY (id_st)
);

CREATE TABLE IF NOT EXISTS rol (
	id_rol int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	CONSTRAINT pk_rol PRIMARY KEY (id_rol)
);

CREATE TABLE IF NOT EXISTS usuarios (
	id_usu int AUTO_INCREMENT NOT NULL,
	usuario VARCHAR(255) NOT NULL UNIQUE,
	correo VARCHAR(255) NOT NULL UNIQUE,
	pass VARCHAR(255) NOT NULL,
	id_rol int NOT NULL,
	CONSTRAINT pk_usu PRIMARY KEY (id_usu)
);

CREATE TABLE IF NOT EXISTS tipo (
	id_tipo int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	CONSTRAINT pk_tipo PRIMARY KEY (id_tipo)
);

CREATE TABLE IF NOT EXISTS nivel (
	id_niv int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	CONSTRAINT pk_niv PRIMARY KEY (id_niv)
);

CREATE TABLE IF NOT EXISTS division (
	id_div int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	CONSTRAINT pk_div PRIMARY KEY (id_div)
);

CREATE TABLE IF NOT EXISTS maestria (
	id_ma int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	objetivo TEXT NOT NULL,
	pingreso TEXT NOT NULL,
	req TEXT NOT NULL,
	pegreso TEXT NOT NULL,
	campo TEXT NOT NULL,
	competencias TEXT,
	img TEXT NOT NULL,
    id_tipo int NOT NULL,
    id_div int NOT NULL,
    opT TEXT,
	CONSTRAINT pk_ma PRIMARY KEY (id_ma)
);

CREATE TABLE IF NOT EXISTS investigadores (
	id_in int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	lic TEXT NOT NULL,
	maestria TEXT NOT NULL,
	doctorado TEXT,
	correo TEXT,
	samblanza TEXT NOT NULL,
	img TEXT NOT NULL,
    id_niv int NOT NULL,
    id_div int NOT NULL,
	CONSTRAINT pk_in PRIMARY KEY (id_in)
);

CREATE TABLE IF NOT EXISTS directores (
	id_direc int NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	correo TEXT NOT NULL,
    id_div int NOT NULL,
	CONSTRAINT pk_in PRIMARY KEY (id_direc)
);

CREATE TABLE IF NOT EXISTS slider (
	id_sli int NOT NULL AUTO_INCREMENT,
	img TEXT,
    redir TEXT NOT NULL,
	CONSTRAINT pk_sli PRIMARY KEY (id_sli)
);

CREATE TABLE IF NOT EXISTS wrapper (
	id_wra int NOT NULL AUTO_INCREMENT,
	img TEXT,
    redir TEXT NOT NULL,
    titulo TEXT NOT NULL,
    descripcion TEXT NOT NULL,
	CONSTRAINT pk_wra PRIMARY KEY (id_wra)
);

-- FK

ALTER TABLE usuarios ADD CONSTRAINT fk_rol FOREIGN KEY(id_rol) REFERENCES rol(id_rol) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE maestria ADD CONSTRAINT fk_tipo FOREIGN KEY(id_tipo) REFERENCES tipo(id_tipo) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE maestria ADD CONSTRAINT fk_div_ma FOREIGN KEY(id_div) REFERENCES division(id_div) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE directores ADD CONSTRAINT fk_div FOREIGN KEY(id_div) REFERENCES division(id_div) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE investigadores ADD CONSTRAINT fk_niv FOREIGN KEY(id_niv) REFERENCES nivel(id_niv) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE investigadores ADD CONSTRAINT fk_div_in FOREIGN KEY(id_div) REFERENCES division(id_div) ON DELETE CASCADE ON UPDATE CASCADE;

-- FK Status
-- ALTER TABLE usuarios ADD CONSTRAINT fk_stUsu FOREIGN KEY(id_statusUsu) REFERENCES statusAll(id_status) ON DELETE CASCADE ON UPDATE CASCADE;

-- Insertar datos

INSERT INTO rol VALUES
	(1, 'Admininstrador');

INSERT INTO nivel VALUES
	(1, 'PTC');

INSERT INTO st VALUES
	(1, 'Habilitado'),
	(2, 'Deshabilitado');

INSERT INTO tipo VALUES
	(1, 'Maestría'),
	(2, 'Doctorado');

INSERT INTO division VALUES
	(1, 'División de Licenciatura en Administración'),
	(2, 'División de Ingeniería Industrial'),
	(3, 'División de Ingeniería Mecatrónica'),
	(4, 'División de Ingeniería en Nanotecnología'),
	(5, 'División de Ingeniería en Informática');

INSERT INTO usuarios VALUES
	(null, 'admin', 'posgrados@gmail.com', MD5('post'), 1);

INSERT INTO directores VALUES
	(null, 'Ing. Gustavo Zea Nápoles', 'informatica@upvm.edu.mx', 5);