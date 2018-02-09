<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-ar

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
\Pimcore\Model\Version::disable();

$conditionFilters = array("
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-ar%'

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

    if(!($object instanceof Object_Product))
        continue;
    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 


    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $scienergie_converti = $object->name_scienergie_converti; //huilé cire
    $article = $object->code;
    $parent = $object->getParent();

    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    /*if(stristr($scienergieCourt, "hd")) {
        $object->setSupport('HDF');
         $save=true;
    }
    else if(stristr($scienergieCourt, "cp")) {*/
        $object->setSupport('cp');
        $save=true;
    //}

   

    //Usée brosssé
    /*
    Brossé,brosse
Brossé accentué, brosse accentue
Brut,brut
Brut de sciage, brut de sciage
Vieilli rives abimées, vieilli rives abimees
Usé,use
*/
    echo "\n$article ?";

    $suffixeEan = $object->getEpaisseur();

    if(stristr($article, "FMCHEUB")) {
        echo "OK !\n";
         $object->setTraitement_surface(("vieilli use brosse rives abimees"));

         //EAN
         if(strlen($object->getEan())>0) {
            $suffixeEan .= 'x'.$object->getLargeur().'x'.$object->getLongueur();
            $object->setValue("pimonly_name_suffixe",$suffixeEan);


         }
         //Article
         else  {
            $object->setValue("pimonly_name_suffixe","vieilli usé brossé rives abîmées");
            $object->setValue('epaisseur_txt','Epaisseur +/- 21 mm');
            $object->setValue('longueur_txt','Longueurs panachées 2000 à 3000 mm');
         }
         
         $save=true;
    }
    else if(stristr($article, "fmcher")) {
          $object->setTraitement_surface(("vieilli rives abimees"));


         if(strlen($object->getEan())>0) {
            

            if(stristr($scienergieCourt, "xl")) {
                $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
                $object->setValue('longueur_txt','Longueurs panachées 2000 à 3000 mm');
                $suffixeEan.="x220/260/300x2000-3000";

            }
            else {
                $object->setValue('largeur_txt','Largeurs panachées 140/180/220 mm');
                $object->setValue('longueur_txt','Longueurs panachées 1800 à 2700 mm');
                $suffixeEan.="x140/180/220x1800-2700";
            }
           
            $object->setValue("pimonly_name_suffixe",$suffixeEan);

         }
         else {
            $object->setValue("pimonly_name_suffixe","vieilli rives abîmées");
         }


        
    }

    if(stristr($scienergie, "HUILE AQUA")) {
        $object->setValue('finition',"huile-aqua");
    }
    else if(stristr($scienergie, "HUILE CIRE") ||  stristr($scienergie_converti, "huilé cire")) {
        $object->setValue('finition',"huile-cire");
    }

    //$object->setValue('origine_bois','France');
   // $object->setValue('country_of_manufacture','Belgique');

    if($object->getEpaisseur()==15) {
        $object->setEpaisseurUsure('4 mm');
        $save=true;
    }
    else if($object->getEpaisseur()==20) {
        $object->setEpaisseurUsure('6 mm');
        $save=true;
    }
   

    if(strlen($object->getEan())>0) {

        $object->setChauffantBasseTemperature("1");
        $object->setChauffantRadiantElectrique("1");
        $object->setSolRaffraichissant("0");

       
        //$object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);
        /* $parent = $object->getParent();
        //On force le titre si plusiqueurs matieres
        if(stristr($parent->getChoixString()," ou ")) {
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."support ".strtoupper($object->getSupport('cp'))." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',null);

        }  
        else {
            $object->setValue("pimonly_name_suffixe","support ".strtoupper($object->getSupport('cp'))." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',$parent->getChoixString());
        }*/

        
        $save=true;

       
        if(strlen($parent->name)>0) {
            $parent->setValue('name',null);
            
        } 
        $parent->save();
        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
   // continue;

   
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
\Pimcore\Model\Version::enable();
?>