
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- maquina
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `maquina`;

CREATE TABLE `maquina`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(256) NOT NULL,
    `quantidade_estados` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- saida
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `saida`;

CREATE TABLE `saida`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(256) NOT NULL,
    `id_maquina` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `saida_fi_3c3ffb` (`id_maquina`),
    CONSTRAINT `saida_fk_3c3ffb`
        FOREIGN KEY (`id_maquina`)
        REFERENCES `maquina` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- estado
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(256) NOT NULL,
    `valor` VARCHAR(256) NOT NULL,
    `id_maquina` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `estado_fi_3c3ffb` (`id_maquina`),
    CONSTRAINT `estado_fk_3c3ffb`
        FOREIGN KEY (`id_maquina`)
        REFERENCES `maquina` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- entrada
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `entrada`;

CREATE TABLE `entrada`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `id_maquina` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `entrada_fi_3c3ffb` (`id_maquina`),
    CONSTRAINT `entrada_fk_3c3ffb`
        FOREIGN KEY (`id_maquina`)
        REFERENCES `maquina` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- transicao
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `transicao`;

CREATE TABLE `transicao`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_maquina` INTEGER NOT NULL,
    `id_estado_origem` INTEGER NOT NULL,
    `id_estado_destino` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `transicao_fi_3c3ffb` (`id_maquina`),
    INDEX `transicao_fi_3ae1b3` (`id_estado_origem`),
    INDEX `transicao_fi_72a4f4` (`id_estado_destino`),
    CONSTRAINT `transicao_fk_3c3ffb`
        FOREIGN KEY (`id_maquina`)
        REFERENCES `maquina` (`id`),
    CONSTRAINT `transicao_fk_3ae1b3`
        FOREIGN KEY (`id_estado_origem`)
        REFERENCES `estado` (`id`),
    CONSTRAINT `transicao_fk_72a4f4`
        FOREIGN KEY (`id_estado_destino`)
        REFERENCES `estado` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- entrada_transicao
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `entrada_transicao`;

CREATE TABLE `entrada_transicao`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_entrada` INTEGER NOT NULL,
    `id_transicao` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `entrada_transicao_fi_408a2d` (`id_entrada`),
    INDEX `entrada_transicao_fi_f6f256` (`id_transicao`),
    CONSTRAINT `entrada_transicao_fk_408a2d`
        FOREIGN KEY (`id_entrada`)
        REFERENCES `entrada` (`id`),
    CONSTRAINT `entrada_transicao_fk_f6f256`
        FOREIGN KEY (`id_transicao`)
        REFERENCES `transicao` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- saida_acionamento
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `saida_acionamento`;

CREATE TABLE `saida_acionamento`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_estado` INTEGER,
    `id_transicao` INTEGER,
    `id_saida` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `saida_acionamento_fi_aec559` (`id_estado`),
    INDEX `saida_acionamento_fi_f6f256` (`id_transicao`),
    INDEX `saida_acionamento_fi_d22470` (`id_saida`),
    CONSTRAINT `saida_acionamento_fk_aec559`
        FOREIGN KEY (`id_estado`)
        REFERENCES `estado` (`id`),
    CONSTRAINT `saida_acionamento_fk_f6f256`
        FOREIGN KEY (`id_transicao`)
        REFERENCES `transicao` (`id`),
    CONSTRAINT `saida_acionamento_fk_d22470`
        FOREIGN KEY (`id_saida`)
        REFERENCES `saida` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
