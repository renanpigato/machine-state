<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1543770102.
 * Generated on 2018-12-02 15:01:42 by renan
 */
class PropelMigration_1543770102
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `maquina`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(256) NOT NULL,
    `quantidade_estados` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

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
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `maquina`;

DROP TABLE IF EXISTS `saida`;

DROP TABLE IF EXISTS `estado`;

DROP TABLE IF EXISTS `entrada`;

DROP TABLE IF EXISTS `transicao`;

DROP TABLE IF EXISTS `entrada_transicao`;

DROP TABLE IF EXISTS `saida_acionamento`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}