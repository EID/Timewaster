<?php

class Tools
{
	public $dbh;
	
	public function __construct($conf) {
		$this->dbh = $conf['dbh'];
	}

	public function sanitize($var) {
		for ($i = 0; $i < func_num_args(); $i++) { 
			switch (func_get_arg($i)) {
				case 'int':
				$var = (int) $var;
				break;

				case 'str':
				$var = trim($var);
				break;

				case 'sql':
				$var = mysql_real_escape_string($var);
				break;

				case 'nohtml':
				$var = strip_tags($var);
				break;

				case 'nospaces':
				$var = trim( preg_replace('/\s*/', '', $var) );
				break;

				case 'urldecode':
				$var = urldecode($var);
				break;

				case 'urlencode':
				$var = urlencode($var);
				break;

				case 'lowercase':
				$var = strtolower($var);
				break;

				case 'urlencode':
				$var = strtoupper($var);
				break;
			}
		}

		return $var;
	}
}

?>