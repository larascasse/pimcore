<?php

// define a custom class,  for example:
class Website_Teinte extends Object_Teinte {

	protected  $_tags;
	protected  $_productsArticle;


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

	public function getProduct_ids() {
		$productIds = array();

		$relatedProducts = $this->getSimilarTeinteProducts();
		

		foreach ($relatedProducts as $relatedProduct) {
		
			if(strlen($relatedProduct->getEan()) == 0) {

				//On va chercher tous les enfants
				$list = new Pimcore\Model\Object\Product\Listing();
	            $list->setCondition("o_path LIKE '" . $relatedProduct->getRealFullPath() . "/%' AND (obsolete IS NULL OR obsolete=0)");
	            //$list->addConditionParam("obsolete != ?",1);
	            //$productIds[] = "o_path LIKE '" . $relatedProduct->getRealFullPath() . "/%'";
	            
	            $childrens = $list->load();

	            foreach ($childrens as $simpleProduct) {
	            	if (!$simpleProduct->getObsolete())
	                	$productIds[] = $simpleProduct->getId();
            	}
			}
			else {
				  if (!$relatedProduct->getObsolete())
				  	$productIds[] = $relatedProduct->getId();
			}
		}
		return $productIds;
	}
	public function getProduct_ids_flat() { //Utilisé pour m'import magento
		//On ^rends les SKU !!
		$productIds = array();

		$relatedProducts = $this->getSimilarTeinteProducts();
		

		foreach ($relatedProducts as $relatedProduct) {
		
			if(strlen($relatedProduct->getEan()) == 0) {

				//On va chercher tous les enfants

				$list = new Pimcore\Model\Object\Product\Listing();
				$list->setUnpublished(true);
	            $list->setCondition("o_path LIKE '" . $relatedProduct->getRealFullPath() . "/%' AND (obsolete IS NULL OR obsolete=0)");

	           // \Pimcore\Log\Simple::log("bibi.log", $list);
	            
	            $childrens = $list->load();

	            foreach ($childrens as $simpleProduct) {

	                $productIds[] = $simpleProduct->getEan();
            	}
			}
			else {
				  //$productIds[] = $relatedProduct->getId();
			}
		}

		return implode(",",$productIds);
	}

	public function getConfigurableFields() {
		 $childIds = $this->getProduct_ids();
        return \Website\Tool\ProductHelper::getConfigurableAttributesFromProductIds($childIds);
	}


	//On ne prend que les articles (pas les ean ...)
	public function getProductsArticle($productToExclude=null) {

		if(!$this->_productsArticle) {


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
			$this->_productsArticle = $products;
		}
		return $this->_productsArticle;
		
		
	}

	public function getMage_mediagallery() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 


   		$return = array();
		$articles = $this->getProductsArticle();
		foreach ($articles as $product) {
			$asset = $product->getImage_1();
			$path = $asset->getThumbnail("magento_realisation")->getPath();

			$assetTag = array();
			$assetTag[] = $this->getName();
			$assetTag[] = $product->getMotifString();
			$assetTag[] = $product->getTraitement_surfaceString();
			$assetTag[] = $product->getChoixString();

			$assetTageString = implode('|',$assetTag);
			
			$return[$assetTageString] = $path."::".$assetTageString;
		}
		 Object_Abstract::setGetInheritedValues($inheritance); 
		return implode(";",$return);
		
	}

	public function getMage_tags() {

		if(!$this->_tags) {
			$tags = \Pimcore\Model\Element\Tag::getTagsForElement('object', $this->getId());
			$tagsName=[];
			foreach ($tags as $tag) {
				$tagsName[] = $tag->getName();
			}
			$this->_tags = implode(',',$tagsName);
		}
		return $this->_tags;
	}

	public function getShortArray() {
		$attributes = $this->getClass()->getFieldDefinitions();


		//On met ca pour eviter la bouvvle dans getForCsvExport
		$ignoreFields = array("configurable_fields");
		

		$return = [];
		foreach($attributes as $key=> $value) {

		
			$attribute  =  $value->getName();
			$attributeLabel = $value->getTitle();

			$attributeKey = $attributeLabel;

			if(in_array($attribute,$ignoreFields)) {
				//unset($attributeValue);
				continue;
			}
			
			$attributeValue = $value->getForCsvExport($this);
			
			//echo $attribute." ".$attributeValue."\n<br/>";
			$return[$attribute] = $attributeValue;
		}

		switch ($return["product_type"]) {
	        case 'parquet':
	            $return["short_name"]  = "Parquet ".$return["name"];
	            $return["name"]  = "Parquet ".$return["name"];
	            break;

	        case 'terrasse':
	            $return["short_name"]  = "Terrasse ".$return["name"];
	            $return["name"]  = "Terrasse ".$return["name"];
	            break;
	        case 'sol-stratifie':
	            $return["short_name"]  = "Stratifié ".$return["name"];
	            $return["name"]  = "Stratifié ".$return["name"];
	            break;
	         case 'sol-plaque':
	            $return["short_name"]  = "Sol plaqué ".$return["name"];
	            $return["name"]  = "Sol plaqué ".$return["name"];
	            break;
	        
	        default:
	             $return["short_name"]  = $return["name"];
	             $return["name"]  = $return["name"];
	            break;
    	}

		$return["mage_short_name"] = $return["mage_short_name"];
		$return["mage_name"] = $return["mage_name"];
		$return["mage_meta_title"] = $return["name"] . " par La parqueterie Nouvelle";
		
		$return["configurable_fields"] = $this->getConfigurableFields();
		//$return["subtype"] = "teinte-".$return["product_type"];
		$return["subtype"] = ''; //On ne met rien car cet attribut est devenu configurable
		$return["className"] = "teinte";
		$return["key"] = $this->getKey();
		$return["unite"] = "M2";
		$return["published"] = $this->getPublished();
		//$return["mage_realisationsJson"] = $this->getAllRealisations();
		$return["mage_realisationsJson"] = Zend_Json::encode($this->getAllRealisations());

		if(count($articles = $this->getProductsArticle()) > 0 ) {
			$firstArticle = $articles[0];
			$return["finition"] = $firstArticle->getFinition();
			$return["essence"] = $firstArticle->getEssence();
		}
		

		return $return;
	}


	public function getAllRealisations() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
		Object_Abstract::setGetInheritedValues(true); 
   		$return = array();
		$articles = $this->getProductsArticle();
		$realisations = [];
		foreach ($articles as $product) {

			$realisationArray  = $product->getMage_realisationsArray($includeProductImage = false,$includeProductName = true,$includeProductThumb);


			foreach ($realisationArray as $realisation) {
				if(is_object($realisation)) {
					$realisation->tags = $this->getMage_tags();
					//Pour éviter les duplicates
					$realisations[$realisation->base] = $realisation;
				}
			}

		}
		foreach ($realisations as $realisation) {
			$return[] = $realisation;
		}
		Object_Abstract::setGetInheritedValues($inheritance); 
		return $return;
	}


}

// and optionally a related list

class Website_Teinte_list extends Object_Teinte_List {

    
}
?>