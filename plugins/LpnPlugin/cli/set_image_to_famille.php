<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
//Object_Abstract::setGetInheritedValues(false);


Pimcore_Model_Cache::disable();


$conditionFilters = array(
       "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-eu%'",
       "ean IS NULL",
       "code IS NOT NULL"

    );




$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);

$condition = implode(" AND ", $conditionFilters);
echo $condition;
$list->setCondition($condition );
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects()).'\n';
//Logger::debug("objects in list:" . count($list->getObjects()));
foreach ($list->getObjects() as $object) {
    
    //COPIE DE SCIERGNER COURT
    
   

    $objectToSave = Object::getById($object->getId());

    if($objectToSave instanceOf Object_Product)  {

        echo "\nTRY ".$objectToSave->getMage_Name();
            $image_1 = $object->getImage_1();
            echo " || ".$image_1." <=> ".$$objectToSave->image_1;
        
            
    }
       /* if(strlen($teinte)>0) {

            $values = array();
            $values['configurable_free_1'] = $teinte;
            $values['pimonly_name_suffixe'] = $teinte;

            $objectToSave->setValues($values);

            $objectToSave->setPublished(true);
            $objectToSave->save();
            echo "\nSaved :".$objectToSave->getName();
        }*/
  

   


   // Object_Abstract::setGetInheritedValues($inheritance); 

}

?>