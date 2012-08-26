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
		de votre vie !
	</section>
</section>

<section id="rank_wrapper" class="container_24">
	<section class="grid_24">Chargement du top 30</section>
</section>

<script type="text/javascript" src="js/timer.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">

$timer 			= document.querySelector('.timer'),
$timerSave 		= document.querySelector('.timer-save'),
$saveForm 		= document.querySelector('.save-form'),
$pseudoInput 	= document.querySelector('input#pseudo'),
$pseudoSend 	= document.querySelector('.pseudo-send'),
$rank 			= document.querySelector('#rank_wrapper'),
$autosave 		= document.querySelector('.autosave'),
$autosavePseudo	= document.querySelector('.autosave-pseudo');

var updateRank = function() {
	Ajax.load({
		container: $rank,
		url: 'ajax/rank.php',
	});
};

var saveScore = function() {
	Ajax.post({
		url: 'ajax/save_score.php',
		success: function(xhr) {
			console.log('Saved : ', xhr.responseText);
		}
	});
	setTimeout(saveScore, 5000/*((Math.random() * (90 - 30)) + 30) * 1000*/);
};

var startScore = function() {
	console.log('start save');
	Ajax.post({
		url: 'ajax/save_score.php',
		data: {'start': true},
		success: function(xhr) {
			console.log('Start Saved : ', xhr.responseText);
			setTimeout(saveScore, 5000/*((Math.random() * (90 - 30)) + 30) * 1000*/);
		},
		error: function(xhr) {
			console.log('Start save error : ', xhr);
		}
	});
};

// First rank update and score save
updateRank();
setInterval(updateRank, 5000/*60000*/);
startScore();

// Initialize and start the timer
Timer.init($timer).start();


// Add event listeners
$timerSave.addEventListener('click', function(evt) {
	evt.preventDefault();
	$timerSave.style.display 	= 'none';
	$autosave.style.display 	= 'none';
	$saveForm.style.display 	= 'block';
});

$pseudoSend.addEventListener('click', function(evt) {
	evt.preventDefault();
	Ajax.post({
		url: 'ajax/save_score.php',
		data: {
			'pseudo': 	encodeURIComponent($pseudoInput.value),
		},
		success: function(xhr) {
			// Set automatic save
			setTimeout(saveScore, ((Math.random() * (90 - 30)) + 30) * 1000);

			$saveForm.style.display 	= 'none';
			$autosavePseudo.innerHTML 	= $pseudoInput.value;
			$autosave.style.display	 	= 'block';
		}
	});
});

</script>

<?php
	include 'includes/footer.php';
?>