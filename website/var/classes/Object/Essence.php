<?php 

class Object_Essence extends Object_Concrete {

public $o_classId = 7;
public $o_className = "essence";
public $code;
public $name;


/**
* @param array $values
* @return Object_Essence
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
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->name;
	 return $data;
}

/**
* @param string $name
* @return void
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

