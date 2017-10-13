<?php 

/** 
* Generated at: 2017-10-12T16:36:16+02:00
* IP: 172.31.11.46


Fields Summary: 
 - resistance_mecanique [input]
 - securite_incendie [input]
 - securite_usage [input]
*/ 

namespace Pimcore\Model\Object\Objectbrick\Data;

use Pimcore\Model\Object;

class TechMarquageCE extends Object\Objectbrick\Data\AbstractData  {

public $type = "techMarquageCE";
public $resistance_mecanique;
public $securite_incendie;
public $securite_usage;


/**
* Set resistance_mecanique - Resitance Mécanique
* @return string
*/
public function getResistance_mecanique () {
	$data = $this->resistance_mecanique;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("resistance_mecanique")->isEmpty($data)) {
		return $this->getValueFromParent("resistance_mecanique");
	}
	 return $data;
}

/**
* Set resistance_mecanique - Resitance Mécanique
* @param string $resistance_mecanique
* @return \Pimcore\Model\Object\TechMarquageCE
*/
public function setResistance_mecanique ($resistance_mecanique) {
	$this->resistance_mecanique = $resistance_mecanique;
	return $this;
}

/**
* Set securite_incendie - securité_incendie
* @return string
*/
public function getSecurite_incendie () {
	$data = $this->securite_incendie;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("securite_incendie")->isEmpty($data)) {
		return $this->getValueFromParent("securite_incendie");
	}
	 return $data;
}

/**
* Set securite_incendie - securité_incendie
* @param string $securite_incendie
* @return \Pimcore\Model\Object\TechMarquageCE
*/
public function setSecurite_incendie ($securite_incendie) {
	$this->securite_incendie = $securite_incendie;
	return $this;
}

/**
* Set securite_usage - securite_usage
* @return string
*/
public function getSecurite_usage () {
	$data = $this->securite_usage;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("securite_usage")->isEmpty($data)) {
		return $this->getValueFromParent("securite_usage");
	}
	 return $data;
}

/**
* Set securite_usage - securite_usage
* @param string $securite_usage
* @return \Pimcore\Model\Object\TechMarquageCE
*/
public function setSecurite_usage ($securite_usage) {
	$this->securite_usage = $securite_usage;
	return $this;
}

}

