<?php 

/** Generated at 2016-07-26T10:22:33+02:00 */

/**
* Inheritance: no
* Variants   : no
* Changed by : florent (6)
* IP:          92.154.6.232
*/


namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\ProductKit\Listing getByEan ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\ProductKit\Listing getByProducts ($value, $limit = 0) 
*/

class ProductKit extends Concrete {

public $o_classId = 10;
public $o_className = "productKit";
public $ean;
public $products;


/**
* @param array $values
* @return \Pimcore\Model\Object\ProductKit
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get ean - EAN
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
* Set ean - EAN
* @param string $ean
* @return \Pimcore\Model\Object\ProductKit
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* Get products - Produits
* @return \Pimcore\Model\Object\AbstractObject[]
*/
public function getProducts () {
	$preValue = $this->preGetValue("products"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("products")->preGetData($this);
	return $data;
}

/**
* Set products - Produits
* @param \Pimcore\Model\Object\AbstractObject[] $products
* @return \Pimcore\Model\Object\ProductKit
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

