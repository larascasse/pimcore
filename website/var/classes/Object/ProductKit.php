<?php 

/** 
* Generated at: 2019-05-14T10:52:43+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.184


Fields Summary: 
- ean [input]
- block [block]
-- title [input]
-- option_type [select]
-- option_required [checkbox]
-- associatedProducts [objectsMetadata]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\ProductKit\Listing getByEan ($value, $limit = 0) 
* @method \Pimcore\Model\Object\ProductKit\Listing getByBlock ($value, $limit = 0) 
*/

class ProductKit extends Concrete {

public $o_classId = 10;
public $o_className = "productKit";
public $ean;
public $block;


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
* @return \Pimcore\Model\Object\ProductKit
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* Get block - block
* @return \Pimcore\Model\Object\Data\Block
*/
public function getBlock () {
	$preValue = $this->preGetValue("block"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->block;
	return $data;
}

/**
* Set block - block
* @param \Pimcore\Model\Object\Data\Block $block
* @return \Pimcore\Model\Object\ProductKit
*/
public function setBlock ($block) {
	$this->block = $block;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

