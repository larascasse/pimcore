<?php 

class Object_Fieldcollection_Data_ProductFieldCollection extends Object_Fieldcollection_Data_Abstract  {

public $type = "ProductFieldCollection";
public $prix;


/**
* @return array
*/
public function getPrix () {
	$data = $this->prix;
	 return $data;
}

/**
* @param array $prix
* @return void
*/
public function setPrix ($prix) {
	$this->prix = $prix;
	return $this;
}

}

