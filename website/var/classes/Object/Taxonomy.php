<?php 

/** 
* Generated at: 2018-10-31T12:38:48+01:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.20.64


Fields Summary: 
- code [input]
- label [input]
- label_scienergie [input]
- logo [image]
- localizedfields [localizedfields]
-- description [textarea]
-- editorial [textarea]
-- help [textarea]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Taxonomy\Listing getByCode ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Taxonomy\Listing getByLabel ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Taxonomy\Listing getByLabel_scienergie ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Taxonomy\Listing getByLogo ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Taxonomy\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
*/

class Taxonomy extends Concrete {

public $o_classId = 6;
public $o_className = "taxonomy";
public $code;
public $label;
public $label_scienergie;
public $logo;
public $localizedfields;


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

/**
* Get label_scienergie - Label (Scienergie)
* @return string
*/
public function getLabel_scienergie () {
	$preValue = $this->preGetValue("label_scienergie"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->label_scienergie;
	return $data;
}

/**
* Set label_scienergie - Label (Scienergie)
* @param string $label_scienergie
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setLabel_scienergie ($label_scienergie) {
	$this->label_scienergie = $label_scienergie;
	return $this;
}

/**
* Get logo - Logo
* @return \Pimcore\Model\Asset\Image
*/
public function getLogo () {
	$preValue = $this->preGetValue("logo"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->logo;
	return $data;
}

/**
* Set logo - Logo
* @param \Pimcore\Model\Asset\Image $logo
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setLogo ($logo) {
	$this->logo = $logo;
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
	return $data;
}

/**
* Get description - Contenu FT
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
* Get editorial - Contenu Fiche produit
* @return string
*/
public function getEditorial ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("editorial", $language);
	$preValue = $this->preGetValue("editorial"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get help - Contenu Aide
* @return string
*/
public function getHelp ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("help", $language);
	$preValue = $this->preGetValue("help"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Set localizedfields - 
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set description - Contenu FT
* @param string $description
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setDescription ($description, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("description", $description, $language);
	return $this;
}

/**
* Set editorial - Contenu Fiche produit
* @param string $editorial
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setEditorial ($editorial, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("editorial", $editorial, $language);
	return $this;
}

/**
* Set help - Contenu Aide
* @param string $help
* @return \Pimcore\Model\Object\Taxonomy
*/
public function setHelp ($help, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("help", $help, $language);
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

