<?php 

class Object_Category extends Object_Concrete {

public $o_classId = 8;
public $o_className = "category";
public $name;
public $mage_category_id;
public $products;
public $person;
public $Date;
public $test;
public $test2;


/**
* @param array $values
* @return Object_Category
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
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name")->isEmpty($data)) { return $this->getValueFromParent("name");}
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
public function getMage_category_id () {
	$preValue = $this->preGetValue("mage_category_id"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_category_id;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_category_id")->isEmpty($data)) { return $this->getValueFromParent("mage_category_id");}
	 return $data;
}

/**
* @param string $mage_category_id
* @return void
*/
public function setMage_category_id ($mage_category_id) {
	$this->mage_category_id = $mage_category_id;
	return $this;
}

/**
* @return array
*/
public function getProducts () {
	$preValue = $this->preGetValue("products"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("products")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("products")->isEmpty($data)) { return $this->getValueFromParent("products");}
	 return $data;
}

/**
* @param array $products
* @return void
*/
public function setProducts ($products) {
	$this->products = $this->getClass()->getFieldDefinition("products")->preSetData($this, $products);
	return $this;
}

/**
* @return Document_Page | Document_Snippet | Document | Asset | Object_Abstract
*/
public function getPerson () {
	$preValue = $this->preGetValue("person"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("person")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("person")->isEmpty($data)) { return $this->getValueFromParent("person");}
	 return $data;
}

/**
* @param Document_Page | Document_Snippet | Document | Asset | Object_Abstract $person
* @return void
*/
public function setPerson ($person) {
	$this->person = $this->getClass()->getFieldDefinition("person")->preSetData($this, $person);
	return $this;
}

/**
* @return Zend_Date
*/
public function getDate () {
	$preValue = $this->preGetValue("Date"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->Date;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("Date")->isEmpty($data)) { return $this->getValueFromParent("Date");}
	 return $data;
}

/**
* @param Zend_Date $Date
* @return void
*/
public function setDate ($Date) {
	$this->Date = $Date;
	return $this;
}

/**
* @return Object_Data_ObjectMetadata[]
*/
public function getTest () {
	$preValue = $this->preGetValue("test"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("test")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("test")->isEmpty($data)) { return $this->getValueFromParent("test");}
	 return $data;
}

/**
* @param Object_Data_ObjectMetadata[] $test
* @return void
*/
public function setTest ($test) {
	$this->test = $this->getClass()->getFieldDefinition("test")->preSetData($this, $test);
	return $this;
}

/**
* @return array
*/
public function getTest2 () {
	$preValue = $this->preGetValue("test2"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("test2")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("test2")->isEmpty($data)) { return $this->getValueFromParent("test2");}
	 return $data;
}

/**
* @param array $test2
* @return void
*/
public function setTest2 ($test2) {
	$this->test2 = $this->getClass()->getFieldDefinition("test2")->preSetData($this, $test2);
	return $this;
}

protected static $_relationFields = array (
  'products' => 
  array (
    'type' => 'objects',
  ),
  'person' => 
  array (
    'type' => 'href',
  ),
  'test' => 
  array (
    'type' => 'objectsMetadata',
  ),
  'test2' => 
  array (
    'type' => 'multihref',
  ),
);

public $lazyLoadedFields = NULL;

}

