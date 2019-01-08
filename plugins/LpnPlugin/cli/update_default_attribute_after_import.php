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
    o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/strat-barre-jonction/ap000mebj0000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/strat-barre-jonction/ap000mebj0240bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/ap000mebs1000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/strat-plinthes/ap000mepsb000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/strat-plinthes/ap000mepsh000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/ap000meqro000bf/%'
    OR o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/ap000mesco000bf/%'

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

    $objectToSave = Object::getById($object->getId());

    $values = array();
    
    $values['name']='';
    $values['lesplus']='';
    $values['catalogue']='';
    $values['subtype']='';
    $values['price']='';
    $values['weight']='';
    $values['leadtime']='';
    $values['shipping_type']='';
    $values['characteristics_others']='';
    $values['origine_bois']='';
    $values['country_of_manufacture']='';
    $values['norme_sanitaire']='';
    $values['support']='';
    $values['pefc']='';
    $values['meta_title']='';
    $values['meta_description']='';
    $values['no_stock_delay']='';


    $values['configurable_free_1'] = $value;
    $values['pimonly_name_suffixe'] = $value;

    $objectToSave->setValues($values);


    $objectToSave->setPublished(true);
    $objectToSave->save();

    Object_Abstract::setGetInheritedValues($inheritance); 

}

?>