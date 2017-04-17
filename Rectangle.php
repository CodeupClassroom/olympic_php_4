<?php 

class Rectangle {
	private $height;
	private $width;

	public function __construct($height, $width) {
	    // Self encapsulation
        $this->setHeight($height);
        $this->setWidth($width);
	}

    protected function setHeight($height)
    {
        $this->height = $height; // 1 assignment
    }

    protected function setWidth($width)
    {
        $this->width = $width;
    }

    public function getHeight()
    {
        return $this->height; // 1 return
    }

    public function getWidth()
    {
        return $this->width;
    }

	public function area() {
		return $this->height * $this->width;
	}

	public function perimeter() {
		return 2 * $this->height + 2 * $this->width;
	}
}

