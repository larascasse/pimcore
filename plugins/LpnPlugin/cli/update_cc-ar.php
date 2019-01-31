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
Vieilli rives abimées, vieilli
Usé,use
*/
    echo "\n$article ?";

    $suffixeEan = $object->getEpaisseur();

    //Usée b rossé
    if(stristr($article, "FMCHEUB")) {
        echo "OK !\n";
         $object->setTraitement_surface(("vieilli use brosse rives abimees"));
         //$object->setValue('chanfreins','rives abîmées'); 

         //EAN
         if(strlen($object->getEan())>0) {

            if($object->getLargeur()==540) {
                $suffixeEan = '21x140/180/220x2000-3000';
                $object->setValue('largeur_txt','Largeurs panachées 140/180/220 mm');
            }
            else if($object->getLargeur()==780) {
                $suffixeEan = '21x220/260/300x2000-3000';
                $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
            }
            else  {
                $suffixeEan = '21x'.$object->getLargeur().'x'.$object->getLongueur();
                $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
            }
            
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
          $object->setTraitement_surface(("vieilli"));
          //$object->setValue('chanfreins','rives abîmées'); 


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

    if(stristr($article, "G2")) {
        $parent->setValue('chanfreins','2');
    }   
    else {
        $parent->setValue('chanfreins','rives abîmées');
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
        
        $save=true;

       
        if(strlen($parent->name)>0) {
            $parent->setValue('name',null);
            
        } 
        $parent->setValue('fixation',['rainurelanguette']);
        
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

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>