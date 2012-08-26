<?php
	include 'config.php';
?>

<section class="grid_24">
	<?php $main->nbOtherUsers(); ?> autres personnes n'ont pas de vie
</section>
<section class="grid_8">
	<ul>
	<?php 
		$i = 0;
		$rankData = $main->getRanking(0, 10);
		for ($j = 0; $j < count($rankData); $j++) { 
			++$i;

			$hours 		= floor( $rankData[$j]['score'] / 3600 );
			$minutes 	= floor( $rankData[$j]['score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $rankData[$j]['score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li>
			<span class="number"><? echo $i?>. </span>
			<span class="pseudo"><? echo $rankData[$j]['pseudo'] ?></span>
			<i><? echo $hours . 'h' .$minutes . 'mn' . $seconds . 's'?></i>
		</li>
	<?php
		}
	?>
	</ul>
</section>
<section class="grid_8">
	<ul>
	<?php 
		$i = 10;
		$rankData = $main->getRanking(10, 10);
		for ($j = 0; $j < count($rankData); $j++) { 
			++$i;

			$hours 		= floor( $rankData[$j]['score'] / 3600 );
			$minutes 	= floor( $rankData[$j]['score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $rankData[$j]['score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li>
			<span class="number"><? echo $i?>. </span>
			<span class="pseudo"><? echo $rankData[$j]['pseudo'] ?></span>
			<i><? echo $hours . 'h' .$minutes . 'mn' . $seconds . 's'?></i>
		</li>
	<?php
		}
	?>
	</ul>
</section>
<section class="grid_8">
	<ul>
	<?php 
		$i = 20;
		$rankData = $main->getRanking(20, 10);
		for ($j = 0; $j < count($rankData); $j++) { 
			++$i;

			$hours 		= floor( $rankData[$j]['score'] / 3600 );
			$minutes 	= floor( $rankData[$j]['score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $rankData[$j]['score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li>
			<span class="number"><? echo $i?>. </span>
			<span class="pseudo"><? echo $rankData[$j]['pseudo'] ?></span>
			<i><? echo $hours . 'h' .$minutes . 'mn' . $seconds . 's'?></i>
		</li>
	<?php
		}
	?>
	</ul>
</section>
<section class="grid_4 push_20 display_all_wrapper">
	<a href="ranking" target="_blank">Afficher tout</a>
</section>