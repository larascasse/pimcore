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

$conditionFilters = array(
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp/mm-pn%'",
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

    if(!($object instanceof Object_Product))
        continue;
    

    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 


    $scienergieCourt    = $object->name_scienergie_court;
    $scienergie         = $object->name_scienergie;
    $code               = $article    = $object->code;
    $ean                = $object->ean;
    $parent             = $object->getParent();
    $essence            = $object->getEssence();
    $longueur            = $object->getLongueur();
   


   $longueur_txt = "";

   //CHENE

   if($essence == "CHE") {
        switch ($object->getEpaisseur()) {
            case '22':
                
                $object->setEpaisseurUsure('6 mm');
                 break;

            case '28':
                
                $object->setEpaisseurUsure('8 mm');
                break;

            case '30':
                
                $object->setEpaisseurUsure('12 mm');
                break;
           
            default:
                # code...
                break;
        }


        $longueur_min = 0;
        $longueur_max = 0;
        $isVariable = false;
        //Longeurs fixes
        if(stristr($code,"mv")) {

            $isVariable = true;
  
        }

        switch ($longueur) {
           
            case 1800:
                $longueur_min = 1000;
                $longueur_max = 1800;
                break;

            case 3300:
                $longueur_min = 1200;
                $longueur_max = 3300;
                break;

             case 4000:
                $longueur_min = 1000;
                $longueur_max = 4000;
                break;

             case 4800:
                $longueur_min = 3600;
                $longueur_max = 4800;
                break;

            case 5000:
                $longueur_min = 2000;
                $longueur_max = 5000;
                break;

            case 6000:
                $longueur_min = 1000;
                $longueur_max = 6000;

                if(!$isVariable) {

                    if($object->getEpaisseur()==22) {
                        
                        $longueur_min = 5100;
                        $longueur_max = 6000;
                    }
                    else {
                        
                        $longueur_min = 4500;
                        $longueur_max = 6000;
                    }
                    
                }
                break;

            case 7000:
                $longueur_min = 6500;
                $longueur_max = 7000;
                break;

            case 8000:
                $longueur_min = 6500;
                $longueur_max = 8000;

                if($object->getEpaisseur()==22) {
                        
                        $longueur_min = 7500;
                        $longueur_max = 8000;
                    }
                    else {
                        
                        $longueur_min = 6500;
                        $longueur_max = 8000;
                    }


                

                break;

            case 12000:
                $longueur_min = 8500;
                $longueur_max = 12000;
                break; 
     
        }

        if($longueur_min>0) {
            $object->setValue("pimonly_name_suffixe",$object->getEpaisseur()."x".$object->getlargeur()."x".$longueur_min."-".$longueur_max." ".($isVariable?"":"")."");
            $object->setValue("longueur_txt","Longueurs".($isVariable?"":"")." de ".$longueur_min." à ".$longueur_max." mm");
        }

        $object->setValue('chanfreins',"2");

        /*
        $parent->setChauffantBasseTemperature("1");
        $parent->setChauffantRadiantElectrique("1");
        $parent->setSolRaffraichissant("0");

        $object->setChauffantBasseTemperature("");
        $object->setChauffantRadiantElectrique("");
        $object->setSolRaffraichissant("");
        */

        $object->save();
    
        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();

   }
   //FIN CHENE


   else if($essence == "DGL") {
        
        switch ($object->getEpaisseur()) {
            case '20':
                
                $object->setEpaisseurUsure('7 mm');
                 break;

            case '28':
                
                $object->setEpaisseurUsure('11.5 mm');
                break;

            case '35':
                
                $object->setEpaisseurUsure('14.5 mm');
                break;
           
        }


        $longueur_min = 0;
        $longueur_max = 0;
        $isVariable = false;
        //Longeurs fixes
        if(stristr($code,"mv")) {

            $isVariable = true;
  
        }

        switch ($longueur) {
           
            

            case 5000:
                $longueur_min = 2000;
                $longueur_max = 5000;
                

                if(!$isVariable) {

                    $longueur_min = 1000;
                    $longueur_max = 5000;
                    
                    
                }

                if($object->getEpaisseur() == 20) {

                    $longueur_min = 1000;
                    $longueur_max = 5000;
                    
                    
                }
                break;

            case 7000:
                $longueur_min = 5500;
                $longueur_max = 7000;
                break;

            case 9000:
                $longueur_min = 7500;
                $longueur_max = 9000;

            

                break;

            case 12000:
                $longueur_min = 9500;
                $longueur_max = 12000;
                break; 

            case 15000:
                $longueur_min = 12500;
                $longueur_max = 15000;
                break;
     
        }

        if($longueur_min>0) {
            $object->setValue("pimonly_name_suffixe",$object->getEpaisseur()."x".$object->getlargeur()."x".$longueur_min."-".$longueur_max." ".($isVariable?"":"")."");
            $object->setValue("longueur_txt","Longueurs".($isVariable?"":"")." de ".$longueur_min." à ".$longueur_max." mm");
        }

        $object->setValue('chanfreins',"2");

        $values = array();
    
    $values['lesplus']='';
    $values['catalogue']='';
    $values['subtype']='';
    $values['leadtime']='';
    $values['shipping_type']='';
    $values['characteristics_others']='';
    $values['origine_bois']='';
    $values['country_of_manufacture']='';
    $values['norme_sanitaire']='';
    $values['support']='';
    $values['pefc']='';
    $values['meta_title']='';
    $values['meta_description']='';
    $values['no_stock_delay']='';
    $values['meta_title']='';
    $values['meta_description']='';
    $values['image_1']='';
    $values['image_2']='';
    $values['image_3']='';
    $values['characteristics_others']='';
    $values['characteristics_others_tech']='';
    $values['characteristics_others_perf']='';
    $values['associatedArticles']=array();
    $values['pimonly_category_pose']=null;
    $values['pimonly_category_finition']=null;
    $values['pimonly_category_entretien']=null;
    $values['re_skus']=null;
    $values['cs_skus']=null;
    $values['fiche_technique_lpn']=null;
    $values['fiche_technique_orginale']=null;
    $values['fiche_securite']=null;
    $values['realisations']=null;
    $objectToSave->setValues($values);

        /*
        $parent->setChauffantBasseTemperature("1");
        $parent->setChauffantRadiantElectrique("1");
        $parent->setSolRaffraichissant("0");

        $object->setChauffantBasseTemperature("");
        $object->setChauffantRadiantElectrique("");
        $object->setSolRaffraichissant("");
        */

        $object->save();
    
        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();

   }
   //FIN CHENE

    
        

}


 Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>