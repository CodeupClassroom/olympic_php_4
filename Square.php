<?php 

require_once "Rectangle.php";

class Square extends Rectangle {

	public function __construct($height) {
		parent::__construct($height, $height);
	}

	public function perimeter() {
		return $this->height * 4;
	}

	public function area() {
		return $this->height * $this->height;
	}
}