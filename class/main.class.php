<?php

class Main
{
	public $dbh;
	
	public function __construct($conf) {
		$this->dbh = $conf['dbh'];
	}

	public function save($pseudo, $score) {
		$pseudo = htmlspecialchars($pseudo, ENT_QUOTES );
		$score 	= intval($score);
		
		if( $this->usrExists($pseudo) ) {
			$usrData = $this->get($pseudo);
			
			if ($score > $usrData['usr_score']) {
				$q = $this->dbh->prepare('UPDATE tw_user SET usr_score=:score WHERE usr_pseudo=:pseudo');
			}
		} else {
			$q = $this->dbh->prepare("INSERT INTO tw_user VALUES('', :pseudo, :score, 0)");
		}
		
		if (isset($q)) {
			$q->execute(array(
				pseudo 	=> $pseudo,
				score 	=> $score,
			));
		}
	}
	
	public function usrExists($pseudo) {
		$query = $this->dbh->prepare('SELECT COUNT(id) as nb FROM tw_user WHERE usr_pseudo=:pseudo');
		$query->execute(array(
			pseudo => $pseudo,
		));
		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		
		return $data['nb'] != 0;
	}
	
	public function get($pseudo) {
		$query = $this->dbh->prepare('SELECT * FROM tw_user WHERE usr_pseudo=:pseudo');
		$query->execute(array(
			pseudo => $pseudo,
		));
		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		
		return $data;
	}
}

?>