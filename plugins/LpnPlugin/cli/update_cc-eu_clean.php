<?php

//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-eu

//
include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '3024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
Object_Abstract::setGetInheritedValues(false);


//

Pimcore_Model_Cache::disable();
//\Pimcore\Model\Version::disable();

$conditionFilters = array(
       "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-eu%'",
      // "o_id >10000",
        //"ean IS NULL",

    );


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));

$list->setOrder("ASC");
$list->setOrderKey("ean");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));

foreach ($list->getObjects() as $object) {

    if(!($object instanceof Object_Product))
        continue;

    /*$object->setFixation_not_configurable(null);
    $object->setOrigine_bois('');
    $object->setPefc(null);


    $object->fixation_not_configurable = '';
    $object->origine_bois = '';
    $object->pefc = '';
    */

    $object->setValue('fixation_not_configurable',null);
    $object->setValue('origine_bois','');
    $object->setValue('pefc',null);



   
    $object->save();

    echo "\nEan:".$object->getId()." - ".$object->getCode()." - ".$object->getEan()." - ".$object->getMage_name();


    unset($object);

    
        

    

}
Object_Abstract::setGetInheritedValues($inheritance); 

?>