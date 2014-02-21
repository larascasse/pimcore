<?php 

class Object_Taxonomy extends Object_Concrete {

public $o_classId = 6;
public $o_className = "taxonomy";
public $code;
public $label;


/**
* @param array $values
* @return Object_Taxonomy
*/
public static function create($values = array()) {
	$object = new self();
	$object->setValues($values);
	return $object;
}

/**
* @return string
*/
public function getCode () {
	$preValue = $this->preGetValue("code"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->code;
	 return $data;
}

/**
* @param string $code
* @return void
*/
public function setCode ($code) {
	$this->code = $code;
	return $this;
}

/**
* @return string
*/
public function getLabel () {
	$preValue = $this->preGetValue("label"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->label;
	 return $data;
}

/**
* @param string $label
* @return void
*/
public function setLabel ($label) {
	$this->label = $label;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

