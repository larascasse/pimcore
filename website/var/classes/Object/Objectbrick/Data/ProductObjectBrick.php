<?php 

class Object_Objectbrick_Data_ProductObjectBrick extends Object_Objectbrick_Data_Abstract  {

public $type = "ProductObjectBrick";
public $test;


/**
* @return string
*/
public function getTest () {
	$data = $this->test;
	if(!$data && Object_Abstract::doGetInheritedValues($this->getObject())) {
		return $this->getValueFromParent("test");
	}
	 return $data;
}

/**
* @param string $test
* @return void
*/
public function setTest ($test) {
	$this->test = $test;
	return $this;
}

}

