﻿-- MySQL Script generated by MySQL Workbench
-- Tue May 23 22:30:31 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Pais` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Pais` (
  `id_pais` INT NOT NULL AUTO_INCREMENT,
  `nombre_pais` VARCHAR(45) NOT NULL,
  `bandera` BLOB NOT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Rol` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Rol` (
  `id_Rol` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Region` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Region` (
  `id_Region` INT NOT NULL AUTO_INCREMENT,
  `nombre_region` VARCHAR(45) NULL,
  `id_pais` INT NOT NULL,
  PRIMARY KEY (`id_Region`),
  INDEX `fk_pais_de_region_idx` (`id_pais` ASC),
  CONSTRAINT `fk_pais_de_region`
    FOREIGN KEY (`id_pais`)
    REFERENCES `mydb`.`Pais` (`id_pais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Comuna`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Comuna` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Comuna` (
  `id_comuna` INT NOT NULL AUTO_INCREMENT,
  `id_pais` INT NOT NULL,
  `nombre_comuna` VARCHAR(45) NOT NULL,
  `id_region` INT NOT NULL,
  PRIMARY KEY (`id_comuna`),
  INDEX `fk_pais_idx` (`id_pais` ASC),
  INDEX `fk_region_idx` (`id_region` ASC),
  CONSTRAINT `fk_pais`
    FOREIGN KEY (`id_pais`)
    REFERENCES `mydb`.`Pais` (`id_pais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_region`
    FOREIGN KEY (`id_region`)
    REFERENCES `mydb`.`Region` (`id_Region`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NOT NULL,
  `ape_paterno` VARCHAR(45) NOT NULL,
  `ape_materno` VARCHAR(45) NOT NULL,
  `nick` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `rol` INT NOT NULL,
  `id_nacionalidad` INT NOT NULL,
  `descripcion` VARCHAR(500) NULL,
  `gustos` LONGTEXT NULL,
  `id_seguidos` LONGTEXT NULL,
  `seguidores` LONGTEXT NULL,
  `portada_img` BLOB NOT NULL,
  `perfil_img` BLOB NOT NULL,
  `comuna` INT NULL,
  `telefono` VARCHAR(13) NOT NULL,
  `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `nick_UNIQUE` (`nick` ASC),
  INDEX `fk_nacionalidad_idx` (`id_nacionalidad` ASC),
  INDEX `fk_rol_idx` (`rol` ASC),
  INDEX `fk_comuna_idx` (`comuna` ASC),
  UNIQUE INDEX `id_usuario_UNIQUE` (`id_usuario` ASC),
  CONSTRAINT `fk_nacionalidad`
    FOREIGN KEY (`id_nacionalidad`)
    REFERENCES `mydb`.`Pais` (`id_pais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rol`
    FOREIGN KEY (`rol`)
    REFERENCES `mydb`.`Rol` (`id_Rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comuna`
    FOREIGN KEY (`comuna`)
    REFERENCES `mydb`.`Comuna` (`id_comuna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Categorias` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Categorias` (
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Album`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Album` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Album` (
  `id_album` INT NOT NULL AUTO_INCREMENT,
  `portada` BLOB NOT NULL,
  `id_usuario` INT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_album`),
  INDEX `FK_ID_USUARIO_idx` (`id_usuario` ASC),
  INDEX `fk_album_tipo_idx` (`tipo` ASC),
  CONSTRAINT `FK_ID_USUARIO_album`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mydb`.`Usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_album_tipo`
    FOREIGN KEY (`tipo`)
    REFERENCES `mydb`.`Categorias` (`tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Foto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Foto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Foto` (
  `id_foto` INT NOT NULL AUTO_INCREMENT,
  `foto` BLOB NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_album` INT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_foto`),
  INDEX `FK_ID_ALBUM_idx` (`id_album` ASC),
  INDEX `fk_foto_tipo_idx` (`tipo` ASC),
  CONSTRAINT `FK_ID_ALBUM`
    FOREIGN KEY (`id_album`)
    REFERENCES `mydb`.`Album` (`id_album`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_foto_tipo`
    FOREIGN KEY (`tipo`)
    REFERENCES `mydb`.`Categorias` (`tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Validacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Validacion` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Validacion` (
  `id_usuario` INT NOT NULL,
  `pass` MEDIUMTEXT NOT NULL,
  INDEX `FK_ID_USUARIO_idx` (`id_usuario` ASC),
  CONSTRAINT `FK_ID_USUARIO`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mydb`.`Usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Comentarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Comentarios` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Comentarios` (
  `id_album` INT NOT NULL,
  `id_foto` INT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comentario` LONGTEXT NOT NULL,
  `id_comentario` INT NOT NULL AUTO_INCREMENT,
  INDEX `FK_ID_FOTO_idx` (`id_foto` ASC),
  INDEX `FK_ID_ALBUM_idx` (`id_album` ASC),
  PRIMARY KEY (`id_comentario`),
  CONSTRAINT `FK_ID_FOTO`
    FOREIGN KEY (`id_foto`)
    REFERENCES `mydb`.`Foto` (`id_foto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ID_ALBUM_COMENTARIO`
    FOREIGN KEY (`id_album`)
    REFERENCES `mydb`.`Album` (`id_album`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Contactos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Contactos` (
  `id_Contactos` INT NOT NULL AUTO_INCREMENT,
  `id_contactador` INT NOT NULL,
  `id_contactado` INT NOT NULL,
  `tipo_trabajo` VARCHAR(45) NOT NULL,
  `valor` VARCHAR(45) NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_Contactos`),
  INDEX `fk_contacto_idx` (`id_contactador` ASC),
  INDEX `fk_contactado_idx` (`id_contactado` ASC),
  CONSTRAINT `fk_contacto`
    FOREIGN KEY (`id_contactador`)
    REFERENCES `mydb`.`Usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contactado`
    FOREIGN KEY (`id_contactado`)
    REFERENCES `mydb`.`Usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Rol` (`id_Rol`, `tipo`) VALUES (1, 'Administrador');
INSERT INTO `mydb`.`Rol` (`id_Rol`, `tipo`) VALUES (2, 'Diseñador');
INSERT INTO `mydb`.`Rol` (`id_Rol`, `tipo`) VALUES (3, 'Normal');
INSERT INTO `mydb`.`Rol` (`id_Rol`, `tipo`) VALUES (4, 'Modelo');

COMMIT;

