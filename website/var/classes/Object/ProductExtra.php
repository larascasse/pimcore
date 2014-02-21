<?php 

class Object_ProductExtra extends Object_Concrete {

public $o_classId = 9;
public $o_className = "productExtra";
public $name;
public $content;


/**
* @param array $values
* @return Object_ProductExtra
*/
public static function create($values = array()) {
	$object = new self();
	$object->setValues($values);
	return $object;
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

/**
* @return string
*/
public function getContent () {
	$preValue = $this->preGetValue("content"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("content")->preGetData($this);
	 return $data;
}

/**
* @param string $content
* @return void
*/
public function setContent ($content) {
	$this->content = $content;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

