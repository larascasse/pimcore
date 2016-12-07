<?php 

/** 
* Generated at: 2016-11-28T17:18:55+01:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 92.154.6.232


Fields Summary: 
- name [input]
- mage_category_id [input]
- products [objects]
- title [input]
- description [textarea]
- person [href]
- Date [datetime]
- test [objectsMetadata]
- test2 [multihref]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Category\Listing getByName ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByMage_category_id ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByProducts ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByTitle ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByDescription ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByPerson ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByDate ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByTest ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Category\Listing getByTest2 ($value, $limit = 0) 
*/

class Category extends Concrete {

public $o_classId = 8;
public $o_className = "category";
public $name;
public $mage_category_id;
public $products;
public $title;
public $description;
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
* @return \Pimcore\Model\Object\product[]
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
* @param \Pimcore\Model\Object\product[] $products
* @return \Pimcore\Model\Object\Category
*/
public function setProducts ($products) {
	$this->products = $this->getClass()->getFieldDefinition("products")->preSetData($this, $products);
	return $this;
}

/**
* Get title - Titre
* @return string
*/
public function getTitle () {
	$preValue = $this->preGetValue("title"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->title;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("title")->isEmpty($data)) {
		return $this->getValueFromParent("title");
	}
	return $data;
}

/**
* Set title - Titre
* @param string $title
* @return \Pimcore\Model\Object\Category
*/
public function setTitle ($title) {
	$this->title = $title;
	return $this;
}

/**
* Get description - Description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("description")->isEmpty($data)) {
		return $this->getValueFromParent("description");
	}
	return $data;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Category
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get person - Client
* @return \Pimcore\Model\Object\person
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
* @param \Pimcore\Model\Object\person $person
* @return \Pimcore\Model\Object\Category
*/
public function setPerson ($person) {
	$this->person = $this->getClass()->getFieldDefinition("person")->preSetData($this, $person);
	return $this;
}

/**
* Get Date - date
* @return \Pimcore\Date
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
* @param \Pimcore\Date $Date
* @return \Pimcore\Model\Object\Category
*/
public function setDate ($Date) {
	$this->Date = $Date;
	return $this;
}

/**
* Get test - test
* @return \Pimcore\Model\Object\AbstractObject[]
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
* @param \Pimcore\Model\Object\AbstractObject[] $test
* @return \Pimcore\Model\Object\Category
*/
public function setTest ($test) {
	$this->test = $this->getClass()->getFieldDefinition("test")->preSetData($this, $test);
	return $this;
}

/**
* Get test2 - test2
* @return \Pimcore\Model\Asset\image[]
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
* @param \Pimcore\Model\Asset\image[] $test2
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

