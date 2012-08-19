<?php

class Main
{
	public $dbh;
	
	public function __construct($conf) {
		$this->dbh = $conf['dbh'];
	}

	// Put your methods here
}

?>