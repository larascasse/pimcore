<?php 

class Object_Product extends Object_Concrete {

public $o_classId = 5;
public $o_className = "product";
public $code;
public $subtype;
public $name_scienergie;
public $name_scienergie2;
public $name;
public $short_name;
public $ean;
public $price;
public $short_description;
public $short_description_title;
public $description;
public $lesplus;
public $remarque;
public $echantillon;
public $epaisseur;
public $longueur;
public $largeur;
public $color;
public $volume;
public $hauteur;
public $conditionnement;
public $finition;
public $characteristics_others;
public $nbrpp;
public $unite;
public $rendement;
public $famille;
public $qualite;
public $essence;
public $choix;
public $fixation;
public $profil;
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
public $image_1;
public $image_2;
public $image_3;
public $realisations;
public $fiche_technique_lpn;
public $fiche_technique_orginale;
public $relatedProducts;
public $relatedAccessories;
public $associatedArticles;
public $meta_title;
public $meta_description;
public $meta_keywords;
public $mage_short_name;
public $mage_sub_description;
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


/**
* @param array $values
* @return Object_Product
*/
public static function create($values = array()) {
	$object = new self();
	$object->setValues($values);
	return $object;
}

/**
* @return string
*/
public function getCode () {
	$preValue = $this->preGetValue("code"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->code;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("code");}
	 return $data;
}

/**
* @param string $code
* @return void
*/
public function setCode ($code) {
	$this->code = $code;
	return $this;
}

/**
* @return string
*/
public function getSubtype () {
	$preValue = $this->preGetValue("subtype"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->subtype;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("subtype");}
	 return $data;
}

/**
* @param string $subtype
* @return void
*/
public function setSubtype ($subtype) {
	$this->subtype = $subtype;
	return $this;
}

/**
* @return string
*/
public function getName_scienergie () {
	$preValue = $this->preGetValue("name_scienergie"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->name_scienergie;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("name_scienergie");}
	 return $data;
}

/**
* @param string $name_scienergie
* @return void
*/
public function setName_scienergie ($name_scienergie) {
	$this->name_scienergie = $name_scienergie;
	return $this;
}

/**
* @return string
*/
public function getName_scienergie2 () {
	$preValue = $this->preGetValue("name_scienergie2"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->name_scienergie2;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("name_scienergie2");}
	 return $data;
}

/**
* @param string $name_scienergie2
* @return void
*/
public function setName_scienergie2 ($name_scienergie2) {
	$this->name_scienergie2 = $name_scienergie2;
	return $this;
}

/**
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->name;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("name");}
	 return $data;
}

/**
* @param string $name
* @return void
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* @return string
*/
public function getShort_name () {
	$preValue = $this->preGetValue("short_name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->short_name;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("short_name");}
	 return $data;
}

/**
* @param string $short_name
* @return void
*/
public function setShort_name ($short_name) {
	$this->short_name = $short_name;
	return $this;
}

/**
* @return string
*/
public function getEan () {
	$preValue = $this->preGetValue("ean"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->ean;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("ean");}
	 return $data;
}

/**
* @param string $ean
* @return void
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* @return string
*/
public function getPrice () {
	$preValue = $this->preGetValue("price"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->price;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("price");}
	 return $data;
}

/**
* @param string $price
* @return void
*/
public function setPrice ($price) {
	$this->price = $price;
	return $this;
}

/**
* @return string
*/
public function getShort_description () {
	$preValue = $this->preGetValue("short_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->short_description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("short_description");}
	 return $data;
}

/**
* @param string $short_description
* @return void
*/
public function setShort_description ($short_description) {
	$this->short_description = $short_description;
	return $this;
}

/**
* @return string
*/
public function getShort_description_title () {
	$preValue = $this->preGetValue("short_description_title"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->short_description_title;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("short_description_title");}
	 return $data;
}

/**
* @param string $short_description_title
* @return void
*/
public function setShort_description_title ($short_description_title) {
	$this->short_description_title = $short_description_title;
	return $this;
}

/**
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("description");}
	 return $data;
}

/**
* @param string $description
* @return void
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* @return string
*/
public function getLesplus () {
	$preValue = $this->preGetValue("lesplus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->lesplus;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("lesplus");}
	 return $data;
}

/**
* @param string $lesplus
* @return void
*/
public function setLesplus ($lesplus) {
	$this->lesplus = $lesplus;
	return $this;
}

/**
* @return string
*/
public function getRemarque () {
	$preValue = $this->preGetValue("remarque"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->remarque;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("remarque");}
	 return $data;
}

/**
* @param string $remarque
* @return void
*/
public function setRemarque ($remarque) {
	$this->remarque = $remarque;
	return $this;
}

/**
* @return boolean
*/
public function getEchantillon () {
	$preValue = $this->preGetValue("echantillon"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->echantillon;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("echantillon");}
	 return $data;
}

/**
* @param boolean $echantillon
* @return void
*/
public function setEchantillon ($echantillon) {
	$this->echantillon = $echantillon;
	return $this;
}

/**
* @return string
*/
public function getEpaisseur () {
	$preValue = $this->preGetValue("epaisseur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->epaisseur;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("epaisseur");}
	 return $data;
}

/**
* @param string $epaisseur
* @return void
*/
public function setEpaisseur ($epaisseur) {
	$this->epaisseur = $epaisseur;
	return $this;
}

/**
* @return string
*/
public function getLongueur () {
	$preValue = $this->preGetValue("longueur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->longueur;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("longueur");}
	 return $data;
}

/**
* @param string $longueur
* @return void
*/
public function setLongueur ($longueur) {
	$this->longueur = $longueur;
	return $this;
}

/**
* @return string
*/
public function getLargeur () {
	$preValue = $this->preGetValue("largeur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->largeur;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("largeur");}
	 return $data;
}

/**
* @param string $largeur
* @return void
*/
public function setLargeur ($largeur) {
	$this->largeur = $largeur;
	return $this;
}

/**
* @return string
*/
public function getColor () {
	$preValue = $this->preGetValue("color"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->color;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("color");}
	 return $data;
}

/**
* @param string $color
* @return void
*/
public function setColor ($color) {
	$this->color = $color;
	return $this;
}

/**
* @return string
*/
public function getVolume () {
	$preValue = $this->preGetValue("volume"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->volume;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("volume");}
	 return $data;
}

/**
* @param string $volume
* @return void
*/
public function setVolume ($volume) {
	$this->volume = $volume;
	return $this;
}

/**
* @return string
*/
public function getHauteur () {
	$preValue = $this->preGetValue("hauteur"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->hauteur;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("hauteur");}
	 return $data;
}

/**
* @param string $hauteur
* @return void
*/
public function setHauteur ($hauteur) {
	$this->hauteur = $hauteur;
	return $this;
}

/**
* @return string
*/
public function getConditionnement () {
	$preValue = $this->preGetValue("conditionnement"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->conditionnement;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("conditionnement");}
	 return $data;
}

/**
* @param string $conditionnement
* @return void
*/
public function setConditionnement ($conditionnement) {
	$this->conditionnement = $conditionnement;
	return $this;
}

/**
* @return string
*/
public function getFinition () {
	$preValue = $this->preGetValue("finition"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->finition;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("finition");}
	 return $data;
}

/**
* @param string $finition
* @return void
*/
public function setFinition ($finition) {
	$this->finition = $finition;
	return $this;
}

/**
* @return string
*/
public function getCharacteristics_others () {
	$preValue = $this->preGetValue("characteristics_others"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->characteristics_others;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("characteristics_others");}
	 return $data;
}

/**
* @param string $characteristics_others
* @return void
*/
public function setCharacteristics_others ($characteristics_others) {
	$this->characteristics_others = $characteristics_others;
	return $this;
}

/**
* @return string
*/
public function getNbrpp () {
	$preValue = $this->preGetValue("nbrpp"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->nbrpp;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("nbrpp");}
	 return $data;
}

/**
* @param string $nbrpp
* @return void
*/
public function setNbrpp ($nbrpp) {
	$this->nbrpp = $nbrpp;
	return $this;
}

/**
* @return string
*/
public function getUnite () {
	$preValue = $this->preGetValue("unite"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->unite;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("unite");}
	 return $data;
}

/**
* @param string $unite
* @return void
*/
public function setUnite ($unite) {
	$this->unite = $unite;
	return $this;
}

/**
* @return string
*/
public function getRendement () {
	$preValue = $this->preGetValue("rendement"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->rendement;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("rendement");}
	 return $data;
}

/**
* @param string $rendement
* @return void
*/
public function setRendement ($rendement) {
	$this->rendement = $rendement;
	return $this;
}

/**
* @return string
*/
public function getFamille () {
	$preValue = $this->preGetValue("famille"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->famille;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("famille");}
	 return $data;
}

/**
* @param string $famille
* @return void
*/
public function setFamille ($famille) {
	$this->famille = $famille;
	return $this;
}

/**
* @return string
*/
public function getQualite () {
	$preValue = $this->preGetValue("qualite"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->qualite;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("qualite");}
	 return $data;
}

/**
* @param string $qualite
* @return void
*/
public function setQualite ($qualite) {
	$this->qualite = $qualite;
	return $this;
}

/**
* @return string
*/
public function getEssence () {
	$preValue = $this->preGetValue("essence"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->essence;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("essence");}
	 return $data;
}

/**
* @param string $essence
* @return void
*/
public function setEssence ($essence) {
	$this->essence = $essence;
	return $this;
}

/**
* @return string
*/
public function getChoix () {
	$preValue = $this->preGetValue("choix"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->choix;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("choix");}
	 return $data;
}

/**
* @param string $choix
* @return void
*/
public function setChoix ($choix) {
	$this->choix = $choix;
	return $this;
}

/**
* @return array
*/
public function getFixation () {
	$preValue = $this->preGetValue("fixation"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->fixation;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("fixation");}
	 return $data;
}

/**
* @param array $fixation
* @return void
*/
public function setFixation ($fixation) {
	$this->fixation = $fixation;
	return $this;
}

/**
* @return array
*/
public function getProfil () {
	$preValue = $this->preGetValue("profil"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->profil;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("profil");}
	 return $data;
}

/**
* @param array $profil
* @return void
*/
public function setProfil ($profil) {
	$this->profil = $profil;
	return $this;
}

/**
* @return string
*/
public function getClasse () {
	$preValue = $this->preGetValue("classe"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->classe;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("classe");}
	 return $data;
}

/**
* @param string $classe
* @return void
*/
public function setClasse ($classe) {
	$this->classe = $classe;
	return $this;
}

/**
* @return string
*/
public function getEpaisseurUsure () {
	$preValue = $this->preGetValue("epaisseurUsure"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->epaisseurUsure;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("epaisseurUsure");}
	 return $data;
}

/**
* @param string $epaisseurUsure
* @return void
*/
public function setEpaisseurUsure ($epaisseurUsure) {
	$this->epaisseurUsure = $epaisseurUsure;
	return $this;
}

/**
* @return array
*/
public function getExtras () {
	$preValue = $this->preGetValue("extras"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("extras")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("extras");}
	 return $data;
}

/**
* @param array $extras
* @return void
*/
public function setExtras ($extras) {
	$this->extras = $this->getClass()->getFieldDefinition("extras")->preSetData($this, $extras);
	return $this;
}

/**
* @return string
*/
public function getChanfreins () {
	$preValue = $this->preGetValue("chanfreins"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->chanfreins;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("chanfreins");}
	 return $data;
}

/**
* @param string $chanfreins
* @return void
*/
public function setChanfreins ($chanfreins) {
	$this->chanfreins = $chanfreins;
	return $this;
}

/**
* @return boolean
*/
public function getPieceHumide () {
	$preValue = $this->preGetValue("pieceHumide"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->pieceHumide;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("pieceHumide");}
	 return $data;
}

/**
* @param boolean $pieceHumide
* @return void
*/
public function setPieceHumide ($pieceHumide) {
	$this->pieceHumide = $pieceHumide;
	return $this;
}

/**
* @return boolean
*/
public function getSousCoucheIntegree () {
	$preValue = $this->preGetValue("sousCoucheIntegree"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->sousCoucheIntegree;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("sousCoucheIntegree");}
	 return $data;
}

/**
* @param boolean $sousCoucheIntegree
* @return void
*/
public function setSousCoucheIntegree ($sousCoucheIntegree) {
	$this->sousCoucheIntegree = $sousCoucheIntegree;
	return $this;
}

/**
* @return boolean
*/
public function getChauffantBasseTemperature () {
	$preValue = $this->preGetValue("chauffantBasseTemperature"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->chauffantBasseTemperature;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("chauffantBasseTemperature");}
	 return $data;
}

/**
* @param boolean $chauffantBasseTemperature
* @return void
*/
public function setChauffantBasseTemperature ($chauffantBasseTemperature) {
	$this->chauffantBasseTemperature = $chauffantBasseTemperature;
	return $this;
}

/**
* @return boolean
*/
public function getChauffantAccumulationBasseTemperature () {
	$preValue = $this->preGetValue("chauffantAccumulationBasseTemperature"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->chauffantAccumulationBasseTemperature;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("chauffantAccumulationBasseTemperature");}
	 return $data;
}

/**
* @param boolean $chauffantAccumulationBasseTemperature
* @return void
*/
public function setChauffantAccumulationBasseTemperature ($chauffantAccumulationBasseTemperature) {
	$this->chauffantAccumulationBasseTemperature = $chauffantAccumulationBasseTemperature;
	return $this;
}

/**
* @return boolean
*/
public function getSolRaffraichissant () {
	$preValue = $this->preGetValue("solRaffraichissant"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->solRaffraichissant;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("solRaffraichissant");}
	 return $data;
}

/**
* @param boolean $solRaffraichissant
* @return void
*/
public function setSolRaffraichissant ($solRaffraichissant) {
	$this->solRaffraichissant = $solRaffraichissant;
	return $this;
}

/**
* @return string
*/
public function getCountry () {
	$preValue = $this->preGetValue("country"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->country;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("country");}
	 return $data;
}

/**
* @param string $country
* @return void
*/
public function setCountry ($country) {
	$this->country = $country;
	return $this;
}

/**
* @return string
*/
public function getColisage () {
	$preValue = $this->preGetValue("colisage"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->colisage;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("colisage");}
	 return $data;
}

/**
* @param string $colisage
* @return void
*/
public function setColisage ($colisage) {
	$this->colisage = $colisage;
	return $this;
}

/**
* @return string
*/
public function getTypeLame () {
	$preValue = $this->preGetValue("typeLame"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->typeLame;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("typeLame");}
	 return $data;
}

/**
* @param string $typeLame
* @return void
*/
public function setTypeLame ($typeLame) {
	$this->typeLame = $typeLame;
	return $this;
}

/**
* @return Asset_Image
*/
public function getImage_1 () {
	$preValue = $this->preGetValue("image_1"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->image_1;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("image_1");}
	 return $data;
}

/**
* @param Asset_Image $image_1
* @return void
*/
public function setImage_1 ($image_1) {
	$this->image_1 = $image_1;
	return $this;
}

/**
* @return Asset_Image
*/
public function getImage_2 () {
	$preValue = $this->preGetValue("image_2"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->image_2;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("image_2");}
	 return $data;
}

/**
* @param Asset_Image $image_2
* @return void
*/
public function setImage_2 ($image_2) {
	$this->image_2 = $image_2;
	return $this;
}

/**
* @return Asset_Image
*/
public function getImage_3 () {
	$preValue = $this->preGetValue("image_3"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->image_3;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("image_3");}
	 return $data;
}

/**
* @param Asset_Image $image_3
* @return void
*/
public function setImage_3 ($image_3) {
	$this->image_3 = $image_3;
	return $this;
}

/**
* @return array
*/
public function getRealisations () {
	$preValue = $this->preGetValue("realisations"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("realisations")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("realisations");}
	 return $data;
}

/**
* @param array $realisations
* @return void
*/
public function setRealisations ($realisations) {
	$this->realisations = $this->getClass()->getFieldDefinition("realisations")->preSetData($this, $realisations);
	return $this;
}

/**
* @return Document_Page | Document_Snippet | Document | Asset | Object_Abstract
*/
public function getFiche_technique_lpn () {
	$preValue = $this->preGetValue("fiche_technique_lpn"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("fiche_technique_lpn")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("fiche_technique_lpn");}
	 return $data;
}

/**
* @param Document_Page | Document_Snippet | Document | Asset | Object_Abstract $fiche_technique_lpn
* @return void
*/
public function setFiche_technique_lpn ($fiche_technique_lpn) {
	$this->fiche_technique_lpn = $this->getClass()->getFieldDefinition("fiche_technique_lpn")->preSetData($this, $fiche_technique_lpn);
	return $this;
}

/**
* @return Document_Page | Document_Snippet | Document | Asset | Object_Abstract
*/
public function getFiche_technique_orginale () {
	$preValue = $this->preGetValue("fiche_technique_orginale"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("fiche_technique_orginale")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("fiche_technique_orginale");}
	 return $data;
}

/**
* @param Document_Page | Document_Snippet | Document | Asset | Object_Abstract $fiche_technique_orginale
* @return void
*/
public function setFiche_technique_orginale ($fiche_technique_orginale) {
	$this->fiche_technique_orginale = $this->getClass()->getFieldDefinition("fiche_technique_orginale")->preSetData($this, $fiche_technique_orginale);
	return $this;
}

/**
* @return array
*/
public function getRelatedProducts () {
	$preValue = $this->preGetValue("relatedProducts"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("relatedProducts")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("relatedProducts");}
	 return $data;
}

/**
* @param array $relatedProducts
* @return void
*/
public function setRelatedProducts ($relatedProducts) {
	$this->relatedProducts = $this->getClass()->getFieldDefinition("relatedProducts")->preSetData($this, $relatedProducts);
	return $this;
}

/**
* @return array
*/
public function getRelatedAccessories () {
	$preValue = $this->preGetValue("relatedAccessories"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("relatedAccessories")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("relatedAccessories");}
	 return $data;
}

/**
* @param array $relatedAccessories
* @return void
*/
public function setRelatedAccessories ($relatedAccessories) {
	$this->relatedAccessories = $this->getClass()->getFieldDefinition("relatedAccessories")->preSetData($this, $relatedAccessories);
	return $this;
}

/**
* @return array
*/
public function getAssociatedArticles () {
	$preValue = $this->preGetValue("associatedArticles"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("associatedArticles")->preGetData($this);
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("associatedArticles");}
	 return $data;
}

/**
* @param array $associatedArticles
* @return void
*/
public function setAssociatedArticles ($associatedArticles) {
	$this->associatedArticles = $this->getClass()->getFieldDefinition("associatedArticles")->preSetData($this, $associatedArticles);
	return $this;
}

/**
* @return string
*/
public function getMeta_title () {
	$preValue = $this->preGetValue("meta_title"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->meta_title;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("meta_title");}
	 return $data;
}

/**
* @param string $meta_title
* @return void
*/
public function setMeta_title ($meta_title) {
	$this->meta_title = $meta_title;
	return $this;
}

/**
* @return string
*/
public function getMeta_description () {
	$preValue = $this->preGetValue("meta_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->meta_description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("meta_description");}
	 return $data;
}

/**
* @param string $meta_description
* @return void
*/
public function setMeta_description ($meta_description) {
	$this->meta_description = $meta_description;
	return $this;
}

/**
* @return string
*/
public function getMeta_keywords () {
	$preValue = $this->preGetValue("meta_keywords"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->meta_keywords;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("meta_keywords");}
	 return $data;
}

/**
* @param string $meta_keywords
* @return void
*/
public function setMeta_keywords ($meta_keywords) {
	$this->meta_keywords = $meta_keywords;
	return $this;
}

/**
* @return string
*/
public function getMage_short_name () {
	$preValue = $this->preGetValue("mage_short_name"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_short_name;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_short_name");}
	 return $data;
}

/**
* @param string $mage_short_name
* @return void
*/
public function setMage_short_name ($mage_short_name) {
	$this->mage_short_name = $mage_short_name;
	return $this;
}

/**
* @return string
*/
public function getMage_sub_description () {
	$preValue = $this->preGetValue("mage_sub_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_sub_description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_sub_description");}
	 return $data;
}

/**
* @param string $mage_sub_description
* @return void
*/
public function setMage_sub_description ($mage_sub_description) {
	$this->mage_sub_description = $mage_sub_description;
	return $this;
}

/**
* @return string
*/
public function getMage_lesplus () {
	$preValue = $this->preGetValue("mage_lesplus"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_lesplus;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_lesplus");}
	 return $data;
}

/**
* @param string $mage_lesplus
* @return void
*/
public function setMage_lesplus ($mage_lesplus) {
	$this->mage_lesplus = $mage_lesplus;
	return $this;
}

/**
* @return string
*/
public function getMage_description () {
	$preValue = $this->preGetValue("mage_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_description");}
	 return $data;
}

/**
* @param string $mage_description
* @return void
*/
public function setMage_description ($mage_description) {
	$this->mage_description = $mage_description;
	return $this;
}

/**
* @return string
*/
public function getCharacteristics () {
	$preValue = $this->preGetValue("characteristics"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->characteristics;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("characteristics");}
	 return $data;
}

/**
* @param string $characteristics
* @return void
*/
public function setCharacteristics ($characteristics) {
	$this->characteristics = $characteristics;
	return $this;
}

/**
* @return string
*/
public function getMage_guideline () {
	$preValue = $this->preGetValue("mage_guideline"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_guideline;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_guideline");}
	 return $data;
}

/**
* @param string $mage_guideline
* @return void
*/
public function setMage_guideline ($mage_guideline) {
	$this->mage_guideline = $mage_guideline;
	return $this;
}

/**
* @return string
*/
public function getImage_1_src () {
	$preValue = $this->preGetValue("image_1_src"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->image_1_src;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("image_1_src");}
	 return $data;
}

/**
* @param string $image_1_src
* @return void
*/
public function setImage_1_src ($image_1_src) {
	$this->image_1_src = $image_1_src;
	return $this;
}

/**
* @return string
*/
public function getImage_2_src () {
	$preValue = $this->preGetValue("image_2_src"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->image_2_src;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("image_2_src");}
	 return $data;
}

/**
* @param string $image_2_src
* @return void
*/
public function setImage_2_src ($image_2_src) {
	$this->image_2_src = $image_2_src;
	return $this;
}

/**
* @return string
*/
public function getImage_3_src () {
	$preValue = $this->preGetValue("image_3_src"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->image_3_src;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("image_3_src");}
	 return $data;
}

/**
* @param string $image_3_src
* @return void
*/
public function setImage_3_src ($image_3_src) {
	$this->image_3_src = $image_3_src;
	return $this;
}

/**
* @return string
*/
public function getMage_fichepdf () {
	$preValue = $this->preGetValue("mage_fichepdf"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_fichepdf;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_fichepdf");}
	 return $data;
}

/**
* @param string $mage_fichepdf
* @return void
*/
public function setMage_fichepdf ($mage_fichepdf) {
	$this->mage_fichepdf = $mage_fichepdf;
	return $this;
}

/**
* @return string
*/
public function getMage_invoice_description () {
	$preValue = $this->preGetValue("mage_invoice_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_invoice_description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_invoice_description");}
	 return $data;
}

/**
* @param string $mage_invoice_description
* @return void
*/
public function setMage_invoice_description ($mage_invoice_description) {
	$this->mage_invoice_description = $mage_invoice_description;
	return $this;
}

/**
* @return string
*/
public function getMage_realisations () {
	$preValue = $this->preGetValue("mage_realisations"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_realisations;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_realisations");}
	 return $data;
}

/**
* @param string $mage_realisations
* @return void
*/
public function setMage_realisations ($mage_realisations) {
	$this->mage_realisations = $mage_realisations;
	return $this;
}

/**
* @return string
*/
public function getMage_config_description () {
	$preValue = $this->preGetValue("mage_config_description"); 
	if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}
	$data = $this->mage_config_description;
	if(!$data && Object_Abstract::doGetInheritedValues()) { return $this->getValueFromParent("mage_config_description");}
	 return $data;
}

/**
* @param string $mage_config_description
* @return void
*/
public function setMage_config_description ($mage_config_description) {
	$this->mage_config_description = $mage_config_description;
	return $this;
}

protected static $_relationFields = array (
  'extras' => 
  array (
    'type' => 'objects',
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
  'relatedProducts' => 
  array (
    'type' => 'objects',
  ),
  'relatedAccessories' => 
  array (
    'type' => 'objects',
  ),
  'associatedArticles' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = NULL;

}

