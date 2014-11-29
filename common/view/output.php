<?php

namespace common\view;
require_once('follower/model/follower.php');
require_once('ability/model/ability.php');
require_once('traits/model/traits.php');
require_once('common/model/medoo.php');

class output {

	private $follower;
	private $ability;
	private $traits;
	private $database;

	public function __construct(\common\model\medoo $database) {	
		$this->database = $this->database = $database;
		$this->follower = new \follower\model\follower($this->database);
		$this->ability = new \ability\model\ability($this->database);
		$this->traits = new \traits\model\traits($this->database);
	}

	//returns an array of followers 
	private function getFollowers() {
		$followers = $this->follower->sortFollowersAndSpells();
		return $followers;
	}

	private function followerHtml() {
		$followers = $this->getFollowers();
		$html = '';
		foreach ($followers as $follower) {
			$html .= '<ul>';
			$html .= '<h2>'.$follower->getName().'</h2>';
			$html .= '<p>Level '.$follower->getLevel().'</p>';

			$html .= '<ul id="abilityList">';
			$html .= '<h3>Abilities</h3>';
			foreach ($follower->getAbilities() as $ability) {								
				$html .= '<p>'.ucfirst($ability).'</p>';
			}
			$html .= '</ul>';
			$html .= '<ul id="traitList">';
			$html .= '<h3>Traits</h3>';
			foreach ($follower->getTraits() as $trait) {
				$html .= '<p>'.ucfirst($trait).'</p>';
			}
			$html .= '</ul>';
			$html .= '</ul>';
		}
		return $html;
	}

	private function abilitiesHtml($identifier) {
		$abilities = $this->ability->getAbilities();

		$html = '<label for="abilities">Ability '.$identifier.'</label> <select class="form-control" name="abilities'.$identifier.'">';
		foreach ($abilities as $ability) {
			$html .= '<option value="'.$ability.'" />'.$ability.'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	private function traitsHtml($identifier) {
		$traits = $this->traits->getTraits();


		$html = '<label for="traits">Trait '.$identifier.'</label> <select class="form-control" name="traits'.$identifier.'">';
		foreach ($traits as $trait) {
			$html .= '<option value="'.$trait.'" />'.$trait.'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	public function getPage() {
		$followerHtml = $this->followerHtml();
		$abilities =

		$html = '<html>
				<head>
					<title></title>					
					<link rel=stylesheet href="css/reset.css" type="text/css">
					<link rel=stylesheet href="css/bootstrap.css" type="text/css">
					<link rel=stylesheet href="css/style.css" type="text/css">
				</head>
				<body>
					<div id="main">
						<div class="well" id="followersList">
							'.$followerHtml.'
						</div>
						<div id="addFollowerForm" class="well bs-component">
							<form action="?add" method="post">
								<legend>Add follower</legend>
								<label for="name">Name</label>
								<input class="form-control" type="text" name="name" placeholder="Enter name"/>
								<label for="level">Level</label>
								<input class="form-control" type="text" name="level" placeholder="Enter level"/>
								'.$this->abilitiesHtml(1).'
								'.$this->abilitiesHtml(2).'
								'.$this->traitsHtml(1).'
								'.$this->traitsHtml(2).'
								'.$this->traitsHtml(3).'
								<input class="btn btn-primary" id="submitBtn" name="submitBtn" type="submit" value="Skicka" />
							</form>
						</div>
					</div>
				</body>
				</html>';
		
		
		return $html;
	}
}