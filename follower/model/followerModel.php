<?php

namespace follower\model;

class followerModel {
	protected $name;
	protected $level;
	protected $traits = [];
	protected $abilities = [];

	public function __construct($name) {
		$this->name = $name;
	}

	public function addAbility($ability) {
		if (count($this->abilities) < 2 && !in_array($ability, $this->abilities)) {
			array_push($this->abilities, $ability);
		}
	}

	public function addTrait($trait) {
		if (count($this->traits) < 3 && !in_array($trait, $this->traits)) {
			array_push($this->traits, $trait);
		}
	}

	public function setLevel($level) {
		if (is_integer($level)) {
			$this->level = $level;
		}
	}

	public function getName() {
		return $this->name;
	}
	public function getLevel() {
		return $this->level;
	}
	public function getTraits() {
		return $this->traits;
	}
	public function getAbilities() {
		return $this->abilities;
	}
}