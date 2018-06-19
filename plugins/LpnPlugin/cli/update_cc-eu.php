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
Object_Abstract::setGetInheritedValues(false);


//

Pimcore_Model_Cache::disable();
\Pimcore\Model\Version::disable();

$conditionFilters = array(
       "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-eu%'",
       "o_id >10000",

    );


$list = new Pimcore\Model\Object\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));

$list->setOrder("DESC");
$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));

foreach ($list->getObjects() as $object) {

    if(!($object instanceof Object_Product))
        continue;


    $techDescription = array();
    $techTech = array();
    $techCe = array();


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 

    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;

    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=false;

    if(stristr($scienergieCourt, " hd") || stristr($scienergieCourt, " H ")) {
        $object->setSupport('HDF');
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

    
    if(stristr($scienergie, "BROSS")) {
     $object->setTraitement_surface(("brosse"));
    }
    if(stristr($object->getName(), "vernis mat")) {
     $object->setFinition(("Verni mat"));
    }
    elseif(stristr($object->getName(), "huile teinte réactive")) {
     $object->setFinition(("huile teinte reactive"));
    }
    elseif(stristr($object->getName(), "vernis mat")) {
     $object->setFinition(("vernis cérusé mat"));
    }
    elseif(stristr($object->getName(), "huilé")) {
     $object->setFinition(("huile"));
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

    if(strlen($object->getEan())>0) {
         $parent = $object->getParent();
         $parent->setChoix($object->getChoix());

         $suffixe = "";
         $prefixe = "";

         if(stristr($scienergieCourt, "click") || stristr($scienergie, "click")) {
           $suffixe.=' Click';
        }

        if(stristr($scienergieCourt, "BR ")) {
            $prefixe = "Bâton Rompu ";
        }

        if(stristr($scienergieCourt, "PDH ")) {
            $prefixe = "Point de Hongrie ";
        }


        $suffixe2 = "";
        if(stristr($scienergieCourt, "PDH ")) {
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
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."support ".strtoupper($object->getSupport()).$suffixe2." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',$prefixe.$suffixe);

        }  
        else {
            $object->setValue("pimonly_name_suffixe","support ".strtoupper($object->getSupport()).$suffixe2." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',$prefixe.$parent->getChoixString().$suffixe);
        }



        
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

    unset($object);
    unset($parent);
    continue;
    
    
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>