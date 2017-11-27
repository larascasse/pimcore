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
 //echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));
$fieldsToExport=array("ean","name_scienergie","name_scienergie_court","choix","couche_usure","chauffantBasseTemperature","chauffantRadiantElectrique","solRaffraichissant");

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
    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 


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
       $row[] = 'https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    
        $rows[] = $row;
        echo implode(";", $row)."\n";
        
    }
    
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}

?>