<?php

namespace traits\model;

require_once('follower/model/followerModel.php');

class traits {

	private $database;

	public function __construct(\common\model\medoo $database) {
		$this->database = $database;
	}

	public function getTraitByName($traitName) {
		return intval($this->database->select('trait', 'pk', ['trait_name' => $traitName])[0]);
	}

	public function getTraits() {
		$traits = $this->database->select('trait', ['trait_name']);
		$onlyNames = [];
		foreach ($traits as $trait) {
			array_push($onlyNames, $trait['trait_name']);
		}
		return $onlyNames;		
	}
}