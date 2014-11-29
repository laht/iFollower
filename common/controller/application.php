<?php

namespace common\controller;

require_once('ability/model/ability.php');
require_once('traits/model/traits.php');

class application {

	private $database;
	private $ability;
	private $traits;

	public function __construct(\common\model\medoo $database) {
		$this->database = $database;
		$this->ability = new \ability\model\ability($database);
		$this->traits = new \traits\model\traits($this->database);
	}

	public function whatToDo() {
		if (isset($_POST['submitBtn'])) {
			$this->addFollowerToDb($_POST);
		}		
	}

	private function addFollowerToDb($data) {
		$followerId = $this->database->insert('follower', ['name' => $data['name'], 'level' => $data['level']]);

		$abilityIdOne = $this->ability->getAbilityByName($data['abilities1']);
		$abilityIdTwo = $this->ability->getAbilityByName($data['abilities2']);
		
		$traitOne = $this->traits->getTraitByName($data['traits1']);
		$traitIdTwo = $this->traits->getTraitByName($data['traits2']);
		$traitIdThree = $this->traits->getTraitByName($data['traits3']);
		
		$this->database->insert('ability_card', ['follower_pk' => $followerId, 'ability_pk' => $abilityIdOne]);
		$this->database->insert('ability_card', ['follower_pk' => $followerId, 'ability_pk' => $abilityIdTwo]);

		
		$this->database->insert('trait_card', ['follower_fk' => $followerId, 'trait_fk' => $traitOne]);
		$this->database->insert('trait_card', ['follower_fk' => $followerId, 'trait_fk' => $traitIdTwo]);
		$this->database->insert('trait_card', ['follower_fk' => $followerId, 'trait_fk' => $traitIdThree]);
	}
}