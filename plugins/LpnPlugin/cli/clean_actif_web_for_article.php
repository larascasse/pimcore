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
    "ean IS NULL",
   // "code IS NOT NULL",
    //"LOWER(name) like '% ".strtolower($teinteName)." %'"
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
        
        echo $object->actif_web?"Actif\n":"--\n";

        if($object->actif_web) {
            $object->setActif_web(false);
            $object->save();
        }
    



}


?>