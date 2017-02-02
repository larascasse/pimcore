<?php 

/** 
* Generated at: 2017-02-02T14:50:29+01:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.232


Fields Summary: 
*/ 

namespace Pimcore\Model\Object;



/**
*/

class ProjectCategory extends Concrete {

public $o_classId = 17;
public $o_className = "projectCategory";


/**
* @param array $values
* @return \Pimcore\Model\Object\ProjectCategory
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

}

