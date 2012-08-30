<?php
	include 'config.php';
?>

<section class="grid_24">
	<?php 
		$nb = $main->nbOtherUsers() - 1;
		echo $nb .' autre' .$main->pluriel($nb). ' personne' .$main->pluriel($nb). ' n\'' .($main->pluriel($nb) ? 'ont' : 'a') .' pas de vie' ;
	?>
</section>

<?php 

for ($i=0; $i < 30; $i += 10) { 
	
?>
<section class="grid_8">
	<ul>
	<?php 
		$rankData = $main->getRanking($i, 10);
		for ($j = 0; $j < count($rankData); $j++) { 

			$hours 		= floor( $rankData[$j]['score'] / 3600 );
			$minutes 	= floor( $rankData[$j]['score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $rankData[$j]['score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li  <?php echo ($rankData[$j]['pseudo'] == $_SESSION['pseudo']) ? 'class="me"' : ''; ?>>
			<span class="number"><? echo $i + $j + 1 ?>. </span>
			<span class="pseudo"><? echo (strlen($rankData[$j]['pseudo']) > 15) ? substr($rankData[$j]['pseudo'], 0, 15). '...' : $rankData[$j]['pseudo'] ?></span>
			<i><? echo $hours . 'h' .$minutes . 'mn' . $seconds . 's'?></i>
		</li>
	<?php
		}
	?>
	</ul>
</section>

<?php 

}	

?>
<section class="clear"></section>
<section class="grid_4 push_20 display_all_wrapper">
	<a href="ranking" target="_blank">Afficher tout</a>
</section>