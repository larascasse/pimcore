<?php 

class Object_Category extends Object_Concrete {

public $o_classId = 8;
public $o_className = "category";
public $name;
public $mage_category_id;
public $products;
public $person;
public $Date;
public $localizedfields;


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
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("name");}
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
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_category_id");}
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
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("products");}
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
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("person");}
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
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("Date");}
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
* @return array
*/
public function getLocalizedfields () {
	$preValue = $this->preGetValue("localizedfields"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("localizedfields");}
	 return $data;
}

/**
* @return string
*/
public function getTes ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("tes", $language);
	$preValue = $this->preGetValue("tes"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	 return $data;
}

/**
* @param array $localizedfields
* @return void
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* @param string $tes
* @return void
*/
public function setTes ($tes, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("tes", $tes, $language);
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
);

public $lazyLoadedFields = NULL;

}

