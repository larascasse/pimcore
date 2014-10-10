<?php 

/** Generated at 2014-10-01T15:49:36+02:00 */

/**
* Inheritance: yes
* Variants   : no
* Changed by : florent (6)
* IP:          127.0.0.1
*/


class Object_Product extends Object_Concrete {

public $o_classId = 5;
public $o_className = "product";
public $code;
public $ean;
public $name_scienergie;
public $subtype;
public $name_scienergie_court;
public $name_scienergie_converti;
public $name_scienergie2;
public $name;
public $short_name;
public $price;
public $short_description;
public $mage_sub_description;
public $short_description_title;
public $description;
public $lesplus;
public $remarque;
public $echantillon;
public $no_stock_delay;
public $price_1;
public $price_2;
public $price_3;
public $price_4;
public $epaisseur;
public $epaisseur_not_configurable;
public $longueur;
public $longueur_not_configurable;
public $largeur;
public $largeur_not_configurable;
public $color;
public $color_not_configurable;
public $volume;
public $volume_not_configurable;
public $hauteur;
public $hauteur_not_configurable;
public $conditionnement;
public $nbrpp;
public $finition;
public $profil;
public $characteristics_others;
public $unite;
public $mode_calcul;
public $rendement;
public $famille;
public $qualite;
public $essence;
public $choix;
public $fixation;
public $classe;
public $epaisseurUsure;
public $extras;
public $chanfreins;
public $pieceHumide;
public $sousCoucheIntegree;
public $chauffantBasseTemperature;
public $chauffantAccumulationBasseTemperature;
public $solRaffraichissant;
public $country;
public $colisage;
public $typeLame;
public $country_of_manufacture;
public $pefc;
public $image_1;
public $image_2;
public $image_3;
public $gallery;
public $realisations;
public $fiche_technique_lpn;
public $fiche_technique_orginale;
public $re_skus;
public $cs_skus;
public $associatedArticles;
public $origineArticles;
public $meta_title;
public $meta_description;
public $meta_keywords;
public $accessoirepopin;
public $mage_accessoirepopin;
public $mage_short_name;
public $mage_lesplus;
public $mage_description;
public $characteristics;
public $mage_guideline;
public $image_1_src;
public $image_2_src;
public $image_3_src;
public $mage_fichepdf;
public $mage_invoice_description;
public $mage_realisations;
public $mage_config_description;
public $mage_re_skus;
public $mage_cs_skus;
public $mage_visibility;
public $mage_origine_arbre;


/**
* @param array $values
* @return Object_Product
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get code - Code Article
* @return string
*/
public function getCode () {
	$preValue = $this->preGetValue("code"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->code;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("code")->isEmpty($data)) {
		return $this->getValueFromParent("code");
	}
	return $data;
}

/**
* Set code - Code Article
* @param string $code
* @return Object_Product
*/
public function setCode ($code) {
	$this->code = $code;
	return $this;
}

/**
* Get ean - EAN
* @return string
*/
public function getEan () {
	$preValue = $this->preGetValue("ean"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->ean;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("ean")->isEmpty($data)) {
		return $this->getValueFromParent("ean");
	}
	return $data;
}

/**
* Set ean - EAN
* @param string $ean
* @return Object_Product
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* Get name_scienergie - Nom scienergie
* @return string
*/
public function getName_scienergie () {
	$preValue = $this->preGetValue("name_scienergie"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie");
	}
	return $data;
}

/**
* Set name_scienergie - Nom scienergie
* @param string $name_scienergie
* @return Object_Product
*/
public function setName_scienergie ($name_scienergie) {
	$this->name_scienergie = $name_scienergie;
	return $this;
}

/**
* Get subtype - Type
* @return string
*/
public function getSubtype () {
	$preValue = $this->preGetValue("subtype"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->subtype;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("subtype")->isEmpty($data)) {
		return $this->getValueFromParent("subtype");
	}
	return $data;
}

/**
* Set subtype - Type
* @param string $subtype
* @return Object_Product
*/
public function setSubtype ($subtype) {
	$this->subtype = $subtype;
	return $this;
}

/**
* Get name_scienergie_court - Nom scienergie Court
* @return string
*/
public function getName_scienergie_court () {
	$preValue = $this->preGetValue("name_scienergie_court"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie_court;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie_court")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie_court");
	}
	return $data;
}

/**
* Set name_scienergie_court - Nom scienergie Court
* @param string $name_scienergie_court
* @return Object_Product
*/
public function setName_scienergie_court ($name_scienergie_court) {
	$this->name_scienergie_court = $name_scienergie_court;
	return $this;
}

/**
* Get name_scienergie_converti - Nom scienergie Converti
* @return string
*/
public function getName_scienergie_converti () {
	$preValue = $this->preGetValue("name_scienergie_converti"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie_converti;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie_converti")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie_converti");
	}
	return $data;
}

/**
* Set name_scienergie_converti - Nom scienergie Converti
* @param string $name_scienergie_converti
* @return Object_Product
*/
public function setName_scienergie_converti ($name_scienergie_converti) {
	$this->name_scienergie_converti = $name_scienergie_converti;
	return $this;
}

/**
* Get name_scienergie2 - Nom scienergie 2
* @return string
*/
public function getName_scienergie2 () {
	$preValue = $this->preGetValue("name_scienergie2"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie2;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie2")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie2");
	}
	return $data;
}

/**
* Set name_scienergie2 - Nom scienergie 2
* @param string $name_scienergie2
* @return Object_Product
*/
public function setName_scienergie2 ($name_scienergie2) {
	$this->name_scienergie2 = $name_scienergie2;
	return $this;
}

/**
* Get name - Name
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name")->isEmpty($data)) {
		return $this->getValueFromParent("name");
	}
	return $data;
}

/**
* Set name - Name
* @param string $name
* @return Object_Product
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get short_name - Nom court
* @return string
*/
public function getShort_name () {
	$preValue = $this->preGetValue("short_name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->short_name;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("short_name")->isEmpty($data)) {
		return $this->getValueFromParent("short_name");
	}
	return $data;
}

/**
* Set short_name - Nom court
* @param string $short_name
* @return Object_Product
*/
public function setShort_name ($short_name) {
	$this->short_name = $short_name;
	return $this;
}

/**
* Get price - Prix Public HT
* @return string
*/
public function getPrice () {
	$preValue = $this->preGetValue("price"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price")->isEmpty($data)) {
		return $this->getValueFromParent("price");
	}
	return $data;
}

/**
* Set price - Prix Public HT
* @param string $price
* @return Object_Product
*/
public function setPrice ($price) {
	$this->price = $price;
	return $this;
}

/**
* Get short_description - Description courte
* @return string
*/
public function getShort_description () {
	$preValue = $this->preGetValue("short_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->short_description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("short_description")->isEmpty($data)) {
		return $this->getValueFromParent("short_description");
	}
	return $data;
}

/**
* Set short_description - Description courte
* @param string $short_description
* @return Object_Product
*/
public function setShort_description ($short_description) {
	$this->short_description = $short_description;
	return $this;
}

/**
* Get mage_sub_description - Sous description
* @return string
*/
public function getMage_sub_description () {
	$preValue = $this->preGetValue("mage_sub_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_sub_description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_sub_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_sub_description");
	}
	return $data;
}

/**
* Set mage_sub_description - Sous description
* @param string $mage_sub_description
* @return Object_Product
*/
public function setMage_sub_description ($mage_sub_description) {
	$this->mage_sub_description = $mage_sub_description;
	return $this;
}

/**
* Get short_description_title - Description titre
* @return string
*/
public function getShort_description_title () {
	$preValue = $this->preGetValue("short_description_title"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->short_description_title;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("short_description_title")->isEmpty($data)) {
		return $this->getValueFromParent("short_description_title");
	}
	return $data;
}

/**
* Set short_description_title - Description titre
* @param string $short_description_title
* @return Object_Product
*/
public function setShort_description_title ($short_description_title) {
	$this->short_description_title = $short_description_title;
	return $this;
}

/**
* Get description - Description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("description")->isEmpty($data)) {
		return $this->getValueFromParent("description");
	}
	return $data;
}

/**
* Set description - Description
* @param string $description
* @return Object_Product
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get lesplus - Les Plus
* @return string
*/
public function getLesplus () {
	$preValue = $this->preGetValue("lesplus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->lesplus;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("lesplus")->isEmpty($data)) {
		return $this->getValueFromParent("lesplus");
	}
	return $data;
}

/**
* Set lesplus - Les Plus
* @param string $lesplus
* @return Object_Product
*/
public function setLesplus ($lesplus) {
	$this->lesplus = $lesplus;
	return $this;
}

/**
* Get remarque - Remarque
* @return string
*/
public function getRemarque () {
	$preValue = $this->preGetValue("remarque"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->remarque;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("remarque")->isEmpty($data)) {
		return $this->getValueFromParent("remarque");
	}
	return $data;
}

/**
* Set remarque - Remarque
* @param string $remarque
* @return Object_Product
*/
public function setRemarque ($remarque) {
	$this->remarque = $remarque;
	return $this;
}

/**
* Get echantillon - Echantillon disponible ?
* @return boolean
*/
public function getEchantillon () {
	$preValue = $this->preGetValue("echantillon"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->echantillon;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("echantillon")->isEmpty($data)) {
		return $this->getValueFromParent("echantillon");
	}
	return $data;
}

/**
* Set echantillon - Echantillon disponible ?
* @param boolean $echantillon
* @return Object_Product
*/
public function setEchantillon ($echantillon) {
	$this->echantillon = $echantillon;
	return $this;
}

/**
* Get no_stock_delay - Délai de livraison
* @return string
*/
public function getNo_stock_delay () {
	$preValue = $this->preGetValue("no_stock_delay"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->no_stock_delay;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("no_stock_delay")->isEmpty($data)) {
		return $this->getValueFromParent("no_stock_delay");
	}
	return $data;
}

/**
* Set no_stock_delay - Délai de livraison
* @param string $no_stock_delay
* @return Object_Product
*/
public function setNo_stock_delay ($no_stock_delay) {
	$this->no_stock_delay = $no_stock_delay;
	return $this;
}

/**
* Get price_1 - Négoce (1)
* @return string
*/
public function getPrice_1 () {
	$preValue = $this->preGetValue("price_1"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_1;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_1")->isEmpty($data)) {
		return $this->getValueFromParent("price_1");
	}
	return $data;
}

/**
* Set price_1 - Négoce (1)
* @param string $price_1
* @return Object_Product
*/
public function setPrice_1 ($price_1) {
	$this->price_1 = $price_1;
	return $this;
}

/**
* Get price_2 - Gros poseur (2)
* @return string
*/
public function getPrice_2 () {
	$preValue = $this->preGetValue("price_2"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_2;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_2")->isEmpty($data)) {
		return $this->getValueFromParent("price_2");
	}
	return $data;
}

/**
* Set price_2 - Gros poseur (2)
* @param string $price_2
* @return Object_Product
*/
public function setPrice_2 ($price_2) {
	$this->price_2 = $price_2;
	return $this;
}

/**
* Get price_3 - Pro (3)
* @return string
*/
public function getPrice_3 () {
	$preValue = $this->preGetValue("price_3"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_3;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_3")->isEmpty($data)) {
		return $this->getValueFromParent("price_3");
	}
	return $data;
}

/**
* Set price_3 - Pro (3)
* @param string $price_3
* @return Object_Product
*/
public function setPrice_3 ($price_3) {
	$this->price_3 = $price_3;
	return $this;
}

/**
* Get price_4 - Public (4)
* @return string
*/
public function getPrice_4 () {
	$preValue = $this->preGetValue("price_4"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_4;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_4")->isEmpty($data)) {
		return $this->getValueFromParent("price_4");
	}
	return $data;
}

/**
* Set price_4 - Public (4)
* @param string $price_4
* @return Object_Product
*/
public function setPrice_4 ($price_4) {
	$this->price_4 = $price_4;
	return $this;
}

/**
* Get epaisseur - Epaisseur
* @return string
*/
public function getEpaisseur () {
	$preValue = $this->preGetValue("epaisseur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseur;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseur")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseur");
	}
	return $data;
}

/**
* Set epaisseur - Epaisseur
* @param string $epaisseur
* @return Object_Product
*/
public function setEpaisseur ($epaisseur) {
	$this->epaisseur = $epaisseur;
	return $this;
}

/**
* Get epaisseur_not_configurable - Epaisseur non configurable
* @return boolean
*/
public function getEpaisseur_not_configurable () {
	$preValue = $this->preGetValue("epaisseur_not_configurable"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseur_not_configurable;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseur_not_configurable");
	}
	return $data;
}

/**
* Set epaisseur_not_configurable - Epaisseur non configurable
* @param boolean $epaisseur_not_configurable
* @return Object_Product
*/
public function setEpaisseur_not_configurable ($epaisseur_not_configurable) {
	$this->epaisseur_not_configurable = $epaisseur_not_configurable;
	return $this;
}

/**
* Get longueur - Longueur
* @return string
*/
public function getLongueur () {
	$preValue = $this->preGetValue("longueur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur")->isEmpty($data)) {
		return $this->getValueFromParent("longueur");
	}
	return $data;
}

/**
* Set longueur - Longueur
* @param string $longueur
* @return Object_Product
*/
public function setLongueur ($longueur) {
	$this->longueur = $longueur;
	return $this;
}

/**
* Get longueur_not_configurable - Longueur non configurable
* @return boolean
*/
public function getLongueur_not_configurable () {
	$preValue = $this->preGetValue("longueur_not_configurable"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur_not_configurable;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("longueur_not_configurable");
	}
	return $data;
}

/**
* Set longueur_not_configurable - Longueur non configurable
* @param boolean $longueur_not_configurable
* @return Object_Product
*/
public function setLongueur_not_configurable ($longueur_not_configurable) {
	$this->longueur_not_configurable = $longueur_not_configurable;
	return $this;
}

/**
* Get largeur - Largeur
* @return string
*/
public function getLargeur () {
	$preValue = $this->preGetValue("largeur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur")->isEmpty($data)) {
		return $this->getValueFromParent("largeur");
	}
	return $data;
}

/**
* Set largeur - Largeur
* @param string $largeur
* @return Object_Product
*/
public function setLargeur ($largeur) {
	$this->largeur = $largeur;
	return $this;
}

/**
* Get largeur_not_configurable - Largeur non configurable
* @return boolean
*/
public function getLargeur_not_configurable () {
	$preValue = $this->preGetValue("largeur_not_configurable"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur_not_configurable;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("largeur_not_configurable");
	}
	return $data;
}

/**
* Set largeur_not_configurable - Largeur non configurable
* @param boolean $largeur_not_configurable
* @return Object_Product
*/
public function setLargeur_not_configurable ($largeur_not_configurable) {
	$this->largeur_not_configurable = $largeur_not_configurable;
	return $this;
}

/**
* Get color - Couleur / Teinte
* @return string
*/
public function getColor () {
	$preValue = $this->preGetValue("color"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->color;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("color")->isEmpty($data)) {
		return $this->getValueFromParent("color");
	}
	return $data;
}

/**
* Set color - Couleur / Teinte
* @param string $color
* @return Object_Product
*/
public function setColor ($color) {
	$this->color = $color;
	return $this;
}

/**
* Get color_not_configurable - Couleur non configurable
* @return boolean
*/
public function getColor_not_configurable () {
	$preValue = $this->preGetValue("color_not_configurable"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->color_not_configurable;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("color_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("color_not_configurable");
	}
	return $data;
}

/**
* Set color_not_configurable - Couleur non configurable
* @param boolean $color_not_configurable
* @return Object_Product
*/
public function setColor_not_configurable ($color_not_configurable) {
	$this->color_not_configurable = $color_not_configurable;
	return $this;
}

/**
* Get volume - Volume
* @return string
*/
public function getVolume () {
	$preValue = $this->preGetValue("volume"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->volume;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("volume")->isEmpty($data)) {
		return $this->getValueFromParent("volume");
	}
	return $data;
}

/**
* Set volume - Volume
* @param string $volume
* @return Object_Product
*/
public function setVolume ($volume) {
	$this->volume = $volume;
	return $this;
}

/**
* Get volume_not_configurable - Volume non configurable
* @return boolean
*/
public function getVolume_not_configurable () {
	$preValue = $this->preGetValue("volume_not_configurable"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->volume_not_configurable;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("volume_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("volume_not_configurable");
	}
	return $data;
}

/**
* Set volume_not_configurable - Volume non configurable
* @param boolean $volume_not_configurable
* @return Object_Product
*/
public function setVolume_not_configurable ($volume_not_configurable) {
	$this->volume_not_configurable = $volume_not_configurable;
	return $this;
}

/**
* Get hauteur - Hauteur / Rattrapage
* @return string
*/
public function getHauteur () {
	$preValue = $this->preGetValue("hauteur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hauteur;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hauteur")->isEmpty($data)) {
		return $this->getValueFromParent("hauteur");
	}
	return $data;
}

/**
* Set hauteur - Hauteur / Rattrapage
* @param string $hauteur
* @return Object_Product
*/
public function setHauteur ($hauteur) {
	$this->hauteur = $hauteur;
	return $this;
}

/**
* Get hauteur_not_configurable - Hauteur non configurable
* @return boolean
*/
public function getHauteur_not_configurable () {
	$preValue = $this->preGetValue("hauteur_not_configurable"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hauteur_not_configurable;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hauteur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("hauteur_not_configurable");
	}
	return $data;
}

/**
* Set hauteur_not_configurable - Hauteur non configurable
* @param boolean $hauteur_not_configurable
* @return Object_Product
*/
public function setHauteur_not_configurable ($hauteur_not_configurable) {
	$this->hauteur_not_configurable = $hauteur_not_configurable;
	return $this;
}

/**
* Get conditionnement - Conditionnement
* @return string
*/
public function getConditionnement () {
	$preValue = $this->preGetValue("conditionnement"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->conditionnement;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("conditionnement")->isEmpty($data)) {
		return $this->getValueFromParent("conditionnement");
	}
	return $data;
}

/**
* Set conditionnement - Conditionnement
* @param string $conditionnement
* @return Object_Product
*/
public function setConditionnement ($conditionnement) {
	$this->conditionnement = $conditionnement;
	return $this;
}

/**
* Get nbrpp - NBRPP
* @return string
*/
public function getNbrpp () {
	$preValue = $this->preGetValue("nbrpp"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->nbrpp;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("nbrpp")->isEmpty($data)) {
		return $this->getValueFromParent("nbrpp");
	}
	return $data;
}

/**
* Set nbrpp - NBRPP
* @param string $nbrpp
* @return Object_Product
*/
public function setNbrpp ($nbrpp) {
	$this->nbrpp = $nbrpp;
	return $this;
}

/**
* Get finition - Finition
* @return string
*/
public function getFinition () {
	$preValue = $this->preGetValue("finition"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->finition;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("finition")->isEmpty($data)) {
		return $this->getValueFromParent("finition");
	}
	return $data;
}

/**
* Set finition - Finition
* @param string $finition
* @return Object_Product
*/
public function setFinition ($finition) {
	$this->finition = $finition;
	return $this;
}

/**
* Get profil - Profil
* @return array
*/
public function getProfil () {
	$preValue = $this->preGetValue("profil"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->profil;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("profil")->isEmpty($data)) {
		return $this->getValueFromParent("profil");
	}
	return $data;
}

/**
* Set profil - Profil
* @param array $profil
* @return Object_Product
*/
public function setProfil ($profil) {
	$this->profil = $profil;
	return $this;
}

/**
* Get characteristics_others - Caractéristiques Autre
* @return string
*/
public function getCharacteristics_others () {
	$preValue = $this->preGetValue("characteristics_others"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->characteristics_others;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("characteristics_others")->isEmpty($data)) {
		return $this->getValueFromParent("characteristics_others");
	}
	return $data;
}

/**
* Set characteristics_others - Caractéristiques Autre
* @param string $characteristics_others
* @return Object_Product
*/
public function setCharacteristics_others ($characteristics_others) {
	$this->characteristics_others = $characteristics_others;
	return $this;
}

/**
* Get unite - Unité
* @return string
*/
public function getUnite () {
	$preValue = $this->preGetValue("unite"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->unite;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("unite")->isEmpty($data)) {
		return $this->getValueFromParent("unite");
	}
	return $data;
}

/**
* Set unite - Unité
* @param string $unite
* @return Object_Product
*/
public function setUnite ($unite) {
	$this->unite = $unite;
	return $this;
}

/**
* Get mode_calcul - Mode de caclul
* @return string
*/
public function getMode_calcul () {
	$preValue = $this->preGetValue("mode_calcul"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mode_calcul;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mode_calcul")->isEmpty($data)) {
		return $this->getValueFromParent("mode_calcul");
	}
	return $data;
}

/**
* Set mode_calcul - Mode de caclul
* @param string $mode_calcul
* @return Object_Product
*/
public function setMode_calcul ($mode_calcul) {
	$this->mode_calcul = $mode_calcul;
	return $this;
}

/**
* Get rendement - Rendement
* @return string
*/
public function getRendement () {
	$preValue = $this->preGetValue("rendement"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->rendement;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("rendement")->isEmpty($data)) {
		return $this->getValueFromParent("rendement");
	}
	return $data;
}

/**
* Set rendement - Rendement
* @param string $rendement
* @return Object_Product
*/
public function setRendement ($rendement) {
	$this->rendement = $rendement;
	return $this;
}

/**
* Get famille - Famille Article
* @return string
*/
public function getFamille () {
	$preValue = $this->preGetValue("famille"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->famille;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("famille")->isEmpty($data)) {
		return $this->getValueFromParent("famille");
	}
	return $data;
}

/**
* Set famille - Famille Article
* @param string $famille
* @return Object_Product
*/
public function setFamille ($famille) {
	$this->famille = $famille;
	return $this;
}

/**
* Get qualite - Qualité
* @return string
*/
public function getQualite () {
	$preValue = $this->preGetValue("qualite"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->qualite;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("qualite")->isEmpty($data)) {
		return $this->getValueFromParent("qualite");
	}
	return $data;
}

/**
* Set qualite - Qualité
* @param string $qualite
* @return Object_Product
*/
public function setQualite ($qualite) {
	$this->qualite = $qualite;
	return $this;
}

/**
* Get essence - Essence
* @return string
*/
public function getEssence () {
	$preValue = $this->preGetValue("essence"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->essence;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("essence")->isEmpty($data)) {
		return $this->getValueFromParent("essence");
	}
	return $data;
}

/**
* Set essence - Essence
* @param string $essence
* @return Object_Product
*/
public function setEssence ($essence) {
	$this->essence = $essence;
	return $this;
}

/**
* Get choix - Choix
* @return string
*/
public function getChoix () {
	$preValue = $this->preGetValue("choix"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->choix;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("choix")->isEmpty($data)) {
		return $this->getValueFromParent("choix");
	}
	return $data;
}

/**
* Set choix - Choix
* @param string $choix
* @return Object_Product
*/
public function setChoix ($choix) {
	$this->choix = $choix;
	return $this;
}

/**
* Get fixation - Type de pose / Fixation
* @return array
*/
public function getFixation () {
	$preValue = $this->preGetValue("fixation"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->fixation;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fixation")->isEmpty($data)) {
		return $this->getValueFromParent("fixation");
	}
	return $data;
}

/**
* Set fixation - Type de pose / Fixation
* @param array $fixation
* @return Object_Product
*/
public function setFixation ($fixation) {
	$this->fixation = $fixation;
	return $this;
}

/**
* Get classe - Classe
* @return string
*/
public function getClasse () {
	$preValue = $this->preGetValue("classe"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->classe;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("classe")->isEmpty($data)) {
		return $this->getValueFromParent("classe");
	}
	return $data;
}

/**
* Set classe - Classe
* @param string $classe
* @return Object_Product
*/
public function setClasse ($classe) {
	$this->classe = $classe;
	return $this;
}

/**
* Get epaisseurUsure - Epaisseur couche d'usure
* @return string
*/
public function getEpaisseurUsure () {
	$preValue = $this->preGetValue("epaisseurUsure"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseurUsure;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseurUsure")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseurUsure");
	}
	return $data;
}

/**
* Set epaisseurUsure - Epaisseur couche d'usure
* @param string $epaisseurUsure
* @return Object_Product
*/
public function setEpaisseurUsure ($epaisseurUsure) {
	$this->epaisseurUsure = $epaisseurUsure;
	return $this;
}

/**
* Get extras - Autre
* @return array
*/
public function getExtras () {
	$preValue = $this->preGetValue("extras"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("extras")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("extras")->isEmpty($data)) {
		return $this->getValueFromParent("extras");
	}
	return $data;
}

/**
* Set extras - Autre
* @param array $extras
* @return Object_Product
*/
public function setExtras ($extras) {
	$this->extras = $this->getClass()->getFieldDefinition("extras")->preSetData($this, $extras);
	return $this;
}

/**
* Get chanfreins - Chanfreins
* @return string
*/
public function getChanfreins () {
	$preValue = $this->preGetValue("chanfreins"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chanfreins;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chanfreins")->isEmpty($data)) {
		return $this->getValueFromParent("chanfreins");
	}
	return $data;
}

/**
* Set chanfreins - Chanfreins
* @param string $chanfreins
* @return Object_Product
*/
public function setChanfreins ($chanfreins) {
	$this->chanfreins = $chanfreins;
	return $this;
}

/**
* Get pieceHumide - Compatible pièces humides
* @return boolean
*/
public function getPieceHumide () {
	$preValue = $this->preGetValue("pieceHumide"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pieceHumide;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pieceHumide")->isEmpty($data)) {
		return $this->getValueFromParent("pieceHumide");
	}
	return $data;
}

/**
* Set pieceHumide - Compatible pièces humides
* @param boolean $pieceHumide
* @return Object_Product
*/
public function setPieceHumide ($pieceHumide) {
	$this->pieceHumide = $pieceHumide;
	return $this;
}

/**
* Get sousCoucheIntegree - Sous-couche intégrée
* @return boolean
*/
public function getSousCoucheIntegree () {
	$preValue = $this->preGetValue("sousCoucheIntegree"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->sousCoucheIntegree;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("sousCoucheIntegree")->isEmpty($data)) {
		return $this->getValueFromParent("sousCoucheIntegree");
	}
	return $data;
}

/**
* Set sousCoucheIntegree - Sous-couche intégrée
* @param boolean $sousCoucheIntegree
* @return Object_Product
*/
public function setSousCoucheIntegree ($sousCoucheIntegree) {
	$this->sousCoucheIntegree = $sousCoucheIntegree;
	return $this;
}

/**
* Get chauffantBasseTemperature - Compatible sol chauffant basse température
* @return boolean
*/
public function getChauffantBasseTemperature () {
	$preValue = $this->preGetValue("chauffantBasseTemperature"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chauffantBasseTemperature;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chauffantBasseTemperature")->isEmpty($data)) {
		return $this->getValueFromParent("chauffantBasseTemperature");
	}
	return $data;
}

/**
* Set chauffantBasseTemperature - Compatible sol chauffant basse température
* @param boolean $chauffantBasseTemperature
* @return Object_Product
*/
public function setChauffantBasseTemperature ($chauffantBasseTemperature) {
	$this->chauffantBasseTemperature = $chauffantBasseTemperature;
	return $this;
}

/**
* Get chauffantAccumulationBasseTemperature - à accumulation basse température
* @return boolean
*/
public function getChauffantAccumulationBasseTemperature () {
	$preValue = $this->preGetValue("chauffantAccumulationBasseTemperature"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chauffantAccumulationBasseTemperature;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chauffantAccumulationBasseTemperature")->isEmpty($data)) {
		return $this->getValueFromParent("chauffantAccumulationBasseTemperature");
	}
	return $data;
}

/**
* Set chauffantAccumulationBasseTemperature - à accumulation basse température
* @param boolean $chauffantAccumulationBasseTemperature
* @return Object_Product
*/
public function setChauffantAccumulationBasseTemperature ($chauffantAccumulationBasseTemperature) {
	$this->chauffantAccumulationBasseTemperature = $chauffantAccumulationBasseTemperature;
	return $this;
}

/**
* Get solRaffraichissant - Compatible sol rafraichissant
* @return boolean
*/
public function getSolRaffraichissant () {
	$preValue = $this->preGetValue("solRaffraichissant"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->solRaffraichissant;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("solRaffraichissant")->isEmpty($data)) {
		return $this->getValueFromParent("solRaffraichissant");
	}
	return $data;
}

/**
* Set solRaffraichissant - Compatible sol rafraichissant
* @param boolean $solRaffraichissant
* @return Object_Product
*/
public function setSolRaffraichissant ($solRaffraichissant) {
	$this->solRaffraichissant = $solRaffraichissant;
	return $this;
}

/**
* Get country - Pays de fabrication
* @return string
*/
public function getCountry () {
	$preValue = $this->preGetValue("country"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->country;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("country")->isEmpty($data)) {
		return $this->getValueFromParent("country");
	}
	return $data;
}

/**
* Set country - Pays de fabrication
* @param string $country
* @return Object_Product
*/
public function setCountry ($country) {
	$this->country = $country;
	return $this;
}

/**
* Get colisage - Colisage
* @return string
*/
public function getColisage () {
	$preValue = $this->preGetValue("colisage"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->colisage;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("colisage")->isEmpty($data)) {
		return $this->getValueFromParent("colisage");
	}
	return $data;
}

/**
* Set colisage - Colisage
* @param string $colisage
* @return Object_Product
*/
public function setColisage ($colisage) {
	$this->colisage = $colisage;
	return $this;
}

/**
* Get typeLame - Type de lame
* @return string
*/
public function getTypeLame () {
	$preValue = $this->preGetValue("typeLame"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->typeLame;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("typeLame")->isEmpty($data)) {
		return $this->getValueFromParent("typeLame");
	}
	return $data;
}

/**
* Set typeLame - Type de lame
* @param string $typeLame
* @return Object_Product
*/
public function setTypeLame ($typeLame) {
	$this->typeLame = $typeLame;
	return $this;
}

/**
* Get country_of_manufacture - Fabrication
* @return string
*/
public function getCountry_of_manufacture () {
	$preValue = $this->preGetValue("country_of_manufacture"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->country_of_manufacture;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("country_of_manufacture")->isEmpty($data)) {
		return $this->getValueFromParent("country_of_manufacture");
	}
	return $data;
}

/**
* Set country_of_manufacture - Fabrication
* @param string $country_of_manufacture
* @return Object_Product
*/
public function setCountry_of_manufacture ($country_of_manufacture) {
	$this->country_of_manufacture = $country_of_manufacture;
	return $this;
}

/**
* Get pefc - Pefc
* @return boolean
*/
public function getPefc () {
	$preValue = $this->preGetValue("pefc"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pefc;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pefc")->isEmpty($data)) {
		return $this->getValueFromParent("pefc");
	}
	return $data;
}

/**
* Set pefc - Pefc
* @param boolean $pefc
* @return Object_Product
*/
public function setPefc ($pefc) {
	$this->pefc = $pefc;
	return $this;
}

/**
* Get image_1 - Base Image
* @return Asset_Image
*/
public function getImage_1 () {
	$preValue = $this->preGetValue("image_1"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_1;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_1")->isEmpty($data)) {
		return $this->getValueFromParent("image_1");
	}
	return $data;
}

/**
* Set image_1 - Base Image
* @param Asset_Image $image_1
* @return Object_Product
*/
public function setImage_1 ($image_1) {
	$this->image_1 = $image_1;
	return $this;
}

/**
* Get image_2 - Small Image
* @return Asset_Image
*/
public function getImage_2 () {
	$preValue = $this->preGetValue("image_2"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_2;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_2")->isEmpty($data)) {
		return $this->getValueFromParent("image_2");
	}
	return $data;
}

/**
* Set image_2 - Small Image
* @param Asset_Image $image_2
* @return Object_Product
*/
public function setImage_2 ($image_2) {
	$this->image_2 = $image_2;
	return $this;
}

/**
* Get image_3 - Thumbnail Image
* @return Asset_Image
*/
public function getImage_3 () {
	$preValue = $this->preGetValue("image_3"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_3;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_3")->isEmpty($data)) {
		return $this->getValueFromParent("image_3");
	}
	return $data;
}

/**
* Set image_3 - Thumbnail Image
* @param Asset_Image $image_3
* @return Object_Product
*/
public function setImage_3 ($image_3) {
	$this->image_3 = $image_3;
	return $this;
}

/**
* Get gallery - Autres Images pour la galerie
* @return array
*/
public function getGallery () {
	$preValue = $this->preGetValue("gallery"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("gallery")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("gallery")->isEmpty($data)) {
		return $this->getValueFromParent("gallery");
	}
	return $data;
}

/**
* Set gallery - Autres Images pour la galerie
* @param array $gallery
* @return Object_Product
*/
public function setGallery ($gallery) {
	$this->gallery = $this->getClass()->getFieldDefinition("gallery")->preSetData($this, $gallery);
	return $this;
}

/**
* Get realisations - Réalisations (Gallery)
* @return array
*/
public function getRealisations () {
	$preValue = $this->preGetValue("realisations"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("realisations")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("realisations")->isEmpty($data)) {
		return $this->getValueFromParent("realisations");
	}
	return $data;
}

/**
* Set realisations - Réalisations (Gallery)
* @param array $realisations
* @return Object_Product
*/
public function setRealisations ($realisations) {
	$this->realisations = $this->getClass()->getFieldDefinition("realisations")->preSetData($this, $realisations);
	return $this;
}

/**
* Get fiche_technique_lpn - Fiche technique LPN
* @return Document_Page | Document_Snippet | Document | Asset | Object_Abstract
*/
public function getFiche_technique_lpn () {
	$preValue = $this->preGetValue("fiche_technique_lpn"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_technique_lpn")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_technique_lpn")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_technique_lpn");
	}
	return $data;
}

/**
* Set fiche_technique_lpn - Fiche technique LPN
* @param Document_Page | Document_Snippet | Document | Asset | Object_Abstract $fiche_technique_lpn
* @return Object_Product
*/
public function setFiche_technique_lpn ($fiche_technique_lpn) {
	$this->fiche_technique_lpn = $this->getClass()->getFieldDefinition("fiche_technique_lpn")->preSetData($this, $fiche_technique_lpn);
	return $this;
}

/**
* Get fiche_technique_orginale - Fiche technique originale
* @return Document_Page | Document_Snippet | Document | Asset | Object_Abstract
*/
public function getFiche_technique_orginale () {
	$preValue = $this->preGetValue("fiche_technique_orginale"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_technique_orginale")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_technique_orginale")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_technique_orginale");
	}
	return $data;
}

/**
* Set fiche_technique_orginale - Fiche technique originale
* @param Document_Page | Document_Snippet | Document | Asset | Object_Abstract $fiche_technique_orginale
* @return Object_Product
*/
public function setFiche_technique_orginale ($fiche_technique_orginale) {
	$this->fiche_technique_orginale = $this->getClass()->getFieldDefinition("fiche_technique_orginale")->preSetData($this, $fiche_technique_orginale);
	return $this;
}

/**
* Get re_skus - Produits associés
* @return array
*/
public function getRe_skus () {
	$preValue = $this->preGetValue("re_skus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("re_skus")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("re_skus")->isEmpty($data)) {
		return $this->getValueFromParent("re_skus");
	}
	return $data;
}

/**
* Set re_skus - Produits associés
* @param array $re_skus
* @return Object_Product
*/
public function setRe_skus ($re_skus) {
	$this->re_skus = $this->getClass()->getFieldDefinition("re_skus")->preSetData($this, $re_skus);
	return $this;
}

/**
* Get cs_skus - Crossels (tarif)
* @return array
*/
public function getCs_skus () {
	$preValue = $this->preGetValue("cs_skus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("cs_skus")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("cs_skus")->isEmpty($data)) {
		return $this->getValueFromParent("cs_skus");
	}
	return $data;
}

/**
* Set cs_skus - Crossels (tarif)
* @param array $cs_skus
* @return Object_Product
*/
public function setCs_skus ($cs_skus) {
	$this->cs_skus = $this->getClass()->getFieldDefinition("cs_skus")->preSetData($this, $cs_skus);
	return $this;
}

/**
* Get associatedArticles - Articles associés
* @return array
*/
public function getAssociatedArticles () {
	$preValue = $this->preGetValue("associatedArticles"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("associatedArticles")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("associatedArticles")->isEmpty($data)) {
		return $this->getValueFromParent("associatedArticles");
	}
	return $data;
}

/**
* Set associatedArticles - Articles associés
* @param array $associatedArticles
* @return Object_Product
*/
public function setAssociatedArticles ($associatedArticles) {
	$this->associatedArticles = $this->getClass()->getFieldDefinition("associatedArticles")->preSetData($this, $associatedArticles);
	return $this;
}

/**
* Get origineArticles - Articles associés (Origine)
* @return array
*/
public function getOrigineArticles () {
	$preValue = $this->preGetValue("origineArticles"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("origineArticles")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("origineArticles")->isEmpty($data)) {
		return $this->getValueFromParent("origineArticles");
	}
	return $data;
}

/**
* Set origineArticles - Articles associés (Origine)
* @param array $origineArticles
* @return Object_Product
*/
public function setOrigineArticles ($origineArticles) {
	$this->origineArticles = $this->getClass()->getFieldDefinition("origineArticles")->preSetData($this, $origineArticles);
	return $this;
}

/**
* Get meta_title - Métas Title
* @return string
*/
public function getMeta_title () {
	$preValue = $this->preGetValue("meta_title"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_title;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_title")->isEmpty($data)) {
		return $this->getValueFromParent("meta_title");
	}
	return $data;
}

/**
* Set meta_title - Métas Title
* @param string $meta_title
* @return Object_Product
*/
public function setMeta_title ($meta_title) {
	$this->meta_title = $meta_title;
	return $this;
}

/**
* Get meta_description - Meta Descriptions
* @return string
*/
public function getMeta_description () {
	$preValue = $this->preGetValue("meta_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_description")->isEmpty($data)) {
		return $this->getValueFromParent("meta_description");
	}
	return $data;
}

/**
* Set meta_description - Meta Descriptions
* @param string $meta_description
* @return Object_Product
*/
public function setMeta_description ($meta_description) {
	$this->meta_description = $meta_description;
	return $this;
}

/**
* Get meta_keywords - Meta Keywords
* @return string
*/
public function getMeta_keywords () {
	$preValue = $this->preGetValue("meta_keywords"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_keywords;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_keywords")->isEmpty($data)) {
		return $this->getValueFromParent("meta_keywords");
	}
	return $data;
}

/**
* Set meta_keywords - Meta Keywords
* @param string $meta_keywords
* @return Object_Product
*/
public function setMeta_keywords ($meta_keywords) {
	$this->meta_keywords = $meta_keywords;
	return $this;
}

/**
* Get accessoirepopin - Checkout Products
* @return array
*/
public function getAccessoirepopin () {
	$preValue = $this->preGetValue("accessoirepopin"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("accessoirepopin")->preGetData($this);
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("accessoirepopin")->isEmpty($data)) {
		return $this->getValueFromParent("accessoirepopin");
	}
	return $data;
}

/**
* Set accessoirepopin - Checkout Products
* @param array $accessoirepopin
* @return Object_Product
*/
public function setAccessoirepopin ($accessoirepopin) {
	$this->accessoirepopin = $this->getClass()->getFieldDefinition("accessoirepopin")->preSetData($this, $accessoirepopin);
	return $this;
}

/**
* Get mage_accessoirepopin - Magento Product Checkout
* @return string
*/
public function getMage_accessoirepopin () {
	$preValue = $this->preGetValue("mage_accessoirepopin"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_accessoirepopin;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_accessoirepopin")->isEmpty($data)) {
		return $this->getValueFromParent("mage_accessoirepopin");
	}
	return $data;
}

/**
* Set mage_accessoirepopin - Magento Product Checkout
* @param string $mage_accessoirepopin
* @return Object_Product
*/
public function setMage_accessoirepopin ($mage_accessoirepopin) {
	$this->mage_accessoirepopin = $mage_accessoirepopin;
	return $this;
}

/**
* Get mage_short_name - Nom court Magento
* @return string
*/
public function getMage_short_name () {
	$preValue = $this->preGetValue("mage_short_name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_short_name;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_short_name")->isEmpty($data)) {
		return $this->getValueFromParent("mage_short_name");
	}
	return $data;
}

/**
* Set mage_short_name - Nom court Magento
* @param string $mage_short_name
* @return Object_Product
*/
public function setMage_short_name ($mage_short_name) {
	$this->mage_short_name = $mage_short_name;
	return $this;
}

/**
* Get mage_lesplus - Les Plus 
* @return string
*/
public function getMage_lesplus () {
	$preValue = $this->preGetValue("mage_lesplus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_lesplus;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_lesplus")->isEmpty($data)) {
		return $this->getValueFromParent("mage_lesplus");
	}
	return $data;
}

/**
* Set mage_lesplus - Les Plus 
* @param string $mage_lesplus
* @return Object_Product
*/
public function setMage_lesplus ($mage_lesplus) {
	$this->mage_lesplus = $mage_lesplus;
	return $this;
}

/**
* Get mage_description - Description Magento
* @return string
*/
public function getMage_description () {
	$preValue = $this->preGetValue("mage_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_description");
	}
	return $data;
}

/**
* Set mage_description - Description Magento
* @param string $mage_description
* @return Object_Product
*/
public function setMage_description ($mage_description) {
	$this->mage_description = $mage_description;
	return $this;
}

/**
* Get characteristics - Characteristics
* @return string
*/
public function getCharacteristics () {
	$preValue = $this->preGetValue("characteristics"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->characteristics;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("characteristics")->isEmpty($data)) {
		return $this->getValueFromParent("characteristics");
	}
	return $data;
}

/**
* Set characteristics - Characteristics
* @param string $characteristics
* @return Object_Product
*/
public function setCharacteristics ($characteristics) {
	$this->characteristics = $characteristics;
	return $this;
}

/**
* Get mage_guideline - Guidelines
* @return string
*/
public function getMage_guideline () {
	$preValue = $this->preGetValue("mage_guideline"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_guideline;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_guideline")->isEmpty($data)) {
		return $this->getValueFromParent("mage_guideline");
	}
	return $data;
}

/**
* Set mage_guideline - Guidelines
* @param string $mage_guideline
* @return Object_Product
*/
public function setMage_guideline ($mage_guideline) {
	$this->mage_guideline = $mage_guideline;
	return $this;
}

/**
* Get image_1_src - Image 1 src
* @return string
*/
public function getImage_1_src () {
	$preValue = $this->preGetValue("image_1_src"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_1_src;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_1_src")->isEmpty($data)) {
		return $this->getValueFromParent("image_1_src");
	}
	return $data;
}

/**
* Set image_1_src - Image 1 src
* @param string $image_1_src
* @return Object_Product
*/
public function setImage_1_src ($image_1_src) {
	$this->image_1_src = $image_1_src;
	return $this;
}

/**
* Get image_2_src - Image 2 src
* @return string
*/
public function getImage_2_src () {
	$preValue = $this->preGetValue("image_2_src"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_2_src;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_2_src")->isEmpty($data)) {
		return $this->getValueFromParent("image_2_src");
	}
	return $data;
}

/**
* Set image_2_src - Image 2 src
* @param string $image_2_src
* @return Object_Product
*/
public function setImage_2_src ($image_2_src) {
	$this->image_2_src = $image_2_src;
	return $this;
}

/**
* Get image_3_src - Image 3 src
* @return string
*/
public function getImage_3_src () {
	$preValue = $this->preGetValue("image_3_src"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_3_src;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_3_src")->isEmpty($data)) {
		return $this->getValueFromParent("image_3_src");
	}
	return $data;
}

/**
* Set image_3_src - Image 3 src
* @param string $image_3_src
* @return Object_Product
*/
public function setImage_3_src ($image_3_src) {
	$this->image_3_src = $image_3_src;
	return $this;
}

/**
* Get mage_fichepdf - Fiche PDF
* @return string
*/
public function getMage_fichepdf () {
	$preValue = $this->preGetValue("mage_fichepdf"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_fichepdf;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_fichepdf")->isEmpty($data)) {
		return $this->getValueFromParent("mage_fichepdf");
	}
	return $data;
}

/**
* Set mage_fichepdf - Fiche PDF
* @param string $mage_fichepdf
* @return Object_Product
*/
public function setMage_fichepdf ($mage_fichepdf) {
	$this->mage_fichepdf = $mage_fichepdf;
	return $this;
}

/**
* Get mage_invoice_description - Description pour facture
* @return string
*/
public function getMage_invoice_description () {
	$preValue = $this->preGetValue("mage_invoice_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_invoice_description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_invoice_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_invoice_description");
	}
	return $data;
}

/**
* Set mage_invoice_description - Description pour facture
* @param string $mage_invoice_description
* @return Object_Product
*/
public function setMage_invoice_description ($mage_invoice_description) {
	$this->mage_invoice_description = $mage_invoice_description;
	return $this;
}

/**
* Get mage_realisations - Réalisations
* @return string
*/
public function getMage_realisations () {
	$preValue = $this->preGetValue("mage_realisations"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_realisations;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_realisations")->isEmpty($data)) {
		return $this->getValueFromParent("mage_realisations");
	}
	return $data;
}

/**
* Set mage_realisations - Réalisations
* @param string $mage_realisations
* @return Object_Product
*/
public function setMage_realisations ($mage_realisations) {
	$this->mage_realisations = $mage_realisations;
	return $this;
}

/**
* Get mage_config_description - Description Pour configurateur
* @return string
*/
public function getMage_config_description () {
	$preValue = $this->preGetValue("mage_config_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_config_description;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_config_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_config_description");
	}
	return $data;
}

/**
* Set mage_config_description - Description Pour configurateur
* @param string $mage_config_description
* @return Object_Product
*/
public function setMage_config_description ($mage_config_description) {
	$this->mage_config_description = $mage_config_description;
	return $this;
}

/**
* Get mage_re_skus - Related SKUS
* @return string
*/
public function getMage_re_skus () {
	$preValue = $this->preGetValue("mage_re_skus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_re_skus;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_re_skus")->isEmpty($data)) {
		return $this->getValueFromParent("mage_re_skus");
	}
	return $data;
}

/**
* Set mage_re_skus - Related SKUS
* @param string $mage_re_skus
* @return Object_Product
*/
public function setMage_re_skus ($mage_re_skus) {
	$this->mage_re_skus = $mage_re_skus;
	return $this;
}

/**
* Get mage_cs_skus - Crossels SKUS
* @return string
*/
public function getMage_cs_skus () {
	$preValue = $this->preGetValue("mage_cs_skus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_cs_skus;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_cs_skus")->isEmpty($data)) {
		return $this->getValueFromParent("mage_cs_skus");
	}
	return $data;
}

/**
* Set mage_cs_skus - Crossels SKUS
* @param string $mage_cs_skus
* @return Object_Product
*/
public function setMage_cs_skus ($mage_cs_skus) {
	$this->mage_cs_skus = $mage_cs_skus;
	return $this;
}

/**
* Get mage_visibility - mage_visibility
* @return string
*/
public function getMage_visibility () {
	$preValue = $this->preGetValue("mage_visibility"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_visibility;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_visibility")->isEmpty($data)) {
		return $this->getValueFromParent("mage_visibility");
	}
	return $data;
}

/**
* Set mage_visibility - mage_visibility
* @param string $mage_visibility
* @return Object_Product
*/
public function setMage_visibility ($mage_visibility) {
	$this->mage_visibility = $mage_visibility;
	return $this;
}

/**
* Get mage_origine_arbre - Origine Arbre
* @return string
*/
public function getMage_origine_arbre () {
	$preValue = $this->preGetValue("mage_origine_arbre"); 
	if($preValue !== null && !Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_origine_arbre;
	if(Object_Abstract::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_origine_arbre")->isEmpty($data)) {
		return $this->getValueFromParent("mage_origine_arbre");
	}
	return $data;
}

/**
* Set mage_origine_arbre - Origine Arbre
* @param string $mage_origine_arbre
* @return Object_Product
*/
public function setMage_origine_arbre ($mage_origine_arbre) {
	$this->mage_origine_arbre = $mage_origine_arbre;
	return $this;
}

protected static $_relationFields = array (
  'extras' => 
  array (
    'type' => 'objects',
  ),
  'gallery' => 
  array (
    'type' => 'multihref',
  ),
  'realisations' => 
  array (
    'type' => 'multihref',
  ),
  'fiche_technique_lpn' => 
  array (
    'type' => 'href',
  ),
  'fiche_technique_orginale' => 
  array (
    'type' => 'href',
  ),
  're_skus' => 
  array (
    'type' => 'objects',
  ),
  'cs_skus' => 
  array (
    'type' => 'objects',
  ),
  'associatedArticles' => 
  array (
    'type' => 'objects',
  ),
  'origineArticles' => 
  array (
    'type' => 'objects',
  ),
  'accessoirepopin' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = NULL;

}

