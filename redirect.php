<?php

session_start();
header('HTTP/1.1 200 OK');
$_SESSION['redirect'] = true;
include 'includes/config.php';

?>