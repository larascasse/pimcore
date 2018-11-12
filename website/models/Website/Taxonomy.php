<?php

// define a custom class,  for example:
class Website_Taxonomy extends Object_Taxonomy {

	 public function getShortArray() {

    
    	 $itemData= array();
         $itemData["id"] = $this->getId();
         $itemData["modificationDate"] = $this->o_modificationDate;
         $itemData["key"] = $this->o_key;
         $itemData["path"] = str_replace('/taxonomies/','',$this->getPath().$this->o_key);
         $itemData["mage_identifier"] = $this->getMageIdentifier();
         $itemData["code"] = $this->getCode();
         $itemData["label"] = $this->getLabel();
         $itemData["description"] =  $this->getDescription();
         $itemData["editorial"] =  $this->getEditorial();
         $itemData["help"] =  $this->getHelp();


         /*$parent = $this->getParent();
         if($parent->code && $parent->o_key != "taxonomies") {
            $itemData["code"] = $parent->getPath()."/".$itemData["code"];
         }*/

         return $itemData;
    }

    public function getMageIdentifier() {
    	return $this->getId();;
    }

	


}

// and optionally a related list

class Website_Taxonomy_List extends Object_Taxonomy_List {

    
}
?>