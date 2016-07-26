<?php 

/** Generated at 2016-07-26T10:22:28+02:00 */

/**
* Inheritance: no
* Variants   : no
* Changed by : florent (6)
* IP:          92.154.6.232
*/


namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Taxonomy\Listing getByCode ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Taxonomy\Listing getByLabel ($value, $limit = 0) 
*/

class Taxonomy extends Concrete {

public $o_classId = 6;
public $o_className = "taxonomy";
public $code;
public $label;


/**
* @param array $values
* @return \Pimcore\Model\Object\Taxonomy
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get code - Code
* @return string
*/
public function getCode () {
	$preValue = $this->preGetValue("code"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->code;
	return $data;
}

/**
* Set code - Code
* @param string $code
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setCode ($code) {
	$this->code = $code;
	return $this;
}

/**
* Get label - Label
* @return string
*/
public function getLabel () {
	$preValue = $this->preGetValue("label"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->label;
	return $data;
}

/**
* Set label - Label
* @param string $label
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setLabel ($label) {
	$this->label = $label;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

