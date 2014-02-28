<?php

class Sitemap_AdminController extends Pimcore_Controller_Action_Admin {

   public function predefinedAction(){
       $list = new Property_Predefined_List();
        $list->setCondition("type = 'bool'");
        $list->setOrder("ASC");
        $list->setOrderKey("name");
        $list->load();

        $properties = array();
        $properties['doc']=array();
        $properties['objet']=array();
        foreach ($list->getProperties() as $type) {
            if($type->ctype=="document"){
                $properties["doc"][] = $type;
            }elseif($type->ctype=="object"){
                $properties["object"][] = $type;
            }            
        }

        $this->_helper->json(array("doc" => $properties["doc"],"object"=>$properties["object"]));
   }

}