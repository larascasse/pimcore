<?php

// define a custom class,  for example:
class Website_Teinte extends Object_Teinte {

	public function getSimilarTeinteProducts($productToExclude=null) {
		$teinte = $this;
		$products = array();
		if($teinte) {

			$def = $teinte->getClass()->getFieldDefinition("products_relation");
			$refKey = $def->getOwnerFieldName();
			$refId = $def->getOwnerClassId();
			$nonOwnerRelations = $teinte->getRelationData($refKey,false,$refId);
			
		   	foreach($nonOwnerRelations as $productRelarion){
		   		$product =  Object_Abstract::getById($productRelarion['id']);
		   		

		   		if($product instanceof Object_Product)  {
		   		
		   			if(!$productToExclude || $product->getId()!=$productToExclude->getId()) {

		   				$products[] = $product;
		   			}
		     		
		     	}
		   	}
		}
		return $products;
	}

	public function getProduct_ids_flat() {
		$productIds = array();

		$relatedProducts = $this->getSimilarTeinteProducts();
		
		foreach ($relatedProducts as $relatedProduct) {
			
			if(strlen($relatedProduct->getEan()) == 0) {

				//On va chercher tous les enfants
				$list = new Pimcore\Model\Object\Teinte\Listing();
	            $list->setCondition("path LIKE '" . $relatedProduct->getRealFullPath() . "/%'");
	            
	            $childrens = $list->load();

	            foreach ($childrens as $simpleProduct) {
	                $productIds[] = $simpleProduct->getId();
            	}
			}
			else {
				  $productIds[] = $relatedProduct->getId();
			}
		}
		return implode($productIds);
	}


	//On ne prend que les articles (pas les ean ...)
	public function getProductsArticle($productToExclude=null) {
		$teinte = $this;
		$products = array();

		if($teinte) {
			
			$def = $teinte->getClass()->getFieldDefinition("products_relation");
			$refKey = $def->getOwnerFieldName();
			$refId = $def->getOwnerClassId();
			$nonOwnerRelations = $teinte->getRelationData($refKey,false,$refId);
			
		   	foreach($nonOwnerRelations as $productRelarion){
		   		$product =  Object_Abstract::getById($productRelarion['id']);
		   		

		   		if($product instanceof Object_Product)  {

		   		
		   			if(!$productToExclude || $product->getId()!=$productToExclude->getId()) {

		   				$products[] = $product;
		   			}
		     		
		     	}
		   	}
		}
		
		return $products;
	}


}

// and optionally a related list

class Website_Teinte_list extends Object_Teinte_List {

    
}
?>