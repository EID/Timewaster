<?php

if( $redirect ) {
	$url = false;
	
	// Tester chaque regex

	foreach($config['option']['urlrewrite'] as $key => $value) {
		if(preg_match('#'.$key.'#',$_SERVER['REQUEST_URI'],$matches)) {
			$url 	= preg_replace('#'.$key.'#', $value, $_SERVER['REQUEST_URI']);
			$page 	= preg_replace('#.+/(.+)\?.+#', '${1}', $url);
			preg_match('#.+/.+\?(.+)=(.+)#',$url,$matches);
			while(++$i <= count($matches)) {
				$_GET[$matches[$i]] = $matches[++$i];
			}
			break;
		}
	}

	// Redirection

	if(!$url) {
		header('Location: 404.php');
	} else {
		$redirect = false;
		echo $page;
		include $page;
	}
}

?>