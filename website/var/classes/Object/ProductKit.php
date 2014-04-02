<?php 

class Object_ProductKit extends Object_Concrete {

public $o_classId = 10;
public $o_className = "productKit";
public $ean;
public $products;


/**
* @param array $values
* @return Object_ProductKit
*/
public static function create($values = array()) {
	$object = new self();
	$object->setValues($values);
	return $object;
}

/**
* @return string
*/
public function getEan () {
	$preValue = $this->preGetValue("ean"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->ean;
	 return $data;
}

/**
* @param string $ean
* @return void
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* @return Object_Data_ObjectMetadata[]
*/
public function getProducts () {
	$preValue = $this->preGetValue("products"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("products")->preGetData($this);
	 return $data;
}

/**
* @param Object_Data_ObjectMetadata[] $products
* @return void
*/
public function setProducts ($products) {
	$this->products = $this->getClass()->getFieldDefinition("products")->preSetData($this, $products);
	return $this;
}

protected static $_relationFields = array (
  'products' => 
  array (
    'type' => 'objectsMetadata',
  ),
);

public $lazyLoadedFields = NULL;

}

