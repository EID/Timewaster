<?php
	include 'config.php';

	if(isset($_POST['pseudo']) ) {
		print_r($_POST['pseudo']);
	} else {
		print_r($_SESSION['pseudo']);
	}

	if(isset($_POST['start']) ) {
		if ($main->saveStart()) {
			echo 'Save start success';
		} else {
			header('500 Internal Server Error', true, 500);
			echo 'Save start fail';
		}
	} else {
		if (isset($_POST['pseudo'])) {
			$pseudo = $main->sanitize($_POST['pseudo'], 'urldecode', 'nohtml');
			$save 	= $main->save($pseudo);	
		} else {
			$save = $main->save();
		}
				
		if ($save) {
			echo 'Sauvegarde effectuée : '. $_SESSION['pseudo'];
		} else {
			// Throw HTTP 500 for ajax
			header('500 Internal Server Error', true, 500);
			echo 'Erreur lors de la sauvegarde';
			return false;
		}
	}
?>