<?php 

/** Generated at 2015-01-06T10:28:51+01:00 */

/**
* IP:          ::1
*/


namespace Pimcore\Model\Object\Objectbrick\Data;

use Pimcore\Model\Object;

class ProductObjectBrick extends Object\Objectbrick\Data\AbstractData  {

public $type = "ProductObjectBrick";
public $test;


/**
* Set test - Test Desciption
* @return string
*/
public function getTest () {
	$data = $this->test;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("test")->isEmpty($data)) {
		return $this->getValueFromParent("test");
	}
	 return $data;
}

/**
* Set test - Test Desciption
* @param string $test
* @return \Pimcore\Model\Object\ProductObjectBrick
*/
public function setTest ($test) {
	$this->test = $test;
	return $this;
}

}

