<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-bs

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
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp/mm-bs%'",
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


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    switch ($epaisseur) {
         case 10:
            
        
            $object->setEpaisseurUsure('4.5 mm');
            //$object->setChauffantBasseTemperature("0");
            //$object->setSolRaffraichissant("0");
            //$object->setChauffantRadiantElectrique("0");
            $object->setPose(array('acoller'));

            break;

        case 14:
            
        
            $object->setEpaisseurUsure('6 mm');
            //$object->setChauffantBasseTemperature("0");
            //$object->setSolRaffraichissant("0");
            //$object->setChauffantRadiantElectrique("0");
            $object->setPose(array('acoller'));

            break;

         case 23:
            
        
            $object->setEpaisseurUsure('9 mm');
            //$object->setChauffantBasseTemperature("0");
            //$object->setSolRaffraichissant("0");
            //$object->setChauffantRadiantElectrique("0");
            $object->setPose(array('aclouer','acoller'));

            break;
        
        default:
            # code...
            break;
    }

    $suffixeEan =$object->getEpaisseur()."x".$object->getLargeur();
    
    // 23 ou 14mm => Longueurs de 350 à 1400mm pour les Largeurs de 50 à70mm - Ep: 23mm => Longueurs de 400 à 2000mm pour les Largeurs de 75 à 180mm - EP: 14mm => Longueurs de 400 à 1600mm pour les Largeurs de 90mm et + 
    switch ($longueur) {
         case 500:
            $object->setValue('longueur_txt','Longueurs panachées de 300 à 500 mm');
            $suffixeEan.="x300-500";
            break;

        case 1400:
            $object->setValue('longueur_txt','Longueurs panachées de 350 à 1400 mm');
            $suffixeEan.="x350-1400";
            break;

        case 1500:
            $object->setValue('longueur_txt','Longueurs panachées de 300 à 1500 mm');
            $suffixeEan.="x300-1500";
            break;

        case 1600:
            $object->setValue('longueur_txt','Longueurs panachées de 400 à 1600 mm');
            $suffixeEan.="x400-1600";
            break;

        case 2000:
            $object->setValue('longueur_txt','Longueurs panachées de 400 à 2000 mm');
            $suffixeEan.="x400-2000";
            break;

        case 2400:
            $object->setValue('longueur_txt','Longueurs panachées de 500 à 1400 mm (30%) et 1500 à 2400 mm (70%)');
            $suffixeEan.="x500-2400";
            break;
        
        default:
            # code...
            break;
    }

    $object->setValue("pimonly_name_suffixe",$suffixeEan);

    //if($object->getChauffantBasseTemperature()==0) {
        if(stripos($object->getCalculatedChauffantBasseTemperature(),"oui") === 0) {
            $object->setChauffantBasseTemperature("1");
        }

        if(stripos($object->getCalculatedSolRaffraichissant(),"oui") === 0) {
            $object->setSolRaffraichissant("0");
            
        }
        if(stripos($object->getCalculatedChauffantRadiantElectrique(),"oui") === 0) {
            $object->setChauffantRadiantElectrique("0");   
        }     

    //}
    


    
    $parent->setValue('pimonly_name_suffixe',$parent->getChoixString());

       
    if(strlen($parent->name)>0) {
       $parent->setValue('name',null);
       $parent->save();
        
    } 

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        

   $object->save();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>