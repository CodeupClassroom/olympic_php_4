<?php

class Car {
	protected $make;
	protected $model;
	protected $speed = 0;

	private $isMagicSchoolBus = true;

	public function __construct($make, $model) {
		$this->make = $make;
		$this->model = $model;
	}

	public function getMake() {
		return $this->make;
	}

	public function getModel() {
		return $this->model;
	}

	public function accelerate() {
		$this->speed += 1;
	}

	public function stop() {
		$this->speed = 0;
	}

	public function getSpeed() {
		return $this->speed;
	}

}


class RaceCar extends Car {
	// child classes inherit protected methods
	// child classes inherit protected properties

	// child classes DO NOT inherit private methods/properties
}