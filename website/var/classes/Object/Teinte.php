<?php 

/** 
* Generated at: 2019-02-21T15:43:02+01:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 172.31.26.91


Fields Summary: 
- name [input]
- description [textarea]
- image [image]
- hexacolor [input]
- products_relation [nonownerobjects]
- teinte_type [select]
- product_type [select]
- product_ids_flat [textarea]
- configurableFields [input]
- mage_mediagallery [textarea]
- mage_tags [input]
- associatedArticles [objects]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Teinte\Listing getByName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByDescription ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByImage ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByHexacolor ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByTeinte_type ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByProduct_type ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByProduct_ids_flat ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByConfigurableFields ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByMage_mediagallery ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByMage_tags ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Teinte\Listing getByAssociatedArticles ($value, $limit = 0) 
*/

class Teinte extends Concrete {

public $o_classId = 13;
public $o_className = "teinte";
public $name;
public $description;
public $image;
public $hexacolor;
public $teinte_type;
public $product_type;
public $product_ids_flat;
public $configurableFields;
public $mage_mediagallery;
public $mage_tags;
public $associatedArticles;


/**
* @param array $values
* @return \Pimcore\Model\Object\Teinte
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get name - Nom
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name")->isEmpty($data)) {
		return $this->getValueFromParent("name");
	}
	return $data;
}

/**
* Set name - Nom
* @param string $name
* @return \Pimcore\Model\Object\Teinte
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get description - Description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("description")->isEmpty($data)) {
		return $this->getValueFromParent("description");
	}
	return $data;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Teinte
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get image - Image
* @return \Pimcore\Model\Asset\Image
*/
public function getImage () {
	$preValue = $this->preGetValue("image"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image")->isEmpty($data)) {
		return $this->getValueFromParent("image");
	}
	return $data;
}

/**
* Set image - Image
* @param \Pimcore\Model\Asset\Image $image
* @return \Pimcore\Model\Object\Teinte
*/
public function setImage ($image) {
	$this->image = $image;
	return $this;
}

/**
* Get hexacolor - Couleur Hexa (avec #)
* @return string
*/
public function getHexacolor () {
	$preValue = $this->preGetValue("hexacolor"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hexacolor;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hexacolor")->isEmpty($data)) {
		return $this->getValueFromParent("hexacolor");
	}
	return $data;
}

/**
* Set hexacolor - Couleur Hexa (avec #)
* @param string $hexacolor
* @return \Pimcore\Model\Object\Teinte
*/
public function setHexacolor ($hexacolor) {
	$this->hexacolor = $hexacolor;
	return $this;
}

/**
* Get teinte_type - Type de teinte
* @return string
*/
public function getTeinte_type () {
	$preValue = $this->preGetValue("teinte_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->teinte_type;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("teinte_type")->isEmpty($data)) {
		return $this->getValueFromParent("teinte_type");
	}
	return $data;
}

/**
* Set teinte_type - Type de teinte
* @param string $teinte_type
* @return \Pimcore\Model\Object\Teinte
*/
public function setTeinte_type ($teinte_type) {
	$this->teinte_type = $teinte_type;
	return $this;
}

/**
* Get product_type - Type de produit
* @return string
*/
public function getProduct_type () {
	$preValue = $this->preGetValue("product_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_type;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("product_type")->isEmpty($data)) {
		return $this->getValueFromParent("product_type");
	}
	return $data;
}

/**
* Set product_type - Type de produit
* @param string $product_type
* @return \Pimcore\Model\Object\Teinte
*/
public function setProduct_type ($product_type) {
	$this->product_type = $product_type;
	return $this;
}

/**
* Get product_ids_flat - product_ids_flat
* @return string
*/
public function getProduct_ids_flat () {
	$preValue = $this->preGetValue("product_ids_flat"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_ids_flat;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("product_ids_flat")->isEmpty($data)) {
		return $this->getValueFromParent("product_ids_flat");
	}
	return $data;
}

/**
* Set product_ids_flat - product_ids_flat
* @param string $product_ids_flat
* @return \Pimcore\Model\Object\Teinte
*/
public function setProduct_ids_flat ($product_ids_flat) {
	$this->product_ids_flat = $product_ids_flat;
	return $this;
}

/**
* Get configurableFields - configurableFields
* @return string
*/
public function getConfigurableFields () {
	$preValue = $this->preGetValue("configurableFields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->configurableFields;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("configurableFields")->isEmpty($data)) {
		return $this->getValueFromParent("configurableFields");
	}
	return $data;
}

/**
* Set configurableFields - configurableFields
* @param string $configurableFields
* @return \Pimcore\Model\Object\Teinte
*/
public function setConfigurableFields ($configurableFields) {
	$this->configurableFields = $configurableFields;
	return $this;
}

/**
* Get mage_mediagallery - mage_mediagallery
* @return string
*/
public function getMage_mediagallery () {
	$preValue = $this->preGetValue("mage_mediagallery"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_mediagallery;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_mediagallery")->isEmpty($data)) {
		return $this->getValueFromParent("mage_mediagallery");
	}
	return $data;
}

/**
* Set mage_mediagallery - mage_mediagallery
* @param string $mage_mediagallery
* @return \Pimcore\Model\Object\Teinte
*/
public function setMage_mediagallery ($mage_mediagallery) {
	$this->mage_mediagallery = $mage_mediagallery;
	return $this;
}

/**
* Get mage_tags - mage_tags
* @return string
*/
public function getMage_tags () {
	$preValue = $this->preGetValue("mage_tags"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_tags;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_tags")->isEmpty($data)) {
		return $this->getValueFromParent("mage_tags");
	}
	return $data;
}

/**
* Set mage_tags - mage_tags
* @param string $mage_tags
* @return \Pimcore\Model\Object\Teinte
*/
public function setMage_tags ($mage_tags) {
	$this->mage_tags = $mage_tags;
	return $this;
}

/**
* Get associatedArticles - Articles associés
* @return \Pimcore\Model\Object\article[]
*/
public function getAssociatedArticles () {
	$preValue = $this->preGetValue("associatedArticles"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("associatedArticles")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("associatedArticles")->isEmpty($data)) {
		return $this->getValueFromParent("associatedArticles");
	}
	return $data;
}

/**
* Set associatedArticles - Articles associés
* @param \Pimcore\Model\Object\article[] $associatedArticles
* @return \Pimcore\Model\Object\Teinte
*/
public function setAssociatedArticles ($associatedArticles) {
	$this->associatedArticles = $this->getClass()->getFieldDefinition("associatedArticles")->preSetData($this, $associatedArticles);
	return $this;
}

protected static $_relationFields = array (
  'associatedArticles' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = NULL;

}

