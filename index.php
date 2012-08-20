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
		00 heures 00 minutes 00 secondes
	</section>
	<section class="grid_24">
		de votre vie !
	</section>
</section>

<section id="rank_wrapper" class="container_24">
</section>

<script type="text/javascript" src="js/timer.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">

$timer 			= document.querySelector('.timer'),
$timerSave 		= document.querySelector('.timer-save'),
$saveForm 		= document.querySelector('.save-form'),
$pseudoInput 	= document.querySelector('input#pseudo'),
$pseudoSend 	= document.querySelector('.pseudo-send'),
$rank 			= document.querySelector('#rank_wrapper');

// Initialize and start the timer
Timer.init($timer).start();

// Add event listeners
$timerSave.addEventListener('click', function(evt) {
	evt.preventDefault();
	$timerSave.style.display = 'none';
	$saveForm.style.display = 'block';
});

$pseudoSend.addEventListener('click', function(evt) {
	evt.preventDefault();
	Ajax.get({
		url: 'ajax/save_score.php',
		data: 'pseudo=' +encodeURIComponent($pseudoInput.value)+ '&time=' +Timer.totalTime,
		success: function(xhr) {
			console.log(xhr.responseText);
		}
	});
});

Ajax.load({
	container: $rank,
	url: 'ajax/rank.php'
})
</script>

<?php
	include 'includes/footer.php';
?>