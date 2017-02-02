<?php 

/** 
* Generated at: 2017-02-02T14:43:51+01:00
* IP: 172.31.30.232


Fields Summary: 
 - products [objects]
*/ 

namespace Pimcore\Model\Object\Fieldcollection\Data;

use Pimcore\Model\Object;

class ProductList extends Object\Fieldcollection\Data\AbstractData  {

public $type = "productList";
public $products;


/**
* Get products - products
* @return \Pimcore\Model\Object\product[]
*/
public function getProducts () {
	$container = $this;
	$fd = $this->getDefinition()->getFieldDefinition("products");
	$data = $fd->preGetData($container);
	 return $data;
}

/**
* Set products - products
* @param \Pimcore\Model\Object\product[] $products
* @return \Pimcore\Model\Object\ProductList
*/
public function setProducts ($products) {
	$this->products = $this->getDefinition()->getFieldDefinition("products")->preSetData($this, $products);
	return $this;
}

}

