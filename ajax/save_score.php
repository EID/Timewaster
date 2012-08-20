<?php
	include 'config.php';
	
	if( isset($_GET['pseudo']) && isset($_GET['time']) ) {
		echo $_GET['pseudo'];
		echo $_GET['time'];
		
		$pseudo = ( $_GET['pseudo'] != '' 	? trim(htmlspecialchars( $_GET['pseudo'], ENT_QUOTES )) 	: '' );
		$time 	= ( $_GET['time'] 	!= 0 	? intval( $_GET['time'] ) 									: 0 );
				
		print_r($main);
		if( $pseudo != '' && $time != 0 ) {
			$main->save($pseudo, $time);
		}
	} else { echo 'Epic fail'; }
?>