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

$conditionFilters = array("
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-ad%'

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


    $suffixeEan = "";
    //largeur
    if(strlen($object->getEan())>0) {

        $suffixeEan .= $object->getEpaisseur();
        switch ($object->getLargeur()) {
            case '540':
                $object->setValue('largeur_txt','Largeurs panachées : 160/180/200 mm');
                $suffixeEan .= 'x160/180/200';
                break;
            case '600':
                $object->setValue('largeur_txt','Largeurs panachées : 180/200/220 mm');
                 $suffixeEan .= 'x180/200/220';
                break;
            default:
                $suffixeEan .= 'x'.$object->getLargeur();
                break;
        }
    }
    //CONTEMPORAIN
    if(stristr($article, "FMCHEG2")) {
        echo "OK !\n";
         //$object->setTraitement_surface(("vieilli use brosse rives abimees"));

         $longueur_txt = 'Longueurs panachées de 1200 à 2300 mm';
         $suffixeEan .= 'x1200-2300';
        

         //EAN
         if(strlen($object->getEan())>0) {
            $object->setValue("pimonly_name_suffixe",$suffixeEan);


         }
         //Article
         else  {
            //$object->setValue("pimonly_name_suffixe","vieilli usé brossé rives abîmées");
            $object->setValue('longueur_txt',$longueur_txt);
            $object->setValue('chanfreins','2');
         }
         
         $save=true;
    }

    //vieilli rives abimees
    else if(stristr($article, "FMCHERA")) {
         
         $longueur_txt = 'Longueurs panachées de 1200 à 2300 mm';
         $suffixeEan .= 'x1200-2300';

         if(strlen($object->getEan())>0) {
            $object->setValue("pimonly_name_suffixe",$suffixeEan);

         }
         else {
            $object->setValue('longueur_txt',$longueur_txt);
            $object->setTraitement_surface(("vieilli"));
            $object->setValue("pimonly_name_suffixe","vieilli");
            
            $object->setValue('chanfreins','rives abîmées');
         }


        
    }

    if(stristr($scienergie, "HUILE AQUA")) {
        $object->setValue('finition',"huile-aqua");
        if(strlen($object->getEan())==0) {
            $parent->setValue("pimonly_name_suffixe","huile aqua");
             $parent->save();

        }
    }
    else if(stristr($scienergie, "HUILE CIRE")) {
        $object->setValue('finition',"huile-cire");
        if(strlen($object->getEan())==0) {
            $parent->setValue("pimonly_name_suffixe","huile cire");
             $parent->save();

        }
    }


    //TODO
    if(stristr($scienergie, "TRES ACCENTU")) {
        if(strlen($object->getEan())>0) {

        }
        else {
            $object->setValue('traitement_surface',"vieilli tres accentue");
            $object->setValue("pimonly_name_suffixe","vieilli très accentué");
            $object->setValue('chanfreins','rives abîmées');
        }
        
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
       
        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        $parent->save();
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
   // continue;

   
    if($save)
        $object->save();

    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>