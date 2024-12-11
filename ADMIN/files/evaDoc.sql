
CREATE DATABASE IF NOT EXISTS evaDoc;

USE evaDoc;

CREATE TABLE IF NOT EXISTS profesores(
    idProf int AUTO_INCREMENT,
    nombre VARCHAR(60),
    apPat VARCHAR(60),
    apMat VARCHAR(60),
    email VARCHAR(100),
    idCarrera int,
    CONSTRAINT pk_prof PRIMARY KEY (idProf)
);

CREATE TABLE IF NOT EXISTS universidad(
    idUni int AUTO_INCREMENT,
    nombre VARCHAR(30),
    direccion VARCHAR(100),
    website VARCHAR(100),
    noAlumns int,
    CCT VARCHAR(20),
    CONSTRAINT pk_uni PRIMARY KEY (idUni)
);

CREATE TABLE IF NOT EXISTS usuarios(
    idUsu int AUTO_INCREMENT,
    nombre VARCHAR(60),
    fecNac DATE,
    status VARCHAR(50),
    pass VARCHAR(20),
    idCarrera int,
    CONSTRAINT pk_usu PRIMARY KEY (idUsu)
);

CREATE TABLE IF NOT EXISTS grupo (
    idGrupo int AUTO_INCREMENT,
    descri VARCHAR(30),
    noAlu int,
    idCarrera int,
    pass VARCHAR(20),
    CONSTRAINT pk_grupo PRIMARY KEY (idGrupo)
);

CREATE TABLE IF NOT EXISTS materias(
    idMateria int AUTO_INCREMENT,
    descri VARCHAR(30),
    idCarrera int,
    CONSTRAINT pk_mate PRIMARY KEY (idMateria)
);

CREATE TABLE IF NOT EXISTS carreras (
    idCarrera int AUTO_INCREMENT,
    descri VARCHAR (30),
    CONSTRAINT pk_Carre PRIMARY KEY (idCarrera)
);

CREATE TABLE IF NOT EXISTS preguntas (
    idPreg int AUTO_INCREMENT,
    idCarrera int,
    descri VARCHAR(60),
    CONSTRAINT pk_preg PRIMARY KEY (idPreg, idCarrera)
);

CREATE TABLE IF NOT EXISTS respuestas (
    idRes int AUTO_INCREMENT,
    idPreg int,
    idGrupo int,
    idProf int,
    fecha DATE,
    calif DOUBLE,
    idMateria int,
    CONSTRAINT pk_res PRIMARY KEY (idRes, idPreg, idGrupo, idProf, fecha, idMateria)
);

CREATE TABLE IF NOT EXISTS rubros (
    idRubro int AUTO_INCREMENT,
    idPreg int,
    descri VARCHAR(200),
    CONSTRAINT pk_rub PRIMARY KEY (idRubro, idPreg)
);

CREATE TABLE IF NOT EXISTS grup_mate (
    idGrupo int,
    idMateria int, 
    fecha DATE,
    CONSTRAINT pk_grup_mate PRIMARY KEY (idGrupo, idMateria, fecha)
);

--FK

ALTER TABLE profesores ADD CONSTRAINT fk_prof_car FOREIGN KEY (idCarrera) REFERENCES carreras (idCarrera) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE usuarios ADD CONSTRAINT fk_usu_car FOREIGN KEY (idCarrera) REFERENCES carreras (idCarrera) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE grupo ADD CONSTRAINT fk_grup_car FOREIGN KEY (idCarrera) REFERENCES carreras (idCarrera) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE materias ADD CONSTRAINT fk_mate_car FOREIGN KEY (idCarrera) REFERENCES carreras (idCarrera) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE preguntas ADD CONSTRAINT fk_preg_car FOREIGN KEY (idCarrera) REFERENCES carreras (idCarrera) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE respuestas ADD CONSTRAINT fk_res_preg FOREIGN KEY (idPreg) REFERENCES preguntas (idPreg) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE respuestas ADD CONSTRAINT fk_res_grup FOREIGN KEY (idGrupo) REFERENCES grupo (idGrupo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE respuestas ADD CONSTRAINT fk_res_prof FOREIGN KEY (idProf) REFERENCES profesores (idProf) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE respuestas ADD CONSTRAINT fk_res_mate FOREIGN KEY (idMateria) REFERENCES materias (idMateria) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE rubros ADD CONSTRAINT fk_rub_preg FOREIGN KEY (idPreg) REFERENCES preguntas (idPreg) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE grup_mate ADD CONSTRAINT fk_gm_grup FOREIGN KEY (idGrupo) REFERENCES grupo (idGrupo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE grup_mate ADD CONSTRAINT fk_gm_mate FOREIGN KEY (idMateria) REFERENCES materias (idMateria) ON DELETE CASCADE ON UPDATE CASCADE;