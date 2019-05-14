<?php

use Pimcore\Model;

// define a custom class,  for example:
class Website_ProductPlusValue extends Object_ProductPlusValue {

	public function getEan() {

		$mainProduct = $this->getProduct();
		$plusValue = $this->getPlusValue();


		if($mainProduct && $plusValue) {
			return $mainProduct->getEan()."|".$plusValue->getEan();
		}
	}


	public  function getShortArray() {
		$return = $this->getProduct()->getShortArray();

		$return["className"] = "product";
		$return["key"] = $this->getKey();
		$return["published"] = $this->getPublished();

		return $return;
	}

	public function getImageAssetArray($withRealisations = false) {
		if($mainProduct = $this->getProduct())
			return $mainProduct->getImageAssetArray($withRealisations);
	}


}



// and optionally a related list

class Website_ProductPlusValue_List extends Object_ProductPlusValue_List {

    
}
?>