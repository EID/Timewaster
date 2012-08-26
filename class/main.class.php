<?php

class Main
{
	public $dbh;
	
	public function __construct($conf) {
		$this->dbh = $conf['dbh'];
	}

	public function saveStart() {	
		if (!$this->usrExists($_SESSION['pseudo'])) {
			$q = $this->dbh->prepare("INSERT INTO tw_users VALUES('', :pseudo, :start, 0, 0)");
			return $q->execute(array(
				pseudo 	=> $_SESSION['pseudo'],
				start 	=> time(),
			));
		} else {
			$q = $this->dbh->prepare('UPDATE tw_users SET usr_start=:start WHERE usr_pseudo=:pseudo');
			return $q->execute(array(
				pseudo 	=> $_SESSION['pseudo'],
				start 	=> time(),
			));
		}
	}

	public function save($pseudo = null) {
		if ($pseudo == null) {
			$pseudo = $_SESSION['pseudo'];
			print_r('Pseudo save session : ' .$pseudo);
		} else {
			// Update pseudo
			if (!$this->usrExists($pseudo)) {
				$pseudoUpdateQuery = $this->dbh->prepare('UPDATE tw_users SET usr_pseudo=:new_pseudo WHERE usr_pseudo=:pseudo');
				$pseudoUpdateQuery->execute(array(
					pseudo 		=> $_SESSION['pseudo'],
					new_pseudo 	=> $pseudo,
				));
				$_SESSION['pseudo'] = $pseudo;
			} else {
				echo 'User already exists';
				return false;
			}
			
			print_r('Pseudo save : ' .$pseudo);
		}
		
		if ($this->usrExists($pseudo)) {
			$usrData = $this->get($pseudo);
			
			if (time() > $usrData['usr_save']) {
				$q = $this->dbh->prepare('UPDATE tw_users SET usr_save=:save WHERE usr_pseudo=:pseudo');
				return $q->execute(array(
					pseudo 	=> $pseudo,
					save 	=> time(),
				));
			}
		} else {
			return false;
		}
	}
	
	public function usrExists($pseudo) {
		$query = $this->dbh->prepare('SELECT COUNT(id) as nb FROM tw_users WHERE usr_pseudo=:pseudo');
		$query->execute(array(
			pseudo => $pseudo,
		));
		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		
		return $data['nb'] != 0;
	}
	
	public function get($pseudo) {
		$query = $this->dbh->prepare('SELECT * FROM tw_users WHERE usr_pseudo=:pseudo');
		$query->execute(array(
			pseudo => $pseudo,
		));
		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		
		return $data;
	}

	public function generatePseudo() {
		if (isset($_SESSION['pseudo'])) {
			return false;
		}

		$pseudo = 'Player' .$this->zeroFill( mt_rand(0,10000) );

		if ($this->usrExists($pseudo)) {
			$this->generatePseudo();
		} else {
			$_SESSION['pseudo'] = $pseudo;
			return $pseudo;
		}
	}

	public function zeroFill ($num, $zerofill = 4) {
		return sprintf("%0".$zerofill."s", $num);
	}

	public function getRanking($start = 0, $length = 50) {
		$rank = array();

		$q = $this->dbh->prepare('SELECT * FROM tw_users');
		$q->execute();

		$rankingData = $q->fetchAll(PDO::FETCH_ASSOC);

		for ($i=0; $i < count($rankingData); $i++) { 
			if ($rankingData[$i]['usr_save'] != 0) {
				$rank[] = array(
					'id' => $rankingData[$i]['id'],
					'pseudo' => $rankingData[$i]['usr_pseudo'],
					'score' => $rankingData[$i]['usr_save'] - $rankingData[$i]['usr_start'],
					'fb_id' => $rankingData[$i]['usr_facebook_id'],
				);
			} else {
				$rank[] = array(
					'id' => $rankingData[$i]['id'],
					'pseudo' => $rankingData[$i]['usr_pseudo'],
					'score' => $rankingData[$i]['usr_save'],
					'fb_id' => $rankingData[$i]['usr_facebook_id'],
				);
			}
		}

		

		usort($rank, function($a, $b) {
			return $a['score'] < $b['score'];
		});

		return array_slice($rank, $start, $length);
	}

	public function nbOtherUsers() {
		$countQuery = $this->dbh->prepare("SELECT COUNT(id) as nb FROM tw_users");
		$count 		= $countQuery->fetchAll(PDO::FETCH_ASSOC);

		return $count['nb'];
	}
}

?>