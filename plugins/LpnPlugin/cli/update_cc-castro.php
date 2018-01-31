<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-bambou/cc-mo

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
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-bois-exo/cc-cf%'

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
    $famille = $object->getFamille();
    $epaisseur = $object->getEpaisseur();
    $largeur = $object->getLargeur();

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

    $techDescription = array();
    $techTech = array();
    $techCe = array();



    
   

    if(stristr($scienergie, "DENSIF")) {
        $techTech[] = "Densité (Couche supérieure) : +/- 1050 kg/m3";
        $techTech[] = "Contribution BREEAM : HEA 2, MAT 5 (DT)";
        $techTech[] = "Dureté Brinell : >= 9.5kg/mm2";
    }
    else {
        $techTech[] = "Densité (Couche supérieure) : +/- 700 kg/m3";
        $techTech[] = "Contribution BREEAM : HEA 2, MAT 1";
        $techTech[] = "Dilatation bambou: 0,14% pour 1% de variation d’humidité";
        $techTech[] = "Dureté Brinell : >= 4kg/mm2";
    }




    if(strlen($object->getEan())>0) {

        $object->setPose(array('acoller','flottante'));
        $object->setSupport('cp');

        //DOUSSIE
        if(stristr($famille, "FMDOUG4COUVE0CF")) {


        }

        //Erable US
        elseif(stristr($famille, "FMERAG4COUVE0CF")) {

        }
        //IROKO
        elseif(stristr($famille, "FMIROG4COUVE0CF")) {

        }      
        //NOYER IUS
        elseif(stristr($famille, "FMNOAG4COUVE0CF")) {

        }      
        //NOYER CLICK
        elseif(stristr($famille, "FMNOYG2COCVM0BW")) {

        }        
        //SAPELLI
        elseif(stristr($famille, "FMSPIG4COUVE0CF")) {

        }
        //TECK
        elseif(stristr($famille, "FMTECG4COUVE0CF")) {

        }

        switch ($epaisseur) {
            case 10:
                //Sauf teck
                if($largeur==120 && $famille != 'FMTECG4COUVE0CF') {
                    $object->setEpaisseurUsure('3 mm');
                }
                else {
                    $object->setEpaisseurUsure('4 mm');
                }
                break;
            
            default:
                $object->setEpaisseurUsure('4 mm');
                break;
        }
       


        $object->setChauffantBasseTemperature("1");
        $object->setChauffantRadiantElectrique("1");
        $object->setSolRaffraichissant("0");

        $object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);

        /*
        $object->setPimonly_resistance_thermique("0.0542");
                $object->setPimonly_conductivite_thermique_total("0.18");
                 $object->setClasse("31");
                 */


        //$techDescription [] = "Garantie : 30 ans";
        //$techTech[] = "Contribution LEED BD+C - v4 : EQ2 / v2009: MR 6, IEQ 4.3";
        //$techTech[] = "Contribution HQE : 2.4.1, 2.4.2, 2.4.3";

        $object->setCharacteristics_others(implode("\n", $techDescription));
        $object->setCharacteristics_others_tech(implode("\n", $techTech));
        $object->setCharacteristics_others_perf(implode("\n", $techCe));

    
        //PRE - HUILE

        /*$suffixe = "";
        if(stristr($scienergie, "PRE - HUILE")) {
            $parent->setValue('finition',"huile-aqua");
            $suffixe.= "huile aqua";
        }
        else if(stristr($scienergie, "BROSSE")) {
            $parent->setValue('finition',"huile-aqua");
            $suffixe.= "huile aqua";
        }
        */
       


        //melange de choix dans Scienergie.. on passe par l'EAN
        //$suffixe.=" ".$object->getChoixString();
        
        //$parent->setValue('pimonly_name_suffixe',trim($suffixe));



        //$parent->setValue('finition',"huile-cire");
        //$parent->setValue('pimonly_name_suffixe',trim($suffixe));

        

    }







    
   

    if(strlen($object->getEan())>0) {
       
 
        $save=true;

       
        if(strlen($parent->name)>0 && !stristr($code,"zzp")  && !stristr($code,"xzp")) {
            $parent->setValue('name',null);
            
        } 
        $parent->save();
        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
   // continue;

   
   // if($save)
        $object->save();




    
    

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>