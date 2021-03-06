<?php 

/** Generated at 2016-07-26T10:22:15+02:00 */

/**
* Inheritance: yes
* Variants   : no
* Changed by : florent (6)
* IP:          92.154.6.232
*/


namespace Pimcore\Model\Object;



/**
* @method static \Pimcore\Model\Object\Article\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
*/

class Article extends Concrete {

public $o_classId = 7;
public $o_className = "article";
public $localizedfields;


/**
* @param array $values
* @return \Pimcore\Model\Object\Article
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
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
* Get content - Contenu
* @return string
*/
public function getContent ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("content", $language);
	$preValue = $this->preGetValue("content"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get documents - Documents
* @return \Pimcore\Model\Asset\document[] | \Pimcore\Model\Asset\image[]
*/
public function getDocuments ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("documents", $language);
	$preValue = $this->preGetValue("documents"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Set localizedfields - 
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\Article
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\Article
*/
public function setName ($name, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("name", $name, $language);
	return $this;
}

/**
* Set content - Contenu
* @param string $content
* @return \Pimcore\Model\Object\Article
*/
public function setContent ($content, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("content", $content, $language);
	return $this;
}

/**
* Set documents - Documents
* @param \Pimcore\Model\Asset\document[] | \Pimcore\Model\Asset\image[] $documents
* @return \Pimcore\Model\Object\Article
*/
public function setDocuments ($documents, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("documents", $documents, $language);
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

