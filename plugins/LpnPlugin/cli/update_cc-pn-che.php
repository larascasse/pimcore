<?php


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
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-pn/cc-pn-chene%'

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
    $code = $article = $object->code;
    $ean  = $object->ean;
    $parent = $object->getParent();

    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    /*if(stristr($scienergieCourt, "hd")) {
        $object->setSupport('HDF');
         $save=true;
    }
    else if(stristr($scienergieCourt, "cp")) {*/
        //$object->setSupport('cp');
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

    $save = true;
    //epaisseur

    if(strlen($object->getEan())>0) {
        //$object->setFixation(array('rainurelanguette4cotes'));
        //$object->setValue('support','3 plis massif');



        $longueur_txt = "";

        switch ($object->getEpaisseur()) {
            case '18':
            case '21':
                
                $object->setEpaisseurUsure('5 mm');
                 break;

            case '16':
                $object->setEpaisseurUsure('5 mm');
               
                break;
           
            default:
                # code...
                break;
        }

       
    


        //MULTI
        $suffixe = "";
        

        if(stristr($code,"fv")) {
           $suffixe .= " brut ".$object->getChoixString()." longueurs variables";
           $parent->setValue('configurable_free_1',"Longueurs variables");
      
        }
        else {
            $suffixe .= " brut ".$object->getChoixString()." longueurs fixes";
            $parent->setValue('configurable_free_1',"Longueurs fixes");
        }

      

        
        $parent->setValue('pimonly_name_suffixe',trim($suffixe));
        $parent->setValue('name',null);
        $parent->setValue('short_name',null);

        $object->setValue('name',null);
        $object->setValue('short_name',null);

        //echo "\n set suffixe ".trim($suffixe)."\n";

        $suffixeEan = $object->getEpaisseur()."x".$object->getLargeur();

        if(stristr($code,"fv")) {

            if($object->getLongueur() == 6000) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x3000-6000");
                $object->setValue('longueur_txt','Longueurs variables de 3000 à 6000 mm');
            }

            elseif($object->getLongueur() == 5000) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x3000-5000");
                $object->setValue('longueur_txt','Longueurs variables de 2000 à 5000 mm');
            }
        }
        else  {

            if($object->getLongueur() == 8000) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x7500-8000");
                $object->setValue('longueur_txt','Longueur fixe de 7500 à 8000 mm');
            } 
            elseif($object->getLongueur() == 7000) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x6500-7000");
                $object->setValue('longueur_txt','Longueur fixe de 6500 à 7000 mm');
            }

            elseif($object->getLongueur() == 6000) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x5000-6000");
                $object->setValue('longueur_txt','Longueur fixe de 5000 à 6000 mm');
            }
            elseif($object->getLongueur() == 4500) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x3000-4500");
                $object->setValue('longueur_txt','Longueur fixe de 3000 à 4500 mm');
            }
            elseif($object->getLongueur() == 2500) {
                $object->setValue("pimonly_name_suffixe",$suffixeEan."x1000-2500");
                $object->setValue('longueur_txt','Longueur fixe de 1000 à 2500 mm');
            }
        }

        
        $save=true;

       
        if(strlen($parent->name)>0) {
            $parent->setValue('name',null);
            
        } 
        $parent->setValue('chanfreins',"2");
        $object->setValue('chanfreins',null);
        
        $parent->setChauffantBasseTemperature("1");
        $parent->setChauffantRadiantElectrique("1");
        $parent->setSolRaffraichissant("0");

        $object->setChauffantBasseTemperature("");
        $object->setChauffantRadiantElectrique("");
        $object->setSolRaffraichissant("");


        $parent->save();

        //if($save)
        $object->save();

        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
   // continue;

   
    
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>