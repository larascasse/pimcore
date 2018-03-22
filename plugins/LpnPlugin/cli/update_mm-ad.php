<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-ad

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

$conditionFilters = array(
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp/mm-ad%'",
    "ean IS NOT NULL"
);


$list = new Pimcore\Model\Object\Product\Listing();
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
    $code = $article = $object->code;
    $ean  = $object->ean;
    $parent = $object->getParent();
    $famille = $object->getFamille();
    $epaisseur = $object->getEpaisseur();
    $largeur = $object->getLargeur();
    $longueur = $object->getLongueur();
    $qualite = $object->getQualite();

    $isPointDeHongrie = stripos($scienergieCourt, "hongrie") !== false || stripos($scienergieCourt, "pth") !== false || stripos($scienergie, "point de hongrie") !== false;

    $isbatonRompu = stripos($scienergieCourt, "br") !== false || stripos($scienergieCourt, "baton rompu") !== false || stripos($scienergie, "baton") !== false;

    $isThermo = stripos($scienergie, "THERMO")>0;
    $isBrut = $object->isParquetBrut() && !$isThermo ;
    $isChene = $object->getEssence()=="CHE";


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    switch ($epaisseur) {
         case 20:
            
        
            $object->setEpaisseurUsure('8 mm');
            //$object->setChauffantBasseTemperature("0");
            //$object->setSolRaffraichissant("0");
            //$object->setChauffantRadiantElectrique("0");
            //$object->setPose(array('acoller'));

            break;

        case 14:
            
        
            $object->setEpaisseurUsure('5 mm');
            //$object->setChauffantBasseTemperature("0");
            //$object->setSolRaffraichissant("0");
            //$object->setChauffantRadiantElectrique("0");
            //$object->setPose(array('acoller'));

            break;

         
        
        default:
            # code...
            break;
    }

    $suffixeEan =$object->getEpaisseur()."x".$object->getLargeur();


    if($isBrut) {
        $suffixeEan.="x400-2000";
        $object->setValue('longueur_txt','Longueurs panachées de 400 à 2000 mm');
           
    }
    

    $object->setValue("pimonly_name_suffixe",$suffixeEan);

    //if($object->getChauffantBasseTemperature()==0) {
        if(stripos($object->getCalculatedChauffantBasseTemperature(),"oui") === 0) {
            $object->setChauffantBasseTemperature("1");
        }
        else {
            $object->setChauffantBasseTemperature("0");
        }

        if(stripos($object->getCalculatedSolRaffraichissant(),"oui") === 0) {
            $object->setSolRaffraichissant("1");
            
        }
        else {
            $object->setSolRaffraichissant("0");
        }

        if(stripos($object->getCalculatedChauffantRadiantElectrique(),"oui") === 0) {
            $object->setChauffantRadiantElectrique("1");   
        }  
        else {
         $object->setChauffantRadiantElectrique("0");   
        }
          

    //}
    


    
    $parent->setValue('pimonly_name_suffixe',$parent->getChoixString());

       
    if(strlen($parent->name)>0) {
       $parent->setValue('name',null);
       $parent->save();
        
    } 

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    $object->setPublished(true);
   $object->save();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>