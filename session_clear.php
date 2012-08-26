<?php
	$title = 'Session clear';
	include 'includes/config.php';
	unset($_SESSION['pseudo']);
	include 'includes/header.php';
?>


<section id="timer_wrapper" class="container_24">
	<section class="grid_24">
		Session cleared
	</section>
</section>

<?php
	include 'includes/footer.php';
?>