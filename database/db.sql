-- examens-univ.fr database
--
-- @author
--		Francois-Xavier Beligat
-- @digest
--		This script will drop any database knows as `exam`.
--		Afterwards it will create a new database `exam` and add tables
--		according to the following structure.
--		Eventually, it will insert a few required basis rows.
--

DROP DATABASE IF EXISTS exam;
CREATE DATABASE `exam` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE exam;

--
-- Promos
--

CREATE TABLE `promo` (
	`id` SMALLINT(2) UNSIGNED AUTO_INCREMENT,
	`nom` VARCHAR(31) NOT NULL,
	`nb_etudiants` INT NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=`utf8`;

--
-- Matieres
--

CREATE TABLE `matiere` (
	`id` SMALLINT(2) UNSIGNED AUTO_INCREMENT,
	`nom` VARCHAR(31) NOT NULL,
	`duree` BIGINT NOT NULL, -- en secondes
	PRIMARY KEY (`id`),
	UNIQUE KEY (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=`utf8`;

--
-- Batiments
--

CREATE TABLE `batiment` (
	`id` SMALLINT(2) UNSIGNED AUTO_INCREMENT,
	`nom` VARCHAR(15) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=`utf8`;

--
-- Salles
--

CREATE TABLE `salle` (
	`id` SMALLINT(2) UNSIGNED AUTO_INCREMENT,
	`nom` VARCHAR(7) NOT NULL,
	`nb_places` INT NOT NULL,
	`batiment` SMALLINT(2) UNSIGNED,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`nom`),
	CONSTRAINT `fk_salle_batiment`
		FOREIGN KEY (`batiment`)
		REFERENCES batiment(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=`utf8`;

--
-- Disponibilites
--

CREATE TABLE `disponibilite` (
	`salle` SMALLINT(2) UNSIGNED,
	`debut` DATETIME NOT NULL COMMENT "Base d'une demi-heure par creneau",
	`disponible` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`salle`, `debut`),
	CONSTRAINT `fk_disponibilite_salle`
		FOREIGN KEY (`salle`)
		REFERENCES salle(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=`utf8`;


--
-- Contient
--
CREATE TABLE `contient` (
	`promo` SMALLINT(2) UNSIGNED,
	`matiere` SMALLINT(2) UNSIGNED,
	PRIMARY KEY (`promo`, `matiere`),
	CONSTRAINT `fk_contient_promo`
		FOREIGN KEY (`promo`)
		REFERENCES promo(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `fk_contient_matiere`
		FOREIGN KEY (`matiere`)
		REFERENCES matiere(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=`utf8`;