<?php
	include 'config.php';
	$query1 		= $main->dbh->prepare('SELECT * FROM tw_users ORDER BY usr_score DESC LIMIT 0, 10');
	$query2 		= $main->dbh->prepare('SELECT * FROM tw_users ORDER BY usr_score DESC LIMIT 10, 10');
	$query3 		= $main->dbh->prepare('SELECT * FROM tw_users ORDER BY usr_score DESC LIMIT 20, 10');
	$countQuery 	= $main->dbh->prepare('SELECT COUNT(id) as nb FROM tw_users');
	$countQuery->execute();
	$query1->execute();
	$query2->execute();
	$query3->execute();
	
	$count 	= $countQuery->fetch(PDO::FETCH_ASSOC);
?>

<section class="grid_24">
	<?php echo $count['nb'] - 1; ?> autres personnes n'ont pas de vie
</section>
<section class="grid_8">
	<ul>
	<?php 
		$i = 0;
		while ($col1 = $query1->fetch(PDO::FETCH_ASSOC)) { 
			++$i;

			$hours 		= floor( $col1['usr_score'] / 3600 );
			$minutes 	= floor( $col1['usr_score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $col1['usr_score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li>
			<span class="number"><? echo $i?>. </span>
			<span class="pseudo"><? echo $col1['usr_pseudo']?></span>
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
		while ($col2 = $query2->fetch(PDO::FETCH_ASSOC)) { 
			++$i;
			$hours 		= floor( $col2['usr_score'] / 3600 );
			$minutes 	= floor( $col2['usr_score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $col2['usr_score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li>
			<span class="number"><? echo $i?>. </span>
			<span class="pseudo"><? echo $col2['usr_pseudo']?></span>
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
		while ($col3 = $query3->fetch(PDO::FETCH_ASSOC)) { 
			++$i;
			$hours 		= floor( $col3['usr_score'] / 3600 );
			$minutes 	= floor( $col3['usr_score'] / 60 ) - ( $hours * 60 );
			$seconds 	= $col3['usr_score'] - ( $hours * 3600 ) - ( $minutes * 60 );
			
			if ($hours < 10) $hours = '0'. $hours;
			if ($minutes < 10) $minutes = '0'. $minutes;
			if ($seconds < 10) $seconds = '0'. $seconds;
	?>
		<li>
			<span class="number"><? echo $i?>. </span>
			<span class="pseudo"><? echo $col3['usr_pseudo']?></span>
			<i><? echo $hours . 'h' .$minutes . 'mn' . $seconds . 's'?></i>
		</li>
	<?php
		}
	?>
	</ul>
</section>
<section class="grid_4 push_20">
	<a href="ranking" target="_blank">Afficher tout</a>
</section>