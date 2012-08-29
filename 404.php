<?php
	$title = 'Accueil';
	include 'includes/config.php';
	include 'includes/header.php';
?>


<section id="timer_wrapper" class="container_24">
	<section class="grid_24">
		Felicitations, vous venez de gaspiller officiellement
	</section>
	<section class="grid_24 timer">
		00 heures 00 minutes 00 seconde
	</section>
	<section class="grid_24">
		de votre vie a chercher une page qui n'existe pas !
	</section>
</section>

<script type="text/javascript" src="js/timer.js"></script>
<script type="text/javascript">

$timer 	= document.querySelector('.timer'),

// Initialize and start the timer
Timer.init($timer).start();

</script>

<?php
	include 'includes/footer.php';
?>