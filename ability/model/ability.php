<?php

namespace ability\model;

require_once('follower/model/followerModel.php');

class ability {

	private $database;

	public function __construct(\common\model\medoo $database) {
		$this->database = $database;
	}

	public function getAbilityByName($abilityName) {
		return intval($this->database->select('ability', 'pk', ['ability_name' => $abilityName])[0]);
	}

	public function getAbilities() {
		$abilities = $this->database->select('ability', ['ability_name']);
		$onlyNames = [];
		foreach ($abilities as $ability) {
			array_push($onlyNames, $ability['ability_name']);
		}
		return $onlyNames;		
	}
}