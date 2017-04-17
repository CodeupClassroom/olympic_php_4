<?php 

require_once "Rectangle.php";

class Square extends Rectangle {
	public function __construct($height) {
		parent::__construct($height, $height); // You should ALWAYS call the parent constructor
		//$this->height = $height; // Don't do this, this will make a new public property $height
	}

	public function perimeter() {
		return $this->getHeight() * 4;
	}

	public function area() {
		return $this->getHeight() * $this->getHeight();
	}
}