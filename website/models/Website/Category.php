<?php

// define a custom class,  for example:
class Website_Category extends Object_Category {

	 public function getShortArray() {

        if(strlen($this->getName()) == 0) {
            return [];
        }

         $inheritance = Object_Abstract::doGetInheritedValues(); 
         Object_Abstract::setGetInheritedValues(false); 


    	 $itemData= array();
         $itemData["id"] = $this->getId();
         $itemData["modificationDate"] = $this->o_modificationDate;
         $itemData["key"] = $this->o_key;
         $itemData["full_path"] = str_replace('/categories/','',$this->getFullPath());
         $itemData["mage_identifier"] = $this->getMageIdentifier();
         
         $itemData["name"] = trim($this->getName());
         $itemData["sub_description"] = $this->sub_description;
         $itemData["description"] =  $this->description;
         $itemData["mage_category_id"] =  $this->mage_category_id;
         $itemData["mage_parent_category_id"] =  $this->getParent()->mage_category_id;
         $itemData["short_name"] =  $this->short_name;
         $itemData["mage_custom_layout"] =  $this->mage_custom_layout;
         //$itemData["mage_dynamic_products_conds"] =  $this->mage_dynamic_products_conds;

         // get an asset
        //$asset = Asset::getById($this->getImage_1()->id);
         $image_header_url = "";
        if($this->getImage_header()) {
            /*
            $fsPath = $this->getImage_1()->getThumbnail("magento_small")->getFileSystemPath(true);
            $path = "http://".$_SERVER["HTTP_HOST"].urlencode_ignore_slash(str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath));
            */

            /* VERSION CLOUD */
            $image_header_url = $this->getImage_header()->getThumbnail("magento-header")->getPath();

            
        }
        $itemData["image_header_url"] = $image_header_url; 

        Object_Abstract::setGetInheritedValues($inheritance); 

        return $itemData;
    }

    public function getMageIdentifier() {
    	return $this->o_key;
    }

	


}

// and optionally a related list

class Website_Category_List extends Object_Category_List {

    
}
?>