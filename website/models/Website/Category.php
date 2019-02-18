<?php

// define a custom class,  for example:
class Website_Category extends Object_Category {

	 public function getShortArray() {

    
    	 $itemData= array();
         $itemData["id"] = $this->getId();
         $itemData["modificationDate"] = $this->o_modificationDate;
         $itemData["key"] = $this->o_key;
         $itemData["full_path"] = str_replace('/categories/','',$this->getFullPath());
         $itemData["mage_identifier"] = $this->getMageIdentifier();
         
         $itemData["name"] = $this->getName();
         $itemData["sub_description"] = $this->getSub_description();
         $itemData["description"] =  $this->getDescription();
         //$itemData["mage_category_id"] =  $this->getMage_category_id();
         $itemData["mage_category_id"] =  $this->mage_category_id;
         $itemData["mage_parent_category_id"] =  $this->getParent()->mage_category_id;
         //$itemData["full_path"] =  $this->getFullPath();
 


         /*$parent = $this->getParent();
         if($parent->code && $parent->o_key != "taxonomies") {
            $itemData["code"] = $parent->getPath()."/".$itemData["code"];
         }*/

         return $itemData;
    }

    public function getMageIdentifier() {
    	return $this->$this->o_key;
    }

	


}

// and optionally a related list

class Website_Category_List extends Object_Category_List {

    
}
?>