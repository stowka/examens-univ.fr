<?php
	/**
	 * Classe matiere
	 * @author Fran&ccedil;ois-Xavier B&eacute;ligat
	 * @copyright Universit&eacute; de Franche-Comt&eacute;
	 */
	class Matiere {
		private $id;
		private $nom;
		private $duree;

		$dbh = SPDO::getInstance();

		function __construct() {
			$this->id = 0;
			$this->nom = "";
			$this->duree = 0;
		}

		public static function initWithId($id) {
			$instance = new self();
			$instance->setId($id);
			$stmt = $dbh->prepare("SELECT nom, duree 
									FROM matiere 
									WHERE id = :id;");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$instance->setNom($row['nom']);
			$instance->setduree($row['duree']);
			return $instance;
		}

		public static function initWithData($nom, $duree) {
			$instance = new self();
			$this->setNom($nom);
			$this->setDuree($duree);
			return $instance;
		}

		function store() {
			if (!empty($this->nom) && 0 != $this->duree) {
				$stmt = $dbh->prepare("INSERT INTO matiere (nom, duree)
										VALUES (:nom, :duree);");
				$stmt->bindParam(":nom", $this->nom, PDO::PARAM_STR);
				$stmt->bindParam(":duree", $this->duree, 
									PDO::PARAM_INT);
				$stmt->execute();
				$this->id = $dbh->lastInsertId();
				$stmt->closeCursor();
			} else
				echo "Erreur: le nom ou le nombre d'etudiants n'est pas valide.";
		}

		function delete() {
			$stmt = $dbh->prepare("DELETE FROM matiere WHERE id = :id");
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}

		public static function getAll() {
			$stmt = $dbh->prepare("SELECT id FROM matiere;");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$matieres = array();
			foreach ($rows as $row)
				$matieres[] = Promo::initWithId($row['id']);
			return $matieres;
		}

		# /!\
		public static function deleteAll() {
			$stmt = $dbh->prepare("DELETE * FROM matiere;");
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

		function getDuree() {
			return $this->duree;
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

		function setDuree($duree) {
			$this->duree = $duree;
		}
	}
