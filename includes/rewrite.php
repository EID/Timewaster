<?php

if( isset($_SESSION['redirect']) && $_SESSION['redirect'] ) {
	$url = false;
	
	// Tester chaque regex

	foreach($config['option']['urlrewrite'] as $key => $value) {
		if(preg_match('#'.$key.'#',$_SERVER['REQUEST_URI'],$matches)) {
			$url 	= preg_replace('#'.$key.'#', $value, $_SERVER['REQUEST_URI']);
			$page 	= preg_replace('#.+/(.+)\?.+#', '${1}', $url);
			preg_match('#.+/.+\?(.+)=(.+)#',$url,$matches);
			$i = 0;
			while(++$i <= count($matches)) {
				$_GET[$matches[$i]] = $matches[++$i];
			}
			break;
		}
	}

	// Redirection

	$_SESSION['redirect'] = false;
	if(!$url) {
		require '404.php';
	} else {
		include $page;
	}
}

?>