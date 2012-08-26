<?php
	include 'config.php';
	
	if( isset($_POST['pseudo']) && isset($_POST['time']) ) {
		
		$pseudo = ( $_POST['pseudo'] ? trim(htmlspecialchars( $_POST['pseudo'], ENT_QUOTES )) 	: '' );
		$time 	= ( $_POST['time'] 	? intval( $_POST['time'] ) 									: 0 );
				
		if ($pseudo && $time) {
			if ($main->save($pseudo, $time)) {
				echo 'Sauvegarde effectuée';
			}
		}
	} else {
		echo 'Echec de la sauvegarde';
	}
?>