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

var updateRank = function() {
	Ajax.load({
		container: $rank,
		url: 'ajax/rank.php',
	});

	console.log('Rank updated');
};

var saveScore = function() {
	Ajax.post({
		url: 'ajax/save_score.php',
		data: {
			'pseudo': 	encodeURIComponent($pseudoInput.value),
			'time': 	Timer.totalTime
		},
		success: function(xhr) {
			setTimeout(saveScore, ((Math.random() * (90 - 30)) + 30) * 1000);
		}
	});
};

// Initialize and start the timer
Timer.init($timer).start();

// First rank update
updateRank();

setInterval(updateRank, 60000);

// Add event listeners
$timerSave.addEventListener('click', function(evt) {
	evt.preventDefault();
	$timerSave.style.display = 'none';
	$saveForm.style.display = 'block';
});

$pseudoSend.addEventListener('click', function(evt) {
	evt.preventDefault();
	Ajax.post({
		url: 'ajax/save_score.php',
		data: {
			'pseudo': 	encodeURIComponent($pseudoInput.value),
			'time': 	Timer.totalTime
		},
		success: function(xhr) {
			// Set automatic save
			console.log(xhr.responseText);
			setTimeout(saveScore, ((Math.random() * (90 - 30)) + 30) * 1000);
		}
	});
});

</script>

<?php
	include 'includes/footer.php';
?>