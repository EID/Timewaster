<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="<?php echo $config['lang']['default']; ?>" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="<?php echo $config['lang']['default']; ?>" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="<?php echo $config['lang']['default']; ?>" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="<?php echo $config['lang']['default']; ?>" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="<?php echo $config['lang']['default']; ?>" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="<?php echo $config['display']['charset']; ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php echo $config['display']['title']['prefix']. $title; ?></title>
		<meta name="description" content="<?php echo implode(', ', $config['app']['authors']); ?>">
		<meta name="author" content="<?php echo $config['app']['desc']; ?>">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="css/style.css?v=2">
		<link rel="stylesheet" href="css/960_24_col.css">
		<link rel="stylesheet" href="css/global.css">
	</head>
	<body>
		<section id="header_wrapper">
			<header class="container_24">
				<div class="logo">Time<span>waster</span></div>
				<nav>
					<ul>
						<li class="autosave">Sauvegarde automatique : <span class="autosave-pseudo"><?php echo $_SESSION['pseudo']; ?></span></li>
						<li><a class="timer-save" href="">Changer</a></li>
						<li class="save-form">
							<input type="text" id="pseudo" name="pseudo" maxlength="20"/><a href="" class="pseudo-send">Envoyer</a>
						</li>
					</ul>
				</nav>
			</header>
		</section>