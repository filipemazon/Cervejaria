-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dbBrejasOnRoad
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbBrejasOnRoad
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `dbBrejasOnRoad`;

CREATE SCHEMA IF NOT EXISTS `dbBrejasOnRoad` DEFAULT CHARACTER SET utf8 ;
USE `dbBrejasOnRoad` ;

-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`Cervejaria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`Cervejaria` (
  `cnpj` VARCHAR(18) NOT NULL,
  `nome` VARCHAR(80) NOT NULL,
  `endereco` VARCHAR(80) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `site` VARCHAR(80) NULL,
  `logo` VARCHAR(255) NULL,
  PRIMARY KEY (`cnpj`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`Fabricas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`Fabricas` (
  `idFabricas` INT NOT NULL AUTO_INCREMENT,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `quantestoque` INT NULL,
  `Cervejaria_cnpj` VARCHAR(18) NULL,
  PRIMARY KEY (`idFabricas`),
  INDEX `fk_Fabricas_Cervejaria1_idx` (`Cervejaria_cnpj` ASC),
  CONSTRAINT `fk_Fabricas_Cervejaria1`
    FOREIGN KEY (`Cervejaria_cnpj`)
    REFERENCES `dbBrejasOnRoad`.`Cervejaria` (`cnpj`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`MestreCervejeiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`MestreCervejeiro` (
  `cpf` VARCHAR(14) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `Cervejaria_cnpj` VARCHAR(18) NULL,
  PRIMARY KEY (`cpf`),
  INDEX `fk_MestreCervejeiro_Cervejaria1_idx` (`Cervejaria_cnpj` ASC),
  CONSTRAINT `fk_MestreCervejeiro_Cervejaria1`
    FOREIGN KEY (`Cervejaria_cnpj`)
    REFERENCES `dbBrejasOnRoad`.`Cervejaria` (`cnpj`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`Tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`Tipo` (
  `idTipo` INT NOT NULL AUTO_INCREMENT,
  `nometipo` VARCHAR(45) NOT NULL,
  `paisorigem` VARCHAR(45) NOT NULL,
  `copo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`Cerveja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`Cerveja` (
  `idCerveja` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `coloracao` INT NOT NULL,
  `ibu` INT NOT NULL,
  `lupulo` INT NOT NULL,
  `malte` INT NOT NULL,
  `levedura` INT NOT NULL,
  `extras` VARCHAR(200) NULL,
  `instrucoes` VARCHAR(1000) NOT NULL,
  `MestreCervejeiro_cpf` VARCHAR(14) NOT NULL,
  `Tipo_idTipo` INT NOT NULL,
  PRIMARY KEY (`idCerveja`, `MestreCervejeiro_cpf`, `Tipo_idTipo`),
  INDEX `fk_Cerveja_MestreCervejeiro1_idx` (`MestreCervejeiro_cpf` ASC),
  INDEX `fk_Cerveja_Tipo1_idx` (`Tipo_idTipo` ASC),
  CONSTRAINT `fk_Cerveja_MestreCervejeiro1`
    FOREIGN KEY (`MestreCervejeiro_cpf`)
    REFERENCES `dbBrejasOnRoad`.`MestreCervejeiro` (`cpf`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cerveja_Tipo1`
    FOREIGN KEY (`Tipo_idTipo`)
    REFERENCES `dbBrejasOnRoad`.`Tipo` (`idTipo`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`Producao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`Producao` (
  `idProducao` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `quantidade` INT NOT NULL,
  `Cervejaria_cnpj` VARCHAR(18) NOT NULL,
  `Fabricas_idFabricas` INT NOT NULL,
  `Cerveja_idCerveja` INT NOT NULL,
  PRIMARY KEY (`idProducao`, `Cervejaria_cnpj`, `Fabricas_idFabricas`, `Cerveja_idCerveja`),
  INDEX `fk_Producao_Cervejaria_idx` (`Cervejaria_cnpj` ASC),
  INDEX `fk_Producao_Fabricas1_idx` (`Fabricas_idFabricas` ASC),
  INDEX `fk_Producao_Cerveja1_idx` (`Cerveja_idCerveja` ASC),
  CONSTRAINT `fk_Producao_Cervejaria`
    FOREIGN KEY (`Cervejaria_cnpj`)
    REFERENCES `dbBrejasOnRoad`.`Cervejaria` (`cnpj`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producao_Fabricas1`
    FOREIGN KEY (`Fabricas_idFabricas`)
    REFERENCES `dbBrejasOnRoad`.`Fabricas` (`idFabricas`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producao_Cerveja1`
    FOREIGN KEY (`Cerveja_idCerveja`)
    REFERENCES `dbBrejasOnRoad`.`Cerveja` (`idCerveja`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`Eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`Eventos` (
  `idEventos` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `data` DATE NOT NULL,
  `publico` INT NOT NULL,
  `dinheiro` DECIMAL(18,2) NOT NULL,
  `ingresso` DECIMAL(18,2) NOT NULL,
  `custo` DECIMAL(18,2) NOT NULL,
  PRIMARY KEY (`idEventos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`VendasEvento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`VendasEvento` (
  `Eventos_idEventos` INT NOT NULL,
  `Cerveja_idCerveja` INT NOT NULL,
  `valorml` DECIMAL(18,2) NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`Eventos_idEventos`, `Cerveja_idCerveja`),
  INDEX `fk_Eventos_has_Cerveja_Cerveja1_idx` (`Cerveja_idCerveja` ASC),
  INDEX `fk_Eventos_has_Cerveja_Eventos1_idx` (`Eventos_idEventos` ASC),
  CONSTRAINT `fk_Eventos_has_Cerveja_Eventos1`
    FOREIGN KEY (`Eventos_idEventos`)
    REFERENCES `dbBrejasOnRoad`.`Eventos` (`idEventos`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Eventos_has_Cerveja_Cerveja1`
    FOREIGN KEY (`Cerveja_idCerveja`)
    REFERENCES `dbBrejasOnRoad`.`Cerveja` (`idCerveja`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbBrejasOnRoad`.`CervejariasEventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbBrejasOnRoad`.`CervejariasEventos` (
  `Eventos_idEventos` INT NOT NULL,
  `Cervejaria_cnpj` VARCHAR(18) NOT NULL,
  PRIMARY KEY (`Eventos_idEventos`, `Cervejaria_cnpj`),
  INDEX `fk_Eventos_has_Cervejaria_Cervejaria1_idx` (`Cervejaria_cnpj` ASC),
  INDEX `fk_Eventos_has_Cervejaria_Eventos1_idx` (`Eventos_idEventos` ASC),
  CONSTRAINT `fk_Eventos_has_Cervejaria_Eventos1`
    FOREIGN KEY (`Eventos_idEventos`)
    REFERENCES `dbBrejasOnRoad`.`Eventos` (`idEventos`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Eventos_has_Cervejaria_Cervejaria1`
    FOREIGN KEY (`Cervejaria_cnpj`)
    REFERENCES `dbBrejasOnRoad`.`Cervejaria` (`cnpj`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
