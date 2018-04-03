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