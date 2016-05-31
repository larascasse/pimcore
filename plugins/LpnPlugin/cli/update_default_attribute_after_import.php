<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);


Pimcore_Model_Cache::disable();


$conditionFilters = array("
       o_path LIKE '/catalogue/_product_base__/20strat/ap000mebj0000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/ap000mebj0240bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/ap000mebs1000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/ap000mepsb000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/ap000mepsh000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/ap000meqro000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/ap000mesco000bf/%'

    ");


$list = new Pimcore\Model\Object\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects()).'\n';
//Logger::debug("objects in list:" . count($list->getObjects()));
foreach ($list->getObjects() as $object) {
    echo "update ".$object->getName().'\n';
    //COPIE DE SCIERGNER COURT
    $value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 
    $object->setValue('name',null);
    $object->setValue('lesplus',null);
    $object->setValue('catalogue',null);
    $object->setValue('subtype',null);
    $object->setValue('price',null);
    $object->setValue('weight',null);
    $object->setValue('leadtime',null);
    $object->setValue('shipping_type',null);
    $object->setValue('characteristics_others',null);
    $object->setValue('origine_bois',null);
    $object->setValue('country_of_manufacture',null);
    $object->setValue('norme_sanitaire',null);
    $object->setValue('support',null);
    $object->setValue('pefc',null);
    $object->setValue('meta_title',null);
    $object->setValue('meta_description',null);
    
    $object->setValue('configurable_free_1',$value);
    $object->setValue('pimonly_name_suffixe',$value);
    $object->setPublished(true);
    $object->save();
    Object_Abstract::setGetInheritedValues($inheritance); 

}

?>