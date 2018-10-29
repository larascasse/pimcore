<?php

// define a custom class,  for example:
class Website_Article extends Object_Article {

	 public function getShortArray() {

    
    	 $itemData= array();
         $itemData["id"] = $this->getId();
         $itemData["modificationDate"] = $this->o_modificationDate;
         $itemData["key"] = $this->o_key;
         $itemData["path"] = $this->o_path;
         //$itemData["meta"] = $this->getMeta();

         $itemData["mage_identifier"] = $this->getMageIdentifier();
         $itemData["title"] = $this->getName();
         $itemData["name"] = $this->getName();
         $itemData["content"] = $this->getContent();
         $itemData["description"] =  $itemData["content"];
         //$itemData["posterImage"] = $this->getPosterImage()?$this->getPosterImage()->getThumbnail("content")->getPath():"";
         //$itemData["sku"] = ($product=$this->getRelatedProduct())?$product->getSku():"";

         return $itemData;
    }

    public function getMageIdentifier() {
    	return "article/".$this->o_key;
    }

	


}

// and optionally a related list

class Website_Article_List extends Object_Article_List {

    
}
?>