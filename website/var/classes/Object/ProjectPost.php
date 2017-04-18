<?php 

/** 
* Generated at: 2017-04-18T15:00:58+02:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.232


Fields Summary: 
- category [multihref]
- localizedfields [localizedfields]
-- name [input]
-- accroche [textarea]
-- description [textarea]
- images [multihref]
- content [textarea]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\ProjectPost\Listing getByCategory ($value, $limit = 0) 
* @method \Pimcore\Model\Object\ProjectPost\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
* @method \Pimcore\Model\Object\ProjectPost\Listing getByImages ($value, $limit = 0) 
* @method \Pimcore\Model\Object\ProjectPost\Listing getByContent ($value, $limit = 0) 
*/

class ProjectPost extends Concrete {

public $o_classId = 16;
public $o_className = "projectPost";
public $category;
public $localizedfields;
public $images;
public $content;


/**
* @param array $values
* @return \Pimcore\Model\Object\ProjectPost
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get category - category
* @return 
*/
public function getCategory () {
	$preValue = $this->preGetValue("category"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("category")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("category")->isEmpty($data)) {
		return $this->getValueFromParent("category");
	}
	return $data;
}

/**
* Set category - category
* @param  $category
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setCategory ($category) {
	$this->category = $this->getClass()->getFieldDefinition("category")->preSetData($this, $category);
	return $this;
}

/**
* Get localizedfields - 
* @return \Pimcore\Model\Object\Localizedfield
*/
public function getLocalizedfields () {
	$preValue = $this->preGetValue("localizedfields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("localizedfields")->isEmpty($data)) {
		return $this->getValueFromParent("localizedfields");
	}
	return $data;
}

/**
* Get name - Nom
* @return string
*/
public function getName ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("name", $language);
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get accroche - Accroche
* @return string
*/
public function getAccroche ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("accroche", $language);
	$preValue = $this->preGetValue("accroche"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get description - description
* @return string
*/
public function getDescription ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("description", $language);
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Set localizedfields - 
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setName ($name, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("name", $name, $language);
	return $this;
}

/**
* Set accroche - Accroche
* @param string $accroche
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setAccroche ($accroche, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("accroche", $accroche, $language);
	return $this;
}

/**
* Set description - description
* @param string $description
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setDescription ($description, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("description", $description, $language);
	return $this;
}

/**
* Get images - images
* @return \Pimcore\Model\Asset\video[] | \Pimcore\Model\Asset\image[] | \Pimcore\Model\Asset\folder[] | \Pimcore\Model\Asset\unknown[]
*/
public function getImages () {
	$preValue = $this->preGetValue("images"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("images")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("images")->isEmpty($data)) {
		return $this->getValueFromParent("images");
	}
	return $data;
}

/**
* Set images - images
* @param \Pimcore\Model\Asset\video[] | \Pimcore\Model\Asset\image[] | \Pimcore\Model\Asset\folder[] | \Pimcore\Model\Asset\unknown[] $images
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setImages ($images) {
	$this->images = $this->getClass()->getFieldDefinition("images")->preSetData($this, $images);
	return $this;
}

/**
* Get content - content
* @return string
*/
public function getContent () {
	$preValue = $this->preGetValue("content"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->content;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("content")->isEmpty($data)) {
		return $this->getValueFromParent("content");
	}
	return $data;
}

/**
* Set content - content
* @param string $content
* @return \Pimcore\Model\Object\ProjectPost
*/
public function setContent ($content) {
	$this->content = $content;
	return $this;
}

protected static $_relationFields = array (
  'category' => 
  array (
    'type' => 'multihref',
  ),
  'images' => 
  array (
    'type' => 'multihref',
  ),
);

public $lazyLoadedFields = array (
  0 => 'category',
  1 => 'images',
);

}

