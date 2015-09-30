<?php 

/** Generated at 2015-01-06T10:28:50+01:00 */

/**
* Inheritance: no
* Variants   : no
* Changed by : florent (6)
* IP:          ::1
*/


namespace Pimcore\Model\Object;



class ProductExtra extends Concrete {

public $o_classId = 9;
public $o_className = "productExtra";
public $name;
public $content;


/**
* @param array $values
* @return \Pimcore\Model\Object\ProductExtra
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
	return $data;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\ProductExtra
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get content - Contenu
* @return string
*/
public function getContent () {
	$preValue = $this->preGetValue("content"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("content")->preGetData($this);
	return $data;
}

/**
* Set content - Contenu
* @param string $content
* @return \Pimcore\Model\Object\ProductExtra
*/
public function setContent ($content) {
	$this->content = $content;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

