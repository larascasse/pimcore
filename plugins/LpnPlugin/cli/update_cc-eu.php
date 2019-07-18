<?php

//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-eu

//
include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '3024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
//Object_Abstract::setGetInheritedValues(false);


//

Pimcore_Model_Cache::disable();
\Pimcore\Model\Version::disable();

$conditionFilters = array(
       "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-eu%'",
       "ean IS NOT NULL",
       "famille not like '97LOTS'",

    );


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));

$list->setOrder("DESC");
$list->setOrderKey("code");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));
$previousParent = null;

$listObject = $list->getObjects();
$total = count($listObject);
$idx=0;
foreach ($list->getObjects() as $object) {
    $idx++;
    if(!($object instanceof Object_Product))
        continue;


    $techDescription = array();
    $techTech = array();
    $techCe = array();


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $code = $article  = $object->getCode();
    $famille = $object->getFamille();

    $parent = $object->getParent();
    if(isset($previousParent) && $previousParent->getId() == $parent->getId()) {
        $sameParentAsPrevious = true;
    }
    else {
         $sameParentAsPrevious = false;
    }
    $previousParent = $parent;


    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 

    $ean  = $object->ean;

    
   
    $epaisseur = $object->getEpaisseur();
    $largeur = $object->getLargeur();
    $longueur = $object->getLongueur();
    $qualite = $object->getQualite();

    $isPointDeHongrie = stripos($article, "FHCHE") === 0;
    $isbatonRompu = stripos($article, "FBCHE") === 0;

    $isThermo = stripos($scienergie, "THERMO")>0;
    $isBrut = $object->isParquetBrut() && !$isThermo ;
    $isChene = $object->getEssence()=="CHE";
    $isDalle = stripos($scienergie, "VERSAILLES")>0;;

    $isVieilli= stripos($scienergie, "VIEILLI ")>0;;



    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=false;

    $suportString = "";

    if(stristr($scienergieCourt, " hd") || stristr($scienergieCourt, " hrl") || stristr($scienergieCourt, " H ") || stristr($scienergieCourt, "click") || stristr($scienergie, "click")) {
        $object->setSupport('HDF');
        $suportString = "support HDF";
        $object->setPimonly_masse_volumique_moyenne(850);

        if($object->getEpaisseur()==10) {
            $object->setPimonly_conductivite_thermique_total(0.164);
            $object->setPimonly_resistance_thermique(0.061);
        }
        else if($object->getEpaisseur()==14) {
            $object->setPimonly_conductivite_thermique_total(0.172);
            $object->setPimonly_resistance_thermique(0.081);
        }

        $save=true;
    }
    else if(stristr($scienergieCourt, "cp") || stristr($scienergieCourt, " P ")) {
        $object->setSupport('cp');
        $suportString = "support CP";
        $object->setPimonly_masse_volumique_moyenne(780);

        if($object->getEpaisseur()==10) {
            $object->setPimonly_conductivite_thermique_total(0.163);
            $object->setPimonly_resistance_thermique(0.062);
        }
        else if($object->getEpaisseur()==14) {
            $object->setPimonly_conductivite_thermique_total(0.168);
            $object->setPimonly_resistance_thermique(0.083);
        }
         else if($object->getEpaisseur()==19) {
            $object->setPimonly_conductivite_thermique_total(0.166);
            $object->setPimonly_resistance_thermique(0.114);
        }

        $save=true;
    }

    
    if($isVieilli) {
        $object->setTraitement_surface(("brosse-vieilli"));
    }
    else if(stristr($scienergie, "BROSS")) {
     $object->setTraitement_surface(("brosse"));
    }

        
    if(stristr($scienergie, "huile uv")) {
        $parent->setFinition(("Huile UV"));
        $object->setFinition('');
    }
    else if(stristr($scienergie, "vernis mat")) {
        $parent->setFinition(("Verni mat"));
        $object->setFinition('');
    }
    else if(stristr($scienergie, "vernis brosse mat")) {
        $parent->setFinition(("Verni mat"));
        $object->setFinition('');
    }
    elseif(stristr($object->getName(), "huile teinte réactive")) {
        $parent->setFinition(("huile teinte reactive"));
        $object->setFinition('');
    }
    elseif(stristr($scienergie, "vernis ceruse mat")) {
        $parent->setFinition(("vernis cérusé mat"));
        $object->setFinition('');
    }
    elseif(stristr($scienergie, "vernis")) {
        $parent->setFinition(("Verni"));
        $object->setFinition('');
    }
    elseif(stristr($scienergie, "huilé")) {
        $parent->setFinition(("huile"));
        $object->setFinition('');
    }


    if(stristr($scienergieCourt, "click") || stristr($scienergie, "click")) {
        $object->setFixation(array('click'));
        $save=true;
    }
    else {
        $object->setFixation(array('rainurelanguette'));
        $save=true;
    }

    if(stristr($scienergieCourt, "BR ")) {
        $object->setMotif('baton rompu');
        $save=true;
    }
    else if(stristr($scienergieCourt, "PDH ")) {
        $object->setMotif('pth');

    }

    if($object->getEpaisseur()==19) {
        $object->setEpaisseurUsure('5.5 mm');
        
        $object->setChauffantBasseTemperature("0");
        $object->setSolRaffraichissant("0");
        $object->setChauffantRadiantElectrique("0");


        $save=true;
    }
    else if($object->getEpaisseur()==14) {
        $object->setEpaisseurUsure('3.2 mm');

        $object->setChauffantBasseTemperature("1");
        
        if( $object->getSupport() == 'HDF')
            $object->setSolRaffraichissant("0");
        else
            $object->setSolRaffraichissant("1");
        
        $object->setChauffantRadiantElectrique("1");

        $save=true;
    }
    else if($object->getEpaisseur()==10) {
        $object->setEpaisseurUsure('2 mm');
        
        $object->setChauffantBasseTemperature("1");
        $object->setSolRaffraichissant("1");
        $object->setChauffantRadiantElectrique("1");

        $save=true;
    }

   

         $parent->setChoix($object->getChoix());

         $suffixe = "";
         $prefixe = "";

         if(stristr($scienergieCourt, "click") || stristr($scienergie, "click")) {
           $suffixe.=' Click';
        }

        if(stristr($scienergieCourt, "BR ") || stristr($article, "FBCHE") ) {
            $prefixe = "Bâton Rompu ";
        }

        if(stristr($scienergieCourt, "PDH ") || stristr($article, "FHCHE") ) {
            $prefixe = "Point de Hongrie ";
        }

        $prefixe .= lcfirst($object->getTraitement_surfaceString($raw = true))." ";
        $prefixe .= lcfirst($object->getFinitionString($raw = true))." ";

       

        if(stristr($article, "G2")) {
            $object->setChanfreins(2);
        }
        else if(stristr($article, "G4")) {
            $object->setChanfreins(4);

        }
        else if(stristr($article, "G0")) {
            $object->setChanfreins(0);

        }


        $suffixe2 = "";
        if(stristr($scienergieCourt, "PDH ")  || stristr($article, "FHCHE") ) {
            if($object->getLargeur()==92) {
                $suffixe2 .= " angle 45°";
               // $techDescription[] = "Angle : 45°";
                $object->setAngle('angle 45°');
            }
            else if($object->getLargeur()==124) {
                $suffixe2 .= " angle 52°";
                //$techDescription[] = "Angle : 52°";
                $object->setAngle('angle 52°');
            }

        }

        $object->setCharacteristics_others(implode("\n", $techDescription));




        //On force le titre si plusiqueurs matieres
        if(stristr($parent->getChoixString()," ou ")) {
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." ".$suportString.$suffixe2." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',$prefixe.$suffixe);

        }  
        else {
            $object->setValue("pimonly_name_suffixe",$suportString.$suffixe2." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',$prefixe.$parent->getChoixString().$suffixe);
        }


            //soucics: 

        $parent->setValue('fixation_not_configurable',null);
        $object->setValue('fixation_not_configurable',null);
        $object->setValue('pefc',null);

        
        $save=true;

       
        $object->setValue('name',null);
            

        if(!$sameParentAsPrevious) {

            //Petit truc a clean, dans le nom du parent / parent, on vire la finition

            if(($parentParent = $parent->getParent()) instanceof Object_Product) {
                $oldName = $parentParent->name;
                $newName = str_replace(" ".$object->getFinitionString($raw = true),"" , $oldName);
                $newName = str_ireplace(" ".$object->getTraitement_surfaceString($raw = true),"" , $newName);

                //On vire les finitions sur l'object parent
                $oldFinition = $parentParent->finition;
                $oldTraitementSurface = $parentParent->traitement_surface;
                
                if($newName != $oldName || $oldFinition != ""  || $oldTraitementSurface != "") {
                    $parentParent->setValue('name',$newName);
                    $parentParent->setValue('finition','');
                    $parentParent->setValue('traitement_surface','');
                    $parentParent->save();
                    echo "\nParent Article : ".$newName. ' -> '.$oldName;
                }
            }
              

            $parent->save();
            echo "\nArticle :".$parent->getCode()." - ".$parent->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$parent->getPreviewUrl();
        }
        
        if($save) {
             echo "\nEan ($idx/$total):".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
            $object->save();
        }

       

    unset($object);
    unset($parent);
    
    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>