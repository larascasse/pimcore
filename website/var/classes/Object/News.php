<?php 

/** Generated at 2015-01-06T10:28:49+01:00 */

/**
* Inheritance: no
* Variants   : no
* Changed by : florent (6)
* IP:          ::1
*/


namespace Pimcore\Model\Object;



class News extends Concrete {

public $o_classId = 2;
public $o_className = "news";
public $localizedfields;
public $keyvaluepairs;
public $date;
public $image_1;
public $image_2;
public $image_3;


/**
* @param array $values
* @return \Pimcore\Model\Object\News
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get localizedfields - 
* @return array
*/
public function getLocalizedfields () {
	$preValue = $this->preGetValue("localizedfields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);
	return $data;
}

/**
* Get title - Title
* @return string
*/
public function getTitle ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("title", $language);
	$preValue = $this->preGetValue("title"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { return $preValue;}
	 return $data;
}

/**
* Get shortText - Short Text
* @return string
*/
public function getShortText ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("shortText", $language);
	$preValue = $this->preGetValue("shortText"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { return $preValue;}
	 return $data;
}

/**
* Get text - Text
* @return string
*/
public function getText ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("text", $language);
	$preValue = $this->preGetValue("text"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { return $preValue;}
	 return $data;
}

/**
* Set localizedfields - 
* @param array $localizedfields
* @return \Pimcore\Model\Object\News
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set title - Title
* @param string $title
* @return \Pimcore\Model\Object\News
*/
public function setTitle ($title, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("title", $title, $language);
	return $this;
}

/**
* Set shortText - Short Text
* @param string $shortText
* @return \Pimcore\Model\Object\News
*/
public function setShortText ($shortText, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("shortText", $shortText, $language);
	return $this;
}

/**
* Set text - Text
* @param string $text
* @return \Pimcore\Model\Object\News
*/
public function setText ($text, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("text", $text, $language);
	return $this;
}

/**
* Get keyvaluepairs - KEY
* @return Object_Data_KeyValue
*/
public function getKeyvaluepairs () {
	$preValue = $this->preGetValue("keyvaluepairs"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->keyvaluepairs;
	return $data;
}

/**
* Set keyvaluepairs - KEY
* @param Object_Data_KeyValue $keyvaluepairs
* @return \Pimcore\Model\Object\News
*/
public function setKeyvaluepairs ($keyvaluepairs) {
	$this->keyvaluepairs = $keyvaluepairs;
	return $this;
}

/**
* Get date - Date
* @return Zend_Date
*/
public function getDate () {
	$preValue = $this->preGetValue("date"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->date;
	return $data;
}

/**
* Set date - Date
* @param Zend_Date $date
* @return \Pimcore\Model\Object\News
*/
public function setDate ($date) {
	$this->date = $date;
	return $this;
}

/**
* Get image_1 - Image
* @return Asset_Image
*/
public function getImage_1 () {
	$preValue = $this->preGetValue("image_1"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_1;
	return $data;
}

/**
* Set image_1 - Image
* @param Asset_Image $image_1
* @return \Pimcore\Model\Object\News
*/
public function setImage_1 ($image_1) {
	$this->image_1 = $image_1;
	return $this;
}

/**
* Get image_2 - Image
* @return Asset_Image
*/
public function getImage_2 () {
	$preValue = $this->preGetValue("image_2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_2;
	return $data;
}

/**
* Set image_2 - Image
* @param Asset_Image $image_2
* @return \Pimcore\Model\Object\News
*/
public function setImage_2 ($image_2) {
	$this->image_2 = $image_2;
	return $this;
}

/**
* Get image_3 - Image
* @return Asset_Image
*/
public function getImage_3 () {
	$preValue = $this->preGetValue("image_3"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_3;
	return $data;
}

/**
* Set image_3 - Image
* @param Asset_Image $image_3
* @return \Pimcore\Model\Object\News
*/
public function setImage_3 ($image_3) {
	$this->image_3 = $image_3;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

