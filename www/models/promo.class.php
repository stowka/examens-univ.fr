<?php
	/**
	 * Classe promo
	 * @author Fran&ccedil;ois-Xavier B&eacute;ligat
	 * @copyright Universit&eacute; de Franche-Comt&eacute;
	 */
    
	class Promo {
		private $id;
		private $nom;
		private $effectif;

		function __construct() {
			$this->id = 0;
			$this->nom = "";
			$this->effectif = 1;
		}

		public static function initWithId($id) {
			$instance = new self();
			$instance->setId($id);
            $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("SELECT nom, effectif 
									FROM promo 
									WHERE id = :id;");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
            $instance->setNom($row['nom']);
			$instance->setEffectif($row['effectif']);
            return $instance;
		}

		public static function initWithData($nom, $effectif) {
			$instance = new self();
			$instance->setNom($nom);
			$instance->setEffectif($effectif);
			return $instance;
		}

		function store() {
			if (!empty($this->nom) && $this->effectif >= 1) {
                $dbh = SPDO::getInstance();
				$stmt = $dbh->prepare("INSERT INTO promo (nom, effectif)
										VALUES (:nom, :effectif);");
				$stmt->bindParam(":nom", $this->nom, PDO::PARAM_STR);
				$stmt->bindParam(":effectif", $this->effectif, 
									PDO::PARAM_INT);
				$stmt->execute();
				$this->id = $dbh->lastInsertId();
                $stmt->closeCursor();
            }
		}

		public static function getAll() {
            $dbh = SPDO::getInstance();
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
            $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("DELETE FROM promo WHERE id = :id");
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
		}

		# /!\ NO CONFIRMATION
		public static function deleteAll() {
            $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("DELETE * FROM promo;");
			$stmt->execute();
			$stmt->closeCursor();
		}

		/*
		 * Getters
		 */

		public function getId() {
			return $this->id;
		}

		public function getNom() {
			return $this->nom;
		}

		public function getEffectif() {
			return $this->effectif;
		}

		/*
		 * Setters
		 */

		public function setId($id) {
			$this->id = $id;
		}

		public function setNom($nom) {
			$this->nom = $nom;
		}

		public function setEffectif($effectif) {
			$this->effectif = $effectif;
		}
	}
