<?php


//include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");
include(dirname(__FILE__) . "/pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
Object_Abstract::setGetInheritedValues(false);


Pimcore_Model_Cache::disable();


$conditionFilters = array(
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp%'",
    "ean IS NOT NULL"
);


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");


$list->load();

$objects = array();
 //echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));
$fieldsToExport=array("ean","name_scienergie","name_scienergie_court","pimonly_print_label");

$rows=array();

$row=array();
foreach ($fieldsToExport as $field) {
    $row[] = $field;          
}
$rows[] = $row;

foreach ($list->getObjects() as $object) {


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    if(!($object instanceof Object_Product))
        continue;
    
  
    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $article = $object->code;
    $parent = $object->getParent();

    
   

    if(strlen($object->getEan())>0) {

        $row=array();
       foreach ($fieldsToExport as $field) {
         
           $fieldDefinition = $object->getClass()->getFieldDefinition($field);
           if ($fieldDefinition) {
                $row[] = $fieldDefinition->getForCsvExport($object);
            }
       }
      // $row[] = 'https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    
        $rows[] = $row;
        echo implode(";", $row)."\n";
        
    }
    
    



}

?>