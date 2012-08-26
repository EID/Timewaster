<?php

session_start();

// App config

$config['app']['title']				= 'Timewaster';
$config['app']['version'] 			= 'V0.0.1';
$config['app']['authors']			= array( 'CMat', 'Adrienj');
$config['app']['desc']				= '';

// Lang config

$config['lang']['default']				= 'fr';

// Display config

$config['display']['title']['prefix'] 	= 'TW - ';
$config['display']['charset'] 			= 'utf-8';

// SQL Config
	
$config['sql']['host'] 	= 'localhost';
$config['sql']['user'] 	= 'root';
$config['sql']['pass'] 	= '';
$config['sql']['db'] 	= 'timewaster';

// Redirection config

$config['option']['urlrewrite'] = Array(
	'\/timewaster\/timewaster\/home(.html)?$' 	=> 'index.php',
);

// Don't worry about that, you don't have to modifiy anything
include '../includes/rewrite.php';


$config['dbh'] = new PDO('mysql:host=' .$config['sql']['host']. ';dbname=' .$config['sql']['db'], 
				$config['sql']['user'], 
				$config['sql']['pass']
			  );

// From here you can modifiy again !
			  
// Include here user created class

require_once '../class/main.class.php';

// Instance precedently loaded classes
$main 	= new Main($config);
$dbh = $main->dbh;

?>