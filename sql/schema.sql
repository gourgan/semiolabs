
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- article
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `titre` VARCHAR(255),
    `texte` VARCHAR(255),
    `date` DATE,
    `media` VARCHAR(255),
    `lien` VARCHAR(255),
    `type_id` INTEGER,
    `auteur_id` INTEGER,
    `tags` VARCHAR(255),
    `nb_vue` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `article_FI_1` (`type_id`),
    INDEX `article_FI_2` (`auteur_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- auteur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `auteur`;

CREATE TABLE `auteur`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(255),
    `password` VARCHAR(255),
    `description` VARCHAR(255),
    `image` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
