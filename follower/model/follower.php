<?php

namespace follower\model;

require_once('follower/model/followerModel.php');

class follower {

	private $database;

	public function __construct(\common\model\medoo $database) {
		$this->database = $database;
	}

	private function fetchFollowersFromDb() {
		return $this->database->query( 'SELECT DISTINCT follower.name, follower.level, ability.ability_name, trait.trait_name
										FROM follower
										INNER JOIN ability_card ON follower.pk = ability_card.follower_pk
										INNER JOIN ability ON ability_card.ability_pk = ability.pk
										INNER JOIN trait_card ON trait_card.follower_fk = follower.pk
										INNER JOIN trait ON trait_card.trait_fk = trait.pk
										ORDER BY follower.name')->fetchAll();
	}

	public function sortFollowersAndSpells() {
		$rawDb = $this->fetchFollowersFromDb();
		$tmpFollower = [];
		$names = [];

		foreach ($rawDb as $follower) {
			if (!in_array($follower['name'], $names)) {
				$names[] = $follower['name'];
				$tmpFollower[] = new \follower\model\followerModel($follower['name']);
			}
		}

		foreach ($tmpFollower as $name) {			
			foreach ($rawDb as $follower) {
				if ($follower['name'] == $name->getName()) {
					$name->addAbility($follower['ability_name']);
					$name->addTrait($follower['trait_name']);
					$name->setLevel(intval($follower['level']));
				}
			}
		}
		
		return $tmpFollower;
	}

}