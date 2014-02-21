<?php 

class Object_Product_Testobjectbrick extends Object_Objectbrick {



protected $brickGetters = array('ProductObjectBrick');


public $ProductObjectBrick = null;

/**
* @return Object_Objectbrick_Data_ProductObjectBrick
*/
public function getProductObjectBrick() { 
	if(!$this->ProductObjectBrick && Object_Abstract::doGetInheritedValues($this->getObject())) { 
		$brick = $this->getObject()->getValueFromParent("testobjectbrick");
		if(!empty($brick)) {
			return $this->getObject()->getValueFromParent("testobjectbrick")->getProductObjectBrick(); 
		}
	}
   return $this->ProductObjectBrick; 
}

/**
* @param Object_Objectbrick_Data_ProductObjectBrick $ProductObjectBrick
* @return void
*/
public function setProductObjectBrick ($ProductObjectBrick) {
	$this->ProductObjectBrick = $ProductObjectBrick;
	return $this;;
}

}

