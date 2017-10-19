<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
Object_Abstract::setGetInheritedValues(false);


Pimcore_Model_Cache::disable();


$conditionFilters = array("
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp%'

    ");


$list = new Pimcore\Model\Object\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));

foreach ($list->getObjects() as $object) {


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 

    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;

    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=false;

    if(stristr($scienergieCourt, "hd")) {
        $object->setSupport('HDF');
         $save=true;
    }
    else if(stristr($scienergieCourt, "cp")) {
        $object->setSupport('cp');
        $save=true;
    }

    if(stristr($scienergieCourt, "rl")) {
        $object->setFixation(array('rainurelanguette'));
        $save=true;
    }
    if(stristr($scienergieCourt, "click") || stristr($scienergie, "click")) {
        $object->setFixation(array('click'));
        $save=true;
    }

    if($object->getEpaisseur()==19) {
        $object->setEpaisseurUsure('5.5 mm');
        $save=true;
    }
    else if($object->getEpaisseur()==14) {
        $object->setEpaisseurUsure('3.2 mm');
        $save=true;
    }
    if($object->getEpaisseur()==10) {
        $object->setEpaisseurUsure('2 mm');
        $save=true;
    }

    if(strlen($object->getEan())>0) {
        $object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);
        $save=true;

        $parent = $object->getParent();
        if(strlen($parent->name)>0) {
            $parent->setValue('name',null);
            $parent->setValue('pimonly_name_suffixe',$parent->getChoixString());
            $parent->save();
        }   

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
    continue;

   
    if($save)
        $object->save();


    continue;
    $values = array();
    $objectToSave = Object::getById($object->getId());
    foreach ($fieldsToClean as $key => $fieldName) {
        # code...
        
        

        $value = $object->getValueForFieldName($fieldName);
        if(!($object->getParent() instanceof Website_Product)) {
            $parentValue = $object->getParent()->getParent()->getValueForFieldName($fieldName);
         
        }
        else {
            $parentValue = $object->getParent()->getValueForFieldName($fieldName);
        }

        

        if(($value == $parentValue || $value=="Terrasses en bois par La Parqueterie Nouvelle") && strlen($value)>0 ) {
            echo "--> nullify $fieldName : ".$object->getSku()."  -----    $value <-> $parentValue\n";
            
            
            $values[$fieldName]=null;
            


            //$objectToSave->setPublished(true);
            
        }
   
    }

    if(count( $values)>0) {
        $objectToSave->setValues($values);
        //print_r($values);

        echo "\n";
        $objectToSave->save();
    }
    
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}

?>