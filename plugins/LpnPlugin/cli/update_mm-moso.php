<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-bambou/cc-mo

//plugins/LpnPlugin/odata/pimcore$ php import_ean_to_pimcore.php startswith=fmbamg4 nonactif=1
//plugins/LpnPlugin/odata/pimcore$ php import_ean_to_pimcore.php startswith=fmbamg0 nonactif=1

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
        "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/mm-bambou/mm-mo%'",
       "ean IS NOT NULL"
);


$list = new Pimcore\Model\Object\Product\Listing();
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



    
   

 


 

        //$object->setFixation(array('click'));
        $object->setPose(array('acoller'));
        $object->setPieceHumide("non");

        $object->setChauffantBasseTemperature("1");
        $object->setChauffantRadiantElectrique("1");
        $object->setSolRaffraichissant("0");

        $object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);

        $object->setPimonly_classe_reaction_feu_eu("Cfls1");
       


        //Elite
        if($object->getEpaisseur() == 13 || ($object->getEpaisseur() == 15 && $object->getLongueur() == 1960)) {
           
           $object->setNorme_sanitaire("A+");
           $object->setPimonly_classe_reaction_feu_eu("Cfls1");

           if(stristr($scienergie, "DENSIF")) {
                $object->setPimonly_resistance_thermique("0.0784");
                $object->setPimonly_conductivite_thermique_total("0.19");
                 $object->setClasse("33");
                 $object->setEpaisseurUsure('3 mm');

                $techTech[] = "Densité (Couche supérieure) : +/- 1050 kg/m3";
                $techTech[] = "Contribution BREEAM : HEA 2, MAT 5 (DT)";
                $techTech[] = "Dureté Brinell : >= 9.5kg/mm2";
           }
           else {
                $object->setPimonly_resistance_thermique("0.0882");
                $object->setPimonly_conductivite_thermique_total("0.17");
                $object->setClasse("31");
                $object->setEpaisseurUsure('5 mm');

                $techTech[] = "Densité (Couche supérieure) : +/- 700 kg/m3";
                $techTech[] = "Contribution BREEAM : HEA 2, MAT 1, MAT 3, MAT 5";
                $techTech[] = "Dureté Brinell : >= 4kg/mm2";

           }
           $techDescription [] = "Garantie : 30 ans";
           


        }

        //Forest
        else if($object->getEpaisseur() == 18) {
           
           $object->setNorme_sanitaire("A+");
           $object->setPimonly_classe_reaction_feu_eu("Cfls1");

           $techTech[] = "Densité (Couche supérieure) : +/- 850 kg/m3";
           $techTech[] = "Contribution BREEAM : HEA 2, MAT 1, MAT 3, MAT 5";
           $techTech[] = "Dureté Brinell : >= 9.5kg/mm2";

            $object->setPimonly_resistance_thermique("0.0872");
            $object->setPimonly_conductivite_thermique_total("0.21");
            $object->setClasse("34");
            

           $techDescription [] = "Garantie : 30 ans";
           


        }
        
       //PURE
        if($object->getEpaisseur() == 12 || ($object->getEpaisseur() == 15 && $object->getLongueur() == 960)) {
           
           $object->setNorme_sanitaire("A+");
           $object->setPimonly_classe_reaction_feu_eu("Cfls1");

           if ($object->getEpaisseur() == 12) {
             $object->setEpaisseurUsure('3 mm');
           }
           else if(stristr($scienergie, "HORIZ")) {
                $object->setEpaisseurUsure('5 mm');
            }
            else {
                $object->setEpaisseurUsure('6 mm');
            }

           if(stristr($scienergie, "DENSIF")) {
                $object->setPimonly_resistance_thermique("0.0471");
                $object->setPimonly_conductivite_thermique_total("0.26");
                 $object->setClasse("33");
                 

                $techTech[] = "Densité (Couche supérieure) : +/- 1050 kg/m3";
                $techTech[] = "Contribution BREEAM : HEA 2, MAT 5 (DT)";
                $techTech[] = "Dureté Brinell : >= 9.5kg/mm2";
           }
           else {
                $object->setPimonly_resistance_thermique("0.0882");
                $object->setPimonly_conductivite_thermique_total("0.17");
                $object->setClasse("31");
                $object->setEpaisseurUsure('5 mm');

                $techTech[] = "Densité (Couche supérieure) : +/- 700 kg/m3";
                $techTech[] = "Contribution BREEAM : HEA 2, MAT 1, MAT 3, MAT 5";
                $techTech[] = "Dureté Brinell : >= 4kg/mm2";

           }
           $techDescription [] = "Garantie : 30 ans";
           


        }




        $techTech[] = "Contribution LEED BD+C - v4 : EQ2 / v2009: MR 6, MR 7, IEQ 4.3";
        $techTech[] = "Contribution HQE : 2.3.1, 2.3.2, 2.3.4 (FSC), 2.4.1, 2.4.2, 2.4.3";

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

       
        /*if(strlen($parent->name)>0 && !stristr($code,"zzp")  && !stristr($code,"xzp")) {
            $parent->setValue('name',null);
            
        } 
        $parent->save();*/
        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
  

   
    $object->save();


    
    

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>