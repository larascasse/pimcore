<?php 

/** 
* Generated at: 2017-10-12T17:18:13+02:00
* IP: 172.31.30.232


Fields Summary: 
 - reaction_feu [input]
 - degagement_formaldehyde [input]
 - emission_penta [input]
 - resistance_rupture [input]
 - glissance [input]
 - conductivite_thermique [input]
 - durabilite_biologique [input]
 - masse_volumique_moyenne [calculatedValue]
*/ 

namespace Pimcore\Model\Object\Objectbrick\Data;

use Pimcore\Model\Object;

class TechDopParquet extends Object\Objectbrick\Data\AbstractData  {

public $type = "techDopParquet";
public $reaction_feu;
public $degagement_formaldehyde;
public $emission_penta;
public $resistance_rupture;
public $glissance;
public $conductivite_thermique;
public $durabilite_biologique;
public $masse_volumique_moyenne;


/**
* Set reaction_feu - reaction_feu
* @return string
*/
public function getReaction_feu () {
	$data = $this->reaction_feu;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("reaction_feu")->isEmpty($data)) {
		return $this->getValueFromParent("reaction_feu");
	}
	 return $data;
}

/**
* Set reaction_feu - reaction_feu
* @param string $reaction_feu
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setReaction_feu ($reaction_feu) {
	$this->reaction_feu = $reaction_feu;
	return $this;
}

/**
* Set degagement_formaldehyde - degagement_formaldehyde
* @return string
*/
public function getDegagement_formaldehyde () {
	$data = $this->degagement_formaldehyde;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("degagement_formaldehyde")->isEmpty($data)) {
		return $this->getValueFromParent("degagement_formaldehyde");
	}
	 return $data;
}

/**
* Set degagement_formaldehyde - degagement_formaldehyde
* @param string $degagement_formaldehyde
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setDegagement_formaldehyde ($degagement_formaldehyde) {
	$this->degagement_formaldehyde = $degagement_formaldehyde;
	return $this;
}

/**
* Set emission_penta - emission_penta
* @return string
*/
public function getEmission_penta () {
	$data = $this->emission_penta;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("emission_penta")->isEmpty($data)) {
		return $this->getValueFromParent("emission_penta");
	}
	 return $data;
}

/**
* Set emission_penta - emission_penta
* @param string $emission_penta
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setEmission_penta ($emission_penta) {
	$this->emission_penta = $emission_penta;
	return $this;
}

/**
* Set resistance_rupture - resistance_rupture
* @return string
*/
public function getResistance_rupture () {
	$data = $this->resistance_rupture;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("resistance_rupture")->isEmpty($data)) {
		return $this->getValueFromParent("resistance_rupture");
	}
	 return $data;
}

/**
* Set resistance_rupture - resistance_rupture
* @param string $resistance_rupture
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setResistance_rupture ($resistance_rupture) {
	$this->resistance_rupture = $resistance_rupture;
	return $this;
}

/**
* Set glissance - glissance
* @return string
*/
public function getGlissance () {
	$data = $this->glissance;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("glissance")->isEmpty($data)) {
		return $this->getValueFromParent("glissance");
	}
	 return $data;
}

/**
* Set glissance - glissance
* @param string $glissance
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setGlissance ($glissance) {
	$this->glissance = $glissance;
	return $this;
}

/**
* Set conductivite_thermique - conductivite_thermique
* @return string
*/
public function getConductivite_thermique () {
	$data = $this->conductivite_thermique;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("conductivite_thermique")->isEmpty($data)) {
		return $this->getValueFromParent("conductivite_thermique");
	}
	 return $data;
}

/**
* Set conductivite_thermique - conductivite_thermique
* @param string $conductivite_thermique
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setConductivite_thermique ($conductivite_thermique) {
	$this->conductivite_thermique = $conductivite_thermique;
	return $this;
}

/**
* Set durabilite_biologique - durabilite_biologique
* @return string
*/
public function getDurabilite_biologique () {
	$data = $this->durabilite_biologique;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("durabilite_biologique")->isEmpty($data)) {
		return $this->getValueFromParent("durabilite_biologique");
	}
	 return $data;
}

/**
* Set durabilite_biologique - durabilite_biologique
* @param string $durabilite_biologique
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setDurabilite_biologique ($durabilite_biologique) {
	$this->durabilite_biologique = $durabilite_biologique;
	return $this;
}

/**
* Set masse_volumique_moyenne - masse_volumique_moyenne
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getMasse_volumique_moyenne ($language = null) {
	$brickDefinition = Object\Objectbrick\Definition::getByKey("techDopParquet");
	$fd = $brickDefinition->getFieldDefinition("masse_volumique_moyenne");
	$data = new \Pimcore\Model\Object\Data\CalculatedValue($fd->getName());
	$data->setContextualData("objectbrick", $this->getFieldName() , $this->getType(), $fd->getName(), null, null, $fd);
	$data = Object\Service::getCalculatedFieldValue($this->getObject(), $data);
	return $data;
	}

/**
* Set masse_volumique_moyenne - masse_volumique_moyenne
* @param \Pimcore\Model\Object\Data\CalculatedValue $masse_volumique_moyenne
* @return \Pimcore\Model\Object\TechDopParquet
*/
public function setMasse_volumique_moyenne ($masse_volumique_moyenne) {
	return $this;
}

}

