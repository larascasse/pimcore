<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/01massif/tmp/mm-zp

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
    "o_path LIKE '/catalogue/_product_base__/03revplaca%'",
    "ean IS NOT NULL"
);


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");

$list->setOrder("DESC");
$list->setOrderKey("o_id");


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
    $article = $object->getCode();
    $parent = $object->getParent();
    $famille = $object->getFamille();
    $epaisseur = $object->getEpaisseur();
    $largeur = $object->getLargeur();
    $longueur = $object->getLongueur();
    $qualite = $object->getQualite();

    $isPointDeHongrie = stripos($article, "RT") === 0;
    $isbatonRompu = stripos($article, "RS") === 0 || stripos($article, "RT") === 0;

    $isThermo = stripos($scienergie, "THERMO")>0;
    $isBrut = $object->isParquetBrut() && !$isThermo ;
    $isChene = $object->getEssence()=="CHE";


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    //$object->setEpaisseurUsure('0.6 mm');
    //$object->setSupport('HDF');
    //$object->setFixation(array('click'))
    //$object->setPose(array('acoller','flottante'));

    switch ($epaisseur) {
         case 20:
            
        

            break;

         
        
        default:
            # code...
            break;
    }

    

    $suffixeEan = "";
    $longueur_txt = "";
    
    if(!$isbatonRompu) {

        $suffixeEan .= $object->pimonly_dimensions;
        
        

       

    }

    if($isbatonRompu) {

        $suffixeEan .= $object->pimonly_dimensions;;
    }




    $object->setValue("pimonly_name_suffixe",$suffixeEan);


    //SURFACE
    $parentSuffixeEan = "";

    if($isbatonRompu) {
        $parent->setMotif('baton rompu');
        $parentSuffixeEan .=" Bâton rompu";
    }

    if(stristr($scienergie, "G4")) {
        $parent->setValue('chanfreins','4');
    }
    else if(stristr($scienergie, "G2")) {
        $parent->setValue('chanfreins','2');

    }
    



    


    //HUILE
    
    if(stristr($scienergie, "VERNIS BROSSE MAT")) {
        $parent->setValue('finition',"Verni mat");
        $parentSuffixeEan .= " brossé vernis mat";
        $parent->setValue('traitement_surface',"brosse");
    }
    else if(stristr($scienergie, "VERNIS SATINE")) {
        $parent->setValue('finition',"Verni satiné");
        $parentSuffixeEan .= " vernis satiné";      
    }

    if(stristr($scienergie, "(LOU)")) {
        $parentSuffixeEan .= " - Lounge -";
    }
    else if(stristr($scienergie, "(TWI)")) {
        $parentSuffixeEan .= " - Twist -";
    }
    else  if(stristr($scienergie, "(PRO)")) {
        $parentSuffixeEan .= " - Pro -";
    }
    else  if(stristr($scienergie, "(SWI)")) {
        $parentSuffixeEan .= " - Swing -";
    }
     else  if(stristr($scienergie, "(DEL)")) {
        $parentSuffixeEan .= " - Deluxe -";
    }

    $parentSuffixeEan .= ' '.$object->getChoixString();
   


    $parent->setValue("pimonly_name_suffixe",trim($parentSuffixeEan));
    //$object->setChauffantBasseTemperature("0");
    //$object->setSolRaffraichissant("0");
    //$object->setChauffantRadiantElectrique("0"); 



    
    $parentName = $parent->getName();
    $parentName = str_replace("bois bois", "bois", $parentName);
    $parent->setValue('name',$parentName);
    $parent->save();

    $object->setPublished(true);
    $object->save();

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>