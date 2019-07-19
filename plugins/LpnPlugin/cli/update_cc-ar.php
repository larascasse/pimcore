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

$conditionFilters = array(
    "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-ar%'",
    "ean IS NOT NULL"

 );


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));

$list->setOrder("DESC");
$list->setOrderKey("code");


$list->load();

$objects = array();

$previousParent = null;
$sameParentAsPrevious = false;
$listObject = $list->getObjects();
$total = count($listObject);
$idx=0;


echo "objects in list $total \n";


foreach ($listObject as $object) {


    $idx++;
    
    if(!($object instanceof Object_Product))
        continue;

    $parent = $object->getParent();
    if(isset($previousParent) && $previousParent->getId() == $parent->getId()) {
        $sameParentAsPrevious = true;
    }
    else {
         $sameParentAsPrevious = false;
    }
    $previousParent = $parent;

    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->getName_scienergie();
    $code = $article  = $object->getCode();
    $famille = $object->getFamille();
    $equivalence = $object->getPimonly_equivalence_auto();
    


    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 

    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $scienergie_converti = $object->name_scienergie_converti; //huilé cire
    $article = $object->code;
    $parent = $object->getParent();

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

    $parentSuffixeEan = "";

        $object->setSupport('cp');

    $suffixeEan = $object->getEpaisseur();


    //Usée b rossé
    if(stristr($article, "FMCHEUB")) {
        //echo "OK !\n";
        

        $parent->setValue('longueur_txt','');
        $object->setValue('longueur_txt','Longueurs panachées 1800 à 2700 mm');


        if($object->getLargeur()==540) {
            $suffixeEan = '20-22x140/180/220x1800-2700';
            $object->setValue('largeur_txt','Largeurs panachées 140/180/220 mm');
        }
        else if($object->getLargeur()==780) {
            $suffixeEan = '20-22x220/260/300x2000-3000';
            $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
            
            $parent->setValue('longueur_txt','');
            $object->setValue('longueur_txt','Longueurs panachées 2000 à 3000 mm');
        }
        else  {
            $suffixeEan = '20-22x'.$object->getLargeur().'x'.$object->getLongueur();
            $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
        }

       
        $parent->setValue('epaisseur_txt','');
        $object->setValue('epaisseur_txt','Epaisseur +/- 21 mm');

        $object->setTraitement_surface('');
        $parent->setTraitement_surface('use-brosse');
        $parentSuffixeEan  .= "usé brossé";



    }
    else if (stristr($article, "fmcher")) {

        if(stristr($scienergie, "DEFORME")) {

            if(stristr($scienergie, "INTENSE")) {
                $parent->setTraitement_surface("use-deforme-brosse-intense");
                $object->setTraitement_surface("");
                $parentSuffixeEan .= " brossé intense usé déformé";


            }
            else {
                $object->setTraitement_surface(("vieilli-use-deforme"));
                $object->setTraitement_surface('');
                $parentSuffixeEan .= " vieilli usé déformé";
            }
            $parent->setValue('chanfreins','rives abîmées'); 
        }
        else {
             $parent->setTraitement_surface("vieilli");
             $object->setTraitement_surface('');
             $parentSuffixeEan .= " vieilli";
             $parent->setValue('chanfreins','rives abîmées'); 

        }   

        $object->setValue('largeur_txt','Largeurs panachées 140/180/220 mm');
        $object->setValue('longueur_txt','Longueurs panachées de 1800 à 2700 mm');
        $suffixeEan.="x140/180/220x1800-2700";
        
    }




    if(stristr($article, "G2")) {
        $parent->setValue('chanfreins','2');
    }   
    else {
        $parent->setValue('chanfreins','rives abîmées');
    }

    $object->setValue('finition','');
    if(stristr($scienergie, "PRE HUILE AQUA")) {
        $object->setValue('finition','');
        $parent->setValue('finition',"pre-huile-aqua");
        $parentSuffixeEan .= " pré-huilé aqua";
    } 
    else if(stristr($scienergie, "HUILE AQUA")) {
        $parent->setValue('finition',"huile-aqua");
        $parentSuffixeEan .= " huile aqua";
    }
    else if(stristr($scienergie, "PRE HUIL")) {
        $parent->setValue('finition',"pre-huile");
        $parentSuffixeEan .= " pré-huilé";
    }
    else if(stristr($scienergie, "HUILE CIRE") ) {
        $parent->setValue('finition',"huile-cire");
        $parentSuffixeEan .= " huile cire";      
    }


    $object->setValue("pimonly_name_suffixe",$suffixeEan);
    $parent->setValue("pimonly_name_suffixe",$parentSuffixeEan);



    if($object->getEpaisseur()==15) {
        $object->setEpaisseurUsure('4 mm');

    }
    else  {
        $object->setEpaisseurUsure('6 mm');

    }
   

    $object->setChauffantBasseTemperature("1");
    $object->setChauffantRadiantElectrique("1");
    $object->setSolRaffraichissant("0");

    $parent->setValue('fixation',['rainurelanguette']);
    
    if(strlen($object->name)>0) {
        $object->setValue('name',null);
        
    } 

    if(!$sameParentAsPrevious) {
        $parent->save();
         echo "\nArticle :".$parent->getCode()." - ".$parent->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$parent->getPreviewUrl();
    }

    $object->save();

    echo "\nEan ($idx/$total):".$object->getEan()." - ".$object->getMage_name()." - ".$object->getPimonly_equivalence_auto(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>