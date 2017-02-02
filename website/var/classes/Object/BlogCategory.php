<?php 

/** 
* Generated at: 2017-02-02T14:48:10+01:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.232


Fields Summary: 
- name [input]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\BlogCategory\Listing getByName ($value, $limit = 0) 
*/

class BlogCategory extends Concrete {

public $o_classId = 15;
public $o_className = "blogCategory";
public $name;


/**
* @param array $values
* @return \Pimcore\Model\Object\BlogCategory
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get name - name
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name;
	return $data;
}

/**
* Set name - name
* @param string $name
* @return \Pimcore\Model\Object\BlogCategory
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

