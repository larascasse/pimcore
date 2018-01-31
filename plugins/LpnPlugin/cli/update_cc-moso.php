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
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-bambou/cc-mo%'

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

        $object->setFixation(array('click'));
        $object->setPose(array('acoller','flottante'));
        $object->setPieceHumide("non");

        $object->setChauffantBasseTemperature("1");
        $object->setChauffantRadiantElectrique("1");
        $object->setSolRaffraichissant("0");

        $object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);

        if(stristr($scienergie, "BROSS")) {
            $object->setTraitement_surface(("brosse"));
        }

  


        //TOP
        if(stristr($ean, "110128")) {
           $object->setSupport('HDF');
           $object->setChanfreins("4");
          // $object->setFixation(array('click'));
           $object->setEpaisseurUsure('2.5 mm');
           $object->setNorme_sanitaire("A+");
           $object->setPimonly_classe_reaction_feu_eu("Cfls1");

           if(stristr($scienergie, "DENSIF")) {
                $object->setPimonly_resistance_thermique("0.0542");
                $object->setPimonly_conductivite_thermique_total("0.18");
                 $object->setClasse("31");
           }
           else {
                $object->setPimonly_resistance_thermique("0.0591");
                $object->setPimonly_conductivite_thermique_total("0.17");
                $object->setClasse("23");
           }
           $techDescription [] = "Garantie : 10 ans";
           


        }
        //NOBLE
        else if(stristr($ean, "115142")) {
            $object->setSupport('Latté');
            $object->setChanfreins("4");
           // $object->setFixation(array('rainurelanguette'));
            $object->setEpaisseurUsure('4 mm');
            $object->setNorme_sanitaire("A");
            $object->setPimonly_classe_reaction_feu_eu("Dfls1");

           if(stristr($scienergie, "DENSIF")) {
                $object->setPimonly_resistance_thermique("0.1074");
                $object->setPimonly_conductivite_thermique_total("0.13");
                $object->setClasse("33");
           }
           else {
                $object->setPimonly_resistance_thermique("0.1152");
                $object->setPimonly_conductivite_thermique_total("0.14");
                $object->setClasse("31");
           }

           $techDescription [] = "Garantie : 30 ans";


        }
        //TOP
        else if(stristr($ean, "110125")) {
            $object->setSupport('HDF');
            $object->setChanfreins("4");
            
            $object->setEpaisseurUsure('2.5 mm');
            $object->setNorme_sanitaire("A+");
            $object->setPimonly_classe_reaction_feu_eu("Cfls1");

            if(stristr($scienergie, "DENSIF")) {
                $object->setPimonly_resistance_thermique("0.0542");
                $object->setPimonly_conductivite_thermique_total("0.18");
                 $object->setClasse("31");
           }
           else {
                $object->setPimonly_resistance_thermique("0.0591");
                $object->setPimonly_conductivite_thermique_total("0.17");
                 $object->setClasse("23");
           }

           $techDescription [] = "Garantie : 10 ans";



        }
        //NOBLE
        else if(stristr($ean, "115190")) {
            $object->setSupport('Latté');
            $object->setChanfreins("4");
           // $object->setFixation(array('rainurelanguette'));
            $object->setEpaisseurUsure('4 mm');
            $object->setNorme_sanitaire("A");
            $object->setPimonly_classe_reaction_feu_eu("Dfls1");

           if(stristr($scienergie, "DENSIF")) {
                $object->setPimonly_resistance_thermique("0.1074");
                $object->setPimonly_conductivite_thermique_total("0.14");
                 $object->setClasse("33");
           }
           else {
                $object->setPimonly_resistance_thermique("0.1152");
                $object->setPimonly_conductivite_thermique_total("0.13");
                $object->setClasse("31");
           }

           $techDescription [] = "Garantie : 30 ans";

        }




        $techTech[] = "Contribution LEED BD+C - v4 : EQ2 / v2009: MR 6, IEQ 4.3";
        $techTech[] = "Contribution HQE : 2.4.1, 2.4.2, 2.4.3";

        $object->setCharacteristics_others(implode("\n", $techDescription));
        $object->setCharacteristics_others_tech(implode("\n", $techTech));
        $object->setCharacteristics_others_perf(implode("\n", $techCe));

    


        



        switch ($object->getEpaisseur()) {
            case '10':
              
                 break;

            case '15':
               
                break;
            
            default:
                # code...
                break;
        }

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

   
    if($save)
        $object->save();


    continue;
    $values = array();
    $objectToSave = Object::getById($object->getId());
    foreach ($fieldsToClean as $key => $fieldName) {
        # code...
        
        

        $value = $object->getValueForFieldName($fieldName);
        if(!($object->getParent() instanceof Website_Product)) {
            $parentValue = $object->getParent()->getParent()->getValueForFieldName($fieldName);
         
        }
        else {
            $parentValue = $object->getParent()->getValueForFieldName($fieldName);
        }

        

        if(($value == $parentValue || $value=="Terrasses en bois par La Parqueterie Nouvelle") && strlen($value)>0 ) {
            echo "--> nullify $fieldName : ".$object->getSku()."  -----    $value <-> $parentValue\n";
            
            
            $values[$fieldName]=null;
            


            //$objectToSave->setPublished(true);
            
        }
   
    }

    if(count( $values)>0) {
        $objectToSave->setValues($values);
        //print_r($values);

        echo "\n";
        $objectToSave->save();
    }
    
    

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>