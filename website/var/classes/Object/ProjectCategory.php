<?php 

/** 
<<<<<<< HEAD
* Generated at: 2017-02-23T15:18:58+01:00
=======
* Generated at: 2017-02-23T15:13:53+01:00
>>>>>>> 662512179337c23b9bc4fd52963b34353b10b54b
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 127.0.0.1


Fields Summary: 
- localizedfields [localizedfields]
-- name [input]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\ProjectCategory\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
*/

class ProjectCategory extends Concrete {

public $o_classId = 17;
public $o_className = "projectCategory";
public $localizedfields;


/**
* @param array $values
* @return \Pimcore\Model\Object\ProjectCategory
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
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
* Set localizedfields - 
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\ProjectCategory
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\ProjectCategory
*/
public function setName ($name, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("name", $name, $language);
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

