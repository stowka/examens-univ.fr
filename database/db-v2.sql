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

CREATE TABLE promo (
    id INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    effectif INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Examens
--

CREATE TABLE examen (
    id INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    promo INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_examen_promo
    FOREIGN KEY (promo)
    REFERENCES promo(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salles
--

CREATE TABLE salle (
    id INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    capacite INT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


