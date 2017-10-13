<?php 

/** 
* Generated at: 2017-10-12T17:04:05+02:00
* IP: 172.31.30.232


Fields Summary: 
 - finition [textarea]
*/ 

namespace Pimcore\Model\Object\Objectbrick\Data;

use Pimcore\Model\Object;

class TechDopParquetFinition extends Object\Objectbrick\Data\AbstractData  {

public $type = "techDopParquetFinition";
public $finition;


/**
* Set finition - finition
* @return string
*/
public function getFinition () {
	$data = $this->finition;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("finition")->isEmpty($data)) {
		return $this->getValueFromParent("finition");
	}
	 return $data;
}

/**
* Set finition - finition
* @param string $finition
* @return \Pimcore\Model\Object\TechDopParquetFinition
*/
public function setFinition ($finition) {
	$this->finition = $finition;
	return $this;
}

}

