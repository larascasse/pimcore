<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-bois-exo/cc-cf

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
    "o_path LIKE '//catalogue/_product_base__/50finition/teintes/huile-hardwax-teinte%'",
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

    if(strlen($object->getEan())==0) 
        return


    
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

    //echo $scienergieCourt." ".$object->getEan()."\n";

    //Profil
    $profil = array();
    $traitement_surface = null;
    $suffixe ="";
    if(stristr($scienergieCourt, "1")) {
        $suffixe = "1 L";
        $object->setVolume("1");

    }
    else if(stristr($scienergie, "5")) {
        $suffixe = "5 L";
        $object->setVolume("5");

    }
   

    //$parent->setValue('pimonly_name_suffixe',$suffixe);
    $object->setValue('pimonly_name_suffixe',$suffixe);


    
    echo "\n$article ?";

    $save = true;
    //epaisseur

    $techDescription = array();
    $techTech = array();
    $techCe = array();



    
   

    /*if(stristr($scienergie, "DENSIF")) {
        $techTech[] = "Densité (Couche supérieure) : +/- 1050 kg/m3";
        $techTech[] = "Contribution BREEAM : HEA 2, MAT 5 (DT)";
        $techTech[] = "Dureté Brinell : >= 9.5kg/mm2";
    }
    else {
        $techTech[] = "Densité (Couche supérieure) : +/- 700 kg/m3";
        $techTech[] = "Contribution BREEAM : HEA 2, MAT 1";
        $techTech[] = "Dilatation bambou: 0,14% pour 1% de variation d’humidité";
        $techTech[] = "Dureté Brinell : >= 4kg/mm2";
    }*/




    /*$object->setCharacteristics_others(implode("\n", $techDescription));
    $object->setCharacteristics_others_tech(implode("\n", $techTech));
    $object->setCharacteristics_others_perf(implode("\n", $techCe));
    */

    //$parent->save();
    $object->save();

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
   
        




    
    

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>