<?php
	/**
	 * Classe promo
	 * @author Fran&ccedil;ois-Xavier B&eacute;ligat
	 * @copyright Universit&eacute; de Franche-Comt&eacute;
	 */
	class Promo {
		private $id;
		private $nom;
		private $nbEtudiants;
		private $matieres;

		$dbh = SPDO::getInstance();

		function __construct() {
			$this->id = 0;
			$this->nom = "";
			$this->nbEtudiants = 0;
			$this->matieres = array();
		}

		public static function initWithId($id) {
			$instance = new self();
			$instance->setId($id);
			
			# Promo
			$stmt = $dbh->prepare("SELECT nom, nbEtudiants 
									FROM promo 
									WHERE id = :id;");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();

			$instance->setNom($row['nom']);
			$instance->setNbEtudiants($row['nb_etudiants']);

			# Matieres
			$stmt = $dbh->prepare("SELECT matiere AS id
									FROM contient 
									WHERE promo = :promo");
			$stmt->bindParam(":promo", $id, PDO::PARAM_INT);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();

			$matieres = array();
			foreach ($rows as $row)
				$matieres[] = Matiere::initWithId($row['id']);

			$instance->setMatieres($matieres);
			return $instance;
		}

		public static function initWithData($nom, $nbEtudiants) {
			$instance = new self();
			$this->setNom($nom);
			$this->setNbEtudiants($nbEtudiants);
			return $instance;
		}

		function store() {
			if (!empty($this->nom) && 0 != $this->nbEtudiants) {
				$stmt = $dbh->prepare("INSERT INTO promo (nom, nb_etudiants)
										VALUES (:nom, :nb_etudiants);");
				$stmt->bindParam(":nom", $this->nom, PDO::PARAM_STR);
				$stmt->bindParam(":nb_etudiants", $this->nbEtudiants, 
									PDO::PARAM_INT);
				$stmt->execute();
				$this->id = $dbh->lastInsertId();
				$stmt->closeCursor();
			} else
				echo "Erreur: le nom ou le nombre d'etudiants n'est pas valide.";
		}

		public static function getAll() {
			$stmt = $dbh->prepare("SELECT id FROM promo;");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$promos = array();
			foreach ($rows as $row)
				$promos[] = Promo::initWithId($row['id']);
			return $promos;
		}

		function delete() {
			$stmt = $dbh->prepare("DELETE FROM promo WHERE id = :id");
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}

		# /!\ NO CONFIRMATION
		public static function deleteAll() {
			$stmt = $dbh->prepare("DELETE * FROM promo;");
			$stmt->execute();
			$stmt->closeCursor();
		}

		function addMatiere($matiere) {
			$this->matieres[] = $matiere;
			$stmt = $dbh->prepare("INSERT INTO contient (promo, matiere)
									VALUES (:promo, :matiere);");
			$stmt->bindParam(":promo", $this->id, PDO::PARAM_INT);
			$stmt->bindParam(":matiere", $matiere->getId(), PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}

		/*
		 * Getters
		 */

		function getId() {
			return $this->id;
		}

		function getNom() {
			return $this->nom;
		}

		function getNbEtudiants() {
			return $this->nbEtudiants;
		}

		function getMatieres() {
			return $this->matieres;
		}



		/*
		 * Setters
		 */

		function setId($id) {
			$this->nom = $id;
		}

		function setNom($nom) {
			$this->nom = $nom;
		}

		function setNbEtudiants($nbEtudiants) {
			$this->nbEtudiants = $nbEtudiants;
		}

		function setMatieres($matieres) {
			$this->matieres = $matieres;
		}
	}
