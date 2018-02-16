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
        //$object =$object->getParent();
         $values = array();
        $fields = array("image_1","image_2","image_3","image_4","image_texture");
        echo "\n".(string)$parentToSave->getMage_Name();
        $scienergie = $object->name_scienergie;
        
         if(stristr($scienergieCourt, "BR ") || stristr($scienergieCourt, "PDH ")) {
            foreach ($fields as $fieldName) {
                echo "remove".$fieldName;
                $values[$fieldName] = null;
            }
             $object->setValues($values);
            $object->save();
         }



}
die;

foreach ($list->getObjects() as $object) {
    //COPIE DE SCIERGNER COURT
    
    $save = false;

    $objectToSave = Object::getById($object->getId());
    $fields = array("image_1","image_2","image_3","image_4","image_texture");
     $values = array();
    if($objectToSave instanceOf Object_Product)  {

       foreach ($fields as $fieldName) {
            $getter = "get" . ucfirst($fieldName);
            $setter = "set" . ucfirst($fieldName);
            $field = $object->$getter();
            //echo (string)$objectToSave->$fieldName; die;
           // echo "\nTRY ".$objectToSave->getMage_Name();
            if(!$objectToSave->$fieldName && (string)$field != "lpn-1l-pantone.gif" && $object->getChoix()=="MAT") {
                 
                echo "\n --> ADD $fieldName / ".$field." <=> ".$objectToSave->$fieldName;
                //$objectToSave->$setter($field);
                $values[$fieldName] = $field;
                $save = true;
               
            }
            else if($object->getChoix()!="MAT" || (string)$field == "lpn-1l-pantone.gif") {
                 
                echo "\n --> REMOVE $fieldName / ".$field." <=> ".$objectToSave->$fieldName;
                //$objectToSave->$setter($field);
                $values[$fieldName] = $field;
                $save = true;
               
            }
            else {
                //echo "\n--> SKIP ".$objectToSave->getMage_Name();
                //echo "  ".$field." <=> ".$objectToSave->$fieldName;
                //$values[$fieldName] = null;

            }
       }
       

         if($save) {
            //print_r($values);
             $objectToSave->setValues($values);
             $objectToSave->save();
        }
            
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

foreach ($list->getObjects() as $object) {
        $parentToSave = $object->getParent();
         $values = array();
        $fields = array("image_1","image_2","image_3","image_4","image_texture");
        echo "\n".(string)$parentToSave->getMage_Name();
        foreach ($fields as $fieldName) {
            echo "remove".$fieldName;
            $values[$fieldName] = null;
        }
         $parentToSave->setValues($values);
        $parentToSave->save();




}

?>