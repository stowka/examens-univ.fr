<?php
	/**
	 * @author François-Xavier Béligat
	 */

    require_once "lib/spdo.class.php";
	displayAuthor();

    //Ajout d'une nouvelle promo
    if(isset($_POST['nomPromo']) &&
        isset($_POST['effectifPromo'])) {

       $nouvelle_promo = Promo::initWithData($_POST['nomPromo'],
           $_POST['effectifPromo']);
       $nouvelle_promo->store();
    }

    //Suppression d'une promo
    if(isset($_POST['deleteIdPromo'])) {
        $delete_promo = Promo::initWithId($_POST['deleteIdPromo']);
        $delete_promo->delete();
    }

    $promos = Promo::getAll();

    require_once("views/promos.view.php");
