<?php 

/** 
* Generated at: 2016-09-27T12:06:49+02:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 92.154.6.232


Fields Summary: 
- localizedfields [localizedfields]
-- name [input]
-- description [textarea]
- image [image]
- hexacolor [input]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Teinte\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
* @method static \Pimcore\Model\Object\Teinte\Listing getByImage ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Teinte\Listing getByHexacolor ($value, $limit = 0) 
*/

class Teinte extends Concrete {

public $o_classId = 13;
public $o_className = "teinte";
public $localizedfields;
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
* Get localizedfields - Traductions
* @return \Pimcore\Model\Object\Localizedfield
*/
public function getLocalizedfields () {
	$preValue = $this->preGetValue("localizedfields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("localizedfields")->isEmpty($data)) {
		return $this->getValueFromParent("localizedfields");
	}
	return $data;
}

/**
* Get name - Nom
* @return string
*/
public function getName ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("name", $language);
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get description - Description
* @return string
*/
public function getDescription ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("description", $language);
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Set localizedfields - Traductions
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\Teinte
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\Teinte
*/
public function setName ($name, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("name", $name, $language);
	return $this;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Teinte
*/
public function setDescription ($description, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("description", $description, $language);
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

