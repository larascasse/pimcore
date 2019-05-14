<?php 

/** 
* Generated at: 2019-05-14T10:52:06+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.184


Fields Summary: 
- ean [input]
- product [href]
- plusValue [href]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\ProductPlusValue\Listing getByEan ($value, $limit = 0) 
* @method \Pimcore\Model\Object\ProductPlusValue\Listing getByProduct ($value, $limit = 0) 
* @method \Pimcore\Model\Object\ProductPlusValue\Listing getByPlusValue ($value, $limit = 0) 
*/

class ProductPlusValue extends Concrete {

public $o_classId = 20;
public $o_className = "productPlusValue";
public $ean;
public $product;
public $plusValue;


/**
* @param array $values
* @return \Pimcore\Model\Object\ProductPlusValue
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get ean - Ean
* @return string
*/
public function getEan () {
	$preValue = $this->preGetValue("ean"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->ean;
	return $data;
}

/**
* Set ean - Ean
* @param string $ean
* @return \Pimcore\Model\Object\ProductPlusValue
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* Get product - Produit principal
* @return \Pimcore\Model\Object\product
*/
public function getProduct () {
	$preValue = $this->preGetValue("product"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("product")->preGetData($this);
	return $data;
}

/**
* Set product - Produit principal
* @param \Pimcore\Model\Object\product $product
* @return \Pimcore\Model\Object\ProductPlusValue
*/
public function setProduct ($product) {
	$this->product = $this->getClass()->getFieldDefinition("product")->preSetData($this, $product);
	return $this;
}

/**
* Get plusValue - Plus value
* @return \Pimcore\Model\Object\product
*/
public function getPlusValue () {
	$preValue = $this->preGetValue("plusValue"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("plusValue")->preGetData($this);
	return $data;
}

/**
* Set plusValue - Plus value
* @param \Pimcore\Model\Object\product $plusValue
* @return \Pimcore\Model\Object\ProductPlusValue
*/
public function setPlusValue ($plusValue) {
	$this->plusValue = $this->getClass()->getFieldDefinition("plusValue")->preSetData($this, $plusValue);
	return $this;
}

protected static $_relationFields = array (
  'product' => 
  array (
    'type' => 'href',
  ),
  'plusValue' => 
  array (
    'type' => 'href',
  ),
);

public $lazyLoadedFields = array (
  0 => 'product',
  1 => 'plusValue',
);

}

