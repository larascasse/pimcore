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
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp/mm-zp%'",
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
    
    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $code = $article = $object->code;


    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 

    $ean  = $object->ean;
    $article = $object->getCode();
    $parent = $object->getParent();

    if($parent && !$scienergie) {
        $scienergieCourt = $parent->name_scienergie_court;
        $scienergie = $parent->name_scienergie;
        $code = $article = $parent->code;

    }
    $famille = $object->getFamille();
    $epaisseur = $object->getEpaisseur();
    $largeur = $object->getLargeur();
    $longueur = $object->getLongueur();
    $qualite = $object->getQualite();

    $isPointDeHongrie = stripos($article, "MHCHE") === 0;
    $isbatonRompu = stripos($article, "MBCHE") === 0;

    $isThermo = stripos($scienergie, "THERMO")>0;
    $isBrut = $object->isParquetBrut() && !$isThermo ;
    $isChene = $object->getEssence()=="CHE";


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    switch ($epaisseur) {
         case 20:
            
        
            $object->setEpaisseurUsure('8 mm');
            $object->setPose(array('aclouer','acoller'));

            break;

         
        
        default:
            # code...
            break;
    }

    

    $suffixeEan = "";
    $longueur_txt = "";
    
    if($isBrut) {
        $longueur_txt = 'Longueurs panachées de 400 à 2000 mm';
        $suffixeEan = $object->getEpaisseur()."x".$object->getLargeur();
        $suffixeEan.="x400-2000";
        
            
    }
    else if(!$isPointDeHongrie && !$isbatonRompu) {

        $suffixeEan .= $object->getEpaisseur();
        
        switch ($object->getLargeur()) {
             case '390':
                $object->setValue('largeur_txt','Largeurs panachées : 110/130/150 mm');
                $suffixeEan .= 'x110/130/150';
                break;

            case '460':
                $object->setValue('largeur_txt','Largeurs panachées : 130/150/180 mm');
                $suffixeEan .= 'x130/150/180';
                break;

            case '540':
                $object->setValue('largeur_txt','Largeurs panachées : 160/180/200 mm');
                $suffixeEan .= 'x160/180/200';
                break;
            case '600':
                $object->setValue('largeur_txt','Largeurs panachées : 180/200/220 mm');
                 $suffixeEan .= 'x180/200/220';
                break;
             case '720':
                $object->setValue('largeur_txt','Largeurs panachées : 220/240/260 mm');
                 $suffixeEan .= 'x220/240/260';
                break;
            default:
                $suffixeEan .= 'x'.$object->getLargeur();
                break;
        }

        $longueur_txt = 'Longueurs panachées de 400 à 2400 mm';
        $suffixeEan .= 'x400-2400';

       

    }

    else if($isPointDeHongrie) {

        $suffixeEan .= $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur()." 45°";
    } 

    else if($isbatonRompu) {

        $suffixeEan .= $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur();
    }

    $object->setValue('longueur_txt',$longueur_txt); 
    $object->setValue("pimonly_name_suffixe",$suffixeEan);


    //SURFACE
    $parentSuffixeEan = "";

    if(stristr($article, "MHCHE") && !$isBrut) {
        $parent->setMotif('pth');
        $parent->setAngle('45°');
        $parentSuffixeEan .=" Point de Hongrie";
        $parent->setValue('longueur_txt','Longueur pointe à pointe '."600"." mm");



    }
    elseif(stristr($article, "MBCHE") && !$isBrut) {
        $parent->setMotif('baton rompu');
        $parentSuffixeEan .=" Bâton rompu";
    }

    $parentSuffixeEan .= " ".$object->getChoixString();



     //TODO
    if(stristr($scienergie, "TRES ACCENTU")) {
        
        $parent->setValue('traitement_surface',"vieilli tres accentue");
        $parentSuffixeEan .= " vieilli très accentué";
        $object->setValue('chanfreins','rives abîmées'); 
        //$object->setChoix('ELV');
    }
    else if(stristr($article, "MMCHERA") && !$isBrut) {

        $parent->setTraitement_surface(("vieilli"));
        $parentSuffixeEan .= " rives abîmées";
        $parent->setValue('chanfreins','rives abîmées');
        //$object->setChoix('ELV');
  
    }
    elseif(stristr($article, "MMCHEG2") && !$isBrut) {
        $parent->setValue('chanfreins','2');
        //$object->setChoix('ELC');

    }
    


    //HUILE
    if(stripos($scienergie, "PP") >0) {
         $parent->setValue('finition',"brut");
    }

    //On met le vernis au dessus, car on ajoute
    if(stristr($scienergie, "VERNIS AQUA ULTRA MAT")) {
        $parent->setValue('finition',"Verni aqua ultra mat");
        $parentSuffixeEan .= " vernis aqua ultra mat";      
    } //On met le vernis au dessus, car on ajoute
    else if(stristr($scienergie, "VERNIS AQUA")) {
        $parent->setValue('finition',"Verni aqua");
        $parentSuffixeEan .= " vernis aqua";      
    }
    else if(stristr($scienergie, "HUILE AQUA")) {
        $parent->setValue('finition',"huile-aqua");
        $parentSuffixeEan .= " huile aqua";
    }
    else if(stristr($scienergie, "HUILE CIRE")) {
        $parent->setValue('finition',"huile-cire");
        $parentSuffixeEan .= " huile cire";      
    }
    


    $parent->setValue("pimonly_name_suffixe",trim($parentSuffixeEan));



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
          

    
    $parent->setValue('name',null);
    $parent->save();

    $object->setPublished(true);
    $object->save();

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name()." - ".$scienergie. ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>