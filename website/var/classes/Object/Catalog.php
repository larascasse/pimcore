<?php 

class Object_Catalog extends Object_Concrete {

public $o_classId = 8;
public $o_className = "catalog";
public $title;
public $products;
public $date;
public $text;


/**
* @param array $values
* @return Object_Catalog
*/
public static function create($values = array()) {
	$object = new self();
	$object->setValues($values);
	return $object;
}

/**
* @return string
*/
public function getTitle () {
	$preValue = $this->preGetValue("title"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->title;
	 return $data;
}

/**
* @param string $title
* @return void
*/
public function setTitle ($title) {
	$this->title = $title;
	return $this;
}

/**
* @return array
*/
public function getProducts () {
	$preValue = $this->preGetValue("products"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("products")->preGetData($this);
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
* @return Pimcore_Date
*/
public function getDate () {
	$preValue = $this->preGetValue("date"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->date;
	 return $data;
}

/**
* @param Pimcore_Date $date
* @return void
*/
public function setDate ($date) {
	$this->date = $date;
	return $this;
}

/**
* @return string
*/
public function getText () {
	$preValue = $this->preGetValue("text"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->text;
	 return $data;
}

/**
* @param string $text
* @return void
*/
public function setText ($text) {
	$this->text = $text;
	return $this;
}

protected static $_relationFields = array (
  'products' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = NULL;

}

