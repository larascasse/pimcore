<?php 

/** 
* Generated at: 2017-02-02T14:43:00+01:00
* IP: 172.31.30.232


Fields Summary: 
 - image1 [image]
 - image2 [image]
 - image3 [image]
 - image4 [image]
*/ 

namespace Pimcore\Model\Object\Fieldcollection\Data;

use Pimcore\Model\Object;

class BlocImage extends Object\Fieldcollection\Data\AbstractData  {

public $type = "blocImage";
public $image1;
public $image2;
public $image3;
public $image4;


/**
* Get image1 - image 1
* @return \Pimcore\Model\Asset\Image
*/
public function getImage1 () {
	$data = $this->image1;
	 return $data;
}

/**
* Set image1 - image 1
* @param \Pimcore\Model\Asset\Image $image1
* @return \Pimcore\Model\Object\BlocImage
*/
public function setImage1 ($image1) {
	$this->image1 = $image1;
	return $this;
}

/**
* Get image2 - image 2
* @return \Pimcore\Model\Asset\Image
*/
public function getImage2 () {
	$data = $this->image2;
	 return $data;
}

/**
* Set image2 - image 2
* @param \Pimcore\Model\Asset\Image $image2
* @return \Pimcore\Model\Object\BlocImage
*/
public function setImage2 ($image2) {
	$this->image2 = $image2;
	return $this;
}

/**
* Get image3 - image 3
* @return \Pimcore\Model\Asset\Image
*/
public function getImage3 () {
	$data = $this->image3;
	 return $data;
}

/**
* Set image3 - image 3
* @param \Pimcore\Model\Asset\Image $image3
* @return \Pimcore\Model\Object\BlocImage
*/
public function setImage3 ($image3) {
	$this->image3 = $image3;
	return $this;
}

/**
* Get image4 - image 4
* @return \Pimcore\Model\Asset\Image
*/
public function getImage4 () {
	$data = $this->image4;
	 return $data;
}

/**
* Set image4 - image 4
* @param \Pimcore\Model\Asset\Image $image4
* @return \Pimcore\Model\Object\BlocImage
*/
public function setImage4 ($image4) {
	$this->image4 = $image4;
	return $this;
}

}

