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
       o_path LIKE '/catalogue/_product_base__/20strat/strat-accessoires/%'

    ");

$conditionFilters = array("
       o_path LIKE '/catalogue/_product_base__/85vinylsol/lvt-accessoires%'

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
    
    //COPIE DE SCIERGNER COURT
    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 

    $objectToSave = Object::getById($object->getId());

    if($objectToSave instanceOf Object_Product)  {

        echo "\n\nTRY ".$objectToSave->getName()." ".$objectToSave->getName_scienergie_court();

         $teinte = $objectToSave->getMage_teinte();
         //$teinte  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

        if(strlen($teinte)==0) {
            //On va voir dans le scienergie cout
            $teinteKey = Pimcore_File::getValidFilename($objectToSave->getValueForFieldName('name_scienergie_court'));

            if(strlen(trim($teinteKey))>0) {
                $listTeintes = new Pimcore\Model\Object\Listing();
                $listTeintes->setUnpublished(true);
                $conditionFilters = array(
                    "o_path LIKE '/teintes/teintes/%'",
                    "(o_key = '".$teinteKey."' OR o_key = 'chene-".$teinteKey."')"
                );


                echo "\nsearch ".implode($conditionFilters);

                $listTeintes->setCondition(implode(" AND ", $conditionFilters));
                $listTeintes->load();
                echo "\nobjects in list ".count($listTeintes->getObjects()).'\n';

                foreach ($listTeintes->getObjects() as $teinteObject) {
                    //echo "\nteinteObject";
                    if($teinteObject instanceOf Object_Teinte) {
                         $teinte = $teinteObject->getName();
                        echo "\nget teinte from scienergie court : ".$teinte ." ".$teinteObject->getFullPath();
                        $objectToSave->setPimonly_teinte_rel([$teinteObject]);
                    }
                   

                }
            }
            
        }
        if(strlen($teinte)>0) {

            $values = array();
            $values['configurable_free_1'] = $teinte;
            $values['pimonly_name_suffixe'] = $teinte;

            $objectToSave->setValues($values);

            $objectToSave->setPublished(true);
            $objectToSave->save();
            echo "\nSaved :".$objectToSave->getName();
        }
    }

   


    Object_Abstract::setGetInheritedValues($inheritance); 

}

?>