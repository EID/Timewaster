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
			echo 'Save start fail';
		}
	} else {
		if (isset($_POST['pseudo'])) {
			$pseudo = trim(htmlspecialchars( $_POST['pseudo'], ENT_QUOTES ));
			$save 	= $main->save($pseudo);	
		} else {
			$save = $main->save();
		}
				
		if ($save) {
			echo 'Sauvegarde effectuée';
		} else {
			echo 'Erreur lors de la sauvegarde';
			return false;
		}
	}
?>