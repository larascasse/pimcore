<?php 

/** 
* Generated at: 2017-10-13T10:18:47+02:00
* IP: 172.31.30.232


Fields Summary: 
 - classe_durete [calculatedValue]
 - classe_utilisation [calculatedValue]
*/ 

namespace Pimcore\Model\Object\Objectbrick\Data;

use Pimcore\Model\Object;

class TechAttributeSol extends Object\Objectbrick\Data\AbstractData  {

public $type = "techAttributeSol";
public $classe_durete;
public $classe_utilisation;


/**
* Set classe_durete - classe_durete
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getClasse_durete ($language = null) {
	$brickDefinition = Object\Objectbrick\Definition::getByKey("techAttributeSol");
	$fd = $brickDefinition->getFieldDefinition("classe_durete");
	$data = new \Pimcore\Model\Object\Data\CalculatedValue($fd->getName());
	$data->setContextualData("objectbrick", $this->getFieldName() , $this->getType(), $fd->getName(), null, null, $fd);
	$data = Object\Service::getCalculatedFieldValue($this->getObject(), $data);
	return $data;
	}

/**
* Set classe_durete - classe_durete
* @param \Pimcore\Model\Object\Data\CalculatedValue $classe_durete
* @return \Pimcore\Model\Object\TechAttributeSol
*/
public function setClasse_durete ($classe_durete) {
	return $this;
}

/**
* Set classe_utilisation - classe_utilisation
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getClasse_utilisation ($language = null) {
	$brickDefinition = Object\Objectbrick\Definition::getByKey("techAttributeSol");
	$fd = $brickDefinition->getFieldDefinition("classe_utilisation");
	$data = new \Pimcore\Model\Object\Data\CalculatedValue($fd->getName());
	$data->setContextualData("objectbrick", $this->getFieldName() , $this->getType(), $fd->getName(), null, null, $fd);
	$data = Object\Service::getCalculatedFieldValue($this->getObject(), $data);
	return $data;
	}

/**
* Set classe_utilisation - classe_utilisation
* @param \Pimcore\Model\Object\Data\CalculatedValue $classe_utilisation
* @return \Pimcore\Model\Object\TechAttributeSol
*/
public function setClasse_utilisation ($classe_utilisation) {
	return $this;
}

}

