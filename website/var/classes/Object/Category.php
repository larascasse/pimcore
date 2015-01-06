<?php 

/** Generated at 2015-01-06T10:28:49+01:00 */

/**
* Inheritance: yes
* Variants   : no
* Changed by : florent (6)
* IP:          ::1
*/


namespace Pimcore\Model\Object;



class Category extends Concrete {

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
* @return \Pimcore\Model\Object\Category
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
* @return \Pimcore\Model\Object\Category
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get mage_category_id - Magento Catégorie ID
* @return string
*/
public function getMage_category_id () {
	$preValue = $this->preGetValue("mage_category_id"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_category_id;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_category_id")->isEmpty($data)) {
		return $this->getValueFromParent("mage_category_id");
	}
	return $data;
}

/**
* Set mage_category_id - Magento Catégorie ID
* @param string $mage_category_id
* @return \Pimcore\Model\Object\Category
*/
public function setMage_category_id ($mage_category_id) {
	$this->mage_category_id = $mage_category_id;
	return $this;
}

/**
* Get products - Produits
* @return array
*/
public function getProducts () {
	$preValue = $this->preGetValue("products"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("products")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("products")->isEmpty($data)) {
		return $this->getValueFromParent("products");
	}
	return $data;
}

/**
* Set products - Produits
* @param array $products
* @return \Pimcore\Model\Object\Category
*/
public function setProducts ($products) {
	$this->products = $this->getClass()->getFieldDefinition("products")->preSetData($this, $products);
	return $this;
}

/**
* Get person - Client
* @return Document_Page | Document_Snippet | Document | Asset | Object_Abstract
*/
public function getPerson () {
	$preValue = $this->preGetValue("person"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("person")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("person")->isEmpty($data)) {
		return $this->getValueFromParent("person");
	}
	return $data;
}

/**
* Set person - Client
* @param Document_Page | Document_Snippet | Document | Asset | Object_Abstract $person
* @return \Pimcore\Model\Object\Category
*/
public function setPerson ($person) {
	$this->person = $this->getClass()->getFieldDefinition("person")->preSetData($this, $person);
	return $this;
}

/**
* Get Date - date
* @return Zend_Date
*/
public function getDate () {
	$preValue = $this->preGetValue("Date"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Date;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("Date")->isEmpty($data)) {
		return $this->getValueFromParent("Date");
	}
	return $data;
}

/**
* Set Date - date
* @param Zend_Date $Date
* @return \Pimcore\Model\Object\Category
*/
public function setDate ($Date) {
	$this->Date = $Date;
	return $this;
}

/**
* Get test - test
* @return Object_Data_ObjectMetadata[]
*/
public function getTest () {
	$preValue = $this->preGetValue("test"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("test")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("test")->isEmpty($data)) {
		return $this->getValueFromParent("test");
	}
	return $data;
}

/**
* Set test - test
* @param Object_Data_ObjectMetadata[] $test
* @return \Pimcore\Model\Object\Category
*/
public function setTest ($test) {
	$this->test = $this->getClass()->getFieldDefinition("test")->preSetData($this, $test);
	return $this;
}

/**
* Get test2 - test2
* @return array
*/
public function getTest2 () {
	$preValue = $this->preGetValue("test2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("test2")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("test2")->isEmpty($data)) {
		return $this->getValueFromParent("test2");
	}
	return $data;
}

/**
* Set test2 - test2
* @param array $test2
* @return \Pimcore\Model\Object\Category
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

