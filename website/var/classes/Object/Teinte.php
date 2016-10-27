<?php 

/** 
* Generated at: 2016-10-21T17:24:22+02:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 85.169.54.82


Fields Summary: 
- name [input]
- description [textarea]
- image [image]
- hexacolor [input]
- products_relation [nonownerobjects]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Teinte\Listing getByName ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Teinte\Listing getByDescription ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Teinte\Listing getByImage ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Teinte\Listing getByHexacolor ($value, $limit = 0) 
*/

class Teinte extends Concrete {

public $o_classId = 13;
public $o_className = "teinte";
public $name;
public $description;
public $image;
public $hexacolor;


/**
* @param array $values
* @return \Pimcore\Model\Object\Teinte
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get name - Nom
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name")->isEmpty($data)) {
		return $this->getValueFromParent("name");
	}
	return $data;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\Teinte
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get description - Description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("description")->isEmpty($data)) {
		return $this->getValueFromParent("description");
	}
	return $data;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Teinte
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get image - Image
* @return \Pimcore\Model\Asset\Image
*/
public function getImage () {
	$preValue = $this->preGetValue("image"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image")->isEmpty($data)) {
		return $this->getValueFromParent("image");
	}
	return $data;
}

/**
* Set image - Image
* @param \Pimcore\Model\Asset\Image $image
* @return \Pimcore\Model\Object\Teinte
*/
public function setImage ($image) {
	$this->image = $image;
	return $this;
}

/**
* Get hexacolor - Couleur Hexa (avec #)
* @return string
*/
public function getHexacolor () {
	$preValue = $this->preGetValue("hexacolor"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hexacolor;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hexacolor")->isEmpty($data)) {
		return $this->getValueFromParent("hexacolor");
	}
	return $data;
}

/**
* Set hexacolor - Couleur Hexa (avec #)
* @param string $hexacolor
* @return \Pimcore\Model\Object\Teinte
*/
public function setHexacolor ($hexacolor) {
	$this->hexacolor = $hexacolor;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

