<?php 

/** 
* Generated at: 2017-10-11T15:09:35+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.232


Fields Summary: 
- code [input]
- label [input]
- localizedfields [localizedfields]
-- description [textarea]
-- help [textarea]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Taxonomy\Listing getByCode ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Taxonomy\Listing getByLabel ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Taxonomy\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
*/

class Taxonomy extends Concrete {

public $o_classId = 6;
public $o_className = "taxonomy";
public $code;
public $label;
public $localizedfields;


/**
* @param array $values
* @return \Pimcore\Model\Object\Taxonomy
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get code - Code
* @return string
*/
public function getCode () {
	$preValue = $this->preGetValue("code"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->code;
	return $data;
}

/**
* Set code - Code
* @param string $code
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setCode ($code) {
	$this->code = $code;
	return $this;
}

/**
* Get label - Label
* @return string
*/
public function getLabel () {
	$preValue = $this->preGetValue("label"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->label;
	return $data;
}

/**
* Set label - Label
* @param string $label
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setLabel ($label) {
	$this->label = $label;
	return $this;
}

/**
* Get localizedfields - 
* @return \Pimcore\Model\Object\Localizedfield
*/
public function getLocalizedfields () {
	$preValue = $this->preGetValue("localizedfields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);
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
* Get help - Aide
* @return string
*/
public function getHelp ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("help", $language);
	$preValue = $this->preGetValue("help"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Set localizedfields - 
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setDescription ($description, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("description", $description, $language);
	return $this;
}

/**
* Set help - Aide
* @param string $help
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setHelp ($help, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("help", $help, $language);
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

