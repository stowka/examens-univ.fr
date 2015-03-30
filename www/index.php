<?php
	/**
	 * Default back controller
	 * @author Antoine De Gieter
	 * @author François-Xavier Béligat
	 */

	require_once 'config/config.inc.php';
	require_once 'lib/functions.inc.php';

	# Sessions
	session_save_path();
	session_start();

	# Database
	//require_once 'lib/spdo.class.php';
	//$dbh = SPDO::getInstance();

	/* Uncomment to activate mail library *
	# PHPMailer
	require_once 'lib/phpmailer.class.php';/**/

	# Models
	function __autoload($model) {
		if (file_exists(DEFAULT_MODEL_PATH . strtolower($model) . DEFAULT_MODEL_EXTENSION))
			require_once strtolower("models/".$model.".class.php");
		else
			throw new Exception("Unable to load $model.");
	}

	# Set page
	if (isset($_GET['page'])):
		require_once("controllers/" . $_GET['page'] . ".cont.php");
	else:
		require_once("controllers/home.cont.php");
	endif;
