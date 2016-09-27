<?php 

/** 
* Generated at: 2016-09-27T11:19:54+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 92.154.6.232


Fields Summary: 
- teinte [href]
- objettest [objects]
- multimetadata [multihrefMetadata]
- objmetadata [objectsMetadata]
- multihref [multihref]
*/ 

namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Test\Listing getByTeinte ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Test\Listing getByObjettest ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Test\Listing getByMultimetadata ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Test\Listing getByObjmetadata ($value, $limit = 0) 
* @method static \Pimcore\Model\Object\Test\Listing getByMultihref ($value, $limit = 0) 
*/

class Test extends Concrete {

public $o_classId = 11;
public $o_className = "test";
public $teinte;
public $objettest;
public $multimetadata;
public $objmetadata;
public $multihref;


/**
* @param array $values
* @return \Pimcore\Model\Object\Test
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get teinte - teinte
* @return \Pimcore\Model\Object\taxonomy
*/
public function getTeinte () {
	$preValue = $this->preGetValue("teinte"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("teinte")->preGetData($this);
	return $data;
}

/**
* Set teinte - teinte
* @param \Pimcore\Model\Object\taxonomy $teinte
* @return \Pimcore\Model\Object\Test
*/
public function setTeinte ($teinte) {
	$this->teinte = $this->getClass()->getFieldDefinition("teinte")->preSetData($this, $teinte);
	return $this;
}

/**
* Get objettest - objettest
* @return \Pimcore\Model\Object\taxonomy[]
*/
public function getObjettest () {
	$preValue = $this->preGetValue("objettest"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("objettest")->preGetData($this);
	return $data;
}

/**
* Set objettest - objettest
* @param \Pimcore\Model\Object\taxonomy[] $objettest
* @return \Pimcore\Model\Object\Test
*/
public function setObjettest ($objettest) {
	$this->objettest = $this->getClass()->getFieldDefinition("objettest")->preSetData($this, $objettest);
	return $this;
}

/**
* Get multimetadata - multimetadata
* @return \Pimcore\Model\Object\taxonomy[]
*/
public function getMultimetadata () {
	$preValue = $this->preGetValue("multimetadata"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("multimetadata")->preGetData($this);
	return $data;
}

/**
* Set multimetadata - multimetadata
* @param \Pimcore\Model\Object\taxonomy[] $multimetadata
* @return \Pimcore\Model\Object\Test
*/
public function setMultimetadata ($multimetadata) {
	$this->multimetadata = $this->getClass()->getFieldDefinition("multimetadata")->preSetData($this, $multimetadata);
	return $this;
}

/**
* Get objmetadata - objmetadata
* @return \Pimcore\Model\Object\AbstractObject[]
*/
public function getObjmetadata () {
	$preValue = $this->preGetValue("objmetadata"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("objmetadata")->preGetData($this);
	return $data;
}

/**
* Set objmetadata - objmetadata
* @param \Pimcore\Model\Object\AbstractObject[] $objmetadata
* @return \Pimcore\Model\Object\Test
*/
public function setObjmetadata ($objmetadata) {
	$this->objmetadata = $this->getClass()->getFieldDefinition("objmetadata")->preSetData($this, $objmetadata);
	return $this;
}

/**
* Get multihref - multihref
* @return \Pimcore\Model\Object\product[]
*/
public function getMultihref () {
	$preValue = $this->preGetValue("multihref"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("multihref")->preGetData($this);
	return $data;
}

/**
* Set multihref - multihref
* @param \Pimcore\Model\Object\product[] $multihref
* @return \Pimcore\Model\Object\Test
*/
public function setMultihref ($multihref) {
	$this->multihref = $this->getClass()->getFieldDefinition("multihref")->preSetData($this, $multihref);
	return $this;
}

protected static $_relationFields = array (
  'teinte' => 
  array (
    'type' => 'href',
  ),
  'objettest' => 
  array (
    'type' => 'objects',
  ),
  'multimetadata' => 
  array (
    'type' => 'multihrefMetadata',
  ),
  'objmetadata' => 
  array (
    'type' => 'objectsMetadata',
  ),
  'multihref' => 
  array (
    'type' => 'multihref',
  ),
);

public $lazyLoadedFields = array (
  0 => 'teinte',
  1 => 'objettest',
  2 => 'multimetadata',
  3 => 'objmetadata',
  4 => 'multihref',
);

}

